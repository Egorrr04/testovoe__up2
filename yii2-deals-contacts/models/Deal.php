<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "deal".
 *
 * @property int $id
 * @property string $name
 * @property float|null $amount
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Contact[] $contacts
 */
class Deal extends ActiveRecord
{
    public $contactIds = [];

    public static function tableName()
    {
        return 'deal';
    }

    public function rules()
{
    return [
        [['name'], 'required'],
        [['amount'], 'number'],
        [['created_at', 'updated_at'], 'integer'],
        [['name'], 'string', 'max' => 255],
        [['contactIds'], 'each', 'rule' => ['integer']], 
    ];
}

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'amount' => 'Сумма',
            'contactIds' => 'Контакты',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getContacts()
    {
        return $this->hasMany(Contact::class, ['id' => 'contact_id'])
            ->viaTable('deal_contact', ['deal_id' => 'id']);
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->contactIds = $this->getContacts()->select('id')->column();
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        
        $currentContactIds = $this->getContacts()->select('id')->column();

       
        $newContactIds = is_array($this->contactIds) ? $this->contactIds : [];

        
        foreach (array_diff($newContactIds, $currentContactIds) as $contactId) {
            if ($contact = Contact::findOne($contactId)) {
                $this->link('contacts', $contact);
            }
        }

    
        foreach (array_diff($currentContactIds, $newContactIds) as $contactId) {
            if ($contact = Contact::findOne($contactId)) {
                $this->unlink('contacts', $contact, true);
            }
        }
    }
}