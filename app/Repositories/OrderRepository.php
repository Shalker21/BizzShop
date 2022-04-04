<?php 

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Contracts\OrderContract;
use Illuminate\Validation\Rules\Unique;

class OrderRepository extends BaseRepository implements OrderContract
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function getOrders(object $request)
    {
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        
        if(empty($request->input('search.value'))) {
            $order_data = $this->model->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
        } else {
            $search_text = $request->input('search.value');
            $order_data = $this->model
            ->where('_id', $search_text)
            ->orWhere('order_number', 'like', "%{$search_text}%")
            ->orWhere('first_name', 'like', "%{$search_text}%")
            ->orWhere('last_name', 'like', "%{$search_text}%")
            ->orWhere('address_name', 'like', "%{$search_text}%")
            ->orWhere('city', 'like', "%{$search_text}%")
            ->orWhere('phone_number', 'like', "%{$search_text}%")
            ->orWhere('total', 'like', "%{$search_text}%")
            ->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
            
            $totalFilteredRecord = count($order_data);
        }

        $data_val = [];
        if(!empty($order_data)) {
            foreach ($order_data as $order_val) {
                
                $ordernestedData['id'] = $order_val->id;
                $ordernestedData['order_number'] = $order_val->order_number;
                $ordernestedData['first_name'] = $order_val->first_name;
                $ordernestedData['last_name'] = $order_val->last_name;
                $ordernestedData['address_name'] = $order_val->address;
                $ordernestedData['city'] = $order_val->city;
                $ordernestedData['phone_number'] = $order_val->phone_number;
                $ordernestedData['total'] = $order_val->total;
                $ordernestedData['payment_method'] = $order_val->payment_method;
                $ordernestedData['options'] = "&emsp;<a href='".route('admin.webshop.orders.show', ['id' => $order_val->id])."' class='bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded'><span class='showdata glyphicon glyphicon-list'>DETALJNO</span></a>&emsp;<p>-</p><a href='".route('admin.webshop.order.delete', ['id' => $order_val->id])."' class='bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded'>OBRIŠI</span></a>";
                
                $data_val[] = $ordernestedData;
            }
        }

        $draw_val = $request->input('draw');
        $get_json_data = [
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        ];

        echo json_encode($get_json_data);
    }

    public function storeOrderDetails(array $params)
    {
        $cart_data = unserialize(base64_decode($params['cart_data']));   
        unset($params['cart_data']);

        $params['order_number'] = uniqid();

        $order = new Order($params);
        $order->save();

        $params['order_id'] = $order->id;

        foreach ($cart_data as $product_id => $product_data) {
            $params['product_id'] = $product_id;
            $params['price'] = $product_data['unit_price'];
            $params['special_price'] = $product_data['unit_special_price'] !== null ? $product_data['unit_special_price'] : null;
            $params['quantity'] = (int)$product_data['item_qty'];

            $orderItems = new OrderItem($params);  
            $orderItems->save();
        }

        session()->forget('cart');

        return $order;
    }
}