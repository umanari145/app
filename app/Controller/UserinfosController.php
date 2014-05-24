<?php
App::uses('AppController', 'Controller');
/**
 * Userinfos Controller
 *
 * @property Userinfo $Userinfo
 * @property CommonComponent $Common
 */
class UserinfosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Common');
        public $uses = array('Userinfo');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Userinfo->recursive = 0;
		$this->set('userinfos', $this->paginate());
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Userinfo->id = $id;
		if (!$this->Userinfo->exists()) {
			throw new NotFoundException(__('Invalid userinfo'));
		}
		$this->set('userinfo', $this->Userinfo->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
	
	if ($this->request->is('post')) {
          	       $this->Userinfo->create();
                        if ($this->Userinfo->save($this->request->data)) {
				$this->Session->setFlash(__('The userinfo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userinfo could not be saved. Please, try again.'));
			}
		}
		$users = $this->Userinfo->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Userinfo->id = $id;
		if (!$this->Userinfo->exists()) {
			throw new NotFoundException(__('Invalid userinfo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Userinfo->save($this->request->data)) {
				$this->Session->setFlash(__('The userinfo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userinfo could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Userinfo->read(null, $id);
		}
		$users = $this->Userinfo->User->find('list');
		$this->set(compact('users'));
                $this->render('add');
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Userinfo->id = $id;
		if (!$this->Userinfo->exists()) {
			throw new NotFoundException(__('Invalid userinfo'));
		}
		if ($this->Userinfo->delete()) {
			$this->Session->setFlash(__('Userinfo deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Userinfo was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
