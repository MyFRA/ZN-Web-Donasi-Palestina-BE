<!DOCTYPE html>
<html lang="en">

@include('panel.layouts.partials.head')

<body>
    <div class="wrapper">
        @include('panel.layouts.partials.sidebar')

        <div class="main">
            @include('panel.layouts.partials.navbar')

            <main class="content">
                <div class="container-fluid p-0">

                    @yield('content')

                </div>
            </main>

            @include('panel.layouts.partials.footer')
        </div>
    </div>


    <script src="{{ asset('panel-assets/js/app.js') }}"></script>
    @yield('scripts')

</body>

</html>
