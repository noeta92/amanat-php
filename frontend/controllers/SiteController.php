<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\search\PosSearch;
use common\models\Pos;
use common\models\SuratMasuk;
use common\models\SuratMasukBidang;
use common\models\SuratKeluar;
use common\models\Bidang;
use common\models\MonitoringPerjadin;
use common\models\MonitoringLembur;
use common\models\MonitoringHonorarium;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $roles = \common\models\AuthAssignment::find()->where(['user_id' => \Yii::$app->user->getId()])->one();
        $item_name = $roles->item_name;
        $bidang = \common\models\User::find()->where(['id' => \Yii::$app->user->getId()])->one();

        $start = Yii::$app->request->post('start');
        $end = Yii::$app->request->post('end');
        $time = date("Y-m-d:");
        
        if ($item_name == 'Kabid') {

            $masuk_today = SuratMasukBidang::find()
                ->leftJoin('surat_masuk', 'surat_masuk_bidang.noSurat = surat_masuk.id')               
                ->where(['surat_masuk.tanggalTerimaKirim' => $time])
                ->andWhere(['surat_masuk_bidang.kodeBidang' => $bidang])
                ->groupBy('noSurat') 
                ->count();

            $keluar_today = SuratKeluar::find()
                ->where(['tanggalSurat' => $time])
                ->andWhere(['kodeBidang' => $bidang])
                ->count();

        } else {

            $masuk_today = SuratMasuk::find()
            ->where(['tanggalTerimaKirim' => date("Y-m-d")])
            ->count();

            $keluar_today = SuratKeluar::find()
            ->where(['tanggalSurat' => $time])
            ->count();

        }

        $bidang_chart = [];
        $tanggal_chart = [];

        if ($start != null) {

            $surat_masuk =  SuratMasuk::find()
                ->where(['between', 'tanggalTerimaKirim', $start, $end ])
                ->count();

            $surat_keluar =  SuratKeluar::find()
                ->where(['between', 'tanggalSurat', $start, $end ])
                ->count();

            $surat_semua = $surat_masuk + $surat_keluar;

            foreach (Bidang::find()->all() as $key => $value) {
                $bidang_chart['kategori'][] = (string)$value->bidang;
                $bidang_chart['masuk'][] = (int)$value->getSuratMasukBidang()
                                        ->leftJoin('surat_masuk', 'surat_masuk_bidang.noSurat = surat_masuk.id')
                                        ->groupBy('noSurat')                
                                        ->Where(['between', 'surat_masuk.tanggalTerimaKirim', $start, $end ])->count();
                $bidang_chart['keluar'][] = (int)$value->getSuratKeluar()->andwhere(['between', 'tanggalSurat', $start, $end ])->count();
                }
            
            $totalPerjadin = MonitoringPerjadin::find()->where(['between', 'tanggal_awal', $start, $end ])->count();
            $totalLembur = MonitoringLembur::find()->where(['between', 'tanggal_awal', $start, $end ])->count();
            $totalHonor = MonitoringHonorarium::find()->where(['between', 'tanggal', $start, $end ])->count();

            $idUser = [];
            $idUser[] = 1;
            $idUser[] = 29;
            $idUser[] = 30;
            $idUser[] = 31;

            foreach (User::find()->where(['not in','id', $idUser])->all() as $key => $value) {
                $monitoring_chart['kategori'][] = (string)$value->username;
                $monitoring_chart['perjadin'][] = (int)$value->getPerjadin()->andwhere(['between', 'tanggal_awal', $start, $end ])->count();
                $monitoring_chart['lembur'][] = (int)$value->getLembur()->andwhere(['between', 'tanggal_awal', $start, $end ])->count();
                $monitoring_chart['honor'][] = (int)$value->getHonor()->andwhere(['between', 'tanggal', $start, $end ])->count();
            }
    
        } else {

            $surat_masuk =  SuratMasuk::find()->count();
            $surat_keluar = SuratKeluar::find()->count();

            $surat_semua = $surat_masuk + $surat_keluar;

            foreach (Bidang::find()->all() as $key => $value) {
            $bidang_chart['kategori'][] = (string)$value->bidang;
            $bidang_chart['masuk'][] = (int)$value->getSuratMasukBidang()->count();
            $bidang_chart['keluar'][] = (int)$value->getSuratKeluar()->count();
            }

            foreach (SuratMasuk::find()->groupBy('tanggalTerimaKirim')->all() as $key => $value) {
            $tanggal_chart['kategori'][] = (string)($value->timeCreated);
            //$tanggal_chart['tu'][] = (int)count($value->tanggalLapor);
            // $tanggal_chart['tu'][] = (int)($value->tanggalLapor)->count();
            //  $tanggal_chart['pdsk'][] = (int)$value->getPengaduans()->Where(['kodeBagian' => [5]])->count();
            }

            $totalPerjadin = MonitoringPerjadin::find()->count();
            //$totalPerjadin = MonitoringPerjadin::find()->all();
            $totalLembur = MonitoringLembur::find()->count();
            $totalHonor = MonitoringHonorarium::find()->count();

            $idUser = [];
            $idUser[] = 1;
            $idUser[] = 29;
            $idUser[] = 30;

            foreach (User::find()->where(['not in','id', $idUser])->all() as $key => $value) {
                $monitoring_chart['kategori'][] = (string)$value->username;
                $monitoring_chart['perjadin'][] = (int)$value->getPerjadin()->count();
                $monitoring_chart['lembur'][] = (int)$value->getLembur()->count();
                $monitoring_chart['honor'][] = (int)$value->getHonor()->count();
            }
        }

        

        return $this->render('index',[
        'masuk_today' => $masuk_today,
        'keluar_today' => $keluar_today,
        'surat_masuk' => $surat_masuk,
        'surat_keluar'=> $surat_keluar,
        'surat_semua' => $surat_semua,
        'bidang_chart' => $bidang_chart,
        'item_name'=> $item_name,
        //'tanggal_chart' => $tanggal_chart,
        'start' => $start,
        'end' => $end,
        'totalPerjadin' => $totalPerjadin,
        'totalLembur' => $totalLembur,
        'totalHonor' => $totalHonor,
        'monitoring_chart' => $monitoring_chart
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
