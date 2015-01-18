<?php

/**
 * This is the model class for table "checker".
 *
 * The followings are the available columns in table 'checker':
 * @property integer $id
 * @property string $keyword
 * @property integer $type
 * @property double $threshold
 * @property integer $is_running
 * @property integer $obj_id
 * @property double $real_rate
 * @property integer $pre_cycle
 * @property integer $cur_cycle
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Objects $obj
 */
class Checker extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'checker';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, is_running, obj_id, pre_cycle, cur_cycle', 'numerical', 'integerOnly'=>true),
			array('threshold, real_rate', 'numerical'),
			array('keyword', 'length', 'max'=>128),
			array('status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, keyword, type, threshold, is_running, obj_id, real_rate, pre_cycle, cur_cycle, status', 'safe', 'on'=>'search'),
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
			'obj' => array(self::BELONGS_TO, 'Objects', 'obj_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'keyword' => 'Keyword',
			'type' => 'Type',
			'threshold' => 'Threshold',
			'is_running' => 'Is Running',
			'obj_id' => 'Obj',
			'real_rate' => 'Real Rate',
			'pre_cycle' => 'Pre Cycle',
			'cur_cycle' => 'Cur Cycle',
			'status' => 'Status',
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
		$criteria->compare('keyword',$this->keyword,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('threshold',$this->threshold);
		$criteria->compare('is_running',$this->is_running);
		$criteria->compare('obj_id',$this->obj_id);
		$criteria->compare('real_rate',$this->real_rate);
		$criteria->compare('pre_cycle',$this->pre_cycle);
		$criteria->compare('cur_cycle',$this->cur_cycle);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Checker the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
