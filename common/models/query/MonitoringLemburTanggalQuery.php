<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\MonitoringLemburTanggal]].
 *
 * @see \common\models\MonitoringLemburTanggal
 */
class MonitoringLemburTanggalQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\MonitoringLemburTanggal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\MonitoringLemburTanggal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
