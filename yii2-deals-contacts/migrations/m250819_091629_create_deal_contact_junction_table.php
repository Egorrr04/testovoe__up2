<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%deal_contact_junction}}`.
 */
class m250819_091629_create_deal_contact_junction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
public function safeUp()
{
    $this->createTable('deal_contact', [
        'deal_id' => $this->integer(),
        'contact_id' => $this->integer(),
        'PRIMARY KEY(deal_id, contact_id)',
    ]);

    $this->addForeignKey(
        'fk-deal_contact-deal_id',
        'deal_contact',
        'deal_id',
        'deal',
        'id',
        'CASCADE'
    );

    $this->addForeignKey(
        'fk-deal_contact-contact_id',
        'deal_contact',
        'contact_id',
        'contact',
        'id',
        'CASCADE'
    );
}

public function safeDown()
{
    $this->dropTable('deal_contact');
}
}
