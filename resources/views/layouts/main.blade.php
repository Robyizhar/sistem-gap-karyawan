<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard | GAP INFORMATION</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('layouts.style')
    </head>
    <body data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
        <div id="wrapper">
            @include('layouts.navbar')
            @include('layouts.leftside')
            @yield('content')
        </div>
        <div class="form-process" style="display: none;">
            <div class="css3-spinner">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
            </div>
        </div>
        {{-- @include('layouts.rightside') --}}
        <div class="rightbar-overlay"></div>
        @include('layouts.script')

    </body>
</html>

