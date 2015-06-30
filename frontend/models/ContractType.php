<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contract_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $soft_delete
 * @property ContractMaster[] $contractMasters
 * @property ContractWork[] $contractWorks
 */
class ContractType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contract_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'soft_delete' => 'Soft_Delete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractMasters()
    {
        return $this->hasMany(ContractMaster::className(), ['contract_type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractWorks()
    {
        return $this->hasMany(ContractWork::className(), ['work_contract_type' => 'id']);
    }
}
