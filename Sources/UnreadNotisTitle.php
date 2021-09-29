<?php

/**
 * @package Unread Notifications On Title
 * @version 1.1.1
 * @author Diego Andrés <diegoandres_cortes@outlook.com>
 * @copyright Copyright (c) 2020, Diego Andrés
 * @license https://www.mozilla.org/en-US/MPL/2.0/
 */

if (!defined('SMF'))
	die('No direct access...');

class UnreadNotisTitle
{
	/**
	 * @var int The noti count
	 */
	private $_notifications;

	/**
	 * UnreadNotisTitle::__construct()
	 *
	 *  Initialize the notis to 0 and then start adding them
	 * 
	 * @return void
	 */
	public function __construct()
	{
		// No notis
		$this->_notifications = 0;

		// Add the notis
		$this->find_notis();
	}

	/**
	 * UnreadNotisTitle::theme_context()
	 *
	 *  Insert the notis in the title
	 * 
	 * @return void
	 */
	public function theme_context()
	{
		global $context;

		// Insert the notis in the title
		if (!empty($this->_notifications))
			$context['page_title_html_safe'] = '(' . ($this->_notifications) . ') ' . $context['page_title_html_safe'];
	}

	/**
	 * UnreadNotisTitle::find_notis()
	 *
	 *  Load and add the different notis
	 * Allow other mods to hook their noti count too
	 * 
	 * @return void
	 */
	public function find_notis()
	{
		global $context;

		// Alerts
		$this->_notifications += !$context['user']['is_guest'] ? $context['user']['alerts'] : 0;
		// Personal Messages
		$this->_notifications += !$context['user']['is_guest'] ? $context['user']['unread_messages'] : 0;
		// Mod Actions
		$this->_notifications += !$context['user']['is_guest'] ? $context['open_mod_reports'] : 0;

		// Allow other mods to add their notis
		call_integration_hook('integrate_mod_unreadnotistitle', [&$this->_notifications]);
	}
}