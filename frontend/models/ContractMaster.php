<?php

namespace app\models;

use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "contract_master".
 *
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $created_at
 * @property string $updated_at
 * @property integer $contract_type
 *
 * @property ContractType $contractType
 * @property InspectionMaster[] $inspectionMasters
 * @property Location[] $locations
 * @property RepresentativeContract[] $representativeContracts
 */
class ContractMaster extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'contract_master';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'contract_type'], 'required'],
            [['start_date', 'end_date', 'created_at'], 'safe'],
            [['contract_type'], 'integer'],
            [['name', 'updated_at'], 'string', 'max' => 45],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'contract_type' => 'Contract Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractType() {
        return $this->hasOne(ContractType::className(), ['id' => 'contract_type']);
    }

    public function getContractTypeName() {
        return $this->contractType->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInspectionMasters() {
        return $this->hasMany(InspectionMaster::className(), ['inspection_contract_master' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations() {
        return $this->hasMany(Location::className(), ['location_contract_master' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepresentativeContracts() {
        return $this->hasMany(RepresentativeContract::className(), ['contract_master' => 'id']);
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
