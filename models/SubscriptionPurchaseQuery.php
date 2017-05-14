<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SubscriptionPurchase]].
 *
 * @see SubscriptionPurchase
 */
class SubscriptionPurchaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SubscriptionPurchase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SubscriptionPurchase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
