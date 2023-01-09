<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('_partials.links')
    @yield('page-style')
    
</head>
<body>
    @include('_partials.navbar')
    <div class="wrapper">
        <div class="container-fluid">
            @yield('page-content')
            
            {{-- @include('_partials.modal') --}}
            @yield('page-modal')
        </div>
    </div>
    @include('_partials.scripts')
    @yield('page-scripts')
</body>
</html>
