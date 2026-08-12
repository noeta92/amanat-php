<?php

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFile extends Model {

    /**
     * @var UploadedFile
     */

    public $file;
    public $id;

    public function rules() {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, jpeg, jpg, png', 'maxFiles' => 50, 'maxSize' => 1024 * 1024 * 2],
            [['id', 'file'], 'required']
        ];
    }

    public function attributeLabels() {
        return [
            'file' => 'Berkas File',
        ];
    }


}

?>
