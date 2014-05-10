<!--sidebar-->
<div id="sidebar">
    
    <!--login_form-->
    <div id="login_form">
        <p id="hello_message">ようこそ<?php echo $yourname; ?>さん</p>
        <?php if($login_id === "ゲスト"):?>
        <ul>
            <?php echo $this->Form->create("User" , array( 'controller' => 'user' , 'action' => 'index' ) ); ?>
            <?php echo $this->Form->input("login_id",array('type'=>'text','label'=>'メールアドレス','size'=>'20'));
                  echo $this->Form->input("pass",array('type'=>'password','label'=>'パスワード','size'=>'20'));
                  echo $this->Form->input("iscookie",array('type'=>'checkbox','label'=>'ログインしたままにする'));
                  echo $this->Form->end("ログインする")
            ?>
            <p id="regist"><?php echo $this->Html->link(__('新規登録をする'), array( 'controller'=>'users' , 'action' => 'regist')); ?></p>
        </ul>
        <?php else:?>
        <p><?php echo $this->Html->link("ログアウトする",array('controller'=>'items','action'=>'index','?'=>array("logout"=>1))); ?>
        </p>
        <?php endif ;?>
    </div>
    <!--login_form end-->
    
    <!--item_regist-->
    <div id="item_regist">
        <h3><?php echo __('商品を登録する'); ?></h3>
        <p><?php echo $this->Html->link(__('商品を登録する'), array('controller'=>'items','action' => 'add')); ?></p>
    </div>
    <!--item_regist end -->
    
</div>
<!--sidebar end-->
