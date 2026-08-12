<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\PelaporInternal]].
 *
 * @see \common\models\PelaporInternal
 */
class PelaporInternalQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\PelaporInternal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\PelaporInternal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
