<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SubscriptionPackageDetail]].
 *
 * @see SubscriptionPackageDetail
 */
class SubscriptionPackageDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SubscriptionPackageDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SubscriptionPackageDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
