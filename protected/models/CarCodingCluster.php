<?php

/**
 * This is the model class for table "car_coding_cluster".
 *
 * The followings are the available columns in table 'car_coding_cluster':
 * @property integer $cluster_id
 * @property integer $car
 * @property integer $coding
 */
class CarCodingCluster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'car_coding_cluster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('car, coding', 'required'),
			array('car, coding, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cluster_id, car, coding, status', 'safe', 'on'=>'search'),
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
			'Car'=>array(self::HAS_ONE, 'Car', array( 'car_id' => 'car' )),
			'CodingType'=>array(self::HAS_ONE, 'CodingType', array( 'type_id' => 'coding' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cluster_id' => 'Cluster',
			'car' => 'Car',
			'coding' => 'Coding',
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

		$criteria->compare('cluster_id',$this->cluster_id);
		$criteria->compare('car',$this->car);
		$criteria->compare('coding',$this->coding,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchList()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->compare('cluster_id',$this->cluster_id);
		$criteria->compare('car',$this->car,true);
		//$criteria->compare('coding',$this->coding,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CarCodingCluster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
