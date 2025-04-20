@extends('layout.default')
@section('title', 'Edit Client')
@section('content')
<style>
.image-exist.active { display: none; }
.select2-container .select2-selection--single { width: 100%; padding: 0.90rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 1rem; color: #374151; outline: none; height: auto; display: flex; align-items: center;}
.select2-container--default .select2-selection--single .select2-selection__arrow { height: 50px !important; }
.select2.select2-container.select2-container--default{ width: 100% !important;}
.select2-container .select2-selection--single{ height: 50px !important; }
.select2-dropdown { border: 1px solid #e5e7eb; border-radius: 10px 0px; font-size: 1rem; color: #374151; }
</style>
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
<div class="w-full max-w-[800px]">
    <div class="flex justify-between items-center pb-5 mt-14">
            <div class="list-header">
                <div class="flex items-center justify-start">
                    <a href="{{route('admin.client.list')}}" class="p-1"><img src="{{asset('public/images/arrow.svg')}}" alt="Back Button"></a>
                    <h2 class="font-normal text-2xl">Edit Client</h2>
                </div>
            </div>
            <div class="list-header">
                <div class="flex items-center justify-center -mx-1.5">
                    <a href="{{ route('admin.client.view', $user->id) }}"
                        class="bg-[#F3EAFD] inline-flex items-center justify-center w-[30px] h-[30px] rounded-[20px] mx-1.5">
                        <img src="{{ asset('public/images/d_eye_icon.svg') }}" alt="View Icon" class="max-w-[16px]">
                        </a>
                </div>
        </div>
    </div>

    <div class="w-full p-8 bg-white rounded-md">
        <form action="{{route('admin.client.edit.post',$user->id)}}" method="post" class="flex flex-col"
            onsubmit="return checkForm();">
            @csrf
            <input type="hidden" id="CompanyLogoId" name="CompanyLogoId" value="{{$company_logo_id}}">
            <!-- Basic Information Section -->
            <div class="basic-information">
                <div class="mb-6 text-left">
                    <h3 class="text-[1.3rem] font-bold text-gray-700">Basic Information</h3>
                </div>

                <!-- Company Logo Upload -->
                <div class="input-group w-full mb-4">
                    <!-- Dummy Preview -->
                    <div id="imagePreviewWrapper" class="mb-[30px] mt-[10px] items-center gap-[10px] {{ isset($company_logo->url) ? 'flex' : 'hidden' }}">
                        <div id="mainImageContainer" class="mb-[10px]">
                            @if(isset($company_logo->url))
                            <div class="image-preview-container w-auto rounded-md border border-gray-300 inline-block">
                                <div class="image-wrapper p-[0.30rem]">
                                    <img id="imagePreview" src="{{ $company_logo->url }}" alt="Company Logo" class="w-[150px] h-[150px] rounded-md object-contain block m-0 p-0" />
                                </div>
                                <div class="remove-button-wrapper">
                                    <button type="button" id="removeImageBtn" class="px-2.5 py-1 bg-red-600 text-white border-none cursor-pointer w-full mt-1">Remove</button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                </div>

                <div class="input-group w-full mb-4 image-exist {{ isset($company_logo->url) ? 'active' : '' }}">
                    <p class="text-sm text-gray-600 mb-2">Company Logo</p>
                    <label for="company_logo" class="text-sm text-gray-600 mb-2 block">
                        <div class="w-full max-w-[180px] h-[150px] border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center text-center cursor-pointer bg-gray-100 transition-all duration-300 ease-in-out hover:border-gray-400">
                            <img src="{{ asset('public/images/upload_img1.svg') }}" alt="Upload" class="w-[50px] h-[50px] mb-2">
                            <p class="text-[14px] text-gray-700">Click to Upload</p>
                        </div>
                        <input type="file" name="company_logo" id="company_logo" accept=".png, .webp, .jpeg, .jpg" class="p-2 border border-gray-300 rounded-md text-base w-full hidden cursor-pointer" />
                    </label>
                </div>

                <div class="flex justify-between gap-[10px]">
                    <!-- Name -->
                   <div class="input-group w-1/2 mb-4">
                        <label for="name" class="text-sm text-gray-600 mb-2 block">Name<span class="mandatory">*</span></label>
                        <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" value="{{$name}}"
                            data-error-msg="Name is required" />
                        <span class="scrollForReq error-message"></span>
                    </div>
                    <!-- Mobile -->
                   <div class="input-group w-1/2 mb-4">
                        <label for="mobile" class="text-sm text-gray-600 mb-2 block">Mobile<span class="mandatory">*</span></label>
                        <input type="text" name="mobile" id="mobile" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields phone_validation"
                        value="{{$mobile}}" data-error-msg="Mobile is required" />
                        <span class="scrollForReq error-message"></span>
                    </div>
                </div>

                <div class="flex justify-between gap-[10px]">
                    <!-- Company Name -->
                    <div class="input-group w-1/2 mb-4">
                        <label for="company_name" class="text-sm text-gray-600 mb-2 block">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none"
                            value="{{ old('company_name', $company_name) }}" />
                    </div>

                    <!-- Email -->
                    <div class="input-group w-1/2 mb-4">
                        <label for="email" class="text-sm text-gray-600 mb-2 block">Email<span class="mandatory">*</span></label>
                        <input type="text" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields email_validation"
                        value="{{$email}}" data-error-msg="Email is required" />
                        <span class="scrollForReq error-message"></span>
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div class="address-information">
                <div class="mb-6 text-left">
                    <h3 class="text-[1.3rem] font-bold text-gray-700">Address</h3>
                </div>

                <div class="flex justify-between gap-[10px]">
                    <!-- State -->
                    <div class="input-group w-1/2 mb-4">
                        <label for="state" class="text-sm text-gray-600 mb-2 block">State</label>
                        <select name="state" id="state" class="border border-gray-300 rounded-md text-base text-gray-700 outline-none">
                            <option value="">Select State</option>
                            @foreach($getStates as $value)
                            <option value="{{ $value->state }}" @if($state==$value->state) selected @endif>{{
                                $value->state }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- City -->
                    <div class="input-group w-1/2 mb-4">
                        <label for="city" class="text-sm text-gray-600 mb-2 block">City</label>
                        <select name="city" id="city" class="border border-gray-300 rounded-md text-base text-gray-700 outline-none" required disabled>
                            <option value="{{ $city ?? '' }}">{{ $city ?: 'Select City' }}</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-between gap-[10px]">
                    <!-- Street Name -->
                    <div class="input-group w-1/2 mb-4">
                        <label for="street_name" class="text-sm text-gray-600 mb-2 block">Street Name</label>
                        <input type="text" name="street_name" id="street_name" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none" value="{{$street_name}}" />
                    </div>

                    <!-- Password -->
                    <div class="input-group w-1/2 mb-4">
                        <label for="password" class="text-sm text-gray-600 mb-2 block">Change Password</label>
                        <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none" autocomplete="new-password" />

                        <div class="py-2 flex items-center gap-2">
                            <input type="checkbox" id="show-hide-btn" class="!w-[15px] !h-[15px] cursor-pointer border border-gray-300 rounded-md text-base text-gray-700 outline-none"/>
                            <label for="show-hide-btn" class="text-sm text-gray-600 cursor-pointer !mb-0">
                                Show password
                            </label>
                        </div>
                        
                    </div>
                </div>
            </div>

         <div class="w-full">
            <!-- Submit Button -->
            <button type="submit" class="p-[0.95rem] bg-gray-700 text-white text-base border-none rounded-md cursor-pointer transition-all duration-300 mt-4 mb-4 w-full uppercase">UPDATE</button>
        </div>
        </form>
    </div>
</div>


<!-- Scripts -->
<script>
    const showHideBtn = document.getElementById('show-hide-btn');
    const passwordField = document.getElementById('password');

    showHideBtn.addEventListener('change', function () {
        if (this.checked) {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    });

    // upload artwork image start

    var fileTypesBusLicense = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'webp', 'WEBP'];

    $("#company_logo").on('change', function (e) {
        if ($(this).val() != '') {
            var that = this;
            if (this.files && this.files[0]) {
                var fsize = this.files[0].size;
                const file = Math.round((fsize / 1024));
                if (file >= 10240) {
                    Swal.fire({
                        title: 'Image size is too big, please upload less then 10MB size',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: '',
                            title: '',
                            actions: '',
                        },

                    }).then(response => {
                        if (!response.ok) {
                        }
                        return response.json();
                    });
                }
                var extension = this.files[0].name.split('.').pop().toLowerCase(),
                    isSuccess = fileTypesBusLicense.indexOf(extension) > -1;
                if (isSuccess) {
                    upload(this, extension);
                } else {
                    Swal.fire({
                        title: 'Invalid file format, only upload (JPG, JPEG, PNG, WEBP) formats',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: '',
                            title: '',
                            actions: '',
                        },

                    }).then(response => {
                        if (!response.ok) {
                        }
                        return response.json();
                    });
                }
            }
            e.target.value = '';
        }
    });

    function upload(img, extension) {
    var form_data = new FormData();
    form_data.append('photo', img.files[0]);
    form_data.append('_token', '{{ csrf_token() }}');

    $('.overlay').addClass('active');
    $('body').addClass('overlay_section');
    $(".acoda-spinner").css("display", "inline-flex");

    jQuery.ajax({
        url: "{{ route('admin.company.logo.upload') }}",
        data: form_data,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function (data) {
            if (!data.errors) {
                $('#imagePreviewWrapper').show();
                $('.image-preview-container').remove();
                $('.image-exist').addClass('active');

                $("#imagePreview").attr('src', '');
                $("#CompanyLogoId").val('');
                $("#CompanyLogoId").val(data.imageId);
                $("#imagePreview").attr('src', data.miniImageUrl);

                $('#mainImageContainer').append(`
                    <div class="image-preview-container inline-block w-auto rounded-md border border-gray-300">
                        <div class="image-wrapper p-[0.30rem]">
                            <img id="imagePreview" src="${data.miniImageUrl}" alt="Company Logo" class="w-[150px] h-[150px] rounded-md object-contain block m-0 p-0" />
                        </div>
                        <div class="remove-button-wrapper">
                            <button type="button" id="removeImageBtn" class="w-full mt-1 px-2.5 py-1 bg-red-600 text-white text-sm rounded-md cursor-pointer">Remove</button>
                        </div>
                    </div>
                `);
            } else {
                Swal.fire({
                    title: 'File format not supported. Please upload a PNG, JPG or WEBP file',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                });
            }
        },
        complete: function () {
            $('#imagePreview').on('load', function () {
                    $('.overlay').removeClass('active');
                    $('body').removeClass('overlay_section');
                    $(".acoda-spinner").css("display", "none");
                });
            },
            error: function (xhr, status, error) {
                console.error('Upload error:', error.message);
            }
        });
    }

    // Handle Remove Button Click
    $('body').on('click', '#removeImageBtn', function () {
        $('.image-exist').removeClass('active');
        $("#imagePreview").attr('src', '');
        $("#CompanyLogoId").val('');
        $('#imagePreviewWrapper').hide();
        $('.image-preview-container').remove();
    });

    // upload artwork image end

    // Validate form start
    function checkForm() {
        $('.overlay').addClass('active');
        $('body').addClass('overlay_section');
        $(".acoda-spinner").css("display", "inline-flex");

        let hasErrors = false;
        let firstErrorElement = null;

        $(".required_fields").each(function () {
            let $this = $(this);
            let value = $this.val().trim();
            let errorMessage = $this.data("error-msg");
            let errorContainer = $this.closest('.input-group').find('.error-message');

            if (!value) {
                hasErrors = true;
                if (!firstErrorElement) {
                    firstErrorElement = $this;
                }
                errorContainer.html(errorMessage);
            } else {
                errorContainer.empty();
            }

            // Mobile number validation (if applicable)
            if ($this.hasClass('phone_validation')) {
                let inputValue = $this.val().trim();
                if (!inputValue) {
                    hasErrors = true;
                    errorContainer.html("Mobile number is required");
                } else if (inputValue.length < 10) {
                    hasErrors = true;
                    errorContainer.show().html("Mobile number must be at least 10 digits");
                } else {
                    errorContainer.empty();
                }
            }

            // Email validation (if applicable)
            if ($this.hasClass('email_validation')) {
                let inputValue = $this.val().trim();
                let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Standard email validation pattern

                if (!inputValue) {
                    hasErrors = true;
                    errorContainer.text("Email is required").show();
                } else if (!emailPattern.test(inputValue)) {
                    hasErrors = true;
                    errorContainer.text("Enter a valid email address").show();
                } else {
                    errorContainer.hide();
                }
            }

        });

        if (hasErrors) {
            hideLoader();
            Swal.fire({
                title: 'Please fill all required fields',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then(() => {
                if (firstErrorElement) {
                    $("html, body").animate({
                        scrollTop: firstErrorElement.offset().top - 150
                    }, 500);
                }
            });
            return false;
        }

        console.log('Validation successful!');
        return true;
    }

    // Validate form end
    function hideLoader() {
        $('.overlay').removeClass('active');
        $('body').removeClass('overlay_section');
        $(".acoda-spinner").css("display", "none");
    }

    $('.required_fields').on('keyup', function () {
        let $inputGroup = $(this).closest('.input-group');
        let errorMessage = $inputGroup.find('.error-message');
        let errorIcon = $inputGroup.find('.error');

        if (!$(this).val().trim()) {
            errorMessage.text($(this).data("error-msg")).show();
            errorIcon.hide();
        } else {
            errorMessage.hide();
            errorIcon.hide();
        }
    });


    $(document).ready(function () {
        $('#state, #city').select2();
    });

    $('body').on('change', '#state', function () {
        const stateName = $(this).val();
        const citySelect = $('#city');

        if (stateName) {
            citySelect.prop('disabled', true).empty().append('<option>Loading...</option>');

            $.ajax({
                url: "{{ route('getCitiesByState') }}",
                method: 'POST',
                data: {
                    stateName: stateName,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    citySelect.prop('disabled', false).empty();

                    if (response.message && response.message === 'No data found') {
                        citySelect.append('<option value="">No data found</option>');
                    } else {
                        citySelect.append('<option value="">Select City</option>');
                        response.forEach(city => {
                            citySelect.append(`<option value="${city}">${city}</option>`);
                        });
                    }

                    citySelect.select2();
                },
                error: function () {
                    citySelect.prop('disabled', false).empty().append('<option>Error fetching cities</option>');
                }
            });
        } else {
            citySelect.prop('disabled', true).empty().append('<option value="">Select City</option>');
        }
    });

</script>
@endsection