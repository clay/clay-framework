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
\Library('ClayDO/property/form/select');

class multiselect extends \claydo\property\form\select {
	
	public $object = 'form';
	public $label;
	# <option> tags - options[] array('value' => x, 'content' => y, 'selected' => z)
	public $options = array();
	public $template = 'claydo/properties/form/multiselect';

}

?>