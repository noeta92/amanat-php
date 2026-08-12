<?php

namespace common\models\query\Pelaporinternal;

/**
 * This is the ActiveQuery class for [[\common\models\Pelaporinternal\Pelaporinternal]].
 *
 * @see \common\models\Pelaporinternal\Pelaporinternal
 */
class PelaporinternalQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Pelaporinternal\Pelaporinternal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Pelaporinternal\Pelaporinternal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
