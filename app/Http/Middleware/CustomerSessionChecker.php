<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerSessionChecker
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
        $user_role=$request->session()->get('user_role');
        if($user_role==1)//Customer
            return $next($request);
        if($user_role==2)//Admin
            return redirect()->route('admin.home');
        else if($user_role==3)
            return redirect()->route('staffDashboard');
        else if($use_role==4)
            return redirect()->route('vendorDashboard');
    }
}
