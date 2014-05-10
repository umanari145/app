<?php
App::uses('AppModel', 'Model');

class ItemsTag extends AppModel {
	public $name = 'ItemsTag';
	public $actsAs = array('Containable');
	
	public $belongsTo = array(
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			),	
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			)	
		);
	
	//左サイドのリスト。タグの名前と数を数えてデータをだす
	public function sideTag(){
	$tagDataArr = $this->find('all',array('contain'=>array('Tag.tag'),//=>array('fields'=>'tag')),
					'fields'=>array('COUNT(tag_id) AS tag_count'),
					'group'=>'tag_id',
					'order'=>array('tag_count'=>'desc')
					)
			    );
	return $tagDataArr;
	
	}
	
}
?>
