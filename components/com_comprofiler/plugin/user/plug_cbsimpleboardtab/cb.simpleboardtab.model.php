<?php
/**
* Forum Tab Class for handling the CB tab api
* @version $Id: cb.simpleboardtab.model.php 1908 2012-11-02 14:24:31Z beat $
* @package Community Builder
* @subpackage plug_cbsimpleboardtab.php
* @author JoomlaJoe and Beat (Nick A. fixed Fireboard support)
* @copyright (C) JoomlaJoe and Beat, www.joomlapolis.com
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
* Thanks to LucaZone, www.lucazone.net for Fireboard adaptation suggestions
*/

if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

class getForumModel extends cbTabHandler {
	
	/**
	 * Generate forum API
	 *
	 * @param moscomprofilerUser $user
	 * @param array              $params
	 * @return object
	 */
	function getConfig( $user ) {
		global $_CB_database;

		static $forum					=	null;

		if ( $forum === null ) {
			$forum						=	$this->getForumParams();

			if ( $forum !== null ) {
				if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
					if ( ! $forum->config ) {
						$query			=	'SELECT * FROM ' . $_CB_database->NameQuote( '#__' . $forum->prefix . '_config' );
						$_CB_database->setQuery( $query );
						$forum->config	=	$_CB_database->loadAssoc();
					} else {
						if ( $forum->component == 'com_fireboard' ) {
							global $fbConfig;
							$config		=&	$fbConfig;
						} elseif ( $forum->component != 'com_kunena' ) {
							global $sbConfig;
							$config		=&	$sbConfig;
						}

						include_once ( $forum->config );

						if ( $forum->component == 'com_kunena' ) {
							$config		=	get_object_vars( CKunenaConfig::getInstance() );
						}

						$forum->config	=	$config;
					}
				} elseif ( class_exists( 'KunenaFactory' ) ) {
					$forum->config		=	get_object_vars( KunenaFactory::getConfig() );
				} else {
					$forum->config		=	null;
				}

				$forum->version			=	$this->getVersion( $forum );
			}
		}

		if ( $forum !== null && isset( $user->id ) ) {
			$forum->userdetails			=	$this->getUserDetails( $user, $forum );
		}

		return $forum;
	}
	
	/**
	 * Get forum version
	 *
	 * @param object $forum
	 * @return string
	 */
	function getVersion( $forum ) {
		global $_CB_database;

		static $version			=	null;

		if ( $version === null ) {
			if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
				if ( isset( $forum->config['version'] ) ) {
					$version	=	$forum->config['version'];
				} elseif ( ( $forum->component == 'com_fireboard' ) || ( $forum->component == 'com_kunena' ) ) {
					$query		=	'SELECT '		. $_CB_database->NameQuote( 'version' )
								.	"\n FROM "		. $_CB_database->NameQuote( '#__' . $forum->prefix . '_version' )
								.	"\n ORDER BY "	. $_CB_database->NameQuote( 'id' ) . " DESC";
					$_CB_database->setQuery( $query, 0, 1 );
					$version	=	$_CB_database->loadResult();
				} else {
					$version	=	'0.0.0';
				}
			} elseif ( class_exists( 'KunenaForum' ) ) {
				$version		=	KunenaForum::version();
			} else {
				$version		=	'0.0.0';
			}
		}

		return $version;
	}
	
	/**
	 * Generate users details
	 *
	 * @param moscomprofilerUser $user
	 * @param object             $forum
	 * @return object
	 */
	function getUserDetails( $user, $forum ) {
		global $_CB_database, $_CB_framework;
		
		static $usersdetailsCache								=	array();

		if ( ! isset( $usersdetailsCache[$user->id] ) ) {

			if ( ( isset ( $forum->config['showuserstats'] ) ? $forum->config['showuserstats'] : $forum->config['showstats'] ) || ( ! $forum->config['showranking'] && ! $forum->config['showkarma'] && ! ( isset ( $forum->config['poststats'] ) ? $forum->config['poststats'] : ( isset ( $forum->config['postStats'] ) ? $forum->config['postStats'] : ( isset ( $forum->config['userlist_posts'] ) ? $forum->config['userlist_posts'] : $forum->config['showstats'] ) ) ) ) ) {
				if ( ( ( $forum->component == 'com_fireboard' ) && ( $forum->version >= '1.0.3' ) ) || ( $forum->component == 'com_kunena' ) ) {
					$supportsDbRanks							=	', ' . $_CB_database->NameQuote( 'rank' );
				} else {
					$supportsDbRanks							=	null;
				}
				
				$userDetails									=	$this->getUserSettings( $user, $forum, $supportsDbRanks );
				
				if ( ( isset( $userDetails->posts ) ) && $userDetails->posts != 0 ) {
					if ( class_exists( 'KunenaTemplate' ) && class_exists( 'KunenaForum' ) ) {
						$kunenaTemplate							=	KunenaTemplate::getInstance();
					} else {
						$kunenaTemplate							=	null;
					}

					if ( $forum->config['showranking'] ) {
						$uIsAdm									=	isModerator( $user->id );
						$uIsMod									=	$userDetails->moderator;
						$pathImage								=	$_CB_framework->getCfg( 'live_site' ) . '/components/' . $forum->component;

						if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
							if ( $supportsDbRanks ) {
								if ( $userDetails->rank != 0 ) {
									$where						=	$_CB_database->NameQuote( 'rank_id' ) . ' = ' . (int) $userDetails->rank;
								} else {
									$where						=	$_CB_database->NameQuote( 'rank_min' ) . ' <= ' . (int) $userDetails->posts
																.	"\n ORDER BY "	. $_CB_database->NameQuote( 'rank_min' ) . ' DESC';
								}

								$query							=	'SELECT '		. $_CB_database->NameQuote( 'rank_title' )
																.	', '			. $_CB_database->NameQuote( 'rank_image' )
																.	"\n FROM "		. $_CB_database->NameQuote( '#__' . $forum->prefix . '_ranks' )
																	.	"\n WHERE "		. $where;
								$_CB_database->setQuery( $query, 0, 1 );
								$userRank						=	null;
								$_CB_database->loadObject( $userRank );

								$pathImage						=	$pathImage . $this->params->get( 'TemplateRank', '/template/default/images' );
								$rText							=	$userRank->rank_title;
								$rImg							=	$pathImage . '/ranks/' . $userRank->rank_image;
							} else {
								$userDetails->rank				=	1;

								for ( $i = 1; $i <= 5; $i++ ) {
									$rankPrev					=	$forum->config['rank' . ( ( ( $i > 1 ) ? ( $i - 1 ) : $i ) )];
									$rank						=	$forum->config['rank' . $i];

									if ( $userDetails->posts <= $rank && ( $userDetails->posts > $rankPrev ) ) {
										$userDetails->rank		=	$i;
									} elseif ( ( $i == 5 ) && ( $userDetails->posts > $rank ) ) {
										$userDetails->rank		=	6;
									}
								}

								$rText							=	$forum->config['rank' . $userDetails->rank . 'txt'];
								$rImg							=	$pathImage . '/ranks/rank' . $userDetails->rank . '.gif';
							}
						} elseif ( $userDetails instanceof KunenaUser ) {
							$pathImage							=	$pathImage . $this->params->get( 'TemplateRank', '/template/default/images' );
							$userRank							=	$userDetails->getRank();
							$rText								=	$userRank->rank_title;

							if ( $kunenaTemplate ) {
								$rImg							=	$_CB_framework->getCfg( 'live_site' ) . '/' . $kunenaTemplate->getRankPath( $userRank->rank_image );
							} else {
								$rImg							=	null;
							}
						} else {
							$rText								=	null;
							$rImg								=	null;
						}

						if ( ( $userDetails->rank == 0 ) && $uIsMod ) {
							$rText								=	CBTxt::T( 'Moderator' );

							if ( $kunenaTemplate ) {
								$rImg							=	$_CB_framework->getCfg( 'live_site' ) . '/' . $kunenaTemplate->getRankPath( 'rankmod.gif' );
							} else {
								$rImg							=	$pathImage . '/ranks/rankmod.gif';
							}
						}
						
						if ( ( $userDetails->rank == 0 ) && $uIsAdm ) {
							$rText								=	CBTxt::T( 'Administrator' );

							if ( $kunenaTemplate ) {
								$rImg							=	$_CB_framework->getCfg( 'live_site' ) . '/' . $kunenaTemplate->getRankPath( 'rankadmin.gif' );
							} else {
								$rImg							=	$pathImage . '/ranks/rankadmin.gif';
							}
						}
						
						if ( $forum->config['rankimages'] && $rImg ) {
							$userDetails->msg_userrankimg		=	'<img src="' . htmlspecialchars( $rImg ) . '" alt="' . htmlspecialchars( $rText ) . '" border="0" />';
						}
						
						$userDetails->msg_userrank				=	$rText;
					}
				} else {
					$userDetails								=	false;
				}
			} else {
				$userDetails									=	false;
			}
			$usersdetailsCache[$user->id]						=	$userDetails;
		}
		
		return $usersdetailsCache[$user->id];
	}
	
	/**
	 * Generate users stats values for fields
	 *
	 * @param object $forum
	 * @param array  $params
	 * @return array
	 */
	function getUserStats( $forum ) {
		$stats												=	array();
		
		if ( isset ( $forum->config['showuserstats'] ) ? $forum->config['showuserstats'] : $forum->config['showstats'] ) {
			if ( $forum->config['showranking'] && ( $this->params->get( 'statRanking', 1 ) == 1 ) && ( $forum->userdetails !== false ) ) {
				$stats['forumrank']							=	$forum->userdetails->msg_userrank . ( $this->params->get('statRankingImg', 1 ) == 1 ? '<br />' . $forum->userdetails->msg_userrankimg : null );
			}
			if ( ( isset ( $forum->config['poststats'] ) ? $forum->config['poststats'] : ( isset ( $forum->config['postStats'] ) ? $forum->config['postStats'] : ( isset ( $forum->config['userlist_posts'] ) ? $forum->config['userlist_posts'] : $forum->config['showstats'] ) ) ) && ( ( $this->params->get( 'statPosts', 1 ) == 2 ) || ( ( $this->params->get( 'statPosts', 1 ) == 1 ) && ( $forum->userdetails !== false ) ) ) ) {
				$stats['forumposts']						=	( ( $forum->userdetails !== false ) ? $forum->userdetails->posts : 0 );
			}
		}
		
		if ( $forum->config['showkarma'] && ( $forum->userdetails !== false ) && ( ( $this->params->get( 'statKarma', 1 ) == 2 ) || ( ( $this->params->get( 'statKarma', 1 ) == 1 ) && ( $forum->userdetails->karma != 0 ) ) ) ) {
			$stats['forumkarma']							=	$forum->userdetails->karma;
		}
		
		return $stats;
	}
	
	/**
	 * Delete users specific subscription
	 *
	 * @param moscomprofilerUser $user
	 * @param int                $thread
	 * @param string             $prefix
	 */
	function _unsubThread( $user, $thread, $forum ) {
		global $_CB_database;

		if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
			$query	=	'DELETE FROM '	. $_CB_database->NameQuote( '#__' . $forum->prefix . '_subscriptions' )
					.	"\n WHERE "		. $_CB_database->NameQuote( 'userid' )	. " = " . (int) $user->id
					.	"\n AND "		. $_CB_database->NameQuote( 'thread' )	. " = " . (int) $thread;
			$_CB_database->setQuery( $query );
			if ( ! $_CB_database->query() ) {
				trigger_error( 'CBForum-unsubThread SQL error' . $_CB_database->stderr( true ), E_USER_WARNING );
			}
		} elseif ( class_exists( 'KunenaForumTopicHelper' ) ) {
			if ( $thread ) {
				KunenaForumTopicHelper::subscribe( array( (int) $thread ), 0, (int) $user->id );
			}
		}
	}
	
	/**
	 * Delete all users subscriptions
	 *
	 * @param moscomprofilerUser $user
	 * @param string             $prefix
	 */
	function _unsubAll( $user, $forum ) {
		global $_CB_database;

		if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
			$query		=	'DELETE FROM '	. $_CB_database->NameQuote( '#__' . $forum->prefix . '_subscriptions' )
						.	"\n WHERE "		. $_CB_database->NameQuote( 'userid' )	. " = " . (int) $user->id;
			$_CB_database->setQuery( $query );
			if ( ! $_CB_database->query() ) {
				trigger_error( 'CBForum-unsubAll SQL error' . $_CB_database->stderr( true ), E_USER_WARNING );
			}
		} elseif ( class_exists( 'KunenaForumTopicHelper' ) ) {
			$threads	=	array_keys( array_pop( KunenaForumTopicHelper::getLatestTopics( false, 0, 0, array( 'user' => (int) $user->id, 'subscribed' => true ) ) ) );

			if ( $threads ) {
				KunenaForumTopicHelper::subscribe( $threads, 0, (int) $user->id );
			}
		}
	}
	
	/**
	 * Delete users specific favorite
	 *
	 * @param moscomprofilerUser $user
	 * @param int                $thread
	 * @param string             $prefix
	 */
	function _unfavThread( $user, $thread, $forum ) {
		global $_CB_database;

		if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
			$query		=	'DELETE FROM '	. $_CB_database->NameQuote( '#__' . $forum->prefix . '_favorites' )
						.	"\n WHERE "		. $_CB_database->NameQuote( 'userid' )	. " = " . (int) $user->id
						.	"\n AND "		. $_CB_database->NameQuote( 'thread' )	. " = " . (int) $thread;
			$_CB_database->setQuery( $query );
			if ( ! $_CB_database->query() ) {
				trigger_error( 'CBForum-unfavThread SQL error' . $_CB_database->stderr( true ), E_USER_WARNING );
			}
		} elseif ( class_exists( 'KunenaForumTopicHelper' ) ) {
			if ( $thread ) {
				KunenaForumTopicHelper::favorite( array( (int) $thread ), 0, (int) $user->id );
			}
		}
	}
	
	/**
	 * Delete all users favorites
	 *
	 * @param moscomprofilerUser $user
	 * @param string             $prefix
	 */
	function _unfavAll( $user, $forum ) {
		global $_CB_database;

		if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
			$query		=	'DELETE FROM '	. $_CB_database->NameQuote( '#__' . $forum->prefix . '_favorites' )
						.	"\n WHERE "		. $_CB_database->NameQuote( 'userid' )	. " = " . (int) $user->id;
			$_CB_database->setQuery( $query );
			if ( ! $_CB_database->query() ) {
				trigger_error( 'CBForum-unfavAll SQL error' . $_CB_database->stderr( true ), E_USER_WARNING );
			}
		} elseif ( class_exists( 'KunenaForumTopicHelper' ) ) {
			$threads	=	array_keys( array_pop( KunenaForumTopicHelper::getLatestTopics( false, 0, 0, array( 'user' => (int) $user->id, 'favorited' => true ) ) ) );

			if ( $threads ) {
				KunenaForumTopicHelper::favorite( $threads, 0, (int) $user->id );
			}
		}
	}
	
	/**
	 * Returns value of field
	 *
	 * @param moscomprofilerUser $user
	 * @param mixed              $field
	 * @param string             $output
	 * @param string             $reason
	 * @return mixed
	 */
	function getFieldValue( $user, $field, $output = 'html', $reason = 'profile' ) {
		$cbUser												=	CBuser::getInstance( $user->id );
		$format												=	$cbUser->getField( $field, null, $output, 'none', $reason );
		
		return $format;
	}
	
	/**
	 * Generates icon display of field
	 *
	 * @param mixed  $value
	 * @param string $title
	 * @param string $icon
	 * @param string $type
	 * @param string $mode
	 * @return mixed
	 */
	function getFieldIcon( $value, $title, $icon, $type = null, $mode = 'kunena' ) {
		global $_CB_framework;
		
		if ( $mode == 'kunena' ) {
			$iconPath										=	$_CB_framework->getCfg( 'live_site' ) . '/components/com_kunena/template/default/images/english/icons/';
		} elseif ( $mode == 'cb' ) {
			$iconPath										=	$_CB_framework->getCfg( 'live_site' ) . '/components/com_comprofiler/images/';
		} elseif ( $mode == 'images' ) {
			$iconPath										=	$_CB_framework->getCfg( 'live_site' ) . '/images/M_images/';
		}
		
		$value												=	explode( '|*|', $value );
		if ( count( $value ) < 2) {
			$value[1]										=	$value[0];
		}
		
		$format												=	'<img border="0" style="padding:2px;" src="' . $iconPath . $icon . '" title="' . htmlspecialchars( $title . $value[1] ) . '" alt="' . htmlspecialchars( $title . $value[1] ) . '" />';
		
		if ( $type == 'website' ) {
			$format											=	'<a href="' . htmlspecialchars( $value[0] ) . '" target="_blank">' . $format . '</a>';
		} elseif ( $type == 'icq' ) {
			$format											=	'<a href="http://www.icq.com/people/cmd.php?uin=' . htmlspecialchars( $value[0] ) . '&action=message" target="_blank">' . $format . '</a>';
		}
		
		return ( $value[0] ? $format : null );
	}
	
	/**
	 * Generates icon for online status
	 *
	 * @param moscomprofilerUser $user
	 * @param string             $mode
	 * @return mixed
	 */
	function getStatusIcon( $user, $mode = 'kunena' ) {
		$value												=	$this->getFieldValue( $user, 'onlinestatus', 'csv' );
		
		if ( $value == 'true' ) {
			$icon											=	'online';
			$status											=	CBTxt::T( 'ONLINE' );
		} else {
			$icon											=	'offline';
			$status											=	CBTxt::T( 'OFFLINE' );
		}
		
		$format												=	$this->getFieldIcon( $status, CBTxt::T( 'Online Status: ' ), $icon . '.gif', null, $mode );
		
		return $format;
	}
	
	/**
	 * Generates icon for profile link
	 *
	 * @param moscomprofilerUser $user
	 * @param string             $mode
	 * @return mixed
	 */
	function getProfileIcon( $user, $mode = 'kunena' ) {
		$icon												=	$this->getFieldIcon( $user->username, CBTxt::T( 'View Profile: ' ), 'profile.gif', null, $mode );
		$url												=	cbSef( 'index.php?option=com_comprofiler&amp;task=userProfile&amp;user=' . (int) $user->id . getCBprofileItemid( true ) );
		$format												=	'<a href="' . $url . '">' . $icon . '</a>';
		
		return $format;
	}
	
	/**
	 * Generates icon for PM link
	 *
	 * @param moscomprofilerUser $user
	 * @param string             $mode
	 * @return mixed
	 */
	function getPMIcon( $user, $mode = 'kunena' ) {
		global $_CB_PMS, $_CB_framework;
		
		$url												=	null;
		
		if ( $user->id ) {
			$resultArray									=	$_CB_PMS->getPMSlinks( $user->id, $_CB_framework->myId(), null, null, 1 );
			
			if ( count( $resultArray ) > 0 ) {
				foreach ( $resultArray as $res ) {
					if ( is_array( $res ) ) {
						$url								=	cbSef( $res['url'] );
					}
				}
			}
			
			if ( $url ) {
				$icon										=	$this->getFieldIcon( $user->username, CBTxt::T( 'Send Private Message: ' ), 'pm.gif', null, $mode );
				$format										=	'<a href="' . $url . '">' . $icon . '</a>';
			}
		}
		
		return ( $url ? $format : null );
	}
	
	/**
	 * Get viewable categories
	 *
	 * @param moscomprofilerUser $user
	 * @param object             $forum
	 * @return array
	 */
	function getAllowedCategories( $user_id, $forum ) {
		global $_CB_framework, $_CB_database;

		if ( $user_id === null ) {
			$user_id			=	$_CB_framework->myId();
		}

		static $cache			=	array();

		if ( ! isset( $cache[$user_id] ) ) {
			if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
				$query			=	'SELECT ' . $_CB_database->NameQuote( 'allowed' )
								.	"\n FROM " . $_CB_database->NameQuote( '#__' . $forum->prefix . '_sessions' )
								.	"\n WHERE " . $_CB_database->NameQuote( 'userid' ) . ' = ' . (int) $user_id;
				$_CB_database->setQuery( $query, 0, 1 );
				$categories		=	$_CB_database->loadResult();

				if ( $categories && ( $categories != 'na' ) ) {
					$allowed	=	explode( ',', $categories );

					cbArrayToInts( $allowed );
				} else {
					$allowed	=	null;
				}
			} elseif ( class_exists( 'KunenaAccess' ) ) {
				$allowed		=	KunenaAccess::getInstance()->getAllowedCategories( (int) $user_id );
			} else {
				$allowed		=	null;
			}

			$cache[$user_id]	=	$allowed;
		}

		return $cache[$user_id];
	}
	
	/**
	 * Count users total posts for paging
	 *
	 * @param moscomprofilerUser $user
	 * @param object             $forum
	 * @return int
	 */
	function getUserPostTotal( $user, $forum ) {
		global $_CB_framework, $_CB_database;

		static $cache				=	array();

		if ( ! isset( $cache[$user->id] ) ) {
			$pagingParams			=	$this->_getPaging( array(), array( 'fposts_' ) );

			if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
				$categories			=	$this->getAllowedCategories( null, $forum );

				if ( strcasecmp( substr( $forum->version, 0, 3 ), '1.7' ) >= 0 ) {
					$cbUser			=&	CBuser::getInstance( (int) $user->id );

					if ( ! $cbUser ) {
						$cbUser		=&	CBuser::getInstance( null );
					}

					$access			=	"\n AND ( ( b." . $_CB_database->NameQuote( 'access' ) . " IN ( " . implode( ',', $cbUser->getAuthorisedViewLevelsIds( false ) ) . " )"
									.	' AND b.' . $_CB_database->NameQuote( 'accesstype' ) . ' = ' . $_CB_database->Quote( 'joomla.level' ) . ' )'
									.	"\n OR ( b." . $_CB_database->NameQuote( 'pub_access' ) . " IN ( " . implode( ',', $_CB_framework->acl->get_groups_below_me( (int) $user->id, true ) ) . " )"
									.	' AND b.' . $_CB_database->NameQuote( 'accesstype' ) . ' = ' . $_CB_database->Quote( 'none' ) . ' )';
				} else {
					$access			=	"\n AND ( b." . $_CB_database->NameQuote( 'pub_access' ) . " IN ( " . implode( ',', $_CB_framework->acl->get_groups_below_me( (int) $user->id, true ) ) . " )";
				}

				$access				.=	( $categories ? "\n OR b." . $_CB_database->NameQuote( 'id' ) . " IN ( " . implode( ',', $categories ) . " ) )" : ' )' );

				$query				=	'SELECT COUNT(*)'
									.	"\n FROM " . $_CB_database->NameQuote( '#__' . $forum->prefix . '_messages' ) . " AS a"
									.	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__' . $forum->prefix . '_categories' ) . " AS b"
									.	' ON a.' . $_CB_database->NameQuote( 'catid' ) . ' = b.' . $_CB_database->NameQuote( 'id' )
									.	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__' . $forum->prefix . '_messages' ) . " AS c"
									.	' ON a.' . $_CB_database->NameQuote( 'thread' ) . ' = c.' . $_CB_database->NameQuote( 'id' )
									.	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__' . $forum->prefix . '_messages_text' ) . " AS d"
									.	' ON a.' . $_CB_database->NameQuote( 'id' ) . ' = d.' . $_CB_database->NameQuote( 'mesid' )
									.	"\n WHERE a." . $_CB_database->NameQuote( 'hold' ) . " = 0"
									.	"\n AND b." . $_CB_database->NameQuote( 'published' ) . " = 1"
									.	"\n AND a." . $_CB_database->NameQuote( 'userid' ) . " = " . (int) $user->id
									.	$access
									.	( $pagingParams['fposts_search'] ? "\n AND ( a." . $_CB_database->NameQuote( 'subject' ) . " LIKE '%" . cbEscapeSQLsearch( cbGetEscaped( $pagingParams['fposts_search'] ) ) . "%' OR d." . $_CB_database->NameQuote( 'message' ) . " LIKE '%" . cbEscapeSQLsearch( $pagingParams['fposts_search'] ) . "%' )" : null );
				$_CB_database->setQuery( $query );
				$total				=	$_CB_database->loadResult();
			} elseif ( class_exists( 'KunenaForumMessageHelper' ) ) {
				$where				=	array();

				if ( isset( $pagingParams['fposts_search'] ) && ( $pagingParams['fposts_search'] != '' ) ) {
					$where[]		=	'( m.' . $_CB_database->NameQuote( 'subject' ) . ' LIKE ' . $_CB_database->Quote( '%' . $_CB_database->getEscaped( $pagingParams['fposts_search'], true ) . '%', false )
									.	' OR t.' . $_CB_database->NameQuote( 'message' ) . ' LIKE ' . $_CB_database->Quote( '%' . $_CB_database->getEscaped( $pagingParams['fposts_search'], true ) . '%', false ) . ' )';
				}

				$params				=	array(	'user' => (int) $user->id,
												'starttime' => -1,
												'where' => ( count( $where ) ? implode( ' AND ', $where ) : null )
											);

				$total				=	array_shift( KunenaForumMessageHelper::getLatestMessages( false, 0, 0, $params ) );
			} else {
				$total				=	null;
			}

			$cache[$user->id]		=	(int) $total;
		}

		return $cache[$user->id];
	}
	
	/**
	 * Puts users posts into array
	 *
	 * @param moscomprofilerUser $user
	 * @param object             $forum
	 * @return object
	 */
	function getUserPosts( $user, $forum ) {
		global $_CB_framework, $_CB_database;

		$categories				=	$this->getAllowedCategories( null, $forum );
		$pagingParams			=	$this->_getPaging( array(), array( 'fposts_' ) );
		$postsNumber			=	$this->params->get( 'postsNumber', 10 );

		if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
			switch ( $pagingParams['fposts_sortby'] ) {
				case 'subjectASC':
					$order		=	'a.' . $_CB_database->NameQuote( 'subject' ) . ' ASC';
					break;
				case 'subjectDESC':
					$order		=	'a.' . $_CB_database->NameQuote( 'subject' ) . ' DESC';
					break;
				case 'categoryASC':
					$order		=	'b.' . $_CB_database->NameQuote( 'id' ) . ' ASC';
					break;
				case 'categoryDESC':
					$order		=	'b.' . $_CB_database->NameQuote( 'id' ) . ' DESC';
					break;
				case 'hitsASC':
					$order		=	'c.' . $_CB_database->NameQuote( 'hits' ) . ' ASC';
					break;
				case 'hitsDESC':
					$order		=	'c.' . $_CB_database->NameQuote( 'hits' ) . ' DESC';
					break;
				case 'dateASC':
					$order		=	'a.' . $_CB_database->NameQuote( 'time' ) . ' ASC';
					break;
				case 'dateDESC':
				default:
					$order		=	'a.' . $_CB_database->NameQuote( 'time' ) . ' DESC';
					break;
			}

			if ( strcasecmp( substr( $forum->version, 0, 3 ), '1.7' ) >= 0 ) {
				$cbUser			=&	CBuser::getInstance( (int) $user->id );

				if ( ! $cbUser ) {
					$cbUser		=&	CBuser::getInstance( null );
				}

				$access			=	"\n AND ( ( b." . $_CB_database->NameQuote( 'access' ) . " IN ( " . implode( ',', $cbUser->getAuthorisedViewLevelsIds( false ) ) . " )"
								.	' AND b.' . $_CB_database->NameQuote( 'accesstype' ) . ' = ' . $_CB_database->Quote( 'joomla.level' ) . ' )'
								.	"\n OR ( b." . $_CB_database->NameQuote( 'pub_access' ) . " IN ( " . implode( ',', $_CB_framework->acl->get_groups_below_me( (int) $user->id, true ) ) . " )"
								.	' AND b.' . $_CB_database->NameQuote( 'accesstype' ) . ' = ' . $_CB_database->Quote( 'none' ) . ' )';
			} else {
				$access			=	"\n AND ( b." . $_CB_database->NameQuote( 'pub_access' ) . " IN ( " . implode( ',', $_CB_framework->acl->get_groups_below_me( (int) $user->id, true ) ) . " )";
			}

			$access				.=	( $categories ? "\n OR b." . $_CB_database->NameQuote( 'id' ) . " IN ( " . implode( ',', $categories ) . " ) )" : ' )' );

			$query				=	'SELECT a.*'
								.	', b.' . $_CB_database->NameQuote( 'id' ) . ' AS category'
								.	', b.' . $_CB_database->NameQuote( 'name' ) . ' AS catname'
								.	', c.' . $_CB_database->NameQuote( 'hits' ) . ' AS threadhits'
								.	"\n FROM " . $_CB_database->NameQuote( '#__' . $forum->prefix . '_messages' ) . " AS a"
								.	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__' . $forum->prefix . '_categories' ) . " AS b"
								.	' ON a.' . $_CB_database->NameQuote( 'catid' ) . ' = b.' . $_CB_database->NameQuote( 'id' )
								.	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__' . $forum->prefix . '_messages' ) . " AS c"
								.	' ON a.' . $_CB_database->NameQuote( 'thread' ) . ' = c.' . $_CB_database->NameQuote( 'id' )
								.	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__' . $forum->prefix . '_messages_text' ) . " AS d"
								.	' ON a.' . $_CB_database->NameQuote( 'id' ) . ' = d.' . $_CB_database->NameQuote( 'mesid' )
								.	"\n WHERE a." . $_CB_database->NameQuote( 'hold' ) . " = 0"
								.	"\n AND b." . $_CB_database->NameQuote( 'published' ) . " = 1"
								.	"\n AND a." . $_CB_database->NameQuote( 'userid' ) . " = " . (int) $user->id
								.	$access
								.	( $pagingParams['fposts_search'] ? "\n AND ( a." . $_CB_database->NameQuote( 'subject' ) . " LIKE '%" . cbEscapeSQLsearch( cbGetEscaped( $pagingParams['fposts_search'] ) ) . "%' OR d." . $_CB_database->NameQuote( 'message' ) . " LIKE '%" . cbEscapeSQLsearch( $pagingParams['fposts_search'] ) . "%' )" : null )
								.	"\n ORDER BY "	. $order;
			$_CB_database->setQuery( $query, (int) ( $pagingParams['fposts_limitstart'] ? $pagingParams['fposts_limitstart'] : 0 ), (int) $postsNumber );
			$posts				=	$_CB_database->loadObjectList();
		} elseif ( class_exists( 'KunenaForumMessageHelper' ) ) {
			$where				=	array();

			if ( isset( $pagingParams['fposts_search'] ) && ( $pagingParams['fposts_search'] != '' ) ) {
				$where[]		=	'( m.' . $_CB_database->NameQuote( 'subject' ) . ' LIKE ' . $_CB_database->Quote( '%' . $_CB_database->getEscaped( $pagingParams['fposts_search'], true ) . '%', false )
								.	' OR t.' . $_CB_database->NameQuote( 'message' ) . ' LIKE ' . $_CB_database->Quote( '%' . $_CB_database->getEscaped( $pagingParams['fposts_search'], true ) . '%', false ) . ' )';
			}

			switch ( $pagingParams['fposts_sortby'] ) {
				case 'subjectASC':
					$order		=	'm.' . $_CB_database->NameQuote( 'subject' ) . ' ASC';
					break;
				case 'subjectDESC':
					$order		=	'm.' . $_CB_database->NameQuote( 'subject' ) . ' DESC';
					break;
				case 'categoryASC':
					$order		=	'm.' . $_CB_database->NameQuote( 'catid' ) . ' ASC';
					break;
				case 'categoryDESC':
					$order		=	'm.' . $_CB_database->NameQuote( 'catid' ) . ' DESC';
					break;
				case 'hitsASC':
					$order		=	'm.' . $_CB_database->NameQuote( 'hits' ) . ' ASC';
					break;
				case 'hitsDESC':
					$order		=	'm.' . $_CB_database->NameQuote( 'hits' ) . ' DESC';
					break;
				case 'dateASC':
					$order		=	'm.' . $_CB_database->NameQuote( 'time' ) . ' ASC';
					break;
				case 'dateDESC':
				default:
					$order		=	'm.' . $_CB_database->NameQuote( 'time' ) . ' DESC';
					break;
			}

			$params				=	array(	'user' => (int) $user->id,
											'starttime' => -1,
											'where' => ( count( $where ) ? implode( ' AND ', $where ) : null ),
											'orderby' => $order
										);

			$posts				=	array_pop( KunenaForumMessageHelper::getLatestMessages( false, (int) ( $pagingParams['fposts_limitstart'] ? $pagingParams['fposts_limitstart'] : 0 ), (int) $postsNumber, $params ) );

			if ( $posts ) foreach ( $posts as $k => $post ) {
				$posts[$k]->set( 'category', $post->getCategory()->id );
				$posts[$k]->set( 'catname', $post->getCategory()->name );
				$posts[$k]->set( 'threadhits', $post->getTopic()->hits );
			}
		} else {
			$posts				=	null;
		}

		return $posts;
	}
	
	/**
	 * Count users total subscriptions for paging
	 *
	 * @param moscomprofilerUser $user
	 * @param object             $forum
	 * @return int
	 */
	function getUserSubscriptionsTotal( $user, $forum ) {
		global $_CB_database;

		static $cache			=	array();

		if ( ! isset( $cache[$user->id] ) ) {
			if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
				$query			=	'SELECT COUNT(*)'
								.	"\n FROM " 	. $_CB_database->NameQuote( '#__' . $forum->prefix . '_subscriptions' )
								.	"\n WHERE "	. $_CB_database->NameQuote( 'userid' )	. ' = ' . (int) $user->id;
				$_CB_database->setQuery( $query );
				$total			=	$_CB_database->loadResult();
			} elseif ( class_exists( 'KunenaForumTopicHelper' ) ) {
				$params			=	array(	'user' => (int) $user->id,
											'subscribed' => true,
											'starttime' => -1
										);

				$total			=	array_shift( KunenaForumTopicHelper::getLatestTopics( false, 0, 0, $params ) );
			} else {
				$total			=	0;
			}

			$cache[$user->id]	=	( $total && is_numeric( $total ) ? $total : null );
		}

		return $cache[$user->id];
	}
	
	/**
	 * Puts users subscription posts into object
	 *
	 * @param moscomprofilerUser $user
	 * @param object             $forum
	 * @return object
	 */
	function getUserSubscriptions( $user, $forum ) {
		global $_CB_database;

		$pagingParams			=	$this->_getPaging( array(), array( 'fsubs_' ) );
		$postsNumber			=	$this->params->get( 'postsNumber', 10 );

		if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
			switch ( $pagingParams['fsubs_sortby'] ) {
				case 'subjectASC':
					$order		=	'a.' . $_CB_database->NameQuote( 'subject' ) . ' ASC';
					break;
				case 'subjectDESC':
					$order		=	'a.' . $_CB_database->NameQuote( 'subject' ) . ' DESC';
					break;
				case 'categoryASC':
					$order		=	'b.' . $_CB_database->NameQuote( 'id' ) . ' ASC';
					break;
				case 'categoryDESC':
					$order		=	'b.' . $_CB_database->NameQuote( 'id' ) . ' DESC';
					break;
				case 'dateASC':
					$order		=	'a.' . $_CB_database->NameQuote( 'time' ) . ' ASC';
					break;
				case 'dateDESC':
				default:
					$order		=	'a.' . $_CB_database->NameQuote( 'time' ) . ' DESC';
					break;
			}

			$query				=	'SELECT a.*'
								.	', b.'			. $_CB_database->NameQuote( 'name' ) . ' AS catname'
								.	"\n FROM " 		. $_CB_database->NameQuote( '#__' . $forum->prefix . '_messages' ) . ' AS a'
								.	', ' 			. $_CB_database->NameQuote( '#__' . $forum->prefix . '_categories' ) . ' AS b'
								.	', ' 			. $_CB_database->NameQuote( '#__' . $forum->prefix . '_subscriptions' ) . ' AS s'
								.	"\n WHERE a."	. $_CB_database->NameQuote( 'id' )	. ' = s.' . $_CB_database->NameQuote( 'thread' )
								.	"\n AND a."		. $_CB_database->NameQuote( 'catid' )	. ' = b.' . $_CB_database->NameQuote( 'id' )
								.	"\n AND s."		. $_CB_database->NameQuote( 'userid' )	. ' = ' . (int) $user->id
								.	"\n ORDER BY " . $order;
			$_CB_database->setQuery( $query, (int) ( $pagingParams['fsubs_limitstart'] ? $pagingParams['fsubs_limitstart'] : 0 ), (int) $postsNumber );
			$subs				=	$_CB_database->loadObjectList();
		} elseif ( class_exists( 'KunenaForumTopicHelper' ) ) {
			switch ( $pagingParams['fsubs_sortby'] ) {
				case 'subjectASC':
					$order		=	'tt.' . $_CB_database->NameQuote( 'subject' ) . ' ASC';
					break;
				case 'subjectDESC':
					$order		=	'tt.' . $_CB_database->NameQuote( 'subject' ) . ' DESC';
					break;
				case 'categoryASC':
					$order		=	'tt.' . $_CB_database->NameQuote( 'category_id' ) . ' ASC';
					break;
				case 'categoryDESC':
					$order		=	'tt.' . $_CB_database->NameQuote( 'category_id' ) . ' DESC';
					break;
				case 'dateASC':
					$order		=	'tt.' . $_CB_database->NameQuote( 'first_post_time' ) . ' ASC';
					break;
				case 'dateDESC':
				default:
					$order		=	'tt.' . $_CB_database->NameQuote( 'first_post_time' ) . ' DESC';
					break;
			}

			$params				=	array(	'user' => (int) $user->id,
											'subscribed' => true,
											'starttime' => -1,
											'orderby' => $order
										);

			$subs				=	array_pop( KunenaForumTopicHelper::getLatestTopics( false, (int) ( $pagingParams['fsubs_limitstart'] ? $pagingParams['fsubs_limitstart'] : 0 ), (int) $postsNumber, $params ) );

			if ( $subs ) foreach ( $subs as $k => $sub ) {
				$subs[$k]->set( 'time', $sub->first_post_time );
				$subs[$k]->set( 'catid', $sub->getCategory()->id );
				$subs[$k]->set( 'catname', $sub->getCategory()->name );
				$subs[$k]->set( 'thread', $sub->id );
			}
		} else {
			$subs				=	null;
		}

		return ( $subs ? $subs : null );
	}

	/**
	 * Count users total favorites for paging
	 *
	 * @param moscomprofilerUser $user
	 * @param object             $forum
	 * @return int
	 */
	function getUserFavoritesTotal( $user, $forum ) {
		global $_CB_database;

		static $cache			=	array();

		if ( ! isset( $cache[$user->id] ) ) {
			if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
				$query			=	'SELECT COUNT(*)'
								.	"\n FROM " 	. $_CB_database->NameQuote( '#__' . $forum->prefix . '_favorites' )
								.	"\n WHERE "	. $_CB_database->NameQuote( 'userid' )	. ' = ' . (int) $user->id;
				$_CB_database->setQuery( $query );
				$total			=	$_CB_database->loadResult();
			} elseif ( class_exists( 'KunenaForumTopicHelper' ) ) {
				$params			=	array(	'user' => (int) $user->id,
											'favorited' => true,
											'starttime' => -1
										);

				$total			=	array_shift( KunenaForumTopicHelper::getLatestTopics( false, 0, 0, $params ) );
			} else {
				$total			=	null;
			}

			$cache[$user->id]	=	( $total && is_numeric( $total ) ? $total : null );
		}

		return $cache[$user->id];
	}
	
	/**
	 * Puts users subscription posts into object
	 *
	 * @param moscomprofilerUser $user
	 * @param object             $forum
	 * @return object
	 */
	function getUserFavorites( $user, $forum ) {
		global $_CB_database;

		$pagingParams			=	$this->_getPaging( array(), array( 'ffavs_' ) );
		$postsNumber			=	$this->params->get( 'postsNumber', 10 );

		if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
			switch ( $pagingParams['ffavs_sortby'] ) {
				case 'subjectASC':
					$order		=	'a.' . $_CB_database->NameQuote( 'subject' ) . ' ASC';
					break;
				case 'subjectDESC':
					$order		=	'a.' . $_CB_database->NameQuote( 'subject' ) . ' DESC';
					break;
				case 'categoryASC':
					$order		=	'b.' . $_CB_database->NameQuote( 'id' ) . ' ASC';
					break;
				case 'categoryDESC':
					$order		=	'b.' . $_CB_database->NameQuote( 'id' ) . ' DESC';
					break;
				case 'dateASC':
					$order		=	'a.' . $_CB_database->NameQuote( 'time' ) . ' ASC';
					break;
				case 'dateDESC':
				default:
					$order		=	'a.' . $_CB_database->NameQuote( 'time' ) . ' DESC';
				break;
			}

			$query				=	'SELECT a.*'
								.	', b.'			. $_CB_database->NameQuote( 'name' ) . ' AS catname'
								.	"\n FROM " 		. $_CB_database->NameQuote( '#__' . $forum->prefix . '_messages' ) . ' AS a'
								.	', ' 			. $_CB_database->NameQuote( '#__' . $forum->prefix . '_categories' ) . ' AS b'
								.	', ' 			. $_CB_database->NameQuote( '#__' . $forum->prefix . '_favorites' ) . ' AS s'
								.	"\n WHERE a."	. $_CB_database->NameQuote( 'id' )	. ' = s.' . $_CB_database->NameQuote( 'thread' )
								.	"\n AND a."		. $_CB_database->NameQuote( 'catid' )	. ' = b.' . $_CB_database->NameQuote( 'id' )
								.	"\n AND s."		. $_CB_database->NameQuote( 'userid' )	. ' = ' . (int) $user->id
								.	"\n ORDER BY " . $order;
			$_CB_database->setQuery( $query, (int) ( $pagingParams['ffavs_limitstart'] ? $pagingParams['ffavs_limitstart'] : 0 ), (int) $postsNumber );
			$favs				=	$_CB_database->loadObjectList();
		} elseif ( class_exists( 'KunenaForumTopicHelper' ) ) {
			switch ( $pagingParams['ffavs_sortby'] ) {
				case 'subjectASC':
					$order		=	'tt.' . $_CB_database->NameQuote( 'subject' ) . ' ASC';
					break;
				case 'subjectDESC':
					$order		=	'tt.' . $_CB_database->NameQuote( 'subject' ) . ' DESC';
					break;
				case 'categoryASC':
					$order		=	'tt.' . $_CB_database->NameQuote( 'category_id' ) . ' ASC';
					break;
				case 'categoryDESC':
					$order		=	'tt.' . $_CB_database->NameQuote( 'category_id' ) . ' DESC';
					break;
				case 'dateASC':
					$order		=	'tt.' . $_CB_database->NameQuote( 'first_post_time' ) . ' ASC';
					break;
				case 'dateDESC':
				default:
					$order		=	'tt.' . $_CB_database->NameQuote( 'first_post_time' ) . ' DESC';
					break;
			}

			$params				=	array(	'user' => (int) $user->id,
											'favorited' => true,
											'starttime' => -1,
											'orderby' => $order
										);

			$favs				=	array_pop( KunenaForumTopicHelper::getLatestTopics( false, (int) ( $pagingParams['ffavs_limitstart'] ? $pagingParams['ffavs_limitstart'] : 0 ), (int) $postsNumber, $params ) );

			if ( $favs ) foreach ( $favs as $k => $fav ) {
				$favs[$k]->set( 'time', $fav->first_post_time );
				$favs[$k]->set( 'catid', $fav->getCategory()->id );
				$favs[$k]->set( 'catname', $fav->getCategory()->name );
				$favs[$k]->set( 'thread', $fav->id );
			}
		} else {
			$favs				=	null;
		}

		return ( $favs ? $favs : null );
	}
	
	/**
	 * Builds and returns table titles with sorting
	 *
	 * @param array  $pagingParams
	 * @param string $sort
	 * @return object
	 */
	function getTableTitles( $pagingParams, $sort ) {
		global $_CB_framework;
		
		$sortImg										=	$_CB_framework->getCfg( 'live_site' ) . '/components/com_comprofiler/plugin/user/plug_cbsimpleboardtab/images/';
		$ascImg											=	'<img border="0" alt="ASC" src="' . $sortImg . 'asc.gif" />';
		$descImg										=	'<img border="0" alt="DESC" src="' . $sortImg . 'desc.gif" />';

		$title											=	new stdClass();
		$title->date									=	CBTxt::T( 'Date' ) . str_replace( '>' . CBTxt::T( 'Date' ) . '<', '>' . $descImg . '<', $this->_writeSortByLink( $pagingParams, $sort, 'dateDESC', CBTxt::T( 'Date' ), true ) ) . str_replace( '>' . CBTxt::T( 'Date' ) . '<', '>' . $ascImg . '<', $this->_writeSortByLink( $pagingParams, $sort, 'dateASC', CBTxt::T( 'Date' ) ) );
		$title->subject									=	CBTxt::T( 'Subject' ) . str_replace( '>' . CBTxt::T( 'Subject' ) . '<', '>' . $descImg . '<', $this->_writeSortByLink( $pagingParams, $sort, 'subjectDESC', CBTxt::T( 'Subject' ) ) ) . str_replace( '>' . CBTxt::T( 'Subject' ) . '<', '>' . $ascImg . '<', $this->_writeSortByLink( $pagingParams, $sort, 'subjectASC', CBTxt::T( 'Subject' ) ) );
		$title->category								=	CBTxt::T( 'Category' ) . str_replace( '>' . CBTxt::T( 'Category' ) . '<', '>' . $descImg . '<', $this->_writeSortByLink( $pagingParams, $sort, 'categoryDESC', CBTxt::T( 'Category' ) ) ) . str_replace( '>' . CBTxt::T( 'Category' ) . '<', '>' . $ascImg . '<', $this->_writeSortByLink( $pagingParams, $sort, 'categoryASC', CBTxt::T( 'Category' ) ) );
		$title->hits									=	CBTxt::T( 'Hits' ) . str_replace( '>' . CBTxt::T( 'Hits' ) . '<', '>' . $descImg . '<', $this->_writeSortByLink( $pagingParams, $sort, 'hitsDESC', CBTxt::T( 'Hits' ) ) ) . str_replace( '>' . CBTxt::T( 'Hits' ) . '<', '>' . $ascImg . '<', $this->_writeSortByLink( $pagingParams, $sort, 'hitsASC', CBTxt::T( 'Hits' ) ) );
	
		return $title;
	}
	
	/**
	 * Puts user forum settings into object
	 *
	 * @param moscomprofilerUser $user
	 * @param object             $forum
	 * @param mixed              $additional
	 * @return object
	 */
	function getUserSettings( $user, $forum, $additional = null ) {
		global $_CB_database;

		static $cache			=	array();

		if ( ! isset( $cache[$user->id] ) ) {
			if ( ( $forum->prefix != 'kunena' ) || ( ( $forum->prefix == 'kunena' ) && ( ! class_exists( 'KunenaForum' ) ) ) ) {
				$query			=	'SELECT f.*'
								.	$additional
								.	"\n FROM "		. $_CB_database->NameQuote( '#__' . $forum->prefix . '_users' ) . 'AS f'
								.	', '			. $_CB_database->NameQuote( '#__users' ) . 'AS u'
								.	"\n WHERE f."	. $_CB_database->NameQuote( 'userid' )	. " = u." . $_CB_database->NameQuote( 'id' )
								.	"\n AND f."		. $_CB_database->NameQuote( 'userid' )	. " = " . (int) $user->id;
				$_CB_database->setQuery( $query, 0, 1 );
				$settings		=	null;
				$_CB_database->loadObject( $settings );
			} elseif ( class_exists( 'KunenaUser' ) ) {
				$settings		=	KunenaUser::getInstance( (int) $user->id );
			} else {
				$settings		=	null;
			}

			$cache[$user->id]	=	( $settings ? $settings : null );
		}

		return $cache[$user->id];
	}
	
	/**
	 * Generates forum parameters based on forum type
	 *
	 * @param array $params
	 * @return object
	 */
	function getForumParams() {
		global $_CB_framework, $_CB_database;
		
		$forumType											=	(int) $this->params->get( 'forumType', 0 );
		$path												=	$_CB_framework->getCfg( 'absolute_path' );

		$forumParams										=	new stdClass();
		if ( in_array( $forumType, array( 0, 2 ) ) && file_exists( $path . '/administrator/components/com_joomlaboard/joomlaboard_config.php' ) ) {
			$forumParams->component							=	'com_joomlaboard';
			$forumParams->prefix							=	'sb';
			$forumParams->config							=	$path . '/administrator/components/com_joomlaboard/joomlaboard_config.php';
		} else if ( in_array( $forumType, array( 0, 3 ) ) && file_exists( $path . '/administrator/components/com_simpleboard/simpleboard_config.php' ) ) {
			$forumParams->component							=	'com_simpleboard';
			$forumParams->prefix							=	'sb';
			$forumParams->config							=	$path . '/administrator/components/com_simpleboard/simpleboard_config.php';
		} elseif ( in_array( $forumType, array( 0, 1 ) ) && file_exists( $path . '/administrator/components/com_fireboard/' ) ) {
			$forumParams->component							=	'com_fireboard';
			$forumParams->prefix							=	'fb';
			if ( file_exists( $path . '/administrator/components/com_fireboard/fireboard_config.php' ) ) {
				$forumParams->config						=	$path . '/administrator/components/com_fireboard/fireboard_config.php';
			} else {
				$forumParams->config						=	null;
			}
		} elseif ( in_array( $forumType, array( 0, 4 ) ) && file_exists( $path . '/administrator/components/com_kunena/' ) ) {
			$forumParams->component							=	'com_kunena';
			if ( file_exists( $path . '/administrator/components/com_kunena/api.php' ) ) {
				// Kunena 1.6-2.0:
				$forumParams->prefix						=	'kunena';
			} else {
				// Kunena 1.0-1.5:
				$forumParams->prefix						=	'fb';
			}
			if ( ! class_exists( 'KunenaForum' ) ) {
				if ( file_exists( $path . '/components/com_kunena/lib/kunena.config.class.php' ) ) {
					$forumParams->config					=	$path . '/components/com_kunena/lib/kunena.config.class.php';
				} else {
					$forumParams->config					=	null;
				}
			} else {
				$forumParams->config						=	'api';			}
		} else {
			return null;
		}
		
		
		if ( $forumParams->component ) {
			$query											=	'SELECT '	. $_CB_database->NameQuote( 'id' )
															.	"\n FROM "	. $_CB_database->NameQuote( '#__menu' )
															.	"\n WHERE "	. $_CB_database->NameQuote( 'link' )	. " LIKE " . $_CB_database->Quote( '%' . $forumParams->component . '%' )
															;
			$_CB_database->setQuery( $query );
			$forumParams->itemid							=	'&amp;Itemid=' . $_CB_database->loadResult();
		}
		
		return $forumParams;
	}
	
	/**
	 * Function for the backend XML
	 *
	 * @param  string  $name          Name of the control
	 * @param  string  $value         Current value
	 * @param  string  $control_name  Name of the controlling array (if any)
	 * @return string                 HTML for the control data part or FALSE in case of error
	 */
	function loadExistingForums( $name, $value, $control_name ) {
		global $_CB_framework;
		
		$img_path											=	$_CB_framework->getCfg( 'live_site' ) . '/components/com_comprofiler/images/';
		$installed											=	'<img src="' . $img_path . 'approve.png" alt="Installed" title="Installed" border="0" />';
		$uninstalled										=	'<img src="' . $img_path . 'reject.png" alt="Uninstalled" title="Uninstalled" border="0" />';
		$path												=	$_CB_framework->getCfg( 'absolute_path' );
		$forums												=	null;

		if ( file_exists( $path . '/administrator/components/com_joomlaboard/' ) ) {
			$forums											.=	'<div>' . $installed . ' ' . CBTxt::T( 'Joomlaboard' ) . '</div>';
		} else {
			$forums											.=	'<div>' . $uninstalled . ' ' . CBTxt::T( 'Joomlaboard' ) . '</div>';
		}
		
		if ( file_exists( $path . '/administrator/components/com_simpleboard/' ) ) {
			$forums											.=	'<div>' . $installed . ' ' . CBTxt::T( 'Simpleboard' ) . '</div>';
		} else {
			$forums											.=	'<div>' . $uninstalled . ' ' . CBTxt::T( 'Simpleboard' ) . '</div>';
		}
		
		if ( file_exists( $path . '/administrator/components/com_fireboard/' ) ) {
			$forums											.=	'<div>' . $installed . ' ' . CBTxt::T( 'Fireboard' ) . '</div>';
		} else {
			$forums											.=	'<div>' . $uninstalled . ' ' . CBTxt::T( 'Fireboard' ) . '</div>';
		}
		
		if ( file_exists( $path . '/administrator/components/com_kunena/' ) ) {
			$forums											.=	'<div>' . $installed . ' ' . CBTxt::T( 'Kunena (It is advised to select Kunena manually as Kunena has additional options)' ) . '</div>';
		} else {
			$forums											.=	'<div>' . $uninstalled . ' ' . CBTxt::T( 'Kunena' ) . '</div>';		}
		
		return $forums;
	}
} //end of getForumModel
