<?php
\Library('Clay/Styles');
\clay\styles::addApplication('common','system/styles.css');
\clay\styles::addTheme('ctx-1','style.css');
\Library('Clay/Scripts');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <title><?php $this->pageTitle() ?></title>
    <?php
	\clay\styles::css();
	\clay\scripts::js('head');
	?>
  </head>
  <body>
    <div class="ctx-body">
        <div class="ctx-header">
          <h1><?php echo $this->siteName; ?></h1>
        </div>
        <div class="ctx-container">
	        <div class="ctx-left-column">
			<?php $this->template(array('application' => 'common','template' => 'menu', 'data' => \installer\application::menu()))?>
	        </div>
	        <div class="ctx-main ctx-middle">
	        <?php $this->template('main'); ?>
	        </div>
        </div>
        <div class="ctx-footer">
        <h4><?php echo clay::name.' '.clay::version.' Build '.clay::build . ' "'.clay::cname.'"'; ?></h4>
        </div>
    </div>
    <?php \clay\scripts::js('body'); ?>
  </body>
</html>