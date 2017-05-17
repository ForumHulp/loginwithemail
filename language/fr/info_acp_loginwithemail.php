<?php
/**
*
* Login with your email extension for the phpBB Forum Software package.
* French translation by Galixte (http://www.galixte.com)
*
* @copyright (c) 2017 ForumHulp <http://ForumHulp.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_LIWE'				=> 'Se connecter avec l’adresse e-mail',
	'WITH_EMAIL'			=> ' / adresse e-mail',
	'LIWE_ALLOWED'			=> 'Autoriser la connexion avec l’adresse e-mail',
	'LIWE_ALLOWED_EXPLAIN'	=> 'Permet de se connecter au forum au moyen de l’adresse e-mail, l’option : « Autoriser les adresses e-mail à être réutilisées » doit être désactivée. Il est nécessaire de valider cette page avant d’utiliser cette fonctionnalité.',
	'ALLOW_EMAIL_LOGIN'		=> '(l’option : « Autoriser les adresses e-mail à être réutilisées » est activée !)',
	'DUP_RECORDS'			=> '(Des <a href="%1$s" data-ajax="true" style="color:red;">adresses e-mail</a> identiques ont été trouvées dans la liste des membres !)',
	'DUP_RECORDS_FOUND'		=> 'Des adresses e-mail identiques ont été trouvées dans la liste des membres !',
	'LIWE_NOTICE'			=> '<div class="phpinfo"><p class="entry">Les paramètres de configuration de cette extension se trouvent dans : %1$s » %2$s » %3$s » %4$s.</p></div>',
	'FH_HELPER_NOTICE'		=> 'L’extension « Forumhulp Helper » n’est pas installée !<br />Merci de télécharger l’extension « <a href="https://github.com/ForumHulp/helper">Forumhulp Helper</a> » puis de l’installer.',
));
