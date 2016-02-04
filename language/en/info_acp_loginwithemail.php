<?php
/**
*
* @package Login with email
* @copyright (c) 2016 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_LIWE'				=> 'Login with email',
	'WITH_EMAIL'			=> ' / email',
	'LIWE_ALLOWED'			=> 'Allow email login',
	'LIWE_ALLOWED_EXPLAIN'	=> 'Allow login with your emailaddress, only if email reuse is off. Save form before you can use LIWE',
	'ALLOW_EMAIL_LOGIN'		=> '(Email reuse allowed!)',
	'DUP_RECORDS'			=> '(Duplicate <a href="%1$s" data-ajax="true" style="color:red;">emailaddresses</a> in memberlist!)',
	'DUP_RECORDS_FOUND'		=> 'Duplicate emailaddresses in memberlist!',
	'LIWE_NOTICE'			=> '<div class="phpinfo"><p class="entry">Config setting of this extension are in %1$s » %2$s » %3$s » %4$s.</p></div>',
	'FH_HELPER_NOTICE'		=> 'Forumhulp helper application does not exist!<br />Download <a href="https://github.com/ForumHulp/helper">forumhulp/helper</a> and copy the helper folder to your forumhulp extension folder.',
));
