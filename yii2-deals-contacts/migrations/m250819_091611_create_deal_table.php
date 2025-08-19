<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%deal}}`.
 */
class m250819_091611_create_deal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
public function safeUp()
{
    $this->createTable('deal', [
        'id' => $this->primaryKey(),
        'name' => $this->string()->notNull(),
        'amount' => $this->decimal(10, 2),
        'created_at' => $this->integer(),
        'updated_at' => $this->integer(),
    ]);
}

public function safeDown()
{
    $this->dropTable('deal');
}
}
