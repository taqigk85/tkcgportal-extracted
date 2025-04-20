<?php 
namespace App\Http\Controllers\Web\Admin;
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

class ClientController extends Controller
{
    public function ClientList(){
        $Users = User::where('id', '!=', auth()->user()->id)
            ->whereIn('status', ['active', 'inactive'])
            ->where(function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->where('name', 'LIKE', 'client');
                });
        })
        ->with('roles')
        ->orderBy('created_at', 'DESC')
        ->get();
        return view('pages.admin.clients.list',compact('Users'));
    }
    public function ClientAdd(){
        $getStates = States::select('state')->distinct()->get();
        return view('pages.admin.clients.add',compact('getStates'));
    }

    public function ClientAddPost(Request $request){
              
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
        
        return redirect()->route('admin.client.view', ['id' => $user->id])
        ->with('success', 'Client added successfully.');
    
    }
    public function ClientEdit($id)
    {
        $getStates = States::select('state')->distinct()->get();
        $user = User::whereId($id)->first();
        return view('pages.admin.clients.edit', compact('getStates', 'user'));
    }
    

    public function ClientEditPost(Request $request, $id){
         
        $messages = [
            'name.required' => 'Name is required.',
            'mobile.required' => 'Mobile number is required.',
            'mobile.numeric' => 'Mobile number must be numeric.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
        ];
    
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|email', 
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = User::where('id', $id)->where('status', '!=', 'inactive')->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'User not found or inactive.');
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];
    
        if (!empty($request->password)) {
            $updateData['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($updateData);
    
        $metaFields = ['CompanyLogoId', 'mobile', 'company_name', 'state', 'city', 'street_name'];
        foreach ($metaFields as $field) {
            $this->insertOrUpdateUsermeta($user->id, $field, $request->$field ?? null);
        }
        return redirect()->route('admin.client.view', $id)->with('success', 'Client updated successfully.');
    }

    public function ClientView($id){
        $user = User::whereId($id)->first();
        return view('pages.admin.clients.view',compact('user'));
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



    
    public function ClientDelete(Request $request, $id){
        if(!$request->id){
         return response()->json(['success' => false, 'error'=>true,'msg'=>'Something went wrong!']);
        }

        User::whereId($request->id)->delete();
        return response()->json(['success' => true, 'error'=>false,'msg'=>'Client deleted successfully!']);
    }

}



