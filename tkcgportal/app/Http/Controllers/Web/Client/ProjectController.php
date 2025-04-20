<?php
namespace App\Http\Controllers\Web\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Projects;
use App\Models\master_images;
use App\Models\States;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function ProjectList(){
        $Projects = Projects::where('userId',Auth::user()->id)->get();
        return view('pages.client.projects.list',compact('Projects'));
    }

    public function ProjectAdd(){
        $getStates = States::select('state')->distinct()->get();
        return view('pages.client.projects.add',compact('getStates'));
    }

    public function createThreeDSign(){
        return view('pages.client.3D-SIGN.create-3d-sign');
    }

    public function create(Request $request){
        $messages = [
            'name.required' => 'Project name is required.',
            'wall_type.required' => 'Wall type is required.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'wall_type' => 'required',
        ], $messages);

       if ($validator->fails()) {
        return redirect()->back()->withErrors($validator);
       }

       return redirect()->route('client.project.calculation', [
            'ArtworkImageId' => $request->input('ArtworkImageId'),
            'name' => $request->input('name'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'street_name' => $request->input('street_name'),
            'wall_type' => $request->input('wall_type'),
            'wind_speed' => $request->input('wind_speed'),
            'snow_load' => $request->input('snow_load'),
            'ice' => $request->input('ice'),
            'ASCE_code' => $request->input('ASCE_code'),
            'building_code' => $request->input('building_code')
     ]);

    }

    public function ProjectCalculation(Request $request){
       $ArtworkImageId =  $request->input('ArtworkImageId');
       $name =  $request->input('name');
       $state =  $request->input('state');
       $city =  $request->input('city');
       $street_name =  $request->input('street_name');
       $wall_type =  $request->input('wall_type');
       return view('pages.client.projects.calculation', compact('ArtworkImageId', 'name', 'state', 'city', 'street_name', 'wall_type'));
    }


    public function ProjectCalculationPost(Request $request)
    {
        $rules = [];
        $messages = [];

        if (in_array($request->wall_type, ['cabinet', 'channel_letters', 'raceway'])) {
            $rules = [
                'name' => 'required',
                'wall_type' => 'required',
                // 'XLEW_3_5_7' => 'required',
                // 'XLEW_3_6_7' => 'required',
                'sign_height' => 'required|numeric',
                'sign_length' => 'required|numeric',
                'sign_installation_height' => 'required|numeric',
                'sign_depth' => 'required|numeric',
                'weight' => 'required|numeric',
                'wind_speed' => 'required|numeric',
                'snow_load' => 'required|numeric',
                'ice' => 'required|numeric',
                'building_code' => 'required|string',
                'ASCE_code' => 'required|string',
            ];

            $messages = [
                'name.required' => 'Project name is required.',
                'wall_type.required' => 'Sign type is required.',
                // 'XLEW_3_5_7.required' => 'Exposure category is required.',
                // 'XLEW_3_6_7.required' => 'Risk category is required.',
                'sign_height.required' => 'Sign height is required.',
                'sign_length.required' => 'Sign length is required.',
                'sign_installation_height.required' => 'Installation height is required.',
                'sign_depth.required' => 'Sign depth is required.',
                'weight.required' => 'Approximate weight is required.',
                'wind_speed.required' => 'Wind speed is required.',
                'snow_load.required' => 'Snow load is required.',
                'ice.required' => 'Ice load is required.',
                'building_code.required' => 'Building code is required.',
                'ASCE_code.required' => 'ASCE code is required.',
            ];
        }

        if ($request->wall_type == 'raceway') {
            $rules = array_merge($rules, [
                'block_depth' => 'required|numeric',
                'block_height' => 'required|numeric',
            ]);

            $messages = array_merge($messages, [
                'block_depth.required' => 'Raceway depth is required.',
                'block_height.required' => 'Raceway height is required.',
            ]);
        }

        if (in_array($request->wall_type, [
            'double-post-full-height', 'single-post-full-height',
            'double-post-with-cabinet', 'single-post-with-cabinet', 'post-and-panel',
            'double-post-covered', 'single-post-covered'
        ])) {
            $rules = array_merge($rules, [
                'XLEW_1_3_3' => 'required|numeric',
                // 'XLEW_1_3_8' => 'required|numeric',
                'XLEW_1_4_3' => 'required|numeric',
                'XLEW_1_5_3' => 'required|numeric',
                // 'XLEW_1_5_8' => 'required|numeric',
                'XLEW_1_6_3' => 'required|numeric',
                // 'XLEW_1_7_3' => 'required|numeric',
                'XLEW_1_8_3' => 'required|numeric',
                'XLEW_1_9_3' => 'required|numeric',
                'XLEW_1_10_3' => 'required|numeric',

                'XLEW_1_11_3' => 'required',
                // 'XLEW_1_12_3' => 'required',

                'XLEW_1_14_3' => 'required',
                'XLEW_1_15_3' => 'required',
                'Grade' => 'required',

                'XLEW_1_18_3' => 'required|numeric',
                'Dia' => 'required',
                'XLEW_1_20_3' => 'required',

                'XLEW_1_22_3' => 'required',
                'XLEW_1_23_3' => 'required|numeric',
                // 'XLEW_1_24_3' => 'required|numeric',
                // 'XLEW_1_25_3' => 'required|numeric',

                'XLEW_1_28_3' => 'required|numeric',
                'XLEW_1_29_3' => 'required|numeric',
            ]);

            $messages = array_merge($messages, [
                'XLEW_1_3_3.required' => 'Total height is required.',
                // 'XLEW_1_3_8.required' => 'Ultimate wind speed is required.',
                'XLEW_1_4_3.required' => 'Cabinet height is required.',
                'XLEW_1_5_3.required' => 'Cabinet width is required.',
                // 'XLEW_1_5_8.required' => 'Ice thickness is required.',
                'XLEW_1_6_3.required' => 'Cabinet depth is required.',
                // 'XLEW_1_7_3.required' => 'Pole cover width is required.',
                'XLEW_1_8_3.required' => 'Approximate cabinet weight is required.',
                'XLEW_1_9_3.required' => 'Number of posts is required.',
                'XLEW_1_10_3.required' => 'Post spacing is required.',
                'XLEW_1_11_3.required' => 'Sign face is required.',
                // 'XLEW_1_12_3.required' => 'Open area percentage is required.',
                'XLEW_1_14_3.required' => 'Post shape is required.',
                'XLEW_1_15_3.required' => 'Post size is required.',
                'Grade.required' => 'Material is required.',
                'XLEW_1_18_3.required' => 'Quantity is required.',
                'Dia.required' => 'Diameter is required.',
                'XLEW_1_20_3.required' => 'Grade is required.',
                'XLEW_1_22_3.required' => 'Individual or combined is required.',
                'XLEW_1_23_3.required' => 'Adjust length is required.',
                // 'XLEW_1_24_3.required' => 'Width is required.',
                // 'XLEW_1_25_3.required' => 'Depth is required.',
                'XLEW_1_28_3.required' => 'Drill diameter is required.',
                'XLEW_1_29_3.required' => 'Drill depth is required.',
            ]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $exposure_cate = $request->XLEW_3_5_7;
            $risk_category = $request->XLEW_3_6_7;
            $snow_load = $request->snow_load;

            if (in_array($request->wall_type, [
                'double-post-full-height', 'single-post-full-height',
                'double-post-with-cabinet', 'single-post-with-cabinet', 'post-and-panel',
                'double-post-covered', 'single-post-covered'
            ])) {
                $exposure_cate = $request->XLEW_1_6_8;
                $risk_category = $request->XLEW_1_7_8;
                $snow_load = $request->XLEW_1_4_8;
            }

            // Store project data
            $data = Projects::create([
                'name' => $request->name,
                'wall_type' => $request->wall_type,
                'exposure_cate' => $exposure_cate,
                'risk_category' => $risk_category,
                'artwork_image_id' => $request->ArtworkImageId ?? null,
                'state' => $request->state ?? null,
                'city' => $request->city ?? null,
                'street' => $request->street_name ?? null,
                'sign_height' => $request->sign_height,
                'sign_length' => $request->sign_length,
                'sign_width' => $request->sign_width ?? null,
                'sign_installation_height' => $request->sign_installation_height,
                'sign_depth' => $request->sign_depth,
                'block_depth' => $request->block_depth ?? null,
                'block_height' => $request->block_height ?? null,
                'open_face' => $request->open_face ?? null,
                'weight' => $request->weight,
                'mounting_direction' => $request->mounting_direction ?? null,
                'bottom_sign_to_bolt' => $request->bottom_sign_to_bolt ?? null,
                'bolt_spacing' => $request->bolt_spacing ?? null,
                'wind_speed' => $request->wind_speed,
                'snow_load' => $snow_load,
                'ice' => $request->ice,
                'building_code' => $request->building_code,
                'ASCE_code' => $request->ASCE_code,
                'userId' => Auth::id(),

                // Sign Inputs
                'total_height' => $request->XLEW_1_3_3 ?? null,
                'ultimate_wind_speed' => $request->XLEW_1_3_8 ?? null,
                'cabinet_height' => $request->XLEW_1_4_3 ?? null,
                'cabinet_width' => $request->XLEW_1_5_3 ?? null,
                'ice_thickness' => $request->XLEW_1_5_8 ?? null,
                'cabinet_depth' => $request->XLEW_1_6_3 ?? null,
                'pole_cover_width' => $request->XLEW_1_7_3 ?? null,
                'aprox_cabinet_weight' => $request->XLEW_1_8_3 ?? null,
                'number_of_posts' => $request->XLEW_1_9_3 ?? null,
                'post_spacing' => $request->XLEW_1_10_3 ?? null,

                // Advanced User
                'sign_face' => $request->XLEW_1_11_3 ?? null,
                'open_area_percentage' => $request->XLEW_1_12_3 ?? null,

                // Post Size
                'post_shape' => $request->XLEW_1_14_3 ?? null,
                'post_size' => $request->XLEW_1_15_3 ?? null,
                'material' => $request->Grade ?? null,

                // Anchor Bolt
                'quantity' => $request->XLEW_1_18_3 ?? null,
                'diameter' => $request->Dia ?? null,
                'grade' => $request->XLEW_1_20_3 ?? null,

                // Spread Footing
                'individual_or_combined' => $request->XLEW_1_22_3 ?? null,
                'adjust_length' => $request->XLEW_1_23_3 ?? null,
                'width' => $request->XLEW_1_24_3 ?? null,
                'depth' => $request->XLEW_1_25_3 ?? null,

                // Drill Pier Foundation
                'drill_diameter' => $request->XLEW_1_28_3 ?? null,
                'drill_depth' => $request->XLEW_1_29_3 ?? null,
            ]);

            return redirect()->route('client.project.view', ['id' => $data->id])
                ->with('success', 'Project created successfully!');
        } catch (\Exception $e) {

            return back()->with('error', 'Failed to create project. Error: ' . $e->getMessage());
        }
    }

    public function ArtworkImageUpload(Request $request){
        $image=$request->photo;
        $name=$image->getClientOriginalName();
        $mimeType=$image->getMimeType();
        $name=time().$name;
        $validator = Validator::make($request->all(), [
            'photo' => 'required|mimes:jpeg,jpg,png,webp,PNG,JPG,JPEG,WEBP|max:10240'
       ]);
       if ($validator->fails())
       {
          return response()->json(['errors'=>$validator->errors()->all(),'success'=>false,'error'=>true]);
       }
       else
       {
        if(!file_exists(public_path().'/uploads/'))
        {
            mkdir(public_path().'/uploads/');
        }
        if(!file_exists(public_path().'/uploads/artwork'))
        {
            mkdir(public_path().'/uploads/artwork');
        }
        if(!file_exists(public_path().'/uploads/artwork/'))
        {
            mkdir(public_path().'/uploads/artwork/');
        }
        if (!file_exists(public_path().'/uploads/artwork/172x172/'))
        {
            mkdir(public_path().'/uploads/artwork/172x172/');
        }

        $miniImageUrl = url('/').'/uploads/artwork/'.$name;
        $imageObjectMini = false;

        try{
            $image=$request->file('photo');
            $image_resize = Image::make($image->getRealPath());
            $image_resize->save(public_path().'/uploads/artwork/172x172/'.$name,100);
            $miniImageUrl = url('/').'/public/uploads/artwork/172x172/'.$name;
            $imageObjectMini=master_images::create(['name'=>$image->getClientOriginalName(),'url'=>url('/').'/public/uploads/artwork/172x172/'.$name,'base_url'=>public_path().'/uploads/artwork/172x172/'.$name,'withoutPublicUrl'=>'/uploads/artwork/172x172/'.$name]);
        }
        catch(\Exception $e){
        }
        catch(NotSupportedException $e){
        }
        catch(ImageException $e){
        }
       catch(InvalidArgumentException $e){
      }
      catch(MissingDependencyException $e){
      }
      catch(NotFoundException $e){
      }
      catch(NotReadableException $e){
      }
      catch(NotWritableException $e){
      }
      catch(RuntimeException $e){
      }

      $image->move(public_path().'/uploads/artwork/',$name);
      $imageObject=master_images::create(['name'=>$image->getClientOriginalName(),'url'=>url('/').'/public/uploads/artwork/',$name,'base_url'=>public_path().'/uploads/artwork/'.$name,'withoutPublicUrl'=>'/uploads/artwork/'.$name]);
      return response()->json(['success'=>true,'imageId'=>($imageObjectMini)?$imageObjectMini->id:$imageObject->id,'imageUrl'=>url('/').'/public/uploads/artwork/'.$name,'miniImageUrl'=>$miniImageUrl]);
     }
  }

    public function ProjectEdit(Request $request, $id){
        $getStates = States::select('state')->distinct()->get();
        $data = Projects::whereId($id)->first();
        return view('pages.client.projects.edit',compact('data','getStates'));
    }


    public function ProjectEditPost(Request $request, $id){

        // dd($request->all());
        $rules = [];
        $messages = [];

        if (in_array($request->wall_type, ['cabinet', 'channel_letters', 'raceway'])) {
            $rules = [
                'name' => 'required',
                'wall_type' => 'required',
                // 'XLEW_3_5_7' => 'required',
                // 'XLEW_3_6_7' => 'required',
                'sign_height' => 'required|numeric',
                'sign_length' => 'required|numeric',
                'sign_installation_height' => 'required|numeric',
                'sign_depth' => 'required|numeric',
                'weight' => 'required|numeric',
                'wind_speed' => 'required|numeric',
                'snow_load' => 'required|numeric',
                'ice' => 'required|numeric',
                'building_code' => 'required|string',
                'ASCE_code' => 'required|string',
            ];

            $messages = [
                'name.required' => 'Project name is required.',
                'wall_type.required' => 'Sign type is required.',
                // 'XLEW_3_5_7.required' => 'Exposure category is required.',
                // 'XLEW_3_6_7.required' => 'Risk category is required.',
                'sign_height.required' => 'Sign height is required.',
                'sign_length.required' => 'Sign length is required.',
                'sign_installation_height.required' => 'Installation height is required.',
                'sign_depth.required' => 'Sign depth is required.',
                'weight.required' => 'Approximate weight is required.',
                'wind_speed.required' => 'Wind speed is required.',
                'snow_load.required' => 'Snow load is required.',
                'ice.required' => 'Ice load is required.',
                'building_code.required' => 'Building code is required.',
                'ASCE_code.required' => 'ASCE code is required.',
            ];
        }

        if ($request->wall_type == 'raceway') {
            $rules = array_merge($rules, [
                'block_depth' => 'required|numeric',
                'block_height' => 'required|numeric',
            ]);

            $messages = array_merge($messages, [
                'block_depth.required' => 'Raceway depth is required.',
                'block_height.required' => 'Raceway height is required.',
            ]);
        }

        if (in_array($request->wall_type, [
            'double-post-full-height', 'single-post-full-height',
            'double-post-with-cabinet', 'single-post-with-cabinet', 'post-and-panel',
            'double-post-covered', 'single-post-covered'
        ])) {
            $rules = array_merge($rules, [
                'XLEW_1_3_3' => 'required|numeric',
                // 'XLEW_1_3_8' => 'required|numeric',
                'XLEW_1_4_3' => 'required|numeric',
                'XLEW_1_5_3' => 'required|numeric',
                // 'XLEW_1_5_8' => 'required|numeric',
                'XLEW_1_6_3' => 'required|numeric',
                // 'XLEW_1_7_3' => 'required|numeric',
                'XLEW_1_8_3' => 'required|numeric',
                'XLEW_1_9_3' => 'required|numeric',
                'XLEW_1_10_3' => 'required|numeric',

                'XLEW_1_11_3' => 'required',
                // 'XLEW_1_12_3' => 'required',

                'XLEW_1_14_3' => 'required',
                'XLEW_1_15_3' => 'required',
                'Grade' => 'required',

                'XLEW_1_18_3' => 'required|numeric',
                'Dia' => 'required',
                'XLEW_1_20_3' => 'required',

                'XLEW_1_22_3' => 'required',
                'XLEW_1_23_3' => 'required|numeric',
                // 'XLEW_1_24_3' => 'required|numeric',
                // 'XLEW_1_25_3' => 'required|numeric',

                'XLEW_1_28_3' => 'required|numeric',
                'XLEW_1_29_3' => 'required|numeric',
            ]);

            $messages = array_merge($messages, [
                'XLEW_1_3_3.required' => 'Total height is required.',
                // 'XLEW_1_3_8.required' => 'Ultimate wind speed is required.',
                'XLEW_1_4_3.required' => 'Cabinet height is required.',
                'XLEW_1_5_3.required' => 'Cabinet width is required.',
                // 'XLEW_1_5_8.required' => 'Ice thickness is required.',
                'XLEW_1_6_3.required' => 'Cabinet depth is required.',
                // 'XLEW_1_7_3.required' => 'Pole cover width is required.',
                'XLEW_1_8_3.required' => 'Approximate cabinet weight is required.',
                'XLEW_1_9_3.required' => 'Number of posts is required.',
                'XLEW_1_10_3.required' => 'Post spacing is required.',
                'XLEW_1_11_3.required' => 'Sign face is required.',
                // 'XLEW_1_12_3.required' => 'Open area percentage is required.',
                'XLEW_1_14_3.required' => 'Post shape is required.',
                'XLEW_1_15_3.required' => 'Post size is required.',
                'Grade.required' => 'Material is required.',
                'XLEW_1_18_3.required' => 'Quantity is required.',
                'Dia.required' => 'Diameter is required.',
                'XLEW_1_20_3.required' => 'Grade is required.',
                'XLEW_1_22_3.required' => 'Individual or combined is required.',
                'XLEW_1_23_3.required' => 'Adjust length is required.',
                // 'XLEW_1_24_3.required' => 'Width is required.',
                // 'XLEW_1_25_3.required' => 'Depth is required.',
                'XLEW_1_28_3.required' => 'Drill diameter is required.',
                'XLEW_1_29_3.required' => 'Drill depth is required.',
            ]);
        }



        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // dd($validator->errors(), $request->all());
            return back()->withErrors($validator)->withInput();
        }

            try {

                $exposure_cate = $request->XLEW_3_5_7;
                $risk_category = $request->XLEW_3_6_7;
                $snow_load = $request->snow_load;

                if (in_array($request->wall_type, [
                    'double-post-full-height', 'single-post-full-height',
                    'double-post-with-cabinet', 'single-post-with-cabinet', 'post-and-panel',
                    'double-post-covered', 'single-post-covered'
                ])) {
                    $exposure_cate = $request->XLEW_1_6_8;
                    $risk_category = $request->XLEW_1_7_8;
                    $snow_load = $request->XLEW_1_4_8;
                }

               Projects::whereId($id)->update([
                'name' => $request->name,
                'wall_type' => $request->wall_type,
                'exposure_cate' => $exposure_cate,
                'risk_category' => $risk_category,
                'artwork_image_id' => $request->ArtworkImageId ?? null,
                'state' => $request->state ?? null,
                'city' => $request->city ?? null,
                'street' => $request->street_name ?? null,
                'sign_height' => $request->sign_height,
                'sign_length' => $request->sign_length,
                'sign_width' => $request->sign_width ?? null,
                'sign_installation_height' => $request->sign_installation_height,
                'sign_depth' => $request->sign_depth,
                'block_depth' => $request->block_depth ?? null,
                'block_height' => $request->block_height ?? null,
                'open_face' => $request->open_face ?? null,
                'weight' => $request->weight,
                'mounting_direction' => $request->mounting_direction ?? null,
                'bottom_sign_to_bolt' => $request->bottom_sign_to_bolt ?? null,
                'bolt_spacing' => $request->bolt_spacing ?? null,
                'wind_speed' => $request->wind_speed,
                'snow_load' => $snow_load,
                'ice' => $request->ice,
                'building_code' => $request->building_code,
                'ASCE_code' => $request->ASCE_code,
                'userId' => Auth::id(),

                // Sign Inputs
                'total_height' => $request->XLEW_1_3_3 ?? null,
                'ultimate_wind_speed' => $request->XLEW_1_3_8 ?? null,
                'cabinet_height' => $request->XLEW_1_4_3 ?? null,
                'cabinet_width' => $request->XLEW_1_5_3 ?? null,
                'ice_thickness' => $request->XLEW_1_5_8 ?? null,
                'cabinet_depth' => $request->XLEW_1_6_3 ?? null,
                'pole_cover_width' => $request->XLEW_1_7_3 ?? null,
                'aprox_cabinet_weight' => $request->XLEW_1_8_3 ?? null,
                'number_of_posts' => $request->XLEW_1_9_3 ?? null,
                'post_spacing' => $request->XLEW_1_10_3 ?? null,

                // Advanced User
                'sign_face' => $request->XLEW_1_11_3 ?? null,
                'open_area_percentage' => $request->XLEW_1_12_3 ?? null,

                // Post Size
                'post_shape' => $request->XLEW_1_14_3 ?? null,
                'post_size' => $request->XLEW_1_15_3 ?? null,
                'material' => $request->Grade ?? null,

                // Anchor Bolt
                'quantity' => $request->XLEW_1_18_3 ?? null,
                'diameter' => $request->Dia ?? null,
                'grade' => $request->XLEW_1_20_3 ?? null,

                // Spread Footing
                'individual_or_combined' => $request->XLEW_1_22_3 ?? null,
                'adjust_length' => $request->XLEW_1_23_3 ?? null,
                'width' => $request->XLEW_1_24_3 ?? null,
                'depth' => $request->XLEW_1_25_3 ?? null,

                // Drill Pier Foundation
                'drill_diameter' => $request->XLEW_1_28_3 ?? null,
                'drill_depth' => $request->XLEW_1_29_3 ?? null,
               ]);
            return redirect()->route('client.project.view', $id)->with('success', 'Project updated successfully!');
        } catch (\Exception $e) {
            dd('The line number where the error occurred => catch');
            return back()->with('error', 'Failed to update project. Please try again.');
        }

        }

    public function ProjectView(Request $request, $id){
        $project = $request->session()->get('project') ?? Projects::whereId($id)->first();
        return view('pages.client.projects.table', compact('project'));
    }


    public function ProjectArtwork(Request $request, $id){
        $project = Projects::whereId($id)->first();
        return view('pages.client.projects.artwork',compact('project'));
    }

    public function ProjectDelete(Request $request, $id){
        if(!$request->id){
         return response()->json(['success' => false, 'error'=>true,'msg'=>'Something went wrong!']);
        }

        Projects::whereId($request->id)->delete();
        return response()->json(['success' => true, 'error'=>false,'msg'=>'Project deleted successfully!']);
    }



public function getCitiesByState(Request $request)
{
    $cities = States::where('state', $request->stateName)
    ->pluck('cities')
    ->toArray();

    if (empty($cities)) {
    return response()->json(['message' => 'No data found']);
    }

    $citiesArray = [];
    foreach ($cities as $cityList) {
    if (is_string($cityList)) {
    $decoded = json_decode($cityList, true);
    $cityList = is_array($decoded) ? $decoded : [$cityList];
    }
    $citiesArray = array_merge($citiesArray, (array) $cityList);
    }
    $uniqueCities = array_values(array_unique($citiesArray));
    return response()->json($uniqueCities);
}

public function getWindSnowValueByCities(Request $request)
{
    $state = $request->input('state');
    $city = $request->input('city');

    $stateData = DB::table('states')
        ->where('state', $state)
        ->where('cities', $city)
        ->select('risk_2','building_code','ASCE_code')
        ->first();

    if ($stateData) {
        $riskData = json_decode($stateData->risk_2, true);
        return response()->json([
            'stateData' => $stateData,
            'wind' => $riskData['wind'] ?? '',
            'ice' => $riskData['ice'] ?? '',
            'snow' => $riskData['snow'] ?? ''
        ]);
    }

    return response()->json([
        'wind' => '',
        'ice' => '',
        'snow' => ''
    ]);
}
}