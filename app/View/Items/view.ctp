<div class="items view">

    <h2><?php  echo __('Item');?></h2>
   
    <?php echo $this->element('userinfo');?>
    
    <div id="item_info">
        <div id="view_image">
            
            <p>商品名：<?php echo  h($item['Item']['name']); ?>:<?php echo h($item['Item']['created']); ?>登録</p>
            <p>クリックすると拡大されます</p>
            <?php 
            $image_info = getimagesize(IMG_LOAD_PATH.$item['Item']['image']);
            //imageヘルパーだとurlの中にidをいれられないため直書き
            echo '<li><p><a href='.IMG_LOAD_PATH.$item['Item']['image'].'  width='.$image_info[0].'  height='.$image_info[1].'  class="modal">';
            echo $this->Html->image(IMG_LOAD_PATH_THUMB.$item['Item']['image']);
            echo '</a></p></li>';
            
            //2枚目
            if($item["Item"]["image2"] !==  null ) {
            	echo '<li><p><a href='.IMG_LOAD_PATH.$item['Item']['image2'].' class="modal">';
            	echo $this->Html->image(IMG_LOAD_PATH_THUMB.$item['Item']['image2']);
            	echo '</a></p><li>';
            }

            //３枚目
            if($item["Item"]["image3"] !==  null ){ 
            	echo '<li><p><a href='.IMG_LOAD_PATH.$item['Item']['image3'].' width='.$image_info[0].'  height='.$image_info[1].' class="modal">';
            	echo $this->Html->image(IMG_LOAD_PATH_THUMB.$item['Item']['image3']);
            	echo '</a></p></li>';
            }
            ?>

         </div>
         <!--view_image end-->

         <p><?php echo h($item['Item']['body']); ?></p>
         <p>カテゴリ：<?php echo h($item['Cate']['cate']); ?></p>
    </div>   
    <!--item_info end -->
   
    <hr>
    
        <!--コメント-->
        <div id="view_comment">
            <?php	 
            echo $this->Form->create('comment',array('action'=>'add')); 
            echo $this->Form->hidden('username',array('value'=>$login_username)); 
            echo $this->Form->hidden('user_id',array('value'=>$login_user_id)); 
            echo $this->Form->hidden('item_id',array('value'=>$item['Item']['id'])); 
            echo $this->Form->input('body',array('label'=>'コメント'));
            ?>
            <input type="button" id="CommentAdd" value="コメントする">
            
            <div id="comments">
                <?php if (!empty($item['Comment'])):?>
                    <?php $comments=krsort($item['Comment']);

                    foreach ($item['Comment'] as $key => $comment): ?>

                        <p id="com<?=$key?>"><?php echo h($comment['body']);?><br>
                        <?php echo $this->Html->link($comment['User']['username'],array('action'=>'userinfo',$comment['user_id']));?>
                        </p>

                    <?php endforeach; ?>

                <?php endif; ?>
            </div>
            <!--comments end-->
        </div>
        <!--view_comment-->
    
</div><!--item viewend-->
<!--左サイド-->
<?php echo $this->element('left'); ?>

