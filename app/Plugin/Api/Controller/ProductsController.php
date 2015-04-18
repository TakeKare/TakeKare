<?php

class ProductsController extends ApiAppController
{

    public function collection()
    {
        if (!$this->request->is('post')) {
            throw new NotFoundException();
        }

        $data = $this->request->data;

        if (!$category = $this->Category->findByTitle($data['category'])) {
            throw new BadRequestException();
        }

        $data['category_id'] = $category['Category']['id'];

        if (!$this->Product->save($data)) {
            throw new NotFoundException('Update failed');
        }

        $data['id'] = $this->Product->id;

        $this->set($data);
        $this->set('_serialize', array_keys($data));
    }


}
