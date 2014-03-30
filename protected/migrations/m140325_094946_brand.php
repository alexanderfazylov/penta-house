<?php

class m140325_094946_brand extends CDbMigration
{

    public function safeUp()
    {
        $this->createTable('{{brand}}', array(
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
            'description' => 'text',
            'site' => 'VARCHAR(255) NULL',
            'sert' => 'VARCHAR(255) NULL',
            'meta_data_id' => 'INT NULL',
            'upload_1_id' => 'INT NULL',
            'upload_2_id' => 'INT NULL',
            'upload_3_id' => 'INT NULL',
            'upload_4_id' => 'INT NULL',
            'maine_page_visible' => 'INT NULL DEFAULT 0',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('{{brand}}');
    }
}