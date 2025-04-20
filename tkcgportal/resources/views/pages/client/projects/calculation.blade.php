@extends('layout.default')
@section('title', 'Create New Project Calculation')
@section('content')
@if(strcmp($wall_type,'raceway') == 0)
    <script>
        console.log('Raceway selected');
    </script>
    <script src="{{ asset('public/js/raceway.min.js') }}"></script>
@endif

@if(strcmp($wall_type,'channel_letters') == 0)
    <script>
        console.log('Channel Letters selected');
    </script>
    <script src="{{ asset('public/js/channel-letters.min.js') }}"></script>
@endif

@if(strcmp($wall_type,'cabinet') == 0)
    <script>
        console.log('Cabinet selected');
    </script>
    <script src="{{ asset('public/js/cabinet.min.js') }}"></script>
@endif

@if(strcmp($wall_type, 'double-post-full-height') == 0)
    <script>
        console.log('Double Post Full Height selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($wall_type, 'single-post-full-height') == 0)
    <script>
        console.log('Single Post Full Height selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($wall_type, 'double-post-with-cabinet') == 0)
    <script>
        console.log('Double Post with Cabinet selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($wall_type, 'single-post-with-cabinet') == 0)
    <script>
        console.log('Single Post with Cabinet selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($wall_type, 'post-and-panel') == 0)
    <script>
        console.log('Post and Panel selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($wall_type, 'double-post-covered') == 0)
    <script>
        console.log('Double Post Covered selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($wall_type, 'single-post-covered') == 0)
    <script>
        console.log('Single Post Covered selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

<style>
.php-error-message{ color: #dc2626; font-size: 0.875rem; text-align: center; margin-top: 1rem; }
</style>

    <div class="fixed top-0 left-0 z-10 flex items-center justify-center hidden w-full h-screen">
        <img src="{{asset('public/images/rounded_loader.svg')}}" alt="loader gif" class="w-20 h-20">
    </div>

    @php
    $flexWallTypes = [
        'double-post-full-height',
        'single-post-full-height',
        'double-post-with-cabinet',
        'single-post-with-cabinet',
        'post-and-panel',
        'double-post-covered',
        'single-post-covered'
    ];
   @endphp
    <div class="w-full">
        <div class="w-full max-w-[800px]">
            <div class="flex justify-between items-center mt-[60px] pb-[20px]">
                <div class="list-header">
                    <div class="flex items-center justify-start">
                        <a href="{{ route('client.project.add', [
                            'ArtworkImageId' => request()->get('ArtworkImageId'),
                            'name' => request()->get('name'),
                            'state' => request()->get('state'),
                            'city' => request()->get('city'),
                            'street_name' => request()->get('street_name'),
                            'wall_type' => request()->get('wall_type')
                        ]) }}" class="p-1"><img src="{{asset('public/images/arrow.svg')}}" alt="Back Button" class="w-[20px]"></a>
                        <h2 class="font-normal text-2xl">Project Calculation</h2>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-white rounded-md">
                <div class="wall_type_image py-[15px] px-0">
                    @php
                    $wallTypes = [
                        'raceway' => 'public/images/raceway/raceway-drawing-pdf.png',
                        'cabinet' => 'public/images/cabinet/cabinet-drawing-pdf.png',
                        'channel_letters' => 'public/images/channel-letters/channel-letters-pdf.png',
                        'double-post-full-height'=> 'public/images/monument-pylon-sign/double-post-full-height/double-post-full-height01.png',
                        'single-post-full-height' => 'public/images/monument-pylon-sign/single-post-full-height/single-post-full-height.png',
                        'double-post-with-cabinet '=> 'public/images/monument-pylon-sign/double-post-with-cabinet/double-post-with-cabinet.png',
                        'single-post-with-cabinet '=> 'public/images/monument-pylon-sign/single-post-with-cabinet/single-post-with-cabinet.png',
                        'post-and-panel'=> 'public/images/monument-pylon-sign/post-and-panel/post-and-panel.png',
                        'double-post-covered' => 'public/images/monument-pylon-sign/double-post-covered/double-post-covered.png',
                        'single-post-covered' => 'public/images/monument-pylon-sign/single-post-covered/single-post-covered.png',
                    ];
                @endphp

            @if(array_key_exists($wall_type, $wallTypes))
            <div class="raceway_container">
                <div class="item_container flex flex-col items-center mb-5 w-[70%] h-auto p-0">
                    <div class="text-center w-full h-full flex justify-between relative !flex-row">
                        <div class="wall_type_choice cursor-default inline-block w-full text-black border border-gray-200 p-2 box-border">
                            <div class="pt-0 relative">
                                <a href="{{ asset($wallTypes[$wall_type]) }}"
                                   data-fancybox="editgallery"
                                   class="relative block transition duration-300 ease-in-out group">
                                    <img src="{{ asset($wallTypes[$wall_type]) }}" alt="{{ ucfirst($wall_type) }}"
                                         class="relative h-auto object-contain left-0 right-0 bottom-0 top-0 m-auto max-h-full w-full">
                                    <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[35px] block opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">
                                        <svg fill="#000000" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M31.707 30.282l-8.845-8.899c1.894-2.262 3.034-5.18 3.034-8.366 0-7.189-5.797-13.018-12.986-13.018s-13.017 5.828-13.017 13.017 5.828 13.017 13.017 13.017c3.282 0 6.271-1.218 8.553-3.221l8.829 8.884c0.39 0.39 1.024 0.39 1.414 0s0.391-1.024 0-1.415zM12.893 24c-6.048 0-11-4.951-11-11s4.952-11 11-11c6.048 0 11 4.952 11 11s-4.951 11-11 11zM17.893 12h-4v-4c0-0.552-0.448-1-1-1s-1 0.448-1 1v4h-4c-0.552 0-1 0.448-1 1s0.448 1 1 1h4v4c0 0.552 0.448 1 1 1s1-0.448 1-1v-4h4c0.552 0 1-0.448 1-1s-0.448-1-1-1z"></path>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            </div>

            <form action="{{route('client.project.calculation.post')}}" method="post" class="flex flex-col"
             onsubmit="return checkForm();">
                @csrf
                <input type="hidden" id="ArtworkImageId" name="ArtworkImageId" value="{{ request()->get('ArtworkImageId') }}">
                <input type="hidden" id="name" name="name" value="{{ request()->get('name') }}">
                <input type="hidden" id="state" name="state" value="{{ request()->get('state') }}">
                <input type="hidden" id="city" name="city" value="{{ request()->get('city') }}">
                <input type="hidden" id="street_name" name="street_name" value="{{ request()->get('street_name') }}">
                <input type="hidden" id="wall_type" name="wall_type" value="{{ request()->get('wall_type') }}">
                <!-- Basic Information Section -->
                <div class="basic-information">
                    @if(strcmp($wall_type,'raceway') == 0 || strcmp($wall_type,'cabinet') == 0 || strcmp($wall_type,'channel_letters') == 0 )
                    <div class="mb-6 text-left">
                        <h3 class="text-[1.3rem] font-bold text-gray-700">
                            Basic Information
                        </h3>
                    </div>
                    @else
                     <div class="mb-1 text-left">
                        <h3 class="text-[1.3rem] font-bold text-gray-700">
                            Sign Geometry
                        </h3>
                    </div>
                   @endif
                    @if(strcmp($wall_type,'raceway') ==0 ||  strcmp($wall_type,'channel_letters') || strcmp($wall_type,'cabinet'))
                    <div class="flex justify-between gap-2 hidden">
                      <!-- Sign Type -->
                      <div class="input-group w-full mb-4">
                        <fieldset id="FS1$XLEW_3_3_4" class="border-none">
                                <select name="XLEW_3_3_4" id="XLEW_3_3_4" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" data-error-msg="Sign type is required." onchange="recalc_onclick('XLEW_3_3_4')" >
                                    <option value="raceway" data-value="s:Raceway"
                                        <?= ($wall_type === 'raceway') ? 'selected' : '' ?>>Raceway
                                    </option>

                                    <option value="monument" data-value="s:Monument"
                                        <?= ($wall_type === 'monument') ? 'selected' : '' ?>>Monument
                                    </option>

                                    <option value="solid_freestanding" data-value="s:Solid Freestanding"
                                        <?= ($wall_type === 'solid_freestanding') ? 'selected' : '' ?>>Solid Freestanding
                                    </option>

                                    <option value="channel_letters" data-value="s:Channel Letters"
                                        <?= ($wall_type === 'channel_letters') ? 'selected' : '' ?>>Channel Letters
                                    </option>

                                    <option value="solid_cantilevered" data-value="s:Solid Cantilevered"
                                        <?= ($wall_type === 'solid_cantilevered') ? 'selected' : '' ?>>Solid Cantilevered
                                    </option>

                                    <option value="solid_attached_roof" data-value="s:Solid Attached to Roof"
                                        <?= ($wall_type === 'solid_attached_roof') ? 'selected' : '' ?>>Solid Attached to Roof
                                    </option>

                                    <option value="solid_attached_wall" data-value="s:Solid Attached to Wall"
                                        <?= ($wall_type === 'cabinet') ? 'selected' : '' ?>>Solid Attached to Wall
                                    </option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    @endif

                    @if($wall_type == 'cabinet' || $wall_type == 'raceway' ||  $wall_type == 'channel_letters')
                    <div class="flex justify-between gap-2">
                        <!-- A - Sign Height (ft) -->
                         <div class="input-group w-1/2 mb-4">
                            @php
                            $signHeight = request('sign_height') ? request('sign_height') : old('sign_height');
                            $inputId = '';
                            if (strcmp($wall_type, 'raceway') == 0) {
                                $inputId = 'XLEW_3_4_4';
                            }
                            if (strcmp($wall_type, 'channel_letters') == 0) {
                                $inputId = 'XLEW_3_4_4';
                            }
                            if(strcmp($wall_type, 'cabinet') == 0){
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
                            $signLength = request('sign_length') ? request('sign_length') : old('sign_length');
                            $inputId = '';
                            if (strcmp($wall_type, 'raceway') == 0) {
                                $inputId = 'XLEW_3_5_4';
                            }
                            if (strcmp($wall_type, 'channel_letters') == 0) {
                                $inputId = 'XLEW_3_5_4';
                            }
                            if(strcmp($wall_type, 'cabinet') == 0){
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
                    @endif

                    <div class="flex justify-between gap-2">
                     @if($wall_type == 'cabinet' || $wall_type == 'raceway' ||  $wall_type == 'channel_letters')
                        <!-- B - Sign Depth (ft) -->
                        <div class="input-group w-1/2 mb-4"
                        @if($wall_type === 'channel_letters' || $wall_type === 'cabinet')
                            style="width: 100%;"
                        @elseif($wall_type === 'raceway')
                            style="width: 50%;"
                        @else
                            style="width: 50%;"
                        @endif>

                            @php
                            $signDepth = request('sign_depth') ? request('sign_depth') : old('sign_depth');
                            $inputId = '';
                            if (strcmp($wall_type, 'raceway') == 0) {
                                $inputId = 'XLEW_3_6_4';
                            }
                            if (strcmp($wall_type, 'channel_letters') == 0) {
                                $inputId = 'XLEW_3_6_4';
                            }
                            if(strcmp($wall_type, 'cabinet') == 0){
                                $inputId = 'XLEW_3_6_4';
                            }
                            @endphp
                            <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Sign Depth<span class="mandatory">*</span></label>
                            <input type="text" name="sign_depth" id="{{$inputId}}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                                placeholder="Sign Depth" data-error-msg="Sign depth is required."
                                value="{{$signDepth}}" onchange="this.value=eedisplayFloatND(eeparseFloat(this.value),2);recalc_onclick('{{ $inputId }}')" />
                                <span class="scrollForReq error-message"></span>
                                @error('sign_depth')
                                <span class="php-error-message">{{ $errors->first('sign_depth') }}</span>
                                @enderror
                        </div>
                        @endif

                    @if (strcmp($wall_type, 'raceway') == 0)
                    <!-- Block Depth -->
                    <div class="input-group w-1/2 mb-4">
                        @php
                        $blockDepth = request('block_depth') ? request('block_depth') : old('block_depth');
                        $inputId = '';
                        if (strcmp($wall_type, 'raceway') == 0) {
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
                    @endif
                    </div>

                    <div class="flex justify-between gap-2">
                    @if (strcmp($wall_type, 'raceway') == 0)
                      <!-- Block Height -->
                      <div class="input-group w-1/2 mb-4">
                        @php
                        $blockHeight = request('block_height') ? request('block_height') : old('block_height');
                        $inputId = '';
                        if (strcmp($wall_type, 'raceway') == 0) {
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
                    @endif
                    @if(strcmp($wall_type, 'raceway') == 0 || strcmp($wall_type, 'channel_letters') == 0 || strcmp($wall_type, 'cabinet') == 0)
                    @php
                        $weight = request('weight') ? request('weight') : old('weight');
                        $inputId = '';

                        if (strcmp($wall_type, 'raceway') == 0) {
                            $inputId = 'XLEW_3_9_4';
                        }
                        if (strcmp($wall_type, 'channel_letters') == 0) {
                            $inputId = 'XLEW_3_7_4';
                        }
                        if(strcmp($wall_type, 'cabinet') == 0){
                            $inputId = 'XLEW_3_7_4';
                        }
                    @endphp
                        <div class="input-group w-1/2 mb-4"
                          @if($wall_type === 'channel_letters' || $wall_type === 'cabinet')
                              style="width: 100%;"
                          @elseif($wall_type === 'raceway')
                              style="width: 50%;"
                          @else
                              style="width: 50%;"
                          @endif>
                        <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Approximate Weight<span class="mandatory">*</span></label>
                        <input type="text" name="weight" id="{{$inputId}}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                            placeholder="Approximate Weight" data-error-msg="Approximate weight is required"
                         value="{{$weight}}" readonly/>
                        <span class="scrollForReq error-message"></span>
                        @error('weight')
                        <span class="php-error-message">{{ $errors->first('weight') }}</span>
                        @enderror
                    </div>
                   @endif
                    </div>

                    <div class="flex">
                        @if(strcmp($wall_type, 'raceway') == 0 || strcmp($wall_type, 'channel_letters') == 0 || strcmp($wall_type, 'cabinet') == 0)
                        @php
                        $sign_installation_height = request('sign_installation_height') ? request('sign_installation_height') : old('sign_installation_height');
                        $inputId = '';

                        if (strcmp($wall_type, 'raceway') == 0) {
                            $inputId = 'XLEW_3_10_4';
                        }
                        if (strcmp($wall_type, 'channel_letters') == 0) {
                            $inputId = 'XLEW_3_8_4';
                        }
                        if(strcmp($wall_type, 'cabinet') == 0){
                            $inputId = 'XLEW_3_8_4';
                        }
                       @endphp
                           <div class="input-group w-full mb-4">
                               <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Installation Height<span class="mandatory">*</span></label>
                               <input type="text" name="sign_installation_height" id="{{$inputId}}"
                                   class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number" placeholder="Installation Height"
                                   data-error-msg="Installation height is required." value="" onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('{{$inputId}}')">
                                   <span class="scrollForReq error-message"></span>
                                   @error('sign_installation_height')
                                   <span class="php-error-message">{{ $errors->first('sign_installation_height') }}</span>
                                   @enderror
                           </div>
                       @endif
                     </div>

                     @if(strcmp($wall_type, 'raceway') == 0 || strcmp($wall_type, 'channel_letters') == 0 || strcmp($wall_type, 'cabinet') == 0)
                     <div class="flex justify-between gap-2">
                            <div class="input-group w-1/2 mb-4">
                             @php
                                $windSpeed = request('wind_speed') ? request('wind_speed') : old('wind_speed');
                                $inputId = '';
                                if (strcmp($wall_type, 'raceway') == 0) {
                                    $inputId = 'XLEW_3_3_7';
                                }
                                if (strcmp($wall_type, 'channel_letters') == 0) {
                                    $inputId = 'XLEW_3_3_7';
                                }
                                if(strcmp($wall_type, 'cabinet') == 0){
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
                                $snowLoad = request('snow_load') ? request('snow_load') : old('snow_load');
                                $inputId = '';
                                if (strcmp($wall_type, 'raceway') == 0) {
                                    $inputId = 'XLEW_3_4_7';
                                }
                                if (strcmp($wall_type, 'channel_letters') == 0) {
                                    $inputId = 'XLEW_3_4_7';
                                }
                                if(strcmp($wall_type, 'cabinet') == 0){
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
                    @endif

                    @if(strcmp($wall_type, 'raceway') == 0 || strcmp($wall_type, 'channel_letters') == 0 || strcmp($wall_type, 'cabinet') == 0)
                    <div class="input-group w-full mb-4">
                     @php
                        $iceLoad = request('ice') ? request('ice') : old('ice');
                     @endphp
                        <label for="ice" class="text-sm text-gray-600 mb-2 block">Ice Load<span class="mandatory">*</span></label>
                        <input type="text" name="ice" id="ice"
                            class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number" placeholder="Ice Load"
                            data-error-msg="Ice load is required." value="{{$iceLoad}}">
                            <span class="scrollForReq error-message"></span>
                            @error('ice')
                             <span class="php-error-message">{{ $errors->first('ice') }}</span>
                            @enderror
                    </div>
                    @endif

                    @if(strcmp($wall_type, 'raceway') == 0 || strcmp($wall_type, 'channel_letters') == 0 || strcmp($wall_type, 'cabinet') == 0)
                    <div class="flex justify-between gap-2">
                        <div class="input-group w-1/2 mb-4">
                            @php
                               $building_code = request('building_code') ? request('building_code') : old('building_code');
                            @endphp
                               <label for="building_code" class="text-sm text-gray-600 mb-2 block">Building Code<span class="mandatory">*</span></label>
                               <input type="text" name="building_code" id="building_code"
                                   class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" placeholder="Building Code"
                                   data-error-msg="Building code is required." value="{{$building_code}}">
                                   <span class="scrollForReq error-message"></span>
                                   @error('building_code')
                                   <span class="php-error-message">{{ $errors->first('building_code') }}</span>
                                  @enderror
                           </div>

                           <div class="input-group w-1/2 mb-4">
                            @php
                               $ASCE_code = request('ASCE_code') ? request('ASCE_code') : old('ASCE_code');
                            @endphp
                               <label for="ASCE_code" class="text-sm text-gray-600 mb-2 block">ASCE Code<span class="mandatory">*</span></label>
                               <input type="text" name="ASCE_code" id="ASCE_code"
                                   class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" placeholder="ASCE Code"
                                   data-error-msg="Asce Code is required." value="{{$ASCE_code}}">
                                   <span class="scrollForReq error-message"></span>
                                   @error('ASCE_code')
                                   <span class="php-error-message">{{ $errors->first('ASCE_code') }}</span>
                                  @enderror
                           </div>

                    </div>
                    @endif

                     @if(strcmp($wall_type, 'raceway') == 0 || strcmp($wall_type, 'channel_letters') == 0 || strcmp($wall_type, 'cabinet') == 0)
                     <div class="flex justify-between gap-2 hidden">
                        <!-- EXPOSURE CATE MISSING-->
                        <div class="input-group w-1/2 mb-4">
                            @php
                            $inputId = '';
                            if (strcmp($wall_type, 'raceway') == 0) {
                                $inputId = 'XLEW_3_5_7';
                            }
                            if (strcmp($wall_type, 'channel_letters') == 0) {
                                $inputId = 'XLEW_3_5_7';
                            }
                            if(strcmp($wall_type, 'cabinet') == 0){
                                $inputId = 'XLEW_3_5_7';
                            }
                            @endphp
                            <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">EXPOSURE CATE</label>
                            <fieldset id="FS1$XLEW_3_5_7" class="border-none">
                                <select name="{{$inputId}}" id="{{$inputId}}" class="py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none bg-gray-300" onchange="recalc_onclick('{{$inputId}}')">
                                    <option value="B" data-value="s:B" disabled>B</option>
                                    <option value="C" data-value="s:C" selected>C</option>
                                    <option value="D" data-value="s:D" disabled>D</option>
                                </select>
                            </fieldset>
                        </div>

                        <div class="input-group w-1/2 mb-4">
                            @php
                            $RISKCATEGORY = request('XLEW_3_6_7') ? request('XLEW_3_6_7') : old('XLEW_3_6_7');
                            $inputId = '';
                            if (strcmp($wall_type, 'raceway') == 0) {
                                $inputId = 'XLEW_3_6_7';
                            }
                            if (strcmp($wall_type, 'channel_letters') == 0) {
                                $inputId = 'XLEW_3_6_7';
                            }
                            if(strcmp($wall_type, 'cabinet') == 0){
                                $inputId = 'XLEW_3_6_7';
                            }
                            @endphp
                            <label for="XLEW_3_6_7" class="text-sm text-gray-600 mb-2 block">RISK CATEGORY</label>
                            <fieldset id="FS1$XLEW_3_6_7" class="border-none">
                                <select name="{{$inputId}}" id="{{$inputId}}" class="py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none bg-gray-300" onchange="recalc_onclick('{{$inputId}}')">
                                    <option value="I" data-value="s:I" disabled>I</option>
                                        <option value="II"  data-value="s:II" selected>II</option>
                                        <option value="III" data-value="s:III" disabled>III</option>
                                        <option value="IV" data-value="s:IV" disabled>IV</option>
                                </select>
                            </fieldset>
                        </div>
                        </div>
                       @endif

                       <div class="flex justify-between gap-2 hidden">
                        <div class="input-group w-1/2 mb-4">
                            @php
                            $inputId = '';
                            if (strcmp($wall_type, 'raceway') == 0) {
                                $inputId = 'XLEW_3_15_4';
                            }
                            if (strcmp($wall_type, 'channel_letters') == 0) {
                                $inputId = 'XLEW_3_15_4';
                            }
                            if(strcmp($wall_type, 'cabinet') == 0){
                                $inputId = 'XLEW_3_15_4';
                            }
                            @endphp
                            <textarea id='{{$inputId}}' disabled
                            onchange="recalc_onclick('{{$inputId}}')" onKeyDown="" name='{{$inputId}}'>""</textarea>
                        </div>
                    </div>

                @if($wall_type == 'double-post-full-height' ||
                $wall_type == 'single-post-full-height' ||
                $wall_type == 'double-post-with-cabinet' ||
                $wall_type == 'single-post-with-cabinet' ||
                $wall_type == 'post-and-panel' ||
                $wall_type == 'double-post-covered' ||
                $wall_type == 'single-post-covered')

                <div class="flex justify-between gap-2">
                   @php
                    $totalHeight = request('XLEW_1_3_3') ?? old('XLEW_1_3_3');
                    $inputId = 'XLEW_1_3_3';
                    @endphp
                    <div class="input-group w-1/2 mb-4 relative">
                        <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Total Height<span class="mandatory">*</span></label>
                        <input type="text" name="XLEW_1_3_3" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                            placeholder="Total Height"
                            data-error-msg="Total height is required."
                            value="{{ $totalHeight }}"
                            onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('{{$inputId}}')">
                        <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                        <span class="scrollForReq error-message"></span>
                        @error('XLEW_1_3_3')
                            <span class="php-error-message">{{ $errors->first('XLEW_1_3_3') }}</span>
                        @enderror
                    </div>

                    <div class="input-group w-1/2 mb-4 hidden">
                        @php
                            $ultimateWindSpeed = 115;
                            $inputId = 'XLEW_1_3_8';
                        @endphp
                        <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Ultimate Wind Speed</label>
                        <input type="text" name="XLEW_1_3_8" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none   number"
                            placeholder="Ultimate Wind Speed"
                            value="{{$ultimateWindSpeed}}"
                            onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('{{$inputId}}')">
                    </div>

                    <div class="input-group w-1/2 mb-4 relative">
                        @php
                        $inputId = 'XLEW_1_4_3';
                        @endphp
                        <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Cabinet Height<span class="mandatory">*</span></label>
                        <input type="text" name="XLEW_1_4_3" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                            placeholder="Cabinet Height"
                            data-error-msg="Cabinet height is required."
                            value="{{ $totalHeight }}"
                            onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('{{ $inputId }}')" readonly="readonly">
                        <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                        <span class="scrollForReq error-message"></span>
                        @error('XLEW_1_4_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_4_3') }}</span>
                        @enderror
                    </div>

                    <div class="input-group w-1/2 mb-4 hidden">
                        @php
                            $snowLoad = 40;
                            $inputId = 'XLEW_1_4_8';
                        @endphp
                        <label for="{{ $inputId }}">Snow Load</label>
                        <input type="text" name="XLEW_1_4_8" id="{{ $inputId }}" class="number"
                        placeholder="Snow load"
                        value="{{$snowLoad}}"
                        onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('{{$inputId}}')">
                    </div>
                </div>

                   <div class="flex justify-between gap-2">
                        <div class="input-group w-1/2 mb-4 relative">
                            @php
                                $cabinetWidth = request('XLEW_1_5_3') ?? old('XLEW_1_5_3');
                                $inputId = 'XLEW_1_5_3';
                            @endphp
                            <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Cabinet Width<span class="mandatory">*</span></label>
                            <input type="text" name="XLEW_1_5_3" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                                placeholder="Cabinet Width"
                                data-error-msg="Cabinet width is required."
                                value="{{ $cabinetWidth }}"
                                onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('{{ $inputId }}')">
                                <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                            <span class="scrollForReq error-message"></span>
                            @error('XLEW_1_5_3')
                            <span class="php-error-message">{{ $errors->first('XLEW_1_5_3') }}</span>
                            @enderror
                        </div>

                         <div class="input-group w-1/2 mb-4 hidden">
                            @php
                              $iceThickness = 1;
                              $inputId = 'XLEW_1_5_8';
                            @endphp
                            <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Ice Thickness</label>
                            <input type="text" name="XLEW_1_5_8" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number"
                            placeholder="Ice Thickness"
                            value="{{$iceThickness}}"
                            onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('{{$inputId}}')">
                        </div>

                        <div class="input-group w-1/2 mb-4 relative">
                            @php
                            $cabinetDepth = old('XLEW_1_6_3', request()->get('XLEW_1_6_3', 1));
                            $inputId = 'XLEW_1_6_3';
                            @endphp
                            <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Cabinet Depth<span class="mandatory">*</span></label>
                            <input type="text" name="XLEW_1_6_3" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                                placeholder="Cabinet Depth"
                                data-error-msg="Cabinet depth is required."
                                value="{{ $cabinetDepth }}"
                                onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('{{ $inputId }}')">
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

                    $poleCoverWidth = $poleCoverWidths[$wall_type] ?? 0;

                    $poleCoverWidth = old('XLEW_1_7_3', request()->get('XLEW_1_7_3', $poleCoverWidth));
                    $inputId  = 'XLEW_1_7_3';
                    @endphp

                    <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Pole Cover Width</label>
                    <input type="text" name="XLEW_1_7_3" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number"
                    placeholder="Pole Cover Width"
                    value="{{ $poleCoverWidth }}"
                    onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('{{ $inputId }}')">
                    </div>

                    <div class="input-group w-full mb-4 hidden">
                        <label for="XLEW_1_7_8" class="text-sm text-gray-600 mb-2 block">Risk Category</label>
                        <fieldset id="FS1$XLEW_1_7_8" class="border-none">
                            <select name="XLEW_1_7_8" id="XLEW_1_7_8" class="py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none bg-gray-300" onchange="recalc_onclick('XLEW_1_7_8')">
                                <option  data-value='s:I' selected>I</option>
                                <option  data-value='s:II' selected>II</option>
                                <option  data-value='s:III'>III</option>
                                <option  data-value='s:IV'>IV</option>
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

                        $postSpacing = $postSpacingMap[$wall_type] ?? null;

                        $postSpacing = old('XLEW_1_10_3', request()->get('XLEW_1_10_3', $postSpacing));

                        $inputId = 'XLEW_1_10_3';
                        @endphp

                        <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Post Spacing<span class="mandatory">*</span></label>
                        <input type="text" name="XLEW_1_10_3" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                            placeholder="Post Spacing"
                            data-error-msg="Post spacing is required."
                            value="{{ $postSpacing }}"
                            onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('{{$inputId}}')">
                            <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                        <span class="scrollForReq error-message"></span>
                        @error('XLEW_1_10_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_10_3') }}</span>
                        @enderror
                   </div>
                   <div class="input-group w-1/2 mb-4">
                    @php
                    $numberOfPosts = 2;
                    if ($wall_type == 'double-post-with-cabinet') {
                        $numberOfPosts = 2;
                    }
                    if ($wall_type == 'single-post-full-height') {
                        $numberOfPosts = 1;
                    }

                    if ($wall_type == 'double-post-full-height') {
                        $numberOfPosts = 2;
                    }

                    if ($wall_type == 'single-post-with-cabinet') {
                        $numberOfPosts = 1;
                    }

                    if ($wall_type == 'double-post-covered') {
                        $numberOfPosts = 2;
                    }

                    if ($wall_type == 'single-post-covered') {
                        $numberOfPosts = 1;
                    }

                    if ($wall_type == 'post-and-panel') {
                        $numberOfPosts = 2;
                    }
                    $numberOfPosts = old('XLEW_1_9_3', request()->get('XLEW_1_9_3', $numberOfPosts));
                    @endphp
                        <label for="XLEW_1_9_3" class="text-sm text-gray-600 mb-2 block">Number of Posts<span class="mandatory">*</span></label>
                        <fieldset id="FS1$XLEW_1_9_3" class="border-none">
                            <select name="XLEW_1_9_3" id="XLEW_1_9_3" class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300" onchange="recalc_onclick('XLEW_1_9_3')">
                                <option value="1" data-value='n:1' {{ $numberOfPosts == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" data-value='n:2' {{ $numberOfPosts == 2 ? 'selected' : '' }}>2</option>
                            </select>
                        </fieldset>
                    </div>
                </div>

                <div class="input-group w-1/2 mb-4 hidden">
                    <label for="XLEW_1_11_3" class="text-sm text-gray-600 mb-2 block">Sign Face</label>
                    <fieldset id="FS1$XLEW_1_11_3" class="border-none">
                        <select name="XLEW_1_11_3" id="XLEW_1_11_3" class="py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none bg-gray-300" onchange="recalc_onclick('XLEW_1_11_3')">
                            <option  data-value='s:Double Faced' selected>Double Faced</option>
                            <option  data-value='s:Single Faced'>Single Faced</option>
                        </select>
                    </fieldset>
                  </div>

                  <div class="input-group w-1/2 mb-4 hidden">
                        @php
                            $OpenAreaPercentage = '0%';
                            $inputId = 'XLEW_1_12_3';
                        @endphp
                        <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Open Area Percentage</label>
                        <input type="text" name="XLEW_1_12_3" id="{{$inputId}}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none number"
                            placeholder="Open Area Percentage"
                            value="{{ $OpenAreaPercentage }}"
                            onchange="this.value=eedisplayPercentND(eeparsePercent(this.value),0);recalc_onclick('XLEW_1_12_3')">
                    </div>

                    <div class="flex justify-between gap-2">
                        <div class="input-group w-1/2 mb-4">
                        @php
                            $postShape = old('XLEW_1_14_3', request()->get('XLEW_1_14_3', 'Square'));
                        @endphp
                        <label for="XLEW_1_14_3" class="text-sm text-gray-600 mb-2 block">Post Shape<span class="mandatory">*</span></label>
                        <fieldset id="FS1$XLEW_1_14_3" class="border-none">
                            <select name="XLEW_1_14_3" id="XLEW_1_14_3" class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields"
                                data-error-msg="Post shape is required." onchange="recalc_onclick('XLEW_1_14_3')">
                                <option data-value="s:Square" {{ $postShape == 'Square' ? 'selected' : '' }}>Square</option>
                                <option data-value="s:Round" {{ $postShape == 'Round' ? 'selected' : '' }}>Round</option>
                                <option data-value="s:Rect" {{ $postShape == 'Rect' ? 'selected' : '' }}>Rect</option>
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
                                <select name="XLEW_1_15_3" id="XLEW_1_15_3" class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" data-error-msg="Post shape is required." onchange="recalc_onclick('XLEW_1_15_3')">
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
                                <option  data-value='s:A500 Grade B, Round' selected >A500 Grade B, Round</option>
                                <option  data-value='s:A500 Grade B, Square' >A500 Grade B, Square</option>
                                <option  data-value='s:A36' >A36</option>
                                <option  data-value='s:3003-H14' >3003-H14</option>
                                <option  data-value='s:6061-T6' >6061-T6</option>
                                <option  data-value='s:6063-T5' >6063-T5</option>
                                <option  data-value='s:6063-T6' >6063-T6</option>
                                <option  data-value='s:6061- T6 W' >6061- T6 W</option>
                            </select>
                        </fieldset>
                        <span class="scrollForReq error-message"></span>
                        @error('Grade')
                        <span class="php-error-message">{{$errors->first('Grade')}}</span>
                        @enderror
                        </div>
                        <div class="input-group w-1/2 mb-4">
                        @php
                            $aproxCabinetWeight = 0;
                            $inputId = 'XLEW_1_8_3';
                        @endphp
                        <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Aprox Cabinet Weight<span class="mandatory">*</span></label>
                        <input type="text" name="XLEW_1_8_3" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                            placeholder="Aprox Cabinet Weight"
                            data-error-msg="Aprox cabinet weight is required."
                            value="{{ $aproxCabinetWeight }}"
                            readonly="readonly">
                        <span class="scrollForReq error-message"></span>
                        @error('XLEW_1_8_3')
                        <span class="php-error-message">{{ $errors->first('XLEW_1_8_3') }}</span>
                        @enderror
                    </div>
                    </div>


                    @if(strcmp($wall_type,'raceway') != 0 || strcmp($wall_type,'cabinet') != 0 || strcmp($wall_type,'channel_letters') != 0 )
                     <div class="mb-1 text-left">
                        <h3 class="text-[1.3rem] font-bold text-gray-700">
                            Anchor
                        </h3>
                    </div>
                   @endif

                   <div class="flex justify-between gap-2">
                    <div class="input-group w-1/2 mb-4">
                            @php
                                $quantity = request('XLEW_1_18_3') ?? old('XLEW_1_18_3');
                                $inputId = 'XLEW_1_18_3';
                            @endphp
                            <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Quantity<span class="mandatory">*</span></label>
                            <input type="text" name="XLEW_1_18_3" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields number"
                                placeholder="Quantity"
                                data-error-msg="Quantity is required."
                                value="{{ $quantity }}"
                                onchange="this.value=eedisplayFloatV(eeparseFloatV(this.value));recalc_onclick('{{$inputId}}')">
                            <span class="scrollForReq error-message"></span>
                            @error('XLEW_1_18_3')
                            <span class="php-error-message">{{ $errors->first('XLEW_1_18_3') }}</span>
                            @enderror
                        </div>

                        <div class="input-group w-1/2 mb-4 relative">
                            <label for="Dia" class="text-sm text-gray-600 mb-2 block">Diameter<span class="mandatory">*</span></label>
                            <fieldset id='FS1$Dia' class="border-none">
							    <select name='Dia' id='Dia' class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields" data-error-msg="Diameter is required." onchange="recalc_onclick('Dia')">
									<option  data-value='n:0.375' selected >0.375</option>
									<option  data-value='n:0.5' >0.5</option>
									<option  data-value='n:0.5625' >0.5625</option>
									<option  data-value='n:0.625' >0.625</option>
									<option  data-value='n:0.75' selected >0.75</option>
									<option  data-value='n:0.875' >0.875</option>
									<option  data-value='n:1' >1</option>
									<option  data-value='n:1.125' >1.125</option>
									<option  data-value='n:1.25' >1.25</option>
									<option  data-value='n:1.5' >1.5</option>
									<option  data-value='n:1.75' >1.75</option>
									<option  data-value='n:2' >2</option>
									<option  data-value='n:2.25' >2.25</option>
									<option  data-value='n:2.5' >2.5</option>
									<option  data-value='n:2.75' >2.75</option>
									<option  data-value='n:2' >2</option>
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
                            <select name='XLEW_1_20_3' id='XLEW_1_20_3' class="w-full py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none required_fields"  data-error-msg="Grade is required." onchange="recalc_onclick('XLEW_1_20_3')">
                                <option  data-value='s:F1554 (36)' selected >F1554 (36)</option>
                                <option  data-value='s:F1554 (55)'>F1554 (55)</option>
                                <option  data-value='s:F1554 (105)'>F1554 (105)</option>
                                <option  data-value='s:A307' >A307</option>
                                <option  data-value='s:A36' >A36</option>
                                <option  data-value='s:A572' >A572</option>
                                <option  data-value='s:A588' >A588</option>
                            </select>
                        </fieldset>
                        <span class="scrollForReq error-message"></span>
                         @error('XLEW_1_20_3')
                            <span class="php-error-message">{{ $errors->first('XLEW_1_20_3') }}</span>
                        @enderror
                        <input id='XLEW_1_20_5' type='hidden' readonly='readonly' value='' name='XLEW_1_20_5' />
                     </div>

                     @if(strcmp($wall_type,'raceway') != 0 || strcmp($wall_type,'cabinet') != 0 || strcmp($wall_type,'channel_letters') != 0 )
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
                                <option  data-value='s:Individual'>Individual</option>
                                <option  data-value='s:Combined' selected>Combined</option>
                            </select>
                        </fieldset>
                        <span class="scrollForReq error-message"></span>
                        @error('XLEW_1_22_3')
                            <span class="php-error-message">{{ $errors->first('XLEW_1_22_3') }}</span>
                        @enderror
                    </div>


                    <div class="input-group w-1/2 mb-4 relative">
                        @php
                            $inputId = 'XLEW_1_23_3';
                            $adjustLength = request($inputId) ?? old($inputId) ?? '2';
                        @endphp
                        <label for="{{ $inputId }}" class="text-sm text-gray-600 mb-2 block">Adjust Length<span class="mandatory">*</span></label>
                        <div class="flex gap-2 items-baseline">
                            <select id="adjustLengthDropdown" class="!w-[40%] py-[0.90rem] px-[0.75rem] border border-gray-300 rounded-md text-base text-gray-700 outline-none" onchange="updateAdjustLength()">
                                @for ($i = 2; $i <= 7; $i += 0.25)
                                    @php $formattedValue = number_format($i, 2); @endphp
                                    <option value="{{ $formattedValue }}" {{ $adjustLength == $formattedValue ? 'selected' : '' }}>
                                        {{ $formattedValue }}
                                    </option>
                                @endfor
                            </select>
                            <div class="w-[60%]">
                            <input type="text" name="{{$inputId}}" id="{{$inputId}}"
                            class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                            placeholder="Adjust Length"
                            data-error-msg="Adjust length is required."
                            value="{{ $adjustLength }}"
                            readonly>
                            <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                            <span class="scrollForReq error-message"></span>
                            @error('XLEW_1_23_3')
                                <span class="php-error-message">{{ $errors->first('XLEW_1_23_3') }}</span>
                            @enderror
                            </div>
                        </div>
                        </div>
                    </div>
                  </div>

                  <div class="flex justify-between gap-2">
                    <div class="input-group w-1/2 mb-4 relative">
                    @php
                        $width = request('XLEW_1_24_3') ?? old('XLEW_1_24_3', 0);
                        $inputId = 'XLEW_1_24_3';
                    @endphp
                      <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Width<span class="mandatory">*</span></label>
                      <input type="text" name="XLEW_1_24_3" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                      placeholder="Width"
                      data-error-msg="Width is required."
                      value="{{ $width }}" readonly="readonly">
                      <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                      <span class="scrollForReq error-message"></span>
                      @error('XLEW_1_24_3')
                      <span class="php-error-message">{{ $errors->first('width') }}</span>
                      @enderror
                      <input id='XLEW_1_24_6' type='hidden' readonly='readonly' value='' name='XLEW_1_24_6'/>
                  </div>

                  <div class="input-group w-1/2 mb-4 relative">
                    @php
                        $depth = request('XLEW_1_25_3') ?? old('XLEW_1_25_3', 0);
                        $inputId = 'XLEW_1_25_3';
                    @endphp
                      <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Depth<span class="mandatory">*</span></label>
                      <input type="text" name="XLEW_1_25_3" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                          placeholder="Depth"
                          data-error-msg="Depth is required."
                          value="{{ $depth }}" readonly="readonly">
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
            @if($wall_type != 'raceway' || $wall_type != 'cabinet' || $wall_type != 'channel_letters')
                <div class="mb-1 text-left">
                   <h3 class="text-[1.3rem] font-bold text-gray-700">
                       Augered Footing
                   </h3>
               </div>
              @endif
              <div class="flex justify-between gap-2">
                <div class="input-group w-1/2 mb-4 relative">
                    @php
                       $diameter = request('XLEW_1_28_3') ?? old('XLEW_1_28_3', 3.00);
                       $inputId = 'XLEW_1_28_3';
                    @endphp
                      <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Diameter<span class="mandatory">*</span></label>
                      <input type="text" name="XLEW_1_28_3" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                      placeholder="Diameter"
                      data-error-msg="Diameter is required."
                      value="{{ $diameter }}"
                      onchange="this.value=eedisplayFloatNDV(eeparseFloatV(this.value),2);recalc_onclick('{{$inputId}}')">
                      <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                      <span class="scrollForReq error-message"></span>
                      @error('XLEW_1_28_3')
                      <span class="php-error-message">{{ $errors->first('XLEW_1_28_3') }}</span>
                      @enderror
              </div>

              <div class="input-group w-1/2 mb-4 relative">
                @php
                   $XLEW_1_29_3 = 0;
                   $inputId = 'XLEW_1_29_3';
                @endphp
                  <label for="{{$inputId}}" class="text-sm text-gray-600 mb-2 block">Depth<span class="mandatory">*</span></label>
                  <input type="text" name="{{$inputId}}" id="{{ $inputId }}" class="w-full p-3 border border-gray-300 rounded-md text-base text-gray-700 outline-none pointer-events-none bg-gray-300 required_fields number"
                  placeholder="Depth"
                  data-error-msg="Depth is required."
                  value="{{ $XLEW_1_29_3 }}"
                  readonly="readonly">
                  <span class="absolute top-[45px] right-2 text-gray-500">ft</span>
                  <span class="scrollForReq error-message"></span>
                  @error('XLEW_1_29_3')
                  <span class="php-error-message">{{ $errors->first('XLEW_1_29_3') }}</span>
                  @enderror
             </div>
            </div>
            @endif

            <div class="w-full">
                <button type="submit" class="px-4 py-3 bg-gray-700 text-white text-base border-none rounded-md cursor-pointer transition duration-300 ease-in-out mt-4 mb-4 w-full uppercase">NEXT</button>
              </div>
            </div>
            </form>
            <table class="hidden">
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
                            <input id="XLEW_1_31_3" type="text" readonly="readonly" value="" name="XLEW_1_31_3" class="monument_input_tags"/>
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
    </div>
  </div>
  <!-- OUTPUT DATA START -->
    <!-- WALL TYPE RACEWAY -->
        @if(strcmp($wall_type,'raceway') == 0)
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
                                onchange="recalc_onclick('XLEW_3_{{ 18 + $index }}_{{ $i }}')" name="XLEW_3_{{ 18 + $index }}_{{ $i }}"
                                tabindex="-1">{{ $i == 4 ? '0' : '""' }}</textarea>
                        </div>
                    @endfor
                    </div>
            @endforeach
        @endif

        <!-- WALL TYPE CHANNEL LETTERS -->
        @if(in_array($wall_type, ['channel_letters']))
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

            <!-- WALL TYPE CABINET -->
            @if(in_array($wall_type, ['cabinet']))
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

<script>
        $(document).ready(function () {
        // upload artwork image start
        var fileTypesBusLicense = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'webp', 'WEBP'];
        $("#artwork_image").on('change', function (e) {
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

            $("body").addClass("overlay");
            $(".acoda-spinner").css("display", "inline-flex");

            jQuery.ajax({
                url: "{{route("client.project.artwork.upload")}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    if (!data.errors) {
                        $('#imagePreviewContainer').show();
                        $('.preiview_container').remove();

                        $("#imagePreview").attr('src', '');
                        $("#ArtworkImageId").val('');
                        $("#ArtworkImageId").val(data.imageId);
                        $("#imagePreview").attr('src', data.miniImageUrl);

                        $('#main_image_container').append(
                            '<div class="preiview_container">' +
                            '<div class="image_preiview_container">' +
                            '<img id="imagePreview" src="' + data.miniImageUrl + '" alt="Uploaded Logo" />' +
                            '</div>' +
                            '<div class="remove_image_container">' +
                            '<button type="button" id="removeImage">Remove</button>' +
                            '</div>' +
                            '</div>'
                        );
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
                        $("body").removeClass("overlay");
                        $(".acoda-spinner").css("display", "none");
                    });
                },
                error: function (xhr, status, error) {
                    console.log('error', error.message);
                }
            });
        }
        $('body').on('click', '#removeImage', function () {
            $("#imagePreview").attr('src', '');
            $("#ArtworkImageId").val('');
            $('#imagePreviewContainer').hide();
            $('.preiview_container').remove();
        });
        // upload artwork image end
        });
         // Validate form start
         function checkForm() {

        $("body").addClass("overlay");
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
        $("body").removeClass("overlay");
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
    if (dropdown && inputField) {
        inputField.value = dropdown.value;
    }
}
document.addEventListener("DOMContentLoaded", function () {
    updateAdjustLength();
});

$('#XLEW_1_3_3').on('input', function() {
    const value = $(this).val();
    $('#XLEW_1_4_3').val(value);
});
</script>
@endsection