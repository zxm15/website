<?php

class Cart
{
    private $quantity = 0;
    private $subtotal = 0;
    private $shipping = 0;
    private $taxRate = 0;
    private $tax = 0;
    private $total = 0;

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        unset($_SESSION['cart']);
    }

    /**
     * @param CartItem $item
     */
    public function addItem(CartItem $item)
    {
        $id = $item->getId();
        if ($this->hasItem($id)) {
            $this->updateItemQuantity($item->getId(), $item->getQuantity() + $this->getItem($id)->getQuantity());
        } else {
            $_SESSION['cart'][$item->getId()] = $item;
        }
    }

    /**
     * @param $itemID
     * @param $quantity
     */
    public function updateItemQuantity($itemID, $quantity)
    {
        if (!$this->hasItem($itemID))
            throw new InvalidArgumentException('The item does not exist in your shopping cart');
        $oldItem = $this->getItem($itemID);
        $qtyDiff = $quantity - $oldItem->getQuantity();
        $oldItem->setQuantity($quantity);
        $this->updateCart($oldItem, $qtyDiff);
    }

    /**
     * @param $itemID
     */
    public function removeItem($itemID)
    {
        $item = $this->getItem($itemID);
        $qtyDiff = -1 * $item->getQuantity();
        updateCart($item, $qtyDiff);
        unset($_SESSION['cart'][$itemID]);
    }

    /**
     * @param CartItem $item
     * @param $qtyDiff  difference of the number of item in cart, could be positive or negative
     */
    private function updateCart(CartItem $item, $qtyDiff)
    {
        $this->quantity += $qtyDiff;
        $this->subtotal += $qtyDiff * $item->getPrice();
        $this->shipping += $qtyDiff * $item->getShipping();
        $this->tax += $qtyDiff * $item->getPrice() * $this->taxRate;
        $this->total += $qtyDiff * $item->getPrice() * (1 + $this->taxRate) + $qtyDiff * $item->getShipping();
    }

    /**
     * @param $itemID
     * @return mixed    cart item
     */
    public function getItem($itemID)
    {
        if (!$this->hasItem($itemID))
            throw new InvalidArgumentException('The item does not exist in your shopping cart');
        return $_SESSION['cart'][$itemID];
    }

    /**
     * @param $itemID
     * @return bool
     */
    public function hasItem($itemID)
    {
        return array_key_exists($itemID, $_SESSION['cart']);
    }


    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**setters and getters*/
    /**
     * @return int
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @return int
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @return int
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }


}