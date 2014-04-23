<?php

class m140406_102913_about extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{about}}', array(
            'id' => 'pk',
            'description' => 'TEXT',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('{{about}}');
    }
}