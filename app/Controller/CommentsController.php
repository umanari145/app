<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {

    public $uses       = array( 'Comment' , 'Item' , 'User' );
    public $layout     = 'review';
    public $components = array('Common') ;
    public $paginate   = array(
                               'page'       => 1 ,
                               'conditions' => array( 'Comment.delete_flg' => 0),
                               'limit'      => 5,
                               'sort'       => 'id',
                               'direction'  => 'desc',
                               'recursive'  => 2
                              );

/**
 * index method
 *
 * @return void
 */
    
    public function index( $id = null ) {

        $this->paginate['contain'] = array( 'Item.name' , 'User.id' );
        $this->paginate['fields']  = array('body');
        
        $this->set( 'userinfo' , $userinfo = $this->User->userinfo( $id ) );
        $this->set( 'comments' , $this->paginate( array( 'User.id' => $id ) ) );
    }

/**
 * view method
 *
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException(__('Invalid comment'));
        }
            $this->set('comment', $this->Comment->read(null, $id));
    }

/**
 * add method
 *
 * @return void
 */
    
    public function add($id = null){

        $id = $this->request->data['comment']['item_id'];
        $this->Comment->create();
        if($this->Comment->save( $this->request->data['comment'] )){
            $this->Session->setFlash(__('コメントを追加しました。'));
        }else{
            $this->Session->setFlash(__('コメントが追加できませんでした。'));
        };
        $this->redirect( array( 'controller' => 'items' , 'action' => 'view' , $id ) );
    }

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException(__('Invalid comment'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash(__('The comment has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Comment->read(null, $id);
        }
        $users = $this->Comment->User->find('list');
        $this->set(compact('users'));
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
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException(__('Invalid comment'));
        }
        if ($this->Comment->delete()) {
            $this->Session->setFlash(__('Comment deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Comment was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
