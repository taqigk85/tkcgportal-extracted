<?php

namespace App\Http\Middleware;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userId = auth()->user()->id;
            $userStatus = auth()->user()->status;
            if(strcmp($userStatus,'inactive')==0){
                Auth::guard('web')->logout();
                return redirect()->route('login');
            }else{
                $user = User::whereId($userId)->with('roles')->first();
                $role = 'client';
                if (isset($user->roles[0]->name)) {
                    $role = $user->roles[0]->name;
                }
                if (strcmp($role, 'client') == 0) {
                    return $next($request);
                } else {
                    return redirect()->route('admin.dashboard')->with('message', 'You are not an authorised user');
                }
            }  
           } else {
            Auth::guard('web')->logout();
            return redirect()->route('login');
          } 
    }
}


