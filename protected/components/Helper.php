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
                if ($model->hasRelated($key) && !is_null($model->$key)) {
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
} 