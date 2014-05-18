<?php

class m140518_072035_add_type_entity extends CDbMigration
{
    public function safeUp()
    {
        //
        $this->addColumn('{{page}}', 'entity', 'VARCHAR(255) NULL');
        $this->addColumn('{{page}}', 'view', 'VARCHAR(255) NULL');
        //
        $this->insert('{{page}}', array(
                'name' => 'collection',
                'entity' => 'Collection',
                'view' => 'collection',
            )
        );
        //
        $this->update('{{page}}',
            array(
                'entity' => 'Project',
                'view' => 'project'
            ),
            'id = 5');

        $this->update('{{page}}',
            array(
                'entity' => 'Post',
                'view' => 'post'
            ),
            'id = 6');
        //
    }

    public function safeDown()
    {
        $this->dropColumn('{{page}}', 'entity');
    }

}