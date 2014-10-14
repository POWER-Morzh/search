<?php

if ( !( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) {
    die( 'Direct Access to this location is not allowed.' );
}
if (!defined('DS')) define( 'DS', DIRECTORY_SEPARATOR );
class CbmycaptchaModel  {
	    	
	function displayCode($captchatype='myCaptcha',$mycaptchadata,$publickey = null,$ssl = false) {
           if($captchatype == 'myCaptcha') {
                $db = &JFactory::getDBO();
		require_once('captcha_pi'.DS.'captcha_pi.php');
		$vals = array(
						'word'		 => '',
						'img_path'	 => JPATH_CACHE.DS,
						'img_url'	 => JURI::root().'cache'.DS,
						'font_path'	 => $mycaptchadata[0],					
						'img_width'	 => $mycaptchadata[1],
						'img_height' => $mycaptchadata[2],
						'bg_color' => $mycaptchadata[3],
						'border_color'=>$mycaptchadata[4],
						'text_color' => $mycaptchadata[5],
						'grid_color'=>$mycaptchadata[6],
						'shadow_color'=>$mycaptchadata[7],
						'expiration' => 3600
					);

		$captcha = create_captcha($vals);
		
		$query = "INSERT INTO #__cb_mycaptcha (captcha_time,ip_address,word)"
		. "\n VALUES ('{$captcha['time']}','".CbmycaptchaModel::GetUserIp()."','{$captcha['word']}')";
		
		$db->setQuery($query);
		
		$db->query() or die( $db->stderr() );
		
		return $captcha['image'];
	   } else {
	   	require_once('recaptcha'.DS.'recaptchalib.php');
		$reCaptcha = recaptcha_get_html($publickey,null,$ssl);
		return $reCaptcha;
	   }
	}

	function checkCode($checkarray,$captchatype = 'myCaptcha')
        {
           if($captchatype == 'myCaptcha') {
		// First, delete old captchas
		$expiration = time()-3600; // Two hour limit
		$db  = &JFactory::getDBO();
		$db->setQuery("DELETE FROM #__cb_mycaptcha WHERE captcha_time < ".$expiration);
		$db->query();

		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count "
		. "\n FROM #__cb_mycaptcha "
		. "\n WHERE word = '{$checkarray['word']}' AND ip_address = '{$checkarray['ip']}' AND captcha_time > $expiration"
		;
		
		$query = $db->setQuery($sql);
		
		if ($db->loadResult()) {
			return true;
		} else {
			return false;
		}
           } 
           if($captchatype == 'reCaptcha') {
                require_once('recaptcha'.DS.'recaptchalib.php');
                $res = recaptcha_check_answer ($checkarray['privatekey'],
                                CbmycaptchaModel::GetUserIp(),
                                $checkarray["rec_ch_field"],
                                $checkarray["rec_res_field"]);
                if(!$res->is_valid) {
                  return false;
                } else {
                  return true;
                }
           }
	}
	function GetUserIp()
        {
            $ip = "";
            if(isset($_SERVER)) {
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
                {
                   $ip=$_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                   $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                   $ip=$_SERVER['REMOTE_ADDR'];
                }
            } else {
               if ( getenv( 'HTTP_CLIENT_IP' ) ) {
                 $ip = getenv( 'HTTP_CLIENT_IP' );
               } elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
                 $ip = getenv( 'HTTP_X_FORWARDED_FOR' );
               } else {
                 $ip = getenv( 'REMOTE_ADDR' );
               }
            }
            // In some weird cases the ip address returned is repeated twice separated by comma
            if(strstr($ip,','))
             {
               $ip = array_shift(explode(',',$ip));
             }
           return $ip;
        }
}