<?php

/**
* @version $Id: dt.deleteme.php
* @package Community Builder
* @subpackage DT Delete Me Plugin
* @author DTH Development
* @url www.DTHDevelopment.com
* @copyright (C)2009 DTH Development
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
*/

// ensure this file is being included by a parent file

if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

$_PLUGINS->registerFunction( 'onAfterDeleteUser', 'userDeleted', 'getDemoTab' );

class getDemoTab extends cbTabHandler {

	function getAuthorTab() {

		$this->cbTabHandler();

	}

	function getDisplayTab($tab,$user,$ui) {

global $_CB_framework,$_CB_database,$ueConfig;

$params = $this->params;
$myuser =& JFactory::getUser();
if($myuser->id != $user->id){
   return "";
}
global $Itemid ;
					$Itemid = $_CB_framework->itemid() ;
$id=$myuser->id;
$taskS= $_CB_framework->getRequestVar( 'task' );
//$obj		=&	$_CB_framework->_getCmsUserObject( (int) $id );

      switch ( $taskS ) {

	case "del":

		 global $mainframe;

		//perform the logout action

		new cbTabs( 0, 2, null, false );		// load plugins

			$obj		=&	$_CB_framework->_getCmsUserObject( (int) $id );

				$count = 2;
				
				if ( ( $obj !== null ) && ( $obj->gid == 8 ) ) {

					// count number of active super users

					$query = "SELECT COUNT(distinct u.id )"

					. "\n FROM #__users  u inner join #__user_usergroup_map ug on u.id = ug.user_id "

					. "\n WHERE ug.group_id = 8"

					. "\n AND u.block = 0"

					;

					$_CB_database->setQuery( $query );

					$count = $_CB_database->loadResult();

				}

				if ( $count <= 1 && $obj->gid == 8 ) {

				// cannot delete Super User where it is the only one that exists

					$msg = "You cannot delete this Super User as it is the only active Super User for your site";
					
					cbRedirect( 'index.php?option=com_comprofiler&Itemid='.$Itemid, $msg );
					

				} else {

					// delete user

 					$result = cbDeleteUser( $id, null, $inComprofilerOnly = false );

 					$mailfrom = $ueConfig['reg_email_from'];

					$fromname = $ueConfig['reg_email_name'];

					$mailTo=$ueConfig['reg_email_replyto'];

					$msgUser=$params->get('user_email_text',"");

					$msgAdmin="User {$user->username} with email {$user->email} has successfully deleted themself.";

					$msgSubUser=$params->get('user_email_sub',"");

					$msgSubAdmin="User Account Deleted";
					 
					$dt_mail = JFactory::getMailer();
		$dt_mail->addRecipient($user->email);
		$dt_mail->isHTML(true);
		$dt_mail->addReplyTo(array($mailfrom, $fromname));
		$dt_mail->setSender(array($mailfrom, $fromname));
		$dt_mail->setSubject($msgSubUser);
		$dt_mail->setBody($msgUser);
		$sent = $dt_mail->Send();
		
		$dt_mail = JFactory::getMailer();
		$dt_mail->addRecipient($mailTo);
		$dt_mail->isHTML(true);
		$dt_mail->addReplyTo(array($obj->email, $obj->name));
		$dt_mail->setSender(array($obj->email,  $obj->name));
		$dt_mail->setSubject($msgSubAdmin);
		$dt_mail->setBody($msgAdmin);
		$sent = $dt_mail->Send();

 					if ( $result === null ) {

 						$msg .= "User not found";

 					} elseif (is_string( $result ) && ( $result != "" ) ) {

 						$msg .= $result;

					}

				}

$error = $mainframe->logout();

		if(!JError::isError($error))

		{

			if ($return = JRequest::getVar('return', '', 'method', 'base64')) {

				$return = base64_decode($return);

				if (!JURI::isInternal($return)) {

					$return = '';

				}

			}

			if ( $return && !( strpos( $return, 'index.php' )) ) {

			}

if ( ! $_CB_framework->check_acl( 'canManageUsers', $_CB_framework->myUserType() ) ) {

	cbRedirect( 'index.php', _UE_NOT_AUTHORIZED, 'error' );

}

		} else {

			parent::display();

		}

		break;

          default:

	  $return="<div style=\"paading-bottom:40px;\">".$params->get('text_for_frontend',"")."</div>";
global $Itemid ;
    $return.="<form method='post' onsubmit=\"return confirm('".$params->get('confirm_msg')."')\" action='#'><input type='submit' value='Delete Me'><input type='hidden' name='Itemid' value='".$Itemid."'><input type='hidden' name='task' value='del'></form>";

		return $return;

		break;

}

	}

      function del()

        {

    }

}	// end class getAuthorTab.

?>