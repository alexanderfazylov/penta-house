<?php

class m140419_172749_contact_changes extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{contact}}', 'default_in_city', 'INT NULL DEFAULT 0');
    }

    public function safeDown()
    {
        $this->dropColumn('{{contact}}', 'default_in_city');
    }
}