<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "media".
 *
 * @property integer $id
 * @property integer $surat_id
 * @property string $type
 * @property string $namaFile
 *
 * @property Pengaduan $pengaduan
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','jenisSurat'], 'required'],
            [['id', 'surat_id', 'jenisSurat', 'uploadBy'], 'integer'],
            [['type'], 'string'],
            [['namaFile'], 'string', 'max' => 128],
            [['uploadAt'], 'safe'],
            [['file'],'file','skipOnEmpty'=>false,'extensions'=>'pdf, png, jpeg, jpg', 'maxSize' => 1024 * 1024 * 2],
            [['surat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pengaduan::className(), 'targetAttribute' => ['surat_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surat_id' => 'Pengaduan ID',
            'jenisSurat' => 'Jenis Surat',
            'type' => 'Type',
            'namaFile' => 'Nama File',
            'file' => Yii::t('app', 'File'),
            'uploadAt' => Yii::t('app', 'Upload At'),
            'uploadBy' => Yii::t('app', 'Upload By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengaduan()
    {
        return $this->hasOne(Pengaduan::className(), ['id' => 'surat_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\MediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MediaQuery(get_called_class());
    }
}
