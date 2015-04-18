<?php

class OrderProductsController extends ApiAppController
{

    public function collection()
    {
        if (!$this->request->is('post')) {
            throw new NotFoundException();
        }

        $data = &$this->request->data;

        if (!$product = $this->Product->findByCode($data['code'])) {
            throw new NotFoundException();
        }

        $product = $product['Product'];

        if (!isset($data['order_id']) || !$data['order_id']) {
            $this->Order->create();
            $this->Order->save([]);

            $data['order_id'] = $this->Order->id;
        }

        $data['product_id'] = $product['id'];
        $data['title'] = $product['title'];
        $data['price'] = $product['price'];
        $data['amount'] = 1;

        if (!$this->OrderProduct->save($data)) {
            throw new NotFoundException('Error');
        }

        $data['id'] = $this->OrderProduct->id;

        $this->set($data);
        $this->set('_serialize', array_keys($data));
    }

    public function entity($id)
    {
        $product = null;
        if ($this->request->is(['delete'])) {
            $product = $this->OrderProduct->findById($id);
        }

        parent::entity($id);

        if ($this->request->is(['delete']) && $product) {
            $orderId = $product['OrderProduct']['order_id'];
            $productsCount = $this->OrderProduct->find('count', ['conditions' => ['order_id' => $orderId]]);
            if (!$productsCount) {
                $this->Order->delete($orderId);
            }
        }
    }

}
