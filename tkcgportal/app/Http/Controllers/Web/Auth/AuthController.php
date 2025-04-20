<?php 
namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;
use Hash;
use App\Models\User;
use App\Models\UserMetas;
use App\Models\master_images;
use App\Models\States;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function Login(){
  
    if (Auth::check()) {
        $user = auth()->user();
        $role = optional($user->roles->first())->name;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'client') {
            return redirect()->route('client.dashboard');
        } else {
            return redirect()->route('login')->withErrors(['error' => 'Unauthorized access.']);
        }
    }
    return view('pages.auth.login');
}


    public function LoginPost(Request $request){

    $messages = [
        'email.required' => 'Email is required.',
        'email.email' => 'Email must be a valid email address.',
        'password.required' => 'Password is required.',
    ];


    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ], $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator);
    }
    

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();

        if ($user->status === 'inactive') {
            Auth::logout();
            return redirect()->route('login')->with('errorMessage', 'Your account is currently not active. Please contact admin to activate the account.');
        }

        $role = optional($user->roles()->first())->name;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'client') {
            return redirect()->route('client.dashboard');
        } else {
            Auth::logout();
            return redirect()->route('login')->withErrors(['errorMessage' => 'Unauthorized access.']);
        }

    } else {

        return redirect()->route('login')->with('errorMessage', 'Invalid login credentials.');
    }
    }

     
    public function Register(){
        $getStates = States::select('state')->distinct()->get();
        return view('pages.auth.register',compact('getStates'));
    }

    public function RegisterPost(Request $request)
    {

        $messages = [
            'name.required' => 'Name is required.',
            'mobile.required' => 'Mobile number is required.',
            'mobile.numeric' => 'Mobile number must be numeric.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email is already registered.',
            'password.required' => 'Password is required.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ], $messages);
        
       if ($validator->fails()) {
        return redirect()->back()->withErrors($validator);
     }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('client');
    
        $metaFields = ['CompanyLogoId', 'mobile', 'company_name', 'state', 'city', 'street_name'];
        foreach ($metaFields as $field) {
            $this->insertOrUpdateUsermeta($user->id, $field, $request->$field ?? null);
        }
        
        return redirect()->route('login')->with('success', 'User registered successfully.');
    }


    public function CompanyLogoUpload(Request $request){
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
        if(!file_exists(public_path().'/uploads/companyLogo'))
        {
            mkdir(public_path().'/uploads/companyLogo');
        }
        if(!file_exists(public_path().'/uploads/companyLogo/'))
        {
            mkdir(public_path().'/uploads/companyLogo/');
        }
        if (!file_exists(public_path().'/uploads/companyLogo/172x172/')) {

            mkdir(public_path().'/uploads/companyLogo/172x172/');

        }
        $miniImageUrl = url('/').'/uploads/companyLogo/'.$name;
        $imageObjectMini = false;
        try{
            $image=$request->file('photo');
            $image_resize = Image::make($image->getRealPath());
            $image_resize->save(public_path().'/uploads/companyLogo/172x172/'.$name,100);
            $miniImageUrl = url('/').'/public/uploads/companyLogo/172x172/'.$name;
            $imageObjectMini=master_images::create(['name'=>$image->getClientOriginalName(),'url'=>url('/').'/public/uploads/companyLogo/172x172/'.$name,'base_url'=>public_path().'/uploads/companyLogo/172x172/'.$name,'withoutPublicUrl'=>'/uploads/companyLogo/172x172/'.$name]);
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
      $image->move(public_path().'/uploads/companyLogo/',$name);
      $imageObject=master_images::create(['name'=>$image->getClientOriginalName(),'url'=>url('/').'/public/uploads/companyLogo/',$name,'base_url'=>public_path().'/uploads/companyLogo/'.$name,'withoutPublicUrl'=>'/uploads/companyLogo/'.$name]);
      return response()->json(['success'=>true,'imageId'=>($imageObjectMini)?$imageObjectMini->id:$imageObject->id,'imageUrl'=>url('/').'/public/uploads/companyLogo/'.$name,'miniImageUrl'=>$miniImageUrl]);
     }
  }

  public function LogOut(){
    Auth::logout();
    return redirect()->route('login');
  }
}