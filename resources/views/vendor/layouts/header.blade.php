<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- meta csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>One Shop || e-Commerce HTML Template</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/add_row_custon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/mobile_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.exzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/multiple-image-video.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/ranger_style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.classycountdown.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ url('backend/assets/modules/summernote/summernote-bs4.css') }}">
    <!-- datatables  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
    <style>
        .form-group.wsus__dash_pro_single {
            margin-bottom: 20px;
            display: block;
        }

        .wsus__dash_pro_single.form-group label,
        .textarea-field label {
            display: block;
            margin-bottom: 8px;
            text-transform: capitalize;
            font-size: 14px;
            color: #444;
        }

        .wsus__dash_pro_single.form-group .form-control {
            display: block;
            font-size: 14px;
            font-weight: 400;
        }

        .wsus__dash_pro_single.note-editing-area {
            font-size: 14px;
        }

        .wsus__dash_pro_single.note-editing-area p {
            font-size: 14px;
            font-weight: 400;
        }
    </style>
    @stack('css')

</head>

<body>


    <!--=============================
    DASHBOARD MENU START
  ==============================-->
    <div class="wsus__dashboard_menu">
        <div class="wsusd__dashboard_user">
            <img src="images/dashboard_user.jpg" alt="img" class="img-fluid">
            <p>anik roy</p>
        </div>
    </div>
    <!--=============================
    DASHBOARD MENU END
  ==============================-->
