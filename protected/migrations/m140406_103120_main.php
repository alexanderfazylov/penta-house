<?php

class m140406_103120_main extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{maine}}', array(
            'id' => 'pk',
            'direction_1' => 'TEXT',
            'direction_description_1' => 'TEXT',

            'direction_2' => 'TEXT',
            'direction_description_2' => 'TEXT',

            'direction_3' => 'TEXT',
            'direction_description_3' => 'TEXT',

            'direction_4' => 'TEXT',
            'direction_description_4' => 'TEXT',

            'vk_link' => 'VARCHAR(255) NULL',
            'fb_link' => 'VARCHAR(255) NULL',
            'tw_link' => 'VARCHAR(255) NULL',

        ));

        $this->insert('{{maine}}', array(
            'direction_1' => '',
            'direction_description_1' => '',

            'direction_2' => '',
            'direction_description_2' => '',

            'direction_3' => '',
            'direction_description_3' => '',

            'direction_4' => '',
            'direction_description_4' => '',

            'vk_link' => '',
            'fb_link' => '',
            'tw_link' => '',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('{{maine}}');
    }
}