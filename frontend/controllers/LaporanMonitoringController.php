<?php

namespace frontend\controllers;

use yii;
use common\models\Pegawai;
use common\models\search\PegawaiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Bidang;

class LaporanMonitoringController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $start = Yii::$app->request->post('start');
        $end = Yii::$app->request->post('end');
        $time = date("Y-m-d:");

        // $searchModel = new PegawaiSearch();
        // $dataProvider = $searchModel->search($this->request->queryParams);

        $modelPegawai = Pegawai::find()->All();

            // echo $start; echo $end;
            // return $this->render('index-tanggal', [
            //     // 'searchModel' => $searchModel,
            //     // 'dataProvider' => $dataProvider,
            //     'modelPegawai' => $modelPegawai,
            //     'start' => $start,
            //     'end' => $end,
            //     'startIsi' => $startIsi,
            //     'endIsi' => $endIsi,
            // ]);
        
        return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
            'modelPegawai' => $modelPegawai,
            'start' => $start,
            'end' => $end,        
        ]);
        
    }

    public function actionPerjadin()
    {
        $start = Yii::$app->request->post('start');
        $end = Yii::$app->request->post('end');
        $time = date("Y-m-d:");

        if ($start != NULL) {
            $modelPegawai = Pegawai::find()
                //->select(['monitoring_perjadin.*', 'COUNT(monitoring_perjadin.idPegawai) AS countPerjadin'])
                ->leftJoin('monitoring_perjadin', 'monitoring_perjadin.idPegawai = pegawai.id')
                ->where(['between', 'monitoring_perjadin.tanggal_awal', $start, $end])    
                ->orderBy(['COUNT(monitoring_perjadin.idPegawai)' => SORT_DESC])
                //->orderBy(['countPerjadin' => SORT_DESC])
                ->groupBy('idPegawai')             
                ->all();
     
        } else {
            $modelPegawai = Pegawai::find()
                ->rightJoin('monitoring_perjadin', 'monitoring_perjadin.idPegawai = pegawai.id')
                // ->select(['monitoring_perjadin.*', 'COUNT(monitoring_perjadin.idPegawai) AS countPerjadin'])
                ->orderBy(['COUNT(monitoring_perjadin.idPegawai)' => SORT_DESC])
                ->groupBy('idPegawai')             
                ->all();

        }
        return $this->render('index-perjadin', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
            'modelPegawai' => $modelPegawai,
            'start' => $start,
            'end' => $end,
        ]);    
    }

    public function actionLembur()
    {
        $start = Yii::$app->request->post('start');
        $end = Yii::$app->request->post('end');
        $time = date("Y-m-d:");

        if ($start != NULL) {
            $modelPegawai = Pegawai::find()
                ->leftJoin('monitoring_lembur', 'monitoring_lembur.idPegawai = pegawai.id')
                ->where(['between', 'monitoring_lembur.tanggal_awal', $start, $end])    
                ->orderBy(['COUNT(monitoring_lembur.idPegawai)' => SORT_DESC])
                ->groupBy('idPegawai')             
                ->all();
            
        } else {
            $modelPegawai = Pegawai::find()
                ->rightJoin('monitoring_lembur', 'monitoring_lembur.idPegawai = pegawai.id')
                ->orderBy(['COUNT(monitoring_lembur.idPegawai)' => SORT_DESC])
                ->groupBy('idPegawai')             
                ->all();

        }
        return $this->render('index-lembur', [
            'modelPegawai' => $modelPegawai,
            'start' => $start,
            'end' => $end,
        ]);
    
        
    }

    public function actionHonorarium()
    {
        $start = Yii::$app->request->post('start');
        $end = Yii::$app->request->post('end');
        $time = date("Y-m-d:");

        if ($start != NULL) {
            $modelPegawai = Pegawai::find()
                ->leftJoin('monitoring_honorarium', 'monitoring_honorarium.idPegawai = pegawai.id')
                ->where(['between', 'monitoring_honorarium.tanggal', $start, $end])    
                ->orderBy(['COUNT(monitoring_honorarium.idPegawai)' => SORT_DESC])
                ->groupBy('idPegawai')             
                ->all();

            
        } else {
            $modelPegawai = Pegawai::find()
                ->rightJoin('monitoring_honorarium', 'monitoring_honorarium.idPegawai = pegawai.id')
                ->orderBy(['COUNT(monitoring_honorarium.idPegawai)' => SORT_DESC])
                ->groupBy('idPegawai')             
                ->all();
                
        }
        return $this->render('index-honorarium', [
            'modelPegawai' => $modelPegawai,
            'start' => $start,
            'end' => $end,
        ]);
    
        
    }


}
