<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionChecker
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
        if(! $request->session()->has('uc_id')){
            return redirect()->route('login');
        }
        $user_role=$request->session()->get('user_role');
        if($user_role==1 && !$request->is('customer/*'))
        {
            return redirect()->route('customerDashboard');
        }
        else if($user_role==2 && !$request->is('admin/*'))
        {
            return redirect()->route('admin.home');
        }
        else if($user_role==3 && !$request->is('staff_delivery/*'))
        {
            return redirect()->route('staffDashboard');
        }
        else if($user_role==4 && !$request->is('vendor/*'))
        {   
            return redirect()->route('vendorDashboard');
        }
        return $next($request);
    }
}
