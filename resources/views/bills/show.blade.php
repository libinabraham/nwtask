@extends('layout.default')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bill Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Bills</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
<section class="content">

        <div class="card">
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            @if($bill)
            <div><b>Date:{{date('d-m-Y',strtotime($bill->created_at))}}</b></div>
          </br>
            <div><b>Bill NO: {{$bill->bill_no}}</b></div>

          </br></br>
            <table class="table table-hover text-nowrap">
              <thead>

                <tr>

                  <th>Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Amount</th>
                  <th>Tax %</th>
                  <th>Tax</th>
                  <th>Total</th>

                </tr>
              </thead>
              <tbody>

                @php $subtotal = 0; $totaltax = 0; $totalwithtax = 0; @endphp

                @foreach ($bill->bill_details as $bill_dtail)
                <tr>

                  <td>{{$bill_dtail->name}}</td>
                  <td>{{$bill_dtail->quantity}}</td>
                  <td>${{$bill_dtail->price}}</td>
                  <td>${{$bill_dtail->totalprice()}}</td>
                  <td>{{$bill_dtail->tax}}%</td>
                  <td>${{$bill_dtail->totalpercentage()}}</td>
                  <td>${{$bill_dtail->totalamount()}}</td>
                    @php $subtotal += $bill_dtail->totalprice();
                         $totaltax += $bill_dtail->totalpercentage();
                         $totalwithtax += $bill_dtail->totalamount(); @endphp

                </tr>
                @endforeach
                @if(isset($bill->discount_type))
                @if ($bill->discount_type=='amount')
                @php $discnt='Discount@ $'.$bill->discount; @endphp

                @else
                @php $discnt='Discount@ '.$bill->discount.'%'; @endphp
                @endif
                @else
                @php $discnt='Discount'; @endphp
                @endif

                <tr><td colspan="6"></td><td></td></tr>
                <tr><td style="text-align:right;" colspan="6"><b>Subtotal </b></td><td><b>${{$subtotal}}</b></td></tr>
                <tr><td style="text-align:right;" colspan="6"><b> Tax</b></td><td><b>${{$totaltax}}</b></td></tr>
                <tr><td style="text-align:right;" colspan="6"><b> Subtotal with tax</b></td><td><b>${{$totalwithtax}}</b></td></tr>
                <tr><td><b>Discount:</b></td><td colspan="4">
                  <form class="form-horizontal" method="POST" action="{{route('bills.discount',$bill_dtail->bill_id)}}" id="BillFrm" enctype="multipart/form-data">
                    @csrf
                  <div class="col-md-12"><div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                      <select class="form-control custom-select" name ="discount_type" required>
                        <option disabled>Select Type</option>
                        <option value="amount">Amount</option>
                        <option value="percentage">Percentage</option>
                      </select></div></div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="number" name="discount" id="inputName" class="form-control" required></div></div>
                    <div class="col-md-2">
                      <label for="inputName">&nbsp;</label>
                      <button type="submit" class="btn btn-rounded waves-effect waves-light bg-green font-14 text-white">Apply</button>
                    </div>
                </div></div></form></td>

                  <td style="text-align:right;"><b> {{$discnt}}</b></td><td><b>${{$bill->discount($totalwithtax)}}</b></td></tr>
                  <tr><td style="text-align:right;" colspan="6"><b> Grand Total</b></td><td><b>${{$totalwithtax-$bill->discount($totalwithtax)}}</b></td></tr>
                  <tr></tr>
                  <tr></tr>
                  <tr></tr>
                  <tr><td style="text-align:right;" colspan="4"><button type="submit" class="btn btn-rounded waves-effect waves-light bg-green font-14 text-white">Generate Invoice</button></td></tr>


              </tbody>
            </table>
              @endif
              <div class="col-md-2" style="align:center;">

              </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
