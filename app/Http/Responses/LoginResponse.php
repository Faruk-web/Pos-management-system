<?php

namespace App\Http\Responses;

use Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $guard = config('fortify.guard');
        $path = "/";
        if($guard == 'admin'){
            if(Auth::guard('admin')->user()->supplier_id == null && Auth::guard('admin')->user()->employee_id == null && Auth::guard('admin')->user()->agent_id == null){
                
                 $path = '/admin/dashboard';
                
            }elseif(Auth::guard('admin')->user()->supplier_id !== null){
                
                $path = '/admin/profile'; // for supplier login refirect route 
                
            }elseif(Auth::guard('admin')->user()->employee_id !== null){
                
                $path = '/admin/profile'; // for employee login refirect route 
                
            }elseif(Auth::guard('admin')->user()->agent_id !== null){
                
                $path = '/admin/agent/profile';// for agent login refirect route 
            }
        }
        elseif($guard  == 'employeer'){
            $path = '/employeer/dashboard';
        }

        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended($path);
    }
}
