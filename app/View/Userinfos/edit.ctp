<div class="userinfos form">
<?php echo $this->Form->create('Userinfo'); ?>
	<fieldset>
		<legend><?php echo __('Edit Userinfo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('username');
		echo $this->Form->input('userimage');
		echo $this->Form->input('contents');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Userinfo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Userinfo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Userinfos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
