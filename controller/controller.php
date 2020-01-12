<?php
/**
*
* @package Login with email
* @copyright (c) 2016 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\loginwithemail\controller;

use phpbb\db\driver\driver_interface;
use phpbb\template\template;
use phpbb\user;
use phpbb\request\request;

/**
* Main controller
*/
class controller
{
	protected $db;
	protected $template;
	protected $user;
	protected $request;
	/**
	* Constructor
	*
	* @access public
	*/
	public function __construct(driver_interface $db, template $template, user $user, request $request)
	{
		$this->db = $db;
		$this->template = $template;
		$this->user = $user;
		$this->request = $request;
	}

	/**
	* Display the page
	*
	* @access public
	*/
	public function find_dup()
	{
		$this->user->add_lang_ext('forumhulp/loginwithemail', 'info_acp_loginwithemail');
		$sql = 'SELECT username, user_email FROM ' . USERS_TABLE . ' list
				INNER JOIN (SELECT user_email FROM ' . USERS_TABLE . ' WHERE user_type <> 2
				GROUP BY user_email HAVING count(user_email) > 1) dup ON list.user_email = dup.user_email';
		$result = $this->db->sql_query($sql);
		$message = '';
		while ($row = $this->db->sql_fetchrow($result))
		{
			$message .= $row['username'] . ' » ' . $row['user_email'] . '<br />';
		}

		if ($this->request->is_ajax())
		{
			$json_response = new \phpbb\json_response;
			$json_response->send(array(
				'MESSAGE_TITLE'	=> $this->user->lang['DUP_RECORDS_FOUND'],
				'MESSAGE_TEXT'	=> $message,
			));
		} else
		{
			trigger_error($message, E_USER_NOTICE);
		}
	}
}
