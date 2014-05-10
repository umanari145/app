ユーザー情報<br>
<dl>
<dt>ID</dt><dd><?php   echo $userinfo['User']['id']; ?></dd>
<dt>yourname</dt><dd><?php   echo $userinfo['User']['yourname']; ?></dd>
</dl>
<hr>

<?php echo $this->Html->link("{$userinfo['User']['yourname']}さんの登録アイテムを見る",array('controller'=>'items','action'=>'useritem',$userinfo['User']['id']))?><br>
<?php echo $this->Html->link("{$userinfo['User']['yourname']}さんのコメントを見る",array('controller'=>'comments','action'=>'index',$userinfo['User']['id']))?>

