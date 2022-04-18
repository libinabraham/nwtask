@extends('layout.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ isset($bill) ? 'Edit' : 'Create a new' }} Bill</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Bill</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
      <form class="form-horizontal" method="POST" action="{{route('bills.update',$bill->id)}}" id="BillFrm" enctype="multipart/form-data">
          @csrf
          @METHOD('PUT')
      <div class="row">
        <div class="col-md-12">

          <div class="card card-primary">

            <div class="card-body">
              <div id="row-content">

                @if($bill->bill_details)

                @foreach ($bill->bill_details as $key => $bill_detail)

              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    @if($key==0)
                    <label for="inputName">Item Name</label>
                    @endif
                    <input type="hidden" name="bdetail_id[]" value="{{$bill_detail->id }}">
                    <input type="text" name="name[]" id="inputName" class="form-control" value="{{$bill_detail->name}}" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                      @if($key==0)
                    <label for="inputName">Quantity</label>
                    @endif
                    <input type="number" name="quantity[]" min="1" id="inputName" class="form-control" value="{{$bill_detail->quantity}}" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                      @if($key==0)
                    <label for="inputName">Price</label>
                  @endif
                    <input type="number" name="price[]" id="inputName" class="form-control" value="{{$bill_detail->price}}" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                      @if($key==0)
                    <label for="inputStatus">Tax %</label>
                    @endif
                    <select class="form-control custom-select" name ="tax[]" required>
                      <option selected disabled>Select Tax</option>
                      <option value="0" {{ $bill_detail->tax == 0 ? 'selected' : '' }} >0</option>
                      <option value="1" {{ $bill_detail->tax == 1 ? 'selected' : '' }}>1</option>
                      <option value="5" {{ $bill_detail->tax == 5 ? 'selected' : '' }}>5</option>
                      <option value="10" {{ $bill_detail->tax == 10 ? 'selected' : '' }}>10</option>
                    </select>
                  </div>
                </div>
              <div class="col-md-3">
                  @if($key==0)
                  <div class="form-group">
                    <button type="button" class="btn btn-rounded waves-effect waves-light bg-blue font-14 text-white" id="addmore">Add more item</button>
                  </div>
                  @else

                  <div class="form-group">

                    <button type="button"  data-id="{{ $bill_detail->id }}" data-token="{{ csrf_token() }}" class="btn btn-danger del-item" ><i class="fa fa-trash"></i></button></div>

                  @endif

              </div>
            </div>
            @endforeach
            @endif
              <!-- /.row -->

              <!-- /.row -->
            </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-rounded waves-effect waves-light bg-green font-14 text-white">Save</button>

                  <!--   <input type="submit" value="Save" class="btn btn-success ">-->
                  </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>

      </div>
      <div class="row">

      </div>
        </form>
    </section>

    <!-- /.content -->
  </div>
@endsection
