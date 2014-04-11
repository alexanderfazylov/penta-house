<?php

class m140325_095812_meta_data extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{meta_data}}', array(
            'id' => 'pk',
            'description' => 'text',
            'keywords' => 'text',
            'title' => 'text',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('{{meta_data}}');
    }
}