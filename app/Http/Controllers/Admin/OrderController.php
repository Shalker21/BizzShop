<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Contracts\OrderContract;
use App\Contracts\ProductContract;
use App\Contracts\ProductVariantContract;
use App\Models\Product;
use App\Models\ProductVariant;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $productRepository;
    protected $productVariantRepository;

    public function __construct(
        OrderContract $orderRepository,
        ProductContract $productRepository,
        ProductVariantContract $productVariantRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
    }
    public function index()
    {
        return view('admin.Orders.index');
    }

    public function getOrders(Request $request)
    {
        $this->orderRepository->getOrders($request);
    }

    public function show($id)
    {
        $orderItems = OrderItem::with('product')->where('order_id', $id)->get();
        $products = [];
        foreach ($orderItems as $v) {
            
            $products[$v->id] = [];
            $product = Product::with('product_translation')->where('_id', $v->product_id)->get();
            
            if (empty($product[0])) {
                $product = ProductVariant::with('variant_translation')->where('_id', $v->product_id)->get();
                
                array_push($products[$v->id], [
                    'product_name' => $product[0]->variant_translation->name,
                ]);
            } else {
                array_push($products[$v->id], [
                    'product_name' => $product[0]->product_translation->name,
                ]);
            }

            array_push($products[$v->id], [
                'order_id' => $v->id,
                'quantity' => $v->quantity,
                'price' => $v->price,
                'special_price' => $v->special_price,
            ]);

            
        }
        
        return view('admin.Orders.show', ['products' => $products]);
    }
    
}
