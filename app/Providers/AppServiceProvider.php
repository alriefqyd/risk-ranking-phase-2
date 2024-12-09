<?php

namespace App\Providers;

use App\Models\User;
use App\service\UserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use  \Illuminate\Database\Query\Builder;

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
        Paginator::useBootstrap();

        $userService = new UserService();
        Gate::define('read',function (User $user) use ($userService){
            return $userService->isUserHaveAccess($userService->read);
        });

        Gate::define('create',function (User $user) use ($userService){
            return $userService->isUserHaveAccess($userService->create);
        });

        Gate::define('update',function (User $user) use ($userService){
            return $userService->isUserHaveAccess($userService->update);
        });

        Gate::define('delete',function (User $user) use ($userService){
            return $userService->isUserHaveAccess($userService->delete);
        });

        Gate::define('isAdmin', function(User $user) use ($userService){
            return $userService->isAdmin();
        });

        Gate::define('isViewer', function(User $user) use ($userService){
            return $userService->isViewer();
        });

        Gate::define('isAdminDept', function(User $user) use ($userService){
            return $userService->isAdminDept();
        });

        Gate::define('export', function(User $user) use ($userService){
            if(auth()->user()->department == 6) return true;
            return $userService->isUserHaveAccess($userService->export);
        });

        View::composer('*', function ($view) {
            // Get the count or any other conditional data
            $years = date('Y') + 1 . '-' . date('Y') + 5;
            $month = date('m');
            if($month > 10){
                $years = date('Y') + 2 . '-' . date('Y') + 6;
            }
            $view->with('years', $years);
        });


        /**
         * Macro Function
         */

       Builder::macro('whereLike', function ($attributes, string $searchTerm){
           $this->where(function (Builder $query) use ($attributes, $searchTerm){
               foreach (Arr::wrap($attributes) as $attribute) {
                   $query->when(
                        str_contains($attribute,'.'),
                       function (Builder $query) use ($attribute, $searchTerm){
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm){
                               $query->where($relationAttribute,'LIKE',"%{$searchTerm}%");
                            });
                       },
                       function (Builder $query) use ($attribute, $searchTerm){
                            $query->orWhere($attribute,'LIKE',"%{$searchTerm}%");
                       }
                   );
               }
           });
           return $this;
       });

       Builder::macro('search',function ($field, $string){
           return $string ? $this->where($field,'like','%'.$string.'%') : $this;
       });


    }
}
