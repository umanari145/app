<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('review');
		echo $this->Html->script('jquery-1.7.2.min.js'); 
		//echo $this->Html->script('jquery-ui-1.8.22.custom.min.js'); 
		echo $this->Html->script('javascript.js'); 
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
?>
</head>
<body>
	<div id="backline">

        <div id="container">

	    	<div id="header">
	    		<h1>ワンちゃんのサイトです。</h1>
                <ul>
                    <li>メニュー1</li>
                    <li>メニュー2</li>
                    <li>メニュー3</li>
                    <li>メニュー4</li>
                </ul>
	    	</div>
            <!--header end-->

	    	<div id="content">
	    		<div id="loading"></div>
                <!--loading end-->

	    		<div id="complete_message"></div>
                <!--complete_message end -->

	    		<?php echo $this->Session->flash(); ?>
	    		<?php echo $this->fetch('content'); ?>
	    	</div>
            <!-- content end-->
            
	    	<div id="footer">
	    		<?php echo $this->Html->link(
	    				$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
	    				'http://www.cakephp.org/',
	    				array('target' => '_blank', 'escape' => false)
	    			);
	    		?>
	    	</div>
            <!--footer end -->
	    </div>
        <!-- container end-->
    </div>
    <!--backline end -->
</body>
</html>
