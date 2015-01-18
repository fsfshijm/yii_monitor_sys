<?php

/**
 * This is the model class for table "alarm_stat".
 *
 * The followings are the available columns in table 'alarm_stat':
 * @property integer $id
 * @property string $sender
 * @property string $service
 * @property string $content
 * @property integer $type
 * @property string $reason
 * @property integer $event_id
 * @property string $dt
 * @property integer $hr
 * @property string $alarm_email
 * @property integer $obj_id
 *
 * The followings are the available model relations:
 * @property Events $event
 */
class AlarmStat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alarm_stat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender, content', 'required'),
			array('type, event_id, hr, obj_id', 'numerical', 'integerOnly'=>true),
			array('sender, service', 'length', 'max'=>64),
			array('content', 'length', 'max'=>1024),
			array('alarm_email', 'length', 'max'=>256),
			array('reason, dt', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sender, service, content, type, reason, event_id, dt, hr, alarm_email, obj_id', 'safe', 'on'=>'search'),
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
			'event' => array(self::BELONGS_TO, 'Events', 'event_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sender' => 'Sender',
			'service' => 'Service',
			'content' => 'Content',
			'type' => 'Type',
			'reason' => 'Reason',
			'event_id' => 'Event',
			'dt' => 'Dt',
			'hr' => 'Hr',
			'alarm_email' => 'Alarm Email',
			'obj_id' => 'Obj',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('sender',$this->sender,true);
		$criteria->compare('service',$this->service,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('dt',$this->dt,true);
		$criteria->compare('hr',$this->hr);
		$criteria->compare('alarm_email',$this->alarm_email,true);
		$criteria->compare('obj_id',$this->obj_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AlarmStat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
