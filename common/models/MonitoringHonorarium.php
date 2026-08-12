<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "monitoring_honorarium".
 *
 * @property int $idHonor
 * @property int $idPegawai
 * @property int $jenisSurat
 * @property int $idSurat
 * @property string $tanggal
 * @property string $tujuan
 * @property string $tempat
 * @property int $statusVerifikasi
 * @property int $verifikasiBy
 * @property string $createdOn
 * @property int $createdBy
 *
 * @property Pegawai $idPegawai0
 */
class MonitoringHonorarium extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'monitoring_honorarium';
    }

    /**
     * {@inheritdoc}
     */
    public $namaLengkap;
    public $noSurat;

    public function rules()
    {
        return [
            [['idPegawai', 'jenisSurat', 'idSurat', 'tanggal', 'tujuan', 'tempat', 'verifikasiBy', 'createdOn', 'createdBy'], 'required'],
            [['idPegawai', 'jenisSurat', 'idSurat', 'bulan', 'tahun', 'statusVerifikasi', 'verifikasiBy', 'createdBy'], 'integer'],
            [['tanggal', 'createdOn', 'namaLengkap', 'noSurat'], 'safe'],
            [['tujuan'], 'string', 'max' => 128],
            [['tempat'], 'string', 'max' => 255],
            [['idPegawai'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::class, 'targetAttribute' => ['idPegawai' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idHonor' => 'Id Honor',
            'idPegawai' => 'Id Pegawai',
            'jenisSurat' => 'Jenis Surat',
            'idSurat' => 'Id Surat',
            'tanggal' => 'Tanggal',
            'bulan' => 'bulan',
            'tahun' => 'tahun',
            'tujuan' => 'Tujuan',
            'tempat' => 'Tempat',
            'statusVerifikasi' => 'Status Verifikasi',
            'verifikasiBy' => 'Verifikasi By',
            'createdOn' => 'Created On',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[IdPegawai0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PegawaiQuery
     */
    public function getIdPegawai0()
    {
        return $this->hasOne(Pegawai::class, ['id' => 'idPegawai']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MonitoringHonorariumQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MonitoringHonorariumQuery(get_called_class());
    }

    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['id' => 'idPegawai']);
    }

    public function getSuratMasuk()
    {
        return $this->hasOne(SuratMasuk::className(), ['id' => 'idSurat']);
    }

    public function getSuratKeluar()
    {
        return $this->hasOne(SuratKeluar::className(), ['id' => 'idSurat']);
    }

    public function getPengguna()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }
}
