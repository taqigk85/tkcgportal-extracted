<?php
namespace App\Helpers;
use App\Models\User;
use App\Models\UserMetas;
use App\Models\master_images;
use Illuminate\Support\Facades\Auth;
use DB;
class CommonHelper
{
 

    public static function getUserRole($userId)
    {
        $user = User::with('roles')->find($userId);
        if (!$user) {
            return 'User not found';
        }
        return $user->roles->pluck('name')->implode(', '); 
    }
    

   public static function getUserMeta($userId,$userMetaKey){
        $UserMetas=UserMetas::where([['userId','=',$userId],['meta_key','LIKE',$userMetaKey]])->first();
        return ($UserMetas)?$UserMetas->meta_value:'';
   }

   public static function getPhotoById($imageId)
   {
       return master_images::whereId($imageId)->first();
   }

    public static function getUserRoleName($userRole){
        if ($userRole) {
            $roleName = $userRole->name;
            return $roleName;
        }
    }

     public static function getTimeAgo($carbonObject) {
        return str_ireplace(
            [' seconds', ' second', ' minutes', ' minute', ' hours', ' hour', ' days', ' day', ' weeks', ' week'],
            ['s', 's', 'm', 'm', 'h', 'h', 'd', 'd', 'w', 'w'],
            $carbonObject->diffForHumans()
        );
    }

    public static function getUsernameById($userId)
    {
        $user = User::find($userId);
        return $user ? $user->name : 'User not found';
    }
}
?>