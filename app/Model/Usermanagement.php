<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property User $User
 */
class Usermanagement extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	//���[�U�[����
	public function UserPermission( $controller , $action , $status ){

		$userPermissionAccount = $this->find( 'first',
                                              array( 'conditions' => array( 'controller' => $controller ,
                                                                            'action'     => $action ,
                                                                            'status'     => $status 
                                                                           )
                                                   )
		                                     );
		return $userPermissionAccount;
	} 
}
