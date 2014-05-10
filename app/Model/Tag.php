<?php
App::uses('AppModel', 'Model');

class Tag extends AppModel {
	public $name='Tag';
	public $displayField = 'tag';
	public $useTable='tags';


	//������L���ɂ��Ă��܂���
	//�Ȃ���
	//item��add���\�b�h�����܂�����Ȃ�
	/*public $hasAndBelongsToMany = array(
		'Item' => array(
			'className' => 'Item',
			'joinTable' => 'items_tags',
			'foreignKey' => 'tag_id',
			'associationForeignKey' => 'item_id'
		)
	);*/

	public function beforeSave(){
		//���łɂ�����̂͂͂����A�����łȂ���Γo�^
		if($this->hasAny(array("tag"=>trim($this->data["Tag"]["tag"])))){
			return false;	
		}else{
			return true;
		}	
	}

	//item�o�^���^�O�̒ǉ�
	public function addTag($tagData){

		//�܂��^�O�̕���
		$tags=explode(",",$tagData);

		//�o�^�Ɠ�����tag��id���擾
		$tagNumber=array();
		foreach($tags as $tag){
			//�����̃f�[�^�����Ƃ��͂��ꂵ�Ȃ��Ƃ���
			$this->create();
			//�z��œ���Ȃ��Ƃ͂������
			//�󔒍폜�Ƒ啶����
			$this->save(array("tag"=>strtoupper(trim($tag))));
			$tag_id=$this->find('first',
				array('fields'=>array('Tag.id'),
				'conditions'=>array('Tag.tag'=>strtoupper(trim($tag)))
			)
		);
			array_push($tagNumber,$tag_id['Tag']['id']);
		}

		return $tagNumber;

	}

}
?>
