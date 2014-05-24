<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 */
class ItemsController extends AppController {

    public $uses      = array( 'Item' , 'User' , 'Comment' , 'Cate' );
    public $layout    = 'review';
    public $paginate  = array( 'page'       => 1 ,
                               'conditions' => array( 'Item.delete_flg' => 0 ),
                               'limit'      => 6,
                               'sort'       => 'id',
                               'direction'  => 'desc',
                               'recursive'  => 2
                              );
    
    //componentはコントローラーの共通処理
    public $components = array( 'Common' , 'Cookie' , 'Session' ,'Auth');

    /**
     * index method
     *
     * @return void
     */    

    public function userinfo( $id = null ){
      
        $this->set( 'userinfo' , $userinfo = $this->User->userinfo( $id ) );
    }

    public function useritem( $id = null ){
        //登録アイテム情報
        $this->paginate['contain']    = array( 'Cate.cate' , 'User.id' , 'Comment' );
        $this->paginate['conditions'] = array( 'User.id' => $id );
        $this->set( 'userinfo' , $userinfo = $this->User->userinfo( $id ));
        $this->set( 'items' , $this->paginate() );
    }

    public function index( $key = null ) {
        //リレーションはほしい情報だけ取り出す
        $this->paginate['contain'] = array( 'Cate.cate' );
        $cates  = $this->Item->Cate->find( 'list' );
        
        $this->set( 'items' ,   $this->paginate() );
        $this->set( compact('cates' ) );
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view( $id = null ) {
        $this->Item->id = $id ;
        
        if ( !$this->Item->exists() ) {
            throw new NotFoundException(__('データが存在しません。'));
        }
        $this->set( 'item' , $this->Item->itemData( $id ));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        if ($this->request->is('post')) {
            
            $this->Item->create();
            if ( $this->Item->save( $this->request->data ) ) {
                $this->Session->setFlash(__('データの保存ができました'));
                
                $this->redirect( array( 'action' => 'index' , 0 ));
            } else {
                $this->Session->setFlash(__('データの保存に失敗しました。もう一度入力してください。'));
            }    
        }

        //子だけのモデル情報がほしいときはこのようにかく。親から入って子供だけの情報をとってくる
        $cates  = $this->Item->Cate->find( 'list' );
        $this->set( compact('cates' ) );
    }        
    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        
        $this->Item->id = $id;
        
        if (!$this->Item->exists()) {
            throw new NotFoundException(__('データが存在しません。'));
        }

        $this->request->data = $this->Item->read(null, $id);
        
        if( $this->Auth->user('id') !== $this->request->data['Item']['user_id'] )
        {
            throw new NotFoundException(__('このデータを編集する権限がありません。'));
        }


        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Item->save($this->request->data)) {
                $this->Session->setFlash(__('商品を無事保存することができました。'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('商品を保存することができませんでした。もう一度実行してください。'));
            }
        } else {
            $this->request->data = $this->Item->read(null, $id);
        }

        $cates = $this->Item->Cate->find('list');
        $this->set(compact('cates'));
        $this->render('add');
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Item->id = $id;
        if (!$this->Item->exists()) {
            throw new NotFoundException(__('データが存在しません。'));
        }else{

            $this->Item->saveField('delete_flg','1');
            $this->Session->setFlash(__('データを削除しました。'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('データの削除に失敗しました。'));
        $this->redirect(array('action' => 'index'));
    }

}
