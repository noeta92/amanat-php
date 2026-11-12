<?php

namespace frontend\tests\unit;

use common\models\Media;
use common\models\SuratMasuk;
use common\models\SuratMasukBidang;
use common\models\User;
use frontend\controllers\SuratMasukController;
use PHPUnit\Framework\TestCase;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

class WorkflowController extends SuratMasukController
{
    public $rendered;

    public function render($view, $params = [])
    {
        $this->rendered = [$view, $params];
        return '';
    }

    public function letter($id)
    {
        return $this->findModel($id);
    }

    public function assignment($id)
    {
        return $this->findModelBidang($id);
    }

    public function media($id)
    {
        return $this->findModelMedia($id);
    }
}

class SuratMasukWorkflowTest extends TestCase
{
    private $controller;

    protected function setUp(): void
    {
        new \yii\web\Application([
            'id' => 'workflow-test',
            'basePath' => dirname(__DIR__, 2),
            'components' => [
                'db' => ['class' => \yii\db\Connection::class, 'dsn' => 'sqlite::memory:'],
                'user' => ['identityClass' => User::class, 'enableSession' => false],
                'authManager' => ['class' => \yii\rbac\DbManager::class],
                'request' => ['cookieValidationKey' => 'test', 'enableCsrfValidation' => false],
            ],
        ]);
        $db = Yii::$app->db;
        foreach ([
            'CREATE TABLE user (id INTEGER PRIMARY KEY, bagian_id INTEGER)',
            'CREATE TABLE auth_item (name TEXT PRIMARY KEY, type INTEGER, description TEXT, rule_name TEXT, data TEXT, created_at INTEGER, updated_at INTEGER)',
            'CREATE TABLE auth_item_child (parent TEXT, child TEXT)',
            'CREATE TABLE auth_assignment (item_name TEXT, user_id TEXT, created_at INTEGER)',
            'CREATE TABLE auth_rule (name TEXT PRIMARY KEY, data TEXT, created_at INTEGER, updated_at INTEGER)',
            'CREATE TABLE bidang (id INTEGER PRIMARY KEY, bidang TEXT)',
            'CREATE TABLE klasifikasi (id INTEGER PRIMARY KEY, klasifikasi TEXT, Keterangan TEXT)',
            'CREATE TABLE surat_masuk (id INTEGER PRIMARY KEY AUTOINCREMENT, noSurat TEXT, asalTujuan TEXT, tanggalSurat TEXT, statusSurat INTEGER, kodeBidang INTEGER, kodeKlasifikasi INTEGER, perihal TEXT, uraianSurat TEXT, isiDisposisi TEXT, disposisiKaban TEXT, timeDisposisi INTEGER, jawabanDisposisi TEXT, timeJawaban INTEGER, userJawab_id INTEGER, tanggalTerimaKirim TEXT, namaTerimaKirim TEXT, timeCreated INTEGER)',
            'CREATE TABLE surat_masuk_bidang (id INTEGER PRIMARY KEY AUTOINCREMENT, noSurat INTEGER, statusSurat INTEGER, kodeBidang INTEGER, jawabanDisposisi TEXT, timeJawaban INTEGER, userJawab_id INTEGER, tanggalTerimaKirim TEXT, namaTerimaKirim TEXT)',
            'CREATE TABLE media (id INTEGER PRIMARY KEY, surat_id INTEGER, jenisSurat INTEGER, type TEXT, namaFile TEXT, file TEXT, uploadAt TEXT, uploadBy INTEGER)',
        ] as $sql) {
            $db->createCommand($sql)->execute();
        }
        $db->createCommand("INSERT INTO bidang VALUES (1, 'A'), (2, 'B')")->execute();
        $db->createCommand("INSERT INTO klasifikasi VALUES (1, '001', 'Umum')")->execute();
        $db->createCommand("INSERT INTO surat_masuk (id, noSurat, asalTujuan, tanggalSurat, statusSurat, kodeKlasifikasi, perihal, uraianSurat, timeCreated) VALUES (1, 'A', 'Pengirim', '2026-01-01', 0, 1, 'Perihal', 'Isi', 1), (2, 'B', 'Pengirim', '2026-01-01', 0, 1, 'Perihal', 'Isi', 1)")->execute();
        $db->createCommand("INSERT INTO surat_masuk_bidang (id, noSurat, statusSurat, kodeBidang) VALUES (1, 1, 0, 1), (2, 1, 0, 2), (3, 2, 0, 2)")->execute();
        $db->createCommand("INSERT INTO media (id, surat_id, jenisSurat, file) VALUES (1, 1, 0, 'incoming.pdf'), (2, 1, 1, 'outgoing.pdf')")->execute();
        $db->createCommand("INSERT INTO auth_item (name, type) VALUES ('admin', 1), ('Kabid', 1), ('Keuangan', 1), ('/surat-masuk/index', 2), ('/surat-masuk/view-disposisi', 2)")->execute();
        $db->createCommand("INSERT INTO auth_item_child VALUES ('Kabid', '/surat-masuk/index'), ('Kabid', '/surat-masuk/view-disposisi'), ('Keuangan', '/surat-masuk/index'), ('Keuangan', '/surat-masuk/view-disposisi')")->execute();
        $this->controller = new WorkflowController('surat-masuk', Yii::$app);
        Yii::$app->controller = $this->controller;
        $_SERVER['REQUEST_METHOD'] = 'GET';
    }

    protected function tearDown(): void
    {
        Yii::$app = null;
        unset($_SERVER['REQUEST_METHOD']);
    }

    private function loginAs($role, $department = 1)
    {
        Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => $role, 'user_id' => '10'])->execute();
        Yii::$app->user->setIdentity(new User(['id' => 10, 'bagian_id' => $department]));
    }

    private function post(array $data)
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        Yii::$app->request->setBodyParams($data);
    }

    public function testDepartmentUsersCannotAccessOtherDepartmentsOrOutgoingMedia()
    {
        $this->loginAs('Keuangan');
        $this->assertSame(1, (int) $this->controller->letter(1)->id);
        $this->assertSame(1, (int) $this->controller->media(1)->id);
        $this->assertCount(1, SuratMasuk::findOne(1)->medias);
        try {
            $this->controller->assignment(2);
            $this->fail('Another department assignment was accessible');
        } catch (ForbiddenHttpException $e) {
            $this->assertNotEmpty($e->getMessage());
        }
        try {
            $this->controller->media(2);
            $this->fail('Outgoing media was accessible');
        } catch (\yii\web\NotFoundHttpException $e) {
            $this->assertNotEmpty($e->getMessage());
        }
        $this->expectException(ForbiddenHttpException::class);
        $this->controller->letter(2);
    }

    public function testDepartmentListAndRoutePermissions()
    {
        $this->loginAs('Kabid');
        $this->assertTrue($this->controller->beforeAction($this->controller->createAction('index')));
        $this->controller->actionIndex();
        $provider = $this->controller->rendered[1]['dataProvider'];
        $this->assertCount(1, $provider->getModels());
        $this->expectException(ForbiddenHttpException::class);
        $this->controller->beforeAction($this->controller->createAction('create'));
    }

    public function testRegistrationValidatesAndIgnoresUnrelatedFields()
    {
        $this->loginAs('admin');
        $this->post(['SuratMasuk' => ['noSurat' => '', 'tanggalSurat' => 'not-a-date']]);
        $this->controller->actionCreate();
        $this->assertSame(2, (int) SuratMasuk::find()->count());
        $this->assertTrue($this->controller->rendered[1]['model']->hasErrors());

        $this->post(['SuratMasuk' => [
            'noSurat' => 'C', 'asalTujuan' => 'Pengirim', 'tanggalSurat' => '2026-01-01',
            'kodeKlasifikasi' => 1, 'perihal' => 'Perihal', 'uraianSurat' => 'Isi',
            'statusSurat' => 3, 'isiDisposisi' => 'forged',
        ]]);
        $this->controller->actionCreate();
        $created = SuratMasuk::find()->where(['noSurat' => 'C'])->one();
        $this->assertNotNull($created);
        $this->assertSame(0, (int) $created->statusSurat);
        $this->assertNull($created->isiDisposisi);
    }

    public function testAssignmentRejectsDuplicateAndInvalidDepartmentsWithoutChangingLetter()
    {
        $this->loginAs('admin');
        foreach ([[1], [999], []] as $ids) {
            $this->post(['SuratMasuk' => ['statusSurat' => 2, 'isiDisposisi' => 'Test'],
                'SuratMasukBidang' => ['kodeBidang' => $ids]]);
            $this->controller->actionUpdateDisposisi(1);
            $this->assertTrue($this->controller->rendered[1]['model2']->hasErrors());
            $this->assertSame(0, (int) SuratMasuk::findOne(1)->statusSurat);
            $this->assertSame(2, (int) SuratMasukBidang::find()->where(['noSurat' => 1])->count());
        }
        $this->post(['SuratMasuk' => ['statusSurat' => 2, 'isiDisposisi' => 'Test'],
            'SuratMasukBidang' => ['kodeBidang' => [1]]]);
        $this->controller->actionUpdateDisposisi(2);
        $this->assertSame(2, (int) SuratMasuk::findOne(2)->statusSurat);
        $this->assertTrue(SuratMasukBidang::find()->where(['noSurat' => 2, 'kodeBidang' => 1])->exists());
    }

    public function testUploadValidatorRejectsSpoofedAndDisallowedFiles()
    {
        $path = Yii::getAlias('@frontend/web/dok/masuk/amanat4.png');
        $media = new Media();
        foreach (['payload.php', 'fake.pdf'] as $name) {
            $media->file = new UploadedFile(['name' => $name, 'tempName' => $path,
                'size' => filesize($path), 'error' => UPLOAD_ERR_OK]);
            $this->assertFalse($media->validate(['file']), $name);
        }
        $media->file = new UploadedFile(['name' => 'image.png', 'tempName' => $path,
            'size' => filesize($path), 'error' => UPLOAD_ERR_OK]);
        $this->assertTrue($media->validate(['file']));
    }

    public function testAssignmentRollsBackWhenAnInsertFails()
    {
        $this->loginAs('admin');
        Yii::$app->db->createCommand('DELETE FROM surat_masuk_bidang WHERE noSurat = 1')->execute();
        Yii::$app->db->open();
        Yii::$app->db->pdo->exec("CREATE TRIGGER reject_second_assignment BEFORE INSERT ON surat_masuk_bidang WHEN NEW.kodeBidang = 2 BEGIN SELECT RAISE(FAIL, 'test failure'); END");
        $this->post(['SuratMasuk' => ['statusSurat' => 2, 'isiDisposisi' => 'Test'],
            'SuratMasukBidang' => ['kodeBidang' => [1, 2]]]);
        try {
            $this->controller->actionUpdateDisposisi(1);
            $this->fail('The failed assignment was not reported');
        } catch (\yii\db\Exception $e) {
            $this->assertStringContainsString('test failure', $e->getMessage());
        }
        $this->assertSame(0, (int) SuratMasuk::findOne(1)->statusSurat);
        $this->assertSame(0, (int) SuratMasukBidang::find()->where(['noSurat' => 1])->count());
    }
}
