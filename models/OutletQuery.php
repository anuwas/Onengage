<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Outlet]].
 *
 * @see Outlet
 */
class OutletQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Outlet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Outlet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
