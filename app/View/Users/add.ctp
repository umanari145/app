<div class="admin form">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
    <?php echo $this->Form->input('username'); ?>
    <?php echo $this->Form->input('password'); ?>
    <?php echo $this->Form->input('role', array('options' => array('admin' => '管理者', 'staff' => 'スタッフ', 'customer' => 'お客様'))); ?>    
    <?php echo $this->Form->submit('ログイン'); ?>
    <?php echo $this->Form->end(); ?>
</div>
