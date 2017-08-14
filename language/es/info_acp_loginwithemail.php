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
	'ACP_LIWE'				=> 'Inicio de sesión con email',
	'WITH_EMAIL'			=> ' / email',
	'LIWE_ALLOWED'			=> 'Permitir inicio de sesión de email',
	'LIWE_ALLOWED_EXPLAIN'	=> 'Permitir inicio de sesión con su dirección de correo electrónico, sólo si la reutilización de correo electrónico está desactivada. Guardar formulario antes de poder usarlo LIWE',
	'ALLOW_EMAIL_LOGIN'		=> '(¡Reutilización de email permitido!)',
	'DUP_RECORDS'			=> '(¡Duplicar <a href="%1$s" data-ajax="true" style="color:red;">dirección de correo electrónico</a> en la lista de miembros!)',
	'DUP_RECORDS_FOUND'		=> '¡Duplicar dirección de correo electrónico en la lista de miembros!',
	'LIWE_NOTICE'			=> '<div class="phpinfo"><p class="entry">Ajustes de configuración de está extensión están en %1$s » %2$s » %3$s » %4$s.</p></div>',
	'FH_HELPER_NOTICE'		=> '¡La aplicación Forumhulp helper no existe!<br />Descargar <a href="https://github.com/ForumHulp/helper" target="_blank">forumhulp/helper</a> y copie la carpeta helper dentro de la carpeta de extensión forumhulp.',
));
