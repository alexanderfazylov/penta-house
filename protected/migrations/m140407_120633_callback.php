<?php

class m140407_120633_callback extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{callback}}', array(
            'id' => 'pk',
            'text' => 'TEXT',
            'name' => 'VARCHAR(255) NULL',
            'phone' => 'VARCHAR(255) NOT NULL',
            'created' => 'datetime NOT NULL',
        ));


    }

    public function safeDown()
    {
        $this->dropTable('{{callback}}');
    }
}