<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Tanggal extends Component {

    public function getbulan($id) {
        $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return $bulan[$id-1];
    }

    public function gethari($id) {
        $hari = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
        return $hari[$id-1];
    }

    public function getcurrency($id) {
        $id--;
        if ($id == 0) {
            return '0';
        }
        $str = '';
        $temp = 0;
        while ($id >= 1000) {
            $temp = $id % 1000;
            $str = '.' . str_pad($temp, 3, "0", STR_PAD_LEFT) . $str;
            $id = (int) ($id / 1000);
        }
        return $id . $str . ',00';
    }

    public function getDay($data) {

        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );

        return $Hari = $dayList[$data];
    }

    public function getMonth($data) {

        $monthList  = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );

        return $Bulan = $monthList[$data];
    }

}

?>