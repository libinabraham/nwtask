<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('app.name')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>


    <!-- Right navbar links -->

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Bills
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('bills.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Bills</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('bills.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Bills</p>
                </a>
              </li>

            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->


@yield('content')


  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<script>
$(document).on('click', '#addmore', function(){
            var html = '<div class="row"><div class="col-md-3"><div class="form-group"><input type="text" name="name[]" id="inputName" class="form-control" required></div></div><div class="col-md-2"><div class="form-group"><input type="number" name="quantity[]" min="1" id="inputName" class="form-control" required></div></div><div class="col-md-2"><div class="form-group"><input type="number" name="price[]" id="inputName" class="form-control" required></div></div><div class="col-md-2"><div class="form-group"><select class="form-control custom-select" name ="tax[]" required><option selected disabled>Select Tax</option><option value="0">0</option><option value="1">1</option><option value="5">5</option><option value="10">10</option></select></div></div><div class="col-md-2"><div class="form-group"><button type="button" class="btn btn-danger" id="remove-item"><i class="fa fa-trash"></i></button></div></div></div>';
            $('#row-content').append(html);
            //$('.dropify').dropify();

        });



 $(document).on('click', '#remove-item', function(){
         // var id = $(this).data('id');
          //$('#slider-photo-remove-'+id).val(1);
          //$('#slider-photo-'+id).remove();
		  $(this).closest(".row").remove();


    });
    $(".del-item").click(function(){
      if(confirm('Are you sure?')){
        var id = $(this).data("id");
        var token = $(this).data("token");

        $.ajax(
        {
            url: "{{ url('bills/remove')}}" + '/' + id,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function ()
            {

                window.top.location = window.top.location
            }
        });

      }
    });
</script>
</body>
</html>
