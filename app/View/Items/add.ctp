<div class="items form">
<?php echo $this->Form->create('Item',array('type'=>'file'));?>
	<fieldset>
		<legend><?php echo __('商品投稿ページ'); 
?></legend>
<?php
		echo $this->Form->input('name',array('label'=>'商品名'));
		echo $this->Form->input('body',array('label'=>'記事'));
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$login_user_id));
		echo $this->Form->input('image',array('label'=>'画像1','type'=>'file'));
		echo $this->Form->input('image2',array('label'=>'画像2','type'=>'file'));
		echo $this->Form->input('image3',array('label'=>'画像3','type'=>'file'));
		echo $this->Form->input('cate_id',array('label'=>'カテゴリ','empty'=>'カテゴリを選んでください'));
?>
	</fieldset>
<input type="submit" id="ItemAdd" value="登録する">
</div>
<?php echo $this->element('left'); ?>
