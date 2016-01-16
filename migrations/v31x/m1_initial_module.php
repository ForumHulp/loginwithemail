<?php
/**
*
* @package Login with email
* @copyright (c) 2016 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\loginwithemail\migrations\v31x;

use phpbb\db\migration\container_aware_migration;

/**
* Migration stage 1: Initial module
*/
class m1_initial_module extends container_aware_migration
{
	/**
	 * Assign migration file dependencies for this migration
	 *
	 * @return array Array of migration files
	 * @static
	 * @access public
	 */
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\gold');
	}

	/**
	* Add core change to the files.
	*
	* @return array Array of files
	* @access public
	*/
	public function update_data()
	{
		$this->revert = false;
		return array(
			array('config.add', array('allow_email_login', 0)),
			array('custom', array(array($this, 'update_files'))),
		);
	}

	public function revert_data()
	{
		$this->revert = true;
		return array(
			array('custom', array(array($this, 'update_files'))),
		);
	}

	public function update_files()
	{
		if (class_exists('forumhulp\helper\helper'))
		{
			if (!$this->container->has('forumhulp.helper'))
			{
				$forumhulp_helper = new \forumhulp\helper\helper(
					$this->config,
					$this->container->get('ext.manager'),
					$this->container->get('template'),
					$this->container->get('user'),
					$this->container->get('request'),
					$this->container->get('log'),
					$this->container->get('cache'),
					$this->phpbb_root_path			
				);
				$this->container->set('forumhulp.helper', $forumhulp_helper);
			}
			$this->container->get('forumhulp.helper')->update_files($this->data(), $this->revert);
		} else
		{
			$this->container->get('user')->add_lang_ext('forumhulp/loginwithemail', 'info_acp_loginwithemail');
			trigger_error($this->container->get('user')->lang['FH_HELPER_NOTICE'], E_USER_WARNING);	
		}
	}

	public function data()
	{
		$replacements = array(
			'files' => array(
				0 => '/phpbb/auth/provider/db.' . $this->php_ext,
				),
			'searches' => array(
				0 => array(
					0 => '			WHERE username_clean = \'" . $this->db->sql_escape($username_clean) . "\'";')
				),
			'replaces' => array(
				0 => array(
					0 => '			WHERE username_clean = \'" . $this->db->sql_escape($username_clean) . "\'";

		global $phpbb_dispatcher;
		$vars = array(\'sql\', \'username_clean\');
		extract($phpbb_dispatcher->trigger_event(\'forumhulp.loginwithemail.modify_sql\', compact($vars)));
')
				)
			);
		return $replacements;
	}
}
