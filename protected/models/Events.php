<?php

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $event_id
 * @property integer $group_id
 * @property integer $obj_id
 * @property string $description
 * @property string $dt
 * @property integer $hr
 *
 * The followings are the available model relations:
 * @property AlarmStat[] $alarmStats
 * @property Objects $obj
 * @property Groups $group
 */
class Events extends CActiveRecord
{
	public $id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, obj_id, hr', 'numerical', 'integerOnly'=>true),
			array('description, dt', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('event_id, group_id, obj_id, description, dt, hr', 'safe', 'on'=>'search'),
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
			'alarmStats' => array(self::HAS_MANY, 'AlarmStat', 'event_id'),
			'obj' => array(self::BELONGS_TO, 'Objects', 'obj_id'),
			'group' => array(self::BELONGS_TO, 'Groups', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'event_id' => 'Event',
			'group_id' => 'Group',
			'obj_id' => 'Obj',
			'description' => 'Description',
			'dt' => 'Dt',
			'hr' => 'Hr',
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

		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('obj_id',$this->obj_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('dt',$this->dt,true);
		$criteria->compare('hr',$this->hr);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Events the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
