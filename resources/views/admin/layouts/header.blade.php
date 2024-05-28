<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>
        {{$setting->site_name}} @yield('title')
    </title>
    <!-- meta csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ url('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ url('backend/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">

    <!-- toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- datatables  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/css/components.css') }}">

    <!-- custom file css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">

    @stack('css')

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->

</head>
<body>
