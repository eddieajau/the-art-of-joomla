<?php
/**
 * @version		$Id: ckeditor.php 1.2 28-09-2009 Danijar
 * @package		NewLifeInIT
 * @subpackage	plg_editors_ckeditor
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @author		Andrew Eddie <andrew.eddie@newlifeinit.com>
 * @link		http://www.theartofjoomla.com/extensions/artof-editor.html
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.form.formfield');

/**
 * This is a JHtml element that displays a help message.
 *
 * @package		NewLifeInIT
 * @subpackage	plg_editors_ckeditor
 */
class JFormFieldNote extends JFormField
{
	/**
	 * Element name
	 */
	public $_name = 'Note';

	/**
	 * Method to get the field label markup.
	 *
	 * @return	string	The field label markup.
	 * @since	1.0.3
	 */
	function getLabel()
	{
		switch ($this->element['style'])
		{
			case 'notice':
				$style = 'background: #d2edc9;border: 1px solid #90e772;color: #2b7312;padding: 8px 10px;margin:0;';
				break;

			case 'warning':
				$style = 'background: #FFF3A3;border: 1px solid #E7BD72;color: #B79000;padding: 8px 10px;margin:0;';
				break;

			case 'heading':
				$style = 'font-size:12px;font-weight:bold;color:#333;text-align:left;border-bottom: 1px solid #808080;border-left:1px solid #808080;padding: 5px 10px;margin:0;';
				break;

			default:
				$style = 'margin:0; padding: 8px 10px;';
				break;
		}

		return '<div class="clr"></div><div style="'.$style.'">'.
			JText::_($this->value).
			'</div>';
	}

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.0.3
	 */
	function getInput()
	{
		return null;
	}
}