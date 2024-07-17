<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">


        <title>{{ config('app.name', 'demande_carte') }}</title>
                <!-- Custom fonts for this template-->
        <link href="{{ asset('assets_admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
   
        <!-- Custom styles for this template-->
        <link href="{{ asset('assets_admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body id="page-top">
    
        <!-- Page Wrapper -->
        <div id="wrapper">
    
            <!-- Sidebar -->
            @include('layouts.admin.sidebar')
            <!-- End of Sidebar -->
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    <!-- Topbar -->
                    @include('layouts.admin.navbar')         
                    <!-- End of Topbar -->
    
                    @yield('content')
    
                        <!-- Content Row -->
                        
                        
    
                </div>    
                    <!-- /.container-fluid -->

    
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; card-request 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
    
            </div>
            <!-- End of Content Wrapper -->
    
        </div>
        <!-- End of Page Wrapper -->
    
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('assets_admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('assets_admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('assets_admin/js/sb-admin-2.min.js') }}"></script>
    
        <!-- Page level plugins -->
        <script src="{{ asset('assets_admin/vendor/chart.js/Chart.min.js') }}"></script>
    
        <!-- Page level custom scripts -->
        <script src="{{ asset('assets_admin/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets_admin/js/demo/chart-pie-demo.js') }}"></script>
    
    </body>
    
</html>
