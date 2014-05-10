<div class="userinfos form">
<?php echo $this->Form->create('Userinfo' ,array( 'type' => 'file' )) ; ?>
	<fieldset>
		<legend><?php echo __('Add Userinfo'); ?></legend>
	<?php
		echo $this->Form->input('user_id' ,array( 'type'=>'hidden' ,'value' => $login_number ) );
		echo $this->Form->input('username');
		echo $this->Form->input('userimage' , array('type'=>'file'));
		echo $this->Form->input('contents');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
</div>
