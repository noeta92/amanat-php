<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pengaduan;

/**
 * PengaduanSearch represents the model behind the search form about `common\models\Pengaduan`.
 */
class PengaduanSearch extends Pengaduan
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pelaporInternal_id', 'jenisIdentitas_id', 'kodeBagian', 'statusAduan', 'timeLapor', 'timeJawaban', 'userJawab_id', 'timeVerifikasi', 'userVerifikasi'], 'integer'],
            [['noIdentitas', 'namaPelapor', 'emailPelapor', 'handphone', 'perihal', 'instansiPelapor', 'uraianLapor', 'tanggalLapor', 'uraianPenyelesaian', 'tanggalPenyelesaian', 'tanggalverifikasi', 'noTiket', 'globalSearch'], 'safe'],
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
        $query = Pengaduan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'pelaporInternal_id' => $this->pelaporInternal_id,
            'jenisIdentitas_id' => $this->jenisIdentitas_id,
            'kodeBagian' => $this->kodeBagian,
            'statusAduan' => $this->statusAduan,
            'tanggalLapor' => $this->tanggalLapor,
            'timeLapor' => $this->timeLapor,

            'timeJawaban' => $this->timeJawaban,
            'userJawab_id' => $this->userJawab_id,
            'tanggalPenyelesaian' => $this->tanggalPenyelesaian,
            'tanggalverifikasi' => $this->tanggalverifikasi,
            'timeVerifikasi' => $this->timeVerifikasi,
            'userVerifikasi' => $this->userVerifikasi,
        ]);

        $query->orFilterWhere(['like', 'noIdentitas', $this->globalSearch])
            ->orFilterWhere(['like', 'namaPelapor', $this->globalSearch])
            ->orFilterWhere(['like', 'emailPelapor', $this->globalSearch])
            ->orFilterWhere(['like', 'handphone', $this->globalSearch])
            ->orFilterWhere(['like', 'perihal', $this->globalSearch])
            ->orFilterWhere(['like', 'instansiPelapor', $this->globalSearch])
            ->orFilterWhere(['like', 'uraianLapor', $this->globalSearch])
            ->orFilterWhere(['like', 'uraianPenyelesaian', $this->globalSearch])
            ->orFilterWhere(['like', 'noTiket', $this->globalSearch]);

        return $dataProvider;
    }

    public function searchBagian($params)
    {


        $userId = Yii::$app->user->getId();
        $roles = \common\models\User::find()->where(['id' => $userId])->one();
        $bagian = $roles->bagian_id;

        $query = Pengaduan::find()->where(['kodeBagian'=> $bagian]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'pelaporInternal_id' => $this->pelaporInternal_id,
            'jenisIdentitas_id' => $this->jenisIdentitas_id,
            //'kodeBagian' => $this->kodeBagian,
            'kodeBagian' => $bagian,
            'statusAduan' => $this->statusAduan,
            'tanggalLapor' => $this->tanggalLapor,
            'timeLapor' => $this->timeLapor,

            'timeJawaban' => $this->timeJawaban,
            'userJawab_id' => $this->userJawab_id,
            'tanggalPenyelesaian' => $this->tanggalPenyelesaian,
            'tanggalverifikasi' => $this->tanggalverifikasi,
            'timeVerifikasi' => $this->timeVerifikasi,
            'userVerifikasi' => $this->userVerifikasi,
        ]);

        $query->andFilterWhere(['like', 'noIdentitas', $this->noIdentitas])
            ->andFilterWhere(['like', 'namaPelapor', $this->namaPelapor])
            ->andFilterWhere(['like', 'emailPelapor', $this->emailPelapor])
            ->andFilterWhere(['like', 'handphone', $this->handphone])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'instansiPelapor', $this->instansiPelapor])
            ->andFilterWhere(['like', 'uraianLapor', $this->uraianLapor])
            ->andFilterWhere(['like', 'uraianPenyelesaian', $this->uraianPenyelesaian])
            ->andFilterWhere(['like', 'noTiket', $this->noTiket]);

        return $dataProvider;
    }
}
