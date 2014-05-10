<?php
App::uses('AppController', 'Controller');
/**
 * Votes Controller
 *
 * @property Vote $Vote
 */
class VotesController extends AppController {


/**
 * index method
 *
 * @return void
 */


	public function index() {
		$this->Vote->recursive = 0;
		$this->set('Votes', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Vote->id = $id;
		if (!$this->Vote->exists()) {
			throw new NotFoundException(__('Invalid Vote'));
		}
		$this->set('Vote', $this->Vote->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add(){


		if( $this->request->data["vote"]["vote_point"] !== "" ){
			
			$this->Vote->create();
			$this->Vote->save($this->request->data["vote"]);
			$this->redirect(array('controller'=>'items','action'=>'view',$this->request->data["vote"]["item_id"]));
		}else{
			$this->redirect(array('controller'=>'items','action'=>'view',$this->request->data["vote"]["item_id"]));
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Vote->id = $id;
		if (!$this->Vote->exists()) {
			throw new NotFoundException(__('Invalid Vote'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Vote->save($this->request->data)) {
				$this->Session->setFlash(__('The Vote has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Vote could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Vote->read(null, $id);
		}
		$users = $this->Vote->User->find('list');
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
		$this->Vote->id = $id;
		if (!$this->Vote->exists()) {
			throw new NotFoundException(__('Invalid Vote'));
		}
		if ($this->Vote->delete()) {
			$this->Session->setFlash(__('Vote deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Vote was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
