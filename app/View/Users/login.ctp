<div style="width: 500px;">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
    <?php echo $this->Form->input('username'); ?>
    <?php echo $this->Form->input('password'); ?>
    <?php echo $this->Form->submit('ログイン'); ?>
    <?php echo $this->Form->end(); ?>
    <?php echo $this->Html->link('新規登録する', array('action' => 'add')); ?> 
</div>
