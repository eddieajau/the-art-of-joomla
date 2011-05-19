<?php
/**
 * @version		$Id: ckeditor.php 1.2 28-09-2009 Danijar
 * @package		NewLifeInIT
 * @subpackage	plg_editors_artofeditor
 * @copyright	Copyright 2005 - 2011 New Life in IT Pty Ltd. All rights reserved.
 * @copyright	Based on work Copyright 2009 CMSSpace <http://www.cmsspace.com>
 * @license		GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.event.plugin');

/**
 * @package		NewLifeInIT
 * @subpackage	plg_editors_artofeditor
 * @since		1.0.1
 */
class plgEditorArtofEditor extends JPlugin
{
	/**
	 * Get's a sanitised name for the editor.
	 *
	 * @param	string	$name	The name of the form control.
	 *
	 * @return	string
	 * @since	1.0.0
	 */
	protected function getEditorName($name)
	{
		return preg_replace('#\W#', '_', $name);
	}

	/**
	 * Add the buttons to the editor.
	 *
	 * @param	string	$name	The name of the control.
	 * @param
	 *
	 * @return	string
	 * @since	1.0.0
	 */
	protected function displayButtons($name, $buttons)
	{
		// Load modal popup behavior
		JHTML::_('behavior.modal', 'a.modal-button');

		// Initialise variables.
		$id		= $this->getEditorName($name);
		$args	= array(
			'name'	=> $id,
			'event'	=> 'onGetInsertMethod'
		);
		$return = '';
		$results[] = $this->update($args);
		foreach ($results as $result)
		{
			if (is_string($result) && trim($result)) {
				$return .= $result;
			}
		}

		if (!empty($buttons)) {
			$results = $this->_subject->getButtons($id, $buttons);
			$return .= "\n<div id=\"editor-xtd-buttons\">\n";

			foreach ($results as $button)
			{
				if ($button->get('name')) {
					$modal		= ($button->get('modal')) ? 'class="modal-button"' : null;
					$href		= ($button->get('link')) ? 'href="'.$button->get('link').'"' : null;
					$onclick	= ($button->get('onclick')) ? 'onclick="'.$button->get('onclick').'"' : null;
					$return		.= "<div class=\"button2-left\"><div class=\"".$button->get('name')."\"><a ".$modal." title=\"".$button->get('text')."\" ".$href." ".$onclick." rel=\"".$button->get('options')."\">".$button->get('text')."</a></div></div>\n";
				}
			}

			$return .= "</div>\n";
		}

		return $return;
	}

	function onDisplay($name, $content, $width, $height, $col, $row, $buttons = true)
	{
		JHTML::_('behavior.modal', 'a.modal-button');

		if (is_numeric($width)) {
			$width .= 'px';
		}

		if (is_numeric($height)) {
			$height .= 'px';
		}

		// AJE: Fixes for JForm based editors (jform[fieldname]).
		$id = $this->getEditorName($name);

		$html = '
		<textarea name="'.$name.'" id="'.$id.'" cols="'.$col.'" rows="'.$row.'" style="width:'.$width.'; height:'.$height.'">' .$content.   '</textarea>';

		$user = &JFactory::getUser();

		$fr = '';
		if (!strpos(JPATH_BASE,'administrator')) {
			$fr = '_ft';
		}

  		$html .= "<script type='text/javascript'>
		var ".$id." = CKEDITOR.replace('".$id."',
		{
			baseHref:  '".JURI::root()."',
			skin :     '".$this->params->get('skin',	'kama')."',
			language : '".$this->params->get('language','en')."',
			uiColor:   '".$this->params->get('bgcolor',	'#6B6868')."',
			";

  		if (stripos($this->params->get('toolbar'.$fr), 'Custom') !== false) {
  			$html .= "toolbar :[".$this->params->get(
  				'toolbar_'.$this->params->get(
					'toolbar'.$fr
				),
				"[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ]"
  			).'],';
  		}
  		else {
  			$html .= "toolbar : '".$this->params->get('toolbar'.$fr, 'Full')."',";
  		}

		$html .= "});
		";

		$html .= ";
		</script>";
		$html .= $this->displayButtons($id, $buttons);
		return $html;
	}

	/**
	 * Get the code to get the content in the editor.
	 *
	 * @param	string	$name	The name of the form control.
	 *
	 * @return	string
	 * @since	1.0.0
	 */
	function onGetContent($name)
	{
		$id = $this->getEditorName($name);

		return " CKEDITOR.instances.$id.getData(); ";
	}

	/**
	 * Get/inject the code to insert text into the editor.
	 *
	 * @param	string	$name	The name of the form control (not used).
	 *
	 * @return	string
	 * @since	1.0.0
	 */
	function onGetInsertMethod($name)
	{
		static $once = false;

		if (!$once) {
			$once	= true;
			$id		= $this->getEditorName($name);
			$doc	= JFactory::getDocument();

			$js		= "
			function jInsertEditorText(text, editor)
			{
				CKEDITOR.instances[editor].insertHtml(text);
				return true;
			}";

			$doc->addScriptDeclaration($js);
		}

		return true;
	}

	/**
	 * Initialise the editor.
	 *
	 * @return	string
	 * @since	1.0.0
	 */
	function onInit()
	{
		// Initialise variables.
		$doc = JFactory::getDocument();

		$doc->addStyleDeclaration("table.admintable {width: 100%;}");

  		$result = '<script type="text/javascript" src="'.JURI::root().'plugins/editors/artofeditor/ckeditor.js"></script>';

  		return $result;
	}

	/**
	 * Get/inject the code to copy the editor content to the form control.
	 *
	 * @param	string	$name	The name of the form control.
	 *
	 * @return	string
	 * @since	1.0.0
	 */
	function onSave($name)
	{
		return '';
	}

	/**
	 * @param	string	$name	The name of the form control.
	 * @param	string	$html
	 *
	 * @return	string
	 * @since	1.0.0
	 */
	function onSetContent($name, $html)
	{
		$id = $this->getEditorName($name);

		return "CKEDITOR.instances.$id.setData('$html');";
	}
}