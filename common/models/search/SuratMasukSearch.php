<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SuratMasuk;
use common\models\SuratMasukBidang;

/**
 * SuratMasukSearch represents the model behind the search form of `common\models\SuratMasuk`.
 */
class SuratMasukSearch extends SuratMasuk
{
    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['id', 'statusSurat', 'kodeBidang', 'kodeKlasifikasi', 'timeDisposisi', 'jawabanDisposisi', 'timeJawaban', 'userJawab_id', 'timeCreated'], 'integer'],
            [['noSurat', 'tanggalSurat', 'asalTujuan', 'perihal', 'uraianSurat', 'isiDisposisi', 'tanggalTerimaKirim', 'namaTerimaKirim'], 'safe'],
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
        $query = SuratMasuk::find();

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
            'id' => $this->id,
            'tanggalSurat' => $this->tanggalSurat,
            'statusSurat' => $this->statusSurat,
            'kodeBidang' => $this->kodeBidang,
            'kodeKlasifikasi' => $this->kodeKlasifikasi,
            'timeDisposisi' => $this->timeDisposisi,
            'jawabanDisposisi' => $this->jawabanDisposisi,
            'timeJawaban' => $this->timeJawaban,
            'userJawab_id' => $this->userJawab_id,
            'tanggalTerimaKirim' => $this->tanggalTerimaKirim,
            'timeCreated' => $this->timeCreated,
        ]);

        $query->andFilterWhere(['like', 'noSurat', $this->noSurat])
            ->andFilterWhere(['like', 'asalTujuan', $this->asalTujuan])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'uraianSurat', $this->uraianSurat])
            ->andFilterWhere(['like', 'isiDisposisi', $this->isiDisposisi])
            ->andFilterWhere(['like', 'namaTerimaKirim', $this->namaTerimaKirim]);

        return $dataProvider;
    }

    public function searchBidang($params)
    {
       
        $query = SuratMasukBidang::find();

        $query->joinWith(['noSurat0']); //Search Child

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
            'id' => $this->id,
            //'noSurat' => $this->noSurat,
            'statusSurat' => $this->statusSurat,
            'kodeBidang' => $this->kodeBidang,
            'timeJawaban' => $this->timeJawaban,
            'userJawab_id' => $this->userJawab_id,
            'tanggalTerimaKirim' => $this->tanggalTerimaKirim,
        ]);

        $query->andFilterWhere(['like', 'jawabanDisposisi', $this->jawabanDisposisi])
            ->andFilterWhere(['like', 'surat_masuk.kodeKlasifikasi', $this->kodeKlasifikasi])
            ->andFilterWhere(['like', 'surat_masuk_bidang.namaTerimaKirim', $this->namaTerimaKirim])
            ->andFilterWhere(['like', 'surat_masuk.tanggalSurat', $this->tanggalSurat])
            ->andFilterWhere(['like', 'surat_masuk.asalTujuan', $this->asalTujuan])
            ->andFilterWhere(['like', 'surat_masuk.perihal', $this->perihal])
            ->andFilterWhere(['like', 'surat_masuk.noSurat', $this->noSurat]); //Search Child

        return $dataProvider;
    }

}
