<?php

class m140506_174604_page extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{page}}', array(
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
            'meta_data_id' => 'INT NULL',
        ));

        $this->insert('{{page}}', array('name' => 'index'));
        $this->insert('{{page}}', array('name' => 'about'));
        $this->insert('{{page}}', array('name' => 'contact'));
        $this->insert('{{page}}', array('name' => 'catalog'));
        $this->insert('{{page}}', array('name' => 'projects'));
        $this->insert('{{page}}', array('name' => 'posts'));

    }

    public function safeDown()
    {
        $this->dropTable('{{page}}');

    }
}