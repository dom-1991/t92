<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login VMO</title>  

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <div class="row d-flex justify-content-center mt-5">
    <div class="col-4 d-flex justify-content-center">
      <div class="card card-primary w-50">
        <div class="card-header">
          <h3 class="card-title">Login VMO</h3>
        </div>
        <!-- /.card-header -->
        <!-- validate -->

        @if (count($errors) >0)
       <ul>
           @foreach($errors->all() as $error)
               <li class="text-danger"> {{ $error }}</li>
           @endforeach
       </ul>
       @endif

       @if (session('status'))
           <ul>
               <li class="text-danger"> {{ session('status') }}</li>
           </ul>
       @endif

        <!-- form start -->
        <form action="{{ route('postLogin') }}" method="post">
          @csrf
          <div class="card-body w-100">
            <div class="form-group">
              <label for="txtEmail">Email</label>
              <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="txtPassword">Password</label>
              <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Password">
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="../../dist/js/demo.js"></script> --}}
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

</body>
</html>
