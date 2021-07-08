<!--begin::Fonts-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<!--end::Fonts-->
<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{ asset('admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles-->
<!--begin::Global Theme Styles(used by all pages)-->
<link href="{{ asset('admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->
<!--begin::Layout Themes(used by all pages)-->
<link href="{{ asset('admin/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" type="text/css" />
<!--end::Layout Themes-->
@yield('css')