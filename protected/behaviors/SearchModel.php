<?php

class SearchModel extends CBehavior
{


    public $behaviorsCriteria;

    public function condition($entity_id, $location_type)
    {

        $current_model = $this->owner->findByPk($entity_id);
        $entity = null;
        $current_index = null;
        $last_index = null;
        $search_index = null;

        $models = $this->owner->findAll($this->behaviorsCriteria);

        if (empty($models)) {
            throw new CHttpException(404, 'Нет записей для отображения');
        }


        if (empty($current_model)) {
            throw new CHttpException(404, 'Нет записей для отображения');
        }


        foreach ($models as $key => $model) {
            if ($model->id == $entity_id) {
                $current_index = $key;
            }
            $last_index = $key;
        }
        //
        unset($models[$current_index]);
        //
        if ($location_type == Page::MODEL_NEXT) {
            if ($current_index == $last_index) {
                $current_index = 0;
            } else {
                ++$current_index;
            }
        } else if ($location_type == Page::MODEL_PREV) {
            if ($current_index == 0) {
                $current_index = $last_index;
            } else {
                --$current_index;
            }
        } else {
            throw new CHttpException(404, 'Неверный запрос');
        }

        $response = array(
            'model' => $models[$current_index],
            'models' => $models
        );

        return $response;
    }

}