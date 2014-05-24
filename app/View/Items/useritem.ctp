<div class="items view">
    <h2><?php  echo __('Item');?></h2>
    <?php	echo $userinfo['User']['username']."さんが登録したアイテム<br>"; ?>
    <?php
    	echo $this->Paginator->counter(array(
    	'format' => __("{$userinfo['User']['username']}さんは{:count}件の商品を登録しています。 ")
    ));
    ?>
    


    <?php foreach($items as $item):?>
    <dl>
    <dt>商品名</dt>
    <dd><?php echo $this->Html->link($item['Item']['name'],array('action'=>'view',$item['Item']['id']));?></dd>
    <dt>商品記事</dt>
    <dd><?php echo $item['Item']['body'];?></dd>
    <dt>写真</dt>
    <dd><?php echo $this->Html->image(IMG_LOAD_PATH.$item['Item']['image'],array('width'=>'20%','height'=>'20%'));?></dd>
    <dt>カテゴリ</dt>
    <dd><?php echo $item['Cate']['cate'];?></dd>
    <dt>登録日</dt>
    <dd><?php echo $item['Item']['created'];?></dd>
    <hr>
    </dl>
    <?php
    endforeach;
    ?>

	<div class="paging">
	<?php
	
	    echo $this->Paginator->prev('< ' . __('前へ'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('次へ') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>

</div>
<!--左サイド-->
<?php echo $this->element('left'); ?>
