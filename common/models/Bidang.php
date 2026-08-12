<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bidang".
 *
 * @property int $id
 * @property string|null $bagian
 *
 * @property User[] $users
 */
class Bidang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bidang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['bidang'], 'string'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bidang' => 'bidang',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['bagian_id' => 'id']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */

    public function getSuratMasukBidang()
    {
        return $this->hasMany(SuratMasukBidang::className(), ['kodeBidang' => 'id']);
    }

    public function getSuratKeluar()
    {
        return $this->hasMany(SuratKeluar::className(), ['kodeBidang' => 'id']);
    }

    public function getSuratMasuk()
    {
        return $this->hasMany(SuratMasuk::className(), ['kodeBidang' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\BidangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BidangQuery(get_called_class());
    }
}
