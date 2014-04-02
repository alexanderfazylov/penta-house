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
            'upload_1_id' => 'INT NULL',
            'brand_id' => 'INT NULL',
            'meta_data_id' => 'INT NULL',
        ));

        $this->createTable('{{tag}}', array(
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
        ));

        $this->createTable('{{collection_tag}}', array(
            'id' => 'pk',
            'collection_id' => 'INT NOT NULL',
            'tag_id' => 'INT NOT NULL',
        ));


        $this->createTable('{{collection_upload}}', array(
            'id' => 'pk',
            'collection_id' => 'INT NOT NULL',
            'upload_id' => 'INT NOT NULL',
        ));

        $this->addForeignKey('tag_collection_tag', '{{collection_tag}}', 'collection_id', '{{tag}}', 'id');
        $this->addForeignKey('upload_collection_upload', '{{collection_upload}}', 'upload_id', '{{upload}}', 'id');

    }

    public function safeDown()
    {
        $this->dropForeignKey('tag_collection_tag', '{{collection_tag}}');
        $this->dropForeignKey('upload_collection_upload', '{{collection_upload}}');

        $this->dropTable('{{collection}}');
        $this->dropTable('{{tag}}');
        $this->dropTable('{{collection_tag}}');
        $this->dropTable('{{collection_upload}}');


    }
}