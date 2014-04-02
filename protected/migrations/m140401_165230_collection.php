<?php

class m140401_165230_collection extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{collection}}', array(
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
            'slogan' => 'VARCHAR(255) NULL',
            'description' => 'TEXT',
            'order' => 'INT NULL',
            'maine_page_visible' => 'INT NULL DEFAULT 0',
            'sanitary_engineering' => 'INT NULL DEFAULT 0',
            'tile' => 'INT NULL DEFAULT 0',
            'upload_1_id' => 'INT NULL',
            'brand_id' => 'INT NULL',
            'meta_data_id' => 'INT NULL',
        ));

        $this->createTable('{{collection_upload}}', array(
            'id' => 'pk',
            'collection_id' => 'INT NOT NULL',
            'upload_id' => 'INT NOT NULL',
        ));


    }

    public function safeDown()
    {
        $this->dropTable('{{collection}}');
        $this->dropTable('{{collection_upload}}');
    }
}