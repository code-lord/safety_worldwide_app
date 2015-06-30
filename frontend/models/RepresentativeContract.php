<?php

namespace app\models;

use Yii;
use yii\helpers\Security;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "representative_contract".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $representative_master
 * @property integer $contract_master
 * @property integer $soft_delete
 *
 * @property ContractMaster $contractMaster
 * @property RepresentativeMaster $representativeMaster
 */
class RepresentativeContract extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'representative_contract';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['representative_master', 'contract_master'], 'required'],
            [['representative_master', 'contract_master', 'soft_delete'], 'integer'],
            [['created_at', 'updated_at'], 'safe']
        ];
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

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'isRepresentative' => 'Is Representative',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'representative_master' => 'Representative Master',
            'contract_master' => 'Contract Master',
            'soft_delete' => 'Soft Delete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractMaster() {
        return $this->hasOne(ContractMaster::className(), ['id' => 'contract_master']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepresentativeMaster() {
        return $this->hasOne(RepresentativeMaster::className(), ['id' => 'representative_master']);
    }

    public function getRepresentativeName() {
        return $this->representativeMaster->first_name . " " . $this->representativeMaster->last_name;
    }

    public function getRepresentativePhone() {
        return $this->representativeMaster->phone;
    }

    public function getRepresentativeEmail() {
        return $this->representativeMaster->email;
    }

}
