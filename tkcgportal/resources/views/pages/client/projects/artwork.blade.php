@extends('layout.default')
@section('title', 'Artwork')
@section('content')
@php
  $sign_type =  $project->wall_type;
@endphp
<style>
.wrapper {
    width: 100%;
    max-width: 1600px;
    margin: 0 auto;
    padding: 0px 20px;
}

.main_container {
    display: flex;
}

td {
    padding: 5px;
    font-weight: 400;
}
.side_view_container {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: space-between;
    width: 30%;
}

.front_view_container {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: space-between;
    width: 70%;
}

/* Left Section */
.left-section {
    justify-content: space-between;
    display: flex;
    flex-wrap: wrap;
}

.box {
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    font-weight: bold;
}

.side_view_text,
.front_view_text {
    margin-top: 20px;
    font-size: 25px;
}

/* Right Section (Sidebar) */
.right-section {
    flex-basis: 20%;
}

.company-logo {
    font-size: 20px;
    font-weight: bold;
}

.table_container {
    overflow-x: auto;
}

.artwork-main-container {
    margin-top: 60px;
}

th {
    font-size: 12px !important;
    padding: 1px !important;
}

td {
    font-size: 12px !important;
    padding: 1px !important;
}

.table_container sup {
    font-size: 12px;
}

.table_container td {
    white-space: normal !important;
    padding: 12px 12px !important;
}

.ee151 {
    width: 100%;
    font-size: 12px;
    height: 16px;
    overflow: hidden;
}

.ee144 {
    font-size: 12px;
    color: #000;
}

#downloadPdf {
    cursor: pointer;
}

.table_container th {
    background-color: #d9d9d9;
    color: #000;
}

.table_container tbody tr:nth-child(even) {
    background-color: unset;
}



/* Responsive Styles */
@media (max-width: 1480px) {
    .top_box {
        flex-wrap: wrap;
    }

    .responsive_box {
        width: 100% !important;
    }

    .fastner_box {
        width: 100% !important;
    }
}

@media (max-width: 1200px) {
    .main_container {
        display: block;
    }

    .left-section {
        border-right: 2px solid #000 !important;
    }

    .company-logo {
        padding: 10px;
    }

    .company_desciption {
        min-height: unset !important;
    }
}

@media (max-width: 1024px) {
    .main_container {
        padding: 0px 0px;
    }
}

@media (max-width: 992px) {
    .box {
        padding: 10px;
    }
    .sign_geometry {
        margin-bottom: -10px !important;
        justify-content: flex-start !important;
    }
    .responsive_box {
        width: 100% !important;
    }
}

@media (max-width: 860px) {
    .artwork_drawing {
        min-width: unset !important;
    }
    .top_box {
        flex-wrap: wrap !important;
    }
    .sign_geometry {
        width: 100% !important;
    }
}

@media (max-width: 768px) {
    .main_container {
        flex-direction: column;
    }
    .left-section {
        grid-template-columns: 1fr;
        padding-right: 0;
    }
    .side_view_text,
    .front_view_text {
        font-size: 16px;
    }
    .table_container {
        overflow-x: auto;
    }
}

@media (max-width: 479px) {
    td {
        padding: 2px;
    }
    .bottom_box {
        flex-wrap: wrap;
        justify-content: center;
    }
    .front_view_container,
    .side_view_container {
        width: 100%;
        max-width: 250px;
    }
}
</style>
@php
    $artwork = \App\Helpers\CommonHelper::getPhotoById($project->artwork_image_id);
    $company_logo_id = App\Helpers\CommonHelper::getUserMeta(Auth::user()->id, 'CompanyLogoId');
    $company_logo = \App\Helpers\CommonHelper::getPhotoById($company_logo_id);
    $siteName= App\Helpers\CommonHelper::getUserMeta(Auth::user()->id, 'company_name');
@endphp

<meta name="csrf-token" content="{{ csrf_token() }}">

@if(strcmp($project->wall_type,'raceway') ==0)
<script src="{{ asset('public/js/raceway.min.js') }}"></script>
@endif
@if(strcmp($project->wall_type,'channel_letters') ==0)
<script src="{{ asset('public/js/channel-letters.min.js') }}"></script>
@endif
@if(strcmp($project->wall_type,'cabinet') ==0)
<script src="{{ asset('public/js/cabinet.min.js') }}"></script>
@endif

    <div class="artwork-main-container">
    <div class="list-header-container">
        <div class="list-header">
            <div class="back-btn-header">
                <a href="{{asset('client.project.list')}}"><img src="{{asset('public/images/arrow.svg')}}" alt=""> </a>
                <h2>Artwork</h2>
            </div>
        </div>

        <div>
            <a class="btn btn-primary" id="downloadPdf" >
                Download PDF
            </a>
        </div>
    </div>

     <div class="main_container wrapper">

    <!-- Left Section -->
    <div class="left-section" style="border: 2px solid #000; border-right: 0px;">

        <div class="top_box" style="display: flex; width: 100%;">

            <div class="box responsive_box" style="width:30%; height: 250px; overflow: hidden;">

                @if(!empty($artwork))
                    <img class="artwork_drawing" src="{{ $artwork->url }}" alt="artwork"
                        style="width: 100%; height: 100%; object-fit: contain; border: 1px solid #000;">
                @else
                    <div style="border: 1px solid #000; height: 100%; display: flex; align-items: center; justify-content: center; text-align: center;">
                        <p style="text-transform: uppercase;">Your Artwork Here</p>
                    </div>
                @endif

            </div>

            <div class="fastner_box" style="display: flex; width:70%; flex-direction: column;">

                <div class="middle_box" style="display: flex; width: 100%;">
                    <div class="box responsive_box" >
                        <div class="table_container">
                            <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; text-align: center; border: 1px solid black;  font-size: 12px;">

                                <tr style="display:none;">
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

                                <tr style="background: #ccc; font-weight: bold;">
                                    <th colspan="8" style="padding: 5px;font-size: 11px;border: 1px solid black;  font-size: 12px;">FASTENER SCHEDULE</th>
                                </tr>
                                <tr style="background: #ddd; font-weight: bold;">

                                    <th colspan="3" style="padding: 5px;font-size: 11px;border: 1px solid black;  font-size: 12px;">FASTENER</th>

                                    <th colspan="5" style="padding: 5px;font-size: 11px;border: 1px solid black;  font-size: 12px;">HORIZONTAL SPACING PER WALL CONSTRUCTION (INCHES)</th>
                                </tr>
                                <tr style="background: #ddd; font-weight: bold;" class="header_tr_w">
                                    <th style="padding: 5px;font-size: 11px;border: 1px solid black;  font-size: 12px;">HARDWARE</th>
                                    <th style="padding: 5px;font-size: 11px;border: 1px solid black;  font-size: 12px;">DIA.</th>
                                    <th style="padding: 5px;font-size: 11px;border: 1px solid black;  font-size: 12px;">
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
                                           <textarea id='{{$inputId}}' class='ee144' disabled
                                            onchange="recalc_onclick('{{$inputId}}')" onKeyDown="" name='{{$inputId}}'
                                            placeholder='' tabindex='-1'>""</textarea>
                                        </th>


                                    <th style="padding: 5px;font-size: 11px;border: 1px solid black;  font-size: 12px;">MASONRY</th>
                                    <th style="padding: 5px;font-size: 11px;border: 1px solid black;  font-size: 12px;">WOOD STUDS</th>
                                    <th style="padding: 5px;font-size: 11px;border: 1px solid black;  font-size: 12px;">EIFS/DRYVIT OVER 1/2" MIN PLYWOOD</th>
                                    <th style="padding: 5px;font-size: 11px;border: 1px solid black;  font-size: 12px;">EIFS/DRYVIT OVER 1/2" MIN GYPSUM/DENGLASS</th>
                                    <th style="padding: 5px;font-size: 11px;border: 1px solid black;  font-size: 12px;">METAL PANEL OVER METAL STUD</th>
                                </tr>


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
                                  <tr style="width:100%;">
                                        <td style="border: 1px solid black; font-size: 12px;">{{ $item[0] }}<sup>{{ $index + 1 }}</sup></td>
                                        <td style="border: 1px solid black; font-size: 12px;">{{ $item[1] }}</td>
                                        @for($i = 4; $i <= 9; $i++)
                                        <td style="border: 1px solid black; font-size: 12px;">
                                                <textarea id="XLEW_3_{{ 18 + $index }}_{{ $i }}" class="ee151" disabled
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
                                    <td style="border: 1px solid black; font-size: 12px;">{{ $item[0] }}<sup>{{ $index + 1 }}</sup></td>
                                    <td style="border: 1px solid black; font-size: 12px;">{{$item[1]}}</td>
                                    @for($i = 4; $i <= 9; $i++)
                                      <td style="border: 1px solid black; font-size: 12px;">
                                            <textarea id="XLEW_3_{{ 18 + $index }}_{{ $i }}" class="ee151" disabled
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
                                <td style="border: 1px solid black; font-size: 12px;">{{ $item[0] }}<sup>{{ $index + 1 }}</sup></td>
                                <td style="border: 1px solid black; font-size: 12px;">{{$item[1]}}</td>
                                @for($i = 4; $i <= 9; $i++)
                                  <td style="border: 1px solid black; font-size: 12px;">
                                        <textarea id="XLEW_3_{{ 18 + $index }}_{{ $i }}" class="ee151" disabled
                                            onchange="recalc_onclick('XLEW_3_{{ 16 + $index }}_{{ $i }}')" name="XLEW_3_{{ 16 + $index }}_{{ $i }}"
                                            tabindex="-1">{{ $i == 4 ? '0' : '""' }}</textarea>

                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    @endif
                    </table>
                        </div>
                        <div style="margin-top: 2px;">
                            <p style="text-align: left;font-size: 12px; font-weight: 400; font-style: italic; margin-bottom: 2px;">1) MINIMUM 1.5" EMBEDMENT INTO WOOD STUDS, OR MIN 1/4" PROTUDED FROM THE BACK OF PLYWOOD.</p>
                            <p style="text-align: left;font-size: 12px; font-weight: 400; font-style: italic; margin-bottom: 2px;">2) MIN 1/4" PROTUDED FROM THE BACK OF METAL STUD. MINIMUM 20 GAUGE METAL THICKNESS.</p>
                            <p style="text-align: left;font-size: 12px; font-weight: 400; font-style: italic; margin-bottom: 2px;">3) MINIMUM 2.5" EMBEDMENT INTO WOOD STUDS, OR MIN 1/4" PROTUDED FROM THE BACK OF PLYWOOD.</p>
                            <p style="text-align: left;font-size: 12px; font-weight: 400; font-style: italic; margin-bottom: 2px;">4) REQUIRES 2"x2"x1/4" STEEL BACKING PLATE.</p>
                            <p style="text-align: left;font-size: 12px; font-weight: 400; font-style: italic; margin-bottom: 2px;">5) USE HILTI HLC SLEEVE ANCHOR OR EQUIVALENT WITH 1-1/4" MIN EMBEDMENT. ANCHOR SHALL BE INSTALLED IN CONCRETE OR GROUT FILLED CMU UNITS ONLY.</p>
                            <p style="text-align: left;font-size: 12px; font-weight: 400; font-style: italic; margin-bottom: 2px;">6) USE HILTI KWIK HUS-E OR APPROVED EQUIVALENT WITH 1-5/8" MIN EMBEDMENT. ANCHOR SHALL BE INSTALLED IN CONCRETE OR GROUT FILLED CMU UNITS ONLY.</p>
                            <p style="text-align: left;font-size: 12px; font-weight: 400; font-style: italic; margin-bottom: 2px;">7) THROUGH BLOCK FACE FOR CLAY BRICKS.</p>
                            <p style="text-align: left;font-size: 12px; font-weight: 400; font-style: italic; margin-bottom: 2px;">8) STUDS TO BE 6061 ALUMINUM. MINIMUM SILICONE STRENGTH TO BE 300PSI.</p>
                            <p style="text-align: left;font-size: 12px; font-weight: 400; font-style: italic; margin-bottom: 10px;">9) IF THE CONTRACTOR ENCOUNTERS A METAL/WOODEN STUD, HE/SHE SHALL FOLLOW THE LAG/TEK SCREW GUIDELINE AS SHOWN ON THE SCHEDULE ABOVE. THE CONTRACTOR SHALL MAKE EVERY ATTEMPT TO USE STUDS WHENEVER POSSIBLE.</p>
                            <p style="text-align: left;font-size: 12px; font-weight: 400; font-style: italic; margin-bottom: 2px;"><b>NOTE:</b> THIS FASTENER SCHEDULE IS INTENDED FOR USE WITH SIGN CONNECTION TO BUILDING ONLY. IT IS ASSUMED THAT THE BUILDING IS RIGID, FREE OF STRUCTURAL DEFECTS, AND STRUCTURALLY SUFFICIENT TO CARRY THE LOAD OF THE SIGN. CONTRACTOR SHALL FOLLOW FASTENER SCHEDULE TO DETERMINE FASTENER TYPE TO BE USED FOR INSTALLATION AND SHALL ENSURE THE FASTENER HAS A RIGID AND STRONG CONNECTION. CONTRACTOR SHALL FOLLOW MANUFACTURERS SPECS FOR FASTENER/ANCHOR INSTALLATION. CONTRACTOR SHALL ENSURE THAT FASTENER BEARS ON WALL FACADE IMMEDIATELY AFTER INSTALLATION. CONTRACTOR SHALL NOT USE EXISTING HOLES PRESENT IN THE CURRENT FASCIA FOR FASTENER INSTALLATION.</p>
                        </div>
                    </div>
                </div >

                <div class="sign_geometry box" style=" display: flex;  width:100%;  justify-content:flex-end;">

                    <div style=" width:250px; ">
                    <table style=" border: 1px solid black; border-collapse: collapse; font-family: Arial, sans-serif; margin-top:0px;">
                        <tr>
                            <th colspan="3" style="border: 1px solid black; text-align: center; padding: 5px; background-color: #d9d9d9; color:#000;">
                                Sign Geometry
                            </th>
                        </tr>
                        @if(!empty($project->sign_height))
                        <tr>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align:center; text-transform: uppercase;">Sign Height</td>
                            <td style="border: 0; padding: 5px; text-align: center; font-size: 12px; text-transform: uppercase;">{{$project->sign_height}}</td>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align:center; text-transform: uppercase;">ft</td>
                        </tr>
                        @endif

                        @if(!empty($project->sign_length))
                        <tr>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align:center; text-transform: uppercase;">Sign Length</td>
                            <td style="border: 0; padding: 5px; text-align: center; font-size: 12px; text-transform: uppercase;">{{$project->sign_length}}</td>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align:center; text-transform: uppercase;">ft</td>
                        </tr>
                        @endif
                        @if(!empty($project->sign_depth))
                        <tr>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align:center; text-transform: uppercase;">Sign Depth</td>
                            <td style="border: 0; padding: 5px; text-align: center; font-size: 12px; text-transform: uppercase;">{{$project->sign_depth}}</td>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align:center; text-transform: uppercase;">ft</td>
                        </tr>
                        @endif
                        @if(!empty($project->block_depth))
                        <tr>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align:center; text-transform: uppercase;">Raceway Depth</td>
                            <td style="border: 0; padding: 5px; text-align: center; font-size: 12px; text-transform: uppercase;">{{$project->block_depth}}</td>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align:center; text-transform: uppercase;">ft</td>
                        </tr>
                        @endif
                        @if(!empty($project->block_height))
                        <tr>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align:center; text-transform: uppercase;">Raceway Height</td>
                            <td style="border: 0; padding: 5px; text-align: center; font-size: 12px; text-transform: uppercase;">{{$project->block_height}}</td>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align: center; text-transform: uppercase;">ft</td>
                        </tr>
                        @endif
                        @if(!empty($project->sign_installation_height))
                        <tr>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align:center; text-transform: uppercase;">Installation Height</td>
                            <td style="border: 0; padding: 5px; text-align: center; font-size: 12px; text-transform: uppercase;">{{$project->sign_installation_height}}</td>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align: center; text-transform: uppercase;">ft</td>
                        </tr>
                        @endif
                        @if(!empty($project->weight))
                        <tr>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align:center; text-transform: uppercase;">Approximate Weight</td>
                            <td style="border: 0; padding: 5px; text-align: center; font-size: 12px; text-transform: uppercase;">{{ $project->weight }}</td>
                            <td style="border: 0; padding: 5px; font-size: 12px; text-align: center; text-transform: uppercase;">lbs</td>
                        </tr>
                        @endif
                    </table>
                    </div>
                </div>


            </div>
        </div>



        <div class="bottom_box" style="display: flex; width: 100%; padding-top: 10px; padding-bottom: 10px; padding-left: 10px;">
            @if(strcmp($project->wall_type, 'raceway') == 0)
                <img style="width: 80%; max-width: 800px;" src="{{asset('public/images/raceway/raceway-drawing-pdf.png')}}" alt="">
            @endif

            @if(strcmp($project->wall_type, 'cabinet') == 0)
            <img style="width: 80%; max-width: 800px;" src="{{asset('public/images/cabinet/cabinet-drawing-pdf.png')}}" alt="">
            @endif

            @if(strcmp($project->wall_type, 'channel_letters') == 0)
            <img style="width: 80%; max-width: 800px;" src="{{asset('public/images/channel-letters/channel-letters-pdf.png')}}" alt="">
           @endif
        </div>
    </div>

    <!-- Right Section (Sidebar) -->
    <div class="right-section" style="border: 2px solid #000; ">
        <div class="company-logo" style="display: flex; justify-content: center; border-bottom: 1px solid #000;">
            <img src="{{asset('public/images/site_logo.jpg')}}" style="max-width: 250px;" alt="">
        </div>
        <div class="company_desciption" style="border-bottom: 1px solid #000; padding: 10px; min-height:350px">
            <p style="font-size: 12px;">THIS DRAWING WAS CREATED BY TKCG
                DESIGN ASSISTANT AND MAY NOT BY
                MODIFIED WITHOUT WRITTEN
                APPROVAL FROM TKCG. THIS DRAWING
                HAS NOT BEEN REVIEWED BY A
                PROFESSIONAL ENGINEER UNLESS A
                PE STAMP IS PRESENT.</p>
        </div>
        <div class="company-logo" style="display: flex; justify-content: center; align-items: center; border-bottom: 1px solid #000; min-height: 200px;">
            @if($company_logo)
                <img src="{{ $company_logo->url }}"
                     style="width: 100%; height: auto; max-width: 250px; max-height: 200px; object-fit: contain;"
                     alt="Company Logo">
            @else
                <p style="width: 100%; max-width: 250px; height: 200px; display: flex; align-items: center; justify-content: center; margin: 0; text-align: center; text-transform:uppercase;">
                    Company logo
                </p>
            @endif
        </div>
        <div style="font-family: Arial, sans-serif;">
            <div style="border-bottom: 2px solid black; padding: 4px;">
                <strong style="font-size: 15px;">DESIGN CRITERIA</strong>
                <table style="width: 100%; font-size: 12px; margin-top: 5px; border-collapse: collapse;">
                    @if (!empty($project->wind_speed))
                    <tr>
                        <td style="text-align: left; padding: 2px 0px; border: none;">WIND SPEED</td>
                        <td style="text-align: center; padding: 2px 0px; border: none;">{{ $project->wind_speed }}</td>
                        <td style="text-align: center; padding-top:2px; padding-right: 4px; border: none;">MPH</td>
                    </tr>
                @endif

                @if (!empty($project->snow_load))
                    <tr>
                        <td style="text-align: left; padding: 2px 0px; border: none;">SNOW LOAD</td>
                        <td style="text-align: center; padding: 2px 0px; border: none;">{{ $project->snow_load }}</td>
                        <td style="text-align: center; padding-top:2px; padding-right: 4px; border: none;">PSF</td>
                    </tr>
                @endif

                @if (!empty($project->ice))
                    <tr>
                        <td style="text-align: left; padding: 2px 0px; border: none;">ICE LOAD</td>
                        <td style="text-align: center; padding: 2px 0px; border: none;">{{ $project->ice }}</td>
                        <td style="text-align: center; padding-top:2px; padding-right: 4px; border: none;">INCH</td>
                    </tr>
                @endif

                @if (!empty($project->exposure_cate))
                    <tr>
                        <td style="text-align: left; padding: 2px 0px; border: none;">EXPOSURE CATEGORY</td>
                        <td style="text-align: center;  padding: 2px 0px; border: none;">{{ $project->exposure_cate }}</td>
                        <td style="border: none;"></td>
                    </tr>
                @endif

                @if (!empty($project->risk_category))
                    <tr>
                        <td style="text-align: left; padding: 2px 0px; border: none;">RISK CATEGORY</td>
                        <td style="text-align: center;  padding: 2px 0px; border: none;">{{ $project->risk_category }}</td>
                        <td style="border: none;"></td>
                    </tr>
                @endif
                </table>
            </div>

            <div style="border-bottom: 2px solid black; padding:4px;">
                <strong style="font-size: 15px;">DESIGN CODES:</strong><br>
                <p style="font-size: 12px; margin-top: 5px;">
                    @if($project->building_code)
                        {{$project->building_code}}<br>
                    @endif
                    @if($project->ASCE_code)
                    {{$project->ASCE_code}}<br>
                   @endif
                    AISC 16TH EDITION<br>
                    ALUMINUM DESIGN MANUAL 2020
                </p>
            </div>
            <div style="border-bottom: 2px solid black; padding: 10px 4px;">
                <div>
                    <strong style="font-size: 12px; float: left;">PROJECT NAME:</strong><p style="font-size: 12px; float: right;">{{$project->name}}</p><br>
                </div>
                @if(!empty($siteName))
                <div>
                <strong style="font-size: 12px; float: left;">SITE NAME:</strong><p style="font-size: 12px; float: right;">{{$siteName}}</p><br>
                </div>
                @endif
                <!--- get company name from user meta -->
            </div>
            @if(!empty($project->street) || !empty($project->city) ||!empty($project->state))
            <div style="border-bottom: 2px solid black; padding: 2px 4px;">
                <strong style="font-size: 15px;">ADDRESS:</strong>
                @if(!empty($project->street))
                <div style="margin-top: 5px;">
                    <p style="font-size: 12px; float: left; padding: 2px 0px;">STREET:</p><p style="font-size: 12px; float: right;">{{$project->street}}</p><br>
                </div>
                @endif
                @if(!empty($project->city))
                 <div>
                    <p style="font-size: 12px; float: left; padding: 2px 0px;">CITY:</p><p style="font-size: 12px; float: right;">{{$project->city}}</p><br>
                 </div>
                 @endif
                 @if(!empty($project->state))
                 <div>
                    <p style="font-size: 12px; float: left; padding: 2px 0px;">STATE:</p><p style="font-size: 12px; float: right;">{{$project->state}}</p><br>
                 </div>
                 @endif
            </div>
            @endif
            <div style="border-bottom: 2px solid black; padding: 10px 4px;">
                <strong style="font-size: 15px;">SCALE:</strong><br>
                <p style="font-size: 12px;">NOT TO SCALE</p>
            </div>

            <div style="border-bottom: 2px solid black; padding: 10px 4px;">
                <strong style="font-size: 15px;">SHEET NAME:</strong><br>
                <p style="font-size: 12px;">
                    SIGN MOUNTING DETAIL
                </p>
            </div>

            <div style="padding: 4px 4px;">
                <p style="text-align: left; font-size: 12px;">DRAWING NUMBER:</p>
                <p style="font-size: 32px; font-weight: bold; text-align: center; padding: 25px 0px;">
                    DETAIL
                </p>
            </div>

        </div>

    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#downloadPdf").click(function(event) {
        event.preventDefault();
        let formData = {};
        $("textarea").each(function() {
            formData[$(this).attr("name")] = $(this).val();
        });
        formData._token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('client.store.table_data') }}",
            type: "POST",
            data: formData,
            success: function(response) {
            console.log("response",response)
                window.location.href = "{{ route('client.download.pdf', $project->id) }}";
            },
            error: function(xhr) {
                alert("Error saving data.");
            }
        });
    });
});
</script>
@endsection
