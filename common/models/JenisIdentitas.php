<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jenisIdentitas".
 *
 * @property integer $id
 * @property string $jenisIndentitas
 *
 * @property Pengaduan[] $pengaduans
 */
class JenisIdentitas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenisIdentitas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenisIndentitas'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenisIndentitas' => 'Jenis Indentitas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengaduans()
    {
        return $this->hasMany(Pengaduan::className(), ['jenisIdentitas_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\JenisIdentitasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\JenisIdentitasQuery(get_called_class());
    }
}
