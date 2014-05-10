<div id="login">
<p><?php echo $message; ?></p>
<?php if( $status === "regist" ) : ?>
<?php echo $this->Form->create("User"); 	
      echo $this->Form->input( "login_id", array('type'=>'text',    'label'=>'メールアドレス','size'=>'40')); 
      echo $this->Form->input( "yourname", array('type'=>'text',    'label'=>'ユーザー名','size'=>'40')); 	
      echo $this->Form->input( "pass"    , array('type'=>'password','label'=>'パスワード','size'=>'20')); 		
      echo $this->Form->input( "re_pass" , array('type'=>'password','label'=>'パスワード(確認のためにもう一度登録してください。)','size'=>'20')); 
      echo $passCheckMessage ;
      echo $this->Form->end("送信") 
?>
<?php endif ; ?>
</div>
<!--login end-->
