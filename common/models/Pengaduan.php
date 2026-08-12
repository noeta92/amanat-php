<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pengaduan".
 *
 * @property integer $id
 * @property integer $pelaporInternal_id
 * @property integer $jenisIdentitas_id
 * @property string $noIdentitas
 * @property string $namaPelapor
 * @property string $emailPelapor
 * @property string $handphone
 * @property string $perihal
 * @property integer $kodeBagian
 * @property string $instansiPelapor
 * @property string $uraianLapor
 * @property integer $statusAduan
 * @property string $tanggalLapor
 * @property integer $timeLapor
 * @property string $uraianPenyelesaian
 * @property string $tanggalJawaban
 * @property integer $timeJawaban
 * @property integer $userJawab_id
 * @property string $tanggalPenyelesaian
 * @property string $tanggalverifikasi
 * @property integer $timeVerifikasi
 * @property integer $userVerifikasi
 * @property string $noTiket
 *
 * @property Media[] $media
 * @property PelaporInternal $pelaporInternal
 * @property Bagian $kodeBagian0
 * @property JenisIdentitas $jenisIdentitas
 */
class Pengaduan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pengaduan';
    }

    /**
     * @inheritdoc
     */
    public $captcha;

    public function rules()
    {
        return [
            [['pelaporInternal_id', 'jenisIdentitas_id', 'kodeBagian', 'statusAduan', 'timeLapor', 'timeJawaban', 'userJawab_id', 'timeVerifikasi', 'userVerifikasi', 'intervalJawab', 'intervalPenyelesaian'], 'integer'],
            [['jenisIdentitas_id', 'noIdentitas', 'emailPelapor', 'perihal', 'kodeBagian', 'uraianLapor', 'statusAduan',  'uraianPenyelesaian', 'tanggalPenyelesaian'], 'required'],

            [['namaPelapor', 'emailPelapor', 'instansiPelapor', 'uraianLapor'], 'string'],
            // [['tanggalLapor', 'tanggalJawaban', 'tanggalPenyelesaian', 'tanggalverifikasi'], 'safe'],
            [['tanggalLapor', 'tanggalPenyelesaian', 'tanggalverifikasi'], 'safe'],
            [['noIdentitas', 'handphone'], 'string', 'max' => 18],
            [['perihal', 'uraianPenyelesaian', 'noTiket'], 'string', 'max' => 128],
            [['kodeBagian'], 'exist', 'skipOnError' => true, 'targetClass' => Bagian::className(), 'targetAttribute' => ['kodeBagian' => 'Id']],
            [['jenisIdentitas_id'], 'exist', 'skipOnError' => true, 'targetClass' => JenisIdentitas::className(), 'targetAttribute' => ['jenisIdentitas_id' => 'id']],
            [['captcha'],'required'],
            [['captcha'],'captcha'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pelaporInternal_id' => 'ID Pelapor Internal',
            'jenisIdentitas_id' => 'ID Jenis Identitas',
            'noIdentitas' => 'No Identitas',
            'namaPelapor' => 'Nama Pelapor',
            'emailPelapor' => 'Email Pelapor',
            'handphone' => 'Handphone',
            'perihal' => 'Perihal',
            'kodeBagian' => 'Kode Bagian',
            'instansiPelapor' => 'Instansi Pelapor',
            'uraianLapor' => 'Uraian Lapor',
            'statusAduan' => 'Status Aduan',
            'tanggalLapor' => 'Tanggal Lapor',
            'timeLapor' => 'Time Lapor',
            'uraianPenyelesaian' => 'Uraian Penyelesaian',
            // 'tanggalJawaban' => 'Tanggal Jawaban',
            'timeJawaban' => 'Time Jawaban',
            'userJawab_id' => 'User Jawab ID',
            'tanggalPenyelesaian' => 'Tanggal Penyelesaian',
            'tanggalverifikasi' => 'Tanggal Verifikasi',
            'intervalJawab' => 'Interval Jawab',
            'intervalPenyelesaian' => 'Interval Penyelesaian',
            'timeVerifikasi' => 'Time Verifikasi',
            'userVerifikasi' => 'User Verifikasi',
            'noTiket' => 'No Tiket',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['pengaduan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelaporInternal()
    {
        return $this->hasOne(PelaporInternal::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeBagian0()
    {
        return $this->hasOne(Bagian::className(), ['id' => 'kodeBagian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisIdentitas()
    {
        return $this->hasOne(JenisIdentitas::className(), ['id' => 'jenisIdentitas_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\PengaduanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PengaduanQuery(get_called_class());
    }
}
