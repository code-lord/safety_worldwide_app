<?php

namespace app\models;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "inspection_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property integer $contract_work
 *
 * @property InspectionCheck[] $inspectionChecks
 * @property ContractWork $contractWork
 */
class InspectionType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inspection_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','contract_work'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['contract_work'], 'integer'],
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
            'contract_work' => 'Contract Work',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInspectionChecks()
    {
        return $this->hasMany(InspectionCheck::className(), ['inspection_type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractWork()
    {
        return $this->hasOne(ContractWork::className(), ['id' => 'contract_work']);
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
