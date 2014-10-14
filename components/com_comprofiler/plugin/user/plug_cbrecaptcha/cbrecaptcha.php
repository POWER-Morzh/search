<?php
/**
* CBreCaptcha provide Captcha widget in CB registrantion and password/username remind forms.
* @author Juan Padial
* @copyright (C) Juan Padial, www.shikle.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

if ( !( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) {
    die( 'Direct Access to this location is not allowed.' );
}

if (!defined('_UE_CAPTCHA_Label')) DEFINE('_UE_CAPTCHA_Label','Security Code:');
if (!defined('_UE_CAPTCHA_Desc')) DEFINE('_UE_CAPTCHA_Desc','Enter Security Code from image');
if (!defined('_UE_CAPTCHA_NOT_VALID')) DEFINE('_UE_CAPTCHA_NOT_VALID','Invalid Security Code');

$_PLUGINS->registerFunction('onBeforeRegisterForm','onBeforeRegisterForm','getcbrecaptchaTab');
$_PLUGINS->registerFunction('onBeforeUserRegistration','onBeforeUserRegistration','getcbrecaptchaTab');

$_PLUGINS->registerFunction('onLostPassForm','onLostPassForm','getcbrecaptchaTab');
$_PLUGINS->registerFunction('onBeforeNewPassword','onBeforeNewPassword','getcbrecaptchaTab' );

$_PLUGINS->registerFunction('onAfterEmailUserForm','onAfterEmailUserForm','getcbrecaptchaTab');
$_PLUGINS->registerFunction('onBeforeEmailUser','onBeforeEmailUser','getcbrecaptchaTab' );
$_PLUGINS->registerFunction('onBeforeUsernameReminder','onBeforeUsernameReminder','getcbrecaptchaTab');
require_once('cb_mycaptacha.model.php');

class getcbrecaptchaTab extends cbTabHandler {
	/**
	* Constructor
	*/	
	function getcbrecaptchaTab() {
		$this->cbTabHandler();
	}
	function _getreCaptcha() {
	        $params = $this->params;
	        $captchatype = $params->get('captchatype', 'myCaptcha');
	        $publickey = $params->get('publickey', '');
	        $mycaptchadata = array();
	        $mycaptchadata[0] = $params->get('font', 'texb.ttf');
	        $mycaptchadata[1] = $params->get('img_width', '100');
	        $mycaptchadata[2] = $params->get('img_height', '30');
	        $mycaptchadata[3] = $params->get('bg_color', '#fff');
	        $mycaptchadata[4] = $params->get('border_color', '#996666');
	        $mycaptchadata[5] = $params->get('text_color', '#6f6f6f');
	        $mycaptchadata[6] = $params->get('grid_color', '#ffb6b6');
	        $mycaptchadata[7] = $params->get('shadow_color', '#fff0f0');
	        $ssl = $params->get('ssl_server', false);
	        $captcha = CbmycaptchaModel::displayCode($captchatype,$mycaptchadata,$publickey,$ssl);
		return $captcha;
	}
	
	function getDisplayRegistration($tab, $user, $ui) {
	        $params = $this->params;
	        $captchatype = $params->get('captchatype', 'myCaptcha');
	        $return = '';
	        if($captchatype == 'reCaptcha') {
	        $return .= "<script type=\"text/javascript\">
				 var RecaptchaOptions = {
				      lang : '".$params->get('recaptchalanguage','en')."',
                                      theme : '".$params->get('recaptchatheme','red')."'
                                   };
			  </script>";
	        }
	        
		$captcha = $this->_getreCaptcha();
		$return .= "<tr>\n";                                              
		$return .= "	<td class=\"titleCell\"></td>\n";
		$return .= "	<td class=\"fieldCell\">" . $captcha;
		$return .= "</td></tr>\n";
		if($captchatype == 'myCaptcha') {
		  $return .= "<tr>\n";                                              
		  $return .= "	<td class=\"titleCell\">"._UE_CAPTCHA_Label."</td>\n";
		  $return .= "	<td class=\"fieldCell\"><input id=\"cb_mycaptcha\" class=\"inputbox\" type=\"text\" size=\"25\" value=\"\" name=\"cb_mycaptcha\"/>";
		  $return .= "</td></tr>\n";
		}
		
		return $return;
	}

	function onBeforeUserRegistration( &$row, &$rowExtras ) {
		global $_POST,$_PLUGINS;
		$params = $this->params;
		$captchatype = $params->get('captchatype', 'myCaptcha');
		if($captchatype == 'myCaptcha') {
                  $checkarray = array('word' => $_POST['cb_mycaptcha'], 'ip' => CbmycaptchaModel::GetUserIp());
                } else {
                 $privatekey = $params->get('privatekey','');
                 $checkarray = array('privatekey' => $privatekey, 'rec_ch_field' => $_POST["recaptcha_challenge_field"],'rec_res_field' => $_POST["recaptcha_response_field"]);
                }
                $res = CbmycaptchaModel::checkCode($checkarray,$captchatype);
		if (!$res) {
			$_PLUGINS->raiseError(0);
			$_PLUGINS->_setErrorMSG(_UE_CAPTCHA_NOT_VALID);
		}
		return true;
	}

	function onLostPassForm( $ui ) {
		$captcha = $this->_getreCaptcha();
		$params = $this->params;
	        $captchatype = $params->get('captchatype', 'myCaptcha');
	        if($captchatype == 'reCaptcha') {
	        $label = "<script type=\"text/javascript\">
				 var RecaptchaOptions = {
				      lang : '".$params->get('recaptchalanguage','en')."',
                                      theme : '".$params->get('recaptchatheme','red')."'
                                   };
			  </script>&nbsp;";
	        }                                       
		$return = $captcha;
		if($captchatype == 'myCaptcha') {
		  $label = _UE_CAPTCHA_Label;
		  $return .= "<br/><input id=\"cb_mycaptcha\" class=\"inputbox\" type=\"text\" size=\"25\" value=\"\" name=\"cb_mycaptcha\"/>";
		} else {
		  $label == '';
		}
				
		$return = array(0 => $label, 1 => $return);
		return $return;		
	}
	
	function onBeforeNewPassword( $user_id, &$newpass, &$subject, &$message ) {
		global $_POST,$_PLUGINS;
		$params = $this->params;
		$captchatype = $params->get('captchatype', 'myCaptcha');
		if($captchatype == 'myCaptcha') {
                  $checkarray = array('word' => $_POST['cb_mycaptcha'], 'ip' => CbmycaptchaModel::GetUserIp());
                } else {
                 $privatekey = $params->get('privatekey','');
                 $checkarray = array('privatekey' => $privatekey, 'rec_ch_field' => $_POST["recaptcha_challenge_field"],'rec_res_field' => $_POST["recaptcha_response_field"]);
                }
                $res = CbmycaptchaModel::checkCode($checkarray,$captchatype);
		if (!$res) {
			$_PLUGINS->raiseError(0);
			$_PLUGINS->_setErrorMSG(_UE_CAPTCHA_NOT_VALID);
		}
		return true;
	}

	function onAfterEmailUserForm( &$rowFrom, &$rowTo, &$warning, $ui ) {
	        $params = $this->params;
	        $captchatype = $params->get('captchatype', 'myCaptcha');
	        $return = '';
	        if($captchatype == 'reCaptcha') {
	        $return = "<script type=\"text/javascript\">
				 var RecaptchaOptions = {
				      lang : '".$params->get('recaptchalanguage','en')."',
                                      theme : '".$params->get('recaptchatheme','red')."'
                                   };
			  </script>";
	        }
	        
		$captcha = $this->_getreCaptcha();
		$return .= "<tr>\n";                                              
		$return .= "	<td class=\"titleCell\"></td>\n";
		$return .= "	<td class=\"fieldCell\">" . $captcha;
		$return .= "</td></tr>\n";
		if($captchatype == 'myCaptcha') {
		  $return .= "<tr>\n";                                              
		  $return .= "	<td class=\"titleCell\">"._UE_CAPTCHA_Label."</td>\n";
		  $return .= "	<td class=\"fieldCell\"><input id=\"cb_mycaptcha\" class=\"inputbox\" type=\"text\" size=\"25\" value=\"\" name=\"cb_mycaptcha\"/>";
		  $return .= "</td></tr>\n";
		}
		
		return $return;
	}
	function onBeforeEmailUser( &$rowFrom, &$rowTo, $ui ) {
		global $_POST,$_PLUGINS;
		$params = $this->params;
		$captchatype = $params->get('captchatype', 'myCaptcha');
		if($captchatype == 'myCaptcha') {
                  $checkarray = array('word' => $_POST['cb_mycaptcha'], 'ip' => CbmycaptchaModel::GetUserIp());
                } else {
                 $privatekey = $params->get('privatekey','');
                 $checkarray = array('privatekey' => $privatekey, 'rec_ch_field' => $_POST["recaptcha_challenge_field"],'rec_res_field' => $_POST["recaptcha_response_field"]);
                }
                $res = CbmycaptchaModel::checkCode($checkarray,$captchatype);
		if (!$res) {
			$_PLUGINS->raiseError(0);
			$_PLUGINS->_setErrorMSG(_UE_CAPTCHA_NOT_VALID);
		}
		return true;
	}
  function onBeforeUsernameReminder( $ui, &$subject, &$message ) {
		global $_POST,$_PLUGINS;
		$params = $this->params;
		$captchatype = $params->get('captchatype', 'myCaptcha');
		if($captchatype == 'myCaptcha') {
                  $checkarray = array('word' => $_POST['cb_mycaptcha'], 'ip' => CbmycaptchaModel::GetUserIp());
                } else {
                 $privatekey = $params->get('privatekey','');
                 $checkarray = array('privatekey' => $privatekey, 'rec_ch_field' => $_POST["recaptcha_challenge_field"],'rec_res_field' => $_POST["recaptcha_response_field"]);
                }
                $res = CbmycaptchaModel::checkCode($checkarray,$captchatype);
		if (!$res) {
			$_PLUGINS->raiseError(0);
			$_PLUGINS->_setErrorMSG(_UE_CAPTCHA_NOT_VALID);
		}
		return true;
	}
}
?>