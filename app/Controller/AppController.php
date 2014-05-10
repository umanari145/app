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

    public $uses       = array( 'Item' , 'User' , 'ItemsTag' , 'Tag' , 'Usermanagement'  );
    public $components = array( 'Common' , 'Cookie' , 'Session' );

    //ログインidも全処理で共通
    public function beforeFilter (){

        //ログアウトしたときはクッキーとセッションを消す。
        if( isset( $this->request->query["logout"] ) === true ){
            $this->Cookie->delete('login_id');
            $this->Session->delete('login_id');
        }

        $login_id = $this->Common->getLogin_id();
        
        //ゲスト以外はidとstatusの取り出し
        if( $login_id !== "ゲスト" ){
            $key         = $this->User->find( 'first' , 
                                              array( 'conditions' => array( 'login_id' => $login_id ) , 
                                                     'fields'     => array( 'User.id' , 'User.status' ) 
                                                    )
                                            );
        
            $yourname_tmp         = $this->User->find( 'first' , 
                                              array( 'conditions' => array( 'login_id' => $login_id ) , 
                                                     'fields'     => array( 'User.yourname' ) 
                                                    )
                                            );
            
            $yourname = $yourname_tmp["User"]["yourname"];

            $status_data = $this->User->find( 'first' , 
                                              array( 'conditions' => array('login_id'=>$login_id),
                                                     'fields'     => array('User.status')
                                                    )
                                            );
        
            $status      = $status_data["User"]["status"];
      
        }else{
            $key['User']['id'] = "";
            $status            = "guest";
            $yourname ="ゲスト";
        }
        //ユーザー権限の管理　admin/user/guestによって制限がかかるページをここで制御 許可ない場合にはあらかじめ登録された別ページに飛ぶ
        //guest=>新規登録画面　member=>商品一覧ページ
        $userPermissionAccount = $this->Usermanagement->UserPermission( $this->request->params["controller"] ,
                                                                        $this->request->params["action"] , 
                                                                        $status
                                                                       );
		if( !$userPermissionAccount["Usermanagement"]["permit_flg"] && $status === "guest" ){
            $this->redirect( array( 'controller' => 'users', 'action' =>'index') );
        }elseif( !$userPermissionAccount["Usermanagement"]["permit_flg"] && $status === "member" ){
            $this->redirect( array( 'controller' => 'items' , 'action' => 'index' ));
        }
        
        $this->set( 'yourname' , $yourname );
        $this->set( 'login_id' , $login_id );
        $this->set( 'login_number' , $key['User']['id'] );

    }

    //サイドのタグは全処理で共通
    public function beforeRender(){
        $login_id = $this->Common->getLogin_id();

        $this->set( 'item_count' , $this->Item->find('count') );
        $this->set( 'catelinks' , $this->Item->cateList() );
        $this->set( 'tags' , $this->ItemsTag->sideTag() );
    }
}
