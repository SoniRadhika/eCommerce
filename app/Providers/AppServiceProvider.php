<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use DB;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::Composer('Layout.header',function($view){
            /*Live Transfers Counts*/
            $name = DB::table('users')->first();

            $useremail = $name->email;
  
            $view->with('useremail',$useremail);
  
          });
    }
}
