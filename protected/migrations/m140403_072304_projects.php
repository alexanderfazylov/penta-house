<?php

class m140403_072304_projects extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{project}}', array(
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
            'description' => 'TEXT',
            'order' => 'INT NULL',
            'visible' => 'INT NULL DEFAULT 0',
            'upload_1_id' => 'INT NULL',
            'meta_data_id' => 'INT NULL',
            'end_date' => 'date NULL',
        ));

        $this->createTable('{{project_upload}}', array(
            'id' => 'pk',
            'project_id' => 'INT NOT NULL',
            'upload_id' => 'INT NOT NULL',
        ));


    }

    public function safeDown()
    {
        $this->dropTable('{{project}}');
        $this->dropTable('{{project_upload}}');
    }
}