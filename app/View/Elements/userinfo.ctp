<div id="regist_info">
	<table>
		<tr><td>登録者の情報</td></tr>
		<tr><td>登録者 <?php echo $item['User']['yourname']?></td></tr>
		<tr><td><?php echo $this->Html->link("この登録者の商品を見る",array('action'=>'useritem',$item['User']['id'])); ?></td></tr>
		<tr><td><?php echo $this->Html->link("この登録者のコメントを見る",array('controller'=>'comments','action'=>'index',$item['User']['id'])); ?></td></tr>
	</table>
</div>
