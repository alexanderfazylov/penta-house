<?php

class m140406_063347_post extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{post}}', array(
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
            'description' => 'TEXT',
            'order' => 'INT NULL',
            'visible' => 'INT NULL DEFAULT 0',
            'upload_1_id' => 'INT NULL',
            'meta_data_id' => 'INT NULL',
            'start_date' => 'date NULL',
        ));

        $this->createTable('{{post_upload}}', array(
            'id' => 'pk',
            'post_id' => 'INT NOT NULL',
            'upload_id' => 'INT NOT NULL',
        ));


    }

    public function safeDown()
    {
        $this->dropTable('{{post}}');
        $this->dropTable('{{post_upload}}');
    }
}