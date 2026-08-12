<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SuratMasukBidang;

/**
 * SuratMasukBidangSearch represents the model behind the search form of `common\models\SuratMasukBidang`.
 */
class SuratMasukBidangSearch extends SuratMasukBidang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'noSurat', 'statusSurat', 'kodeBidang', 'timeJawaban', 'userJawab_id'], 'integer'],
            [['jawabanDisposisi', 'tanggalTerimaKirim', 'namaTerimaKirim'], 'safe'],
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
        $query = SuratMasukBidang::find();

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
            'noSurat' => $this->noSurat,
            'statusSurat' => $this->statusSurat,
            'kodeBidang' => $this->kodeBidang,
            'timeJawaban' => $this->timeJawaban,
            'userJawab_id' => $this->userJawab_id,
            'tanggalTerimaKirim' => $this->tanggalTerimaKirim,
        ]);

        $query->andFilterWhere(['like', 'jawabanDisposisi', $this->jawabanDisposisi])
            ->andFilterWhere(['like', 'namaTerimaKirim', $this->namaTerimaKirim]);

        return $dataProvider;
    }
}
