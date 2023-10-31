<?php

namespace App\Http\Controllers;

use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function authentification (Request $request)
    {

        // dd($request->all()); die();
        if(empty($request->email)):
            MessageService::isEmpty('email');
            return back();
        endif;

        if(empty($request->password)):
            MessageService::isEmpty('mot de passe');
            return back();
        endif;

        $users = DB::table('users')->where('email', $request->email)->first();
//  dd($users); die();
        // if (!$users || !password_verify($request->password, $users->password))
        // {
        //     MessageService::isDataNoFound();
        //     return back();
        // }

        $user_data_validate = Auth::attempt(['email'=> $request->email,'password'=> $request->password]);
        dd($user_data_validate); die();

        if($user_data_validate == true){
            $request->session()->regenerate();

            $users_status = DB::table('users')->where('email', $request->email)
            ->value('online');

            if($users_status == 1){
                $users_status_verify = DB::table('users')->where('email', $request->email)
                ->update(['online' => 0]);
            }

            $users_status_verify = DB::table('users')->where('email', $request->email)
            ->update(['online' => 1]);

            // dd($users_status_verify); die();

            if(($users_status_verify == true) || ($users_status_verify == 1)){

                $users_online_data = DB::table('users')
                ->join('roles', 'users.role_id', 'roles.id')
                ->select('roles.role as user_role', 'users.*')->first();

                // Auth::login($user_data_validate);

                session()->put('data',$users_online_data);

                MessageService::loginSuccess();
                return redirect()->intended(route('index'));

            }else if(($users_status_verify == false) || ($users_status_verify == 0)){
                MessageService::isAlreadlyConnected();
                return back();
            }

        }else{
            MessageService::isDataNoFound();
            return back();
        }
    }

    public function logOut($id)
    {

        if($id){
            $get_user_status = DB::table('users')
            ->where('id', $id)
            ->value('online');

            // dd($get_user_status);
            if($get_user_status == 1){
                $user_offline = DB::table('users')
                ->where('id', $id)
                ->update(['online'=> 0]);

                dd($user_offline);
                if($user_offline == true){

                    Auth::logout();

                    session()->forget('data');
                    session()->flush();

                    MessageService::logoutSuccess();
                    return redirect()->route('login');
                }else{

                    MessageService::isErrorFailed();
                    return back();
                }
            }else{

                MessageService::isAlreadlyDisconnected();
                // return redirect()->route('login');
            }
        }else{
            MessageService::isErrorFailed();
            return back();
        }
    }
}
