@extends('layout.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Bill</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Bill</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
      <form class="form-horizontal" method="POST" action="{{route('bills.store')}}" id="BillFrm" enctype="multipart/form-data">
          @csrf
      <div class="row">
        <div class="col-md-12">

          <div class="card card-primary">

            <div class="card-body">
              <div id="row-content">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="inputName">Item Name</label>
                    <input type="text" name="name[]" id="inputName" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="inputName">Quantity</label>
                    <input type="number" name="quantity[]" min="1" id="inputName" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="inputName">Price</label>
                    <input type="number" name="price[]" id="inputName" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="inputStatus">Tax %</label>
                    <select class="form-control custom-select" name ="tax[]" required>
                      <option selected disabled>Select Tax</option>
                      <option value="0">0</option>
                      <option value="1">1</option>
                      <option value="5">5</option>
                      <option value="10">10</option>
                    </select>
                  </div>
                </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <button type="button" class="btn btn-rounded waves-effect waves-light bg-blue font-14 text-white" id="addmore">Add more item</button>
                  </div>
              </div>
            </div>
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
