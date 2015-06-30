<?php

namespace app\models;
use yii\helpers\Security;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "inspection_master".
 *
 * @property integer $id
 * @property integer $shift
 * @property string $created_at
 * @property string $updated_at
 * @property integer $inspection_location
 * @property integer $inspection_representative_master
 * @property integer $inspection_contract_master
 *
 * @property InspectionCheck[] $inspectionChecks
 * @property ContractMaster $inspectionContractMaster
 * @property Location $inspectionLocation
 * @property RepresentativeMaster $inspectionRepresentativeMaster
 */
class InspectionMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inspection_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shift','inspection_location', 'inspection_representative_master', 'inspection_contract_master'], 'required'],
            [['shift', 'inspection_location', 'inspection_representative_master', 'inspection_contract_master'], 'integer'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shift' => 'Shift',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'inspection_location' => 'Inspection Location',
            'inspection_representative_master' => 'Inspection Representative Master',
            'inspection_contract_master' => 'Inspection Contract Master',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInspectionChecks()
    {
        return $this->hasMany(InspectionCheck::className(), ['inspection_master' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInspectionContractMaster()
    {
        return $this->hasOne(ContractMaster::className(), ['id' => 'inspection_contract_master']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInspectionLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'inspection_location']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInspectionRepresentativeMaster()
    {
        return $this->hasOne(RepresentativeMaster::className(), ['id' => 'inspection_representative_master']);
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
