@extends('layout.default')
@section('title', 'Fastener Schedule')
@section('content')
@php
  $sign_type =  $project->wall_type;
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

@if(strcmp($project->wall_type,'raceway') ==0)
<script src="{{ asset('public/js/raceway.min.js') }}"></script>
@endif
@if(strcmp($project->wall_type,'channel_letters') ==0)
<script src="{{ asset('public/js/channel-letters.min.js') }}"></script>
@endif
@if(strcmp($project->wall_type,'cabinet') ==0)
<script src="{{ asset('public/js/cabinet.min.js') }}"></script>
@endif


@if(strcmp($project->wall_type, 'double-post-full-height') == 0)
    <script>
        console.log('Double Post Full Height selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($project->wall_type, 'single-post-full-height') == 0)
    <script>
        console.log('Single Post Full Height selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($project->wall_type, 'double-post-with-cabinet') == 0)
    <script>
        console.log('Double Post with Cabinet selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($project->wall_type, 'single-post-with-cabinet') == 0)
    <script>
        console.log('Single Post with Cabinet selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($project->wall_type, 'post-and-panel') == 0)
    <script>
        console.log('Post and Panel selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($project->wall_type, 'double-post-covered') == 0)
    <script>
        console.log('Double Post Covered selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif

@if(strcmp($project->wall_type, 'single-post-covered') == 0)
    <script>
        console.log('Single Post Covered selected');
    </script>
    <script src="{{ asset('public/js/monument-min.js') }}"></script>
@endif



<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="flex justify-between items-center mt-[60px] pb-[20px]">
    <div class="w-full max-w-full flex items-center justify-between">
    <div class="list-header">
        <div class="flex items-center justify-start">
            <a href="{{route('client.project.list')}}" class="p-1 inline-flex"><img src="{{asset('/public/images/arrow.svg')}}" alt="Back Button" class="w-4"></a>
            <h2 class="font-normal text-[24px]">Fastener Schedule</h2>
        </div>
    </div>
    
    <div class="flex items-center justify-center mx-[-6px]">
        <a href="{{ route('client.project.edit', $project->id) }}" class="bg-[#EBF0F9] inline-flex items-center justify-center w-[30px] h-[30px] mx-[6px] rounded-[20px]"><img src="{{ asset('public/images/icons_edit.svg') }}" alt="Edit Icon" class="max-w-[16px]"></a>
        <a href="javascript:void(0);" class="bg-[#FDEDEB] inline-flex items-center justify-center w-[30px] h-[30px] mx-[6px] rounded-[20px] action-delete-btn" data-delete-url="{{route('client.project.delete.post',$project->id)}}" data-project-id="{{$project->id}}"><img src="{{ asset('public/images/delete_icon.svg') }}" alt="Delete Icon" class="max-w-[16px]"></a>
    </div>
   
</div>
</div>

<div class="w-full mx-auto bg-white rounded-[6px] border border-black">
    <div class="p-[15px]">
        @if($project->wall_type == 'raceway' || $project->wall_type == 'channel_letters' || $project->wall_type == 'cabinet')
        <div class="w-full bg-white shadow-[0_0_10px_#0000001a]" id="fastenerScheduleTable">
            <div class="relative">
                <div class="overflow-x-auto">
                    <div class="table_before"></div>
                     <table class="w-full border-collapse text-center mx-auto">
                        <thead>
                            @if(strcmp($project->wall_type,'raceway') ==0 || strcmp($project->wall_type,'channel_letters') || strcmp($project->wall_type,'cabinet'))
                            <tr class="hidden hidden_tr">
                                <!-- Sign Type -->
                                 <td>
                                    @php
                                    $inputId = '';
                                    if (strcmp($sign_type, 'raceway') == 0) {
                                        $inputId = 'XLEW_3_3_4';
                                    }
                                    if (strcmp($sign_type, 'channel_letters') == 0) {
                                        $inputId = 'XLEW_3_3_4';
                                    }
                                    if(strcmp($sign_type, 'cabinet') == 0){
                                        $inputId = 'XLEW_3_3_4';
                                    }
                                    @endphp
                                    <fieldset id="FS1$XLEW_3_3_4">
                                        <select name="{{$inputId}}" id="{{$inputId}}" tabindex="5" size="1" onchange="recalc_onclick('{{$inputId}}')"
                                            data-sheet="3" data-row="6" data-col="8" class="input-auto">
                                            <option value="raceway" data-value="s:Raceway"
                                                <?= ($sign_type === 'raceway') ? 'selected' : '' ?>>Raceway
                                            </option>

                                            <option value="monument" data-value="s:Monument"
                                                <?= ($sign_type === 'monument') ? 'selected' : '' ?>>Monument
                                            </option>

                                            <option value="solid_freestanding" data-value="s:Solid Freestanding"
                                                <?= ($sign_type === 'solid_freestanding') ? 'selected' : '' ?>>Solid Freestanding
                                            </option>

                                            <option value="channel_letters" data-value="s:Channel Letters"
                                                <?= ($sign_type === 'channel_letters') ? 'selected' : '' ?>>Channel Letters
                                            </option>

                                            <option value="solid_cantilevered" data-value="s:Solid Cantilevered"
                                                <?= ($sign_type === 'solid_cantilevered') ? 'selected' : '' ?>>Solid Cantilevered
                                            </option>

                                            <option value="solid_attached_roof" data-value="s:Solid Attached to Roof"
                                                <?= ($sign_type === 'solid_attached_roof') ? 'selected' : '' ?>>Solid Attached to Roof
                                            </option>

                                            <option value="solid_attached_wall" data-value="s:Solid Attached to Wall"
                                                <?= ($sign_type === 'cabinet') ? 'selected' : '' ?>>Solid Attached to Wall
                                            </option>
                                        </select>
                                    </fieldset>
                                </td>
                                <!-- Sign Height -->
                                <td>
                                    @php
                                    $sign_height =  $project->sign_height;
                                    $inputId = '';
                                    if (strcmp($sign_type, 'raceway') == 0) {
                                        $inputId = 'XLEW_3_4_4';
                                    }
                                    if (strcmp($sign_type, 'channel_letters') == 0) {
                                        $inputId = 'XLEW_3_4_4';
                                    }
                                    if(strcmp($sign_type, 'cabinet') == 0){
                                        $inputId = 'XLEW_3_4_4';
                                    }
                                    @endphp
                                    <input id="{{$inputId}}" type='text' value='{{$sign_height}}' onchange="this.value=eedisplayFloatND(eeparseFloat(this.value),2);recalc_onclick('{{$inputId}}')"
                                        class='ee123 form-control input-auto' name='{{$inputId}}'
                                        placeholder='' tabindex='1' data-sheet='3' data-row='3'
                                        data-col='4' />
                                </td>
                                <!-- Sign Length -->
                                <td>
                                    @php
                                    $sign_length =  $project->sign_length;
                                    $inputId = '';
                                    if (strcmp($sign_type, 'raceway') == 0) {
                                        $inputId = 'XLEW_3_5_4';
                                    }
                                    if (strcmp($sign_type, 'channel_letters') == 0) {
                                        $inputId = 'XLEW_3_5_4';
                                    }
                                    if(strcmp($sign_type, 'cabinet') == 0){
                                        $inputId = 'XLEW_3_5_4';
                                    }
                                    @endphp
                                    <input id='{{$inputId}}' type='text' value='{{$sign_length}}' onchange="this.value=eedisplayFloatND(eeparseFloat(this.value),2);recalc_onclick('{{$inputId}}')"
                                    class='ee123 form-control input-auto'
                                    name='{{$inputId}}' placeholder='' tabindex='2' data-sheet='3'
                                    data-row='4' data-col='4' />
                                </td>
                                <!-- Sign Depth -->
                                  <td>
                                    @php
                                    $sign_depth =  $project->sign_depth;
                                    $inputId = '';
                                    if (strcmp($sign_type, 'raceway') == 0) {
                                        $inputId = 'XLEW_3_6_4';
                                    }
                                    if (strcmp($sign_type, 'channel_letters') == 0) {
                                        $inputId = 'XLEW_3_6_4';
                                    }
                                    if(strcmp($sign_type, 'cabinet') == 0){
                                        $inputId = 'XLEW_3_6_4';
                                    }
                                    @endphp
                                    <input id='{{$inputId}}' type='text' value='{{$sign_depth}}'
                                        onchange="this.value=eedisplayFloatND(eeparseFloat(this.value),2);recalc_onclick('{{$inputId}}')"
                                        name='{{$inputId}}' placeholder='' tabindex='3' data-sheet='3'
                                        data-row='5' data-col='4' class='ee123 form-control input-auto'>
                                </td>
                                <!-- Aproximate Weight -->
                                <td>
                                    @php
                                    $weight =  $project->weight;
                                    $inputId = '';
                                    if (strcmp($sign_type, 'raceway') == 0) {
                                        $inputId = 'XLEW_3_9_4';
                                    }
                                    if (strcmp($sign_type, 'channel_letters') == 0) {
                                        $inputId = 'XLEW_3_7_4';
                                    }
                                    if(strcmp($sign_type, 'cabinet') == 0){
                                        $inputId = 'XLEW_3_7_4';
                                    }
                                    @endphp
                                    <input id='{{$inputId}}' type='text' value='{{$weight}}'
                                        name='{{$inputId}}' placeholder='' tabindex='6' data-sheet='3'
                                        data-row='7' data-col='4' class='ee123 form-control input-auto'/>
                                </td>
                                <!-- Installation Height -->
                                 <td>
                                    @php
                                    $sign_installation_height =  $project->sign_installation_height;
                                    $inputId = '';
                                    if (strcmp($sign_type, 'raceway') == 0) {
                                        $inputId = 'XLEW_3_10_4';
                                    }
                                    if (strcmp($sign_type, 'channel_letters') == 0) {
                                        $inputId = 'XLEW_3_8_4';
                                    }
                                    if(strcmp($sign_type, 'cabinet') == 0){
                                        $inputId = 'XLEW_3_8_4';
                                    }
                                    @endphp
                                    <input id='{{$inputId}}' type='text' value='{{$sign_installation_height}}'
                                        onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('{{$inputId}}')"
                                        class='ee123 form-control input-auto' name='{{$inputId}}'
                                        placeholder='' tabindex='1' data-sheet='3' data-row='3'
                                        data-col='4' />
                                </td>

                            @if(strcmp($project->wall_type,'raceway') ==0)
                            <!-- Raceway Depth -->
                            <td>
                             @php
                               $blockDepth =  $project->block_depth;
                                $inputId = '';
                                if (strcmp($sign_type, 'raceway') == 0) {
                                    $inputId = 'XLEW_3_7_4';
                                }
                            @endphp
                                <input id='{{$inputId}}' type='text' value='{{$blockDepth}}' onchange="this.value=eedisplayFloatND(eeparseFloat(this.value),2);recalc_onclick('{{$inputId}}')"
                                    name='{{$inputId}}' placeholder='' tabindex='4' data-sheet='3'
                                    data-row='6' data-col='4' class='ee123 form-control input-auto'/>
                            </td>
                            <!-- Raceway Height -->
                            <td>
                            @php
                                $blockHeight =  $project->block_height;
                                 $inputId = '';
                                 if (strcmp($sign_type, 'raceway') == 0) {
                                     $inputId = 'XLEW_3_8_4';
                                 }
                             @endphp
                                <input id='{{$inputId}}' type='text' value='{{$blockHeight}}'
                                    onchange="this.value=eedisplayFloatND(eeparseFloat(this.value),2);recalc_onclick('{{$inputId}}')"
                                    name='{{$inputId}}' placeholder='' tabindex='6' data-sheet='3'
                                    data-row='7' data-col='4' class='ee123 form-control input-auto'/>
                            </td>
                            @endif

                            <!--Wind Speed -->
                                <td>
                                 @php
                                    $windSpeed = $project->wind_speed;
                                    $inputId = '';
                                    if (strcmp($sign_type, 'raceway') == 0) {
                                        $inputId = 'XLEW_3_3_7';
                                    }
                                    if (strcmp($sign_type, 'channel_letters') == 0) {
                                        $inputId = 'XLEW_3_3_7';
                                    }
                                    if(strcmp($sign_type, 'cabinet') == 0){
                                        $inputId = 'XLEW_3_3_7';
                                    }
                                 @endphp
                                <input id='{{$inputId}}' type='text' value='{{$windSpeed}}' onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('{{$inputId}}')"
                                    class='ee123 form-control input-auto' name='{{$inputId}}'
                                    placeholder='' tabindex='1' data-sheet='3' data-row='3'
                                    data-col='4' />
                            </td>

                            <!-- SNOW LOAD -->
                                <td>
                                  @php
                                    $snowLoad = $project->snow_load;
                                    $inputId = '';
                                    if (strcmp($sign_type, 'raceway') == 0) {
                                        $inputId = 'XLEW_3_4_7';
                                    }
                                    if (strcmp($sign_type, 'channel_letters') == 0) {
                                        $inputId = 'XLEW_3_4_7';
                                    }
                                    if(strcmp($sign_type, 'cabinet') == 0){
                                        $inputId = 'XLEW_3_4_7';
                                    }
                                 @endphp
                                <input id='{{$inputId}}' type='text' value='{{$snowLoad}}' onchange="this.value=eedisplayFloat  (eeparseFloat(this.value));recalc_onclick('{{$inputId}}')"
                                    class='ee123 form-control input-auto' name='{{$inputId}}'
                                    placeholder='' tabindex='1' data-sheet='3' data-row='3'
                                    data-col='4' />
                            </td>

                             <!-- EXPOSURE CATE MISSING-->
                                 <td>
                                    @php
                                    $EXPOSURECATE = $project->exposure_cate;
                                    $inputId = '';
                                    if (strcmp($sign_type, 'raceway') == 0) {
                                        $inputId = 'XLEW_3_5_7';
                                    }
                                    if (strcmp($sign_type, 'channel_letters') == 0) {
                                        $inputId = 'XLEW_3_5_7';
                                    }
                                    if(strcmp($sign_type, 'cabinet') == 0){
                                        $inputId = 'XLEW_3_5_7';
                                    }
                                    @endphp
                                    <fieldset id="FS1$XLEW_3_5_7">
                                        <select name="{{$inputId}}" id="{{$inputId}}" onchange="recalc_onclick('{{$inputId}}')" tabindex="5" size="1"
                                            data-sheet="3" data-row="6" data-col="8"  class='ee123 form-control input-auto'>

                                            <option value="B" data-value="s:B"
                                                <?= ($EXPOSURECATE === 'B') ? 'selected' : '' ?>>B
                                            </option>

                                            <option value="C" data-value="s:C"
                                                <?= ($EXPOSURECATE === 'C') ? 'selected' : '' ?>>C
                                            </option>

                                            <option value="D" data-value="s:D"
                                                <?= ($EXPOSURECATE === 'D') ? 'selected' : '' ?>>D
                                            </option>

                                        </select>
                                    </fieldset>
                                </td>

                                  <!-- RISK CATEGORY MISSING-->
                                  <td>
                                    @php
                                    $RISKCATEGORY = $project->risk_category;
                                    $inputId = '';
                                    if (strcmp($sign_type, 'raceway') == 0) {
                                        $inputId = 'XLEW_3_6_7';
                                    }
                                    if (strcmp($sign_type, 'channel_letters') == 0) {
                                        $inputId = 'XLEW_3_6_7';
                                    }
                                    if(strcmp($sign_type, 'cabinet') == 0){
                                        $inputId = 'XLEW_3_6_7';
                                    }
                                    @endphp

                                    <fieldset id="FS1$XLEW_3_6_7">
                                        <select name="{{$inputId}}" id="{{$inputId}}" tabindex="5" size="1" class='ee123 form-control input-auto' onchange="recalc_onclick('{{$inputId}}')"
                                            data-sheet="3" data-row="6" data-col="8">

                                            <option value="I" data-value="s:I"
                                                <?= ($RISKCATEGORY === 'I') ? 'selected' : '' ?>>B
                                            </option>

                                            <option value="II" data-value="s:II"
                                                <?= ($RISKCATEGORY === 'II') ? 'selected' : '' ?>>II
                                            </option>

                                            <option value="III" data-value="s:III"
                                                <?= ($RISKCATEGORY === 'III') ? 'selected' : '' ?>>III
                                            </option>

                                            <option value="IV" data-value="s:IV"
                                                <?= ($RISKCATEGORY === 'IV') ? 'selected' : '' ?>>IV
                                            </option>

                                        </select>
                                    </fieldset>
                                  </td>
                            </tr>
                            @endif
                            <tr class="heading">
                                <th colspan="8" class="border border-white border-l-white border-r-white border-b-white bg-[#49b747] text-white text-[18px] uppercase align-middle whitespace-pre-line p-[12px]">FASTENER SCHEDULE</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] align-middle whitespace-pre-line border border-white border-r-white">FASTENER</th>
                                <th colspan="5" class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] border border-white border-r-white align-middle whitespace-pre-line">HORIZONTAL SPACING PER WALL CONSTRUCTION (INCHES)
                                </th>
                            </tr>
                            <tr class="">
                                <th rowspan="" class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] border border-white align-middle whitespace-pre-line">HARDWARE</th>
                                <th rowspan="" class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] border border-white align-middle whitespace-pre-line">DIA</th>
                                <!-- Here for result -->
                                <th class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] border border-white align-middle whitespace-pre-line">
                                @php
                                  $inputId = '';
                                    if (strcmp($sign_type, 'raceway') == 0) {
                                        $inputId = 'XLEW_3_15_4';
                                    }
                                    if (strcmp($sign_type, 'channel_letters') == 0) {
                                        $inputId = 'XLEW_3_15_4';
                                    }
                                    if(strcmp($sign_type, 'cabinet') == 0){
                                        $inputId = 'XLEW_3_15_4';
                                    }
                                @endphp
                                   <textarea id='{{$inputId}}' class='ee144 text-white uppercase text-[14px] resize-none border-none text-center bg-transparent font-bold h-auto min-h-auto font-lato' disabled
                                    onchange="recalc_onclick('{{$inputId}}')" onKeyDown="" name='{{$inputId}}'
                                    placeholder='' tabindex='-1'>""</textarea>
                                </th>
                                <!-- Here for result -->

                                <th class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] border border-white align-middle whitespace-pre-line">MASONRY</th>
                                <th class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] border border-white align-middle whitespace-pre-line">WOOD STUDS</th>
                                <th class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] border border-white align-middle whitespace-pre-line">EIFS/DRYVIT OVER 1/2" MIN PLYWOOD</th>
                                <th class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] border border-white align-middle whitespace-pre-line">EIFS/DRYVIT OVER 1/2" MIN GYPSUM/DENGLASS</th>
                                <th class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] border border-white align-middle whitespace-pre-line">METAL PANEL OVER METAL STUD</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(strcmp($project->wall_type,'raceway') == 0)
                            @php
                                $items = [
                                    ['WOOD SCREW', '#10'],
                                    ['TEK SCREW', '#10'],
                                    ['LAG BOLT', '3/8"'],
                                    ['THRU-BOLT', '3/8"'],
                                    ['EXPANSION ANCHOR', '3/8"'],
                                    ['CARBON STEEL SCREW ANCHOR', '3/8"'],
                                    ['TOGGLE BOLT', '3/8"'],
                                    ['ALUMINUM STUDS', '1/4"'],
                                ];
                            @endphp

                            @foreach($items as $index => $item)
                                <tr>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">{{ $item[0] }}<sup>{{ $index + 1 }}</sup></td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">{{$item[1]}}</td>
                                    @for($i = 4; $i <= 9; $i++)
                                        <td class="border border-[#ccc] uppercase text-sm text-center">
                                            <textarea id="XLEW_3_{{ 18 + $index }}_{{ $i }}" class="bg-white border-none text-sm font-inherit resize-none min-h-[30px] text-center outline-none px-[5px] pt-[30px] pb-[12px] leading-[1.5]" disabled
                                                onchange="recalc_onclick('XLEW_3_{{ 18 + $index }}_{{ $i }}')" name="XLEW_3_{{ 18 + $index }}_{{ $i }}"
                                                tabindex="-1">{{ $i == 4 ? '0' : '""' }}</textarea>

                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endif

                        @if(strcmp($project->wall_type,'channel_letters') == 0)
                            @php
                                $items = [
                                    ['WOOD SCREW', '#10'],
                                    ['TEK SCREW', '#10'],
                                    ['LAG BOLT', '3/8"'],
                                    ['THRU-BOLT', '3/8"'],
                                    ['EXPANSION ANCHOR', '3/8"'],
                                    ['CARBON STEEL SCREW ANCHOR', '3/8"'],
                                    ['TOGGLE BOLT', '3/8"'],
                                    ['ALUMINUM STUDS', '1/4"'],
                                ];
                            @endphp

                            @foreach($items as $index => $item)
                                <tr>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">{{ $item[0] }}<sup>{{ $index + 1 }}</sup></td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">{{$item[1]}}</td>
                                    @for($i = 4; $i <= 9; $i++)
                                        <td class="border border-[#ccc] uppercase text-sm text-center">
                                            <textarea id="XLEW_3_{{ 18 + $index }}_{{ $i }}" class="bg-white border-none text-sm font-inherit resize-none min-h-[30px] text-center outline-none px-[5px] pt-[30px] pb-[12px] leading-[1.5]" disabled
                                                onchange="recalc_onclick('XLEW_3_{{ 16 + $index }}_{{ $i }}')" name="XLEW_3_{{ 16 + $index }}_{{ $i }}"
                                                tabindex="-1">{{ $i == 4 ? '0' : '""' }}</textarea>

                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endif


                        @if(strcmp($project->wall_type,'cabinet') == 0)
                        @php
                            $items = [
                                ['WOOD SCREW', '#10'],
                                ['TEK SCREW', '#10'],
                                ['LAG BOLT', '3/8"'],
                                ['THRU-BOLT', '3/8"'],
                                ['EXPANSION ANCHOR', '3/8"'],
                                ['CARBON STEEL SCREW ANCHOR', '3/8"'],
                                ['TOGGLE BOLT', '3/8"'],
                                ['ALUMINUM STUDS', '1/4"'],
                            ];
                        @endphp

                        @foreach($items as $index => $item)
                            <tr>
                                <td class="border border-[#ccc] uppercase text-sm text-center">{{ $item[0] }}<sup>{{ $index + 1 }}</sup></td>
                                <td class="border border-[#ccc] uppercase text-sm text-center">{{$item[1]}}</td>
                                @for($i = 4; $i <= 9; $i++)
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <textarea id="XLEW_3_{{ 18 + $index }}_{{ $i }}" class="bg-white border-none text-sm font-inherit resize-none min-h-[30px] text-center outline-none px-[5px] pt-[30px] pb-[12px] leading-[1.5]" disabled
                                            onchange="recalc_onclick('XLEW_3_{{ 16 + $index }}_{{ $i }}')" name="XLEW_3_{{ 16 + $index }}_{{ $i }}"
                                            tabindex="-1">{{ $i == 4 ? '0' : '""' }}</textarea>
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                       @endif
                     </tbody>
                    </table>
                    <div class="table_after"></div>
                </div>
            </div>
            <div class="p-[10px]">
                <p class="text-[14px]">1) MINIMUM 1.5" EMBEDMENT INTO WOOD STUDS, OR MIN 1/4" PROTUDED FROM THE BACK OF
                    PLYWOOD.</p>
                <p class="text-[14px]">2) MIN 1/4" PROTUDED FROM THE BACK OF METAL STUD.</p>
                <p class="text-[14px]">3) MINIMUM 2.5" EMBEDMENT INTO WOOD STUDS, OR MIN 1/4" PROTUDED FROM THE BACK OF
                    PLYWOOD.</p>
                <p class="text-[14px]">4) ANCHORS REQUIRE A MINIMUM 2" EMBEDMENT, ANCHOR SHALL BE INSTALLED IN CONCRETE
                    OR
                    GROUT FILLED CMU UNITS ONLY.</p>
                <p class="text-[14px]">5) REQUIRES 2"x2"x1/4" STEEL BACKING PLATE.</p>
                <p class="text-[14px]">6) USE HILTI HLC SLEEVE ANCHOR OR EQUIVALENT WITH 1-1/4" MIN EMBEDMENT.</p>
                <p class="text-[14px]">7) USE HILTI KWIK HUS-E OR APPROVED EQUIVALENT WITH 1-5/8" MIN EMBEDMENT.</p>
                <p class="text-[14px]">8) MINIMUM 20 GAUGE METAL THICKNESS.</p>
                <p class="text-[14px]">9) THROUGH BLOCK FACE FOR CLAY BRICKS.</p>
                <p class="text-[14px]">10) IF THE CONTRACTOR ENCOUNTERS A METAL/WOODEN STUD, HE/SHE SHALL FOLLOW THE
                    LAG/TEK
                    SCREW GUIDELINE AS SHOWN ON THE SCHEDULE ABOVE. THE CONTRACTOR SHALL MAKE EVERY
                    ATTEMPT TO USE STUDS WHENEVER POSSIBLE.</p>
                <p class="text-[14px]">NOTE: THIS FASTENER SCHEDULE IS INTENDED FOR USE WITH SIGN CONNECTION TO BUILDING
                    ONLY. IT IS ASSUMED THAT THE BUILDING IS RIGID, FREE OF STRUCTURAL DEFECTS, AND
                    STRUCTURALLY SUFFICIENT TO CARRY THE LOAD OF THE SIGN. CONTRACTOR SHALL FOLLOW
                    FASTENER SCHEDULE TO DETERMINE FASTENER TYPE TO BE USED FOR INSTALLATION AND
                    SHALL
                    ENSURE THE FASTENER HAS A RIGID AND STRONG CONNECTION. CONTRACTOR SHALL FOLLOW
                    MANUFACTURERS SPECS FOR FASTENER/ANCHOR INSTALLATION. CONTRACTOR SHALL ENSURE
                    THAT
                    FASTENER BEARS ON WALL FACADE IMMEDIATELY AFTER INSTALLATION. CONTRACTOR SHALL
                    NOT
                    USE EXISTING HOLES PRESENT IN THE CURRENT FASCIA FOR FASTNER INSTALLATION.</p>
            </div>
        </div>
         @endif

         @if($project->wall_type == 'double-post-full-height' ||
         $project->wall_type == 'single-post-full-height' ||
         $project->wall_type == 'double-post-with-cabinet' ||
         $project->wall_type == 'single-post-with-cabinet' ||
         $project->wall_type == 'post-and-panel' ||
         $project->wall_type == 'double-post-covered' ||
         $project->wall_type == 'single-post-covered')
         <div class="" id="fastenerScheduleTable">
                    <div class="fastener_schedule_container">
                        <div class="fastener_schedule_table">
                            <div class="table_before"></div>
                            <table class="w-full border-collapse text-center mx-auto">
                                <thead>
                                    <tr class="hidden hidden_tr">
                                        {{-- Total Height --}}
                                        <td>
                                            <input type="text" name="XLEW_1_3_3" id="XLEW_1_3_3" value="{{ $project->total_height }}" onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('XLEW_1_3_3')">
                                        </td>
                                        {{-- Ultimate Wind Speed --}}
                                        <td>
                                            <input type="text" name="XLEW_1_3_8" id="XLEW_1_3_8" value="{{ $project->ultimate_wind_speed }}"  onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('XLEW_1_3_8')">
                                        </td>
                                        {{-- Cabinet Height --}}
                                        <td>
                                            <input type="text" name="XLEW_1_4_3" id="XLEW_1_4_3" value="{{ $project->cabinet_height }}" onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('XLEW_1_4_3')" readonly="readonly">
                                        </td>
                                        {{-- Snow Load --}}
                                        <td>
                                            <input type="text" name="XLEW_1_4_8" id="XLEW_1_4_8" value="{{ $project->snow_load }}" onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('XLEW_1_4_8')">
                                        </td>
                                        {{-- Cabinet Width --}}
                                        <td>
                                            <input type="text" name="XLEW_1_5_3" id="XLEW_1_5_3" value="{{ $project->cabinet_width }}" onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('XLEW_1_5_3')">
                                        </td>
                                        {{-- Ice Thickness --}}
                                        <td>
                                            <input type="text" name="XLEW_1_5_8" id="XLEW_1_5_8" value="{{ $project->ice_thickness }}" onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('XLEW_1_5_8')">
                                        </td>
                                        {{-- Cabinet Depth --}}
                                        <td>
                                            <input type="text" name="XLEW_1_6_3" id="XLEW_1_6_3" value="{{ $project->cabinet_depth }}" onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('XLEW_1_6_3')">
                                        </td>
                                        {{-- Exposure Category --}}
                                        <td>
                                            <fieldset id="FS1$XLEW_1_6_8">
                                                <select name="XLEW_1_6_8" id="XLEW_1_6_8" onchange="recalc_onclick('XLEW_1_6_8')">

                                                    <option value="B" data-value="s:B"
                                                        <?= ($project->exposure_cate === 'B') ? 'selected' : '' ?>>B
                                                    </option>

                                                    <option value="C" data-value="s:C"
                                                        <?= ($project->exposure_cate === 'C') ? 'selected' : '' ?>>C
                                                    </option>

                                                    <option value="D" data-value="s:D"
                                                        <?= ($project->exposure_cate === 'D') ? 'selected' : '' ?>>D
                                                    </option>

                                                </select>
                                            </fieldset>
                                        </td>
                                        {{-- Pole Cover Width --}}
                                        <td>
                                            <input type="text" name="XLEW_1_7_3" id="XLEW_1_7_3" value="{{ $project->pole_cover_width }}" onchange="this.value = eedisplayFloat(eeparseFloat(this.value)); recalc_onclick('XLEW_1_7_3')">
                                        </td>
                                        {{-- Risk Category --}}
                                        <td>
                                            <fieldset id="FS1$XLEW_1_7_8">
                                                <select name="XLEW_1_7_8" id="XLEW_1_7_8" onchange="recalc_onclick('XLEW_1_7_8')">

                                                    <option value="I" data-value="s:I"
                                                        <?= ($project->risk_category === 'I') ? 'selected' : '' ?>>B
                                                    </option>

                                                    <option value="II" data-value="s:II"
                                                        <?= ($project->risk_category === 'II') ? 'selected' : '' ?>>II
                                                    </option>

                                                    <option value="III" data-value="s:III"
                                                        <?= ($project->risk_category === 'III') ? 'selected' : '' ?>>III
                                                    </option>

                                                    <option value="IV" data-value="s:IV"
                                                        <?= ($project->risk_category === 'IV') ? 'selected' : '' ?>>IV
                                                    </option>

                                                </select>
                                            </fieldset>
                                        </td>
                                        {{-- Aprox Cabinet Weight --}}
                                        <td>
                                            <input type="text" name="XLEW_1_8_3" id="XLEW_1_8_3" value="{{ $project->aprox_cabinet_weight }}" readonly="readonly">
                                        </td>
                                        {{-- Number of Posts --}}
                                        <td>
                                            <fieldset id="FS1$XLEW_1_9_3">
                                                <select name="XLEW_1_9_3" id="XLEW_1_9_3" onchange="recalc_onclick('XLEW_1_9_3')" disabled>

                                                    <option value="1" data-value="n:1"
                                                        <?= ($project->number_of_posts === '1') ? 'selected' : '' ?>>1
                                                    </option>

                                                    <option value="2" data-value="n:2"
                                                        <?= ($project->number_of_posts === '2') ? 'selected' : '' ?>>2
                                                    </option>

                                                </select>
                                            </fieldset>
                                        </td>
                                        <td>
                                            <input type="text" name="XLEW_1_10_3" id="XLEW_1_10_3" value="{{ $project->post_spacing }}" onchange="this.value=eedisplayFloat(eeparseFloat(this.value));recalc_onclick('XLEW_1_10_3')">
                                        </td>
                                        {{-- Sign Face --}}
                                        <td>
                                            <fieldset id="FS1$XLEW_1_11_3">
                                                <select name="XLEW_1_11_3" id="XLEW_1_11_3" onchange="recalc_onclick('XLEW_1_11_3')">

                                                    <option value="Double Faced" data-value="s:Double Faced"
                                                        <?= ($project->sign_face === 'Double Faced') ? 'selected' : '' ?>>Double Faced
                                                    </option>

                                                    <option value="Single Faced" data-value="s:Single Faced"
                                                        <?= ($project->sign_face === 'Single Faced') ? 'selected' : '' ?>>Single Faced
                                                    </option>

                                                </select>
                                            </fieldset>
                                        </td>
                                        {{-- Open Area Percentage --}}
                                        <td>
                                            <input type="text" name="XLEW_1_12_3" id="XLEW_1_12_3" value="{{ $project->open_area_percentage }}"   onchange="this.value=eedisplayPercentND(eeparsePercent(this.value),0);recalc_onclick('XLEW_1_12_3')">
                                        </td>
                                        {{-- Post Shape --}}
                                        <td>
                                            <fieldset id="FS1$XLEW_1_14_3">
                                                <select name="XLEW_1_14_3" id="XLEW_1_14_3" onchange="recalc_onclick('XLEW_1_14_3')">
                                                    <option data-value="s:Square" {{ $project->post_shape == 'Square' ? 'selected' : '' }}>Square</option>
                                                    <option data-value="s:Round" {{ $project->post_shape == 'Round' ? 'selected' : '' }}>Round</option>
                                                    <option data-value="s:Rect" {{ $project->post_shape == 'Rect' ? 'selected' : '' }}>Rect</option>
                                                </select>
                                            </fieldset>
                                        </td>
                                        {{-- Post Size --}}
                                        <td>
                                            <fieldset id="FS1$XLEW_1_15_3">
                                                <select name="XLEW_1_15_3" id="XLEW_1_15_3" onchange="recalc_onclick('XLEW_1_15_3')">
                                                    <option  data-value='s:[Dynamic Dropdown]'>[Dynamic Dropdown]</option>
                                                </select>
                                            </fieldset>
                                            <input id='XLEW_1_15_5' type='hidden' name='XLEW_1_15_5' value='' readonly='readonly'/>
                                        </td>
                                        {{-- Material --}}
                                        <td>
                                            <fieldset id="FS1$Grade">
                                                <select name="Grade" id="Grade" onchange="recalc_onclick('Grade')">
                                                    <option data-value="s:A500 Grade B, Round" {{ $project->material == 'A500 Grade B, Round' ? 'selected' : '' }}>A500 Grade B, Round</option>
                                                    <option data-value="s:A500 Grade B, Square" {{ $project->material == 'A500 Grade B, Square' ? 'selected' : '' }}>A500 Grade B, Square</option>
                                                    <option data-value="s:A36" {{ $project->material == 'A36' ? 'selected' : '' }}>A36</option>
                                                    <option data-value="s:3003-H14" {{ $project->material == '3003-H14' ? 'selected' : '' }}>3003-H14</option>
                                                    <option data-value="s:6061-T6" {{ $project->material == '6061-T6' ? 'selected' : '' }}>6061-T6</option>
                                                    <option data-value="s:6063-T5" {{ $project->material == '6063-T5' ? 'selected' : '' }}>6063-T5</option>
                                                    <option data-value="s:6063-T6" {{ $project->material == '6063-T6' ? 'selected' : '' }}>6063-T6</option>
                                                    <option data-value="s:6061- T6 W" {{ $project->material == '6061- T6 W' ? 'selected' : '' }}>6061- T6 W</option>
                                                </select>
                                            </fieldset>
                                        </td>
                                        {{-- Quantity --}}
                                        <td>
                                            <input type="text" name="XLEW_1_18_3" id="XLEW_1_18_3" value="{{ $project->quantity }}" onchange="this.value=eedisplayFloatV(eeparseFloatV(this.value));recalc_onclick('XLEW_1_18_3')">
                                        </td>
                                        {{-- Diameter --}}
                                        <td>
                                            <fieldset id='FS1$Dia'>
                                                <select name='Dia' id='Dia' onchange="recalc_onclick('Dia')">
                                                    <option data-value='n:0.375' {{ $project->diameter == '0.375' ? 'selected' : '' }}>0.375</option>
                                                    <option data-value='n:0.5' {{ $project->diameter == '0.5' ? 'selected' : '' }}>0.5</option>
                                                    <option data-value='n:0.5625' {{ $project->diameter == '0.5625' ? 'selected' : '' }}>0.5625</option>
                                                    <option data-value='n:0.625' {{ $project->diameter == '0.625' ? 'selected' : '' }}>0.625</option>
                                                    <option data-value='n:0.75' {{ $project->diameter == '0.75' ? 'selected' : '' }}>0.75</option>
                                                    <option data-value='n:0.875' {{ $project->diameter == '0.875' ? 'selected' : '' }}>0.875</option>
                                                    <option data-value='n:1' {{ $project->diameter == '1' ? 'selected' : '' }}>1</option>
                                                    <option data-value='n:1.125' {{ $project->diameter == '1.125' ? 'selected' : '' }}>1.125</option>
                                                    <option data-value='n:1.25' {{ $project->diameter == '1.25' ? 'selected' : '' }}>1.25</option>
                                                    <option data-value='n:1.5' {{ $project->diameter == '1.5' ? 'selected' : '' }}>1.5</option>
                                                    <option data-value='n:1.75' {{ $project->diameter == '1.75' ? 'selected' : '' }}>1.75</option>
                                                    <option data-value='n:2' {{ $project->diameter == '2' ? 'selected' : '' }}>2</option>
                                                    <option data-value='n:2.25' {{ $project->diameter == '2.25' ? 'selected' : '' }}>2.25</option>
                                                    <option data-value='n:2.5' {{ $project->diameter == '2.5' ? 'selected' : '' }}>2.5</option>
                                                    <option data-value='n:2.75' {{ $project->diameter == '2.75' ? 'selected' : '' }}>2.75</option>
                                                </select>
                                            </fieldset>

                                        </td>
                                        {{-- Grade --}}
                                        <td>
                                            <fieldset id='FS1$XLEW_1_20_3'>
                                                <select name='XLEW_1_20_3' id='XLEW_1_20_3' onchange="recalc_onclick('XLEW_1_20_3')">
                                                    <option data-value='s:F1554 (36)' {{ $project->grade == 'F1554 (36)' ? 'selected' : '' }}>F1554 (36)</option>
                                                    <option data-value='s:F1554 (55)' {{ $project->grade == 'F1554 (55)' ? 'selected' : '' }}>F1554 (55)</option>
                                                    <option data-value='s:F1554 (105)' {{ $project->grade == 'F1554 (105)' ? 'selected' : '' }}>F1554 (105)</option>
                                                    <option data-value='s:A307' {{ $project->grade == 'A307' ? 'selected' : '' }}>A307</option>
                                                    <option data-value='s:A36' {{ $project->grade == 'A36' ? 'selected' : '' }}>A36</option>
                                                    <option data-value='s:A572' {{ $project->grade == 'A572' ? 'selected' : '' }}>A572</option>
                                                    <option data-value='s:A588' {{ $project->grade == 'A588' ? 'selected' : '' }}>A588</option>
                                                </select>
                                            </fieldset>
                                            <input id='XLEW_1_20_5' type='hidden' readonly='readonly' value='' name='XLEW_1_20_5' />
                                        </td>
                                        {{-- Individual or Combined? --}}
                                        <td>
                                            <fieldset id='FS1$XLEW_1_22_3'>
                                                <select name='XLEW_1_22_3' id='XLEW_1_22_3' onchange="recalc_onclick('XLEW_1_22_3')">
                                                    <option  data-value='s:Individual' {{ $project->individual_or_combined == 'Individual' ? 'selected' : '' }}>Individual</option>
                                                    <option  data-value='s:Combined' {{ $project->individual_or_combined == 'Combined' ? 'selected' : '' }} >Combined</option>
                                                </select>
                                            </fieldset>
                                        </td>
                                        {{-- Adjust Length --}}
                                        <td>
                                            <input type="text" name="XLEW_1_23_3" id="XLEW_1_23_3" value="{{ $project->adjust_length }}" onchange="this.value=eedisplayFloatNDV(eeparseFloatV(this.value),2);recalc_onclick('XLEW_1_23_3')">
                                        </td>
                                        {{-- Width --}}
                                        <td>
                                            <input type="text" name="XLEW_1_24_3" id="XLEW_1_24_3" value="{{ $project->width }}" readonly="readonly">
                                            <input id='XLEW_1_24_6' type='hidden' readonly='readonly' value='' name='XLEW_1_24_6'/>
                                        </td>
                                        {{-- Depth --}}
                                        <td>
                                            <input type="text" name="XLEW_1_25_3" id="XLEW_1_25_3" value="{{ $project->depth }}" readonly="readonly">
                                            <input id='XLEW_1_25_6' type='hidden' readonly='readonly' name='XLEW_1_25_6'/>
                                        </td>
                                        {{-- Foundation Check --}}
                                        <td>
                                            <input id='XLEW_1_26_3' type='text' readonly='readonly' value='' name='XLEW_1_26_3'/>
                                        </td>
                                        {{-- Drill Diameter --}}
                                        <td>
                                            <input type="text" name="XLEW_1_28_3" id="XLEW_1_28_3" value="{{ $project->drill_diameter }}" onchange="this.value=eedisplayFloatNDV(eeparseFloatV(this.value),2);recalc_onclick('XLEW_1_28_3')">
                                        </td>
                                        <td>
                                            <input type="text" name="XLEW_1_29_3" id="XLEW_1_29_3" value="{{ $project->drill_depth }}" readonly="readonly">
                                        </td>
                                    </tr>
                                    <tr class="heading">
                                        <th colspan="8" class="border border-white border-l-white border-r-white border-b-white bg-[#49b747] text-white text-[18px] uppercase align-middle whitespace-pre-line p-[12px]">FASTENER SCHEDULE</th>
                                    </tr>
                                    <tr>
                                        <th class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] align-middle whitespace-pre-line border border-white border-r-white">Component</th>
                                        <th class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] align-middle whitespace-pre-line border border-white border-r-white">Structural Summary</th>
                                        <th class="text-white uppercase text-[14px] p-[12px] bg-[#49b747] align-middle whitespace-pre-line border border-white border-r-white">Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">Post Size</td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_31_3" type="text" readonly="readonly" value="" name="XLEW_1_31_3" class="monument_input_tags border-none bg-none outline-none w-full text-center leading-[1.5] min-h-[50px]"/>
                                    </td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_31_5" type="text" readonly="readonly" value="" name="XLEW_1_31_5" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5] min-h-[50px]"/>
                                    </td>
                                </tr>
                                <tr>
                                 <td class="border border-[#ccc] uppercase text-sm text-center">Post Burial Depth (ft)</td>
                                   <td class="border border-[#ccc] uppercase text-sm text-center leading-[1.5]">
                                       <input id="XLEW_1_32_3" type="text" readonly="readonly" value="0" name="XLEW_1_32_3" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px]"/>
                                   </td>
                                   <td class="border border-[#ccc] uppercase text-sm text-center"></td>
                                </tr>
                                <tr>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">Baseplate Size (in)</td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_33_3" type="text" readonly="readonly" value="" name="XLEW_1_33_3" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5] min-h-[50px]"/>
                                    </td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_33_5" type="text" readonly="readonly" value="" name="XLEW_1_33_5" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5] min-h-[50px]"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">Anchor Size (in)</td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_34_3" type="text" readonly="readonly" value="" name="XLEW_1_34_3" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5] min-h-[50px]"/>
                                    </td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_34_5" type="text" readonly="readonly" value="" name="XLEW_1_34_5" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5] min-h-[50px]"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">Anchor Embedment (in)</td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_35_3" type="text" readonly="readonly" value="0" name="XLEW_1_35_3" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5] min-h-[50px]"/>
                                    </td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center"></td>
                                </tr>
                                <tr>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">Augered Footing (ft)</td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_36_3" type="text" readonly="readonly" value="" name="XLEW_1_36_3" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5] min-h-[50px]"/>
                                    </td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_36_5" type="text" readonly="readonly" value="" name="XLEW_1_36_5" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5] min-h-[50px]"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-[#ccc] uppercase text-sm text-center min-h-[50px]">Spread Footing (ft)</td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_37_3" type="text" readonly="readonly" value="" name="XLEW_1_37_3" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5]"/>
                                    </td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_37_5" type="text" readonly="readonly" value="" name="XLEW_1_37_5" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5]"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-[#ccc] uppercase text-sm text-center min-h-[50px]">Spread Footing Rebar</td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center">
                                        <input id="XLEW_1_38_3" type="text" readonly="readonly" value="" name="XLEW_1_38_3" class="monument_input_tags border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5]"/>
                                    </td>
                                    <td class="border border-[#ccc] uppercase text-sm text-center"><input id="60ksiRebar" type="text" name="60ksiRebar" readonly="readonly" value="60ksi Rebar" class="border-none bg-none outline-none w-full text-center min-h-[50px] leading-[1.5]"/></td>
                                </tr>
                                </tbody>
                             </table>
                            </div>
                        </div>
                        <div class="p-[10px]">
                            <p class="text-[14px]">1) MINIMUM 1.5" EMBEDMENT INTO WOOD STUDS, OR MIN 1/4" PROTUDED FROM THE BACK OF
                                PLYWOOD.</p>
                            <p class="text-[14px]">2) MIN 1/4" PROTUDED FROM THE BACK OF METAL STUD.</p>
                            <p class="text-[14px]">3) MINIMUM 2.5" EMBEDMENT INTO WOOD STUDS, OR MIN 1/4" PROTUDED FROM THE BACK OF
                                PLYWOOD.</p>
                            <p class="text-[14px]">4) ANCHORS REQUIRE A MINIMUM 2" EMBEDMENT, ANCHOR SHALL BE INSTALLED IN CONCRETE
                                OR
                                GROUT FILLED CMU UNITS ONLY.</p>
                            <p class="text-[14px]">5) REQUIRES 2"x2"x1/4" STEEL BACKING PLATE.</p>
                            <p class="text-[14px]">6) USE HILTI HLC SLEEVE ANCHOR OR EQUIVALENT WITH 1-1/4" MIN EMBEDMENT.</p>
                            <p class="text-[14px]">7) USE HILTI KWIK HUS-E OR APPROVED EQUIVALENT WITH 1-5/8" MIN EMBEDMENT.</p>
                            <p class="text-[14px]">8) MINIMUM 20 GAUGE METAL THICKNESS.</p>
                            <p class="text-[14px]">9) THROUGH BLOCK FACE FOR CLAY BRICKS.</p>
                            <p class="text-[14px]">10) IF THE CONTRACTOR ENCOUNTERS A METAL/WOODEN STUD, HE/SHE SHALL FOLLOW THE
                                LAG/TEK
                                SCREW GUIDELINE AS SHOWN ON THE SCHEDULE ABOVE. THE CONTRACTOR SHALL MAKE EVERY
                                ATTEMPT TO USE STUDS WHENEVER POSSIBLE.</p>
                            <p class="text-[14px]">NOTE: THIS FASTENER SCHEDULE IS INTENDED FOR USE WITH SIGN CONNECTION TO BUILDING
                                ONLY. IT IS ASSUMED THAT THE BUILDING IS RIGID, FREE OF STRUCTURAL DEFECTS, AND
                                STRUCTURALLY SUFFICIENT TO CARRY THE LOAD OF THE SIGN. CONTRACTOR SHALL FOLLOW
                                FASTENER SCHEDULE TO DETERMINE FASTENER TYPE TO BE USED FOR INSTALLATION AND
                                SHALL
                                ENSURE THE FASTENER HAS A RIGID AND STRONG CONNECTION. CONTRACTOR SHALL FOLLOW
                                MANUFACTURERS SPECS FOR FASTENER/ANCHOR INSTALLATION. CONTRACTOR SHALL ENSURE
                                THAT
                                FASTENER BEARS ON WALL FACADE IMMEDIATELY AFTER INSTALLATION. CONTRACTOR SHALL
                                NOT
                                USE EXISTING HOLES PRESENT IN THE CURRENT FASCIA FOR FASTNER INSTALLATION.</p>
                        </div>
                    </div>
              @endif
           <div class="flex items-center justify-end pt-[15px] mt-0 mx-[-10px">
            <div class="print_btn">
                <a href="javascript:void(0);" class="block p-[15px_20px] mx-[10px] rounded-[6px] text-[14px] bg-[#374151] uppercase no-underline text-white font-bold" id="downloadPdf">
                    Artwork
                </a>
            </div>
            <div class="print_btn">
                <a href="javascript:void(0);" class="block p-[15px_20px] mx-[10px] rounded-[6px] text-[14px] bg-[#374151] uppercase no-underline text-white font-bold" onclick="printTable()">Print
                    Table</a>
            </div>
        </div>
    </div>
</div>

<script>
    var storeTableDataUrl = "{{ route('client.store.table_data') }}";
    var downloadPdfUrl = "{{ route('client.download.pdf', $project->id) }}";
    var csrfToken = "{{ csrf_token() }}";
    var projectWallType = "{{ $project->wall_type }}";
</script>

<script>
$(document).ready(function() {
    $("#downloadPdf").click(function(event) {
        event.preventDefault();
        let formData = {};

        $("textarea").each(function() {
            formData[$(this).attr("name")] = $(this).val();
        });

        $('body .monument_input_tags').each(function(){
            formData[$(this).attr("name")] = $(this).val();
        });

        formData._token = csrfToken;
        formData.wall_type = projectWallType;

        $.ajax({
            url: storeTableDataUrl,
            type: "POST",
            data: formData,
            success: function(response) {
               window.location.href = downloadPdfUrl;
            },
            error: function(xhr) {
                alert("Error saving data.");
            }
        });
    });
});


</script>

<script>
    function printTable() {
    document.querySelectorAll("textarea").forEach(textarea => {
        textarea.style.height = "auto"; 
        textarea.style.height = textarea.scrollHeight + "px";
    });

     printJS({
        printable: 'fastenerScheduleTable',
        type: 'html',
        style: `
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid #ccc;
                text-transform: uppercase;
                font-size: 14px;
                text-align: center;
            }
            thead th {
                text-transform: uppercase;
                font-size: 14px;
                text-align: center;
                padding: 12px 5px;
            }
            thead th textarea, 
            tbody td textarea {
                background-color: white;
                border: none;
                font-size: 14px;
                font-family: inherit;
                resize: none;
                min-height: 30px;
                text-align: center;
                outline: none;
                padding: 12px 5px;
                padding-top: 30px;
                line-height: 1.5;
            }
            tbody td input {
                  border: none;
                  outline: none;
            }
            .hidden_tr {
              display: none;
            }
           
        `,
        scanStyles: true
    });
}

     setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => alert.style.display = 'none');
    }, 3000);

    $('body').on('click', '.action-delete-btn', function (e) {
            var that = $(this);
            const deleteUrl = $(this).data('delete-url');
            const deleteId = $(this).data('project-id');
            Swal.fire({
                title: 'Are you sure want to delete?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'YES, DELETE IT!',
                cancelButtonText: 'NO, CANCEL'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                                'id': deleteId,
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data.success) {
                                let tableRowLen = $(that).closest('tr').parent('tbody').find('tr').length;
                                $(that).parents("tr").remove();
                                window.location.href = "{{route('client.project.list')}}";
                            }
                            else {
                                console.log('Error occured');
                            }
                        },
                         error: function (data) {
                            console.log(data.message);
                        }
                    });
                }
            })
        });
    var postSize = "{{$project->post_size}}";
        $(document).ready(function () {
            setTimeout(() => {
                $('#XLEW_3_15_4').val('Quantity Per Letter');
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
</script>
@endsection