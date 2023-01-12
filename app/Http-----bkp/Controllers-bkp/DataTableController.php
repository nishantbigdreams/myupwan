<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Product;
use App\Complain;
use App\Category;
use App\ReturnOrder;
use Illuminate\Http\Request;

class DataTableController extends Controller
{
    public function liveListing(Request $request)
    {
        $data = array();

        $filter_data = $this->prepare_filter_data($request->data);

        $products = Product::when(count($filter_data), function($query) use($filter_data){
                for ($i = 0; $i < count($filter_data); $i++) {
                    //category filter
                    if ($filter_data[$i][0] == 'category') {
                        $query->orWhere('category', 
                            str_replace('+',' ',$filter_data[$i][1]));
                    }
                    //stock filter
                    if ($filter_data[$i][0] == 'stock_from' && $filter_data[$i][1] != '') {
                        $query->where('in_stock', '>=', $filter_data[$i][1]);
                    }
                    if ($filter_data[$i][0] == 'stock_to' && $filter_data[$i][1] != '') {
                        $query->where('in_stock', '<=', $filter_data[$i][1]);
                    }
                    if ($filter_data[$i][0] == 'stock_level') {
                        if ($filter_data[$i][1] == '0') {
                            $query->orWhere('in_stock', 0);
                        }elseif($filter_data[$i][1] == 'less_than_5'){
                            $query->orWhere('in_stock', '<=', 5);
                        }elseif($filter_data[$i][1] == 'more_than_5'){
                            $query->orWhere('in_stock', '>=', 5);
                        }
                    }

                }
            })->orderBy('updated_at', 'desc')->get();

        foreach ($products as $key => $product) {
            array_push($data,array(
                "",
                "
                    <img src='". ($product->featuredImage->url ?? '') ."' class='img-responsive' style='width:80px'>",
                "
                    <strong>$product->name</strong><br>
                    <strong>SKU</strong>: $product->sku, 
                    <strong>Category</strong>: $product->category <br>",
                "
                    <span>".intVal($product->in_stock)."</span>
                    <a href='javascript:;' class='text-primary edit' id='$product->id' data-type='stock'>
                        <i class='ti ti-pencil'></i>
                    </a>",
                "
                    <span> ".($product->price_without_gst ?? 0)." </span>
                    <a href='javascript:;' class='text-primary edit' id='$product->id' data-type='sell_price'>
                        <i class='ti ti-pencil'></i>
                    </a>
                    ",
                "
                    <a target='_blank' href='".route('product.show', [$product->category,$product->sku,$product->id])."' class='table-action-btn h3' tip title='View on Website'>
                        <i class='mdi mdi-eye text-info'></i>
                    </a>

                    <a href='".route('admin.product.edit', $product->id)."' class='table-action-btn h3' tip title='Edit Selling Attirbute'>
                        <i class='mdi mdi-pencil-box-outline text-success'></i>
                    </a>

                    <a href='javascript:;' class='table-action-btn h3 archive' tip title='Archived' id='$product->id'>
                        <i class='mdi mdi-close-box-outline text-danger'></i>
                    </a>

                    <a href='".route('admin.clone.product', $product->id)."' class='table-action-btn h3' tip title='Clone Product' target='_blank'>
                        <i class='fa fa-copy text-default'></i>
                    </a>

                    <a href='#calculator' data-toggle='modal' class='table-action-btn h3 calculator' tip title='Calculator' data-price='".($product->price_without_gst ?? 0)."' id='".$product->id."'>
                        <i class='mdi mdi-calculator text-custom'></i>
                    </a>",
            ));
        }

        return response()->json([
            'data'=>$data
        ]);
    }

    public function archiveListing(Request $request)
    {
        $data = array();

        $products = Product::onlyTrashed()->get();

        foreach ($products as $key => $product) {
            array_push($data,array(
                "",
                "
                    <img src='". featuredImage($product) ."' class='img-responsive' style='width:80px'>",
                "
                    <strong>$product->name</strong><br>
                    <strong>SKU</strong>: $product->sku<br>",
                "
                    <a href='javascript:;' class='table-action-btn h3 undo_archive' ='50%' title='Un Archive Product' id='$product->id'>
                        <i class='fa fa-undo text-info'></i>
                    </a>
                    <a href='javascript:;' class='table-action-btn h3 delete' ='50%' title='Permanent Delete' id='$product->id'>
                        <i class='fa fa-trash text-danger'></i>
                    </a>
                ",
            ));
        }

        return response()->json([
            'data'=>$data
        ]);
    }

    public function payments($date = null)
    {
        $data = array();
        if(!$date) {
            $date = date('Y').'-'.date('m');
        }
        $temp = explode('-', $date);
        $payments = Order::with('payment')->whereMonth('created_at', $temp[1])
                        ->whereYear('created_at', $temp[0])
                        ->orderBy('id', 'desc')
                        ->get();

        foreach ($payments as $key => $order) {
            array_push($data,array(
                strtoupper($order->payment->invoice_no),
                date('M, Y', strtotime($order->created_at)),
                $order->payment->utr_no,
                strtoupper($order->payment->method),
                '&#8377; '. $order->total,
                "<a href=".route('admin.order.show', $order->id).">
                    <i class='fa fa-eye text-custom'></i> View More
                </a>"
            ));
        }

        return response()->json(['data'=>$data]);
    }

    public function customerIndex()
    {
        $data = array();
        $users = User::withCount('orders')->orderBy('orders_count', 'desc')->get();
        foreach ($users as $key => $user) {
            array_push($data, array(
                '',
                strtoupper($user->name),
                $user->email,
                $user->phone,
                $user->orders_count,
                "<a href='".route('admin.customer.show', $user)."'>
                    <i class='fa fa-eye'></i> View
                </a>",
            ));
        }
        return response()->json(['data'=>$data]);
    }

    public function salesReport(Request $request)
    {
        $data = [];
        $payments = Order::with(['payment','user'])
                        ->where('created_at','>=', $request->start.'-01')
                        ->where('created_at','<=', $request->end.'-31')
                        ->orderBy('created_at', 'desc')
                        ->get();

        foreach ($payments as $key => $order) {
            array_push($data,array(
                '',
                $order->created_at->format('d M, Y'),
                ucfirst($order->user->name),
                strtoupper($order->payment->invoice_no),
                $order->payment->amount,
                implode('<br>', json_decode($order->product_name)),
                implode('<br>', json_decode($order->product_qty)),
                "<a href=".route('admin.order.show', $order->id).">
                    <i class='fa fa-eye text-custom'></i> View More
                </a>"
            ));
        }
        return response()->json(['data'=>$data]);
    }

    public function ordersReport(Request $request)
    {
        $data = [];
        $orders = Order::with(['payment','user'])
                        ->when($request->status, function($query) use($request){
                            $query->where('status', $request->status);
                        })
                        ->where('created_at','>=', $request->start.'-01')
                        ->where('created_at','<=', $request->end.'-31')
                        ->orderBy('created_at', 'desc')
                        ->get();

        foreach ($orders as $key => $order) {
            array_push($data, array(
                '',
                ucfirst($order->user->name),
                $order->created_at->format('d M, Y'),
                strtoupper($order->payment->invoice_no),
                $order->payment->amount,
                $order->order_id,
                ucfirst($order->status),
            ));
        }

        return response()->json(['data'=>$data]);

    }

    public function categoryIndex()
    {
        $data = array();

        $categories = Category::orderBy('updated_at', 'DESC')->get();

        foreach ($categories as $key => $category) {
            array_push($data,array(
                '',
                $category->name,
                $category->sku_initial,
                $category->totalProducts($category->name),
                '<a href="'.route('admin.category.edit', $category->id).'" class="btn btn-primary btn-sm" title="Edit">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="#" class="btn btn-danger btn-sm delete" title="Delete" id="'.$category->id.'">
                    <i class="fa fa-times"></i>
                </a>'
            ));
        }

        return response()->json(['data' => $data]);
    }

    public function returnOrderIndex()
    {
        $data = array();

        foreach (ReturnOrder::all() as $key => $order) {
            $is_product_received = $order->is_product_received == 1 ? 'Product Received':'Product Not Received';
            $action = '';
            if($order->order->status == 'return'){
                $action .= '<a href="javascript:;" class="btn btn-primary btn-sm return_order" title="Register Return Order" data-id="'.$order->id.'">
                    <i class="fa fa-undo"></i>
                </a>';
            }
            if($order->order->status == 'return_registered' || $order->order->status == 'refund'){
                $action .= '<a href="/admin/awbReturnOrder/pdf/'.$order->id.'" class="btn btn-primary btn-sm " title="view pdf" data-id="'.$order->id.'" target="_blank">
                    <i class="fa fa-eye"></i>
                </a>
               
                ';

                if( $order->is_product_received == 1 && $order->order->status != 'refund'){
                    $action .= '
                <a href="javascript:;" class="btn btn-primary btn-sm refund" title="Refund" data-id="'.$order->id.'">
                    <i class="fa fa-undo"></i>
                </a>';
                }
                if($order->is_product_received != 1){
                    $action .= ' <a href="javascript:;" class="btn btn-primary btn-sm is_product_received" title="Is Product Received" data-id="'.$order->id.'">
                    <i class="fa fa-check"></i>
                </a>';
                }
            }
            if($order->order->status == 'refund'){
                $action .=  '<a href="javascript:;" class="btn btn-success btn-sm is_refunded" title="Refunded" data-id="'.$order->id.'">
                    Refunded
                </a>
                ';
            }
            array_push($data,array(
                '',
                $order->order->user->name,
                $order->order->total,
                $order->reason,
                $order->bank,
                $order->account_no,
                $order->ifsc_code,
                $order->mobile,
                $order->email,
                $is_product_received,
                $action,
            ));
        }

        return response()->json(['data' => $data]);
    }

    public function complains()
    {
        $data = array();
        $complains = Complain::with(['order','order.user','order.payment'])
                            ->orderBy('id', 'desc')
                            ->get();

        foreach ($complains as $key => $complain) {
            array_push($data, array(
                '',
                $complain->order->user->name.'<br>'.
                $complain->order->user->phone,
                $complain->order->id,
                $complain->order->payment->invoice_no,
                $complain->order->status,
                $complain->type,
                '<span class="btn btn-sm btn-'.($complain->status == 'pending'? 'danger' : 'success').' text-uppercase status" id="'.$complain->id.'">
                '.$complain->status.'
                </span>',
                '<a href="#message" class="btn-link view-message" data-toggle="modal" data-message="'.$complain->body.'" data-title="'.$complain->type.'">
                    VIEW
                </a>'
            ));
        }
        return response()->json(['data' => $data]);
    }

    protected function prepare_filter_data($data)
    {
        $filtered_data = [];
        $filter_data = explode('&', $data);
        unset($filter_data[0]); //removing csrf_token

        foreach ($filter_data as $key => $data) {
            $tmp = explode('=', $data);
            array_push($filtered_data, array(
                $tmp[0],
                $tmp[1]
            ));
        }

        return $filtered_data;
    }
}
