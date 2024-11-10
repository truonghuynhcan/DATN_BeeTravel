<!DOCTYPE html>
<html lang="vn">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - @yield('title') - BeeTravel</title>

        <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap.css">
        <script src="{{ asset('') }}assets/bootstrap/js/bootstrap.bundle.min.js" defer></script>
        <!-- icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


        <!-- chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- TRÌNH SOẠN THẢO -->
        <script src="https://cdn.tiny.cloud/1/j3c0uo9sihhr95e3j0x613exxpc573dgffjby8r3q6q0aand/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        

    </head>

    {{-- BTApp - BeeTravelApp / BTCtrl - BeeTravelController --}}

    <body ng-app="BTApp" ng-controller="BTCtrl" class="bg-dark-subtle bg-opacity-25">
        @include('admin.layout.header')

        <!--navbar & nội dung chỉnh-->
        <div class="d-flex">
            <!--navbar left / thanh trái-->
            @include('admin.layout.navbar')

            <!--show nội dung-->
            <section class="w-100 d-inline bg-body-secondary p-2" ng-controller="viewCtrl">
                @yield('main')
            </section>
        </div>



        <!-- ! Angular -->
        <script src="{{ asset('') }}assets/js/angular.min.js"></script>

        <script>
            var app = angular.module('BTApp', [])
            // controller chính toàn bộ website
            app.controller('BTCtrl', function($scope) {})

            var viewFunction = function($scope, $http) {}
        </script>

        <!-- truyền vào function angular từ trang phụ -->
        @yield('viewFunction')

        <!-- Điều kiển nội dung sau khi lấy từ yield('main') -->
        <script>
            app.controller('viewCtrl', viewFunction);
        </script>
    </body>

</html>
