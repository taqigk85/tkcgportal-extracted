@php
  function generateRandomVersion()
    {
        return '?v=' . substr(md5(time()), 0, 8);
    }
    $company_logo_id = App\Helpers\CommonHelper::getUserMeta(Auth::user()->id, 'CompanyLogoId');
    $company_logo = \App\Helpers\CommonHelper::getPhotoById($company_logo_id);
    $role = \App\Helpers\CommonHelper::getUserRole(Auth::user()->id);
    $routeArray = app('request')
    ->route()
    ->getAction();
    $controllerAction = class_basename($routeArray['controller']);
    [$controller, $action] = explode('@', $controllerAction);
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
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

<body onload="LoadFromQueryString();recalc_onclick('');" onunload='' browserstorage="false">
  <div class="overlay fixed top-0 left-0 w-full h-full z-[13] bg-black/60 bottom-0 transition-opacity duration-300 ease-in-out hidden"></div>
    <div class="acoda-spinner fixed top-0 left-0 z-10 justify-center items-center w-full h-screen hidden">
        <img src="{{asset('public/images/rounded_loader.svg')}}" alt="loader gif" class="rounded_loader w-[80px] h-[80px]">
    </div>

    <div class="flex bg-[#f4f4f4] justify-end ">
        <!-- Sidebar -->

        <div class="sidebar  fixed 3xl:w-[20%] w-[15%] 2xl:w-[20%] h-screen bg-white border-r border-gray-300 z-[11] top-0 left-0 xl:left-[-60%] lg:left-[-80%] xl:-translate-x-full xl:transition-transform duration-300 ease-in-out h-screen">
        <div class="w-full">
            <div class="mb-2 relative">

                <a href="{{ $role === 'admin' ? route('admin.dashboard') : ($role === 'client' ? route('client.dashboard') : '#') }}"  class="inline-block w-full xl:max-w-[200px] p-5">
                    <img src="{{ asset('public/images/site_logo.jpg') }}" alt="Site Logo" class="max-w-[150px]">
                </a>
                <div class="absolute right-0 top-[10px] hidden xl:block">
                    <a href="javascript:void(0);" id="closeMenu" class="inline-block w-full p-2.5">
                        <img src="{{ asset('public/images/simple-remove@2x.png') }}" alt="Close Menu" class="w-[30px] xl:w-[25px]">
                    </a>
                </div>
            </div>

            <ul class="sidebar-menu h-screen list-none">
                @if (strcmp($role, 'client') === 0)
                    <li class="mb-2 w-full">
                        <a href="{{ route('client.dashboard') }}" class="sidebar-link flex items-center w-full px-8 py-2 text-left text-gray-800 text-base transition duration-300 border border-transparent hover:bg-green-500 hover:text-white active:bg-green-500 active:text-white @if (strcmp($controller, 'DashboardController') == 0) active @endif">
                            <span class="mr-2">
                                <svg width="20px" height="20px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 6V15H6V11C6 9.89543 6.89543 9 8 9C9.10457 9 10 9.89543 10 11V15H15V6L8 0L1 6Z" fill="#000"/>
                                </svg>
                            </span>
                            Dashboard
                        </a>
                    </li>

                    <li class="mb-2 w-full">
                        <a href="{{ route('client.project.list') }}" class="sidebar-link flex items-center w-full px-8 py-2 text-left text-gray-800 text-base transition duration-300 border border-transparent hover:bg-green-500 hover:text-white active:bg-green-500 active:text-white @if (strcmp($controller, 'ProjectController') == 0) active @endif">
                            <span class="mr-2">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.4 2h13.2A3.4 3.4 0 0 1 22 5.4v13.2a3.4 3.4 0 0 1-3.4 3.4H5.4A3.4 3.4 0 0 1 2 18.6V5.4A3.4 3.4 0 0 1 5.4 2ZM7 5a1 1 0 0 1 1 1v8a1 1 0 1 1-2 0V6a1 1 0 0 1 1-1Zm5 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0V6a1 1 0 0 1 1-1Zm6 1a1 1 0 1 0-2 0v10a1 1 0 1 0 2 0V6Z" fill="#000"/>
                                </svg>
                            </span>
                            Projects
                        </a>
                    </li>
                @endif

                @if (strcmp($role, 'client') === 0)
                <li class="mb-2 w-full">
                    <a href="{{ route('client.profile.view', Auth::user()->id) }}" class="sidebar-link flex items-center w-full px-8 py-2 text-left text-gray-800 text-base transition duration-300 border border-transparent hover:bg-green-500 hover:text-white active:bg-green-500 active:text-white @if (strcmp($controller, 'SettingController') == 0) active @endif">
                        <span class="mr-2">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.31 0-10 1.67-10 5v2h20v-2c0-3.33-6.69-5-10-5z" fill="#000"/>
                            </svg>
                        </span>
                        Settings
                    </a>
                </li>

                @endif
                @if (strcmp($role, 'admin') === 0)
                  <li class="mb-2 w-full">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center w-full px-8 py-2 text-left text-gray-800 text-base transition duration-300 border border-transparent hover:bg-green-500 hover:text-white active:bg-green-500 active:text-white @if (strcmp($controller, 'DashboardController') == 0) active @endif">
                            <span class="mr-2">
                                <svg width="20px" height="20px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 6V15H6V11C6 9.89543 6.89543 9 8 9C9.10457 9 10 9.89543 10 11V15H15V6L8 0L1 6Z" fill="#000"/>
                                </svg>
                            </span>
                            Dashboard
                        </a>
                    </li>

                    <li class="mb-2 w-full">
                        <a href="{{ route('admin.project.list') }}" class="sidebar-link flex items-center w-full px-8 py-2 text-left text-gray-800 text-base transition duration-300 border border-transparent hover:bg-green-500 hover:text-white active:bg-green-500 active:text-white @if (strcmp($controller, 'ProjectController') == 0) active @endif">
                            <span class="mr-2">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.4 2h13.2A3.4 3.4 0 0 1 22 5.4v13.2a3.4 3.4 0 0 1-3.4 3.4H5.4A3.4 3.4 0 0 1 2 18.6V5.4A3.4 3.4 0 0 1 5.4 2ZM7 5a1 1 0 0 1 1 1v8a1 1 0 1 1-2 0V6a1 1 0 0 1 1-1Zm5 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0V6a1 1 0 0 1 1-1Zm6 1a1 1 0 1 0-2 0v10a1 1 0 1 0 2 0V6Z" fill="#000"/>
                                </svg>
                            </span>
                            Projects
                        </a>
                    </li>
                @endif


                @if (strcmp($role, 'admin') === 0)
                <li class="mb-2 w-full">
                        <a href="{{ route('admin.client.list') }}" class="sidebar-link flex items-center w-full px-8 py-2 text-left text-gray-800 text-base transition duration-300 border border-transparent hover:bg-green-500 hover:text-white active:bg-green-500 active:text-white @if (strcmp($controller, 'ClientController') == 0) active @endif">
                            <span class="mr-2">
                                <svg width="20px" height="20px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16,12.5C16,11.837 15.737,11.201 15.268,10.732C14.799,10.263 14.163,10 13.5,10C11.447,10 8.553,10 6.5,10C5.837,10 5.201,10.263 4.732,10.732C4.263,11.201 4,11.837 4,12.5C4,14.147 4,15 4,15L16,15C16,15 16,14.147 16,12.5ZM3,13L0,13C0,13 0,12.147 0,10.5C0,9.837 0.263,9.201 0.732,8.732C1.201,8.263 1.837,8 2.5,8L6.536,8C6.754,8.376 7.031,8.714 7.355,9L6.5,9C4.567,9 3,10.567 3,12.5L3,13ZM10,3C11.656,3 13,4.344 13,6C13,7.656 11.656,9 10,9C8.344,9 7,7.656 7,6C7,4.344 8.344,3 10,3ZM6.126,6.997C6.084,6.999 6.042,7 6,7C4.344,7 3,5.656 3,4C3,2.344 4.344,1 6,1C7.026,1 7.932,1.516 8.473,2.302C7.022,2.903 6,4.333 6,6C6,6.344 6.044,6.679 6.126,6.997Z" fill="#000"/>
                                </svg>
                            </span>
                            Clients
                        </a>
                    </li>
                @endif

            </ul>
        </div>
        </div>

        <!-- Main Layout -->
            <div class="w-[85%] 3xl:w-[80%] xl:w-full bg-white flex flex-col shadow-md">
            <header class="flex justify-end items-center bg-white border-b border-gray-300 w-full fixed top-0 left-0 right-0 z-10">
                <div class="xl:block menu-toggle hidden absolute left-5 p-1 rounded-md cursor-pointer">
                    <img src="{{asset('public/images/toggle_menu_icon.svg')}}" alt="" class="max-w[20px] w-full">
                </div>
                <div class="profile-dropdown relative">
                    <button class="profile-btn bg-white border-none cursor-pointer flex items-center p-2.5">
                        @if(strcmp($role, 'client') === 0)
                            <img src="{{ isset($company_logo->url) ? $company_logo->url : asset('public/images/avtar-small.jpg') }}"
                                alt="Profile"
                                class="w-10 h-10 rounded-full object-contain mr-2.5 border border-gray-300 p-[3px]">
                        @endif
                        @if(strcmp($role, 'admin') === 0)
                            <img src="{{ asset('public/images/site_logo.jpg') }}"
                                alt="Profile"
                                class="w-10 h-10 rounded-full object-contain mr-2.5 border border-gray-300 p-[3px]">
                        @endif
                        <span>User</span>
                    </button>

               <!-- Dropdown Menu -->
                <ul class="dropdown-menu absolute top-[62px] right-[7px] bg-white shadow-md list-none p-0 overflow-hidden max-h-0 transition-[max-height] duration-300 ease-in-out min-w-[150px] rounded-md">
                    @if(strcmp($role, 'client') === 0)
                        <li class="border-b border-gray-300">
                            <a href="{{route('client.profile.view', Auth::user()->id)}}"
                                class="block w-full text-left p-2.5 text-gray-800 hover:bg-gray-100">Settings</a>
                        </li>
                    @endif
                    <li class="border-b border-gray-300">
                        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                        <a href="javascript:void(0);" onclick="document.getElementById('logoutForm').submit();"
                            class="block w-full text-left p-2.5 bg-gray-700 text-white text-sm hover:bg-gray-800">
                            Logout
                        </a>
                    </li>
                </ul>

                </div>
            </header>

            <div class="flex-grow p-5 bg-gray-100 min-h-screen h-full">
                @yield('content')
            </div>
            </div>
    </div>

    <script>
        const profileBtn = document.querySelector('.profile-btn');
        const dropdown = document.querySelector('.dropdown-menu');

        profileBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (dropdown.style.maxHeight && dropdown.style.maxHeight !== '0px') {
                dropdown.style.maxHeight = '0px';
            } else {
                dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
            }
        });

        window.addEventListener('click', function () {
            dropdown.style.maxHeight = '0px';
        });


        $(document).ready(function () {
            $('.menu-toggle').on('click', function (e) {
                e.preventDefault();
                $('.sidebar').addClass('active');
                $(this).hide();
                $('.overlay').addClass('active');
                $('body').addClass('overlay_section');
            });

            $(document).on('click', '.overlay.active', function () {
                $('.sidebar').removeClass('active');
                $('.menu-toggle').show();
                $(this).removeClass('active');
                $('body').removeClass('overlay_section');
            });


             $(document).on('click', '#closeMenu', function () {
                $('.sidebar').removeClass('active');
                $('.menu-toggle').show();
                $('.overlay').removeClass('active');
                $('body').removeClass('overlay_section');
            });
        });
    </script>
</body>

</html>