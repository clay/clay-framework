<?php
namespace claydo\property\form;
/**
* Clay Framework
*
* @copyright (C) 2007-2011 David L Dyess II
* @license GPL {@link http://www.gnu.org/licenses/gpl.html}
* @link http://clay-project.com
* @author David L Dyess II (david.dyess@gmail.com)
*/
\library('claydo/object/form');

class textarea extends \claydo\object\form {

	public $object = 'form';
	public $template = 'claydo/properties/form/textarea';
	public $label;
	public $content;

}

?>