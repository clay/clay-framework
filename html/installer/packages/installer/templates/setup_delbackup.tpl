<div class="app-head">Delete a Site Backup</div>
<div class="app-content">
<?php if(!empty($message)){?><h3><?php echo $message ;?></h3><?php } ?>
<form method="post" action="?com=setup&act=delbackup">
	<div style="float:left">
	<fieldset><legend>Delete backup of <?php echo $site; ?>?</legend>
		<p>Are you sure you want to delete this package installation?</p>
		<input type="hidden" name="site" id="site" value="<?php echo $site; ?>" /> <input type="hidden" name="confirm" id="confirm" value="1" />
		<input type="submit" name="submit" value="Yes, Delete <?php echo $site; ?>" id="submit" />
	</fieldset>
	</div>
</form>
</div>
<br style="clear:both" />