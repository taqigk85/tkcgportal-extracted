<?php

namespace App\Http\Controllers;
use App\Models\UserMetas;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function insertOrUpdateUsermeta($userId,$userMetaKey,$userMetaValue)
    {
        if(strcmp($userMetaValue,'')!=0)
        {
            UserMetas::updateOrCreate(['userId'=>$userId,'meta_key'=>$userMetaKey],['partnerId'=>$userId,'meta_key'=>$userMetaKey,'meta_value'=>$userMetaValue]);
        }
        elseif(strcmp($userMetaValue,'')==0){
          $userMetaValue = '';
          UserMetas::updateOrCreate(['userId'=>$userId,'meta_key'=>$userMetaKey],['partnerId'=>$userId,'meta_key'=>$userMetaKey,'meta_value'=>$userMetaValue]);
        }
        
    }

}
