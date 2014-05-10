<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property User $User
 */
class Comment extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $actsAs = array('Containable');
	
	public $validate = array(
		'body' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'コメントを入れてください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'Item'=>array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			//これを入れるとコメントが
			//増えたときにitemのカウンターが自動的に増える
			'counterCache' => true,		)
	);
}
