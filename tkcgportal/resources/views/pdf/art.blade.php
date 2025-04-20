<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artwork PDF</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        .afclr:after { clear: both; float: none; display: block; content: ""; }
        .header_tr_w th:first-child { min-width: 160px; }
        .header_tr_w th { max-width: 80px; }
        .monument_input_tags{
            border: none;
            background: none;
            outline: none;
        }
    </style>
</head>
@php
    $artwork = \App\Helpers\CommonHelper::getPhotoById($project->artwork_image_id);
    $company_logo_id = App\Helpers\CommonHelper::getUserMeta($project->userId, 'CompanyLogoId');
    $company_logo = \App\Helpers\CommonHelper::getPhotoById($company_logo_id);
    $siteName= App\Helpers\CommonHelper::getUserMeta($project->userId, 'company_name');
@endphp

<body style="font-family: lato, sans-serif;">
    <div style="background-color: #fff;  margin-top:10px;  margin-bottom:10px;">
        <div style="display: table; width: 99%; border: 2px solid #000000;  margin:0 auto;">
            <!-- Left Artwork Section -->
            <div style="display: table-cell; width: calc(100% - 240px); vertical-align: top; padding: 5px; text-align: center; margin-left: 5px;">

                <div style="display: block; width: 100%;" class="afclr">
                    <!-- Artwork image start -->
                    <div style="width: 59%; display: block; float: left; position: relative;">
                        <div style="display: block; width: 100%; text-align: center;">
                            @if(!empty($artwork->url))
                                <img src="{{ $artwork->url }}" alt="Artwork Image"
                                    style="width: 100%; max-height:456px; max-width:840px; display: block;">
                            @else
                                  <div
                                        style="height: 430px; width: 100%; position: relative; border: 1px solid #ccc; padding: 1px; box-sizing: border-box;">
                                        <u style="text-transform: uppercase; color: #000; font-size: 18px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); margin: 0;">
                                            No Artwork Provided</u>
                                    </div>
                            @endif
                        </div>
                    </div>
                    <!-- Artwork image end -->

                    <!-- Fastener schedule table start -->
                    <div style="width: 40%; display: block; float: right;" class="afclr">
                        <div style="width: 100%; display: block;">
                            <table style="width: 100%; border-collapse: collapse;">
                                @if($project->wall_type =='raceway' || $project->wall_type == 'channel_letters' || $project->wall_type == 'cabinet')
                                <thead>
                                    <tr>
                                        <th colspan="8"
                                            style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size:8px;">
                                            FASTENER SCHEDULE</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3"
                                            style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                            FASTENER</th>
                                        <th colspan="5"
                                            style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                            HORIZONTAL SPACING PER WALL CONSTRUCTION (INCHES)</th>
                                    </tr>
                                    <tr class="header_tr_w">
                                        <th
                                            style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; min-width: 160px;">
                                            HARDWARE</th>
                                        <th
                                            style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                            DIA</th>
                                        <th
                                            style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                            Quantity Per Letter</th>
                                        <th
                                            style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                            MASONRY</th>
                                        <th
                                            style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                            WOOD STUDS</th>
                                        <th
                                            style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                            EIFS/DRYVIT OVER 1/2" MIN PLYWOOD</th>
                                        <th
                                            style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                            EIFS/DRYVIT OVER 1/2" MIN GYPSUM/DENGLASS</th>
                                        <th
                                            style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                            METAL PANEL OVER METAL STUD</th>
                                    </tr>
                                </thead>
                                @endif
                                 @if($project->wall_type == 'double-post-full-height' ||
                                 $project->wall_type == 'single-post-full-height' ||
                                 $project->wall_type == 'double-post-with-cabinet' ||
                                 $project->wall_type == 'single-post-with-cabinet' ||
                                 $project->wall_type == 'post-and-panel' ||
                                 $project->wall_type == 'double-post-covered' ||
                                 $project->wall_type == 'single-post-covered')
                                 <thead>
                                    <tr style="display: none;">
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
                                                    <option  data-value='s:[Dynamic Dropdown]' selected >[Dynamic Dropdown]</option>
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
                                         {{-- Drill Depth --}}
                                        <td>
                                            <input type="text" name="XLEW_1_29_3" id="XLEW_1_29_3" value="{{ $project->drill_depth }}" readonly="readonly">
                                        </td>
                                    </tr>
                                <tr>
                                    <th style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">Component</th>
                                    <th style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">Structural Summary</th>
                                    <th style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">Grade</th>
                                </tr>
                              </thead>
                                @endif

                                <tbody>
                                    @if (strcmp($project->wall_type, 'raceway') == 0)
                                        @php
                                            $screws = [
                                                ['name' => 'WOOD SCREW', 'size' => '#10', 'prefix' => 'XLEW_3_18'],
                                                ['name' => 'TEK SCREW', 'size' => '#10', 'prefix' => 'XLEW_3_19'],
                                                ['name' => 'LAG BOLT', 'size' => '3/8"', 'prefix' => 'XLEW_3_20'],
                                                ['name' => 'THRU-BOLT', 'size' => '3/8"', 'prefix' => 'XLEW_3_21'],
                                                ['name' => 'EXPANSION ANCHOR', 'size' => '3/8"', 'prefix' => 'XLEW_3_22'],
                                                ['name' => 'CARBON STEEL SCREW ANCHOR', 'size' => '3/8"', 'prefix' => 'XLEW_3_23'],
                                                ['name' => 'TOGGLE BOLT', 'size' => '3/8"', 'prefix' => 'XLEW_3_24'],
                                                ['name' => 'ALUMINUM STUDS', 'size' => '1/4"', 'prefix' => 'XLEW_3_25'],
                                            ];
                                        @endphp
                                        @foreach ($screws as $index => $screw)
                                            <tr style="width:100%;">
                                                <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                                    {{ $screw['name'] }}<sup>{{ $index + 1 }}</td>
                                                <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                                    {{ $screw['size'] }}</td>

                                                @for ($i = 4; $i <= 9; $i++)
                                                    <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                                        {{ $table_data[$screw['prefix'] . "_$i"] ?? 'N/A' }}
                                                    </td>
                                                @endfor
                                            </tr>
                                        @endforeach
                                    @endif


                                    @if (in_array($project->wall_type, ['channel_letters', 'cabinet']))
                                        <tr>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">Channel WOOD SCREW¹</td>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">#10</td>
                                            @foreach (['XLEW_3_16_4', 'XLEW_3_16_5', 'XLEW_3_16_6', 'XLEW_3_16_7', 'XLEW_3_16_8', 'XLEW_3_16_9'] as $key)
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">
                                                    {{ $table_data[$key] ?? 'N/A' }}
                                                </td>
                                            @endforeach
                                        </tr>

                                        <tr>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">TEK SCREW<sup>2</sup></td>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">#12</td>
                                            @foreach (['XLEW_3_17_4', 'XLEW_3_17_5', 'XLEW_3_17_6', 'XLEW_3_17_7', 'XLEW_3_17_8', 'XLEW_3_17_9'] as $key)
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">

                                                {{ $table_data[$key] ?? 'N/A' }}</td>
                                            @endforeach
                                        </tr>

                                        <tr>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">LAG BOLT<sup>3</sup></td>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">3/8"</td>
                                            @foreach (['XLEW_3_18_4', 'XLEW_3_18_5', 'XLEW_3_18_6', 'XLEW_3_18_7', 'XLEW_3_18_8', 'XLEW_3_18_9'] as $key)
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">
                                                {{ $table_data[$key] ?? 'N/A' }}  </td>
                                            @endforeach
                                        </tr>

                                        <tr>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">THRU-BOLT<sup>4</sup></td>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">3/8"</td>
                                            @foreach (['XLEW_3_19_4', 'XLEW_3_19_5', 'XLEW_3_19_6', 'XLEW_3_19_7', 'XLEW_3_19_8', 'XLEW_3_19_9'] as $key)
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">
                                                    {{ $table_data[$key] ?? 'N/A' }}
                                                </td>
                                            @endforeach
                                        </tr>

                                        <tr>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">EXPANSION
                                                ANCHOR<sup>5</sup></td>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">3/8"</td>
                                            @foreach (['XLEW_3_20_4', 'XLEW_3_20_5', 'XLEW_3_20_6', 'XLEW_3_20_7', 'XLEW_3_20_8', 'XLEW_3_20_9'] as $key)
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">
                                                    {{ $table_data[$key] ?? 'N/A' }}
                                                </td>
                                            @endforeach
                                        </tr>

                                        <tr>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">CARBON STEEL SCREW
                                                ANCHOR<sup>6</sup>
                                            </td>
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">3/8"</td>
                                            @foreach (['XLEW_3_21_4', 'XLEW_3_21_5', 'XLEW_3_21_6', 'XLEW_3_21_7', 'XLEW_3_21_8', 'XLEW_3_21_9'] as $key)
                                                <td style="border: 1px solid black; font-size: 8px; text-align:center;">
                                                    {{ $table_data[$key] ?? 'N/A' }}
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black;  font-size: 8px;  font-size: 8px; text-align:center;">TOGGLE
                                                BOLT<sup>7</sup></td>
                                            <td style="border: 1px solid black;  font-size: 8px; text-align:center;">3/8"</td>

                                            @foreach (['XLEW_3_22_4', 'XLEW_3_22_5', 'XLEW_3_22_6', 'XLEW_3_22_7', 'XLEW_3_22_8', 'XLEW_3_22_9'] as $key)
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">
                                                    {{ $table_data[$key] ?? 'N/A' }}
                                                </td>
                                            @endforeach

                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black;  font-size: 8px;  font-size: 8px; text-align:center;">ALUMINUM
                                                STUDS<sup>8</sup></td>
                                            <td style="border: 1px solid black;  font-size: 8px; text-align:center;">1/4"</td>

                                            @foreach (['XLEW_3_23_4', 'XLEW_3_23_5', 'XLEW_3_23_6', 'XLEW_3_23_7', 'XLEW_3_23_8', 'XLEW_3_23_9'] as $key)
                                            <td style="border: 1px solid black; font-size: 8px; text-align:center;">
                                                    {{ $table_data[$key] ?? 'N/A' }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endif

                                    @if($project->wall_type == 'double-post-full-height' ||
                                    $project->wall_type == 'single-post-full-height' ||
                                    $project->wall_type == 'double-post-with-cabinet' ||
                                    $project->wall_type == 'single-post-with-cabinet' ||
                                    $project->wall_type == 'post-and-panel' ||
                                    $project->wall_type == 'double-post-covered' ||
                                    $project->wall_type == 'single-post-covered')
                                     <tr>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">Post Size</td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_31_3" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_31_3'] ?? '' }}" name="XLEW_1_31_3" class="monument_input_tags"/>
                                        </td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_31_5" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_31_5'] ?? '' }}" name="XLEW_1_31_5" class="monument_input_tags"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">Post Burial Depth (ft)</td>
                                       <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                           <input id="XLEW_1_32_3" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_32_3'] ?? '' }}" name="XLEW_1_32_3" class="monument_input_tags"/>
                                       </td>
                                       <td style="border: 1px solid black; font-size: 8px; text-align: center;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">Baseplate Size (in)</td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_33_3" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_33_3'] ?? '' }}" name="XLEW_1_33_3" class="monument_input_tags"/>
                                        </td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_33_5" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_33_5'] ?? '' }}" name="XLEW_1_33_5" class="monument_input_tags"/>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">Anchor Size (in)</td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_34_3" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_34_3'] ?? '' }}" name="XLEW_1_34_3" class="monument_input_tags"/>
                                        </td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_34_5" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_34_5'] ?? '' }}" name="XLEW_1_34_5" class="monument_input_tags"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">Anchor Embedment (in)</td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_35_3" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_35_3'] ?? '' }}" name="XLEW_1_35_3" class="monument_input_tags"/>
                                        </td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">Augered Footing (ft)</td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_36_3" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_36_3'] ?? '' }}" name="XLEW_1_36_3" class="monument_input_tags"/>
                                        </td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_36_5" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_36_5'] ?? '' }}" name="XLEW_1_36_5" class="monument_input_tags"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">Spread Footing (ft)</td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_37_3" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_37_3'] ?? '' }}" name="XLEW_1_37_3" class="monument_input_tags"/>
                                        </td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_37_5" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_37_5'] ?? '' }}" name="XLEW_1_37_5" class="monument_input_tags"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">Spread Footing Rebar</td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">
                                            <input id="XLEW_1_38_3" type="text" readonly="readonly" value="{{ $table_data['XLEW_1_38_3'] ?? '' }}" name="XLEW_1_38_3" class="monument_input_tags"/>
                                        </td>
                                        <td style="border: 1px solid black; font-size: 8px; text-align: center;">60ksi Rebar</td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                            <div style="width: 100%; display: block;">
                                <div style="width: 100%; display: block;">
                                    <p style="text-align:left; font-size: 8px; padding:2px 0px;">1) MINIMUM 1.5"
                                        EMBEDMENT INTO WOOD STUDS, OR MIN 1/4" PROTUDED FROM THE BACK OF PLYWOOD.</p>
                                    <p style="text-align:left; font-size: 8px; padding:2px 0px;">2) MIN 1/4" PROTUDED
                                        FROM THE BACK OF METAL STUD. MINIMUM 20 GAUGE METAL THICKNESS.</p>
                                    <p style="text-align:left; font-size: 8px; padding:2px 0px;">3) MINIMUM 2.5"
                                        EMBEDMENT INTO WOOD STUDS, OR MIN 1/4" PROTUDED FROM THE BACK OF PLYWOOD.</p>
                                    <p style="text-align:left; font-size: 8px; padding:2px 0px;">4) REQUIRES 2"x2"x1/4"
                                        STEEL BACKING PLATE.</p>
                                    <p style="text-align:left; font-size: 8px; padding:2px 0px;">5) USE HILTI HLC SLEEVE
                                        ANCHOR OR EQUIVALENT WITH 1-1/4" MIN EMBEDMENT. ANCHOR SHALL BE INSTALLED IN
                                        CONCRETE OR GROUT FILLED CMU UNITS ONLY.</p>
                                    <p style="text-align:left; font-size: 8px; padding:2px 0px;">6) USE HILTI KWIK HUS-E
                                        OR APPROVED EQUIVALENT WITH 1-5/8" MIN EMBEDMENT. ANCHOR SHALL BE INSTALLED IN
                                        CONCRETE OR GROUT FILLED CMU UNITS ONLY.</p>
                                    <p style="text-align:left; font-size: 8px; padding:2px 0px;">7) THROUGH BLOCK FACE
                                        FOR CLAY BRICKS.</p>
                                    <p style="text-align:left; font-size: 8px; padding:2px 0px;">8) STUDS TO BE 6061
                                        ALUMINUM. MINIMUM SILICONE STRENGTH TO BE 300PSI.</p>
                                    <p style="text-align:left; font-size: 8px; padding:2px 0px;">9) IF THE CONTRACTOR
                                        ENCOUNTERS A METAL/WOODEN STUD, HE/SHE SHALL FOLLOW THE LAG/TEK SCREW GUIDELINE
                                        AS SHOWN ON THE SCHEDULE ABOVE. THE CONTRACTOR SHALL MAKE EVERY ATTEMPT TO USE
                                        STUDS WHENEVER POSSIBLE.</p>

                                    <p style="text-align:left; font-size: 8px; padding:2px 0px; margin-top: 10px;">
                                        <strong>NOTE:</strong> THIS FASTENER SCHEDULE IS INTENDED FOR USE WITH SIGN
                                        CONNECTION TO BUILDING ONLY. IT IS ASSUMED THAT THE BUILDING IS RIGID, FREE OF
                                        STRUCTURAL DEFECTS, AND STRUCTURALLY SUFFICIENT TO CARRY THE LOAD OF THE SIGN.
                                        CONTRACTOR SHALL FOLLOW FASTENER SCHEDULE TO DETERMINE FASTENER TYPE TO BE USED
                                        FOR INSTALLATION AND SHALL ENSURE THE FASTENER HAS A RIGID AND STRONG
                                        CONNECTION. CONTRACTOR SHALL FOLLOW MANUFACTURERS SPECS FOR FASTENER/ANCHOR
                                        INSTALLATION. CONTRACTOR SHALL ENSURE THAT FASTENER BEARS ON WALL FACADE
                                        IMMEDIATELY AFTER INSTALLATION. CONTRACTOR SHALL NOT USE EXISTING HOLES PRESENT
                                        IN THE CURRENT FASCIA FOR FASTENER INSTALLATION.</p>
                                </div>
                            </div>

                        </div>
                        @if($project->wall_type =='raceway' || $project->wall_type == 'channel_letters' || $project->wall_type == 'cabinet')
                        <div style="width: 100%; display: block;" class="afclr">
                            <div style="width: 55%; float: right; margin-top: 10px;">
                                <table style="width: 100%; border-collapse: collapse; ">
                                    <thead>
                                        <tr>
                                            <th colspan="3"
                                                style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                                SIGN GEOMETRY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $geometry = [
                                                ['Sign Height', $project->sign_height, 'ft'],
                                                ['Sign Length', $project->sign_length, 'ft'],
                                                ['Sign Depth', $project->sign_depth, 'ft'],
                                            ];

                                            if ($project->wall_type == 'raceway') {
                                                $geometry[] = ['Raceway Depth', $project->block_depth, 'ft'];
                                                $geometry[] = ['Raceway Height', $project->block_height, 'ft'];
                                            }

                                            $geometry[] = ['Installation Height', $project->sign_installation_height, 'ft'];
                                            $geometry[] = ['Approximate Weight', $project->weight ? $project->weight : 'N/A', 'lbs'];
                                        @endphp

                                        @foreach ($geometry as $row)
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{ $row[0] }}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                                    {{ $row[1] }}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{ $row[2] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                        <div style="width: 100%; display: block;" class="afclr">
                            <div style="width: 65%; float: right; margin-top: 10px;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th colspan="3"
                                                style="background:#ccc; border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px;">
                                                SIGN GEOMETRY</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Total Height
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->total_height}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    ft
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Cabinet Width
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->cabinet_width}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    ft
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Cabinet Depth
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->cabinet_depth}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    ft
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Post Spacing
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->post_spacing}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    ft
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Post Shape
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->post_shape}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Post Size
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->post_size}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Material
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->material}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Quantity
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->quantity}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Diameter
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->diameter}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                in
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Grade
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->grade}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Individual or Combined?
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->individual_or_combined}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    Drill Diameter
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                    {{$project->drill_diameter}}
                                                </td>
                                                <td style="border: 1px solid #000; padding: 2px; text-align: center; font-size: 8px; text-transform: uppercase;">
                                                ft
                                                </td>
                                            </tr>
                                        </tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- Fastener schedule table end -->
                </div>
            @php
            $wallTypeImages = [
                'raceway' => 'public/images/raceway/raceway-drawing-pdf.png',
                'cabinet' => 'public/images/cabinet/cabinet-drawing-pdf.png',
                'channel_letters' => 'public/images/channel-letters/channel-letters-pdf.png',
                'double-post-full-height' => 'public/images/monument-pylon-sign/double-post-full-height/double-post-full-height01.png',
                'single-post-full-height' => 'public/images/monument-pylon-sign/single-post-full-height/single-post-full-height.png',
                'double-post-with-cabinet' => 'public/images/monument-pylon-sign/double-post-with-cabinet/double-post-with-cabinet.png',
                'single-post-with-cabinet' => 'public/images/monument-pylon-sign/single-post-with-cabinet/single-post-with-cabinet.png',
                'post-and-panel' => 'public/images/monument-pylon-sign/post-and-panel/post-and-panel.png',
                'double-post-covered' => 'public/images/monument-pylon-sign/double-post-covered/double-post-covered.png',
                'single-post-covered' => 'public/images/monument-pylon-sign/single-post-covered/single-post-covered.png',
             ];
            $specialWallTypes = [
                    'double-post-full-height',
                    'single-post-full-height',
                    'double-post-with-cabinet',
                    'single-post-with-cabinet',
                    'post-and-panel',
                    'double-post-covered',
                    'single-post-covered'
                ];
              $isSpecialWallType = in_array($project->wall_type, $specialWallTypes);
        @endphp

        @if(isset($wallTypeImages[$project->wall_type]))
            <div style="display: block; width: {{ $isSpecialWallType ? '100%' : '80%' }}; margin-top: {{ !empty($artwork->url) ? '170px' : '100px' }};" class="afclr">
            <div style="display: block; float: left; width: {{ $isSpecialWallType ? '60%' : '100%' }};">
                <img src="{{ asset($wallTypeImages[$project->wall_type]) }}"
                    alt="{{ ucfirst(str_replace('_', ' ', $project->wall_type)) }} Image"
                    style="display:block; width: 80%;">
            </div>

            @if($isSpecialWallType)
            <div style="display: block; float: right; width:40%;">
                <div style="display: inline-block; float: right; padding: 10px;">
                    <img src="{{ asset('public/images/monument-hardware-details/monument-hardware-details02.jpg') }}"
                    alt="HARDWARE OPTIONS FOR RACEWAY LETTERS MODEL"
                    style="display:block; width:100%;">
                </div>
            </div>
            @endif
        </div>
        @endif
        </div>

            <!-- Right Info Section -->
            <div style="display: table-cell; width: 240px; border-left: 2px solid #000000; text-align: center; padding-top: 5px;">

                <div style="padding: 5px; display: block;">
                        <img src="{{ asset('public/images/site_logo.jpg') }}" alt="Logo"
                        style="width: 100%; max-width: 100%; display: inline-block;">
                </div>

                <div style="border-top: 2px solid #000; padding: 10px 10px 160px 10px;">
                    <p style="font-size: 12px; text-align: left;">
                        THIS DRAWING WAS CREATED BY TKCG
                        DESIGN ASSISTANT AND MAY NOT BY
                        MODIFIED WITHOUT WRITTEN
                        APPROVAL FROM TKCG. THIS DRAWING
                        HAS NOT BEEN REVIEWED BY A
                        PROFESSIONAL ENGINEER UNLESS A
                        PE STAMP IS PRESENT.</p>
                </div>

                @if ($company_logo)
                <div style="border-top: 2px solid #000; padding: 2px; position: relative; height: 180px; width: 100%;">
                    @if (!empty($company_logo->url))
                        <img src="{{ $company_logo->url }}" alt="Additional Logo"
                             style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                    max-height: 100%; max-width: 100%; object-fit: contain;">
                    @else
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                    text-align: center; width: 100%;">
                            <p style="font-size: 10px;">PREPARED FOR</p>
                            <p style="text-transform: uppercase; color: #000; font-size: 18px; margin: 0;">
                                COMPANY LOGO
                            </p>
                        </div>
                    @endif
                </div>
            @endif


                <div style="border-top: 2px solid #000; padding: 2px;">
                    <table style="width: 100%; font-size: 9px; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: left; font-size: 9px; font-weight: bold;">DESIGN CRITERIA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($project->wind_speed))
                                <tr>
                                    <td style="text-align: left; padding: 2px 0px;">WIND SPEED</td>
                                    <td style="text-align: center; padding: 2px 0px;">{{ $project->wind_speed }}</td>
                                    <td style="text-align: center; padding-top:2px; padding-right: 4px;">MPH</td>
                                </tr>
                            @endif

                            @if (!empty($project->snow_load))
                                <tr>
                                    <td style="text-align: left; padding: 2px 0px;">SNOW LOAD</td>
                                    <td style="text-align: center; padding: 2px 0px;">{{ $project->snow_load }}</td>
                                    <td style="text-align: center; padding-top:2px; padding-right: 4px;">PSF</td>
                                </tr>
                            @endif

                            @if (!empty($project->ice))
                                <tr>
                                    <td style="text-align: left; padding: 2px 0px;">ICE LOAD</td>
                                    <td style="text-align: center; padding: 2px 0px;">{{ $project->ice }}</td>
                                    <td style="text-align: center; padding-top:2px; padding-right: 4px;">INCH</td>
                                </tr>
                            @endif

                            @if (!empty($project->exposure_cate))
                                <tr>
                                    <td style="text-align: left; padding: 2px 0px;">EXPOSURE CATEGORY</td>
                                    <td style="text-align: center; padding: 2px 0px;">{{ $project->exposure_cate }}</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endif

                            @if (!empty($project->risk_category))
                                <tr>
                                    <td style="text-align: left; padding: 2px 0px;">RISK CATEGORY</td>
                                    <td style="text-align: center; padding: 2px 0px;">{{ $project->risk_category }}</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>

                <div style="border-top: 2px solid #000; padding: 2px;">
                    <table style="width: 100%; font-size: 9px; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="text-align: left; font-size: 9px; font-weight: bold;">DESIGN CODES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($project->building_code)
                                <tr>
                                    <td style="text-align:left; padding: 2px 0px;">{{$project->building_code}}</td>
                                </tr>
                            @endif
                            @if($project->ASCE_code)
                            <tr>
                                <td style="text-align: left; padding: 2px 0px;">{{$project->ASCE_code}}</td>
                            </tr>
                        @endif
                            <tr>
                                <td style="text-align: left; padding: 2px 0px;">AISC 16TH EDITION</td>

                            </tr>
                            <tr>
                                <td style="text-align: left; padding: 2px 0px;">ALUMINUM DESIGN MANUAL 2020</td>

                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="border-top: 2px solid #000; padding: 2px;">
                    <table style="width: 100%; font-size: 9px; border-collapse: collapse;">
                        <tr>
                            <td style="text-align:left; padding: 2px 0px;">PROJECT NAME:</td>
                            <td style="text-align: right; padding: 2px 0px;">
                                {{ ucfirst($project->name) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; padding: 2px 0px;">SITE NAME:</td>
                            <td style="text-align: right; padding: 2px 0px;">{{$siteName}}</td>
                        </tr>
                    </table>
                </div>

                @if(!empty($project->street) || !empty($project->city) || !empty($project->state))
                    <div style="border-top: 2px solid #000; padding: 2px;">
                        <table style="width: 100%; font-size: 9px; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="text-align: left; font-size: 9px; font-weight: bold;">ADDRESS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left; padding: 2px 0px;">STREET:</td>
                                    @if(!empty($project->street))
                                    <td style="text-align: right; padding: 2px 0px;">
                                        {{ucfirst($project->street)}}
                                    </td>
                                    @endif
                                </tr>

                                    <tr>
                                        <td style="text-align: left; padding: 2px 0px;">CITY:</td>
                                        @if(!empty($project->city))
                                        <td style="text-align: right; padding: 2px 0px;">{{ucfirst($project->city)}}</td>
                                        @endif
                                    </tr>

                                    <tr>
                                        <td style="text-align: left; padding: 2px 0px;">STATE:</td>
                                         @if(!empty($project->state))
                                        <td style="text-align: right; padding: 2px 0px;">{{ucfirst($project->state)}}</td>
                                        @endif
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                <div style="border-top: 2px solid #000; padding: 2px;">
                    <table style="width: 100%; font-size: 9px; border-collapse: collapse;">
                        <tr>
                            <td style="text-align:left; padding: 2px 0px;">SCALE:</td>
                            <td style="text-align: right; padding: 2px 0px;">
                                NOT TO SCALE
                            </td>
                        </tr>
                    </table>
                </div>

                <div style="border-top: 2px solid #000; padding: 2px;">
                    <table style="width: 100%; font-size: 9px; border-collapse: collapse;">
                        <tr>
                            <td style="text-align:left; padding: 2px 0px;">SHEET NAME:</td>
                            <td style="text-align: right; padding: 2px 0px;">
                                SIGN MOUNTING DETAIL
                            </td>
                        </tr>
                    </table>
                </div>


                <div style="border-top: 2px solid #000; padding: 2px;">
                    <table style="width: 100%; font-size: 9px; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="text-align: left; font-size: 9px; font-weight: bold;">DRAWING NUMBER:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size: 32px; font-weight: bold; text-align: center; padding: 2px 0px;">DETAIL</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>