<?php
/**
 * Created by PhpStorm.
 * User: zxm
 * Date: 11/23/15
 * Time: 6:57 PM
 */

namespace Acme\CrossSell;


class Node
{
    private $id;
    private $productID;
    private $upSell;
    private $downSell;

    /**
     * Node constructor.
     * @param $id
     * @param $productID
     */
    public function __construct($id, $productID)
    {
        $this->id = $id;
        $this->productID = $productID;

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
    public function getProductID()
    {
        return $this->productID;
    }

    /**
     * @param mixed $productID
     */
    public function setProductID($productID)
    {
        $this->productID = $productID;
    }

    /**
     * @return mixed
     */
    public function getUpSell()
    {
        return $this->upSell;
    }

    /**
     * @param mixed $upSell
     */
    public function setUpSell($upSell)
    {
        $this->upSell = $upSell;
    }

    /**
     * @return mixed
     */
    public function getDownSell()
    {
        return $this->downSell;
    }

    /**
     * @param mixed $downSell
     */
    public function setDownSell($downSell)
    {
        $this->downSell = $downSell;
    }




}