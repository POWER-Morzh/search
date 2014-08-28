<?php
/**
* @version $Id: cb.acl.php 1910 2012-11-05 15:13:37Z beat $
* @package Community Builder
* @subpackage cb.acl.php
* @author Beat and mambojoe
* @copyright (C) Beat, www.joomlapolis.com
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
*/

// no direct access
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

class CBACL {
	/**
	 * @var JAccess
	 */
	var $_acl;

	function CBACL( &$acl ) {
		$this->_acl			=&	$acl;
	}

	function get_group_id( $var_1 = null, $var_2 = null, $var_3 = null ) {
		global $_CB_database;

		if ( checkJversion() == 2 ) {
			$gname		=	( $var_1 ? $var_1 : $var_2 );

			$query		=	'SELECT ' . $_CB_database->NameQuote( 'id' )
						.	"\n FROM " . $_CB_database->NameQuote( '#__usergroups' )
						.	"\n WHERE " . $_CB_database->NameQuote( 'title' ) . " = " . $_CB_database->Quote( $gname );
			$_CB_database->setQuery( $query );
			$return		=	$_CB_database->loadResult();
		} else {
			if ( ! $var_2 ) {
				$var_2	=	'ARO';
			}

			$return		=	$this->_acl->get_group_id( $var_1, $var_2, $var_3 );
		}

		return $return;
	}

	function get_group_name( $var_1 = null, $var_2 = null ) {
		global $_CB_database;

		if ( checkJversion() == 2 ) {
			$query		=	'SELECT ' . $_CB_database->NameQuote( 'title' )
						.	"\n FROM " . $_CB_database->NameQuote( '#__usergroups' )
						.	"\n WHERE " . $_CB_database->NameQuote( 'id' ) . " = " . (int) $var_1;
			$_CB_database->setQuery( $query );
			$return		=	$_CB_database->loadResult();
		} else {
			if ( ! $var_2 ) {
				$var_2	=	'ARO';
			}

			$return		=	$this->_acl->get_group_name( $var_1, $var_2 );
		}

		return $return;
	}

	function acl_check( $var_1 = null, $var_2 = null, $var_3 = null, $var_4 = null, $var_5 = null, $var_6 = null, $var_7 = null, $var_8 = null ) {
		if ( checkJversion() == 2 ) {
			$return	=	JFactory::getUser()->authorise( $var_2, $var_1 );
		} else {
			$return	=	$this->_acl->acl_check( $var_1, $var_2, $var_3, $var_4, $var_5, $var_6, $var_7, $var_8 );
		}
		return $return;
	}

	function get_object_id( $var_1 = null, $var_2 = null, $var_3 = null ) {
		if ( checkJversion() == 2 ) {
			$return		=	$var_2;
		} else {
			$return		=	$this->_acl->get_object_id( $var_1, $var_2, $var_3 );
		}

		return $return;
	}

	function get_object_groups( $var_1 = null, $var_2 = null, $var_3 = null ) {
		if ( checkJversion() == 2 ) {
			$user_id	=	( is_integer( $var_1 ) ? $var_1 : $var_2 );
			$recurse	=	( $var_3 == 'RECURSE' ? true : false );
			$return		=	$this->_acl->getGroupsByUser( $user_id, $recurse );
		} elseif ( checkJversion() == 1 ) {
			if ( ! $var_2 ) {
				$var_2	=	'ARO';
			}

			if ( ! $var_3 ) {
				$var_3	=	'NO_RECURSE';
			}

			$return		=	$this->_acl->get_object_groups( $var_1, $var_2, $var_3 );
		} else {
			$return		=	$this->_acl->get_object_groups( $var_1, $var_2, $var_3 );
		}

		return $return;
	}

	function get_group_children( $var_1 = null, $var_2 = null, $var_3 = null ) {
		global $_CB_database;

		if ( ! $var_3 ) {
			$var_3		=	'NO_RECURSE';
		}

		if ( checkJversion() == 2 ) {
			$query		=	'SELECT g1.' . $_CB_database->NameQuote( 'id' )
						.	"\n FROM " . $_CB_database->NameQuote( '#__usergroups' ) . " AS g1";

			if ( $var_3 == 'RECURSE' ) {
				$query	.=	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__usergroups' ) . " AS g2"
						.	' ON g2.' . $_CB_database->NameQuote( 'lft' ) . ' < g1.' . $_CB_database->NameQuote( 'lft' )
						.	' AND g2.' . $_CB_database->NameQuote( 'rgt' ) . ' > g1.' . $_CB_database->NameQuote( 'rgt' )
						.	"\n WHERE g2." . $_CB_database->NameQuote( 'id' ) . " = " . (int) $var_1;
			} else {
				$query	.=	"\n WHERE g1." . $_CB_database->NameQuote( 'parent_id' ) . " = " . (int) $var_1;

			}

			$query		.=	"\n ORDER BY g1." . $_CB_database->NameQuote( 'title' );
			$_CB_database->setQuery( $query );
			$return		=	$_CB_database->loadResultArray();
		} else {
			if ( ! $var_2 ) {
				$var_2	=	'ARO';
			}

			$return		=	$this->_acl->get_group_children( $var_1, $var_2, $var_3 );
		}

		return $return;
	}

	function get_group_children_tree( $var_1 = null, $var_2 = null, $var_3 = null, $var_4 = null ) {
		global $_CB_database;

		if ( ! $var_4 ) {
			$var_4						=	true;
		}

		if ( checkJversion() == 2 ) {
			$query						=	'SELECT a.' . $_CB_database->NameQuote( 'id' ) . ' AS value'
										.	', a.' . $_CB_database->NameQuote( 'title' ) . ' AS text'
										.	', COUNT( DISTINCT b.' . $_CB_database->NameQuote( 'id' ) . ' ) AS level'
										.	"\n FROM " . $_CB_database->NameQuote( '#__usergroups' ) . " AS a"
										.	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__usergroups' ) . " AS b"
										.	' ON a.' . $_CB_database->NameQuote( 'lft' ) . ' > b.' . $_CB_database->NameQuote( 'lft' )
										.	' AND a.' . $_CB_database->NameQuote( 'rgt' ) . ' < b.' . $_CB_database->NameQuote( 'rgt' )
										.	"\n GROUP BY a." . $_CB_database->NameQuote( 'id' )
										.	"\n ORDER BY a." . $_CB_database->NameQuote( 'lft' ) . " ASC";
			$_CB_database->setQuery( $query );
			$groups						=	$_CB_database->loadObjectList();

			$user_groups				=	array();

			for ( $i = 0, $n = count( $groups ); $i < $n; $i++ ) {
				$groups[$i]->text		=	str_repeat( '- ', $groups[$i]->level ) . JText::_( $groups[$i]->text );

				if ( $var_4 ) {
					$user_groups[$i]	=	JHtml::_( 'select.option', $groups[$i]->value, $groups[$i]->text );
				} else {
					$user_groups[$i]	=	array( 'value' => $groups[$i]->value, 'text' => $groups[$i]->text );
				}
			}

			$return						=	$user_groups;
		} else {
			if ( ! $var_3 ) {
				$var_3					=	true;
			}

			$return						=	$this->_acl->get_group_children_tree( $var_1, $var_2, $var_3, $var_4 );
		}

		return $return;
	}

	function is_group_child_of( $var_1 = null, $var_2 = null, $var_3 = null ) {
		if ( checkJversion() == 2 ) {
			if ( ! is_integer( $var_1 ) ) {
				$group_src		=	$this->get_group_id( $var_1 );
			}

			$group_children		=	$this->get_group_children( $group_src, null, 'RECURSE' );

			if ( ! is_integer( $var_2 ) ) {
				$group_target	=	$this->get_group_id( $var_2 );
			}

			$return				=	( in_array( $group_target, $group_children ) ? 1 : 0 );
		} else {
			if ( ! $var_3 ) {
				$var_3			=	'ARO';
			}

			$return				=	$this->_acl->is_group_child_of( $var_1, $var_2, $var_3 );
		}

		return $return;
	}
	/**
	 * Gets access levels of CMS for $user_id
	 * 
	 * @param  int      $user_id
	 * @param  boolean  $recurse		(DEPRECATED 1.8)
	 * @param  boolean  $cb1xNumbering  (SINCE 1.8)      DEFAULT: FALSE: (if $cb1xNumbering with CB 1.x's definition for standard levels 0,1,2)
	 * @return array of int
	 */
	function get_object_access( $user_id, $recurse = false, $cb1xNumbering = true ) {
		global $_CB_database;

		if ( checkJversion() == 2 ) {
			$levels 		=	$this->_acl->getAuthorisedViewLevels( (int) $user_id );

			// Keep backwards levels compatible: J1.6's 1 is CB 1.7-'s 0, 2 is 1, 3 is 2:
			if ( $cb1xNumbering ) {
				foreach ( $levels as $k => $v ) {
					if ( $v <= 3 ) {
						--$levels[$k];
					}
				}
			}

		} else {

			if ( checkJversion() == 1 ) {
				$user		=&	JFactory::getUser( $user_id ? (int) $user_id : null );
				$level		=	$user->get( 'aid', 0 );
			} else {
				$user		=	new mosUser( $_CB_database );

				$user->load( (int) $user_id );

				$level		=	$user->gid;
			}

			$query			=	'SELECT ' . $_CB_database->NameQuote( 'id' )
							.	"\n FROM " . $_CB_database->NameQuote( '#__groups' )
							.	"\n WHERE " . $_CB_database->NameQuote( 'id' ) . " <= " . (int) $level
							.	"\n ORDER BY " . $_CB_database->NameQuote( 'id' );
			$_CB_database->setQuery( $query );
			$levels			=	$_CB_database->loadResultArray();

			if ( ! $cb1xNumbering ) {
				for ( $i = 0, $n = count( $levels ); $i < $n; $i++ ) {
					if ( in_array( $levels[$i], array( 0, 1, 2 ) ) ) {
						++$levels[$i];		// J1.5's 0 is CB's 1, 1 is 2, 2 is 3.
					}
				}
			}

			// This makes sense only on J<1.6, thus it's only here:
			if ( ! $recurse ) {
				$levels		=	array_slice( $levels, -1 );
			}
		}

		return  array_unique( cbArrayToInts( $levels ) );
	}
	/**
	 * Gives list of view access levels available with translated texts for the levels
	 * 
	 * @param  boolean|string  $html                 false/0: array( 'value' =>, 'text' =>), true/1: ready for moscomprofilerHTML::selectList, 2: array( value => text )
	 * @param  boolean         $cb1xNumbering        DEFAULT: FALSE: (if $cb1xNumbering with CB 1.x's definition for standard levels 0,1,2)
	 * @param  boolean         $filterByVisibleToMe  Restrict result by only View Access Levels visible to me
	 */
	function get_access_children_tree( $html = true, $cb1xNumbering = true, $filterByVisibleToMe = false ) {
		global $_CB_database;

		if ( $filterByVisibleToMe && $this->amIaSuperAdmin() ) {
			$filterByVisibleToMe			=	false;
		}
		if ( $filterByVisibleToMe ) {
			$viewAccessLevels				=	CBuser::getMyInstance()->getAuthorisedViewLevelsIds( $cb1xNumbering );
		}

		$access_levels						=	array();

		if ( checkJversion() == 2 ) {

			$levels							=	JHtml::_( 'access.assetgroups' );

			for ( $i = 0, $n = count( $levels ); $i < $n; $i++ ) {
				if ( $cb1xNumbering && in_array( $levels[$i]->value, array( 1, 2, 3 ) ) ) {
					--$levels[$i]->value;		// J1.6's 1 is CB's 0, 2 is 1, 3 is 2.
				}
				if ( $filterByVisibleToMe && ! in_array( (int) $levels[$i]->value, $viewAccessLevels ) ) {
					continue;
				}
				$levels[$i]->text			=	JText::_( $levels[$i]->text );

				if ( $html === 2 ) {
					$access_levels[(int) $levels[$i]->value]	=	$levels[$i]->text;
				} elseif ( $html ) {
					$access_levels[$i]		=	JHtml::_( 'select.option', $levels[$i]->value, $levels[$i]->text );
				} else {
					$access_levels[$i]		=	array( 'value' => $levels[$i]->value, 'text' => $levels[$i]->text );
				}
			}

		} else {

			$query							=	'SELECT ' . $_CB_database->NameQuote( 'id' ) . ' AS value'
											.	', ' . $_CB_database->NameQuote( 'name' ) . ' AS text'
											.	"\n FROM " . $_CB_database->NameQuote( '#__groups' )
											.	"\n ORDER BY " . $_CB_database->NameQuote( 'id' );
			$_CB_database->setQuery( $query );
			$levels							=	$_CB_database->loadObjectList();

			for ( $i = 0, $n = count( $levels ); $i < $n; $i++ ) {
				if ( ( ! $cb1xNumbering ) && in_array( $levels[$i]->value, array( 0, 1, 2 ) ) ) {
					++$levels[$i]->value;		// J1.5's 0 is CB's 1, 1 is 2, 2 is 3.
				}
				if ( $filterByVisibleToMe && ! in_array( (int) $levels[$i]->value, $viewAccessLevels ) ) {
					continue;
				}
				if ( checkJversion() == 1 ) {
					$levels[$i]->text		=	JText::_( $levels[$i]->text );
				}

				if ( $html === 2 ) {
					$access_levels[(int) $levels[$i]->value]	=	$levels[$i]->text;
				} elseif ( $html ) {
					if ( checkJversion() == 1 ) {
						$access_levels[$i]	=	JHTML::_( 'select.option', $levels[$i]->value, $levels[$i]->text );
					} else {
						$access_levels[$i]	=	mosHTML::makeOption( $levels[$i]->value, $levels[$i]->text );
					}
				} else {
					$access_levels[$i]		=	array( 'value' => $levels[$i]->value, 'text' => $levels[$i]->text );
				}
			}

		}

		return $access_levels;
	}

	function get_allowed_access( $access_gid, $recurse, $user_gids ) {
		if ( ! is_array( $user_gids ) ) {
			$user_gids				=	array( $user_gids );
		}

		if ( ( $access_gid == -2 ) || ( ( $access_gid == -1 ) && ( $user_gids && ( ! in_array( $this->mapGroupNamesToValues( 'Public' ), $user_gids ) ) ) ) ) {
			return true;
		} else {
			if ( in_array( $access_gid, $user_gids ) ) {
				return true;
			} else {
				if ( $recurse == 'RECURSE' ) {
					$group_children	=	$this->get_group_parent_ids( $access_gid );

					if ( is_array( $group_children ) && ( count( $group_children ) > 0 ) ) {
						if ( array_intersect( $user_gids, $group_children ) ) {
							return true;
						}
					}
				}
			}

			return false;
		}
	}

	function get_group_children_ids( $gid ) {
		global $_CB_database;

		static $gids			=	array();

		$gid					=	(int) $gid;

		if ( ! isset( $gids[$gid] ) ) {
			if ( checkJversion() >= 2 ) {
				static $grps				=	null;
				static $paths				=	null;

				if ( ! isset( $grps ) ) {
					$query					=	'SELECT *'
											.	"\n FROM " . $_CB_database->NameQuote( '#__usergroups' )
											.	"\n ORDER BY " . $_CB_database->NameQuote( 'lft' );
					$_CB_database->setQuery( $query );
					$grps					=	$_CB_database->loadObjectList( 'id' );
				}

				if ( ! array_key_exists( $gid, $grps ) ) {
					return array();
				}

				if ( ! isset( $paths[$gid] ) ) {
					jimport('joomla.access.access');
					$isSuper				=	JAccess::checkGroup( $gid, 'core.admin' );

					$paths[$gid]			=	array();
					foreach( $grps as $grp ) {
						if ( ( ( $grp->lft <= $grps[$gid]->lft ) && ( $grp->rgt >= $grps[$gid]->rgt ) ) || $isSuper ) {
							$paths[$gid][]	=	$grp->id;
						}
					}
				}

				$type						=	$this->get_parent_container( $grps[$gid], $grps );

				if ( in_array( $type, array( 2, 3 ) ) ) {
					$paths[$gid]			=	array_merge( $paths[$gid], array_diff( $this->get_group_parent_ids( 2 ), $this->get_group_parent_ids( $gid ) ) );
				}

				$paths[$gid]				=	array_unique( $paths[$gid] );

				sort( $paths[$gid], SORT_NUMERIC );

				$groups						=	$paths[$gid];
			} elseif ( checkJversion() == 1 ) {
				$query			=	'SELECT g1.' . $_CB_database->NameQuote( 'id' ) . ' AS group_id'
								.	', g1.' . $_CB_database->NameQuote( 'name' )
								.	"\n FROM " . $_CB_database->NameQuote( '#__core_acl_aro_groups' ) . " AS g1"
								.	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__core_acl_aro_groups' ) . " AS g2"
								.	' ON g2.' . $_CB_database->NameQuote( 'lft' ) . ' >= g1.' . $_CB_database->NameQuote( 'lft' )
								.	"\n WHERE g2." . $_CB_database->NameQuote( 'id' ) . " = " . (int) $gid
								.	"\n ORDER BY g1." . $_CB_database->NameQuote( 'name' );
				$_CB_database->setQuery( $query );
				$groups			=	$_CB_database->loadResultArray();
			} else {
				$query			=	'SELECT g1.' . $_CB_database->NameQuote( 'group_id' )
								.	', g1.' . $_CB_database->NameQuote( 'name' )
								.	"\n FROM " . $_CB_database->NameQuote( '#__core_acl_aro_groups' ) . " AS g1"
								.	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__core_acl_aro_groups' ) . " AS g2"
								.	' ON g2.' . $_CB_database->NameQuote( 'lft' ) . ' >= g1.' . $_CB_database->NameQuote( 'lft' )
								.	"\n WHERE g2." . $_CB_database->NameQuote( 'group_id' ) . " = " . (int) $gid
								.	"\n ORDER BY g1." . $_CB_database->NameQuote( 'name' );
				$_CB_database->setQuery( $query );
				$groups			=	$_CB_database->loadResultArray();
			}

			for ( $i = 0, $n = count( $groups ); $i < $n; $i++ ) {
				$groups[$i]		=	(int) $groups[$i];
			}

			$standardlist		=	array( -2 );

			if ( $gid && ( $gid != $this->mapGroupNamesToValues( 'Public' ) ) ) {
				$standardlist[]	=	-1;
			}

			$groups				=	array_merge( $groups, $standardlist );

			$gids[$gid]			=	$groups;
		}

		return $gids[$gid];
	}

	function get_group_parent_ids( $gid = null ) {
		global $_CB_database;

		static $gids		=	array();

		$gid				=	(int) $gid;

		if ( ! isset( $gids[$gid] ) ) {

			if ( checkJversion() >= 2 ) {
				static $grps				=	null;
				static $paths				=	null;

				if ( ! isset( $grps ) ) {
					$query					=	'SELECT *'
											.	"\n FROM " . $_CB_database->NameQuote( '#__usergroups' )
											.	"\n ORDER BY " . $_CB_database->NameQuote( 'lft' );
					$_CB_database->setQuery( $query );
					$grps					=	$_CB_database->loadObjectList( 'id' );
				}

				if ( ! array_key_exists( $gid, $grps ) ) {
					return array();
				}

				if ( ! isset( $paths[$gid] ) ) {
					$paths[$gid]			=	array();

					foreach( $grps as $grp ) {
						if ( ( $grp->lft >= $grps[$gid]->lft ) && ( $grp->rgt <= $grps[$gid]->rgt ) ) {
							$paths[$gid][]	=	$grp->id;
						}
					}
				}

				$type						=	$this->get_parent_container( $grps[$gid], $grps );

				if ( $type === 1 ) {
					$paths[$gid]			=	array_merge( $paths[$gid], $this->get_group_parent_ids( 6 ) );
				} elseif ( $type === 2 ) {
					$paths[$gid]			=	array_merge( $paths[$gid], $this->get_group_parent_ids( 8 ) );
				}

				$paths[$gid]				=	array_unique( $paths[$gid] );

				sort( $paths[$gid], SORT_NUMERIC );

				$groups						=	$paths[$gid];
			} elseif ( checkJversion() == 1 ) {
				$query		=	'SELECT g1.' . $_CB_database->NameQuote( 'id' ) . ' AS group_id'
							// .	', g1.' . $_CB_database->NameQuote( 'name' )
							.	"\n FROM " . $_CB_database->NameQuote( '#__core_acl_aro_groups' ) . " AS g1"
							.	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__core_acl_aro_groups' ) . " AS g2"
							.	' ON g2.' . $_CB_database->NameQuote( 'lft' ) . ' <= g1.' . $_CB_database->NameQuote( 'lft' )
							.	"\n WHERE g2." . $_CB_database->NameQuote( 'id' ) . " = " . (int) $gid
							.	"\n ORDER BY g1." . $_CB_database->NameQuote( 'name' );
				$_CB_database->setQuery( $query );
				$groups		=	$_CB_database->loadResultArray();
			} else {
				$query		=	'SELECT g1.' . $_CB_database->NameQuote( 'group_id' )
							// .	', g1.' . $_CB_database->NameQuote( 'name' )
							.	"\n FROM " . $_CB_database->NameQuote( '#__core_acl_aro_groups' ) . " AS g1"
							.	"\n LEFT JOIN " . $_CB_database->NameQuote( '#__core_acl_aro_groups' ) . " AS g2"
							.	' ON g2.' . $_CB_database->NameQuote( 'lft' ) . ' <= g1.' . $_CB_database->NameQuote( 'lft' )
							.	"\n WHERE g2." . $_CB_database->NameQuote( 'group_id' ) . " = " . (int) $gid
							.	"\n ORDER BY g1." . $_CB_database->NameQuote( 'name' );
				$_CB_database->setQuery( $query );
				$groups		=	$_CB_database->loadResultArray();
			}

			for ( $i = 0, $n = count( $groups ); $i < $n; $i++ ) {
				$groups[$i]	=	(int) $groups[$i];
			}

			$gids[$gid]		=	$groups;
		}

		return $gids[$gid];
	}

	function get_parent_container( $grp, $groups ) {
		if ( $grp && $groups ) {
			foreach ( $groups as $group ) {
				$id			=	(int) $grp->id;
				$parent		=	(int) $grp->parent_id;
				$grps		=	array( $parent, $id );

				// Go no further if group has no parent:
				if ( $parent ) {
					// Determine Joomla version:
					if ( checkJversion() == 2 ) {
						if ( in_array( 2, $grps ) ) {
							return 1; // Registered
						} elseif ( in_array( 6, $grps ) ) {
							return 2; // Manager
						} elseif ( in_array( 8, $grps ) ) {
							return 3; // Super Administrator
						}
					} else {
						if ( in_array( 29, $grps ) ) {
							return 1; // Public Frontend
						} elseif ( in_array( 30, $grps ) ) {
							return 2; // Public Backend
						}
					}

					// Loop through for deep groups:
					return $this->get_parent_container( $groups[$parent], $groups );
				} else {
					return 0; // Root
				}
			}
		}

		return null; // Unknown
	}

	/**
	 * Checks if the user is a super-admin
	 *
	 * @since 1.8 (and param $userId since 1.8.1)
	 *
	 * @param  int|null  $userId  User id (default: NULL means logged-in user)
	 * @return boolean            TRUE: Yes, user is super-admin, FALSE otherwise
	 */
	function amIaSuperAdmin( $userId = null ) {
		if ( checkJversion() == 2 ) {
			// Belongs to a group which has super-user permission ? If yes, it's a super user in J1.6+:
			return JFactory::getUser( $userId )->authorise( 'core.admin' );
		} else {
			// Older versions have fixed assignments:
			global $_CB_framework;
			if ( $userId ) {
				$myId			=	$userId;
			} else {
				$myId			=	$_CB_framework->myId();
			}
			return ( $myId && in_array( $this->mapGroupNamesToValues( 'Superadministrator' ), $this->myGroups( $myId ) ) );
		}
	}
	/**
	 * Checks if at least a group within $groups gives the authorization to perform an $action on an $asset 
	 *
	 * @since 1.8 (and Joomla 1.6+ only for now)
	 *
	 * @param  array   $groups
	 * @param  string  $action
	 * @param  string  $asset
	 * @return boolean
	 */	
	function authorizeGroupsForAction( $groups, $action, $asset = 'com_comprofiler' ) {
		if ( checkJversion() >= 2 ) {
			$canDoAction		=	false;
			foreach ( $groups as $gid) {
				$canDoAction	=	JAccess::checkGroup( $gid, 'core.admin' );
				if ( $canDoAction ) {
					break;
				}
			}
		} else {
			// J 1.5-
			//TODO Equivalent
		}
		return $canDoAction;
	}
	/**
	 * Gives all groups (as strict integers) this CBUser is assigned to, as well as optionally the ones below (inherited groups) if $recursive is TRUE (DEFAULT)
	 *
	 * @since 1.8 Temporarily here for future use or deprecation. Do not count on it staying as is.
	 *
	 * @param  boolean  $recursive     TRUE (DEFAULT): Also lists all inherited groups below the ones of the user (strict Joomla 1.6+ definition for 1.6+ and 1.5 definition for 1.5-
	 * @return array of int (STRICT ints)
	 */
	function getGroupIds( $myId, $recursive = false ) {
		$myId	=	(int) $myId;
		if ( checkJversion() >= 2 ) {
			return JAccess::getGroupsByUser( $myId, $recursive );
		} else {
			return $this->getUserGroupIds( $myId, $recursive );
		}
	}
	/**
	 * Gives all groups (as strict integers) a user is assigned to, as well as optionally the ones below (inherited groups)
	 * This returns "parent" groups extensively, in the Joomla 1.5-way.
	 * Do not use in Joomla 1.6+ to get strict parent groups but use: getGroupIds() above instead
	 *
	 * @since 1.8
	 *
	 * @param  int      $myId
	 * @param  boolean  $recursive
	 * @return array of int (STRICT ints)
	 */
	function getUserGroupIds( $myId, $recursive ) {
		if ( $myId ) {
			if ( $recursive ) {
				return $this->get_groups_below_me( $myId, true );
			} else {
				return $this->myGroups( $myId );
			}
		} else {
			return $this->mapGroupNamesToValues( array( 'Public' ) );
		}
	}
	/**
	 * Gives all groups to which user $myId is assigned (but none below)
	 *
	 * @since 1.8
	 *
	 * @param  int  $myId      User-id
	 * @return array of int    Group ids
	 */
	function myGroups( $myId ) {
		$myId					=	(int) $myId;
		if ( checkJversion() == 2 ) {
			$my_groups			=	$this->get_object_groups( $myId );
		} else {
			if ( $myId ) {
				if ( checkJversion() == 1 ) {
					$aro_id		=	$this->get_object_id( 'users', $myId, 'ARO' );
					$my_groups	=	$this->get_object_groups( $aro_id, 'ARO' );
				} else {
					$my_groups	=	$this->get_object_groups( 'users', $myId, 'ARO' );
				}
			} else {
				$my_groups		=	array( $this->mapGroupNamesToValues( 'Public' ) );
			}
		}
		return cbArrayToInts( $my_groups );
	}

	function get_groups_below_me( $myId = null, $raw = false, $exact = false ) {
		global $_CB_framework;

		static $gids			=	array();

		if ( $myId == null ) {
			$myId				=	$_CB_framework->myId();
		} else {
			$myId				=	(int) $myId;
		}

		$id						=	(int) $myId . '_'. (int) $exact;

		if ( ! isset( $gids[$id] ) ) {
			$my_groups			=	$this->myGroups( $myId );
			$my_gids			=	array();

			if ( $my_groups ) foreach ( $my_groups as $gid ) {
				$my_gids		=	array_unique( array_merge( $my_gids, $this->get_group_children_ids( $gid ) ) );

				if ( checkJversion() == 2 ) {
					$my_gids	=	array_unique( array_merge( $my_gids, $this->get_object_groups( $myId, null, 'RECURSE' ) ) );
				}
			}

			if ( ( ! is_array( $my_gids ) ) || empty( $my_gids ) ) {
				$my_gids		=	array();
			} else {
				cbArrayToInts( $my_gids );

				if ( $exact ) foreach ( $my_gids as $k => $v ) {
					if ( in_array( $v, $my_groups ) ) {
						unset( $my_gids[$k] );
					}
				}
			}

			$groups				=	$this->get_group_children_tree( null, 'USERS', false );

			if ( $groups ) {
				foreach ( $groups as $k => $v ) {
					if ( ! in_array( (int) $v->value, $my_gids ) ) {
						unset( $groups[$k] );
					}
				}
			}

			$gids[$id]			=	array_values( $groups );
		}

		$rows					=	$gids[$id];

		if ( $raw ) {
			// in raw mode, makes array of strict ints:
			$grps				=	array( -2 );

			if ( $myId ) {
				$grps[]			=	-1;
			}

			if ( $rows ) {
				foreach ( $rows as $row ) {
					$grps[]		=	(int) $row->value;
				}
			} else {
				$grps[]			=	(int) $this->mapGroupNamesToValues( 'Public' );
			}

			$rows				=	$grps;
		} elseif ( ! $rows ) {
			$rows				=	array();
		}

		return $rows;
	}

	function get_groups_above_me( $myId = null, $raw = false ) {
		global $_CB_framework;

		static $gids			=	array();

		if ( $myId === null ) {
			$myId				=	$_CB_framework->myId();
		} else {
			$myId				=	(int) $myId;
		}

		if ( ! isset( $gids[$myId] ) ) {
			if ( checkJversion() == 2 ) {
				$my_groups		=	$this->get_object_groups( $myId );
			} elseif ( checkJversion() == 1 ) {
				$aro_id			=	$this->get_object_id( 'users', $myId, 'ARO' );
				$my_groups		=	$this->get_object_groups( $aro_id, 'ARO' );
			} else {
				$my_groups		=	$this->get_object_groups( 'users', $myId, 'ARO' );
			}

			$my_gids			=	array();

			if ( $my_groups ) foreach ( $my_groups as $gid ) {
				$my_gids		=	array_unique( array_merge( $my_gids, $this->get_group_parent_ids( $gid ) ) );

				if ( checkJversion() == 2 ) {
					$my_gids	=	array_unique( array_merge( $my_gids, $this->get_object_groups( $myId, null, 'RECURSE' ) ) );
				}
			}

			if ( ( ! is_array( $my_gids ) ) || empty( $my_gids ) ) {
				$my_gids		=	array();
			} else {
				cbArrayToInts( $my_gids );

				$below_me		=	$this->get_groups_below_me( $myId, true );

				if ( $below_me ) foreach ( $my_gids as $k => $v ) {
					if ( in_array( $v, $below_me ) ) {
						unset( $my_gids[$k] );
					}
				}
			}

			$groups				=	$this->get_group_children_tree( null, 'USERS', false );

			if ( $groups ) foreach ( $groups as $k => $v ) {
				if ( ! in_array( (int) $v->value, $my_gids ) ) {
					unset( $groups[$k] );
				}
			}

			$gids[$myId]		=	array_values( $groups );
		}

		$rows					=	$gids[$myId];

		if ( $rows ) {
			if ( $raw ) {
				$grps			=	array();

				foreach ( $rows as $row ) {
					$grps[]		=	(int) $row->value;
				}

				$rows			=	$grps;
			}
		} else {
			$rows				=	array();
		}

		return $rows;
	}

	/**
	 * Prepare top most GID from array of IDs
	 *
	 * @param array $gids
	 * @return int
	 */
	function getBackwardsCompatibleGid( $gids ) {
		static $mod			=	null;
		static $admin		=	null;
		static $super_admin	=	null;
		if ( $super_admin === null ) {
			$mod			=	$this->mapGroupNamesToValues( 'Manager' );
			$admin			=	$this->mapGroupNamesToValues( 'Administrator' );
			$super_admin	=	$this->mapGroupNamesToValues( 'Superadministrator' );
		}

		$gids			=	(array) $gids;
		cbArrayToInts( $gids );

		if ( in_array( $super_admin, $gids ) ) {
			$gid		=	$super_admin;
		} elseif ( in_array( $admin, $gids ) ) {
			$gid		=	$admin;
		} elseif ( in_array( $mod, $gids ) ) {
			$gid		=	$mod;
		} else {
			$gid		=	( empty( $gids ) ? null : $gids[( count( $gids ) - 1 )] );
		}

		return $gid;
	}

	/**
	 * Remap literal groups (such as in default values) to the hardcoded CMS values
	 *
	 * @param  string|array  $name  of int|string
	 * @return int|array of int
	 */
	function mapGroupNamesToValues( $name ) {
		static $ps						=	null;

		$selected						=	(array) $name;
		foreach ( $selected as $k => $v ) {
			if ( ! is_numeric( $v ) ) {
				if ( ! $ps ) {
					if ( checkJversion() >= 2 ) {
						$ps				=	array( 'Root' => 0 , 'Users' => 0 , 'Public' =>  1, 'Registered' =>  2, 'Author' =>  3, 'Editor' =>  4, 'Publisher' =>  5, 'Backend' => 0 , 'Manager' =>  6, 'Administrator' =>  7, 'Superadministrator' =>  8, 'Guest' => 9 );
						if ( ! checkJversion( 'j3.0+' ) ) {
							$ps['Guest'] =	0;
						}
					} else {
						$ps				=	array( 'Root' => 17, 'Users' => 28, 'Public' => 29, 'Registered' => 18, 'Author' => 19, 'Editor' => 20, 'Publisher' => 21, 'Backend' => 30, 'Manager' => 23, 'Administrator' => 24, 'Superadministrator' => 25, 'Guest' => 0 );
					}
				}
				if ( array_key_exists( $v, $ps ) ) {
					if ( $ps[$v] != 0 ) {
						$selected[$k]	=	$ps[$v];
					} else {
						unset( $selected[$k] );
					}
				} else {
					$selected[$k]		=	(int) $v;
				}
			}
		}
		if ( ! is_array( $name ) ) {
			$selected					=	$selected[0];
		}
		return $selected;
	}

	function get_users_permission( $user_ids, $action, $allow_myself = false ) {
		global $_CB_database, $_CB_framework;

		$msg							=	null;


		if ( is_array( $user_ids ) && count( $user_ids ) ) {
			$obj						=	new moscomprofilerUser( $_CB_database );

			foreach ( $user_ids as $user_id ) {
				if ( $user_id != 0 ) {
					if ( $obj->load( (int) $user_id ) ) {
						if ( checkJversion() >= 2 ) {
							$groups		=	$this->get_object_groups( $user_id );
						} elseif ( checkJversion() == 1 ) {
							$aro_id		=	$this->get_object_id( 'users', $user_id, 'ARO' );
							$groups		=	$this->get_object_groups( $aro_id, 'ARO' );
						} else {
							$groups		=	$this->get_object_groups( 'users', $user_id, 'ARO' );
						}

						if ( isset( $groups[0] ) ) {
							$this_group =	strtolower( $this->get_group_name( $groups[0], 'ARO' ) );
						} else {
							$this_group	=	'Registered';
						}
					} else {
						$msg			.=	'User not found. ';
					}
				} else {
					$this_group			=	'Registered';
					$obj->gid 			=	$this->get_group_id( $this_group, 'ARO' );
					$obj->gids			=	$this->get_groups_below_me( $user_id, true );
				}

				if ( $user_id == $_CB_framework->myId() ) {
					if ( ! $allow_myself ) {
		 				$msg			.=	"You cannot $action Yourself! ";
					}
	 			} else {
					if ( checkJversion() >= 2 ) {
						if ( ! $this->amIaSuperAdmin() ) {
							$userGroups	=	$this->get_object_groups( $user_id );
							$myGroups	=	$this->get_object_groups( $_CB_framework->myId() );
							
							$myCBuser	=	CBuser::getMyInstance();
							$iAmAdmin	=	( $myCBuser->authoriseAction( 'core.manage', 'com_users' ) && $myCBuser->authoriseAction( 'core.edit', 'com_users' ) );
							$exactGids	=	! $iAmAdmin;
							$myGidsTree	=	$this->get_groups_below_me( $_CB_framework->myId(), true, $exactGids );
							$isHeSAdmin	=	$this->amIaSuperAdmin( (int) $user_id );

							if ( ( ( array_values( $userGroups ) == array_values( $myGroups ) ) && ( ! $iAmAdmin ) )
							|| ( $user_id && $userGroups && ( ! array_intersect( $userGroups, $myGidsTree ) ) )
							|| $isHeSAdmin )
							{
								$msg	.=	"You cannot $action a `$this_group`. Only higher-level users have this power. ";
							}
						}
					} else {
						$myGid			=	$this->get_user_group_id( $_CB_framework->myId() );
						$cms_admins		=	$this->mapGroupNamesToValues( array( 'Administrator', 'Superadministrator' ) );
						$cms_super_admin =	$this->mapGroupNamesToValues( 'Superadministrator' );
						
						if ( $myGid != $cms_super_admin ) {
							if ( ( ( $obj->gid == $myGid ) && ! in_array( $myGid, $cms_admins ) ) || ( $user_id && $obj->gid && ! in_array( $obj->gid, $this->get_group_children_ids( $myGid ) ) ) ) {
								$msg	.=	"You cannot $action a `$this_group`. Only higher-level users have this power. ";
							}
						}
					}
				}
			}
		} else {
			$this_group 				=	'Registered';
			$gid 						=	$this->get_group_id( $this_group, 'ARO' );

			if ( $user_ids == $_CB_framework->myId() ) {
				if ( ! $allow_myself ) {
					$msg				.=	"You cannot $action Yourself! ";
				}
			} else {
				if ( checkJversion() >= 2 ) {
					if ( ! $this->amIaSuperAdmin() ) {
						$userGroups		=	$this->get_object_groups( $user_ids );
						$myGroups		=	$this->get_object_groups( $_CB_framework->myId() );

						$myCBuser		=	CBuser::getMyInstance();
						$iAmAdmin		=	( $myCBuser->authoriseAction( 'core.manage', 'com_users' ) && $myCBuser->authoriseAction( 'core.edit', 'com_users' ) );
						$exactGids		=	! $iAmAdmin;
						$myGidsTree		=	$this->get_groups_below_me( $_CB_framework->myId(), true, $exactGids );
						$isHeSAdmin		=	$this->amIaSuperAdmin( (int) $user_ids );

						if ( ( ( array_values( $userGroups ) == array_values( $myGroups ) ) && ( ! $iAmAdmin ) )
						|| ( $user_ids && $userGroups && ( ! array_intersect( $userGroups, $myGidsTree ) ) )
						|| $isHeSAdmin )
						{
							$msg		.=	"You cannot $action a `$this_group`. Only higher-level users have this power. ";
						}
					}
				} else {
					$myGid				=	$this->get_user_group_id( $_CB_framework->myId() );
					$cms_admins			=	$this->mapGroupNamesToValues( array( 'Administrator', 'Superadministrator' ) );
					$cms_super_admin	=	$this->mapGroupNamesToValues( 'Superadministrator' );

					if ( $myGid != $cms_super_admin ) {
						if ( ( ( $gid == $myGid ) && ! in_array( $myGid, $cms_admins ) ) || ( $user_ids && $gid && ! in_array( $gid, $this->get_group_children_ids( $myGid ) ) ) ) {
							$msg		.=	"You cannot $action a `$this_group`. Only higher-level users have this power. ";
						}
					}
				}
			}
		}

		return $msg;
	}

	function get_user_permission_task( $user_id, $action ) {
		global $_CB_framework, $ueConfig;

		if ( $user_id == 0 ) {
			$user_id					=	$_CB_framework->myId();
		} else {
			$user_id					=	(int) $user_id;		}

		if ( $user_id == 0 ) {
			$ret						=	false;
		} elseif ( $user_id == $_CB_framework->myId() ) {
			$ret						=	null;
		} else {
			if ( ( ! isset( $ueConfig[$action] ) ) || ( $ueConfig[$action] == 0 ) ) {
				$ret					=	_UE_FUNCTIONALITY_DISABLED;
			} elseif ( $ueConfig[$action] == 1 ) {
				$isModerator			=	$this->get_user_moderator( $_CB_framework->myId() );

				if ( ! $isModerator ) {
					$ret				=	false;
				} else {
					$isModerator_user	=	$this->get_user_moderator( $user_id );

					if ( $isModerator_user ) {
						$ret			=	$this->get_users_permission( array( $user_id ), 'edit', true );
					} else {
						$ret			=	null;
					}
				}
			} elseif ( $ueConfig[$action] > 1 ) {
				// 8: super admins only
				// 7: admins and super admins only
				if ( $_CB_framework->acl->amIaSuperAdmin() ) {
					$ret				=	null;
				} elseif ( $ueConfig[$action] != 7 ) {
					$ret				=	false;
				} else {
					// Admins and Super-admins:
					if ( checkJversion() >= 2 ) {
						$myCBuser		=	CBuser::getMyInstance();
						if ( $myCBuser->authoriseAction( 'core.manage', 'com_users' ) && $myCBuser->authoriseAction( 'core.edit', 'com_users' ) ) {
							$ret		=	null;
						} else {
							$ret		=	false;
						}
					} else {
						if ( in_array( $ueConfig[$action], $this->get_groups_below_me( $_CB_framework->myId(), true ) ) ) {
							$ret		=	null;
						} else {
							$ret		=	false;
						}
					}
				}
			} else {
				$ret					=	false;
			}
		}

		if ( $ret === false ) {
			$ret						=	_UE_NOT_AUTHORIZED;

			if ( $_CB_framework->myId() < 1 ) {
				$ret 					.=	'<br />' . _UE_DO_LOGIN;
			}
		}

		return $ret;
	}

	function get_user_moderator( $user_id ) {
		global $ueConfig;

		static $uid			=	array();

		$user_id			=	(int) $user_id;

		if ( ! isset( $uid[$user_id] ) ) {
			$uid[$user_id]	=	( $user_id && in_array( $ueConfig['imageApproverGid'], $this->get_groups_below_me( $user_id, true ) ) );		}

		return $uid[$user_id];
	}
	/**
	 * Get highest group id
	 *
	 * @deprecated 1.8
	 *
	 * @param  int  $user_id
	 * @return int
	 */
	function get_user_group_id( $user_id ) {
		global $_CB_database;

		static $gid					=	array();

		$user_id					=	(int) $user_id;

		if ( ! isset( $gid[$user_id] ) ) {
			if ( $user_id == 0 ) {
				$gid[$user_id]		=	(int) $this->mapGroupNamesToValues( 'Public' );
			} else {
				if ( checkJversion() == 2 ) {
					$query			=	'SELECT ' . $_CB_database->NameQuote( 'group_id' )
									.	"\n FROM " . $_CB_database->NameQuote( '#__user_usergroup_map' )
									.	"\n WHERE " . $_CB_database->NameQuote( 'user_id' ) . " = " . (int) $user_id;
					$_CB_database->setQuery( $query );
					$gids			=	$_CB_database->loadResultArray();
					$gid[$user_id]	=	(int) $this->getBackwardsCompatibleGid( $gids );
				} else {
					$query			=	'SELECT ' . $_CB_database->NameQuote( 'gid' )
									.	"\n FROM " . $_CB_database->NameQuote( '#__users' )
									.	"\n WHERE " . $_CB_database->NameQuote( 'id' ) . " = " . (int) $user_id;
					$_CB_database->setQuery( $query );
					$gid[$user_id]	=	(int) $_CB_database->loadResult();
				}
			}
		}

		return $gid[$user_id];
	}
}

/**
 * CB 1.x ACL DEPRECIATED functions:
 */

function isModerator( $oID ) {
	global $_CB_framework;

	return $_CB_framework->acl->get_user_moderator( $oID );
}
/**
 * Gets main user GID
 *
 * @deprecated 1.8
 *
 * @param  int  $oID  User-id
 * @return array
 */
function userGID( $oID ){
	global $_CB_framework;

	return $_CB_framework->acl->get_user_group_id( $oID );
}

function allowAccess( $accessgroupid, $recurse, $usersgroupid ) {
	global $_CB_framework;

	return $_CB_framework->acl->get_allowed_access( $accessgroupid, $recurse, $usersgroupid );
}

function cbGetAllUsergroupsBelowMe() {
	global $_CB_framework;

	return $_CB_framework->acl->get_groups_below_me();
}
/**
 * Gets children (groups above and including $gid)
 *
 * @deprecated 1.8
 * 
 * @param int $gid
 */
function getChildGIDS( $gid ) {
	global $_CB_framework;

	return $_CB_framework->acl->get_group_children_ids( $gid );
}

function getParentGIDS( $gid = null ) {
	global $_CB_framework;

	return $_CB_framework->acl->get_group_parent_ids( $gid );
}

function checkCBpermissions( $cid, $actionName, $allowActionToMyself = false ) {
	global $_CB_framework;

	return $_CB_framework->acl->get_users_permission( $cid, $actionName, $allowActionToMyself );
}
/**
 * This FRONT-END function checks if the logged-in user is allowed to edit another user $uid as a moderator
 * 
 * @param  int     $uid              The other user to edit
 * @param  string  $ueConfigVarName  'allowModeratorsUserEdit' ONLY !
 */
function cbCheckIfUserCanPerformUserTask( $uid, $ueConfigVarName ) {
	global $_CB_framework;

	return $_CB_framework->acl->get_user_permission_task( $uid, $ueConfigVarName );
}

// ----- NO MORE CLASSES OR FUNCTIONS PASSED THIS POINT -----
// Post class declaration initialisations
// some version of PHP don't allow the instantiation of classes
// before they are defined
?>