<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "surat_masuk_bidang".
 *
 * @property int $id
 * @property int $noSurat
 * @property int $statusSurat
 * @property int|null $kodeBidang
 * @property string|null $jawabanDisposisi
 * @property int|null $timeJawaban
 * @property int|null $userJawab_id
 * @property string|null $tanggalTerimaKirim
 * @property string|null $namaTerimaKirim
 *
 * @property SuratMasuk $noSurat0
 */
class SuratMasukBidang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'surat_masuk_bidang';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['noSurat', 'statusSurat'], 'required'],
            [['noSurat', 'statusSurat', 'kodeBidang', 'timeJawaban', 'userJawab_id'], 'integer'],
            [['tanggalTerimaKirim'], 'safe'],
            [['jawabanDisposisi', 'namaTerimaKirim'], 'string', 'max' => 128],
            [['noSurat'], 'exist', 'skipOnError' => true, 'targetClass' => SuratMasuk::class, 'targetAttribute' => ['noSurat' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'noSurat' => Yii::t('app', 'No Surat'),
            'statusSurat' => Yii::t('app', 'Status Surat'),
            'kodeBidang' => Yii::t('app', 'Kode Bidang'),
            'jawabanDisposisi' => Yii::t('app', 'Jawaban Disposisi'),
            'timeJawaban' => Yii::t('app', 'Time Jawaban'),
            'userJawab_id' => Yii::t('app', 'User Jawab ID'),
            'tanggalTerimaKirim' => Yii::t('app', 'Tanggal Terima Kirim'),
            'namaTerimaKirim' => Yii::t('app', 'Nama Terima Kirim'),
        ];
    }

    /**
     * Gets query for [[NoSurat0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SuratMasukQuery
     */
    public function getNoSurat0()
    {
        return $this->hasOne(SuratMasuk::class, ['id' => 'noSurat']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SuratMasukBidangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SuratMasukBidangQuery(get_called_class());
    }

    public function getBidang()
    {
        return $this->hasOne(Bidang::className(), ['id' => 'kodeBidang']);
    }

    public function getMedias()
    {
        return $this->hasMany(Media::className(), ['surat_id' => 'noSurat']);
    } 


}
