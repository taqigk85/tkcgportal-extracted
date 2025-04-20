
@extends('layout.default')
@section('title', 'Edit Project Details')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        <span class="alert-icon">
            <svg viewBox="0 0 24 24" fill="none" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="green" stroke-width="2"/>
                <path d="M7 12l3 3 7-7" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        {{ session('success') }}
    </div>
@endif
<style>
.image-exist.active { display: none; }
.php-error-message{ color: #dc2626; font-size: 0.875rem; text-align: center; margin-top: 1rem; }
.raceway_height.inactive , .raceway_depth.inactive{ display: none; }
.approximate_weight.active , .sign_depth.active { width: 100% !important; }
.select2-container .select2-selection--single { width: 100%; padding: 0.90rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 1rem; color: #374151; outline: none; height: auto; display: flex; align-items: center;}
.select2-container--default .select2-selection--single .select2-selection__arrow { height: 50px !important; }
.select2.select2-container.select2-container--default{ width: 100% !important;}
.select2-container .select2-selection--single{ height: 50px !important; }
.select2-dropdown { border: 1px solid #e5e7eb; border-radius: 10px 0px; font-size: 1rem; color: #374151; }
.monument_inputs.hidden{ display: none; } 
.rcc_inputs.hidden{ display: none; }
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
            <h2 class="font-normal text-2xl">Edit Project</h2>
        </div>
    </div>
    <div class="">
        <div class="flex items-center justify-center -mx-1.5">
        <a href="{{ route('client.project.view', Auth::user()->id) }}" class="bg-[#F3EAFD] inline-flex items-center justify-center w-[30px] h-[30px] mx-1.5 rounded-[20px]"><img src="{{ asset('public/images/d_eye_icon.svg') }}" alt="View Icon" class="max-w-[16px]"></a>
        </div>
    </div>
</div>


<div class="p-8 bg-white rounded-md">
    <div class="wall_type_image py-[15px] px-0">
        @php
         $wallTypes = [
            ['folder' => 'raceway', 'file' => 'raceway-drawing-pdf.png', 'datatype' => 'raceway'],
            ['folder' => 'channel-letters', 'file' => 'channel-letters-pdf.png', 'datatype' => 'channel_letters'],
            ['folder' => 'cabinet', 'file' => 'cabinet-drawing-pdf.png', 'datatype' => 'cabinet'],
            ['folder' => 'monument-pylon-sign/double-post-full-height', 'file' => 'double-post-full-height01.png', 'datatype' => 'double-post-full-height'],
            ['folder' => 'monument-pylon-sign/single-post-full-height', 'file' => 'single-post-full-height.png', 'datatype' => 'single-post-full-height'],
            ['folder' => 'monument-pylon-sign/double-post-with-cabinet', 'file' => 'double-post-with-cabinet.png', 'datatype' => 'double-post-with-cabinet'],
            ['folder' => 'monument-pylon-sign/single-post-with-cabinet', 'file' => 'single-post-with-cabinet.png', 'datatype' => 'single-post-with-cabinet'],
            ['folder' => 'monument-pylon-sign/post-and-panel', 'file' => 'post-and-panel.png', 'datatype' => 'post-and-panel'],
            ['folder' => 'monument-pylon-sign/double-post-covered', 'file' => 'double-post-covered.png', 'datatype' => 'double-post-covered'],
            ['folder' => 'monument-pylon-sign/single-post-covered', 'file' => 'single-post-covered.png', 'datatype' => 'single-post-covered']
        ];
        @endphp
        @foreach ($wallTypes as $wall)
            <div class="raceway_container" data-wall-type="{{$wall['datatype']}}" style="display: none;">
                <div class="item_container flex flex-col items-center mb-5 w-[70%] h-auto p-0">
                    <div class="text-center w-full h-full flex justify-between relative !flex-row">
                        <div class="wall_type_choice cursor-default inline-block w-full text-black border border-gray-200 p-2 box-border">
                            <div class="pt-0 relative">
                                <a href="{{ asset('public/images/' . $wall['folder'] . '/' . $wall['file']) }}"
                                   data-fancybox="editgallery"
                                   class="relative block transition duration-300 ease-in-out group">
                                    <img src="{{ asset('public/images/' . $wall['folder'] . '/' . $wall['file']) }}"
                                         alt="Wall Sign"
                                         class="relative h-auto object-contain left-0 right-0 bottom-0 top-0 m-auto max-h-full w-full">
                                    <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[35px] block opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">
                                        <svg fill="#000000" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M31.707 30.282l-8.845-8.899c1.894-2.262 3.034-5.18 3.034-8.366
                                                0-7.189-5.797-13.018-12.986-13.018s-13.017 5.828-13.017
                                                13.017 5.828 13.017 13.017 13.017c3.282 0 6.271-1.218
                                                8.553-3.221l8.829 8.884c0.39 0.39 1.024 0.39 1.414 0s0.391-1.024
                                                0-1.415zM12.893 24c-6.048 0-11-4.951-11-11s4.952-11 11-11c6.048
                                                0 11 4.952 11 11s-4.951 11-11 11zM17.893 12h-4v-4c0-0.552-0.448-1-1-1s-1
                                                0.448-1 1v4h-4c-0.552 0-1 0.448-1 1s0.448 1 1 1h4v4c0 0.552 0.448 1 1
                                                1s1-0.448 1-1v-4h4c0.552 0 1-0.448 1-1s-0.448-1-1-1z"></path>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
    @endforeach
    </div>
    
    <form action="{{route('client.project.edit.post',$data->id)}}" method="post" class="flex flex-col"
        onsubmit="return checkForm();">
        @csrf
        <input type="hidden" id="ArtworkImageId" name="ArtworkImageId" value="{{$data->artwork_image_id}}">
        <!-- Basic Information Section -->
        <div class="basic-information">
            <div class="mb-6 text-left">
                <h3 class="text-[1.3rem] font-bold text-gray-700">
                    Basic Information
                </h3>
            </div>
            @if(strcmp($data->wall_type,'raceway') ==0 ||  strcmp($data->wall_type,'channel_letters') || strcmp($data->wall_type,'cabinet'))
            <div class="flex justify-between gap-2 hidden">
                <!-- Sign Type -->
                  <div class="input-group w-1/2">
                      <fieldset id="FS1$XLEW_3_3_4" class="border-none">
                          <select name="XLEW_3_3_4" id="XLEW_3_3_4" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" data-error-msg="Sign type is required." onchange="recalc_onclick('XLEW_3_3_4')" >
                              <option value="raceway" data-value="s:Raceway"
                                  <?= ($data->wall_type === 'raceway') ? 'selected' : '' ?>>Raceway
                              </option>

                              <option value="monument" data-value="s:Monument"
                                  <?= ($data->wall_type === 'monument') ? 'selected' : '' ?>>Monument
                              </option>

                              <option value="solid_freestanding" data-value="s:Solid Freestanding"
                                  <?= ($data->wall_type === 'solid_freestanding') ? 'selected' : '' ?>>Solid Freestanding
                              </option>

                              <option value="channel_letters" data-value="s:Channel Letters"
                                  <?= ($data->wall_type === 'channel_letters') ? 'selected' : '' ?>>Channel Letters
                              </option>

                              <option value="solid_cantilevered" data-value="s:Solid Cantilevered"
                                  <?= ($data->wall_type === 'solid_cantilevered') ? 'selected' : '' ?>>Solid Cantilevered
                              </option>

                              <option value="solid_attached_roof" data-value="s:Solid Attached to Roof"
                                  <?= ($data->wall_type === 'solid_attached_roof') ? 'selected' : '' ?>>Solid Attached to Roof
                              </option>

                              <option value="solid_attached_wall" data-value="s:Solid Attached to Wall"
                                  <?= ($data->wall_type === 'cabinet') ? 'selected' : '' ?>>Solid Attached to Wall
                              </option>
                          </select>
                      </fieldset>
                  </div>
            </div>
            @endif
            @php
            $name = old('name', $data->name ?? '');
            @endphp
                <!-- Name -->
                <div class="input-group mb-4">
                <label for="name" class="text-sm text-gray-600 mb-2 block">Project Name<span class="mandatory">*</span></label>
                <input type="text" name="name" id="name"  class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields"  value="{{$name}}" data-error-msg="Project name is required."  />
                <span class="scrollForReq text-red-600 text-sm text-center mt-4 error-message"></span>
            </div>

            <!-- Dummy Preview -->
            <div class="input-group mb-4">
                @php
                    $artwork = \App\Helpers\CommonHelper::getPhotoById($data->artwork_image_id);
                @endphp
                   <div id="imagePreviewWrapper" class="mb-7 mt-2 flex items-center {{ isset($artwork->url) ? '' : 'hidden' }}">
                    <div id="mainImageContainer" class="mb-[10px]">
                        @if(isset($artwork->url))
                        <div class="image-preview-container inline-block w-auto rounded-md border border-gray-300">
                            <div class="image-wrapper p-[0.30rem]">
                                <img id="imagePreview" src="{{ $artwork->url }}"alt="Company Logo" class="w-[150px] h-[150px] rounded-md object-contain block m-0 p-0" />
                            </div>
                            <div class="remove-button-wrapper">
                                <button type="button" id="removeImageBtn" class="w-full mt-1 px-2.5 py-1 bg-red-600 text-white text-sm rounded-md cursor-pointer">Remove</button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Artwork Upload -->
            <div class="input-group mb-4 image-exist {{ isset($artwork->url) ? 'active' : '' }}">
                <p>Artwork Image (optional)</p>
                <label for="artwork_image" class="text-sm text-gray-600 mb-2 block">
                    <div class="w-full max-w-full h-[150px] border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center text-center cursor-pointer bg-gray-100 transition-all duration-300 hover:border-gray-400">
                        <img src="{{asset('public/images/upload_img1.svg')}}" alt="Upload" class="w-[50px] h-[50px] mb-[10px]">
                        <p class="text-[14px] text-[#555]">Click to Upload</p>
                    </div>
                    <input type="file" name="artwork_image" id="artwork_image" accept=".png, .webp, .jpeg, .jpg" class="hidden"/>
                </label>
            </div>

            <div class="flex justify-between gap-2">
                <!-- State -->
                <div class="input-group w-1/2 mb-4">
                    <label for="state" class="text-sm text-gray-600 mb-2 block">State</label>
                    <select name="state" id="state" class="border border-gray-300 rounded-md text-base text-gray-700 outline-none">
                        <option value="">Select State</option>
                            @foreach($getStates as $value)
                            <option value="{{ $value->state }}" @if($data->state == $value->state) selected @endif>{{ $value->state }}</option>
                            @endforeach
                    </select>
                </div>
                <!-- City -->
                <div class="input-group w-1/2 mb-4">
                    <label for="city" class="text-sm text-gray-600 mb-2 block">City</label>
                    <select name="city" id="city" class="border border-gray-300 rounded-md text-base text-gray-700 outline-none" disabled>
                        <option value="{{ $data->city ?? '' }}">{{ $data->city ?? 'Select City' }}</option>
                    </select>
                </div>
            </div>

            <!-- Street -->
        <div class="input-group mb-4">
                @php
                  $street = old('street_name', $data->street ?? '');
                @endphp
                <label for="street_name" class="text-sm text-gray-600 mb-2 block">Street</label>
                <input type="text" name="street_name" id="street_name" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none" value="{{$street}}"/>
        </div>
            @php
            $signTypes = [
                'raceway' => ['label' => 'Raceway', 'image' => 'public/images/raceway-drawing_side-0002.jpg'],
                'cabinet' => ['label' => 'Cabinet', 'image' => 'public/images/Channel-letter-or-cabinet.jpg'],
                'channel_letters' => ['label' => 'Channel Letters', 'image' => 'public/images/Channel-letter-or-cabinet.jpg'],
            ];
            @endphp
            <div class="">
                <div class="sub-header mb-6 text-left">
                    <h3 class="text-xl font-bold text-gray-700">Type of Sign</h3>
                </div>
                <div class="flex sm:flex-row sm:items-center justify-start flex-wrap -mx-2">
                    @foreach ($signTypes as $key => $sign)
                        <div class="item_container flex flex-col items-center px-2 mb-5 w-1/3 sm:w-1/2">
                            <div class="item flex justify-between items-center w-full h-full relative text-center">
                                <input type="radio" id="{{ $key }}" name="wall_type" value="{{ $key }}" class="wall_input hidden"
                                    {{ old('wall_type', isset($data->wall_type) ? $data->wall_type : '') == $key ? 'checked' : '' }}>
                                <label for="{{ $key }}" class="inline-block w-full text-black p-2 border border-gray-200 box-border cursor-pointer relative">
                                    <div class="relative pt-[100%]">
                                        <img src="{{ asset($sign['image']) }}" alt="{{ $sign['label'] }}" class="absolute inset-0 m-auto max-h-full w-full h-full object-contain p-[10px_9px]">
                                    </div>
                                    <span class="block mt-2 px-2.5 py-1 font-bold">{{ $sign['label'] }}</span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

         @php
            $signTypes1 = [
                'double-post-full-height' => ['label' => 'DOUBLE POST FULL HEIGHT', 'image' => 'public/images/monument-pylon-sign/double-post-full-height/double-post-full-height01.png'],
                'single-post-full-height' => ['label' => 'SINGLE POST FULL HEIGHT', 'image' => 'public/images/monument-pylon-sign/single-post-full-height/single-post-full-height.png'],
                'double-post-with-cabinet' => ['label' => 'DOUBLE POST WITH CABINET', 'image' => 'public/images/monument-pylon-sign/double-post-with-cabinet/double-post-with-cabinet.png'],
                'single-post-with-cabinet' => ['label' => 'SINGLE POST WITH CABINET', 'image' => 'public/images/monument-pylon-sign/single-post-with-cabinet/single-post-with-cabinet.png'],
                'post-and-panel' => ['label' => 'POST AND PANEL', 'image' => 'public/images/monument-pylon-sign/post-and-panel/post-and-panel.png'],
                'double-post-covered' => ['label' => 'DOUBLE POST COVERED', 'image' => 'public/images/monument-pylon-sign/double-post-covered/double-post-covered.png'],
                'single-post-covered' => ['label' => 'SINGLE POST COVERED', 'image' => 'public/images/monument-pylon-sign/single-post-covered/single-post-covered.png'],
            ];
         @endphp

            <div class="">
                <div class="sub-header mb-6 text-left">
                    <h3 class="text-xl font-bold text-gray-700">MONUMENT/PYLON SIGN</h3>
                </div>
                <div class="flex sm:flex-row sm:items-center justify-start flex-wrap -mx-2">
                    @foreach ($signTypes1 as $key => $sign)
                        <div class="item_container flex flex-col items-center px-2 mb-5 w-1/3 sm:w-1/2">
                            <div class="item flex justify-between items-center w-full h-full relative text-center">
                                <input type="radio" id="{{ $key }}" name="wall_type" value="{{ $key }}" class="wall_input hidden"
                                    {{ old('wall_type', isset($data->wall_type) ? $data->wall_type : '') == $key ? 'checked' : '' }}>
                                <label for="{{ $key }}" class="inline-block w-full text-black p-2 border border-gray-200 box-border cursor-pointer relative">
                                    <div class="relative pt-[100%]">
                                        <img src="{{ asset($sign['image']) }}" alt="{{ $sign['label'] }}" class="absolute inset-0 m-auto max-h-full w-full h-full object-contain p-[10px_9px]">
                                    </div>
                                    <span class="block mt-2 px-2.5 py-1 font-bold">{{ $sign['label'] }}</span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="rcc_inputs">

            <div class="flex justify-between gap-2.5">
                <!-- A - Sign Height (ft) -->
                 <div class="input-group w-1/2 mb-4">
                    @php
                    $signHeight = old('name', $data->sign_height ?? '');

                    $inputId = '';
                    if (strcmp($data->wall_type, 'raceway') == 0) {
                        $inputId = 'XLEW_3_4_4';
                    }
                    if (strcmp($data->wall_type, 'channel_letters') == 0) {
                        $inputId = 'XLEW_3_4_4';
                    }
                    if(strcmp($data->wall_type, 'cabinet') == 0){
                        $inputId = 'XLEW_3_4_4';
                    }
                    @endphp
                   <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Sign Height<span class="mandatory">*</span></label>
                    <input type="text" name="sign_height" id="{{$inputId}}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                        placeholder="Sign Height" value="{{$signHeight}}"
                        data-error-msg="Sign height is required."
                         @if($inputId)
                        onchange="this.value=eedisplayFloatND(eeparseFloat(this.value),2);recalc_onclick('{{$inputId}}')"
                    @endif />
                     <span class="scrollForReq error-message"></span>
                     @error('sign_height')
                     <span class="php-error-message">{{ $errors->first('sign_height') }}</span>
                     @enderror
                </div>

                <!-- Sign Length (ft) -->
                <div class="input-group w-1/2 mb-4">
                    @php
                    $signLength = old('sign_length', $data->sign_length ?? '');
                    $inputId = '';
                    if (strcmp($data->wall_type, 'raceway') == 0) {
                        $inputId = 'XLEW_3_5_4';
                    }
                    if (strcmp($data->wall_type, 'channel_letters') == 0) {
                        $inputId = 'XLEW_3_5_4';
                    }
                    if(strcmp($data->wall_type, 'cabinet') == 0){
                        $inputId = 'XLEW_3_5_4';
                    }
                    @endphp
                    <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Sign Length<span class="mandatory">*</span></label>
                    <input type="text" name="sign_length" id="{{$inputId}}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                        placeholder="Sign Length" data-error-msg="Sign length is required."
                        value="{{$signLength}}" onchange="this.value=eedisplayFloatND(eeparseFloat(this.value),2);recalc_onclick('{{ $inputId }}')" />
                        <span class="scrollForReq error-message"></span>
                        @error('sign_length')
                        <span class="php-error-message">{{ $errors->first('sign_length') }}</span>
                        @enderror
                </div>
            </div>


            <div class="flex justify-between gap-2">

                <!-- B - Sign Depth (ft) -->
                <div class="input-group  w-1/2 mb-4 sign_depth">
                    @php
                    $signDepth = old('sign_depth', $data->sign_depth ?? '');
                    $inputId = '';
                    if (strcmp($data->wall_type, 'raceway') == 0) {
                        $inputId = 'XLEW_3_6_4';
                    }
                    if (strcmp($data->wall_type, 'channel_letters') == 0) {
                        $inputId = 'XLEW_3_6_4';
                    }
                    if(strcmp($data->wall_type, 'cabinet') == 0){
                        $inputId = 'XLEW_3_6_4';
                    }
                    @endphp
                    <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Sign Depth<span class="mandatory">*</span></label>
                    <input type="text" name="sign_depth" id="{{$inputId}}"class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                        placeholder="Sign Depth" data-error-msg="Sign depth is required."
                        value="{{$signDepth}}" onchange="this.value=eedisplayFloatND(eeparseFloat(this.value),2);recalc_onclick('{{ $inputId }}')" />
                        <span class="scrollForReq error-message"></span>
                        @error('sign_depth')
                        <span class="php-error-message">{{ $errors->first('sign_depth') }}</span>
                        @enderror
                </div>


            <!-- Block Depth -->
            <div class="input-group  w-1/2 mb-4 raceway_depth">
                @php
                $blockDepth = old('block_depth', $data->block_depth ?? '');

                $inputId = '';
                if (strcmp($data->wall_type, 'raceway') == 0) {
                    $inputId = 'XLEW_3_7_4';
                }
                @endphp
                <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Raceway Depth<span class="mandatory">*</span></label>
                <input type="text" name="block_depth" id='{{$inputId}}' class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                    placeholder="Raceway Depth" data-error-msg="Raceway depth is required."
                    value="{{ $blockDepth }}" onchange="this.value=eedisplayFloatND(eeparseFloat(this.value),2);recalc_onclick('{{$inputId}}')" />
                    <span class="scrollForReq error-message"></span>
                    @error('block_depth')
                    <span class="php-error-message">{{ $errors->first('block_depth') }}</span>
                    @enderror
              </div>

            </div>

            <div class="flex justify-between gap-2">

            <!-- Block Height -->
            <div class="input-group w-1/2 mb-4 raceway_height">
                @php
                $blockHeight = old('block_depth', $data->block_height ?? '');

                $inputId = '';
                if (strcmp($data->wall_type, 'raceway') == 0) {
                    $inputId = 'XLEW_3_8_4';
                }
                @endphp
                <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Raceway Height<span class="mandatory">*</span></label>
                <input type="text" name="block_height" id="{{$inputId}}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                    placeholder="Raceway Height" data-error-msg="Raceway height is required."
                    value="{{ $blockHeight }}" onchange="this.value=eedisplayFloatND(eeparseFloat(this.value),2);recalc_onclick('{{$inputId}}')" />
                    <span class="scrollForReq error-message"></span>
                    @error('block_height')
                    <span class="php-error-message">{{ $errors->first('block_height') }}</span>
                    @enderror
            </div>

            @php
                $weight = old('weight', $data->weight ?? '');

                $inputId = '';

                if (strcmp($data->wall_type, 'raceway') == 0) {
                    $inputId = 'XLEW_3_9_4';
                }
                if (strcmp($data->wall_type, 'channel_letters') == 0) {
                    $inputId = 'XLEW_3_7_4';
                }
                if(strcmp($data->wall_type, 'cabinet') == 0){
                    $inputId = 'XLEW_3_7_4';
                }
            @endphp
               <!-- Approximate Weight -->
               <div class="input-group w-1/2 mb-4 approximate_weight">
                <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Approximate Weight<span class="mandatory">*</span></label>
                <input type="text" name="weight" id="{{$inputId}}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                       placeholder="Approximate Weight" data-error-msg="Approximate weight is required"
                       value="{{$weight}}" readonly/>
                <span class="scrollForReq error-message"></span>
                @error('weight')
                <span class="php-error-message">{{ $errors->first('weight') }}</span>
                @enderror
            </div>

        </div>
            <div class="flex w-full">
                @php
                $sign_installation_height = old('sign_installation_height', $data->sign_installation_height ?? '');
                $inputId = '';

                if (strcmp($data->wall_type, 'raceway') == 0) {
                    $inputId = 'XLEW_3_10_4';
                }
                if (strcmp($data->wall_type, 'channel_letters') == 0) {
                    $inputId = 'XLEW_3_8_4';
                }
                if(strcmp($data->wall_type, 'cabinet') == 0){
                    $inputId = 'XLEW_3_8_4';
                }
               @endphp
                   <div class="input-group mb-4 !w-full">
                       <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Installation Height<span class="mandatory">*</span></label>
                       <input type="text" name="sign_installation_height" id="{{$inputId}}"
                           class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number" placeholder="Installation Height"
                           data-error-msg="Installation height is required." value="{{$sign_installation_height}}" onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('{{$inputId}}')">
                           <span class="scrollForReq error-message"></span>
                           @error('sign_installation_height')
                           <span class="php-error-message">{{ $errors->first('sign_installation_height') }}</span>
                           @enderror
                   </div>
             </div>


             <div class="flex justify-between gap-2">
                <div class="input-group w-1/2 mb-4">
                     @php
                       $windSpeed = old('wind_speed', $data->wind_speed ?? '');

                        $inputId = '';
                        if (strcmp($data->wall_type, 'raceway') == 0) {
                            $inputId = 'XLEW_3_3_7';
                        }
                        if (strcmp($data->wall_type, 'channel_letters') == 0){
                            $inputId = 'XLEW_3_3_7';
                        }
                        if(strcmp($data->wall_type, 'cabinet') == 0){
                            $inputId = 'XLEW_3_3_7';
                        }
                     @endphp
                        <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Wind Speed<span class="mandatory">*</span></label>
                        <input type="text" name="wind_speed" id="{{$inputId}}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                            placeholder="Wind Speed" data-error-msg="Wind speed is required."
                            value="{{ $windSpeed }}" onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('{{$inputId}}')"/>
                            <span class="scrollForReq error-message"></span>
                            @error('wind_speed')
                            <span class="php-error-message">{{ $errors->first('wind_speed') }}</span>
                            @enderror
                    </div>
                    <div class="input-group w-1/2 mb-4">
                        @php
                        $snowLoad = old('snow_load', $data->snow_load ?? '');

                        $inputId = '';
                        if (strcmp($data->wall_type, 'raceway') == 0) {
                            $inputId = 'XLEW_3_4_7';
                        }
                        if (strcmp($data->wall_type, 'channel_letters') == 0) {
                            $inputId = 'XLEW_3_4_7';
                        }
                        if(strcmp($data->wall_type, 'cabinet') == 0){
                            $inputId = 'XLEW_3_4_7';
                        }
                     @endphp
                        <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Snow Load<span class="mandatory">*</span></label>
                        <input type="text" name="snow_load" id="{{$inputId}}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                            placeholder="Snow Load" data-error-msg="Snow load is required."
                            value="{{ $snowLoad }}" onchange="this.value=eedisplayFloat  (eeparseFloat(this.value));recalc_onclick('{{$inputId}}')">
                            <span class="scrollForReq error-message"></span>
                            @error('snow_load')
                            <span class="php-error-message">{{ $errors->first('snow_load') }}</span>
                            @enderror
                    </div>
                </div>

                <div class="input-group mb-4 w-full">
                 @php
                    $iceLoad = old('ice', $data->ice ?? '');
                 @endphp
                    <label for="ice" class="text-sm text-gray-600 mb-2 block">Ice Load<span class="mandatory">*</span></label>
                    <input type="text" name="ice" id="ice"
                        class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number" placeholder="Ice Load"
                        data-error-msg="Ice load is required." value="{{$iceLoad}}">
                        <span class="scrollForReq error-message"></span>
                        @error('ice')
                        <span class="php-error-message">{{ $errors->first('ice')}}</span>
                        @enderror
                </div>


                <div class="flex justify-between gap-2">
                     <div class="input-group w-1/2 mb-4">
                        @php
                           $building_code = old('building_code', $data->building_code ?? '');
                        @endphp
                           <label for="building_code" class="text-sm text-gray-600 mb-2 block">Building Code<span class="mandatory">*</span></label>
                           <input type="text" name="building_code" id="building_code"
                               class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" placeholder="Building Code"
                               data-error-msg="Building code is required." value="{{$building_code}}">
                               <span class="scrollForReq error-message"></span>
                               @error('building_code')
                               <span class="php-error-message">{{ $errors->first('building_code')}}</span>
                               @enderror
                       </div>

                       <div class="input-group w-1/2 mb-4">
                        @php
                           $ASCE_code = old('ASCE_code', $data->ASCE_code ?? '');
                        @endphp
                           <label for="ASCE_code" class="text-sm text-gray-600 mb-2 block">ASCE Code<span class="mandatory">*</span></label>
                           <input type="text" name="ASCE_code" id="ASCE_code"
                               class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" placeholder="ASCE Code"
                               data-error-msg="Asce Code is required." value="{{$ASCE_code}}">
                               <span class="scrollForReq error-message"></span>
                               @error('ASCE_code')
                               <span class="php-error-message">{{ $errors->first('ASCE_code')}}</span>
                               @enderror
                       </div>
                </div>

                    <div class="flex justify-between gap-2 hidden">
                        <!-- EXPOSURE CATE MISSING-->
                        <div class="input-group w-1/2 mb-4">
                            @php
                            $EXPOSURECATE = request('XLEW_3_5_7') ? request('XLEW_3_5_7') : old('XLEW_3_5_7');

                            $inputId = '';
                            if (strcmp($data->wall_type, 'raceway') == 0) {
                                $inputId = 'XLEW_3_5_7';
                            }
                            if (strcmp($data->wall_type, 'channel_letters') == 0) {
                                $inputId = 'XLEW_3_5_7';
                            }
                            if(strcmp($data->wall_type, 'cabinet') == 0){
                                $inputId = 'XLEW_3_5_7';
                            }
                            @endphp
                            <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">EXPOSURE CATE</label>
                            <fieldset id="FS1$XLEW_3_5_7" class="border-none">
                                <select name="{{$inputId}}" id="{{$inputId}}" class="py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none bg-gray-300" onchange="recalc_onclick('{{$inputId}}')">
                                    <option value="B" data-value="s:B">B</option>
                                    <option value="C" data-value="s:C" selected>C</option>
                                    <option value="D" data-value="s:D">D</option>
                                </select>
                            </fieldset>
                        </div>

                        <div class="input-group w-1/2 mb-4">
                            @php
                            $inputId = '';
                            if (strcmp($data->wall_type, 'raceway') == 0) {
                                $inputId = 'XLEW_3_6_7';
                            }
                            if (strcmp($data->wall_type, 'channel_letters') == 0) {
                                $inputId = 'XLEW_3_6_7';
                            }
                            if(strcmp($data->wall_type, 'cabinet') == 0){
                                $inputId = 'XLEW_3_6_7';
                            }
                            @endphp
                            <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">RISK CATEGORY</label>
                            <fieldset id="FS1$XLEW_3_6_7" class="border-none">
                                <select name="{{$inputId}}" id="{{$inputId}}" class="py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none bg-gray-300" onchange="recalc_onclick('{{$inputId}}')">
                                    <option value="I" data-value="s:I">I</option>
                                        <option value="II"  data-value="s:II" selected>II</option>
                                        <option value="III" data-value="s:III">III</option>
                                        <option value="IV" data-value="s:IV">IV</option>
                                </select>
                            </fieldset>
                    </div>
            </div>
            <div class="flex w-full hidden">
                <div class="input-group w-1/2 mb-4">
                    @php
                    $inputId = '';
                    if (strcmp($data->wall_type, 'raceway') == 0) {
                        $inputId = 'XLEW_3_15_4';
                    }
                    if (strcmp($data->wall_type, 'channel_letters') == 0) {
                        $inputId = 'XLEW_3_15_4';
                    }
                    if(strcmp($data->wall_type, 'cabinet') == 0){
                        $inputId = 'XLEW_3_15_4';
                    }
                    @endphp
                    <textarea id='{{$inputId}}' disabled
                    onchange="recalc_onclick('{{$inputId}}')" onKeyDown="" name='{{$inputId}}'>""</textarea>
                </div>
            </div>
        </div>
        @if(strcmp($data->wall_type,'raceway') != 0 || strcmp($data->wall_type,'cabinet') != 0 || strcmp($data->wall_type,'channel_letters') != 0 )
        <div class="mb-1 text-left">
           <h3 class="text-[1.3rem] font-bold text-gray-700">
            Sign Geometry
           </h3>
       </div>
      @endif
        <div class="monument_inputs">
            <div class="flex justify-between gap-2">
                <div class="input-group w-1/2 mb-4 relative">
                    @php
                    $totalHeight = old('XLEW_1_3_3', $data->total_height ?? '');
                    @endphp
                    <label for="XLEW_1_3_3" class="text-sm text-gray-600 mb-2 block">Total Height<span class="mandatory">*</span></label>
                    <input type="text" name="XLEW_1_3_3" id="XLEW_1_3_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                        placeholder="Total Height"
                        data-error-msg="Total height is required."
                        value="{{ $totalHeight }}"
                        onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('XLEW_1_3_3')">
                        <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                    <span class="scrollForReq error-message"></span>
                    @error('XLEW_1_3_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_3_3') }}</span>
                    @enderror
                </div>

                <div class="input-group mb-4 w-1/2 hidden">
                    <label for="XLEW_1_3_8" class="text-sm text-gray-600 mb-2 block">Ultimate Wind Speed</label>
                    <input type="text" name="XLEW_1_3_8" id="XLEW_1_3_8" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number"
                    value="{{$data->ultimate_wind_speed}}"
                    onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('XLEW_1_3_8')">
                </div>

                <div class="input-group w-1/2 mb-4 relative">
                    <label for="XLEW_1_4_3" class="text-sm text-gray-600 mb-2 block">Cabinet Height<span class="mandatory">*</span></label>
                    <input type="text" name="XLEW_1_4_3" id="XLEW_1_4_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                        placeholder="Cabinet Height"
                        data-error-msg="Cabinet height is required."
                        value="{{ $totalHeight }}"
                        onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('XLEW_1_4_3')" readonly="readonly">
                        <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                    <span class="scrollForReq error-message"></span>
                    @error('XLEW_1_4_3')
                    <span class="php-error-message">{{ $errors->first('XLEW_1_4_3') }}</span>
                    @enderror
                </div>

                <div class="input-group w-1/2 mb-4 hidden">
                    <label for="XLEW_1_4_8">Snow Load</label>
                    <input type="text" name="XLEW_1_4_8" id="XLEW_1_4_8" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number"
                        placeholder="Snow load"
                        value="{{$data->snow_load}}"
                        onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('XLEW_1_4_8')">
                </div>
            </div>

             <div class="flex justify-between gap-2">
                    <div class="input-group w-1/2 mb-4 relative">
                        @php
                          $cabinetWidth = old('XLEW_1_5_3', $data->cabinet_width ?? '');
                        @endphp
                        <label for="XLEW_1_5_3" class="text-sm text-gray-600 mb-2 block">Cabinet Width<span class="mandatory">*</span></label>
                        <input type="text" name="XLEW_1_5_3" id="XLEW_1_5_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                            placeholder="Cabinet Width"
                            data-error-msg="Cabinet width is required."
                            value="{{$cabinetWidth}}"
                            onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('XLEW_1_5_3')">
                        <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                        <span class="scrollForReq error-message"></span>
                        @error('XLEW_1_5_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_5_3') }}</span>
                        @enderror
                    </div>

                    <div class="input-group w-1/2 mb-4 hidden">
                        <label for="XLEW_1_5_8" class="text-sm text-gray-600 mb-2 block">Ice Thickness</label>
                        <input type="text" name="XLEW_1_5_8" id="XLEW_1_5_8" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number"
                        placeholder="Ice Thickness"
                        value="{{$data->ice_thickness}}"
                        onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('XLEW_1_5_8')">
                    </div>

                   <div class="input-group w-1/2 relative">
                    @php
                        $cabinetDepth = old('XLEW_1_6_3', $data->cabinet_depth ?? '');
                      @endphp
                        <label for="XLEW_1_6_3" class="text-sm text-gray-600 mb-2 block">Cabinet Depth<span class="mandatory">*</span></label>
                        <input type="text" name="XLEW_1_6_3" id="XLEW_1_6_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                            placeholder="Cabinet Depth"
                            data-error-msg="Cabinet depth is required."
                            value="{{ $cabinetDepth }}"
                            onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('XLEW_1_6_3')">
                        <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                        <span class="scrollForReq error-message"></span>
                        @error('XLEW_1_6_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_6_3') }}</span>
                        @enderror
                    </div>

                    <div class="input-group w-1/2 mb-4 hidden">
                        <label for="XLEW_1_6_8" class="text-sm text-gray-600 mb-2 block">Exposure Category</label>
                        <fieldset id="FS1$XLEW_1_6_8" class="border-none">
                            <select name="XLEW_1_6_8" id="XLEW_1_6_8" class="py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none bg-gray-300" onchange="recalc_onclick('XLEW_1_6_8')">
                                <option  data-value='s:B' selected >B</option>
                                <option  data-value='s:C' >C</option>
                                <option  data-value='s:D' >D</option>
                            </select>
                        </fieldset>
                    </div>
                </div>

                <div class="input-group w-full mb-4 hidden">
                @php
                    $poleCoverWidths = [
                        'double-post-with-cabinet' => 0,
                        'single-post-full-height' => 0,
                        'double-post-full-height' => 0,
                        'single-post-with-cabinet' => 0,
                        'double-post-covered' => 0,
                        'single-post-covered' => 0,
                        'post-and-panel' => 0
                    ];
                    $poleCoverWidth = $poleCoverWidths[$data->wall_type] ?? 0;
                    $poleCoverWidth = $data->pole_cover_width ?? $poleCoverWidth;
                    $inputId = 'XLEW_1_7_3';
                @endphp

                <label for="XLEW_1_7_3" class="text-sm text-gray-600 mb-2 block">Pole Cover Width</label>
                <input type="text" name="XLEW_1_7_3" id="XLEW_1_7_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number"
                    placeholder="Pole Cover Width"
                    value="{{ $poleCoverWidth }}"
                    onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('XLEW_1_7_3')">
                </div>

                <div class="input-group w-full mb-4 hidden">
                    <label for="XLEW_1_7_8" class="text-sm text-gray-600 mb-2 block">Risk Category</label>
                    <fieldset id="FS1$XLEW_1_7_8" class="border-none">
                        <select name="XLEW_1_7_8" id="XLEW_1_7_8" class="py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none bg-gray-300" onchange="recalc_onclick('XLEW_1_7_8')">
                            <option  data-value='s:I' selected >I</option>
                            <option  data-value='s:II' selected >II</option>
                            <option  data-value='s:III' >III</option>
                            <option  data-value='s:IV' >IV</option>
                        </select>
                    </fieldset>
                </div>
                <div class="flex justify-between gap-2">
                    <div class="input-group w-1/2 mb-4 relative">
                        @php
                        $postSpacingMap = [
                            'double-post-with-cabinet' => '',
                            'single-post-full-height' => 1,
                            'double-post-full-height' => '',
                            'single-post-with-cabinet' => 1,
                            'double-post-covered' => '',
                            'single-post-covered' => 1,
                            'post-and-panel' => $cabinetWidth ?? 0,
                        ];
                        $postSpacing = old('XLEW_1_10_3', $postSpacingMap[$data->wall_type] ?? '');
                        $inputId = 'XLEW_1_10_3';
                        @endphp
                        <label for="XLEW_1_10_3" class="text-sm text-gray-600 mb-2 block">Post Spacing<span class="mandatory">*</span></label>
                        <input type="text" name="XLEW_1_10_3" id="XLEW_1_10_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                            placeholder="Post Spacing"
                            data-error-msg="Post spacing is required."
                            value="{{ $postSpacing }}"
                            onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('XLEW_1_10_3')">
                        <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                        <span class="scrollForReq error-message"></span>
                        @error('XLEW_1_10_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_10_3') }}</span>
                        @enderror
                   </div>



                <div class="input-group w-1/2 mb-4">
                    @php
                    $wallTypePostMap = [
                        'double-post-with-cabinet' => 2,
                        'single-post-full-height' => 1,
                        'double-post-full-height' => 2,
                        'single-post-with-cabinet' => 1,
                        'double-post-covered' => 2,
                        'single-post-covered' => 1,
                        'post-and-panel' => 2,
                    ];
                    $numberOfPosts = old('XLEW_1_9_3', $wallTypePostMap[$data->wall_type] ?? '');
                   @endphp
                    <label for="XLEW_1_9_3" class="text-sm text-gray-600 mb-2 block">Number of Posts<span class="mandatory">*</span></label>
                    <fieldset id="FS1$XLEW_1_9_3" class="border-none">
                        <select name="XLEW_1_9_3" id="XLEW_1_9_3" class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields"
                            data-error-msg="Number of posts is required." onchange="recalc_onclick('XLEW_1_9_3')">
                            <option value="1" data-value='n:1' {{ $numberOfPosts == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" data-value='n:2'{{ $numberOfPosts ==  2 ? 'selected' : '' }}>2</option>
                        </select>
                        <span class="scrollForReq error-message"></span>
                        @error('XLEW_1_9_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_9_3') }}</span>
                        @enderror
                    </fieldset>
                </div>
                </div>

          

               <div class="input-group w-1/2 mb-4 hidden">
                <label for="XLEW_1_11_3" class="text-sm text-gray-600 mb-2 block">Sign Face</label>
                <fieldset id="FS1$XLEW_1_11_3" class="border-none">
                    <select name="XLEW_1_11_3" id="XLEW_1_11_3" class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300" onchange="recalc_onclick('XLEW_1_11_3')">
                        <option value="Double Faced" data-value="s:Double Faced"
                        <?= ($data->sign_face === 'Double Faced') ? 'selected' : '' ?>>Double Faced
                    </option>
                    <option value="Single Faced" data-value="s:Single Faced"
                        <?= ($data->sign_face === 'Single Faced') ? 'selected' : '' ?>>Single Faced
                    </option>
                    </select>
                </fieldset>
              </div>

                <div class="input-group w-1/2 mb-4 hidden">
                    <label for="XLEW_1_12_3" class="text-sm text-gray-600 mb-2 block">Open Area Percentage</label>
                    <input type="text" name="XLEW_1_12_3" id="XLEW_1_12_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number"
                        placeholder="Open Area Percentage"
                        value="{{ $data->open_area_percentage }}"
                        onchange="this.value=eedisplayPercentND(eeparsePercent(this.value),0);recalc_onclick('XLEW_1_12_3')">
                </div>

                          
            <div class="flex justify-between gap-2">
                <div class="input-group w-1/2 mb-4">
                    <label for="XLEW_1_14_3" class="text-sm text-gray-600 mb-2 block">Post Shape<span class="mandatory">*</span></label>
                    <fieldset id="FS1$XLEW_1_14_3" class="border-none">
                        <select name="XLEW_1_14_3" id="XLEW_1_14_3" class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields"
                            data-error-msg="Post shape is required." onchange="recalc_onclick('XLEW_1_14_3')">
                            <option data-value="s:Square" {{ $data->post_shape == 'Square' ? 'selected' : '' }}>Square</option>
                            <option data-value="s:Round" {{ $data->post_shape == 'Round' ? 'selected' : '' }}>Round</option>
                            <option data-value="s:Rect" {{  $data->post_shape == 'Rect' ? 'selected' : '' }}>Rect</option>
                        </select>
                    </fieldset>
                    <span class="scrollForReq error-message"></span>
                    @error('XLEW_1_14_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_14_3') }}</span>
                    @enderror
                </div>
                <div class="input-group w-1/2 mb-4">
                    <label for="XLEW_1_15_3" class="text-sm text-gray-600 mb-2 block">Post Size<span class="mandatory">*</span></label>
                    <fieldset id="FS1$XLEW_1_15_3" class="border-none">
                        <select name="XLEW_1_15_3" id="XLEW_1_15_3" class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" data-error-msg="Post size is required." onchange="recalc_onclick('XLEW_1_15_3')">
                            <option  data-value='s:[Dynamic Dropdown]' selected >[Dynamic Dropdown]</option>
                        </select>
                    </fieldset>
                    <span class="scrollForReq error-message"></span>
                    @error('XLEW_1_15_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_15_3') }}</span>
                        @enderror
                        <div class="default_error">
                            <input id='XLEW_1_15_5' type='text' name='XLEW_1_15_5' value='' readonly='readonly' class="w-full outline-none pointer-events-none text-[#ff0000] text-[14px]"/>
                     </div>
                </div>
                </div>

            <div class="flex justify-between gap-2">
                 <div class="input-group w-1/2 mb-4">
                    <label for="Grade" class="text-sm text-gray-600 mb-2 block">Material<span class="mandatory">*</span></label>
                    <fieldset id="FS1$Grade" class="border-none">
                        <select name="Grade" id="Grade" class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" data-error-msg="Material is required." onchange="recalc_onclick('Grade')">
                            <option data-value="s:A500 Grade B, Round" {{ $data->material == 'A500 Grade B, Round' ? 'selected' : '' }}>A500 Grade B, Round</option>
                            <option data-value="s:A500 Grade B, Square" {{ $data->material == 'A500 Grade B, Square' ? 'selected' : '' }}>A500 Grade B, Square</option>
                            <option data-value="s:A36" {{ $data->material == 'A36' ? 'selected' : '' }}>A36</option>
                            <option data-value="s:3003-H14" {{ $data->material == '3003-H14' ? 'selected' : '' }}>3003-H14</option>
                            <option data-value="s:6061-T6" {{ $data->material == '6061-T6' ? 'selected' : '' }}>6061-T6</option>
                            <option data-value="s:6063-T5" {{ $data->material == '6063-T5' ? 'selected' : '' }}>6063-T5</option>
                            <option data-value="s:6063-T6" {{ $data->material == '6063-T6' ? 'selected' : '' }}>6063-T6</option>
                            <option data-value="s:6061- T6 W" {{ $data->material == '6061- T6 W' ? 'selected' : '' }}>6061- T6 W</option>
                        </select>
                    </fieldset>
                    <span class="scrollForReq error-message"></span>
                    @error('Grade')
                    <span class="php-error-message">{{$errors->first('Grade')}}</span>
                    @enderror
                 </div>


                 <div class="input-group w-1/2 mb-4">
                    <label for="XLEW_1_8_3" class="text-sm text-gray-600 mb-2 block">Aprox Cabinet Weight<span class="mandatory">*</span></label>
                    <input type="text" name="XLEW_1_8_3" id="XLEW_1_8_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                        placeholder="Aprox Cabinet Weight"
                        data-error-msg="Aprox cabinet weight is required."
                        value="{{ $data->aprox_cabinet_weight }}"
                        readonly="readonly">
                    <span class="scrollForReq error-message"></span>
                    @error('XLEW_1_8_3')
                    <span class="php-error-message">{{ $errors->first('XLEW_1_8_3') }}</span>
                    @enderror
                </div>
            </div>

            @if(strcmp($data->wall_type,'raceway') != 0 || strcmp($data->wall_type,'cabinet') != 0 || strcmp($data->wall_type,'channel_letters') != 0 )
            <div class="mb-1 text-left">
               <h3 class="text-[1.3rem] font-bold text-gray-700">
                Anchor
               </h3>
           </div>
          @endif
                 <div class="flex justify-between gap-2">
                     <div class="input-group w-1/2 mb-4">
                        <label for="XLEW_1_18_3" class="text-sm text-gray-600 mb-2 block">Quantity<span class="mandatory">*</span></label>
                        <input type="text" name="XLEW_1_18_3" id="XLEW_1_18_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                            placeholder="Quantity"
                            data-error-msg="Quantity is required."
                            value="{{ $data->quantity }}"
                            onchange="this.value=eedisplayFloatV(eeparseFloatV(this.value));recalc_onclick('XLEW_1_18_3')">
                        <span class="scrollForReq error-message"></span>
                        @error('XLEW_1_18_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_18_3') }}</span>
                        @enderror
                    </div>

                     <div class="input-group w-1/2 mb-4 relative">
                        <label for="Dia" class="text-sm text-gray-600 mb-2 block">Diameter<span class="mandatory">*</span></label>
                        <fieldset id='FS1$Dia' class="border-none">
                            <select name='Dia' id='Dia' onchange="recalc_onclick('Dia')" class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" data-error-msg="Diameter is required.">
                                <option data-value='n:0.375' {{ $data->diameter == '0.375' ? 'selected' : '' }}>0.375</option>
                                <option data-value='n:0.5' {{ $data->diameter == '0.5' ? 'selected' : '' }}>0.5</option>
                                <option data-value='n:0.5625' {{ $data->diameter == '0.5625' ? 'selected' : '' }}>0.5625</option>
                                <option data-value='n:0.625' {{ $data->diameter == '0.625' ? 'selected' : '' }}>0.625</option>
                                <option data-value='n:0.75' {{ $data->diameter == '0.75' ? 'selected' : '' }}>0.75</option>
                                <option data-value='n:0.875' {{ $data->diameter == '0.875' ? 'selected' : '' }}>0.875</option>
                                <option data-value='n:1' {{ $data->diameter == '1' ? 'selected' : '' }}>1</option>
                                <option data-value='n:1.125' {{ $data->diameter == '1.125' ? 'selected' : '' }}>1.125</option>
                                <option data-value='n:1.25' {{ $data->diameter == '1.25' ? 'selected' : '' }}>1.25</option>
                                <option data-value='n:1.5' {{ $data->diameter == '1.5' ? 'selected' : '' }}>1.5</option>
                                <option data-value='n:1.75' {{ $data->diameter == '1.75' ? 'selected' : '' }}>1.75</option>
                                <option data-value='n:2' {{ $data->diameter == '2' ? 'selected' : '' }}>2</option>
                                <option data-value='n:2.25' {{ $data->diameter == '2.25' ? 'selected' : '' }}>2.25</option>
                                <option data-value='n:2.5' {{ $data->diameter == '2.5' ? 'selected' : '' }}>2.5</option>
                                <option data-value='n:2.75' {{ $data->diameter == '2.75' ? 'selected' : '' }}>2.75</option>
                            </select>
                        </fieldset>
                        <span class="absolute top-[40px] right-[20px] text-gray-500">in</span>

                        <span class="scrollForReq error-message"></span>
                        @error('Dia')
                        <span class="php-error-message">{{ $errors->first('Dia') }}</span>
                        @enderror
                    </div>
                  </div>

                  <div class="input-group w-full mb-4">
                    <label for="XLEW_1_20_3" class="text-sm text-gray-600 mb-2 block">Grade<span class="mandatory">*</span></label>
                    <fieldset id='FS1$XLEW_1_20_3' class="border-none">
                        <select name='XLEW_1_20_3' id='XLEW_1_20_3' class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" data-error-msg="Grade is required." onchange="recalc_onclick('XLEW_1_20_3')">
                            <option data-value='s:F1554 (36)' {{ $data->grade == 'F1554 (36)' ? 'selected' : '' }}>F1554 (36)</option>
                            <option data-value='s:F1554 (55)' {{ $data->grade == 'F1554 (55)' ? 'selected' : '' }}>F1554 (55)</option>
                            <option data-value='s:F1554 (105)' {{ $data->grade == 'F1554 (105)' ? 'selected' : '' }}>F1554 (105)</option>
                            <option data-value='s:A307' {{ $data->grade == 'A307' ? 'selected' : '' }}>A307</option>
                            <option data-value='s:A36' {{ $data->grade == 'A36' ? 'selected' : '' }}>A36</option>
                            <option data-value='s:A572' {{ $data->grade == 'A572' ? 'selected' : '' }}>A572</option>
                            <option data-value='s:A588' {{ $data->grade == 'A588' ? 'selected' : '' }}>A588</option>
                        </select>
                    </fieldset>
                    <span class="scrollForReq error-message"></span>
                     @error('XLEW_1_20_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_20_3') }}</span>
                    @enderror
                    <input id='XLEW_1_20_5' type='hidden' readonly='readonly' value='' name='XLEW_1_20_5' />
                 </div>

                 @if(strcmp($data->wall_type,'raceway') != 0 || strcmp($data->wall_type,'cabinet') != 0 || strcmp($data->wall_type,'channel_letters') != 0 )
                 <div class="mb-1 text-left">
                    <h3 class="text-[1.3rem] font-bold text-gray-700">
                        Spread Footing
                    </h3>
                </div>
               @endif

                 <div class="flex justify-between gap-2">
                 <div class="input-group w-1/2 mb-4">
                    <label for="XLEW_1_22_3" class="text-sm text-gray-600 mb-2 block">Individual or Combined?<span class="mandatory">*</span></label>
                    <fieldset id='FS1$XLEW_1_22_3' class="border-none">
                        <select name='XLEW_1_22_3' id='XLEW_1_22_3' class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" data-error-msg="Individual or Combined? is required." onchange="recalc_onclick('XLEW_1_22_3')">
                            <option  data-value='s:Individual' {{ $data->individual_or_combined == 'Individual' ? 'selected' : '' }}>Individual</option>
                            <option  data-value='s:Combined' {{ $data->individual_or_combined == 'Combined' ? 'selected' : '' }} >Combined</option>
                        </select>
                    </fieldset>
                    <span class="scrollForReq error-message"></span>
                    @error('XLEW_1_22_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_22_3') }}</span>
                    @enderror
                </div>

                <div class="input-group w-1/2 mb-4 relative">
                    <label for="XLEW_1_23_3" class="text-sm text-gray-600 mb-2 block">Adjust Length<span class="mandatory">*</span></label>
                    <div class="flex gap-2 items-baseline">
                        <select id="adjustLengthDropdown" class="!w-[40%] py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none" onchange="updateAdjustLength()">
                            @for ($i = 2; $i <= 7; $i += 0.25)
                                <option value="{{ number_format($i, 2) }}" {{ $data->adjust_length == number_format($i, 2) ? 'selected' : '' }}>
                                    {{ number_format($i, 2) }}
                                </option>
                            @endfor
                        </select>

                        <div class="w-[60%]">
                            <input type="text" name="XLEW_1_23_3" id="XLEW_1_23_3"
                                class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                                placeholder="Adjust Length"
                                data-error-msg="Adjust length is required."
                                value="{{ $data->adjust_length }}"
                                onchange="this.value=eedisplayFloatNDV(eeparseFloatV(this.value),2);recalc_onclick('XLEW_1_23_3')"
                                readonly="readonly">
                                <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                            <span class="scrollForReq error-message"></span>
                            @error('XLEW_1_23_3')
                                <span class="php-error-message">{{ $errors->first('XLEW_1_23_3') }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

              </div>

              <div class="flex justify-between gap-2">
                <div class="input-group w-1/2 mb-4 relative">
                  <label for="XLEW_1_24_3" class="text-sm text-gray-600 mb-2 block">Width<span class="mandatory">*</span></label>
                  <input type="text" name="XLEW_1_24_3" id="XLEW_1_24_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                      placeholder="Width"
                      data-error-msg="Width is required."
                      value="{{ $data->width }}" readonly="readonly">
                      <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                      <span class="scrollForReq error-message"></span>
                      @error('XLEW_1_24_3')
                      <span class="php-error-message">{{ $errors->first('XLEW_1_24_3') }}</span>
                      @enderror
                <input id='XLEW_1_24_6' type='hidden' readonly='readonly' value='' name='XLEW_1_24_6'/>
              </div>

              <div class="input-group w-1/2 mb-4 relative">
                  <label for="XLEW_1_25_3" class="text-sm text-gray-600 mb-2 block">Depth<span class="mandatory">*</span></label>
                  <input type="text" name="XLEW_1_25_3" id="XLEW_1_25_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                      placeholder="Depth"
                      data-error-msg="Depth is required."
                      value="{{$data->depth}}" readonly="readonly">
                      <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                      <span class="scrollForReq error-message"></span>
                      @error('XLEW_1_25_3')
                      <span class="php-error-message">{{ $errors->first('XLEW_1_25_3') }}</span>
                      @enderror
                      <input id='XLEW_1_25_6' type='hidden' readonly='readonly' name='XLEW_1_25_6'/>
              </div>
             </div>

             <div class="input-group flex items-center w-1/2 lg:w-full justify-start my-4">
                <div class="flex items-center space-x-2 w-full">
                  <p class="text-[16px] text-gray-600 font-bold whitespace-nowrap">Foundation Check:</p>
                  <input
                    id="XLEW_1_26_3"
                    type="text"
                    readonly
                    value=""
                    name="XLEW_1_26_3"
                    class="flex-1 outline-none pointer-events-none text-[#ff0000] text-[16px] bg-transparent"
                  />
                </div>
              </div>
              
            @if(strcmp($data->wall_type,'raceway') != 0 || strcmp($data->wall_type,'cabinet') != 0 || strcmp($data->wall_type,'channel_letters') != 0 )
            <div class="mb-1 text-left">
               <h3 class="text-[1.3rem] font-bold text-gray-700">
                Augered Footing
               </h3>
           </div>
          @endif

            <div class="flex justify-between gap-2">
                <div class="input-group w-1/2 mb-4 relative">
                  <label for="XLEW_1_28_3" class="text-sm text-gray-600 mb-2 block">Diameter<span class="mandatory">*</span></label>
                  <input type="text" name="XLEW_1_28_3" id="XLEW_1_28_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                  placeholder="Diameter"
                  data-error-msg="Diameter is required."
                  value="{{ $data->drill_diameter }}"
                  onchange="this.value=eedisplayFloatNDV(eeparseFloatV(this.value),2);recalc_onclick('XLEW_1_28_3')">
                  <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                  <span class="scrollForReq error-message"></span>
                  @error('XLEW_1_28_3')
                  <span class="php-error-message">{{ $errors->first('XLEW_1_28_3') }}</span>
                  @enderror
          </div>

          <div class="input-group w-1/2 mb-4 relative">
              <label for="XLEW_1_29_3" class="text-sm text-gray-600 mb-2 block">Depth<span class="mandatory">*</span></label>
              <input type="text" name="XLEW_1_29_3" id="XLEW_1_29_3" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
              placeholder="Depth"
              data-error-msg="Depth is required."
              value="{{$data->drill_depth}}"
              readonly="readonly">
              <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
              <span class="scrollForReq error-message"></span>
              @error('XLEW_1_29_3')
              <span class="php-error-message">{{ $errors->first('XLEW_1_29_3') }}</span>
              @enderror
         </div>
        </div>
    </div>

        <table style="display:none;">
            <thead>
                <tr>
                    <th>Component</th>
                    <th>Structural Summary</th>
                    <th>Grade</th>
                </tr>
            </thead>
             <tbody>
                <tr>
                    <td>Post Size</td>
                    <td>
                        <input id="XLEW_1_31_3" type="text" readonly="readonly" value="n,n,n,n," name="XLEW_1_31_3" class="monument_input_tags"/>
                    </td>
                    <td>
                        <input id="XLEW_1_31_5" type="text" readonly="readonly" value="" name="XLEW_1_31_5" class="monument_input_tags"/>
                    </td>
                </tr>
                <tr>
                    <td>Post Burial Depth (ft)</td>
                    <td>
                        <input id="XLEW_1_32_3" type="text" readonly="readonly" value="0" name="XLEW_1_32_3" class="monument_input_tags"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Baseplate Size (in)</td>
                    <td>
                        <input id="XLEW_1_33_3" type="text" readonly="readonly" value="" name="XLEW_1_33_3" class="monument_input_tags"/>
                    </td>
                    <td>
                        <input id="XLEW_1_33_5" type="text" readonly="readonly" value="" name="XLEW_1_33_5" class="monument_input_tags"/>
                    </td>
                </tr>
                <tr>

                    <td>Anchor Size (in)</td>
                    <td>
                        <input id="XLEW_1_34_3" type="text" readonly="readonly" value="" name="XLEW_1_34_3" class="monument_input_tags"/>
                    </td>
                    <td>
                        <input id="XLEW_1_34_5" type="text" readonly="readonly" value="" name="XLEW_1_34_5" class="monument_input_tags"/>
                    </td>
                </tr>
                <tr>
                    <td>Anchor Embedment (in)</td>
                    <td>
                        <input id="XLEW_1_35_3" type="text" readonly="readonly" value="0" name="XLEW_1_35_3" class="monument_input_tags"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Augered Footing (ft)</td>
                    <td>
                        <input id="XLEW_1_36_3" type="text" readonly="readonly" value="" name="XLEW_1_36_3" class="monument_input_tags"/>
                    </td>
                    <td>
                        <input id="XLEW_1_36_5" type="text" readonly="readonly" value="" name="XLEW_1_36_5" class="monument_input_tags"/>
                    </td>
                </tr>
                <tr>
                    <td>Spread Footing (ft)</td>
                    <td>
                        <input id="XLEW_1_37_3" type="text" readonly="readonly" value="" name="XLEW_1_37_3" class="monument_input_tags"/>
                    </td>
                    <td>
                        <input id="XLEW_1_37_5" type="text" readonly="readonly" value="" name="XLEW_1_37_5" class="monument_input_tags"/>
                    </td>
                </tr>
                <tr>
                    <td>Spread Footing Rebar</td>
                    <td>
                        <input id="XLEW_1_38_3" type="text" readonly="readonly" value="" name="XLEW_1_38_3" class="monument_input_tags"/>
                    </td>
                    <td>60ksi Rebar</td>
                </tr>
              </tbody>
        </table>
        </div>

        <div class="w-full">
            <button type="submit" class="px-4 py-3 bg-gray-700 text-white text-base border-none rounded-md cursor-pointer transition duration-300 ease-in-out mt-4 mb-4 w-full uppercase">UPDATE</button>
        </div>

    </form>

    <!-- OUTPUT DATA START -->
    <!-- WALL TYPE RACEWAY -->
    @if(strcmp($data->wall_type,'raceway') == 0)
    @php
        $items = [
            ['WOOD SCREW¹', '#10'],
            ['TEK SCREW²', '#10'],
            ['LAG BOLT³', '3/8"'],
            ['THRU-BOLT⁴', '3/8"'],
            ['EXPANSION ANCHOR⁵', '3/8"'],
            ['CARBON STEEL SCREW ANCHOR⁶', '3/8"'],
            ['TOGGLE BOLT⁷', '3/8"'],
            ['ALUMINUM STUDS⁸', '1/4"'],
        ];
    @endphp

    @foreach($items as $index => $item)
        <div style="display:none;">
            <div>{{ $item[0] }}<sup>{{ $index + 1 }}</sup></div>
            <div>{{ $item[1] }}</div>
            @for($i = 4; $i <= 9; $i++)
                <div>
                    <textarea id="XLEW_3_{{ 18 + $index }}_{{ $i }}" class="ee151" disabled
                        onchange="recalc_onclick('XLEW_3_{{ 18 + $index }}_{{ $i }}')" 
                        name="XLEW_3_{{ 18 + $index }}_{{ $i }}" tabindex="-1">
                        {{ $i == 4 ? '0' : '""' }}
                    </textarea>
                </div>
            @endfor
        </div>
    @endforeach
@endif
    <!-- WALL TYPE CHANNEL LETTERS -->
         @if(in_array($data->wall_type, ['channel_letters']))
         @php
             $fasteners = [
                 ['WOOD SCREW¹', '#10'],
                 ['TEK SCREW²', '#10'],
                 ['LAG BOLT³', '3/8"'],
                 ['THRU-BOLT⁴', '3/8"'],
                 ['EXPANSION ANCHOR⁵', '3/8"'],
                 ['CARBON STEEL SCREW ANCHOR⁶', '3/8"'],
                 ['TOGGLE BOLT⁷', '3/8"'],
                 ['ALUMINUM STUDS⁸', '1/4"'],
             ];
         @endphp

         @foreach($fasteners as $index => [$name, $size])
             <div class="hidden">
                 <div>{{ $name }}<sup>{{ $index + 1 }}</sup></div>
                 <div>{{ $size }}</div>
                 @for($i = 4; $i <= 9; $i++)
                     <div>
                         <textarea id='XLEW_3_{{ $index + 18 }}_{{ $i }}' class='ee151' disabled
                             onchange="recalc_onclick('XLEW_3_{{ $index + 16 }}_{{ $i }}')"
                             name='XLEW_3_{{ $index + 16 }}_{{ $i }}' placeholder='' tabindex='-1'>{{ $i == 4 ? '0' : '""' }}</textarea>
                     </div>
                 @endfor
                 </div>
         @endforeach
     @endif

     
            <!-- WALL TYPE CABINET -->
                @if(in_array($data->wall_type, ['cabinet']))
                @php
                    $fasteners = [
                        ['WOOD SCREW¹', '#10'],
                        ['TEK SCREW²', '#10'],
                        ['LAG BOLT³', '3/8"'],
                        ['THRU-BOLT⁴', '3/8"'],
                        ['EXPANSION ANCHOR⁵', '3/8"'],
                        ['CARBON STEEL SCREW ANCHOR⁶', '3/8"'],
                        ['TOGGLE BOLT⁷', '3/8"'],
                        ['ALUMINUM STUDS⁸', '1/4"'],
                    ];
                @endphp

                @foreach($fasteners as $index => [$name, $size])
                    <div class="hidden">
                        <div>{{ $name }}<sup>{{ $index + 1 }}</sup></div>
                        <div>{{ $size }}</div>
                        @for($i = 4; $i <= 9; $i++)
                            <div>
                                <textarea id='XLEW_3_{{ $index + 18 }}_{{ $i }}' class='ee151' disabled
                                    onchange="recalc_onclick('XLEW_3_{{ $index + 16 }}_{{ $i }}')"
                                    name='XLEW_3_{{ $index + 16 }}_{{ $i }}' placeholder='' tabindex='-1'>{{ $i == 4 ? '0' : '""' }}</textarea>
                            </div>
                        @endfor
                        </div>
                @endforeach
            @endif
    <!-- OUTPUT DATA END -->

</div>
</div>
</div>
<script>
    $(document).ready(function () {

    // upload artwork image start
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

    $('#state, #city').select2();
    const citySelect = $('#city');
    const stateSelect = $('#state');
    const selectedState = stateSelect.val();
    const selectedCity = "{{ $data->city }}";
    function fetchCities(stateName, preselectedCity = '') {
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
                        citySelect.append(`<option value="${city}" ${preselectedCity === city ? 'selected' : ''}>${city}</option>`);
                    });
                }

                citySelect.select2();
            },
            error: function () {
                citySelect.prop('disabled', false).empty().append('<option>Error fetching cities</option>');
            }
        });
    }

    // Run on page load if a state is already selected
    if (selectedState) {
        fetchCities(selectedState, selectedCity);
    }

    // Fetch cities on state change
    $('body').on('change', '#state', function () {
        const stateName = $(this).val();
        if (stateName) {
            fetchCities(stateName);
        } else {
            citySelect.prop('disabled', true).empty().append('<option value="">Select City</option>');
        }
    });

    $('body').on('change', '#city', function () {
    const cityName = $(this).val();
    const stateName = $('#state').val();
    const windSpeedInput = $('#XLEW_3_3_7');
    const snowLoadInput = $('#XLEW_3_4_7');
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
                building_codeInput.val(response.stateData.building_code || '')
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

    checkWallType();


$("input[name='wall_type']").on('change', function () {
    var selectedWallType = $("input[name='wall_type']:checked").val();

    $("input[name='wall_type']").each(function () {
        $(this).next('label').removeClass("selected-wall");
    });

    $(this).next('label').addClass("selected-wall");

    checkWallType(selectedWallType);
});

    var wall_type = '{{$data->wall_type}}';
    function checkWallType(selectedWallType) {
        var datatypes = document.querySelector("input[name='wall_type']:checked")?.value;
        console.log('object',datatypes);
        $("input[name='wall_type']:checked").each(function () {
        $(this).next('label').addClass("selected-wall");
        });

        if (!datatypes) return;

        console.log('Wall Type Changed to:', selectedWallType);

        if (selectedWallType === 'double-post-full-height') {
            if (wall_type !== 'double-post-full-height') {
                $('#XLEW_1_9_3').val(2);  // Number of Posts
                console.log('XLEW_1_9_3 set to 2');
                $('#XLEW_1_7_3').val(0);  // Pole Cover Width

                 // blank values 
                $('#XLEW_1_3_3').val(''); //Total height 
                $('#XLEW_1_4_3').val(''); //Cabinet Height

                $('#XLEW_1_5_3').val('') //Cabinet Width
                $('#XLEW_1_6_3').val(''); //Cabinet Depth

                $('#XLEW_1_8_3').val(''); //Aprox Cabinet Weight


                $('#XLEW_1_18_3').val(''); //Quantity
                $('#adjustLengthDropdown').val('2.00'); //Adjust Length select
                $('#XLEW_1_23_3').val('2.00'); //Adjust Length


                
                $('#XLEW_1_24_3').val(''); //Width
                $('#XLEW_1_25_3').val(''); //Depth

                 
                $('#XLEW_1_28_3').val(''); //Drill Diameter
                $('#XLEW_1_29_3').val(''); //Drill Depth
                
            }
        }

        if (selectedWallType === 'single-post-full-height') {
            if (wall_type !== 'single-post-full-height') {
                $('#XLEW_1_9_3').val(1);
                console.log('XLEW_1_9_3 set to 1');
                $('#XLEW_1_10_3').val(1);
                console.log('XLEW_1_10_3 set to 1');
                $('#XLEW_1_7_3').val(0);

                 // blank values 
                $('#XLEW_1_3_3').val(''); //Total height 
                $('#XLEW_1_4_3').val(''); //Cabinet Height

                $('#XLEW_1_5_3').val('') //Cabinet Width
                $('#XLEW_1_6_3').val(''); //Cabinet Depth

                $('#XLEW_1_8_3').val(''); //Aprox Cabinet Weight


                $('#XLEW_1_18_3').val(''); //Quantity
                $('#adjustLengthDropdown').val('2.00'); //Adjust Length select
                $('#XLEW_1_23_3').val('2.00'); //Adjust Length


                
                $('#XLEW_1_24_3').val(''); //Width
                $('#XLEW_1_25_3').val(''); //Depth

                 
                $('#XLEW_1_28_3').val(''); //Drill Diameter
                $('#XLEW_1_29_3').val(''); //Drill Depth
            }
        }

        if (selectedWallType === 'double-post-with-cabinet') {
            if (wall_type !== 'double-post-with-cabinet') {
                $('#XLEW_1_9_3').val(2);
                console.log('XLEW_1_9_3 set to 2');
                $('#XLEW_1_7_3').val(0);

                 // blank values 
                $('#XLEW_1_3_3').val(''); //Total height 
                $('#XLEW_1_4_3').val(''); //Cabinet Height

                $('#XLEW_1_5_3').val('') //Cabinet Width
                $('#XLEW_1_6_3').val(''); //Cabinet Depth

                $('#XLEW_1_8_3').val(''); //Aprox Cabinet Weight


                $('#XLEW_1_18_3').val(''); //Quantity
                $('#adjustLengthDropdown').val('2.00'); //Adjust Length select
                $('#XLEW_1_23_3').val('2.00'); //Adjust Length


                
                $('#XLEW_1_24_3').val(''); //Width
                $('#XLEW_1_25_3').val(''); //Depth

                 
                $('#XLEW_1_28_3').val(''); //Drill Diameter
                $('#XLEW_1_29_3').val(''); //Drill Depth
            }
        }

        if (selectedWallType === 'single-post-with-cabinet') {
            if (wall_type !== 'single-post-with-cabinet') {
                $('#XLEW_1_9_3').val(1);
                console.log('XLEW_1_9_3 set to 1');
                $('#XLEW_1_10_3').val(1);
                console.log('XLEW_1_10_3 set to 1');
                $('#XLEW_1_7_3').val(0);


                // blank values 
                $('#XLEW_1_3_3').val(''); //Total height 
                $('#XLEW_1_4_3').val(''); //Cabinet Height

                $('#XLEW_1_5_3').val('') //Cabinet Width
                $('#XLEW_1_6_3').val(''); //Cabinet Depth

                $('#XLEW_1_8_3').val(''); //Aprox Cabinet Weight


                $('#XLEW_1_18_3').val(''); //Quantity
                $('#adjustLengthDropdown').val('2.00'); //Adjust Length select
                $('#XLEW_1_23_3').val('2.00'); //Adjust Length


                
                $('#XLEW_1_24_3').val(''); //Width
                $('#XLEW_1_25_3').val(''); //Depth

                 
                $('#XLEW_1_28_3').val(''); //Drill Diameter
                $('#XLEW_1_29_3').val(''); //Drill Depth
            }
        }

        if (selectedWallType === 'double-post-covered') {
            if (wall_type !== 'double-post-covered') {
                $('#XLEW_1_9_3').val(2);
                console.log('XLEW_1_9_3 set to 2');
                $('#XLEW_1_10_3').val('');
                console.log('XLEW_1_10_3 set to empty');
                $('#XLEW_1_7_3').val(0);


                // blank values 
                $('#XLEW_1_3_3').val(''); //Total height 
                $('#XLEW_1_4_3').val(''); //Cabinet Height

                $('#XLEW_1_5_3').val('') //Cabinet Width
                $('#XLEW_1_6_3').val(''); //Cabinet Depth

                $('#XLEW_1_8_3').val(''); //Aprox Cabinet Weight


                $('#XLEW_1_18_3').val(''); //Quantity
                $('#adjustLengthDropdown').val('2.00'); //Adjust Length select
                $('#XLEW_1_23_3').val('2.00'); //Adjust Length


                
                $('#XLEW_1_24_3').val(''); //Width
                $('#XLEW_1_25_3').val(''); //Depth

                 
                $('#XLEW_1_28_3').val(''); //Drill Diameter
                $('#XLEW_1_29_3').val(''); //Drill Depth
            }
        }

        if (selectedWallType === 'single-post-covered') {
            if (wall_type !== 'single-post-covered') {
                $('#XLEW_1_9_3').val(1);
                console.log('XLEW_1_9_3 set to 1');
                $('#XLEW_1_10_3').val(1);
                console.log('XLEW_1_10_3 set to 1');
                $('#XLEW_1_7_3').val(0);


               // blank values 
                $('#XLEW_1_3_3').val(''); //Total height 
                $('#XLEW_1_4_3').val(''); //Cabinet Height

                $('#XLEW_1_5_3').val('') //Cabinet Width
                $('#XLEW_1_6_3').val(''); //Cabinet Depth

                $('#XLEW_1_8_3').val(''); //Aprox Cabinet Weight


                $('#XLEW_1_18_3').val(''); //Quantity
                $('#adjustLengthDropdown').val('2.00'); //Adjust Length select
                $('#XLEW_1_23_3').val('2.00'); //Adjust Length


                
                $('#XLEW_1_24_3').val(''); //Width
                $('#XLEW_1_25_3').val(''); //Depth

                 
                $('#XLEW_1_28_3').val(''); //Drill Diameter
                $('#XLEW_1_29_3').val(''); //Drill Depth
            }
        }

        if (selectedWallType === 'post-and-panel') {
            if (wall_type !== 'post-and-panel') {
                $('#XLEW_1_9_3').val(1);
                console.log('XLEW_1_9_3 set to 1');

                var XLEW_1_5_3 = $('#XLEW_1_5_3').val();
                $('#XLEW_1_10_3').val(XLEW_1_5_3);
                console.log('XLEW_1_10_3 set to', XLEW_1_5_3);

                $('#XLEW_1_7_3').val(0);


                // blank values 
                $('#XLEW_1_3_3').val(''); //Total height 
                $('#XLEW_1_4_3').val(''); //Cabinet Height

                $('#XLEW_1_5_3').val('') //Cabinet Width
                $('#XLEW_1_6_3').val(''); //Cabinet Depth

                $('#XLEW_1_8_3').val(''); //Aprox Cabinet Weight


                $('#XLEW_1_18_3').val(''); //Quantity
                $('#adjustLengthDropdown').val('2.00'); //Adjust Length select
                $('#XLEW_1_23_3').val('2.00'); //Adjust Length


                
                $('#XLEW_1_24_3').val(''); //Width
                $('#XLEW_1_25_3').val(''); //Depth

                 
                $('#XLEW_1_28_3').val(''); //Drill Diameter
                $('#XLEW_1_29_3').val(''); //Drill Depth
            }
        }

        const monumentSigns = [
            'double-post-full-height', 'single-post-full-height', 'double-post-with-cabinet',
            'single-post-with-cabinet', 'post-and-panel', 'double-post-covered', 'single-post-covered'
        ];

        const rccSigns = ['raceway', 'channel-letters', 'cabinet'];

        document.querySelector('.rcc_inputs')?.classList.toggle('hidden', monumentSigns.includes(datatypes));
        document.querySelector('.monument_inputs')?.classList.toggle('hidden', !monumentSigns.includes(datatypes));


        if (rccSigns.includes(datatypes)) {
            const requiredFields = document.querySelectorAll('.monument_inputs .required_fields');
            requiredFields.forEach(field => field.classList.remove('required_fields'));


            const rccRequiredFields = document.querySelectorAll('.rcc_inputs .required_fields');
            rccRequiredFields.forEach(field => field.classList.add('required_fields'));

        }


        if (monumentSigns.includes(datatypes)) {
            const requiredFields = document.querySelectorAll('.rcc_inputs .required_fields');
            requiredFields.forEach(field => field.classList.remove('required_fields'));

            const monumentRequiredFields = document.querySelectorAll('.monument_inputs .required_fields');
            monumentRequiredFields.forEach(field => field.classList.add('required_fields'));
        }

        document.querySelectorAll('.wall_type_image .raceway_container').forEach(el => el.style.display = 'none');
        const selectedContainer = document.querySelector(`.wall_type_image .raceway_container[data-wall-type="${datatypes}"]`);
        if (selectedContainer) selectedContainer.style.display = 'block';

        const isCabinetOrChannel = datatypes === 'cabinet' || datatypes === 'channel-letters';
        const isRaceway = datatypes === 'raceway';

        document.querySelectorAll('.raceway_depth, .raceway_height').forEach(el => {
            el.classList.toggle('inactive', isCabinetOrChannel);
            el.classList.toggle('inactive', !isRaceway);
        });

        document.querySelectorAll('.approximate_weight, .sign_depth').forEach(el => {
            el.classList.toggle('active', isCabinetOrChannel);
            el.classList.toggle('active', !isRaceway);
        });

        loadScript(datatypes);
    }

function loadScript(datatypes) {
    console.log('datatypes', datatypes);
    const scriptMap = {
        'raceway': 'public/js/raceway.min.js',
        'channel-letters': 'public/js/channel-letters.min.js',
        'cabinet': 'public/js/cabinet.min.js',
        'double-post-full-height': 'public/js/monument-min.js',
        'single-post-full-height': 'public/js/monument-min.js',
        'double-post-with-cabinet': 'public/js/monument-min.js',
        'single-post-with-cabinet': 'public/js/monument-min.js',
        'post-and-panel': 'public/js/monument-min.js',
        'double-post-covered': 'public/js/monument-min.js',
        'single-post-covered': 'public/js/monument-min.js'
    };

    if (!scriptMap[datatypes]) return;
    const scriptSrc = "{{ asset('') }}" + scriptMap[datatypes];

    // Check if the script is already loaded
    if (document.querySelector(`script[src="${scriptSrc}"]`)) {
        console.log(`Script already loaded: ${scriptSrc}`);
        return;
    }

    console.log(`Loading script: ${scriptSrc}`);

    // Remove only the previous monument script if a new one is being loaded
    if (scriptMap[datatypes] === 'public/js/monument-min.js') {
        document.querySelectorAll('script[src*="monument-min.js"]').forEach(script => script.remove());
    }

    const script = document.createElement("script");
    script.src = scriptSrc;
    script.setAttribute("data-wall-script", "true");
    script.onload = () => console.log(`Script loaded: ${scriptSrc}`);
    script.onerror = () => console.error(`Failed to load script: ${scriptSrc}`);
    document.body.appendChild(script);
}

});

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
                console.log('firstErrorElement',$this);
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
$('.required_fields').on('input keypress blur', function (e) {
    let $input = $(this);
    let value = $input.val().trim();
    let charCode = e.which || e.keyCode;

    // Error Handling Logic
    let $inputGroup = $input.closest('.input-group');
    let errorMessage = $inputGroup.find('.error-message');
    let phpErrorMessage = $inputGroup.find('.php-error-message');
    let errorIcon = $inputGroup.find('.error');
    phpErrorMessage.remove();

    if (!value) {
        errorMessage.text($input.data("error-msg")).show();
        errorIcon.hide();
    } else {
        errorMessage.hide();
        errorIcon.hide();
    }

  // Number Field Validation
    if ($input.hasClass('number')) {
        if (e.type === "keypress") {
            if ((charCode < 48 || charCode > 57) && charCode !== 46) {
                e.preventDefault();
            }
            if (charCode === 46 && value.includes('.')) {
                e.preventDefault();
            }
        }
        if (e.type === "input") {
            let formattedValue = value.replace(/[^0-9.]/g, '');
            let decimalMatch = formattedValue.match(/^\d*\.?\d{0,2}/);
            if (decimalMatch) {
                formattedValue = decimalMatch[0];
            }
            $input.val(formattedValue);
        }
    }
 });
    function updateAdjustLength() {
        let dropdown = document.getElementById('adjustLengthDropdown');
        let inputField = document.getElementById('XLEW_1_23_3');

        if (inputField) {
            inputField.removeAttribute('readonly');
            inputField.value = dropdown.value;
            inputField.setAttribute('readonly', 'readonly');
        }
    }
    var postSize = "{{$data->post_size}}";
            $(document).ready(function () {
                setTimeout(() => {
                    var allValues = [];
                    $('#XLEW_1_15_3').find('option').each(function () {
                        var optionValue = $(this).val();
                        allValues.push(optionValue);

                        if (optionValue === postSize) {
                            $(this).prop('selected', true);
                        }
                    });
                    console.log(allValues);
                    $('#XLEW_1_15_3').trigger('change');
                }, 100);

                $('#XLEW_1_15_3').change(function () {
                    var selectedValue = $(this).val();
                    console.log('Selected Value (after change): ', selectedValue);
                });
    });

    $('#XLEW_1_3_3').on('input', function() {
    const value = $(this).val();
    $('#XLEW_1_4_3').val(value);
 });
 $('.item_container label').matchHeight();
</script>
@endsection