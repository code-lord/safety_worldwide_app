<?php

namespace app\models;

use yii\helpers\Security;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property integer $location_contract_master
 *
 * @property InspectionMaster[] $inspectionMasters
 * @property ContractMaster $locationContractMaster
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'location_contract_master'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['location_contract_master'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'location_contract_master' => 'Location Contract Master',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInspectionMasters()
    {
        return $this->hasMany(InspectionMaster::className(), ['inspection_location' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationContractMaster()
    {
        return $this->hasOne(ContractMaster::className(), ['id' => 'location_contract_master']);
    }
    
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
