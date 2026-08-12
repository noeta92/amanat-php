<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pelaporinternal;

/**
 * PelaporinternalSearch represents the model behind the search form about `common\models\Pelaporinternal`.
 */
class PelaporinternalSearch extends Pelaporinternal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'kodeBagian'], 'integer'],
            [['nip', 'nipLama', 'nama', 'tempatLahir', 'tanggalLahir', 'tmtPns', 'golongan', 'tmtTerakhir', 'fungsionalTertentu', 'fungsionalUmum', 'jabatanStruktural', 'eselon', 'status', 'email', 'handphone', 'userInput'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Pelaporinternal::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'kodeBagian' => $this->kodeBagian,
        ]);

        $query->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'nipLama', $this->nipLama])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tempatLahir', $this->tempatLahir])
            ->andFilterWhere(['like', 'tanggalLahir', $this->tanggalLahir])
            ->andFilterWhere(['like', 'tmtPns', $this->tmtPns])
            ->andFilterWhere(['like', 'golongan', $this->golongan])
            ->andFilterWhere(['like', 'tmtTerakhir', $this->tmtTerakhir])
            ->andFilterWhere(['like', 'fungsionalTertentu', $this->fungsionalTertentu])
            ->andFilterWhere(['like', 'fungsionalUmum', $this->fungsionalUmum])
            ->andFilterWhere(['like', 'jabatanStruktural', $this->jabatanStruktural])
            ->andFilterWhere(['like', 'eselon', $this->eselon])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'handphone', $this->handphone])
            ->andFilterWhere(['like', 'userInput', $this->userInput]);

        return $dataProvider;
    }
}
