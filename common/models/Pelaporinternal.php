<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelaporInternal".
 *
 * @property integer $user_id
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
 * @property string $instansi
 * @property string $email
 * @property string $handphone
 * @property string $user
 *
 * @property Pengaduan $user0
 */
class PelaporInternal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelaporInternal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nip', 'golongan', 'tmtTerakhir', 'fungsionalTertentu', 'fungsionalUmum', 'jabatanStruktural', 'eselon', 'status', 'instansi', 'email', 'handphone', 'user'], 'required'],
            [['nip'], 'string', 'max' => 18],
            [['nipLama'], 'string', 'max' => 9],
            [['nama'], 'string', 'max' => 40],
            [['tempatLahir', 'user'], 'string', 'max' => 30],
            [['tanggalLahir', 'tmtPns', 'tmtTerakhir'], 'string', 'max' => 17],
            [['golongan'], 'string', 'max' => 4],
            [['fungsionalTertentu', 'instansi'], 'string', 'max' => 50],
            [['fungsionalUmum', 'jabatanStruktural'], 'string', 'max' => 80],
            [['eselon'], 'string', 'max' => 5],
            [['status'], 'string', 'max' => 21],
            [['email', 'handphone'], 'string', 'max' => 128],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pengaduan::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'instansi' => 'Instansi',
            'email' => 'Email',
            'handphone' => 'Handphone',
            'user' => 'User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(Pengaduan::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\PelaporInternalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PelaporInternalQuery(get_called_class());
    }
}
