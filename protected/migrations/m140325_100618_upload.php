<?php

class m140325_100618_upload extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{upload}}', array(
            'id' => 'pk',
            'file_name' => 'VARCHAR(255) NOT NULL',
            'user_file_name' => 'VARCHAR(255) NOT NULL',
            'ext' => 'VARCHAR(255) NOT NULL',
            'size' => 'VARCHAR(255) NOT NULL',
            'model' => 'VARCHAR(255) NULL',
            'attribute' => 'VARCHAR(255) NULL',
            'created' => 'time',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('{{upload}}');
    }
}