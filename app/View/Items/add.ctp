<div class="items form">
<?php echo $this->Form->create('Item',array('type'=>'file'));?>
	<fieldset>
		<legend><?php echo __('商品投稿ページ'); 
?></legend>
<?php
		echo $this->Form->input('name',array('label'=>'商品名'));
		echo $this->Form->label('user_id',"登録者<br>".$yourname);
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$login_number));
		echo $this->Form->input('body',array('label'=>'記事'));
		echo $this->Form->input('image',array('label'=>'画像1','type'=>'file'));
		echo $this->Form->input('image2',array('label'=>'画像2','type'=>'file'));
		echo $this->Form->input('image3',array('label'=>'画像3','type'=>'file'));
		echo $this->Form->input('cate_id',array('label'=>'カテゴリ','empty'=>'カテゴリを選んでください'));
		echo $this->Form->input('tags',array('type'=>'textarea','label'=>'タグ(下の候補一覧から選ぶか、カンマで区切って直接入力してください。)'));
		//配列名をtagsなどとすると左サイドのデータを持ってきてしまうので
		//別の値で。
        if( !empty($tagArr ) ){
            echo "<ul>" ;
		    foreach($tagArr as $tag) echo'<li class="tag"> '.$tag.' </li>';
		    echo "</ul>" ;
        }
?>
	</fieldset>
<input type="submit" id="ItemAdd" value="登録する">
</div>
<?php echo $this->element('left'); ?>
