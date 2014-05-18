<?php

/**
 * Created by PhpStorm.
 * User: maksim
 * Date: 25.03.14
 * Time: 16:23
 */
class Helper
{
    public static function convertModelToArray($models, array $filterAttributes = null)
    {


        if (is_array($models))
            $arrayMode = TRUE;
        else {
            $models = array($models);
            $arrayMode = FALSE;
        }

        $result = array();
        foreach ($models as $model) {

            $attributes = $model->getAttributes();

            if (isset($filterAttributes) && is_array($filterAttributes)) {
                foreach ($filterAttributes as $key => $value) {

                    if (strtolower($key) == strtolower($model->tableName())) {
                        $value = str_replace(' ', '', $value);
                        $arrColumn = explode(",", $value);

                        if (strpos($value, '*') === FALSE) {
                            $attributes = array();
                        }

                        foreach ($arrColumn as $column) {
                            if ($column != '*') {
                                $attributes[$column] = $model->$column;
                            }
                        }
                        //foreach ($attributes as $key => $value) {
                        //if (!in_array($key, $arrColumn))
                        //unset($attributes[$key]);
                        //}
                    }
                }
            }


            $relations = array();
            foreach ($model->relations() as $key => $related) {
                if ($model->hasRelated($key) && !is_null($model->$key) && $related[0] != CActiveRecord::STAT) {
                    $relations[$key] = self::convertModelToArray($model->$key, $filterAttributes);
                }
            }
            $all = array_merge($attributes, $relations);

            if ($arrayMode)
                array_push($result, $all);
            else
                $result = $all;
        }
        return $result;
    }

    /**
     * Конвертация массива моделей со связями в json
     * @param $models
     * @param array $filterAttributes
     * @return string
     */
    public static function convertModelToJson($models, array $filterAttributes = null)
    {
        $array = self::convertModelToArray($models, $filterAttributes);
        return CJSON::encode($array);
    }


    public static function sendMail($view, $params)
    {
        $email = $params['recipient'];

        $mail_config = Yii::app()->params['smtp_params'];

        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->SMTPAuth = TRUE;
        $mailer->IsSMTP();
        //
        $mailer->Host = $mail_config['host'];
        $mailer->Username = $mail_config['user'];
        $mailer->Password = $mail_config['password'];
        //
        $mailer->From = $mail_config['user'];
        $mailer->AddAddress($email);
        //
        $mailer->Subject = $params['subject'];
        $mailer->FromName = $params['from_name'];
        //
        $mailer->setPathViews('application.views.mail_templates');
        $mailer->getView($view, $params);
        if (!$mailer->Send()) {
            Yii::log('Try to login with params: ' . print_r($mail_config, 1), 'warning');
            Yii::log($mailer->ErrorInfo, 'warning');
            return false;
        }
        return true;
    }

    public static function selectCity($contacts)
    {

        if (!empty($contacts) && empty(Yii::app()->session['city'])) {

            $chhtp = new CHttpRequest();
            //$ip = $chhtp->getUserHostAddress();
            //db test
            $ip = '217.198.1.70'; //KAZAN
            //$ip = '95.221.10.166'; //MOSCOW

            $sx_geo = new SxGeo('SxGeoCity.dat');
            $req = $sx_geo->get($ip);

            if (isset($req['city'])) {
                $city = mb_strtoupper($req['city'], 'UTF-8');
                foreach ($contacts as $contact) {
                    if (mb_strtoupper($contact->city, 'UTF-8') == $city) {
                        Yii::app()->session['city'] = $contact->city;
                        Yii::app()->session['contact_id'] = $contact->id;
                    }
                }
            } else {
                foreach ($contacts as $contact) {
                    if ($contact->default == Contact::DEFAULT_TRUE) {
                        Yii::app()->session['city'] = $contact->city;
                        Yii::app()->session['contact_id'] = $contact->id;
                    }
                }
            }
        }
//        Yii::app()->session['city'] = '';
//        Yii::app()->session['contact_id'] = '';
        return true;
    }

    public static function getPhone($contacts, $active_contact_id)
    {
        $phone = '';
        foreach ($contacts as $contact) {
            if ($contact->id == $active_contact_id) {
                $phone = $contact->phone;
            }
        }

        return $phone;
    }

    public static function getCity($contacts, $active_contact_id)
    {
        $city = '';
        foreach ($contacts as $contact) {
            if ($contact->id == $active_contact_id) {
                $city = $contact->city;
            }
        }

        return $city;
    }


    public static function getSrc($upload, $dop_path = false)
    {


        if (isset($upload->file_name)) {

            if ($dop_path) {
                $file_path = '/uploads/' . $dop_path . '/' . $upload->file_name;
            } else {
                $file_path = '/uploads/' . $upload->file_name;
            }

            $atr = "src='{$file_path}'";
        } else {
            $atr = "src='/i/default.png'";
        }


        return $atr;
    }


    public static function issetPhoto($collections)
    {
        foreach ($collections as $collection)
            if (!empty($collection->collection_upload))
                return true;

        return false;
    }


} 