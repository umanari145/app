<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

//ここには全処理共通の処理を書く。
//主にログイン時やユーザー権限の情報など
class AppController extends Controller {
   public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'items', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
        )
    );

   public function beforeFilter() 
   {
        if( !$this->Auth->loggedIn() )
        {
             $this->redirect(array('controller'=>'users','action' => 'login'));
        }
   }

   public function beforeRender(){ 
       if( $this->Auth->user('id') !== null ){
           $this->set('login_user_id' , $this->Auth->user('id') );
           $this->set('login_username' , $this->Auth->user('username') );
       }
   }
}
