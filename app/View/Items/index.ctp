<div class="items index">
    <h2><?php echo __('Items');?></h2>

    <div id="research">
        <div id="word_box">
        <?php
        echo $this->Form->create('Items',array('action'=>'index','type'=>'get')); ?>
        <ul>
            <li><?php echo $this->Form->input('word' ,array( 'label' => 'キーワード', 'value' => @$word )) ; ?></li>
            <li><?php echo $this->Form->input('cate_id',array('label'=>'カテゴリ','empty'=>'カテゴリを選んでください')); ?></li>
            <li><?php echo $this->Form->input('sortKey',array('label'=>'並び順','options'=>array('新しい順','評価の高い順','コメントの多い順','参照数の多い順'),'selected'=>array('value'=>$sortKey))); ?></li>
        </ul>
        <?php echo $this->Form->end("検索する"); ?>
        </div>
        <!--word_box end-->

    </div>
    <!--research end-->

    <div id="research_result">
    <?php
    if(isset($word)===true){ 
        echo $this->Paginator->counter(array(
                    'format' => __("{$word}で検索中。<br>{:count}件の商品が見つかりました。 ")
                    ));
    }	
    /*echo $this->Paginator->counter(array(
      'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
      ));*/
    ?>
    </div>
    <!--research_result end-->
    
    <div class="item_area clearFix">
        <?php
        foreach ($items as $item): ?>
        <ul>
            <li class="thumb"><?php echo $this->Html->image(IMG_LOAD_PATH_THUMB.$item['Item']['image'],array('url'=>"/items/view/".$item['Item']['id']));?></li>
            <li class="item_name">商品名<?php echo $this->Html->link($item['Item']['name'],array('action' => 'view', $item['Item']['id'])); ?>&nbsp;</li>
            <li>カテゴリ<?php echo h($item['Cate']['cate']); ?></li>
            <li>タグ<?php foreach($item['Tag'] as $tag):?>
               <span><?php echo $tag['tag'] ?></span>
               <?php endforeach ; ?>
            </li>
            <li>みんなの評価
            <?php 
               //ユーザー評価
               if(count($item['Vote']) >0 ){
                   $voteScore=0;
                   foreach($item['Vote'] as $vote){
                       $voteScore += $vote["vote_point"];
                   }
                   echo $voteScore/count($item['Vote'])."点";
               }else{
                   echo "評価なし";
               }
               
               ?>
            </li> 
            <li><?php echo h($item['Item']['created']); ?>&nbsp;</li>
        </ul>
        <?php endforeach;?>		
    </div>
    <!--items_area end-->
    
    <div class="paging">
    <?php
    
    echo $this->Paginator->prev('< ' . __('前へ'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('次へ') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
    </div>
    <!--paging end-->

</div>
<!--items index end-->
<?php echo $this->element('left'); ?>
