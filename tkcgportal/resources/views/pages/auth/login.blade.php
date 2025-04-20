@php
  function generateRandomVersion()
    {
        return '?v=' . substr(md5(time()), 0, 8);
    }
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="shortcut icon" href="{{asset('public/images/favicon-16x16.png')}}" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/fancybox.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/css/custom.css') . generateRandomVersion() }}">

    <!-- Scripts -->
    <script src="{{ asset('public/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ asset('public/js/sweetalert2@11.js') }}"></script>
    <script src="{{asset('public/js/select2.min.js')}}"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script src="{{asset('public/js/fancybox.min.js')}}"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                screens: {
                    "4xl": {
                        max: "1920px"
                    }, // => @media (max-width: 1920px) { ... }
                    "3xl": {
                        max: "1500px"
                    }, // => @media (max-width: 1500px) { ... }
                    "2xl": {
                        max: "1240px"
                    }, // => @media (max-width: 1240px) { ... }
                    xl: {
                        max: "1024px"
                    }, // => @media (max-width: 1024px) { ... }
                    lg: {
                        max: "992px"
                    }, // => @media (max-width: 992px) { ... }
                    md: {
                        max: "767px"
                    }, // => @media (max-width: 767px) { ... }
                    sm: {
                        max: "489px"
                    }, // => @media (max-width: 479px) { ... }
                    xsm: {
                        max: "320px"
                    }, // => @media (max-width: 389px) { ... }
                }
            }
        }
    </script>
    <script src="{{ asset('public/js/custom.js') }}"></script>
</head>

<style>
    .blur_background {
        background-image: linear-gradient(to bottom, rgba(22, 22, 22, 0.25), rgba(22, 22, 22, 0.25)), url("{{ asset('public/images/bg-image.webp') }}");
        background-color: hsl(0, 0%, 9%);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
<body>
  <div class="blur_background">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-sm p-8 md:m-4 bg-white rounded-xl" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
            <div class="mb-6 text-center">
                <div class="max-w-[150px] mx-auto my-0">
                    <img src="{{ asset('public/images/site_logo.jpg') }}" alt="Site Logo" class="">
                </div>
            </div>
            @if ($errors->any())
                <div class="mb-4">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-500 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="post" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="email"
                        id="email"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        autocomplete="current-password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    />

                    <div class="mt-2 text-sm text-gray-600">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" id="show-hide-btn" class="form-checkbox">
                            <span>Show password</span>
                        </label>
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-900 transition-all"
                >
                    Login
                </button>
            </form>
        </div>
    </div>
  </div>

    <script>
        const showHideBtn = document.getElementById('show-hide-btn');
        const passwordField = document.getElementById('password');

        showHideBtn.addEventListener('change', function () {
            passwordField.type = this.checked ? 'text' : 'password';
        });
    </script>

</body>


</html>
