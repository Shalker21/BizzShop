<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use App\Contracts\OrderContract;
use App\Contracts\ProductContract;
use App\Contracts\ProductVariantContract;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
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

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if ((int)$request->ordered) {
            $order->ordered = true;
        }
        if ((int)$request->paid) {
            $order->paid = true;
        }

        $order->save();
        $orderItems = OrderItem::with('product')->where('order_id', $id)->get();
        $order = Order::find($id);
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

            $selected_options_with_values = [];
            if (count($v->option_ids) > 0) {
                foreach ($v->option_ids as $option_id => $optionValue_id) {
                    $option = ProductOption::with(['values' => function ($query) use($optionValue_id) {
                        return $query->where('_id', $optionValue_id)->get();
                    } ])->where('_id', $option_id)->first();

                    $selected_options_with_values[$option->name] = $option->values[0]->value;
                }
            }

            array_push($products[$v->id], [
                'order_id' => $v->id,
                'quantity' => $v->quantity,
                'price' => $v->price,
                'special_price' => $v->special_price,
                'selected_options_with_values' => $selected_options_with_values,
            ]);

            
        }

        return view('admin.Orders.show', [
            'products' => $products,
            'orderData' => $order,
        ]);
    }

    public function show($id)
    {
        $orderItems = OrderItem::with('product')->where('order_id', $id)->get();
        $order = Order::find($id);
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

            $selected_options_with_values = [];
            if (count($v->option_ids) > 0) {
                foreach ($v->option_ids as $option_id => $optionValue_id) {
                    $option = ProductOption::with(['values' => function ($query) use($optionValue_id) {
                        return $query->where('_id', $optionValue_id)->get();
                    } ])->where('_id', $option_id)->first();

                    $selected_options_with_values[$option->name] = $option->values[0]->value;
                }
            }

            array_push($products[$v->id], [
                'order_id' => $v->id,
                'quantity' => $v->quantity,
                'price' => $v->price,
                'special_price' => $v->special_price,
                'selected_options_with_values' => $selected_options_with_values,
            ]);
        }

        return view('admin.Orders.show', [
            'products' => $products,
            'orderData' => $order,
        ]);
    }

    public function destroy($id)
    {
        $this->orderRepository->deleteOrder($id);
        
        return back()->with('delete', 'Uspješno ste obrisali narudžbu');
    }
    
}
