<div class="items view">
     <div id="js_info">
         <p id="welcome"><?php echo $login_id; ?></p>
         <p id="login_number"><?php echo $login_number; ?></p>
         <p class="Itemid"><?php echo $item['Item']['id'] ; ?></p>
    </div>
    <!--js_info -->

    <h2><?php  echo __('Item');?></h2>
   
    <?php echo $this->element('userinfo');?>
    
    <div id="item_info">
        <div id="view_image">
            
            <p>商品名：<?php echo  h($item['Item']['name']); ?>:<?php echo h($item['Item']['created']); ?>登録</p>
            <p>クリックすると拡大されます</p>
            <?php 
            $image_info=getimagesize(IMG_LOAD_PATH.$item['Item']['image']);
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
         <p>タグ：<?php foreach($item['Tag'] as $tag):?>
                  <span><?php echo $tag['tag'] ?></span>
                  <?php endforeach;?>		
         </p>
    </div>   
    <!--item_info end -->
   
    <hr>
    
    <div id="score">
    
        <!--投票データ-->
        <div id="public_vote">
            <fieldset><legend>みんなの評価</legend>
            <?php  if($totalVote['cnt'] > 0 ): ?>

                <?php foreach($votes as $key => $vote): ?>
                    <p>
                        <?php echo $key+1 ; ?>点 :
                        <?php 
                        //投票数分だけ横棒を伸ばす
                        if($vote !== 0) echo $this->Html->image( URL . '/cake/img/g.jpg',array('width'=>20*$vote,'height'=>15));
                        ?>
                        <?php echo $vote?>人
                    </p>

                <?endforeach;?>

                <p>ただいま<?php echo $totalVote['cnt'];?>人がこの商品を評価しており、
                平均<?php echo number_format($totalVote['voteAVG'],1);?>点です。</p>

            <?php else:?>

                <p>この商品に投票している人はまだいません。</p>

            <?php endif;?>
            </fieldset>
        </div>
        <!--public_vote end --> 


        <!--すでに投票しているかどうかのフラグ。falseだったら投票できる-->
        <?php if( $voteflg === false ): ?>

            <?php
            echo $this->Form->create('vote',array('action'=>'add'));
            echo $this->Form->input('login_id',array('type'=>'hidden','value'=>$login_id));
            echo $this->Form->input('item_id',array('type'=>'hidden','value'=>$item['Item']['id']));
            echo $this->Form->input('vote_point',array('legend' => 'この商品を評価する','type'=>'radio','options' => array('1'=>'1点','2'=>'2点','3'=>'3点','4'=>'4点','5'=>'5点')));?>
            <input type="submit" id="valuation" value="評価">
            </form>
    
        <?php else:?>

            <h3>投票ありがとうございました！</h3>

        <?php endif;?>
        
        <hr>
        
        <!--コメント-->
        <div id="view_comment">
            <?php	 
            echo $this->Form->create('comment',array('action'=>'add')); 
            echo $this->Form->hidden('user_id',array('value'=>$login_number)); 
            echo $this->Form->hidden('item_id',array('value'=>$item['Item']['id'])); 
            echo $this->Form->input('body',array('label'=>'コメント'));
            ?>
            <input type="submit" id="CommentAdd" value="コメントする">
            
            <div id="comments">
                <?php if (!empty($item['Comment'])):?>
                    <?php $comments=krsort($item['Comment']);

                    foreach ($item['Comment'] as $key => $comment): ?>

                        <p id="com<?=$key?>"><?php echo h($comment['body']);?><br>
                        <?php echo $this->Html->link($comment['User']['login_id'],array('action'=>'userinfo',$comment['User']['id']));?>
                        </p>

                    <?php endforeach; ?>

                <?php endif; ?>
            </div>
            <!--comments end-->
        </div>
        <!--view_comment-->

    </div>  
    <!--score end-->
    
</div><!--item viewend-->
<!--左サイド-->
<?php echo $this->element('left'); ?>

