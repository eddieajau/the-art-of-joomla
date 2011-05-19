<?php
/**
 * @version		$Id: ckeditor.php 1.2 28-09-2009 Danijar
 * @package		NewLifeInIT
 * @subpackage	plg_editors_ckeditor
 * @copyright	Copyright 2010 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

/**
 * This is a dummy JHtml element that sneakily loads the language file
 * for the frontend module.
 *
 * @package		NewLifeInIT
 * @subpackage	plg_editors_ckeditor
 */
class JElementDummy extends JElement
{
	/**
	 * Element name
	 */
	public $_name = 'Dummy';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$lang = JFactory::getLanguage();
		$lang->load('plg_editors_ckeditor', JPATH_SITE.'/plugins/editors/artofeditor');

		return false;
	}

	function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='')
	{
		return false;
	}
}