<?php

class m140420_054513_collection_changes extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{collection}}', 'index_slider', 'INT NULL DEFAULT 0');
        $this->addColumn('{{collection}}', 'upload_2_id', 'INT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{collection}}', 'index_slider');
        $this->dropColumn('{{collection}}', 'upload_2_id');
    }
}