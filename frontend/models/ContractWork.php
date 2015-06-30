<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contract_work".
 *
 * @property integer $id
 * @property string $name
 * @property integer $work_contract_type
 *
 * @property ContractType $workContractType
 * @property InspectionType[] $inspectionTypes
 */
class ContractWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contract_work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['work_contract_type'], 'integer'],
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
            'work_contract_type' => 'Work Contract Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkContractType()
    {
        return $this->hasOne(ContractType::className(), ['id' => 'work_contract_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInspectionTypes()
    {
        return $this->hasMany(InspectionType::className(), ['contract_work' => 'id']);
    }
}
