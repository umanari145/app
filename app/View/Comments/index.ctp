<div class="items view">
    <h2><?php  echo __('Item');?></h2>
    <?php	echo $userinfo['User']['username']."さんが書いたコメント<br>"; ?>
    <?php
    	echo $this->Paginator->counter(array(
    		'format' => __("{$userinfo['User']['username']}さんのコメント数:{:count}件 "),
    		'model'=>'Comment'
    ));
    ?>

    <dl>
    <?php foreach($comments as $comment):?>
    
    <dt>コメント</dt>
    <dd><?php echo $comment['Comment']['body']?></dd>
    <dt>コメントがついた商品</dt>
    <dd><?php echo $this->Html->link($comment['Item']['name'],array('controller'=>'items','action'=>'view',$comment['Item']['id']));?></dd>
    <?php
    endforeach;
    ?>
    </dl>

	<div class="paging">
	<?php
	
	        echo $this->Paginator->prev('< ' . __('前へ'), array(),null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('次へ') . ' >', array(),null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<!--左サイド-->
<?php echo $this->element('left'); ?>
