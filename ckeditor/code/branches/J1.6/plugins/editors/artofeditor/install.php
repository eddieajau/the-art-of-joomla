<?php
/**
 * @version		$Id: ckeditor.php 1.2 28-09-2009 Danijar
 * @package		NewLifeInIT
 * @subpackage	plg_editors_artofeditor
 * @copyright	Copyright 2010 New Life in IT Pty Ltd. All rights reserved.
 * @copyright	Based on work Copyright 2009 CMSSpace <http://www.cmsspace.com>
 * @license		GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

/**
 * @package		NewLifeInIT
 * @subpackage	plg_editors_artofeditor
 * @since		1.0.3
 */
class plgEditorsArtofEditorInstallerScript
{
	/**
	 * Post-flight extension installer method.
	 *
	 * This method runs after all other installation code.
	 *
	 * @param	$type
	 * @param	$parent
	 *
	 * @return	void
	 * @since	1.0.3
	 */
	function postflight($type, $parent)
	{
		// Display a nice installed message.
		echo JText::sprintf(
			'PLG_AOEDITOR_INSTALLED',
			'1.0.5'
		);
	}
}
