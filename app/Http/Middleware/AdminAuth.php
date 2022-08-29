<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
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
        //  $email=$request->post('email');
        // $password=$request->post('password');
        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        if($request->session()->has('ADMIN_LOGIN')){
           

        }else{
            $request->session()->flash('error','Access Denied');
            return redirect('admin');
        }
        return $next($request);
    }
}
