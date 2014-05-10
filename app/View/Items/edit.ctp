<div class="items form">
<?php echo $this->Form->create('Item');?>
	<fieldset>
		<legend><?php echo __('Edit Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('body');
		echo $this->Form->input('image');
		echo $this->Form->input('cate_id');
		echo $this->Form->input('tag');
		echo $this->Form->input('used_time');
		echo $this->Form->input('score');
		echo $this->Form->input('delete_flg');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Item.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Item.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Cates'), array('controller' => 'cates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cate'), array('controller' => 'cates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
