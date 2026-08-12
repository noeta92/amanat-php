<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "monitoring_perjadin_tanggal".
 *
 * @property int $idPerjadin
 * @property int $idPegawai
 * @property string $tanggal
 */
class MonitoringPerjadinTanggal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'monitoring_perjadin_tanggal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','idPerjadin', 'idPegawai', 'tanggal'], 'required'],
            [['id','idPerjadin', 'idPegawai'], 'integer'],
            [['tanggal'], 'safe'],
            [['idPerjadin'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'idPerjadin' => 'Id Perjadin',
            'idPegawai' => 'Id Pegawai',
            'tanggal' => 'Tanggal',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MonitoringPerjadinTanggalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MonitoringPerjadinTanggalQuery(get_called_class());
    }
}
