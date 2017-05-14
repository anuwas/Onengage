<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SubscriptionComponent]].
 *
 * @see SubscriptionComponent
 */
class SubscriptionComponentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SubscriptionComponent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SubscriptionComponent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
