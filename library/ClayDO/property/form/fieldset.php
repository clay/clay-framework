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
\Library('ClayDO/object/form');

class fieldset extends \claydo\object\form {
	
	public $object = 'form';
	public $legend;
	public $intro;
	public $template = 'claydo/properties/form/fieldset';

}

?>