<?php

namespace App\Contracts;

interface OrderContract
{
    public function getOrders(object $request);
    public function storeOrderDetails(array $params);
}