<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "surat_masuk".
 *
 * @property int $id
 * @property string $noSurat
 * @property string $tanggalSurat
 * @property int $statusSurat
 * @property int|null $kodeBidang
 * @property int $kodeKlasifikasi
 * @property string $perihal
 * @property string $uraianSurat
 * @property string|null $isiDisposisi
 * @property int|null $timeDisposisi
 * @property int|null $jawabanDisposisi
 * @property int|null $timeJawaban
 * @property int|null $userJawab_id
 * @property string|null $tanggalTerimaKirim
 * @property string|null $namaTerimaKirim
 * @property int $timeCreated
 */
class SuratMasuk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'surat_masuk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['noSurat', 'tanggalSurat', 'statusSurat', 'kodeKlasifikasi', 'perihal', 'uraianSurat', 'timeCreated', 'asalTujuan'], 'required'],
            [['tanggalSurat', 'tanggalTerimaKirim'], 'safe'],
            [['statusSurat', 'kodeBidang', 'kodeKlasifikasi', 'timeDisposisi', 'jawabanDisposisi', 'timeJawaban', 'userJawab_id', 'timeCreated'], 'integer'],
            [['uraianSurat', 'asalTujuan', 'isiDisposisi', 'disposisiKaban'], 'string'],
            [['noSurat', 'perihal', 'isiDisposisi', 'disposisiKaban', 'namaTerimaKirim'], 'string', 'max' => 128],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'noSurat' => 'No Surat',
            'asalTujuan' => 'Asal Tujuan',
            'tanggalSurat' => 'Tanggal Surat',
            'statusSurat' => 'Status Surat',
            'kodeBidang' => 'Kode Bidang',
            'kodeKlasifikasi' => 'Kode Klasifikasi',
            'perihal' => 'Perihal',
            'uraianSurat' => 'Uraian Surat',
            'isiDisposisi' => 'Isi Disposisi',
            'disposisiKaban' => 'Disposisi Kaban',
            'timeDisposisi' => 'Time Disposisi',
            'jawabanDisposisi' => 'Jawaban Disposisi',
            'timeJawaban' => 'Time Jawaban',
            'userJawab_id' => 'User Jawab ID',
            'tanggalTerimaKirim' => 'Tanggal Terima Kirim',
            'namaTerimaKirim' => 'Nama Terima Kirim',
            'timeCreated' => 'Time Created',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SuratMasukQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SuratMasukQuery(get_called_class());
    }

    public function getBidang()
    {
        return $this->hasOne(Bidang::className(), ['id' => 'kodeBidang']);
    }

    public function getKlasifikasi()
    {
        return $this->hasOne(Klasifikasi::className(), ['id' => 'kodeKlasifikasi']);
    }

    public function getMedias()
    {
        return $this->hasMany(Media::className(), ['surat_id' => 'id']);
    }
   
    public function getMasukBidang()
    {
        return $this->hasMany(SuratMasukBidang::className(), ['noSurat' => 'id']);
    }

    public function getPerjadins()
    {
        return $this->hasMany(MonitoringPerjadin::className(), ['idSurat' => 'id']);
    }

    public function getLemburs()
    {
        return $this->hasMany(MonitoringLembur::className(), ['idSurat' => 'id']);
    }

    public function getHonors()
    {
        return $this->hasMany(MonitoringHonorarium::className(), ['idSurat' => 'id']);
    }
}
