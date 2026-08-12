<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pegawai_eselon".
 *
 * @property int $id
 * @property string $nm_eselon
 */
class PegawaiEselon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai_eselon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nm_eselon'], 'required'],
            [['id'], 'integer'],
            [['nm_eselon'], 'string'],
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
            'nm_eselon' => 'Nm Eselon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PegawaiEselonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PegawaiEselonQuery(get_called_class());
    }
}
