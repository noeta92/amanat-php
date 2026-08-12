<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SuratKeluar;

/**
 * SuratKeluarSearch represents the model behind the search form of `common\models\SuratKeluar`.
 */
class SuratKeluarSearch extends SuratKeluar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'statusSurat', 'kodeBidang', 'kodeKlasifikasi', 'timeDisposisi', 'jawabanDisposisi', 'timeJawaban', 'userJawab_id', 'timeCreated'], 'integer'],
            [['noSurat','asalTujuan', 'tanggalSurat', 'perihal', 'uraianSurat', 'isiDisposisi', 'tanggalTerimaKirim', 'namaTerimaKirim'], 'safe'],
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
        $query = SuratKeluar::find();

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
}
