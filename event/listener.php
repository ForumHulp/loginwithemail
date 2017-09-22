<?php
/**
*
* @package Login with email
* @copyright (c) 2016 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\loginwithemail\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use phpbb\user;
use phpbb\config\config;
use phpbb\request\request;
use phpbb\template\template;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	protected $user;
	protected $config;
	protected $request;
	protected $template;

	/**
	* Constructor
	*/
	public function __construct(user $user, config $config, request $request, template $template)
	{
		$this->user = $user;
		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header_after'				=> 'add_email',
			'forumhulp.loginwithemail.modify_sql'	=> 'login_with_email',
			'core.acp_board_config_edit_add'		=> 'load_config_on_setup',
		);
	}

	public function add_email($event)
	{
		if ($this->user->data['user_id'] == ANONYMOUS && $this->config['allow_email_login'] && !$this->request->is_set_post('agreed') && $this->request->variable('mode', '') != 'sendpassword')
		{
			$this->user->add_lang_ext('forumhulp/loginwithemail', 'info_acp_loginwithemail');
			$this->template->assign_var('L_USERNAME', $this->user->lang['USERNAME'] . $this->user->lang['WITH_EMAIL']);
		}
	}

	public function login_with_email($event)
	{
		if (!defined('ADMIN_START') && $this->config['allow_email_login'] && $this->request->variable('mode', '') != 'sendpassword')
		{
			$user_email = $event['username_clean'];

			if (!phpbb_validate_email($user_email))
			{
				$sql = $event['sql'];

				$sql = 'SELECT *
					FROM ' . USERS_TABLE . "
					WHERE user_email_hash = '" . phpbb_email_hash($user_email) . "'";
				$event['sql'] = $sql;
			}
		}
	}

	public function load_config_on_setup($event)
	{
		if ($event['mode'] == 'registration')
		{
			if ($event['submit'])
			{
				$this->request->overwrite('allow_email_login', 0, \phpbb\request\request_interface::POST);
			}

			$display_vars = $event['display_vars'];

			$add_config_var = array(
				'allow_email_login' =>
					array(
						'lang'		=> 'LIWE_ALLOWED',
						'validate'	=> 'bool',
						'type'		=> 'custom',
						'function'	=> __NAMESPACE__.'\listener::allow_email_login',
						'explain'	=> true),
			);

			$display_vars['vars'] = phpbb_insert_config_array($display_vars['vars'], $add_config_var, array('after' =>'allow_emailreuse'));
			$event['display_vars'] = array('title' => $display_vars['title'], 'vars' => $display_vars['vars']);
		}
	}

	static function allow_email_login($value, $key)
	{
		global $db, $config, $user, $phpbb_container;

		$not_allowed = false;
		if (!$config['allow_emailreuse'])
		{
			$sql = 'SELECT count(user_email_hash) as cnt FROM ' . USERS_TABLE . ' WHERE user_email_hash > 0 GROUP BY user_email_hash HAVING cnt > 1';
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$not_allowed = $row;
			$helper = $phpbb_container->get('controller.helper');
			$message = ($row) ? $user->lang('DUP_RECORDS', $helper->route('forumhulp_loginwithemail_controller')) : '';
		} else
		{
			$not_allowed = true;
			$message = 	$user->lang['ALLOW_EMAIL_LOGIN'];
		}

		$radio_ary = array(1 => 'YES', 0 => 'NO');
		return str_replace('value="1"', 'value="1"' . (($not_allowed) ? 'disabled' : ''), h_radio('config[allow_email_login]', $radio_ary, ($not_allowed) ? 0 : $value) . (($not_allowed) ? $message : ''));
	}
}
