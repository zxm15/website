<?php

namespace Acme\ShoppingCart;

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
        if (! isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

    }

    /**
     * @param CartItem $item
     */
    public function addItem(CartItem $item)
    {
        $id = $item->getId();
        if ($this->hasItem($id)) {
            $this->updateItemQuantity($item->getId(), $item->getQuantity());
            $oldItem = $this->getItem($id);
            $oldItem->setQuantity($item->getQuantity() + $oldItem->getQuantity);
        } else {
            $_SESSION['cart'][$item->getId()] = $item;
            $this->updateCart($item, $item->getQuantity());
        }
    }

    /**
     * @param $itemID
     * @param $quantity
     */
    public function updateItemQuantity($itemID, $quantity) {
        if ($quantity <= 0) throw new \InvalidArgumentException("Quantity must be larger than 0");
        else if (! $this->hasItem($itemID)) throw new \InvalidArgumentException("The product does not exist in your cart");
        $item = $this->getItem($itemID);
        $this->updateCart($item, $quantity - $item->getQuantity());
        $item->setQuantity($quantity);
    }
    /**
     * @param $itemID
     */
    public function removeItem($itemID)
    {
        $item = $this->getItem($itemID);
        $this->updateCart($item, -1 * $item->getQuantity());
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
        $this->total = $this->subtotal + $this->shipping + $this->tax;
    }

    /**
     * @param $itemID
     * @return mixed    cart item
     */
    public function getItem($itemID)
    {
        if (!$this->hasItem($itemID))
            throw new \InvalidArgumentException('The item does not exist in your shopping cart');
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
