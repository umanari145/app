<p><?php echo $message ; ?></p>
<div id="login">
<?php echo $this->Form->create("User") ; 	
      echo $this->Form->input("login_id",array('type'=>'text','label'=>'メールアドレス','size'=>'40')); 	
      echo $this->Form->input("pass",array('type'=>'password','label'=>'パスワード','size'=>'20')); 		
      echo $this->Form->input("iscookie",array('type'=>'checkbox','label'=>'ログインしたままにする')); 
      echo $this->Form->end("ログインする") 
?>
    <p id="regist"><?php echo $this->Html->link(__('新規登録をする'), array('action' => 'regist')); ?></p>
</div>
<!--login end-->
