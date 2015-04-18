<?php

class CategoriesController extends ApiAppController
{

    public function collection()
    {
        $this->autoRender = false;

        $data = $this->Category->find('list');

        echo json_encode(array_values($data));

        //$this->set($data);
        //$this->set('_serialize', array_keys($data));
    }


}
