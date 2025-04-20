@extends('layout.default')
@section('title', 'Client View')
@section('content')
@php
$company_logo_id = App\Helpers\CommonHelper::getUserMeta($user->id, 'CompanyLogoId');
$company_logo = \App\Helpers\CommonHelper::getPhotoById($company_logo_id);
$name = $user->name;
$mobile = App\Helpers\CommonHelper::getUserMeta($user->id, 'mobile');
$company_name = App\Helpers\CommonHelper::getUserMeta($user->id, 'company_name');
$email = $user->email;
$state = App\Helpers\CommonHelper::getUserMeta($user->id, 'state');
$city = App\Helpers\CommonHelper::getUserMeta($user->id, 'city');
$street_name = App\Helpers\CommonHelper::getUserMeta($user->id, 'street_name');
@endphp

@if (session('success'))
    <div class="flex items-center gap-2 p-2.5 mt-[50px] rounded-md text-sm font-bold bg-green-100 text-green-800 border border-green-300 alert">
        <span class="w-5 h-5">
            <svg viewBox="0 0 24 24" fill="none" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="green" stroke-width="2"/>
                <path d="M7 12l3 3 7-7" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="flex items-center gap-2 p-2.5 mt-[50px] rounded-md text-sm font-bold bg-red-100 text-red-800 border border-red-300 alert">
        <span class="w-5 h-5">
            <svg viewBox="0 0 24 24" fill="none" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="red" stroke-width="2"/>
                <path d="M8 8l8 8M16 8l-8 8" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        {{ session('error') }}
    </div>
@endif
<div class="w-full max-w-4xl">
    <div class="flex justify-between items-center py-5 mt-12">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.client.edit', $user->id) }}" class="p-1">
                <img src="{{ asset('public/images/arrow.svg') }}" alt="Back Button">
            </a>
            <h2 class="text-2xl font-normal">View Profile</h2>
        </div>
        <a href="{{ route('admin.client.edit', $user->id) }}" class="bg-[#EBF0F9] w-[30px] h-[30px] flex items-center justify-center rounded-full">
            <img src="{{ asset('public/images/icons_edit.svg') }}" alt="Edit Icon" class="w-4 h-4">
        </a>
    </div>

    <div class="w-full p-8 lg:p-4 bg-white rounded-md shadow-sm">
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Basic Information</h3>
    
            @if(!empty($company_logo_id))
            <div class="mb-6">
                <p class="text-sm font-medium text-gray-700 mb-1">Company Logo</p>
                <div class="w-fit border border-gray-200 p-2 rounded-md">
                    <img src="{{ $company_logo->url }}" alt="Company Logo" class="w-36 h-36 object-contain rounded-md">
                </div>
            </div>
            @endif
    
            <div class="w-full">
                <div class="flex min-w-[250px] lg:flex items-center lg:w-full">
                    <div class="w-1/2 mb-4">
                        <p class="text-sm text-gray-600 mb-1">Name</p>
                        <p class="text-sm text-black-600 mb-1">{{ $name }}</p>
                    </div>
    
                    @if(!empty($mobile))
                    <div class="w-1/2 mb-4">
                        <p class="text-sm text-gray-600 mb-1">Mobile</p>
                        <p class="text-sm text-black-600 mb-1">{{ $mobile }}</p>
                    </div>
                    @endif
                </div>
    
                <div class="flex min-w-[250px] lg:flex items-center lg:w-full">
                    @if(!empty($company_name))
                    <div class="w-1/2 mb-4">
                        <p class="text-sm text-gray-600 mb-1">Company Name</p>
                        <p class="text-sm text-black-600 mb-1">{{ $company_name }}</p>
                    </div>
                    @endif
    
                    <div class="w-1/2 mb-4">
                        <p class="text-sm text-gray-600 mb-1">Email</p>
                        <p class="text-sm text-black-600 mb-1">{{ $email }}</p>
                    </div>
                </div>
            </div>
        </div>
    
        @if(!empty($state) || !empty($city) || !empty($street_name))
        <div class="w-full">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Address</h3>
            <div class="w-full">
                <div class="flex min-w-[250px] lg:flex items-center lg:w-full">
                    @if(!empty($state))
                    <div class="w-1/2 mb-4">
                        <p class="text-sm text-gray-600 mb-1">State</p>
                        <p class="text-sm text-black-600 mb-1">{{ $state }}</p>
                    </div>
                    @endif
    
                    @if(!empty($city))
                    <div class="w-1/2 mb-4">
                        <p class="text-sm text-gray-600 mb-1">City</p>
                        <p class="text-sm text-black-600 mb-1">{{ $city }}</p>
                    </div>
                    @endif
                </div>
    
                <div class="flex min-w-[250px] lg:flex items-center lg:w-full">
                    @if(!empty($street_name))
                    <div class="w-1/2 mb-4">
                        <p class="text-sm text-gray-600 mb-1">Street Name</p>
                        <p class="text-sm text-black-600 mb-1">{{ $street_name }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.display = 'none';
        });
    }, 3000);
</script>
@endsection
