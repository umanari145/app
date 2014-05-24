<div class="items index">
    <h2><?php echo __('Items');?></h2>

    <div class="item_area clearFix">
        <?php
        foreach ($items as $item): ?>
        <ul>
            <li class="thumb"><?php echo $this->Html->image(IMG_LOAD_PATH_THUMB.$item['Item']['image'],array('url'=>"/items/view/".$item['Item']['id']));?></li>
            <li class="item_name">商品名<?php echo $this->Html->link($item['Item']['name'],array('action' => 'view', $item['Item']['id'])); ?>&nbsp;</li>
            <li>カテゴリ<?php echo h($item['Cate']['cate']); ?></li>
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
