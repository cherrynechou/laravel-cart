<?php

namespace CherryneChou\LaravelCart;

class Cart
{
  /**
     * Associated model name.
     *
     * @var string
     */
    protected $model;

    /**
     * @param $id
     * @param null $qty
     * @param array $attributes
     * @return Item
     * @throws \Exception
     */
    public function add($id, $qty = null, array $attributes = [])
    {
        return $this->addRow($id, $qty,  $attributes);
    }

    /**
     * @param $model
     * @return $this
     * @throws \Exception
     */
    public function associate($model)
    {
        if (!class_exists($model)) {
            throw new \Exception("Invalid model name '$model'.");
        }

        $this->model = $model;

        return $this;
    }

    /**
     * @param $id
     * @param $qty
     * @param array $attributes
     * @return Item
     * @throws \Exception
     */
    protected function addRow($id, $qty ,array $attributes = [])
    {
        if (!is_numeric($qty) || $qty < 1) {
            throw new \Exception('Invalid quantity.');
        }

        //生成方法  商品id 社区id
        $rawId = $this->generateRawId($id, $attributes);

        return $this->makeRow($rawId, $id, $qty, $attributes);
    }

    /**
     * @param $id
     * @param $attributes
     * @return string
     */
    protected function generateRawId($id, $attributes)
    {
        ksort($attributes);

        return md5($id  . serialize($attributes));
    }

    /**
     * @param $rawId
     * @param $id
     * @param $qty
     * @param array $attributes
     * @return Item
     */
    protected function makeRow($rawId, $id, $qty, array $attributes = [])
    {
        return new Item(array_merge([
            '__raw_id' => $rawId,
            'id' => $id,
            'qty' => $qty,
            '__model' => $this->model,
        ], $attributes));
    }
}
