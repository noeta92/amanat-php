<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "klasifikasi".
 *
 * @property integer $id
 * @property string $klasifikasi
 * @property string $Keterangan
 */
class Klasifikasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'klasifikasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['klasifikasi'], 'required'],
            [['Keterangan'], 'string'],
            [['klasifikasi'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'klasifikasi' => 'Klasifikasi',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\KlasifikasiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\KlasifikasiQuery(get_called_class());
    }
}
