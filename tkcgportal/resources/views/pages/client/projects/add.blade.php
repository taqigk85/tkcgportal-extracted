@extends('layout.default')
@section('title', 'Create New Project')
@section('content')
<style>
.image-exist.active { display: none; }
.select2-container .select2-selection--single { width: 100%; padding: 0.90rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 1rem; color: #374151; outline: none; height: auto; display: flex; align-items: center;}
.select2-container--default .select2-selection--single .select2-selection__arrow { height: 50px !important; }
.select2.select2-container.select2-container--default{ width: 100% !important;}
.select2-container .select2-selection--single{ height: 50px !important; }
.select2-dropdown { border: 1px solid #e5e7eb; border-radius: 10px 0px; font-size: 1rem; color: #374151; }
.selected-wall{ border: 1px solid #374151;}

</style>

<div class="fixed top-0 left-0 z-10 flex items-center justify-center hidden w-full h-screen">
    <img src="{{asset('public/images/rounded_loader.svg')}}" alt="loader gif" class="w-20 h-20">
</div>


<div class="w-full">
<div class="w-full max-w-[800px]">
    <div class="flex justify-between items-center mt-[60px] pb-[20px]">
        <div class="list-header">
            <div class="flex items-center justify-start">
                <a href="{{route('client.project.list')}}" class="p-1"><img src="{{asset('public/images/arrow.svg')}}" alt="Back Button" class="w-[20px]"></a>
                <h2 class="font-normal text-2xl">Create New Project</h2>
            </div>
        </div>
    </div>
    
    <div class="p-8 bg-white rounded-md">

        <form action="{{route('client.project.create.next')}}" method="post" class="flex flex-col" onsubmit="return checkForm();">
            @csrf
            <input type="hidden" id="ArtworkImageId" name="ArtworkImageId" value="{{ request()->get('ArtworkImageId', old('ArtworkImageId')) }}">
            <input type="hidden" id="wind_speed" name="wind_speed" value="{{ request()->get('wind_speed', old('wind_speed')) }}">
            <input type="hidden" id="snow_load" name="snow_load" value="{{ request()->get('snow_load', old('snow_load')) }}">
            <input type="hidden" id="ice" name="ice" value="{{ request()->get('ice', old('ice')) }}">
            <input type="hidden" id="building_code" name="building_code" value="{{ request()->get('building_code', old('building_code')) }}">
            <input type="hidden" id="ASCE_code" name="ASCE_code" value="{{ request()->get('ASCE_code', old('ASCE_code')) }}">
        
            <div class="basic-information">
            <div class="mb-6 text-left">
                <h3 class="text-[1.3rem] font-bold text-gray-700">
                    Basic Information
                </h3>
            </div>

            <!-- Name -->
            <div class="input-group mb-4">
                <label for="name" class="text-sm text-gray-600 mb-2 block">Project Name<span class="mandatory">*</span></label>
                <input type="text" name="name" id="name"  class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields"  value="{{ request()->get('name', old('name')) }}" data-error-msg="Project name is required."  />
                <span class="scrollForReq text-red-600 text-sm text-center mt-4 error-message"></span>
            </div>

                <div class="input-group w-full mb-4">
                    <!-- Dummy Preview -->
                    <div id="imagePreviewWrapper" class="mb-[30px] mt-[10px] items-center gap-[10px] hidden">
                        <div id="mainImageContainer" class="mb-[10px]">
                               <!-- JS will append preview here -->
                        </div>
                    </div>
                </div>


                <!-- Artwork Upload -->
                <div class="input-group mb-4 image-exist">
                    <p>Artwork Image (optional)</p>
                    <label for="artwork_image" class="text-sm text-gray-600 mb-2 block">
                        <div class="w-full max-w-full h-[150px] border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center text-center cursor-pointer bg-gray-100 transition-all duration-300 hover:border-gray-400">
                            <img src="{{ asset('public/images/upload_img1.svg') }}" alt="Upload" class="w-[50px] h-[50px] mb-[10px]">
                            <p class="text-[14px] text-[#555]">Click to Upload</p>
                        </div>
                        <input type="file" name="artwork_image" id="artwork_image" accept=".png, .webp, .jpeg, .jpg" class="hidden" />
                    </label>
            </div>

            <div class="flex justify-between gap-2">
                <!-- State -->
                <div class="input-group w-1/2 mb-4">
                    <label for="state" class="text-sm text-gray-600 mb-2 block">State</label>
                    <select name="state" id="state" class="border border-gray-300 rounded-md text-base text-gray-700 outline-none">
                        @foreach($getStates as $state)
                                <option value="{{ $state->state }}"
                                    {{ request()->get('state', old('state')) == $state->state ? 'selected' : '' }}>
                                    {{ $state->state }}
                                </option>
                        @endforeach
                    </select>
                </div>
                <!-- City -->
                <div class="input-group w-1/2 mb-4">
                    <label for="city" class="text-sm text-gray-600 mb-2 block">City</label>
                    <select name="city" id="city" class="border border-gray-300 rounded-md text-base text-gray-700 outline-none" disabled>
                        <option value="">Select City</option>
                    </select>
                </div>
            </div>

            <div class="input-group mb-4">
                <label for="street_name" class="text-sm text-gray-600 mb-2 block">Street</label>
                <input type="text" name="street_name" id="street_name" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none" value="{{ request()->get('street_name', old('street_name')) }}"/>
            </div>

            @php
    $signTypes = [
        ['id' => 'raceway', 'label' => 'Raceway', 'image' => 'public/images/raceway1.jpg'],
        ['id' => 'cabinet', 'label' => 'Cabinet', 'image' => 'public/images/Channel-letter-or-cabinet.jpg'],
        ['id' => 'channel_letters', 'label' => 'Channel Letters', 'image' => 'public/images/Channel-letter-or-cabinet.jpg'],
        ['id' => 'double-post-full-height', 'label' => 'DOUBLE POST FULL HEIGHT', 'image' => 'public/images/monument-pylon-sign/double-post-full-height/double-post-full-height01.png'],
        ['id' => 'single-post-full-height', 'label' => 'SINGLE POST FULL HEIGHT', 'image' => 'public/images/monument-pylon-sign/single-post-full-height/single-post-full-height.png'],
        ['id' => 'double-post-with-cabinet', 'label' => 'DOUBLE POST WITH CABINET', 'image' => 'public/images/monument-pylon-sign/double-post-with-cabinet/double-post-with-cabinet.png'],
        ['id' => 'single-post-with-cabinet', 'label' => 'SINGLE POST WITH CABINET', 'image' => 'public/images/monument-pylon-sign/single-post-with-cabinet/single-post-with-cabinet.png'],
        ['id' => 'post-and-panel', 'label' => 'POST AND PANEL', 'image' => 'public/images/monument-pylon-sign/post-and-panel/post-and-panel.png'],
        ['id' => 'double-post-covered', 'label' => 'DOUBLE POST COVERED', 'image' => 'public/images/monument-pylon-sign/double-post-covered/double-post-covered.png'],
        ['id' => 'single-post-covered', 'label' => 'SINGLE POST COVERED', 'image' => 'public/images/monument-pylon-sign/single-post-covered/single-post-covered.png'],
    ];

    $typeOfSignIds = ['raceway', 'cabinet', 'channel_letters'];

    $typeOfSignItems = collect($signTypes)->whereIn('id', $typeOfSignIds);
    $monumentItems = collect($signTypes)->whereNotIn('id', $typeOfSignIds);
@endphp

<div class="sub-header mb-6 text-left">
    <h3 class="text-xl font-bold text-gray-700">Type of Sign</h3>
</div>
<div class="flex sm:flex-row sm:items-center justify-start flex-wrap -mx-2">
    @foreach($typeOfSignItems as $type)
        <div class="item_container flex flex-col items-center px-2 mb-5 w-1/3 sm:w-1/2">
            <div class="item flex justify-between items-center w-full h-full relative text-center">
                <input 
                    type="radio" 
                    id="{{ $type['id'] }}" 
                    name="wall_type" 
                    value="{{ $type['id'] }}" 
                    class="wall_input hidden"
                    {{ request()->get('wall_type', old('wall_type')) == $type['id'] ? 'checked' : '' }}
                >

                <label for="{{ $type['id'] }}" class="inline-block w-full text-black p-2 border border-gray-200 box-border cursor-pointer relative">
                    <div class="relative pt-[100%]">
                        <img src="{{ asset($type['image']) }}" alt="{{ $type['label'] }}" class="absolute inset-0 m-auto max-h-full w-full h-full object-contain p-[10px_9px]">
                    </div>
                    <span class="block mt-2 px-2.5 py-1 font-bold">{{ $type['label'] }}</span>
                </label>

                <a href="{{ asset($type['image']) }}" data-fancybox="editgallery" class="magnifier_btn absolute top-2 right-2">
                    <span class="svg_mob">
                        <svg fill="#000000" width="20px" height="20px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <path d="M31.707 30.282l-8.845-8.899c1.894-2.262 3.034-5.18 3.034-8.366 0-7.189-5.797-13.018-12.986-13.018s-13.017 5.828-13.017 13.017 5.828 13.017 13.017 13.017c3.282 0 6.271-1.218 8.553-3.221l8.829 8.884c0.39 0.39 1.024 0.39 1.414 0s0.391-1.024 0-1.415zM12.893 24c-6.048 0-11-4.951-11-11s4.952-11 11-11c6.048 0 11 4.952 11 11s-4.951 11-11 11zM17.893 12h-4v-4c0-0.552-0.448-1-1-1s-1 0.448-1 1v4h-4c-0.552 0-1 0.448-1 1s0.448 1 1 1h4v4c0 0.552 0.448 1 1 1s1-0.448 1-1v-4h4c0.552 0 1-0.448 1-1s-0.448-1-1-1z"></path>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    @endforeach
</div>

<div class="sub-header mb-6 mt-10 text-left">
    <h3 class="text-xl font-bold text-gray-700">MONUMENT/PYLON SIGN</h3>
</div>
<div class="flex sm:flex-row sm:items-center justify-start flex-wrap -mx-2">
    @foreach($monumentItems as $type)
        <div class="item_container flex flex-col items-center px-2 mb-5 w-1/3 sm:w-1/2">
            <div class="item flex justify-between items-center w-full h-full relative text-center">
                <input 
                    type="radio" 
                    id="{{ $type['id'] }}" 
                    name="wall_type" 
                    value="{{ $type['id'] }}" 
                    class="wall_input hidden"
                    {{ request()->get('wall_type', old('wall_type')) == $type['id'] ? 'checked' : '' }}
                >

                <label for="{{ $type['id'] }}" class="inline-block w-full text-black p-2 border border-gray-200 box-border cursor-pointer relative">
                    <div class="relative pt-[100%]">
                        <img src="{{ asset($type['image']) }}" alt="{{ $type['label'] }}" class="absolute inset-0 m-auto max-h-full w-full h-full object-contain p-[10px_9px]">
                    </div>
                    <span class="block mt-2 px-2.5 py-1 font-bold">{{ $type['label'] }}</span>
                </label>

                <a href="{{ asset($type['image']) }}" data-fancybox="editgallery" class="magnifier_btn absolute top-2 right-2">
                    <span class="svg_mob">
                        <svg fill="#000000" width="20px" height="20px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <path d="M31.707 30.282l-8.845-8.899c1.894-2.262 3.034-5.18 3.034-8.366 0-7.189-5.797-13.018-12.986-13.018s-13.017 5.828-13.017 13.017 5.828 13.017 13.017 13.017c3.282 0 6.271-1.218 8.553-3.221l8.829 8.884c0.39 0.39 1.024 0.39 1.414 0s0.391-1.024 0-1.415zM12.893 24c-6.048 0-11-4.951-11-11s4.952-11 11-11c6.048 0 11 4.952 11 11s-4.951 11-11 11zM17.893 12h-4v-4c0-0.552-0.448-1-1-1s-1 0.448-1 1v4h-4c-0.552 0-1 0.448-1 1s0.448 1 1 1h4v4c0 0.552 0.448 1 1 1s1-0.448 1-1v-4h4c0.552 0 1-0.448 1-1s-0.448-1-1-1z"></path>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    @endforeach
  </div>
    </div>
    <div class="w-full">
        <button type="submit" class="px-4 py-3 bg-gray-700 text-white text-base border-none rounded-md cursor-pointer transition duration-300 ease-in-out mt-4 mb-4 w-full uppercase">NEXT</button>
    </div>
    </form>
</div>
</div>
</div>

<script>
var fileTypesBusLicense = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'webp', 'WEBP'];
$("#artwork_image").on('change', function (e) {
    if ($(this).val() !== '') {
        var that = this;
        if (this.files && this.files[0]) {
            var file = this.files[0];
            var fsize = file.size;
            const fileSizeKB = Math.round(fsize / 1024);

           
            if (fileSizeKB >= 10240) {
                Swal.fire({
                    title: 'Image size is too big!',
                    text: 'Please upload an image smaller than 10MB.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                e.target.value = ''; 
                return;
            }

            var extension = file.name.split('.').pop();
            var isSuccess = fileTypesBusLicense.includes(extension);

            if (!isSuccess) {
                Swal.fire({
                    title: 'Invalid file format!',
                    text: 'Only JPG, JPEG, PNG, WEBP formats are allowed.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                e.target.value = ''; 
                return;
            }

            var img = new Image();
            img.src = URL.createObjectURL(file);
            img.onload = function () {
                if (img.width < 840 || img.height < 456) {
                    Swal.fire({
                        title: 'Invalid image dimensions!',
                        text: 'Please upload an image with at least 840x456 pixels.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    e.target.value = ''; 
                } else {
                    upload(that, extension); 
                }
            };
        }
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
            url: "{{route("client.project.artwork.upload")}}",
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
                    $("#ArtworkImageId").val('');
                    $("#ArtworkImageId").val(data.imageId);
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
                }
                else {
                    Swal.fire({
                        title: 'File format not supported. Please upload a PNG, JPG or WEBP file',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: '',
                            title: '',
                            actions: '',
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                        }
                    });
                }
            },
            complete: function (data) {
                $("#imagePreview").attr('src', data.miniImageUrl);
                $('#imagePreview').on('load', function () {
                    $('.overlay').removeClass('active');
                    $('body').removeClass('overlay_section');
                    $(".acoda-spinner").css("display", "none");
                });
            },
            error: function (xhr, status, error) {
                console.log('error', error.message);
            }
        });
    }

    $('body').on('click', '#removeImageBtn', function () {
        $('.image-exist').removeClass('active');
        $("#imagePreview").attr('src', '');
        $("#ArtworkImageId").val('');
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

$('body').on('change', '#city', function () {
    const cityName = $(this).val();
    const stateName = $('#state').val();
    const windSpeedInput = $('#wind_speed');
    const snowLoadInput = $('#snow_load');
    const iceInput = $('#ice');
    const ASCE_codeInput = $('#ASCE_code');
    const building_codeInput = $('#building_code');

    if (cityName) {
        $.ajax({
            url: "{{ route('getWindSnowValueByCities') }}",
            method: 'POST',
            data: {
                state: stateName,
                city: cityName,
                "_token": "{{ csrf_token() }}"
            },
            success: function (response) {
                windSpeedInput.val(response.wind || '');
                snowLoadInput.val(response.snow || '');
                iceInput.val(response.ice || '');
                ASCE_codeInput.val(response.stateData.ASCE_code || '');
                building_codeInput.val(response.stateData.building_code || '');
            },
            error: function () {
                windSpeedInput.val('');
                snowLoadInput.val('');
                iceInput.val('');
                ASCE_codeInput.val('');
                building_codeInput.val('');
            }
        });
    } else {
        windSpeedInput.val('');
        snowLoadInput.val('');
        iceInput.val('');
        ASCE_codeInput.val('');
        building_codeInput.val('');
    }
});
$('.item_container label').matchHeight();

$("input[name='wall_type']").on('change', function () {
    var selectedWallType = $("input[name='wall_type']:checked").val();

    $("input[name='wall_type']").each(function () {
        $(this).next('label').removeClass("selected-wall");
    });

    $(this).next('label').addClass("selected-wall");
});

</script>
@endsection