<?php

class m140406_074654_contacts extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{contact}}', array(
            'id' => 'pk',
            'city' => 'VARCHAR(255) NOT NULL',
            'phone' => 'VARCHAR(255) NULL',
            'address' => 'VARCHAR(255) NULL',
            'map' => 'TEXT',
            'order' => 'INT NULL',
            'type' => 'INT NULL',
            'visible' => 'INT NULL DEFAULT 0',

            'monday_start' => 'VARCHAR(255) NULL',
            'monday_end' => 'VARCHAR(255) NULL',

            'tuesday_start' => 'VARCHAR(255) NULL',
            'tuesday_end' => 'VARCHAR(255) NULL',

            'wednesday_start' => 'VARCHAR(255) NULL',
            'wednesday_end' => 'VARCHAR(255) NULL',

            'thursday_start' => 'VARCHAR(255) NULL',
            'thursday_end' => 'VARCHAR(255) NULL',

            'friday_start' => 'VARCHAR(255) NULL',
            'friday_end' => 'VARCHAR(255) NULL',

            'saturday_start' => 'VARCHAR(255) NULL',
            'saturday_end' => 'VARCHAR(255) NULL',

            'sunday_start' => 'VARCHAR(255) NULL',
            'sunday_end' => 'VARCHAR(255) NULL',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('{{contact}}');
    }
}