<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Mail\mailInvoice;
use App\Jobs\SendEmail;
use App\splitInvoice;
use App\CompanyInfo;
use App\Retention;
use Carbon\Carbon;
use PrefixHelper;
use App\Customer;
use App\Products;
use App\StockLog;
use App\Invoice;
use App\Payment;
use App\State;
use Company;
use PdfHelper;
use App\Item;
use Redirect;
use Session;
use View;
use Auth;
use Mail;
use Log;
use PDF;


class InvoiceController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function getGstInvoice(){
        $customers=Customer::where('tax','=','yes')->orderBy('id','desc')->get();
        $customer_inv =Customer::where('tax','=','yes')->whereHas('invoice')->get();
        return view('invoice.invoices',compact('customers','customer_inv'));
    }

    public function getNongstInvoice(){
        $customers=Customer::where('tax','!=','yes')->orderBy('id','desc')->get();
        $customer_inv =Customer::where('tax','!=','yes')
            ->orWhere('tax',null)
            ->whereHas('invoice')->get();

        return view('invoice.invoices',compact('customers','customer_inv'));
    }

    public function getSplitInvoice()
    {
        $start_date =   Input::get('start_date',null);
        $end_date =   Input::get('end_date',null);
        $invoices=splitInvoice::with('customer')
            ->when($start_date, function($query) use($start_date){
                $query->whereDate('due_date','>=',date('Y-m-d', strtotime($start_date)));
            })
            ->when($end_date, function($query) use ($end_date){
                $query->whereDate('due_date','<=',date('Y-m-d', strtotime($end_date)));
            })
            ->orderBy('id', 'desc')
            ->get();
        // dd($invoices);
        return view('invoice.split_invoices',compact('invoices'));
    }

    public function splitToInvoice(splitInvoice $split_invoice){
        $invoice_data = $split_invoice->toArray();

        unset($invoice_data['bill_no']);
        unset($invoice_data['id']);
        if($invoice_data['allow_gst']==1){
            $invoice_data['tax_invoice']=PrefixHelper::getInvoicePrefix(true);
        }else{
            $invoice_data['notax_invoice']=PrefixHelper::getInvoicePrefix(false);
        }
        $invoice_data['due_date'] = date('Y-m-d', strtotime($split_invoice['due_date']));
        $invoice_data['split_invoice'] = 0;
        // $invoice_data['contract_id'] = 0;
        // dd($invoice_data);
        $invoice = Invoice::create($invoice_data);
        $split_invoice->delete();
        Session::flash('success','Bill Converted to Invoice Successfully');

        return redirect()->to('/invoice/client/'.$invoice->customer_id)
            ->with('split_to_invoice',$invoice->tax_invoice ?? $invoice->notax_invoice);
    }

    public function getSplitBills(){
        $bills = array();
        $split_invoice = splitInvoice::with('customer')->orderBy('id', 'desc')->get();
        foreach($split_invoice as $bill){
            array_push($bills,array(
                'id'=>$bill->id,
                'name'=>ucfirst($bill->customer->name),
                'phone'=>$bill->customer->phone,
                'address'=>$bill->customer->street.' '.$bill->customer->city.' '.$bill->customer->street.' '.$bill->customer->pincode,
                'bill_no'=>$bill->bill_no,
                'total'=>$bill->total,
                'invoice_date'=>date('D d m, Y',strtotime($bill->invoice_date)),
                'start'=>date('Y-m-d',strtotime($bill->due_date)).' '.date('H:m:s',strtotime(now())),
                'end'=>date('Y-m-d',strtotime($bill->due_date)).' '.date('H:m:s',strtotime(\Carbon\Carbon::parse(now()->addMinutes(60))))
            ));
        }
        return response()->json($bills);
    }

    public function createInvoice(Request $request){
        $customer = Customer::findOrFail($request->customer_id);
        $states = State::all();
        $items = Item::where('type','service')->get();
        $products = Products::all();
        $invoice_no = PrefixHelper::getInvoicePrefix($customer->tax=='yes'?true:false);
        return view('invoice.newInvoice',compact('customer','invoice_no','items','states','request','products'));
    }

    public function saveInvoice(Request $request)
    {
        if($request->invoice_category=="split"){
            return $this->splitInvoice($request);
        }
        $customer = Customer::find($request->customer_id);
        $terms = CompanyInfo::first();
        $qid = null;

        $tax=$no_tax=null;
        if($request->gstInv=='yes'){
            $tax=$request->inv_no;
        }
        else{
            $no_tax=$request->inv_no;
        }

        if($request->invoice_id == "")
        {
            $invoice = Invoice::create([
                'contract_id'=>$request->contract_id,
                'tax_invoice' =>$request->proforma=="yes"?null:$tax,
                'notax_invoice' =>$request->proforma=="yes"?null:$no_tax,
                'allow_gst' =>($request->gstInv=='yes'?1:0),
                'type' =>$request->invoice_type,
                'category' =>$request->type,
                'invoice_date' => date('Y-m-d',strtotime($request->invoice_date)),
                'due_date' =>\Carbon\Carbon::parse(date('Y-m-d',strtotime($request->invoice_date)))->addMonths(1),
                'services'=>implode("~",$request->item_name),
                'item_id'=>implode("~",$request->item_id),
                'unit_name'=>implode("~",$request->unit),
                'qtys'=>implode("~",count($request->unit_qty)!= 0?$request->unit_qty:$request->item_qty),
                'tax'=>implode("~",is_array($request->item_tax)?$request->item_tax:[]),
                'price'=>implode("~",$request->dntshowGst=='yes'?$request->amount:$request->item_rate),
                'description'=>implode('~',$request->descriptions),
                'adjustment_type'=>$request->adjustment_type,
                'adjustment_value'=>$request->adjustment_value,
                'gst'=>$request->gst,
                'customer_id'=>$request->customer_id,
                'total'=>$request->total_amount,
                'discount'=>$request->discount,
                'invoice_period' => date('Y-m-d',strtotime($request->invoice_period)),
                'service_address' => $request->service_address,
                'state'=>$request->states,
                'po_no'=>$request->po_no,
                'po_date'=>$request->po_date?date('Y-m-d',strtotime($request->po_date)):null,
                'dispatch'=>$request->dispatch_through,
                'address'=>$request->customer_address,
                'delivery_address'=>$request->delivery_address,
                'note'=>$request->note,
                'split_invoice'=>1
            ]);

            $inv = $invoice->id;
            if($request->invoice_type=='sales'){
                for($i=0;$i<count($request->item_id);$i++){
                    if($request->item_id[$i]!=0){
                        $product=Products::where('id',$request->item_id[$i])->decrement('qty_avail',$request->item_qty[$i]);
                        $products = Products::find($request->item_id[$i]);
                        if ($product) {
                            StockLog::create([
                                'product_id'=>$products->id,
                                'invoice_id'=>$inv,
                                'godown_id'=>$products->godown_id,
                                'qty'=>$request->item_qty[$i],
                                'qty_avail'=>$products->qty_avail,
                                'type'=>'removed',
                                'comment'=>'Product Sold'
                            ]);
                        }
                    }
                }
            }
        }
        else
        {
            $update_stock = StockLog::where('invoice_id',$request->invoice_id)->get();
            foreach($update_stock as $log){
                $product=Products::where('id',$log->product_id)->increment('qty_avail',$log->qty);
            }

            Invoice::where('id',$request->invoice_id)->update([
                'tax_invoice'=>$request->proforma=="yes"?null:$tax,
                'notax_invoice'=>$request->proforma=="yes"?null:$no_tax,
                'allow_gst' =>($request->gstInv=='yes'?1:0),
                'type' =>$request->invoice_type,
                'category' =>$request->type,
                'invoice_date' => date('Y-m-d',strtotime($request->invoice_date)),
                'due_date' => \Carbon\Carbon::parse(date('Y-m-d',strtotime($request->invoice_date)))->addMonths(1),
                'services'=>implode("~",$request->item_name),
                'item_id'=>implode("~",$request->item_id),
                'unit_name'=>implode("~",$request->unit),
                'qtys'=>implode("~",$request->type=="custom"?$request->unit_qty:$request->item_qty),
                'tax'=>implode("~",is_array($request->item_tax)?$request->item_tax:[]),
                'price'=>implode("~",$request->dntshowGst=='yes'?$request->amount:$request->item_rate),
                'description'=>implode('~',$request->descriptions),
                'adjustment_type'=>$request->adjustment_type,
                'adjustment_value'=>$request->adjustment_value,
                'gst'=>$request->gst,
                'customer_id'=>$request->customer_id,
                'total'=>$request->total_amount,
                'discount'=>$request->discount,
                'state'=>$request->states,
                'invoice_period' => date('Y-m-d',strtotime($request->invoice_period)),
                'service_address' => $request->service_address,
                'po_no'=>$request->po_no,
                'po_date'=>date('Y-m-d',strtotime($request->po_date)),
                'dispatch'=>$request->dispatch_through,
                'address'=>$request->customer_address,
                'delivery_address'=>$request->delivery_address,
                'note'=>$request->note,
            ]);
            $invoice = Invoice::find($request->invoice_id);

            if($request->invoice_type=='sales'){
                for($i=0;$i<count($request->item_id);$i++){
                    if($request->item_id[$i]!=0){
                        $product=Products::where('id',$request->item_id[$i])->decrement('qty_avail',$request->item_qty[$i]);
                        $products = Products::find($request->item_id[$i]);
                        if ($product) {
                            StockLog::create([
                                'product_id'=>$products->id,
                                'invoice_id'=>$invoice->id,
                                'godown_id'=>$products->godown_id,
                                'qty'=>$request->item_qty[$i],
                                'qty_avail'=>$products->qty_avail,
                                'type'=>'removed',
                                'comment'=>'Product Sold'
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->to('/invoice/client/'.$invoice->customer_id);
        // if($customer->tax=='yes'){
        //     return redirect()->to('/gst_invoice');
        // }
        // else {
        //     return redirect()->to('/non_gst_invoice');
        // }
    }

    public function splitInvoice($request){
        $split_inv_count = count($request->bill_no);
        $inv_no = null;
        if($request->gstInv == 'yes'){
            $inv_no = $request->inv_no;
        }else{
            $inv_no = $request->inv_no;
        }

        $tax=$no_tax=null;
        if($request->gstInv=='yes'){
            $tax=$request->inv_no;
        }
        else{
            $no_tax=$request->inv_no;
        }
        $invoice = Invoice::create([
            'contract_id'=>$request->contract_id,
            'customer_id'=>$request->customer_id,
            'tax_invoice' =>$request->proforma=="yes"?null:$tax,
            'notax_invoice' =>$request->proforma=="yes"?null:$no_tax,
            'allow_gst' =>$request->gstInv=='yes'?1:0,
            'type' =>$request->invoice_type,
            'category' =>$request->type,
            'invoice_date' => date('Y-m-d',strtotime($request->invoice_date)),
            'due_date' =>  date('Y-m-d',strtotime($request->bill_date[0])),
            'services'=>implode("~",$request->item_name),
            'item_id'=>implode("~",$request->item_id),
            'unit_name'=>implode("~",$request->unit),
            'qtys'=>implode("~",$request->item_qty),
            'tax'=>implode("~",is_array($request->item_tax)?$request->item_tax:[]),
            'price'=>implode("~",$request->item_rate),
            'description'=>implode('~',$request->descriptions),
            'gst' => round($request->gst/$split_inv_count,2),
            'total'=> $request->bill_amount[0],
            'adjustment_type'=>$request->adjustment_type,
            'adjustment_value'=>$request->adjustment_value/$split_inv_count,
            'discount'=>$request->discount/$split_inv_count,
            'state'=>$request->states,
            'po_no'=>$request->po_no,
            'po_date'=>$request->po_date?date('Y-m-d',strtotime($request->po_date)):null,
            'dispatch'=>$request->dispatch_through,
            'address'=>$request->customer_address,
            'delivery_address'=>$request->delivery_address,
            'note'=>$request->note,
            'split_invoice'=>0
        ]);

        if($split_inv_count >= 2 ){
            for($i = 1; $i < $split_inv_count; $i++){
                $invoice = new splitInvoice;
                $invoice->bill_no = $inv_no.'-'.$request->bill_no[$i];
                $invoice->customer_id = $request->customer_id;
                $invoice->contract_id = $request->contract_id;
                $invoice->address=$request->customer_address;
                $invoice->type = $request->invoice_type;
                $invoice->allow_gst = $request->gstInv=='yes'?1:0;
                $invoice->state = $request->state;
                $invoice->invoice_date = date('Y-m-d',strtotime($request->invoice_date));
                $invoice->due_date =  date('Y-m-d',strtotime($request->bill_date[$i]));
                $invoice->services = implode("~",$request->item_name);
                $invoice->item_id = implode("~",$request->item_id);
                $invoice->qtys = count($request->unit_qty) > 0 ? implode("~",$request->unit_qty):implode("~",$request->item_qty);
                $invoice->price = implode("~",$request->item_rate);
                $invoice->description = implode("~",$request->descriptions);
                $invoice->tax = implode("~",is_array($request->item_tax)?$request->item_tax:[]);
                $invoice->gst = round($request->gst/$split_inv_count,2);
                $invoice->total = $request->bill_amount[$i];
                $invoice->po_no=$request->po_no;
                $invoice->po_date=date('Y-m-d',strtotime($request->po_date));
                $invoice->dispatch=$request->dispatch_through;
                $invoice->delivery_address=$request->delivery_address;
                $invoice->note=$request->note;
                $invoice->save();
            }
        }

        return redirect()->to('/invoice/client/'.$invoice->customer_id);
    }

    public function getAllInvoice($id)
    {
        $invoices = Invoice::with('contract')->where('customer_id',$id)->OrderBy('id','desc')->get();
        $customer = Customer::find($id);
        return view('invoice.customerInvoice',compact('invoices','customer'));
    }

    public function allInvoice(){
        $start_date = Input::get('start_date');
        $end_date = Input::get('end_date');
        $invoices = Invoice::withoutGlobalScopes([
            \App\Scopes\BadDebitInvoice::class,
            \App\Scopes\cancelInvoice::class,
        ])
            ->with('contract')
            ->when($start_date,function($query) use($start_date){
                $query->whereDate('due_date','>=',date('Y-m-d',strtotime($start_date)));
            })
            ->when($end_date,function($query) use($end_date){
                $query->whereDate('due_date','<=',date('Y-m-d',strtotime($end_date)));
            })
            ->OrderBy('id','desc')
            ->get();
        return view('invoice.all_invoice',compact('invoices'));
    }

    public function allInvoiceExport(){
        $start_date = Input::get('start_date');
        $end_date = Input::get('end_date');
        $invoices = Invoice::when($start_date,function($query) use($start_date){
            $query->whereDate('due_date','>=',date('Y-m-d',strtotime($start_date)));
        })
            ->when($end_date,function($query) use($end_date){
                $query->whereDate('due_date','<=',date('Y-m-d',strtotime($end_date)));
            })
            ->OrderBy('id','desc')
            ->get();
        return $this->exportInvoice($invoices);
    }

    public function editInvoice($id)
    {
        $invoice =Invoice::find($id);
        $states = State::all();
        $customer =Customer::find($invoice->customer_id);
        $items=Item::where('type','service')->orderBy('created_at','desc')->get();
        $products = Products::all();
        $item_name = explode('~', $invoice->services);
        $qtys = explode('~', $invoice->qtys);
        $price = explode('~', $invoice->price);
        $item_tax = explode('~', $invoice->tax);
        $description = explode('~', $invoice->description);
        $item_id = explode('~', $invoice->item_id);
        $units = explode('~', $invoice->unit_name);

        return view('invoice.newInvoice',compact('customer','states','items','products','invoice','item_name','qtys','price','item_tax','description','item_id','units'));
    }

    public function deleteInvoice(Request $request)
    {
        $invoice = Invoice::find($request->id);
        if($invoice->type=='sales'){
            $update_stock = StockLog::where('invoice_id',$invoice->id)->get();
            foreach($update_stock as $log){
                $product=Products::where('id',$log->product_id)->increment('qty_avail',$log->qty);
            }
        }
        $invoice->delete_reason=$request->reason;
        $invoice->save();

        if($invoice->delete())
            return response()->json('success');
        return response()->json('error');

    }

    // public function recordPayment(Request $request){
    //     if($request->invoice_no){
    //         $invoice = Invoice::findOrFail($request->invoice_no);

    //         if($request->amount > $invoice->total - $invoice->payment->sum('amount')){
    //             Session::flash('error','Cant Except payment more than '.($invoice->total - $invoice->payment->sum('amount')));
    //             return back()->withInput($request->input());
    //         }

    //         if(is_numeric($request->retention_amount) && $request->retention_date){
    //             if($invoice->retention){
    //                 $invoice->retention()->update([
    //                     'amount'=>$request->retention_amount,
    //                     'date'=> date('Y-m-d', strtotime($request->retention_date))
    //                 ]);
    //             }else{
    //                 $invoice->retention()->create([
    //                     'amount'=>$request->retention_amount,
    //                     'date'=> date('Y-m-d', strtotime($request->retention_date))
    //                 ]);
    //             }
    //         }

    //         if($request->amount > 0 && $request->payment_date){
    //             if($invoice->payment->count() == 0){
    //                 if($request->amount < $invoice->gst){
    //                     Session::flash('error','Minimum amount payable is '.$invoice->gst.' &#8377;');
    //                     return back()->withInput($request->input());
    //                 }
    //             }
    //             $invoice->payment()->create([
    //                 'amount'=>$request->amount,
    //                 'tds_amount'=>$request->tdsamount,
    //                 'remaining_amount'=>$invoice->total - $invoice->payment->sum('amount') - $request->amount,
    //                 'date'=>date('Y-m-d',strtotime($request->payment_date)),
    //                 'mode'=>$request->mode,
    //                 'reference_no'=>$request->reference_no,
    //                 'notes'=>$request->notes,
    //             ]);
    //             Session::flash('success','Payment saved successfully');
    //         }
    //         $invoice->load(['payment']);
    //         if($invoice->payment->sum('amount') >= $invoice->total){
    //             $invoice->status = "paid";
    //             $invoice->save();
    //         }
    //         if($request->comment && $request->next_payment_date){
    //             $invoice->interactions()->create([
    //                 'comment'=>$request->comment,
    //             ]);
    //             $invoice->due_date = date('Y-m-d', strtotime($request->next_payment_date));
    //             Session::flash('success','Feedback saved successfully');
    //         }
    //     }else{
    //         $payment = Payment::findOrFail($request->payment_id);
    //         $invoice = Invoice::findOrFail($payment->invoice_id);
    //         $rem = $payment->remaining_amount + $payment->amount;
    //         $remaining = $rem - $request->amount;

    //         Payment::where('id',$request->payment_id)->update([
    //           'amount'=>$request->amount,
    //           'tds_amount'=>$request->tdsamount,
    //           'remaining_amount'=>$remaining,
    //           'date'=>date('Y-m-d',strtotime($request->payment_date)),
    //           'mode'=>$request->mode,
    //           'reference_no'=>$request->reference_no,
    //           'notes'=>$request->notes,
    //           ]);

    //         $pay =Payment::where('invoice_id',$payment->invoice_id)->get();
    //         if ($pay->sum('amount') >= $invoice->total) {
    //           Invoice::where('id',$payment->invoice_id)->update(['status'=>'paid']);
    //         }
    //         else{
    //           Invoice::where('id',$payment->invoice_id)->update(['status'=>'pending']);
    //         }
    //         Session::flash('success','Payment Updated successfully');
    //     }
    //     return back();
    // }

    public function recordPayment(Request $request){
        if($request->invoice_no){
            $invoice = Invoice::with('payment')->findOrFail($request->invoice_no);

            if($request->amount > $invoice->total - $invoice->payment->sum('amount')){
                Session::flash('error','Cant Except payment more than '.($invoice->total - $invoice->payment->sum('amount')));
                return back()->withInput($request->input());
            }

            if(is_numeric($request->retention_amount) && $request->retention_date){
                if($invoice->retention){
                    $invoice->retention()->update([
                        'amount'=>$request->retention_amount,
                        'date'=> date('Y-m-d', strtotime($request->retention_date))
                    ]);
                }else{
                    $invoice->retention()->create([
                        'amount'=>$request->retention_amount,
                        'date'=> date('Y-m-d', strtotime($request->retention_date))
                    ]);
                }
            }

            if($request->amount > 0 && $request->payment_date){
                if($invoice->payment->count() == 0){
                    if($request->amount < $invoice->gst){
                        Session::flash('error','Minimum amount payable is '.$invoice->gst.' &#8377;');
                        return back()->withInput($request->input());
                    }
                }

                $current_payment = $invoice->payment()->create([
                    'amount'=>$request->amount,
                    'tds_amount'=>$request->tdsamount,
                    'remaining_amount'=>$invoice->total - $invoice->payment->sum('amount') - $invoice->payment->sum('tds_amount') - $request->amount - $request->tdsamount,
                    'date'=>date('Y-m-d',strtotime($request->payment_date)),
                    'mode'=>$request->mode,
                    'reference_no'=>$request->reference_no,
                    'notes'=>$request->notes,
                ]);

                Session::flash('success','Payment saved successfully');
            }
            if($current_payment->remaining_amount == 0){
                $invoice->status = "paid";
            }
            if($request->comment && $request->next_payment_date){
                $invoice->interactions()->create([
                    'comment'=>$request->comment,
                ]);
                $invoice->due_date = date('Y-m-d', strtotime($request->next_payment_date));
                Session::flash('success','Feedback saved successfully');
            }
            $invoice->save();
        }
        else{
            $payment = Payment::findOrFail($request->payment_id);
            $invoice = Invoice::findOrFail($payment->invoice_id);
            $rem = $payment->remaining_amount + $payment->amount;
            $remaining = $rem - $request->amount;

            Payment::where('id',$request->payment_id)->update([
                'amount'=>$request->amount,
                'tds_amount'=>$request->tdsamount,
                'remaining_amount'=>$request->remaining_amount,
                'date'=>date('Y-m-d',strtotime($request->payment_date)),
                'mode'=>$request->mode,
                'reference_no'=>$request->reference_no,
                'notes'=>$request->notes,
            ]);

            $pay =Payment::where('invoice_id',$payment->invoice_id)->get();
            if ($pay->sum('amount') >= $invoice->total) {
                Invoice::where('id',$payment->invoice_id)->update([
                    'status'=>'paid']);
            }
            else{
                Invoice::where('id',$payment->invoice_id)->update([
                    'status'=>'pending']);
            }
            Session::flash('success','Payment Updated successfully');

        }
        return back();
    }

    public function viewPayment($id)
    {
        $payments = Payment::where('invoice_id',$id)->get();
        return view('invoice.viewPayments',compact('payments'));
    }

    public function editPayment($id)
    {
        $payment = Payment::find($id);
        return json_encode($payment);
    }

    public function deletePayment($id)
    {
        $payment = Payment::where('id',$id)->delete();
        if($payment)
            return 0;
        return 1;
    }

    public function pendingPayment(Request $request)
    {
        $invoices = Invoice::where('status','pending')
            ->when($request->start_date,function($query) use($request){
                $query->whereDate('due_date','>=',date('Y-m-d',strtotime($request->start_date)));
            })
            ->when($request->end_date,function($query) use($request){
                $query->whereDate('due_date','<=',date('Y-m-d',strtotime($request->end_date)));
            })
            ->get();
        return view('invoice.pendingPayment',compact('invoices'));
    }

    public function confirmPayment(Request $request)
    {
        $invoices = Invoice::where('status','!=','pending')
            ->when($request->start_date,function($query) use($request){
                $query->whereDate('due_date','>=',date('Y-m-d',strtotime($request->start_date)));
            })
            ->when($request->end_date,function($query) use($request){
                $query->whereDate('due_date','<=',date('Y-m-d',strtotime($request->end_date)));
            })
            ->get();
        return view('invoice.confirmPayment',compact('invoices'));
    }

    public function getInvoiceDue(){

        $temp_invoices = Invoice::where('status','pending')
            ->with(['customer','retention','payment','interactions'])->get();

        $invoices = array();
        foreach($temp_invoices->toArray() as $invoice){
            if($invoice['retention']!=null){
                if($invoice['total'] - array_sum(array_column($invoice['payment'],'amount')) <= $invoice['retention']['amount']){
                    $invoice_date = \Carbon\Carbon::parse($invoice['due_date']);
                    $retention_date = \Carbon\Carbon::parse($invoice['retention']['date']);
                    if($retention_date->gte($invoice_date) ){
                        $invoice['due_date'] = $invoice['retention']['date'];
                    }
                }
            }
            array_push($invoices,$invoice);
        }
        $data=array();
        foreach ($invoices as $invoice) {
            $due_amount = $invoice['total'] - array_sum(array_column($invoice['payment'],'amount'));
            if($due_amount<=0) continue;
            $temp_array=array(
                'id'=>$invoice['id'],
                'name'=>ucfirst($invoice['customer']['name']),
                'phone'=>$invoice['customer']['phone'],
                'address'=>$invoice['customer']['street'],//.', '.$invoice->customer->city,
                'due_date'=>$invoice['due_date'].' '.date('H:m:s',strtotime(now())),
                'end_time'=>$invoice['due_date'].' '.date('H:m:s',strtotime(\Carbon\Carbon::parse(now()->addMinutes(60)))),
                'due_amount'=>$invoice['total'] - array_sum(array_column($invoice['payment'],'amount')),
                'total_amount'=>$invoice['total'],
                'interactions'=>$invoice['interactions']
            );
            array_push($data,$temp_array);
        }
        return response()->json($data);
        // return json_encode($data);
    }

    public function invoicePdf($id,$send=null)
    {
        $pdf = PdfHelper::invoicePdf($id, $send);
        return $pdf->stream();
    }

    public function mailinvoicePdf($id)
    {
        $send = "Yes";
        $pdf = PdfHelper::mailinvoicePdf($id, $send );
        return $pdf->stream();

    }

    public function mailInvoice($id)
    {
        $invoice = Invoice::find($id);
        return view('invoice.mailInvoice',compact('invoice'));
    }

    public function sendInvoice(Request $request){

        $invoice = Invoice::withoutGlobalScopes([\App\Scopes\cancelInvoice::class,\App\Scopes\BadDebitInvoice::class])
            ->find($request->invoice_id);
        $inv = PdfHelper::invoicePdf($request->invoice_id,true);
        $pdf = $inv->output();

        $mailcontent['title'] = 'Invoice';
        $mailcontent['content'] = "<br>".$request->message."<br>";
        $mailcontent['to'] = $request->input('emailTo');
        $mailcontent['cc']=$request->cc?$request->cc:'contactatbigdreams@gmail.com';
        $mailcontent['subject'] = 'Invoice';
        $mailcontent['invoiceFile']=base64_encode($pdf);
        // Session::flash('success','Invoice send successfully');
        Mail::to($mailcontent['to'])->send(new mailInvoice($mailcontent));
        Session::flash('success','Invoice send successfully');
        return redirect()->to('/invoice/client/'.$invoice->customer->id);
    }

    public function changePaymentDate(Request $request)
    {
        $inv = Invoice::where('id',$request->id)->update([
            'due_date'=>$request->newDate
        ]);
        if($inv)
            return 0;
        return 1;
    }

    public function getPaymentSlip($id)
    {
        $payment = Payment::find($id);
        $invoice = Invoice::where('id',$payment->invoice_id)->first();
        $header = View::make('pdf.Header')->withIsGst($invoice->allow_gst)->render();
        $footer = View::make('pdf.Footer')->withIsGst($invoice->allow_gst)->render();
        $pdf = PDF::loadView('pdf.paymentSlip',compact('payment','invoice'))
            ->setOption('header-html',$header);
        return $pdf->stream();
    }

    public function receivedPayment(){

        $start_date = Input::get('start_date');
        $end_date = Input::get('end_date');
        $invoice_no = Input::get('invoice_no');
        $name = Input::get('name');
        $mode = Input::get('mode');

        $payments = Payment::where('invoice_id','!=',null)->with('invoice.customer')
            ->when($start_date,function($query) use ($start_date){
                $query->whereDate('date','>=',date('Y-m-d', strtotime($start_date)));
            })
            ->when($end_date,function($query) use ($end_date){
                $query->whereDate('date','<=',date('Y-m-d', strtotime($end_date)));
            })
            ->when($mode,function($query) use ($mode){
                $query->where('mode',$mode);
            })
            ->when($invoice_no,function($query) use ($invoice_no){
                $query->whereHas('invoice', function($query) use ($invoice_no){
                    $query->where('notax_invoice',$invoice_no)->orWhere('tax_invoice',$invoice_no);
                });
            })
            ->when($name,function($query) use ($name){
                $query->whereHas('invoice', function($query) use ($name){
                    $query->whereHas('customer',function($query) use ($name){
                        $query->whereRaw("soundex(name) = '".soundex($name)."'");
                    });
                });
            })
            ->orderBy('id','desc')->get();
        return view('invoice.received_payments',compact('payments'));
    }

    public function exportPendingInvoice(Request $request){
        $invoices = Invoice::where('status','pending')
            ->when($request->start_date,function($query) use($request){
                $query->whereDate('due_date','>=',date('Y-m-d',strtotime($request->start_date)));
            })
            ->when($request->end_date,function($query) use($request){
                $query->whereDate('due_date','<=',date('Y-m-d',strtotime($request->end_date)));
            })
            ->get();
        $this->exportInvoice($invoices);
    }

    protected function exportInvoice($invoices){

        \Excel::create('INVOICE-'.date('Y-m-d'), function($excel) use ($invoices) {
            $excel->setCreator('Khan Vajid')
                ->setCompany('Four Brothers Software Solution')
                ->setDescription('PAYMENT REPORT as dated on'.date('D d M, Y'));

            $excel->sheet('sheet 1', function($sheet) use ($invoices) {
                $sheet->row(1, array('Invoice #','Customer Name','Phone','Email','Paid','Remaining','Total','Invoice Date','GST','City','State','Pincode','Address'));
                $sheet->row(1, function($row) {
                    $row->setBackground('#008000');
                    $row->setFontColor('#ffffff');
                });
                $data =array();
                $total_amount = 0;
                $total_paid_amount = 0;
                foreach ($invoices as $invoice) {
                    array_push($data, array(
                        is_null($invoice->notax_invoice)?$invoice->tax_invoice:$invoice->notax_invoice,
                        ucfirst($invoice->customer->name),
                        $invoice->customer->phone,
                        $invoice->customer->email,
                        $invoice->payment->sum('amount'),
                        $invoice->total - $invoice->payment->sum('amount'),
                        $invoice->total,
                        date('D d M, Y', strtotime($invoice->created_at)),
                        $invoice->customer->gst_no,
                        $invoice->customer->city,
                        $invoice->customer->state,
                        $invoice->customer->pincode,
                        $invoice->customer->street
                    ));
                    $total_amount += $invoice->total;
                    $total_paid_amount += $invoice->payment->sum('amount');
                }

                $sheet->rows($data);
                $sheet->appendRow(array(''));//empty row
                $sheet->appendRow(array('','','','Total',$total_paid_amount,$total_amount-$total_paid_amount,$total_amount));
                $sheet->setAutoSize(false);
            });
        })->download('xlsx');
    }

    public function receivedPaymentExport(){
        $start_date = Input::get('start_date');
        $end_date = Input::get('end_date');
        $invoice_no = Input::get('invoice');
        $name = Input::get('name');
        $mode = Input::get('mode');

        $payments = Payment::where('invoice_id','!=',null)->with('invoice.customer')
            ->when($start_date,function($query) use ($start_date){
                $query->whereDate('date','>=',date('Y-m-d', strtotime($start_date)));
            })
            ->when($end_date,function($query) use ($end_date){
                $query->whereDate('date','<=',date('Y-m-d', strtotime($end_date)));
            })
            ->when($mode,function($query) use ($mode){
                $query->where('mode',$mode);
            })
            ->when($invoice_no,function($query) use ($invoice_no){
                $query->whereHas('invoice', function($query) use ($invoice_no){
                    $query->where('notax_invoice',$invoice_no)->orWhere('tax_invoice',$invoice_no);
                });
            })
            ->when($name,function($query) use ($name){
                $query->whereHas('invoice', function($query) use ($name){
                    $query->whereHas('customer',function($query) use ($name){
                        $query->whereRaw("soundex(name) = '".soundex($name)."'");
                    });
                });
            })
            ->orderBy('id','desc')->get();

        \Excel::create('PAYMENT_REPORT-'.date('Y-m-d'), function($excel) use ($payments) {
            $excel->setCreator('Khan Vajid')
                ->setCompany('Four Brothers Software Solution')
                ->setDescription('PAYMENT REPORT as dated on'.date('D d M, Y'));

            $excel->sheet('sheet 1', function($sheet) use ($payments) {
                $sheet->row(1, array('Invoice #','Amount Paid','Date','Payment Note','Remaining','Total','Due Date','Customer Name','Phone','Email','GST','City','State','Pincode','Address'));
                $sheet->row(1, function($row) {
                    $row->setBackground('#008000');
                    $row->setFontColor('#ffffff');
                });
                $data =array();
                foreach ($payments as $payment) {
                    array_push($data, array(
                        $payment->invoice->tax_invoice ?? $payment->invoice->notax_invoice,
                        $payment->amount,
                        date('D d M, Y', strtotime($payment->created_at)),
                        $payment->notes,
                        $payment->remaining_amount,
                        $payment->invoice->total,
                        date('D d M, Y', strtotime($payment->invoice->due_date)),
                        $payment->invoice->customer->name,
                        $payment->invoice->customer->phone,
                        $payment->invoice->customer->email,
                        $payment->invoice->customer->gst_no,
                        $payment->invoice->customer->city,
                        $payment->invoice->customer->state,
                        $payment->invoice->customer->pincode,
                        $payment->invoice->customer->street
                    ));
                }

                $sheet->rows($data);
                $sheet->setAutoSize(false);
            });
        })->download('xlsx');
    }

    public function taxCollected(Request $request){
        $invoices = Invoice::with('customer')->where('tax_invoice','!=',null)
            ->whereHas('payment',function($query){
                $query->where('tds_amount','!=',null);
            })
            ->when($request->start_date,function($query) use ($request){
                $query->whereDate('created_at','>=',date('Y-m-d', strtotime($request->start_date)));
            })
            ->when($request->end_date,function($query) use ($request){
                $query->whereDate('created_at','<=',date('Y-m-d', strtotime($request->end_date)));
            })
            ->orderBy('id', 'desc')->get();
        return view ('master.tax_collected',compact('invoices'));
    }

    public function taxCollectedExport(Request $request){
        $invoices = Invoice::with('customer')->where('tax_invoice','!=',null)
            ->whereHas('payment',function($query){
                $query->where('tds_amount','!=',null);
            })
            ->when($request->start_date,function($query) use ($request){
                $query->whereDate('created_at','>=',date('Y-m-d', strtotime($request->start_date)));
            })
            ->when($request->end_date,function($query) use ($request){
                $query->whereDate('created_at','<=',date('Y-m-d', strtotime($request->end_date)));
            })
            ->orderBy('id', 'desc')->get();

        \Excel::create("TAX REPORT $request->start_date - $request->end_date", function($excel) use ($invoices) {
            $excel->setCreator('Subhash Diwakar')
                ->setCompany('Four Brothers Software Solution')
                ->setDescription('TDS REPORT as dated on'.date('D d M, Y'));

            $excel->sheet('sheet 1', function($sheet) use ($invoices) {
                $sheet->row(1, array('Invoice #','TDS','Date','GST NO','Customer Name','Phone','Email','City','State','Pincode','Address'));
                $sheet->row(1, function($row) {
                    $row->setBackground('#008000');
                    $row->setFontColor('#ffffff');
                });
                $data =array();
                $total_gst = 0;
                foreach ($invoices as $invoice) {
                    array_push($data, array(
                        $invoice->tax_invoice,
                        $invoice->payment->sum('tds_amount'),
                        date('D d M, Y', strtotime($invoice->created_at)),
                        $invoice->customer->gst_no,
                        $invoice->customer->name,
                        $invoice->customer->phone,
                        $invoice->customer->email,
                        $invoice->customer->city,
                        $invoice->customer->state,
                        $invoice->customer->pincode,
                        $invoice->customer->street
                    ));
                    $total_gst += $invoice->gst;
                }
                $sheet->rows($data);
                $sheet->appendRow(array('Total',$total_gst));
                $sheet->setAutoSize(false);
            });
        })->download('xlsx');
    }

    public function retention(){

        $start_date = Input::get('start_date');
        $end_date = Input::get('end_date');

        $retentions = Retention::whereHas('invoice')->with(['invoice','invoice.customer'])
            ->where('status','pending')
            ->when($start_date,function($query) use($start_date) {
                $query->whereDate('date','>=',date('Y-m-d',strtotime($start_date)));
            })
            ->when($end_date,function($query) use($end_date) {
                $query->whereDate('date','<=',date('Y-m-d',strtotime($end_date)));
            })
            ->orderBy('date','desc')->get();

        $retentions = $retentions->filter(function($retention){
            if($retention->invoice->payment->sum('amount') >= $retention->invoice->total ){
                return false;
            }
            return true;
        });

        return view('invoice.retention',compact('retentions'));
    }

    public function updateRetention(Request $request, Retention $retention){
        $retention->status = "collected";
        $retention->comment = $request->comment;
        $retention->save();
        Session::flash('success','Retention Collected successfully');
        return back();
    }

    public function tdsCollected(Request $request){
        $invoices = Invoice::with(['customer','payment'])
            ->when($request->start_date,function($query) use ($request){
                $query->whereDate('created_at','>=',date('Y-m-d', strtotime($request->start_date)));
            })
            ->when($request->end_date,function($query) use ($request){
                $query->whereDate('created_at','<=',date('Y-m-d', strtotime($request->end_date)));
            })
            ->orderBy('id', 'desc')->get();
        return view ('invoice.tds_collected',compact('invoices'));
    }

    public function tdsCollectedExport(Request $request){
        $invoices = Invoice::with('customer')
            ->when($request->start_date,function($query) use ($request){
                $query->whereDate('created_at','>=',date('Y-m-d', strtotime($request->start_date)));
            })
            ->when($request->end_date,function($query) use ($request){
                $query->whereDate('created_at','<=',date('Y-m-d', strtotime($request->end_date)));
            })
            ->orderBy('id', 'desc')->get();

        \Excel::create("TDS REPORT $request->start_date - $request->end_date", function($excel) use ($invoices) {
            $excel->setCreator('Khan Vajid')
                ->setCompany('Four Brothers Software Solution')
                ->setDescription('TAX REPORT as dated on'.date('D d M, Y'));

            $excel->sheet('sheet 1', function($sheet) use ($invoices) {
                $sheet->row(1, array('Invoice #','TDS','Date','GST NO','Customer Name','Phone','Email','City','State','Pincode','Address'));
                $sheet->row(1, function($row) {
                    $row->setBackground('#008000');
                    $row->setFontColor('#ffffff');
                });
                $data =array();
                $total_gst = 0;
                foreach ($invoices as $invoice) {
                    if($invoice->payment->sum('tds_amount') <= 0)
                        continue;
                    array_push($data, array(
                        $invoice->tax_invoice,
                        $invoice->payment->sum('tds_amount'),
                        date('D d M, Y', strtotime($invoice->created_at)),
                        $invoice->customer->gst_no,
                        $invoice->customer->name,
                        $invoice->customer->phone,
                        $invoice->customer->email,
                        $invoice->customer->city,
                        $invoice->customer->state,
                        $invoice->customer->pincode,
                        $invoice->customer->street
                    ));
                    $total_gst += $invoice->payment->sum('tds_amount');
                }
                $sheet->rows($data);
                $sheet->appendRow(array('Total',$total_gst));
                $sheet->setAutoSize(false);
            });
        })->download('xlsx');
    }

    public function retentionExport($start_date = null, $end_date = null){

        $retentions = Retention::whereHas('invoice')->with(['invoice','invoice.customer'])
            ->where('status','pending')
            ->when($start_date,function($query) use($start_date) {
                $query->whereDate('date','>=',date('Y-m-d',strtotime($start_date)));
            })
            ->when($end_date,function($query) use($end_date) {
                $query->whereDate('date','<=',date('Y-m-d',strtotime($end_date)));
            })
            ->orderBy('date','desc')->get();

        \Excel::create("RETENTION REPORT", function($excel) use ($retentions) {
            $excel->setCreator('Khan Vajid')
                ->setCompany('Four Brothers Software Solution')
                ->setDescription('TAX REPORT as dated on'.date('D d M, Y'));

            $excel->sheet('sheet 1', function($sheet) use ($retentions) {
                $sheet->row(1, array('Invoice #','Retention','Received','Invoice Amount','Customer Name','Phone','Email','City','State','Pincode','Address'));
                $sheet->row(1, function($row) {
                    $row->setBackground('#008000');
                    $row->setFontColor('#ffffff');
                });
                $data =array();
                $total_retention = 0;
                foreach ($retentions as $retention) {

                    array_push($data, array(
                        $retention->invoice->tax_invoice ?? $retention->invoice->notax_invoice,
                        $retention->amount,
                        $retention->invoice->payment->sum('amount'),
                        $retention->invoice->total,
                        $retention->invoice->customer->name,
                        $retention->invoice->customer->phone,
                        $retention->invoice->customer->email,
                        $retention->invoice->customer->city,
                        $retention->invoice->customer->state,
                        $retention->invoice->customer->pincode,
                        $retention->invoice->customer->street
                    ));
                    $total_retention += $retention->amount;
                }
                $sheet->rows($data);
                $sheet->appendRow(array('Total',$total_retention));
                $sheet->setAutoSize(false);
            });
        })->download('xlsx');
    }


    public function getTrashInvoice(){
        $invoices = Invoice::onlyTrashed()->with('customer')->get();
        return view('trash.trash_invoice',compact('invoices'));
    }

    public function restoreInvoice($id){
        Invoice::withTrashed()->findOrFail($id)->restore();
        Session::flash('success','Invoice Restore Successfully');
        return back();
    }

    public function badDebit (Invoice $invoice){
        $invoice->bad_debit = 1;
        $invoice->save();
        Session::flash('success','Invoice Successfully moved to BAD DEBIT');
        return back();
    }

    public function getBadDebit(){

        $start_date = Input::get('start_date');
        $end_date = Input::get('end_date');

        $invoices = Invoice::withoutGlobalScope(\App\Scopes\BadDebitInvoice::class)
            ->with(['customer','payment'])
            ->when($start_date,function($query) use($start_date) {
                $query->whereDate('due_date','>=',date('Y-m-d',strtotime($start_date)));
            })
            ->when($end_date,function($query) use($end_date) {
                $query->whereDate('due_date','<=',date('Y-m-d',strtotime($end_date)));
            })
            ->where('bad_debit','1')->get();

        return view('invoice.bad_debit',compact('invoices'));
    }

    public function exportBadDebit($start_date = null, $end_date = null){

        $invoices = Invoice::withoutGlobalScope(\App\Scopes\BadDebitInvoice::class)
            ->with(['customer','payment'])
            ->when($start_date,function($query) use($start_date) {
                $query->whereDate('due_date','>=',date('Y-m-d',strtotime($start_date)));
            })
            ->when($end_date,function($query) use($end_date) {
                $query->whereDate('due_date','<=',date('Y-m-d',strtotime($end_date)));
            })
            ->where('bad_debit','1')->get();
        return $this->exportInvoice($invoices);
    }

    public function cancelInvoice (Invoice $invoice){
        $invoice->cancelled = 1;
        $invoice->save();
        Session::flash('success','Invoice Successfully Cancelled');
        return back();
    }

    public function getCancelInvoice(){
        $start_date = Input::get('start_date');
        $end_date = Input::get('end_date');

        $invoices = Invoice::withoutGlobalScope(\App\Scopes\cancelInvoice::class)
            ->with(['customer','payment'])
            ->when($start_date,function($query) use($start_date) {
                $query->whereDate('due_date','>=',date('Y-m-d',strtotime($start_date)));
            })
            ->when($end_date,function($query) use($end_date) {
                $query->whereDate('due_date','<=',date('Y-m-d',strtotime($end_date)));
            })
            ->where('cancelled','1')->get();

        return view('invoice.cancel_invoice',compact('invoices'));
    }

    public function exportCancelInvoice($start_date = null, $end_date = null){

        $invoices = Invoice::withoutGlobalScope(\App\Scopes\cancelInvoice::class)
            ->with(['customer','payment'])
            ->when($start_date,function($query) use($start_date) {
                $query->whereDate('due_date','>=',date('Y-m-d',strtotime($start_date)));
            })
            ->when($end_date!=null,function($query) use($end_date) {
                $query->whereDate('due_date','<=',date('Y-m-d',strtotime($end_date)));
            })
            ->where('cancelled','1')->get();
        return $this->exportInvoice($invoices);
    }
    public function delete(Request $request){
        // return $request->all();
        $leads = Invoice::onlyTrashed()
            ->where('id',$request->id)
            ->first();
        $leads->forceDelete();
        return response()->json('success');
    }
}
