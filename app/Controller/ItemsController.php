<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 */
class ItemsController extends AppController {

    public $uses      = array( 'Item' , 'User' , 'Comment' , 'Tag' , 'ItemsTag' , 'Vote' , 'Cate' );
    public $layout    = 'review';
    public $paginate  = array(
                               'page'       => 1 ,
                               'conditions' => array( 'Item.delete_flg' => 0 ),
                               'limit'      => 6,
                               'sort'       => 'id',
                               'direction'  => 'desc',
                               'recursive'  => 2
                              );
    
    //componentはコントローラーの共通処理
    public $components = array( 'Common' , 'Cookie' , 'Session' );

    /**
     * index method
     *
     * @return void
     */    
    //全体の共通設定はここで書く
    public function beforeFilter (){
        parent::beforeFilter();
    }

    public function beforeRender(){
        parent::beforeRender();
    }

    public function userinfo( $id = null ){

        $this->set( 'userinfo' , $userinfo = $this->User->userinfo( $id ) );
    }

    public function useritem( $id = null ){
        //登録アイテム情報
        $this->paginate['contain']    = array( 'Cate.cate' , 'User.login_id' , 'Comment' , 'Tag.tag' );
        $this->paginate['conditions'] = array( 'User.id' => $id );
        $this->set( 'userinfo' , $userinfo = $this->User->userinfo( $id ));
        $this->set( 'items' , $this->paginate() );
    }

    public function index( $key = null ) {
        //リレーションはほしい情報だけ取り出す
        $this->paginate['contain'] = array( 'Cate.cate' , 'Tag.tag' , 'Vote.vote_point' );

  

       //ソート機能
        $sortKey    = ( isset( $_GET['sortKey'] ) === true ) ? $_GET['sortKey'] : '0' ;
        $sortKeyArr = array( 'id' , 'score' , 'comment_count' , 'counter' );
        $this->paginate['sort'] = $sortKeyArr[$sortKey];
        //タグのソート検索
        if( isset( $this->request->query["tag"] ) === true ){
            //$tagSortKey=$this->request->query["tag"];
            //$this->ItemsTag->find()

        }

        //検索窓に文字があった場合
        if( isset( $this->request->query['word'] ) === true && trim( $this->request->query['word'] ) !== "" ){    
            
            $word = $this->request->query['word'];
            $this->paginate['conditions'] = array( 'or' => array(
                                                                  array('Item.body Like' => "%$word%" ),
                                                                  array('Item.name Like' => "%$word%" )
                                                                )
                                                  );
            $this->set( 'word' , $word );
        }
           


        //カテゴリ検索あった場合はここで絞り込み
        //ただしインデックスは０表記
        if( $key !== null && $key !== "0" ) $this->paginate['conditions'] = array( 
                                                                                   'Item.delete_flg' => 0 , 
                                                                                   'Item.cate_id'    => $key
                                                                                  );
        
        
        $cates  = $this->Item->Cate->find( 'list' );
        
        $this->set( 'items' ,   $this->paginate() );
        $this->set( 'sortKey' , $sortKey );
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

        //カウンターの増加
        $this->Item->addCount( $id );

        $login_id = $this->Common->getLogin_id();
        
        $this->set( 'voteflg'  , $this->Vote->hasAny( array( 'login_id' => $login_id , 'item_id'=>$id )));
        $this->set( 'votes'    , $this->Vote->voting( $id ));
        $this->set( 'totalVote', $this->Vote->votingAv( $id ));
        $this->set( 'item'     , $this->Item->itemData( $id ));
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

                if( $this->request->data["Item"]["tags"] !== "" ){

                    //タグデータを挿入、新しいものは登録、そしてtagidをひっぱってくる
                    $tagNumber = $this->Tag->addTag( $this->request->data["Item"]["tags"] );
                    $item_id   = $this->Item->getLastInsertID();
                    //ここで多対多のリレーションテーブルにデータを入力
                    foreach( $tagNumber as $value ) $this->ItemsTag->save( array( 'item_id' => $item_id , 'tag_id' => $value ) );
                }

                $this->Session->setFlash(__('データの保存ができました'));
                //0にしないと検索が引っかかる
                $this->redirect( array( 'action' => 'index' , 0 ));
            } else {
                $this->Session->setFlash(__('データの保存に失敗しました。もう一度入力してください。'));
            }    
        }
        //子だけのモデル情報がほしいときはこのようにかく。親から入って子供だけの情報をとってくる
        $tagArr = array();
        $tagArr = $this->Tag->find( 'list' );
        $cates  = $this->Item->Cate->find( 'list' );
        $this->set( compact('cates' ) );
        $this->set( 'tagArr' , $tagArr );
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
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Item->save($this->request->data)) {
                $this->Session->setFlash(__('The item has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The item could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Item->read(null, $id);
        }
        $cates = $this->Item->Cate->find('list');
        $this->set(compact('cates'));
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
