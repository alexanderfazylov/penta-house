<?php

class m140506_161651_collection_technology extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{collection}}', 'entity_id', 'INT NOT NULL DEFAULT 1');

        $this->createTable('{{entity}}', array(
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
        ));

        $this->insert('{{entity}}', array(
            'id' => '1',
            'name' => 'коллекция',
        ));

        $this->insert('{{entity}}', array(
            'id' => '2',
            'name' => 'технология',
        ));
    }

    public function safeDown()
    {
        $this->dropColumn('{{collection}}', 'entity_id');
        $this->dropTable('{{entity}}');

    }
}