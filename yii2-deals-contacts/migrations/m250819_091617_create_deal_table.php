<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%deal}}`.
 */
class m250819_091617_create_deal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
public function safeUp()
{
    $this->createTable('contact', [
        'id' => $this->primaryKey(),
        'first_name' => $this->string()->notNull(),
        'last_name' => $this->string(),
        'created_at' => $this->integer(),
        'updated_at' => $this->integer(),
    ]);
}

public function safeDown()
{
    $this->dropTable('contact');
}
}
