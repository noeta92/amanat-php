<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pegawai".
 *
 * @property int $id
 * @property int $statusAparatur
 * @property string $namaLengkap
 * @property string|null $nip
 * @property int $eselon
 * @property int $bidang
 *
 * @property MonitoringHonorarium[] $monitoringHonoraria
 * @property MonitoringLembur[] $monitoringLemburs
 * @property MonitoringPerjadin[] $monitoringPerjadins
 */
class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['statusAparatur', 'namaLengkap', 'eselon', 'kodeBidang'], 'required'],
            [['statusAparatur', 'eselon', 'kodeBidang'], 'integer'],
            [['namaLengkap'], 'string', 'max' => 100],
            [['nip'], 'string', 'max' => 22],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'statusAparatur' => 'Status Aparatur',
            'namaLengkap' => 'Nama Lengkap',
            'nip' => 'Nip',
            'eselon' => 'Eselon',
            'kodeBidang' => 'Bidang',
        ];
    }

    /**
     * Gets query for [[MonitoringHonoraria]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MonitoringHonorariumQuery
     */
    public function getMonitoringHonoraria()
    {
        return $this->hasMany(MonitoringHonorarium::class, ['idPegawai' => 'id']);
    }

    /**
     * Gets query for [[MonitoringLemburs]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MonitoringLemburQuery
     */
    public function getMonitoringLemburs()
    {
        return $this->hasMany(MonitoringLembur::class, ['idPegawai' => 'id']);
    }

    /**
     * Gets query for [[MonitoringPerjadins]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MonitoringPerjadinQuery
     */
    public function getMonitoringPerjadins()
    {
        return $this->hasMany(MonitoringPerjadin::class, ['idPegawai' => 'id']);
    }

    public function getPegawaiEselon()
    {
        return $this->hasOne(PegawaiEselon::class, ['id' => 'eselon']);
    }

    public function getPegawaiBidang()
    {
        return $this->hasOne(Bidang::class, ['id' => 'kodeBidang']);
    }
    /**
     * {@inheritdoc}
     * @return \common\models\query\PegawaiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PegawaiQuery(get_called_class());
    }
}
