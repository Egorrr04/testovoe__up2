<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Deal[] $deals
 */
class Contact extends ActiveRecord
{
    public $dealIds = [];

    public static function tableName()
    {
        return 'contact';
    }

    public function rules()
{
    return [
        [['first_name'], 'required'],
        [['created_at', 'updated_at'], 'integer'],
        [['first_name', 'last_name'], 'string', 'max' => 255],
        [['dealIds'], 'each', 'rule' => ['integer']], 
    ];
}

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'dealIds' => 'Сделки',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getDeals()
    {
        return $this->hasMany(Deal::class, ['id' => 'deal_id'])
            ->viaTable('deal_contact', ['contact_id' => 'id']);
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->dealIds = $this->getDeals()->select('id')->column();
    }

    public function afterSave($insert, $changedAttributes)
{
    parent::afterSave($insert, $changedAttributes);
    
    
    $currentDealIds = $this->getDeals()->select('id')->column();
    
    
    $newDealIds = is_array($this->dealIds) ? $this->dealIds : [];
    
   
    foreach (array_diff($newDealIds, $currentDealIds) as $dealId) {
        if ($deal = Deal::findOne($dealId)) {
            $this->link('deals', $deal);
        }
    }
    
   
    foreach (array_diff($currentDealIds, $newDealIds) as $dealId) {
        if ($deal = Deal::findOne($dealId)) {
            $this->unlink('deals', $deal, true);
        }
    }
}

    public function getFullName()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}