<?php

/**
 * Created by PhpStorm.
 * User: zxm
 * Date: 11/23/15
 * Time: 11:12 AM
 */
require '../vendor/autoload.php';
use Acme\ShoppingCart\Cart;
use Acme\ShoppingCart\CartItem;
session_start();
class CartTest extends PHPUnit_Framework_TestCase
{
    public function testCart() {
        $cart = new Cart();
        $this->assertEmpty($_SESSION['cart']);
        $item = new CartItem(1, "fitbit", 10.00, 2, 1);
        $cart->addItem($item);
        $this->assertTrue($cart->hasItem(1));
        $this->assertFalse($cart->hasItem(2));
        $this->assertFalse($cart->hasItem(3));
        $this->assertFalse($cart->hasItem(4));
        $cart->updateItemQuantity(1, 3);
        $this->assertEquals(3, $cart->getQuantity());
        $this->assertEquals(36, $cart->getTotal());
        $this->assertEquals(6, $cart->getShipping());
        $this->assertEquals(30, $cart->getSubtotal());
        $cart->removeItem(1);
        $this->assertEquals(0, $cart->getQuantity());
        $this->assertEquals(0, $cart->getTotal());
        $this->assertEquals(0, $cart->getShipping());
        $this->assertEquals(0, $cart->getSubtotal());

    }


}
