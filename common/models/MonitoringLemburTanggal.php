<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "monitoring_lembur_tanggal".
 *
 * @property int $id
 * @property int $idLembur
 * @property int $idPegawai
 * @property string $tanggal
 *
 * @property MonitoringLembur $idLembur0
 */
class MonitoringLemburTanggal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'monitoring_lembur_tanggal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idLembur', 'idPegawai', 'tanggal'], 'required'],
            [['id', 'idLembur', 'idPegawai'], 'integer'],
            [['tanggal'], 'safe'],
            [['id'], 'unique'],
            [['idLembur'], 'exist', 'skipOnError' => true, 'targetClass' => MonitoringLembur::class, 'targetAttribute' => ['idLembur' => 'idLembur']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idLembur' => 'Id Lembur',
            'idPegawai' => 'Id Pegawai',
            'tanggal' => 'Tanggal',
        ];
    }

    /**
     * Gets query for [[IdLembur0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MonitoringLemburQuery
     */
    public function getIdLembur0()
    {
        return $this->hasOne(MonitoringLembur::class, ['idLembur' => 'idLembur']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MonitoringLemburTanggalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MonitoringLemburTanggalQuery(get_called_class());
    }
}
