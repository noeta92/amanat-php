<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class Data extends Component {

    public function dataProvinsi($kondisi = NULL) {
        $provinsi = \common\models\WilayahProvinsi::find();
        if ($kondisi) {
            $provinsi = $provinsi->where($kondisi);
        }
        return $provinsi = ArrayHelper::map($provinsi->all(),
                'kd_provinsi', function($model){return $model->kd_provinsi.'. '.$model->provinsi;});
    }

    public function dataKabupaten($kondisi = NULL) {
        $kabupaten = \common\models\WilayahKabupatenKota::find();
        if ($kondisi) {
            $kabupaten = $kabupaten->where($kondisi);
        }
        return $kabupaten = ArrayHelper::map($kabupaten->all(),
                'kd_kabupaten_kota', function($model){return $model->kd_kabupaten_kota.'. '.$model->kabupaten_kota;});
    }

    public function dataKecamatan($kondisi = NULL) {
        $kecamatan = \common\models\WilayahKecamatan::find();
        if ($kondisi) {
            $kecamatan = $kecamatan->where($kondisi);
        }
        return $kecamatan = ArrayHelper::map($kecamatan->all(),
                'kd_kecamatan', function($model){return $model->kd_kecamatan.'. '.$model->kecamatan;});
    }

    public function dataKelurahan($kondisi = NULL) {
        $kelurahan = \common\models\WilayahKelurahan::find();
        if ($kondisi) {
            $kelurahan = $kelurahan->where($kondisi);
        }
        return $kelurahan = ArrayHelper::map($kelurahan->all(),
                'kd_kelurahan', function($model){return $model->kd_kelurahan.'. '.$model->kelurahan;});
    }

    public function dataLingkungan($kondisi = NULL) {
        $lingkungan = \common\models\WilayahLingkungan::find();
        if ($kondisi) {
            $lingkungan = $lingkungan->where($kondisi);
        }
        return $lingkungan = ArrayHelper::map($lingkungan->all(),
                'kd_lingkungan', function($model){return $model->kd_lingkungan.'. '.$model->lingkungan;});
    }

    public function dataSotkUrusan($kondisi = NULL) {
        $data = \common\models\SotkUrusan::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'kd_urusan', function($model){return $model->kd_urusan.'. '.$model->urusan;});
    }

    public function dataSotkBidang($kondisi = NULL) {
        $data = \common\models\SotkBidang::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'kd_bidang', function($model){return $model->kd_bidang.'. '.$model->bidang;});
    }

    public function dataSotkUnit($kondisi = NULL) {
        $data = \common\models\SotkUnit::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'kd_unit', function($model){return $model->kd_unit.'. '.$model->unit;});
    }

    public function dataSotkSubUnit($kondisi = NULL, $joinWith = null) {
        $data = \common\models\SotkSubUnit::find();
        if ($joinWith) {
            $data = $data->joinWith('user' , null, 'INNER JOIN');
        }
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'kd_sub_unit', function($model){return $model->kd_sub_unit.'. '.$model->sub_unit;});
    }

    public function dataBidangBappeda($kondisi = NULL) {
        $data = \common\models\BidangBappeda::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'id', function($model){return $model->id.'. '.$model->bidang_bappeda;});
    }

    public function dataDprdAnggota($kondisi = NULL) {
        $data = \common\models\DprdAnggota::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'id', function($model){return $model->id.'. '.$model->nama_lengkap;});
    }

    public function dataRenstraVisi($kondisi = NULL) {
        $data = \common\models\RpjmdVisi::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'id', function($model){return $model->id.'. '.$model->visi;});
    }

    public function dataRenstraPokokVisi($kondisi = NULL) {
        $data = \common\models\RenstraPokokVisi::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'no_pokok_visi', function($model){return $model->no_pokok_visi.'. '.$model->pokok_visi;});
    }

    public function dataRenstraMisi($kondisi = NULL) {
        $data = \common\models\RenstraMisi::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'no_misi', function($model){return $model->no_misi.'. '.$model->misi;});
    }

    public function dataRenstraTujuan($kondisi = NULL) {
        $data = \common\models\RenstraTujuan::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'no_tujuan', function($model){return $model->no_tujuan.'. '.$model->tujuan;});
    }

    public function dataRenstraSasaran($kondisi = NULL) {
        $data = \common\models\RenstraSasaran::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'no_sasaran', function($model){return $model->no_sasaran.'. '.$model->sasaran;});
    }

    public function dataRenstraStrategi($kondisi = NULL) {
        $data = \common\models\RenstraStrategi::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'no_strategi', function($model){return $model->no_strategi.'. '.$model->strategi;});
    }

    public function dataRenstraKebijakan($kondisi = NULL) {
        $data = \common\models\RenstraKebijakan::find();
        if ($kondisi) {
            $data = $data->where($kondisi);
        }
        return ArrayHelper::map($data->all(),
                'no_kebijakan', function($model){return $model->no_kebijakan.'. '.$model->kebijakan;});
    }

    public function dataSuratMasuk($id = 7) {
        $data = \common\models\SuratMasuk::find()->where(['id' => $id])->count();
        
        return $data;
    }
}

?>