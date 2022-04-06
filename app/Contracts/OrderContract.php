<?php

namespace App\Contracts;

interface OrderContract
{
    public function getOrders(object $request);
    public function storeOrderDetails(array $params);
    public function deleteOrder(string $id);
}