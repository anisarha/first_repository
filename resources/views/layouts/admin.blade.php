<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- @include('includes.admin.style') --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('backend/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend/fontawesome-free-6.3.0-web/css/fontawesome.min.css') }}"> --}}

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{ url('backend/dist/style/jquery.dataTables.min.css') }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('backend/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{-- drop down select --}}
    <script src="{{ url('backend/dist/script/jquery.js') }}"></script>
    <script src="{{ url('backend/dist/script/jquery-3.5.1.js') }}"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Jquery -->
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> --}}
    <link href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/datatables.min.css" rel="stylesheet" />

    <script src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
    {{-- <link rel="stylesheet" href="{{ asset('backend\dist\jquery.js') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('backend\dist\sweetalert2.all.js') }}"> --}}
    <script src="{{ asset('backend\dist\sweetalert2.all.js') }}"></script>
    <script src="{{ asset('backend\fontawesome-free-6.3.0-web\css\all.css') }}"></script>

    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>

    <link rel="stylesheet" href="{{ asset('backend\dist\sweetalert2.all.js') }}">
</head>
<style>
    .main-sidebar.sidebar-secondary-dark {
        background-color: rgb(5, 132, 236);
    }

    /* CSS to hide the <div> with class "hide" */
    .hide {
        display: none;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('includes.admin.navbar')

        @yield('breadcrumb')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">



                @yield('content')
                <!-- Header content goes here -->
            </section>


            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- Main content goes here -->
                </div>
            </section>
        </div>

        <!-- /.content-wrapper -->

        <!-- Footer -->
        {{-- <footer class="main-footer">
            <!-- Footer content goes here -->
        </footer> --}}
        @include('includes.admin.sidebar')
        <!-- /.main-footer -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('includes.admin.script')
    @stack('page-script')
</body>

</html>
