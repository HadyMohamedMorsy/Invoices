<!-- Title -->
<title> Valex -  Premium dashboard ui bootstrap rwd admin html5 template </title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<!-- Sidemenu css -->
<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">


@if ( LaravelLocalization::getCurrentLocale()  == 'ar')
    <link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">
    @yield('css')
    <!--- Style css -->
    <link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
@else
    <link rel="stylesheet" href="{{URL::asset('assets/css/sidemenu.css')}}">
    @yield('css')
    <!--- Style css -->
    <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet">
@endif

<style>
    .Delete-form{
        display: inline-block;
    }
</style>
