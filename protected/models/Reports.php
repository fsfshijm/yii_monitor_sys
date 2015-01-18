<?php

/**
 * This is the model class for table "reports".
 *
 * The followings are the available columns in table 'reports':
 * @property integer $report_id
 * @property string $content_map
 * @property string $dt
 * @property integer $hr
 * @property integer $obj_id
 *
 * The followings are the available model relations:
 * @property Objects $obj
 */
class Reports extends CActiveRecord
{
	public $id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reports';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hr, obj_id', 'numerical', 'integerOnly'=>true),
			array('content_map, dt', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('report_id, content_map, dt, hr, obj_id', 'safe', 'on'=>'search'),
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
			'report_id' => 'Report',
			'content_map' => 'Content Map',
			'dt' => 'Dt',
			'hr' => 'Hr',
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

		$criteria->compare('report_id',$this->report_id);
		$criteria->compare('content_map',$this->content_map,true);
		$criteria->compare('dt',$this->dt,true);
		$criteria->compare('hr',$this->hr);
		$criteria->compare('obj_id',$this->obj_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reports the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
