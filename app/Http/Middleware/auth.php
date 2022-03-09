<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('uc_id')){

            $userRole = $request->session()->get('user_role');
            if($userRole == 1){
               return redirect()->route('customerDashboard');
            }else if($userRole == 2){
                return redirect()->route('admin.home');
            }

            // 3 = staff, 4 = vendor
            // else if($userRole == 3){
            //     return redirect()->route('admin.home');
            // }else if($userRole == 4){
            //     return redirect()->route('admin.home');
            // }

            // return $next($request);
        }

        return $next($request);
    }
}
