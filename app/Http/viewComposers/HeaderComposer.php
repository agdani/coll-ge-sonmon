<?php

namespace App\Http\viewComposers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HeaderComposer {

    public function Compose(View $view){
        $id = Auth::user()->id;
        $view->with("_user",  DB::table('admin_accounts')->where('id', $id)
        ->first());

        $view->with("user", DB::table('users')
        ->join('roles', 'users.role_id', 'roles.id')
        ->select('roles.role as user_role', 'users.*')
        ->where('users.id', $id)
        ->first());

        $view->with('user_data', Auth::user());
        $view->with('data', User::find(Auth::user()->id));
    }
}
