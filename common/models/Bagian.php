<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bagian".
 *
 * @property int $id
 * @property string $bagian
 *
 * @property Pengaduan[] $pengaduans
 * @property User[] $users
 */
class Bagian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bagian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['bagian'], 'string'],
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
            'bagian' => 'Bagian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengaduans()
    {
        return $this->hasMany(Pengaduan::className(), ['kodeBagian' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['bagian_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BagianQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BagianQuery(get_called_class());
    }
}
