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

/**
 * This is a JHtml element that displays a help message.
 *
 * @package		NewLifeInIT
 * @subpackage	plg_editors_ckeditor
 */
class JElementHelp extends JElement
{
	/**
	 * Element name
	 */
	public $_name = 'CKEditorHelp';

	/**
	 * Fetch the elements.
	 *
	 * @param	string	$name			The name of the variable.
	 * @param	string	$value			The value of the variable.
	 * @param	object	$node			The XML node defining the variable.
	 * @param	string	$controlName	The name of the HTML control that stores this variable.
	 *
	 * @return	string	The HTML representation of the control.
	 * @since	1.0.0
	 */
	function fetchElement($name, $value, &$node, $control_name)
	{
		switch ($node->attributes('style'))
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

		return '<div style="'.$style.'">'.
			JText::_($value).
			'</div>';
	}

	/**
	 * Fetch the tooltip for the variable label.
	 *
	 * @param	string	$label			The text for the label.
	 * @param	string	$description	The description associated with the label.
	 * @param	object	$xmlElement		The XML node defining the variable.
	 * @param	string	$controlName	The name of the HTML control that stores this variable (optional).
	 * @param	string	$name			The name of the variable (optional).
	 *
	 * @return	string	The HTML representation of the label including the tooltip.
	 * @since	1.0.0
	 */
	function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='')
	{
		return false;
	}
}