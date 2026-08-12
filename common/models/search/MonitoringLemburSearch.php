<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MonitoringLembur;

/**
 * MonitoringLemburSearch represents the model behind the search form of `common\models\MonitoringLembur`.
 */
class MonitoringLemburSearch extends MonitoringLembur
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idLembur', 'idPegawai', 'jenisSurat', 'idSurat', 'jenisPerjalanan', 'statusVerifikasi', 'verifikasiBy'], 'integer'],
            [['perihal', 'tanggal_awal', 'tanggal_akhir', 'tempat', 'createdOn', 'createdBy', 'namaLengkap', 'noSurat'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MonitoringLembur::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idLembur' => $this->idLembur,
            'idPegawai' => $this->idPegawai,
            'jenisSurat' => $this->jenisSurat,
            'idSurat' => $this->idSurat,
            'tanggal_awal' => $this->tanggal_awal,
            'tanggal_akhir' => $this->tanggal_akhir,
            'jenisPerjalanan' => $this->jenisPerjalanan,
            'statusVerifikasi' => $this->statusVerifikasi,
            'verifikasiBy' => $this->verifikasiBy,
            'createdOn' => $this->createdOn,
        ]);

        $query->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'tempat', $this->tempat]);

        return $dataProvider;
    }

    public function searchRelasi($params)
    {
        $userId =  \Yii::$app->user->getId();

        $query = MonitoringLembur::find();
       
        $query->joinWith(['pegawai', 'suratKeluar']);
        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idLembur' => $this->idLembur,
            //'idPegawai' => $this->idPegawai,
            'jenisSurat' => $this->jenisSurat,
            //'idSurat' => $this->idSurat,
            'tanggal_awal' => $this->tanggal_awal,
            'tanggal_akhir' => $this->tanggal_akhir,
            'jenisPerjalanan' => $this->jenisPerjalanan,
            'statusVerifikasi' => $this->statusVerifikasi,
            'verifikasiBy' => $this->verifikasiBy,
            'createdOn' => $this->createdOn,
            'createdBy' => $this->createdBy,
            //'namaLengkap' => $this->namaLengkap,
        ]);

        $query->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'pegawai.namaLengkap', $this->namaLengkap])
            ->andFilterWhere(['like', 'suratKeluar.noSurat', $this->noSurat]);

        return $dataProvider;
    }
}
