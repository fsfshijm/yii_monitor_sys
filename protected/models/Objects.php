<?php

/**
 * This is the model class for table "objects".
 *
 * The followings are the available columns in table 'objects':
 * @property integer $obj_id
 * @property string $obj_name
 * @property string $git_path
 * @property string $build_path
 * @property string $description
 * @property string $watcher
 * @property integer $group_id
 * @property integer $type
 * @property string $status
 * @property string $phone_nums
 *
 * The followings are the available model relations:
 * @property Checker[] $checkers
 * @property Groups $group
 * @property Reports[] $reports
 */
class Objects extends CActiveRecord
{
	public $id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'objects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, type', 'numerical', 'integerOnly'=>true),
			array('obj_name, phone_nums', 'length', 'max'=>128),
			array('git_path, build_path, watcher', 'length', 'max'=>256),
			array('status', 'length', 'max'=>8),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('obj_id, obj_name, git_path, build_path, description, watcher, group_id, type, status, phone_nums', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'checkers' => array(self::HAS_MANY, 'Checker', 'obj_id'),
			'group' => array(self::BELONGS_TO, 'Groups', 'group_id'),
			'reports' => array(self::HAS_MANY, 'Reports', 'obj_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'obj_id' => 'Obj',
			'obj_name' => 'Obj Name',
			'git_path' => 'Git Path',
			'build_path' => 'Build Path',
			'description' => 'Description',
			'watcher' => 'Watcher',
			'group_id' => 'Group',
			'type' => 'Type',
			'status' => 'Status',
			'phone_nums' => 'Phone Nums',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('obj_id',$this->obj_id);
		$criteria->compare('obj_name',$this->obj_name,true);
		$criteria->compare('git_path',$this->git_path,true);
		$criteria->compare('build_path',$this->build_path,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('watcher',$this->watcher,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('phone_nums',$this->phone_nums,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Objects the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
