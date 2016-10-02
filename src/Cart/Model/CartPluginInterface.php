<?php

namespace Wambo\Cart\Model;


interface CartPluginInterface
{
    public function execute(Cart $cart);
}