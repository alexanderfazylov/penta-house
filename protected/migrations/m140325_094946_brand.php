<?php

class m140325_094946_brand extends CDbMigration
{

    public function safeUp()
    {
        $this->createTable('{{brand}}', array(
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
            'description' => 'text',
            'upload_id' => 'VARCHAR(255) NULL',
            'meta_data_id' => 'INT NULL',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('{{brand}}');
    }
}