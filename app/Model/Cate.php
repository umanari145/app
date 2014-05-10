<?php
App::uses('AppModel', 'Model');
/**
 * Cate Model
 *
 */
class Cate extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'cate';
/**
 * Validation rules
 *
 * @var array
 */
	public $actsAs = array('Containable');
	
	public $validate = array(
		'id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cate' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
