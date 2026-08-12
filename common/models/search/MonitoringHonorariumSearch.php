<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MonitoringHonorarium;

/**
 * MonitoringHonorariumSearch represents the model behind the search form of `common\models\MonitoringHonorarium`.
 */
class MonitoringHonorariumSearch extends MonitoringHonorarium
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idHonor', 'idPegawai', 'jenisSurat', 'idSurat', 'statusVerifikasi', 'verifikasiBy', 'createdBy'], 'integer'],
            [['tanggal', 'tujuan', 'tempat', 'createdOn','namaLengkap', 'noSurat'], 'safe'],
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
        $query = MonitoringHonorarium::find();

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
            'idHonor' => $this->idHonor,
            'idPegawai' => $this->idPegawai,
            'jenisSurat' => $this->jenisSurat,
            'idSurat' => $this->idSurat,
            'tanggal' => $this->tanggal,
            'statusVerifikasi' => $this->statusVerifikasi,
            'verifikasiBy' => $this->verifikasiBy,
            'createdOn' => $this->createdOn,
            'createdBy' => $this->createdBy,
        ]);

        $query->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'tempat', $this->tempat]);

        return $dataProvider;
    }
    public function searchRelasi($params)
    {
        $userId =  \Yii::$app->user->getId();

        $query = MonitoringHonorarium::find();
       
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
            'idHonor' => $this->idHonor,
            'idPegawai' => $this->idPegawai,
            'jenisSurat' => $this->jenisSurat,
            'idSurat' => $this->idSurat,
            'tanggal' => $this->tanggal,
            'statusVerifikasi' => $this->statusVerifikasi,
            'verifikasiBy' => $this->verifikasiBy,
            'createdOn' => $this->createdOn,
            'createdBy' => $this->createdBy,
        ]);

        $query->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'pegawai.namaLengkap', $this->namaLengkap])
            ->andFilterWhere(['like', 'suratKeluar.noSurat', $this->noSurat]);

        return $dataProvider;
    }
}
