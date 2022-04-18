@extends('layout.default')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bills</h1>
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
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Bill No</th>
                  
                  <th>Bill Date</th>
                  <th style="width: 25%"></th>
                </tr>
              </thead>
              <tbody>
                @if($bills)
                @foreach ($bills as $bill)
                <tr>
                  <td>{{$bill->id}}</td>
                  <td>{{$bill->user->name}}</td>
                  <td>{{$bill->bill_no}}</td>

                  <td>{{date('d-m-Y',strtotime($bill->created_at))}}</td>
                  <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="{{route('bills.show',$bill->id)}}">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a>
                          <a class="btn btn-info btn-sm" href="{{route('bills.edit',$bill->id)}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>


                <form class="btn btn-sm" method="post"  action="{{route('bills.destroy',$bill->id) }}">
                    @csrf

                    {{ method_field('DELETE') }}

                  <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" type="submit" ><i class="fas fa-trash"></i>Delete </button>
                </form>


                      </td>
                </tr>
                @endforeach

                @else

                @endif


              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
