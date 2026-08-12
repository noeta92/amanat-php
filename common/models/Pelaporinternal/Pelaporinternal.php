<?php

namespace common\models\Pelaporinternal;

use Yii;

/**
 * This is the model class for table "pelaporinternal".
 *
 * @property int $user_id
 * @property string $nip
 * @property string $nipLama
 * @property string $nama
 * @property string $tempatLahir
 * @property string $tanggalLahir
 * @property string $tmtPns
 * @property string $golongan
 * @property string $tmtTerakhir
 * @property string $fungsionalTertentu
 * @property string $fungsionalUmum
 * @property string $jabatanStruktural
 * @property string $eselon
 * @property string $status
 * @property int $kodeBagian
 * @property string $email
 * @property string $handphone
 * @property string $userInput
 *
 * @property User $user
 * @property Pengaduan[] $pengaduans
 */
class Pelaporinternal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelaporinternal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nip', 'golongan', 'tmtTerakhir', 'status', 'kodeBagian', 'userInput'], 'required'],
            [['kodeBagian'], 'integer'],
            [['nip'], 'string', 'max' => 18],
            [['nipLama'], 'string', 'max' => 9],
            [['nama'], 'string', 'max' => 40],
            [['tempatLahir', 'userInput'], 'string', 'max' => 30],
            [['tanggalLahir', 'tmtPns', 'tmtTerakhir'], 'string', 'max' => 17],
            [['golongan'], 'string', 'max' => 4],
            [['fungsionalTertentu'], 'string', 'max' => 50],
            [['fungsionalUmum', 'jabatanStruktural'], 'string', 'max' => 80],
            [['eselon'], 'string', 'max' => 5],
            [['status'], 'string', 'max' => 21],
            [['email', 'handphone'], 'string', 'max' => 128],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'nip' => 'Nip',
            'nipLama' => 'Nip Lama',
            'nama' => 'Nama',
            'tempatLahir' => 'Tempat Lahir',
            'tanggalLahir' => 'Tanggal Lahir',
            'tmtPns' => 'Tmt Pns',
            'golongan' => 'Golongan',
            'tmtTerakhir' => 'Tmt Terakhir',
            'fungsionalTertentu' => 'Fungsional Tertentu',
            'fungsionalUmum' => 'Fungsional Umum',
            'jabatanStruktural' => 'Jabatan Struktural',
            'eselon' => 'Eselon',
            'status' => 'Status',
            'kodeBagian' => 'Kode Bagian',
            'email' => 'Email',
            'handphone' => 'Handphone',
            'userInput' => 'User Input',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengaduans()
    {
        return $this->hasMany(Pengaduan::className(), ['pelaporInternal_id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\Pelaporinternal\PelaporinternalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\Pelaporinternal\PelaporinternalQuery(get_called_class());
    }
}
