<?php

/**
 * @package Unread Notifications On Title
 * @version 2.0
 * @author Diego Andrés <diegoandres_cortes@outlook.com>
 * @copyright Copyright (c) 2020, Diego Andrés
 * @license https://www.mozilla.org/en-US/MPL/2.0/
 */

if (!defined('SMF'))
	die('No direct access...');

class UnreadNotisTitle
{
	public static function theme_context()
	{
		global $context;

		// Alerts or PM's
		if ((!empty($context['user']['unread_messages']) || !empty($context['user']['alerts'])) && !$context['user']['is_guest'])
			$context['page_title_html_safe'] .= ' (' . ($context['user']['unread_messages'] + $context['user']['alerts']) . ')';
	}
}