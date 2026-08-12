<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "surat_keluar".
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
class SuratKeluar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'surat_keluar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['statusSurat', 'statusKirim', 'kodeBidang', 'perihal', 'uraianSurat', 'timeCreated', 'asalTujuan'], 'required'],
            [['tanggalSurat', 'tanggalTerimaKirim'], 'safe'],
            [['statusSurat', 'statusKirim', 'kodeBidang', 'kodeKlasifikasi', 'timeDisposisi', 'jawabanDisposisi', 'timeJawaban', 'userJawab_id', 'timeCreated'], 'integer'],
            [['uraianSurat', 'asalTujuan'], 'string'],
            [['noSurat', 'perihal', 'isiDisposisi', 'namaTerimaKirim'], 'string', 'max' => 128],
            [['noSurat'], 'unique', 'targetAttribute' => ['noSurat'], 'targetClass' => '\common\models\SuratKeluar','message' => 'No Surat sudah ada'],
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
            'statusKirim' => 'Status Kirim',
            'kodeBidang' => 'Kode Bidang',
            'kodeKlasifikasi' => 'Kode Klasifikasi',
            'perihal' => 'Perihal',
            'uraianSurat' => 'Uraian Surat',
            'isiDisposisi' => 'Isi Disposisi',
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
     * @return \common\models\query\SuratKeluarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SuratKeluarQuery(get_called_class());
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
