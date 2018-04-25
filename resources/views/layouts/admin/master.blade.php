<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
        <title>{{ $page_title or "AdminLTE Dashboard" }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link rel="stylesheet" href="{{ asset ("/bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
        <!-- Font Awesome Icons -->
        <link href="{{ asset ("/bower_components/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{ asset ("/bower_components/Ionicons/css/ionicons.min.css") }}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
            page. However, you can choose any other skin. Make sure you
            apply the skin class to the body tag so the changes take effect.
        -->
        <link href="{{ asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="{{ asset ("/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css") }}">
    </head>

    <body class="skin-blue">
        <div class="wrapper">

            <!-- Header -->
            @include('layouts.admin.header')

            <!-- Sidebar -->
            @include('layouts.admin.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        {{ $page_title or "Page Title" }}
                        <small>{{ $page_description or null }}</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Your Page Content Here -->
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <!-- Footer -->
            @include('layouts.admin.footer')

        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.3 -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="{{ asset ("/bower_components/jquery/dist/jquery.min.js") }}" type="text/javascript"></script>

        <!-- Bootstrap 3.3.2 JS -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ("/vendor/laravel-admin/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
        Both of these plugins are recommended to enhance the
        user experience -->
        <script type="text/javascript" charset="utf8" src="{{ asset ("/bower_components/datatables.net/js/jquery.dataTables.min.js") }}"></script>
        
        <script>
        /////////////////////////////////////////////////////////////////
            ////Ajax function for delete/////

        HTMLElement.prototype.del = function(delUrl){
            var resp = confirm("Are you sure you want to delete this post?");
            if (resp == true) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax(
                {
                    url: delUrl,
                    type: 'delete',
                    dataType: "JSON",
                    data: "{}",
                    success: function (response)
                    {
                            window.location.href = "/clients/approved";
                        
                        console.log(response); // see the reponse sent
                    },
                    error: function(xhr) {
                    console.log(xhr.responseText); 
                }
                
                });
            }
        }
        //////////////////////////////////////////////
        ////Ajax function for approve/////

        HTMLElement.prototype.approve = function(id){
            var resp = confirm("Approve this client?");
            var url = '/clients/' + id + '/approve';
            if (resp == true) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax(
                {
                    url: url,
                    type: 'post',
                    dataType: "JSON",
                    data: "{}",
                    success: function (response)
                    {
                            window.location.href = "/clients/manage";
                        
                        console.log(response); // see the reponse sent
                    },
                    error: function(xhr) {
                    console.log(xhr.responseText); 
                }
                
                });
            }
        }

        //////////////////////////////////////////////////////////
            
        </script>
        @stack('js')
    </body>
</html>