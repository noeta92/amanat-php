<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "monitoring_lembur".
 *
 * @property int $idLembur
 * @property int $idPegawai
 * @property int $jenisSurat
 * @property int $idSurat
 * @property string $perihal
 * @property string $tanggal_awal
 * @property string|null $tanggal_akhir
 * @property int $jenisPerjalanan
 * @property string $tempat
 * @property int $statusVerifikasi
 * @property int|null $verifikasiBy
 * @property string $createdOn
 *
 * @property Pegawai $idPegawai0
 */
class MonitoringLembur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $namaLengkap;
    public $noSurat;
    public static function tableName()
    {
        return 'monitoring_lembur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPegawai', 'jenisSurat', 'idSurat', 'perihal', 'tanggal_awal', 'jenisPerjalanan', 'tempat', 'createdOn', 'createdBy'], 'required'],
            [['idPegawai', 'jenisSurat', 'idSurat', 'jenisPerjalanan', 'statusVerifikasi', 'verifikasiBy', 'createdBy'], 'integer'],
            [['tanggal_awal', 'tanggal_akhir', 'createdOn','namaLengkap', 'noSurat'], 'safe'],
            [['perihal'], 'string', 'max' => 128],
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
            'idLembur' => 'Id Lembur',
            'idPegawai' => 'Id Pegawai',
            'jenisSurat' => 'Jenis Surat',
            'idSurat' => 'Id Surat',
            'perihal' => 'Perihal',
            'tanggal_awal' => 'Tanggal Awal',
            'tanggal_akhir' => 'Tanggal Akhir',
            'jenisPerjalanan' => 'Jenis Perjalanan',
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
     * @return \common\models\query\MonitoringLemburQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MonitoringLemburQuery(get_called_class());
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
