<?php

class m140430_075842_contact_changed extends CDbMigration
{
    public function safeUp()
    {
        $this->dropColumn('{{contact}}', 'monday_start');
        $this->dropColumn('{{contact}}', 'monday_end');
        $this->dropColumn('{{contact}}', 'tuesday_start');
        $this->dropColumn('{{contact}}', 'tuesday_end');
        $this->dropColumn('{{contact}}', 'wednesday_start');
        $this->dropColumn('{{contact}}', 'wednesday_end');
        $this->dropColumn('{{contact}}', 'thursday_start');
        $this->dropColumn('{{contact}}', 'thursday_end');
        $this->dropColumn('{{contact}}', 'friday_start');
        $this->dropColumn('{{contact}}', 'friday_end');
        $this->dropColumn('{{contact}}', 'saturday_start');
        $this->dropColumn('{{contact}}', 'saturday_end');
        $this->dropColumn('{{contact}}', 'sunday_start');
        $this->dropColumn('{{contact}}', 'sunday_end');
        /**/
        $this->addColumn('{{contact}}', 'weekdays', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'saturday', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'sunday', 'VARCHAR(255) NULL');
    }

    public function safeDown()
    {
        $this->addColumn('{{contact}}', 'monday_start', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'monday_end', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'tuesday_start', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'tuesday_end', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'wednesday_start', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'wednesday_end', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'thursday_start', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'thursday_end', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'friday_start', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'friday_end', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'saturday_start', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'saturday_end', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'sunday_start', 'VARCHAR(255) NULL');
        $this->addColumn('{{contact}}', 'sunday_end', 'VARCHAR(255) NULL');
    }
}