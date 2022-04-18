<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Bill_detail;
use Illuminate\Http\Request;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class BillController extends Controller
{


    public function index()
    {

      $bills = Bill::orderBy('id')->get();
      return view('bills.index')->with(compact('bills'));
    }


    public function create()
    {
        return view('bills.create');
    }



    public function store(Request $request)
    {
      $data = $request->all();
      //dd($data);
      $billno = 'BL'.'1'.strtotime(date('YmdHis'));
      //dd($billno);
      $bill = Bill::create([ 'user_id' => auth()->user()->id, 'bill_no' => $billno,]);

      foreach($request->input('name') as $key => $value) {

          $bdetail=new Bill_detail;
          $bdetail->bill_id = $bill->id;
          $bdetail->name = $request->name[$key];
          $bdetail->quantity = $request->quantity[$key];
          $bdetail->price = $request->price[$key];
          $bdetail->tax =$request->tax[$key];
          $bdetail->save();
      }

      return redirect()->route('bills.create');
    }


    public function show(Bill $bill)
    {
      //dd($bill);
        return view('bills.show')->with(compact('bill'));
    }


    public function edit(Bill $bill)
    {
      return view('bills.edit')->with(compact('bill'));
    }


    public function update(Request $request, Bill $bill)
    {

      foreach($request->input('name') as $key => $value) {
          $data = array(
            'name'=> $request->name[$key],
            'quantity'=>$request->quantity[$key],
            'price'=>$request->price [$key],
            'tax'=>$request->tax [$key]
          );
          $item_id = isset($request->bdetail_id[$key]) ? $request->bdetail_id[$key] : "";

          if($item_id ==''){
            $data['bill_id']=$bill->id;
            $bdtail = Bill_detail::create($data);

          }else{
            $bdtail =  Bill_detail::where('id', $item_id)->update($data);
          }

      }
      return redirect()->route('bills.edit',$bill->id);
    }


    public function destroy($bill)
    {
        Bill::destroy($bill);
        return redirect()->route('bills.index');
    }

    public function remove_item($id)
    {

        $res=Bill_detail::destroy($id);

        return response()->json([
        'success' => 'Record has been deleted successfully!'
    ]);


    }

    public function add_discount(Request $request, $bill)
    {

    //  $data = $request->all();
      $data['discount_type']=$request->discount_type;
      $data['discount']=$request->discount;
      //dd($data);
      $bdtail =  Bill::where('id', $bill)->update($data);



      return redirect()->route('bills.show',$bill);
    }

    public function gen_invoice($bill)
    {


      $customer = new Buyer([
              'name'          => 'John Doe',
              'custom_fields' => [
                  'email' => 'test@example.com',
              ],
          ]);

          $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

          $invoice = Invoice::make()
              ->buyer($customer)
              ->discountByPercent(10)
              ->taxRate(15)
              ->addItem($item);

          return $invoice->stream();
    }



}
