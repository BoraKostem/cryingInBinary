<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
        if(!session()->has('userID') && ($request->path() != 'login')){
            return redirect('login')->with('fail','You must be logged in to perform this action.');
        }

        if(session()->has('userID') && ($request->path() == 'login')){
            return back();
        }
 
        return $next($request)->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')  //These are to prevent browsers go back and retrieve data fucntionality.
                              ->header('Pragma','no-cache')
                              ->header('Expires','Sat 01 Jan 1990 00:00:00 GMT');;
    }
}
