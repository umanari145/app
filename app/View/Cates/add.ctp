<div class="cates form">
<?php echo $this->Form->create('Cate') ; ?>
	<fieldset>
		<legend><?php echo __('カテゴリーを追加する'); ?></legend>
	<?php
		echo $this->Form->input('cate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('登録する')); ?>
</div>
<?php echo $this->element('left'); ?>
