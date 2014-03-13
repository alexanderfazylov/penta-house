<?php

class m140313_125248_user extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{user}}', array(
            'id' => 'pk',
            'password' => 'VARCHAR(255) NOT NULL',
            'username' => 'VARCHAR(255) NOT NULL',
        ));

        $this->insert('{{user}}', array(
            'password' => md5('demo'),
            'username' => 'demo',
        ));

    }

    public function safeDown()
    {
    }

}