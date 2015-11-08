<?php

class CartItem
{
    private $id;
    private $name;
    private $price;
    private $shipping;
    private $quantity;


    /**
     * Item constructor.
     * @param $id
     * @param $name
     * @param $price
     * @param $shipping
     * @param $quantity
     */
    public function __construct($id, $name, $price, $shipping, $quantity)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->shipping = $shipping;
        $this->quantity = $quantity;
    }
    /**setters and getters*/
    /**
     * @return mixed
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param mixed $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }


}