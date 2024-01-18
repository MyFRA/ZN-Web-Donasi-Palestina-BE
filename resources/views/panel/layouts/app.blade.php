<!DOCTYPE html>
<html lang="en">

@include('panel.layouts.partials.head')

@yield('styles')

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
    <form action="" method="post" id="form-delete">
        @method('DELETE')
        @csrf
    </form>

    <script src="{{ asset('panel-assets/js/app.js') }}"></script>
    @yield('scripts')
    <script>
        function onDelete(elem) {
            if (confirm('Apakah anda yakin?')) {
                const formElement = document.getElementById('form-delete');
                formElement.setAttribute('action', elem.dataset.url)
                formElement.submit()
            }
        }
    </script>

</body>

</html>
