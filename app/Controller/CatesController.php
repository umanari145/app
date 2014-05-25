<?php
App::uses('AppController', 'Controller');
/**
 * Cates Controller
 *
 * @property Cate $Cate
 */
class CatesController extends AppController {

    public $layout    = 'review';
/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Cate->recursive = 0;
        $this->set( 'cates' , $this->paginate() );
    }

/**
 * view method
 *
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        $this->Cate->id = $id;
        if (!$this->Cate->exists()) {
            throw new NotFoundException(__('Invalid cate'));
        }
        $this->set('cate', $this->Cate->read(null, $id));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->Cate->create();
            if ($this->Cate->save($this->request->data)) {
                $this->Session->setFlash(__('カテゴリーが無事登録できました。'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The cate could not be saved. Please, try again.'));
            }
        }
    }

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        $this->Cate->id = $id;
        if (!$this->Cate->exists()) {
            throw new NotFoundException(__('Invalid cate'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Cate->save($this->request->data)) {
                $this->Session->setFlash(__('The cate has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The cate could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Cate->read(null, $id);
        }
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
        $this->Cate->id = $id;
        if (!$this->Cate->exists()) {
            throw new NotFoundException(__('Invalid cate'));
        }
        if ($this->Cate->delete()) {
            $this->Session->setFlash(__('Cate deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Cate was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
