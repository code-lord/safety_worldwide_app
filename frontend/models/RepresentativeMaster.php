<?php

namespace app\models;

use Yii;
use yii\helpers\Security;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "representative_master".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property integer $type
 * @property string $phone
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 *
 * @property InspectionMaster[] $inspectionMasters
 * @property RepresentativeContract[] $representativeContracts
 */
class RepresentativeMaster extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'representative_master';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'password', 'first_name', 'last_name', 'type', 'phone', 'email'], 'required'],
            [['type'], 'integer'],
            [['created_at'], 'safe'],
            [['username', 'first_name', 'last_name', 'phone', 'email', 'updated_at'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 75],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'type' => 'Type',
            'phone' => 'Phone',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInspectionMasters() {
        return $this->hasMany(InspectionMaster::className(), ['inspection_representative_master' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepresentativeContracts() {
        return $this->hasMany(RepresentativeContract::className(), ['representative_master' => 'id']);
    }

    public function getUserType() {
        if ($this->type == "1") {
            return "Representative";
        } elseif ($this->type == "2") {
            return "Superviser";
        } elseif ($this->type == "3") {
            return "Contractor";
        } else {
            return "Undefined";
        }
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = sha1($password);
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
