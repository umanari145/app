<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $uses = array('User');

    public $components=array('Auth' => array(
        'loginRedirect' => array('controller' => 'items', 'action' => 'index'),
        'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
    )
);

    public function beforeFilter()
    {
       $this->Auth->allow('login','logout','add');
    }

    public function login() {

        if( $this->Auth->loggedIn()) {
            $this->redirect($this->Auth->redirect());
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            }else{
                $this->Session->setFlash('ログインに失敗しました。正しいユーザー名とパスワードを入力してください。', 'default', array(), 'auth');
            }
        }
    }
    
    
    public function add()
    {
        // POST の時だけ
        if ($this->request->is('post')) {
            if ($this->User->save($this->request->data)) {
                $this->redirect(array('action'=>'login'));
            } else {
                $this->Session->setFlash('登録に失敗しました。');
            }
        }

    }

    /**
     * ログアウト処理を行います
     */
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

}
