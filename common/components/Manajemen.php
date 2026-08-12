<?php

namespace common\components;

use Yii;
use yii\base\Component;

class Manajemen extends Component {
    
    public function getPenugasan($id = 0) {
        if ($id==0) $id = Yii::$app->user->getId();
        $value = Yii::$app->authManager->getRolesByUser($id);
        return isset(end($value)->name) ? end($value)->name : 'Guest';
    }
    
    public function getBagian() {
        if ($this->getPenugasan() == 'Kabid') {
            $data = \common\models\User::findOne(Yii::$app->user->getId());      
            return [
                'bagian_id' => $data->bagian_id,        
            ];
        }
        if ($this->getPenugasan() == 'admin') {
            $data = \common\models\User::findOne(Yii::$app->user->getId());
            return null;
        }
        return null;
    }

    public function getSurat() {
        if ($this->getPenugasan() == 'Kabid') {
        $bagian = $this->getBagian();

        $data = \common\models\SuratMasukBidang::find()->where(['kodeBidang' => $bagian])->andWhere(['statusSurat' => '0'])->count();
        return $data;
        }  
        
        if ($this->getPenugasan() == 'admin') {
        $data = \common\models\SuratKeluar::find()->where(['statusKirim' => '1'])->count();
        return $data;
        }
    }
    
}
?>
