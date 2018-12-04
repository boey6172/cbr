<?php

/**
 * This is the model class for table "car_repair_log".
 *
 * The followings are the available columns in table 'car_repair_log':
 * @property integer $repair_id
 * @property string $car_id
 * @property string $repair_details
 * @property integer $repair_costing
 * @property string $date_saved
 */
class RepairLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RepairLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'car_repair_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('repair_details,', 'required'),
			array('repair_costing', 'numerical', 'integerOnly'=>true),
			array('car_id', 'length', 'max'=>36),
			array('repair_details', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('repair_id, car_id, repair_details, repair_costing, date_saved', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'repair_id' => 'Repair',
			'car_id' => 'Car',
			'repair_details' => 'Repair Details',
			'repair_costing' => 'Repair Costing',
			'date_saved' => 'Date Saved',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('repair_id',$this->repair_id);
		$criteria->compare('car_id',$this->car_id,true);
		$criteria->compare('repair_details',$this->repair_details,true);
		$criteria->compare('repair_costing',$this->repair_costing);
		$criteria->compare('date_saved',$this->date_saved,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
        if(parent::beforeSave()) {
        	$this->date_saved = date( 'Y-m-d H:i:s');
            return true;
        } else 
            return false;
    }
}