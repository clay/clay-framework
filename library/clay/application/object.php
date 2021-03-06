<?php
namespace clay\application;
/**
 * Clay Framework
 *
 * @copyright (C) 2007-2010 David L Dyess II
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @link http://clay-project.com
 * @author David L Dyess II (david.dyess@gmail.com)
 * @package Clay Integrated Application Controller Object
 */

/**
 * An integrated Controller and View library - this library is the backbone for Applications and Themes
 *
 */
abstract class object {
	# Most of these are only applicable when the child class is the primary application (acting as the controller).
	public $defaultApp; # Is this the default application? true or false
	public $template = ''; # Alternate Component Actions display template (optional)
	public $theme; # The current Theme (see also constant \clay\THEME) *
	public $page; # Page template *
	public $pageTitle;
	public $siteName;
	public $siteSlogan;
	private static $initiated = null; # null until the Page template is loaded. !null means it's too late to change most properties above.
	# * If Child class is the primary application
	/**
	 * Takes an array of settings and transforms them into class properties
	 * @param array $settings
	 */
	public function inject($settings){
		if(empty(self::$initiated)){
			foreach($settings as $setting => $value){
				$this->$setting = $value;
			}
		}
	}
	/**
	 * Loads the Page template from the current Theme
	 */
	public function page(){
		if(empty(self::$initiated)){
			include \clay\THEMES_PATH.$this->theme.'/pages/'.$this->page.'.tpl';
			self::$initiated = true;
		}
	}
	/**
	 * Calls a specified $action of the child class
	 * @param string $action - child class method
	 * @param array $args - parameters to pass to the Action
	 * @return array - used by template() to display the Action's template
	 */
	public function action($action='',$args=array()){
		if(empty($action)){
			return $this->primary;
		}
		$namespace = \explode('\\',get_class($this)); # [0] => 'application' [1] => $application [2] => $component
		try {
			if(!method_exists($this,$action)) throw new \Exception('Application method ' . get_class($this) . '::' . $action . '() does not exist.');
			# Pass $args to the function as parameter
			$appdata = $this->$action($args);
			# If $this->template is set as NULL, we do not want to display anything.
			if(is_null($this->template)) {
				$this->template = '';
				# Return null
				return;
			}
			# This allows us to use more than one action/template within a single component object (hopefully)
			$template = $this->template;
			$this->template = '';
			# Build array for passing to template()
			return array('application' => $namespace[1], 'template' => !empty($template) ? $template : $namespace[2].'_'.$action, 'data' => $appdata);
		} catch(\Exception $e){
			# Pass the Exception template and info instead
			return array('application' => 'common', 'template' => 'system/exception', 'data' => array('exception' => $e));
		}
		# ! We never get this far... I guess we don't need this?  Leaving it as a reminder to investigate later.
		$this->template = ''; # Empty the template setting so the next action called isn't forced to use the same template.
	}
	public function pageTitle(){

			echo (!empty($this->defaultApp) || empty($this->pageTitle)) ? $this->siteName.' :: ' . $this->siteSlogan : $this->pageTitle.' :: ' . $this->siteName;

	}
	
	/**
	* Object wrapper Method for Static \clay\application::template()
	* Object template method for Applications. This allows templates to assume $this is in context.
	* Splitting template() into 2 methods (static and object) was done to obtain PHP Strict Standards compliance.
	* @param array $args or string 'main' (for primary application area in Page template)
	*/
	public function template($args=array()){
		# For redirects or other desired reasons not to include a template (component used $this->template = NULL)
		if(is_null($args)) return;
		# That wasn't necessary, but why let it keep going?
		#'main' is often used in the Theme Page template for the primary application area.
		if($args === 'main'){
			$args = $this->primary;
		}
		# Let the Static method do the rest.
		$template = \clay\application::template($args);
		# If nothing was found, stop here.
		if(empty($template['tpl'])) return;
		# If the supplied template data is an array, we extra each array key into it's own variable.
		if(is_array($template['data'])) extract($template['data']);
		# Here's Johnny
		include $template['tpl'];
	}	
}