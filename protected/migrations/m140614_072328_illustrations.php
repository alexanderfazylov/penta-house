<?php

class m140614_072328_illustrations extends CDbMigration
{
    public function safeUp()
    {
        Yii::import('application.models.*');
        Yii::import('application.components.*');

        $uplods = Upload::model()->findAll();


        $base_path = '../uploads/';
        $illustration_path = 'illustration/';

        $ih = new CImageHandler();

        if (!is_dir($base_path . $illustration_path)) {
            mkdir($base_path . $illustration_path);
            chmod($base_path . $illustration_path, 0777);
        }

        foreach ($uplods as $index => $uplod) {

            $filename = $uplod->file_name;

            $width = 400;
            $height = 400;

            if (file_exists($base_path . $filename)) {
                $picter = $ih->load($base_path . $filename);

                if ($picter->getWidth() > $width || $picter->getHeight() > $height) {
                    $picter
                        ->resize($width, $height)
                        ->crop(400, 200);
                }

                $picter->save($base_path . $illustration_path . $filename);
                echo $index . ' on ' . count($uplods) . '===============';
            }
        }


    }

    public function safeDown()
    {


    }
}