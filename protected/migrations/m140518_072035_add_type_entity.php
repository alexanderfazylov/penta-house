<?php

class m140518_072035_add_type_entity extends CDbMigration
{
    public function safeUp()
    {
        //
        $this->addColumn('{{page}}', 'entity', 'VARCHAR(255) NULL');
        //
        $this->insert('{{page}}', array('name' => 'collection', 'entity' => 'Collection'));
        //
        $this->update('{{page}}', array('entity' => 'Contact'), 'id = 3');
        $this->update('{{page}}', array('entity' => 'Project'), 'id = 5');
        $this->update('{{page}}', array('entity' => 'Post'), 'id = 6');
        //
    }

    public function safeDown()
    {
        $this->dropColumn('{{page}}', 'entity');
    }

}