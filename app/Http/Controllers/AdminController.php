<?php

namespace App\Http\Controllers;

use App\Models\adminAccountModel\admin_account;
use App\Models\classroomModel\classroom;
use App\Models\niveauEtudeModel\niveau_etude;
use App\Models\roleModel\role;
use App\Models\schoolModel\school;
use App\Models\scolariteModel\scolarite;
use App\Models\User;
use App\Services\CodeGenerator;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    // Comments number
    /*
        01.FUNCTIONS BASE
        02.SCHOOLS FUNCTIONS
        03.ACCOUNTS ADMIN FUNCTIONS
        04.ROLES FUNCTIONS
        05.CLASSROOM FUNCTIONS
        06.REGISTER STUDENT FUNCTIONS
        07.NIVEAU ETUDE FUNCTIONS
    */

//*🟠🟠🟠🟠*// 01.FUNCTIONS BASE //*🟠🟠🟠🟠*//


    public function __construct(){
        $this->middleware("auth")->except("login");
    }

    public function login(){
        return view('pages.auth.auth');
    }

    public function dashboard(){
        return view('pages.dashboard');
    }

    public function profile(){
        // dd(Auth::user()); die();
        return view('pages.profile');
    }

//*🟠🟠🟠🟠*// 01.FUNCTIONS BASE //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 02.SCHOOLS FUNCTIONS //*🟠🟠🟠🟠*//

    // page
    public function add_new_school_page(){
        return view('pages.other-pages.schools.add_school');
    }

    // get
    public function liste_school()
    {
        $liste_school = school::all();

        return view('pages.other-pages.schools.liste_school',
        compact(
            [
                'liste_school'
            ]
        ));
    }

    // add
    public function add_new_school_request(Request $request)
    {
        if(empty($request->school_name)){
            MessageService::isEmpty('nom de l\'école');
            return back();
        }

        if(empty($request->localite)){
            MessageService::isEmpty('localité');
          return back();
        }

        if(empty($request->email)){
            MessageService::isEmpty('email');
          return back();
        }

        if(empty($request->phone_number)){
            MessageService::isEmpty('fix de l\'établissement');
          return back();
        }

        if(empty($request->address)){
            MessageService::isEmpty('adresse de l\'école');
          return back();
        }

        if(empty($request->date_creation)){
            MessageService::isEmpty('date de création de l\'école');
          return back();
        }

        $add_data = new school();

        $add_data->school_name = $request->school_name;
        $add_data->localite = $request->localite;
        $add_data->email = $request->email;
        $add_data->phone_number = $request->phone_number;
        $add_data->date_creation = $request->date_creation;
        $add_data->address = $request->address;

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_school');
        }
    }

    // edit
    public function edit_new_school($id){
        $data = DB::table('schools')->where('id', $id)->first();
        return view('pages.other-pages.schools.edit_school',
        compact(['data']));
    }
    // update
    public function update_school_request(Request $request, $id)
    {
        if(!empty($id)){
            // dd($request->all()); die();
            if(empty($request->school_name)){
                MessageService::isEmpty('nom de l\'école');
                return back();
            }

            if(empty($request->localite)){
                MessageService::isEmpty('localité');
            return back();
            }

            if(empty($request->email)){
                MessageService::isEmpty('email');
            return back();
            }

            if(empty($request->phone_number)){
                MessageService::isEmpty('fix de l\'établissement');
            return back();
            }

            if(empty($request->address)){
                MessageService::isEmpty('adresse de l\'école');
            return back();
            }

            if(empty($request->date_creation)){
                MessageService::isEmpty('date de création de l\'école');
            return back();
            }

            $update_data = school::Where('id', $id)->first();
            $update_data->school_name = $request->school_name;
            $update_data->localite = $request->localite;
            $update_data->email = $request->email;
            $update_data->phone_number = $request->phone_number;
            $update_data->date_creation = $request->date_creation;
            $update_data->address = $request->address;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_school');
            }
        }
    }
    // delete
    public function delete_new_school($id){
        $data = DB::table('schools')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return view('pages.other-pages.schools.liste_school');
        }
    }

//*🟠🟠🟠🟠*// 02.END SCHOOLS FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 03. ADMIN ACCOUNT FUNCTIONS //*🟠🟠🟠🟠*//
    // pages
    public function add_new_admin_account_page(){
        $liste_school = school::all();
        $liste_role = role::all();
        return view('pages.accounts.account_add', compact(['liste_school', 'liste_role']));
    }

     // get
    public function liste_admin_account()
    {
        $liste_admin = User::join('roles', 'users.role_id', 'roles.id')
        ->select('roles.role', 'users.*')
        ->get();

        return view('pages.accounts.account_liste',
        compact(
            [
                'liste_admin'
            ]
        ));
    }

    // add
    public function add_new_admin_account_request(Request $request)
    {
    // dd($request->all()); die();
        if(empty($request->role_id)){
            MessageService::isEmpty('rôle');
            return back();
        }

        if(empty($request->fname)){
            MessageService::isEmpty('nom');
        return back();
        }

        if(empty($request->lname)){
            MessageService::isEmpty('prénoms');
        return back();
        }

        if(empty($request->email)){
            MessageService::isEmpty('email');
        return back();
        }

        if(empty($request->school)){
            MessageService::isEmpty('école');
        return back();
        }

        if(empty($request->phone)){
            MessageService::isEmpty('numéro de téléphone');
        return back();
        }

        if(empty($request->address)){
            MessageService::isEmpty('adresse');
        return back();
        }

        if(empty($request->city)){
            MessageService::isEmpty('la ville');
        return back();
        }

        if(empty($request->fonction)){
            MessageService::isEmpty('fonction');
        return back();
        }

        if(empty($request->matricule)){
            MessageService::isEmpty('matricule');
        return back();
        }

    if(empty($request->admin_img)){
        MessageService::isEmpty('photo');
    return back();
    }

    $add_data = new User();

    if($request->hasFile('admin_img')):
        $file = $request->file('admin_img');
        $extension =  $file->getClientOriginalExtension();
        $filename ="admin_img".time().'.'.$extension;

        if($filename):
            $img = Image::make($file->getRealPath());
            $img->resize(600, 600);
            $img->save('documents/admin-img/'.$filename);
        else:
            MessageService::isErrorFailed();
            return back();
        endif;

        $path = "documents/admin-img/";
        $add_data->admin_img = URL::to('').'/'.$path.$filename;
    endif;

    if($request->accountActivation == "on"):
        $add_data->status = 1;
    endif;

    $add_data->role_id = $request->role_id;
    // $add_data->author_id = $request->role_id;
    $add_data->author_id = 1;
    $add_data->fname = $request->fname;
    $add_data->lname = $request->lname;
    $add_data->email = $request->email;
    $add_data->school = $request->school;
    $add_data->phone = $request->phone;
    $add_data->address = $request->address;
    $add_data->city = $request->city;
    $add_data->fonction = $request->fonction;
    $add_data->matricule = $request->matricule;
    $add_data->password = Hash::make($request->password);
    $add_data->slug = CodeGenerator::slug();


    $get_users_auth = DB::table("users")
    ->where("email", $request->email)->first();

    if($get_users_auth != null){
        MessageService::emailExist();
        return back();

    }else{
        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_admin_account');
        }else{
            MessageService::isErrorFailed();
            return back();
        }
    }
    }

    // edit
    public function edit_new_admin_account($id){
    $liste_school = school::all();
    $liste_role = role::all();
        $data = DB::table('users')
        ->join('roles', 'users.role_id', 'roles.id')
        ->select('roles.role', 'users.*')
        ->where('users.id', $id)->first();
        return view('pages.accounts.account_edit',
        compact(['data', 'liste_school', 'liste_role']));
    }
     // update
    public function update_admin_account_request(Request $request, $id)
    {
        if(!empty($id)){

            // dd($request->all()); die();
            if(empty($request->role_id)){
                MessageService::isEmpty('rôle');
                return back();
            }

            if(empty($request->fname)){
                MessageService::isEmpty('nom');
              return back();
            }

            if(empty($request->lname)){
                MessageService::isEmpty('prénoms');
              return back();
            }

            if(empty($request->email)){
                MessageService::isEmpty('email');
              return back();
            }

            if(empty($request->school)){
                MessageService::isEmpty('école');
              return back();
            }

            if(empty($request->phone)){
                MessageService::isEmpty('numéro de téléphone');
              return back();
            }

            if(empty($request->address)){
                MessageService::isEmpty('adresse');
              return back();
            }

            if(empty($request->city)){
                MessageService::isEmpty('la ville');
              return back();
            }

            if(empty($request->fonction)){
                MessageService::isEmpty('fonction');
              return back();
            }

            if(empty($request->matricule)){
                MessageService::isEmpty('matricule');
              return back();
            }


            $update_data = User::where('id', $id)->first();

            if(!empty($request->admin_img)){
                $update_data = admin_account::Where('id', $id)->first();
                if($request->hasFile('admin_img')):
                    $file = $request->file('admin_img');
                    $extension =  $file->getClientOriginalExtension();
                    $filename ="admin_img".time().'.'.$extension;

                    if($filename):
                        $img = Image::make($file->getRealPath());
                        $img->resize(600, 600);
                        $img->save('documents/admin-img/'.$filename);
                    else:
                        MessageService::isErrorFailed();
                        return back();
                    endif;

                    $path = "documents/admin-img/";
                    $update_data->admin_img = URL::to('').'/'.$path.$filename;
                endif;
            }

            $update_data->role_id = $request->role_id;
            $update_data->fname = $request->fname;
            $update_data->lname = $request->lname;
            $update_data->email = $request->email;
            $update_data->school = $request->school;
            $update_data->phone = $request->phone;
            $update_data->address = $request->address;
            $update_data->city = $request->city;
            $update_data->fonction = $request->fonction;
            $update_data->matricule = $request->matricule;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_admin_account');
            }
        }
    }
    // delete
    public function delete_new_admin_account($id){
        $data = DB::table('users')->where('id', $id)->delete();
        $users = User::where('user_id', $id)->delete();

        if(($data == true) && ($users == true)){

            $liste_admin = admin_account::join('roles', 'users.role_id', 'roles.id')
            ->select('roles.role', 'users.*')
            ->get();

            MessageService::successFully();
            return back();
        }
    }
    // check_user_account
    public function check_user_account(Request $request){
        // dd($request->all()); die();

        if(empty($request->password)){
            MessageService::isEmpty('mot de passe');
          return back();
        }

        if(empty($request->email)){
            MessageService::isEmpty('email');
          return back();
        }

        // dump($request->id);
        $users = User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);

        // dd($users); die();
        if(($users == true) || ($users == 1)){

            $update_data = User::where('id', $request->id)
            ->update(['status' => 1]);

            if(($update_data == true) || ($update_data == 1)){
                $liste_admin = admin_account::join('roles', 'users.role_id', 'roles.id')
                ->select('roles.role', 'users.*')
                ->get();

                MessageService::successFully();
                return view('pages.accounts.account_liste',
                compact(
                    [
                        'liste_admin'
                    ]
                ));
            }else{
                MessageService::isErrorFailedUser();
                return back();
            }
        }else{
            MessageService::isErrorFailedUser();
            return back();
        }
    }
//*🟠🟠🟠🟠*// 03. ADMIN ACCOUNT FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 04.ROLES FUNCTIONS //*🟠🟠🟠🟠*//
    // page
    public function add_new_role_page(){
        return view('pages.other-pages.roles.add_role');
    }
    // get
    public function liste_role()
    {
        $liste_role = role::all();

        return view('pages.other-pages.roles.liste_role',
        compact(
            [
                'liste_role'
            ]
        ));
    }
    // add
    public function add_new_role_request(Request $request)
    {
        if(empty($request->role)){
            MessageService::isEmpty('rôle');
            return back();
        }

        $add_data = new role();

        $add_data->role = $request->role;
        $add_data->slug = $request->slug;

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_role');
        }
    }

    // edit
    public function edit_new_role($id){
        $data = DB::table('roles')->where('id', $id)->first();
        return view('pages.other-pages.roles.edit_role',
        compact(['data']));
    }
    // update
    public function update_role_request(Request $request, $id)
    {
        if(!empty($id)){
            // dd($request->all()); die();
            if(empty($request->role)){
                MessageService::isEmpty('rôle');
                return back();
            }

            $update_data = role::Where('id', $id)->first();
            $update_data->role = $request->role;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_role');
            }
        }
    }
    // delete
    public function delete_new_role($id){
        $data = DB::table('roles')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return view('pages.other-pages.roles.liste_role');
        }
    }
//*🟠🟠🟠🟠*// 04.END ROLES FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 05.CLASSROOM FUNCTIONS //*🟠🟠🟠🟠*//
    // page
    public function add_new_classroom_page(){
        $liste_classe = [
            '6ème',
            '5ème',
            '4ème',
            '3ème',
            '2nd',
            '1ère',
            'Tle',
        ];
        $liste_level = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10',
            '',
            'A1-1',
            'A1-2',
            'A2-1',
            'A2-2',
            '',
            'C-1',
            'C-2',
            'D-1',
            'D-2',
        ];
        return view('pages.classrooms.add_classroom',
        compact(['liste_classe', 'liste_level']));
    }
    // get
    public function liste_classroom()
    {
        $liste_classroom = classroom::all();

        return view('pages.classrooms.liste_classroom',
        compact(
            [
                'liste_classroom'
            ]
        ));
    }
    // add
    public function add_new_classroom_request(Request $request)
    {
        if(empty($request->classroom)){
            MessageService::isEmpty('classe');
            return back();
        }
        if(empty($request->level)){
            MessageService::isEmpty('rôle');
            return back();
        }

        $add_data = new classroom();

        $add_data->classroom = $request->classroom;
        // $add_data->author_id = $request->classroom;
        $add_data->author_id = 1;
        $add_data->level = $request->level;
        $add_data->building = $request->building;
        $add_data->slug = CodeGenerator::slug();

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_classroom');
        }
    }
    // edit
    public function edit_new_classroom($id){

        $liste_classe = [
            '6ème',
            '5ème',
            '4ème',
            '3ème',
            '2nd',
            '1ère',
            'Tle',
        ];
        $liste_level = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10',
            '',
            'A1-1',
            'A1-2',
            'A2-1',
            'A2-2',
            '',
            'C-1',
            'C-2',
            'D-1',
            'D-2',
        ];
        $data = DB::table('classrooms')->where('id', $id)->first();
        return view('pages.classrooms.edit_classroom',
        compact(['data', 'liste_classe', 'liste_level']));
    }
    // update
    public function update_classroom_request(Request $request, $id)
    {
        if(!empty($id)){
            // dd($request->all()); die();
            if(empty($request->classroom)){
                MessageService::isEmpty('classe');
                return back();
            }
            if(empty($request->level)){
                MessageService::isEmpty('rôle');
                return back();
            }

            $update_data = classroom::Where('id', $id)->first();
            $update_data->classroom = $request->classroom;
            $update_data->level = $request->level;
            $update_data->building = $request->building;
            $update_data->slug = $request->slug;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_classroom');
            }
        }
    }
    // delete
    public function delete_new_classroom($id){
        $data = DB::table('classrooms')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return view('pages.classrooms.liste_classroom');
        }
    }
//*🟠🟠🟠🟠*// 05.END CLASSROOM FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 05.SCOLARITE FUNCTIONS //*🟠🟠🟠🟠*//
    // page
    public function add_new_scolarite_page(){
        // $liste_classroom = DB::table('classrooms')->get();
        $liste_niveau_etude = niveau_etude::all();
        return view('pages.scolarites.add_scolarite',
        compact(['liste_niveau_etude']));
    }
    // get
    public function liste_scolarite()
    {
        $author = 1;
        $liste_scolarite = scolarite::join('niveau_etudes', 'scolarites.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude', 'scolarites.*')
        ->where('scolarites.author_id', $author)
        ->get();
        return view('pages.scolarites.liste_scolarite',
        compact(
            [
                'liste_scolarite'
            ]
        ));
    }
    // add
    public function add_new_scolarite_request(Request $request)
    {
        if(empty($request->niveau_etude_id)){
            MessageService::isEmpty('classe');
            return back();
        }
        if(empty($request->price)){
            MessageService::isEmpty('prix');
            return back();
        }
        if(empty($request->school_year_start)){
            MessageService::isEmpty('année de début');
            return back();
        }

        if(empty($request->school_year_end)){
            MessageService::isEmpty('année de fin');
            return back();
        }

        $add_data = new scolarite();

        $author = 1;
        $add_data->author_id = $author;
        $add_data->niveau_etude_id = $request->niveau_etude_id;
        $add_data->price = $request->price;
        $add_data->school_year_start = $request->school_year_start;
        $add_data->school_year_end = $request->school_year_end;
        $add_data->slug = CodeGenerator::slug();

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_scolarite');
        }
    }
    // edit
    public function edit_new_scolarite($id){
        $liste_niveau_etude = DB::table('niveau_etudes')->get();
        $data = DB::table('scolarites')
        ->join('niveau_etudes', 'scolarites.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude', 'scolarites.*')
        ->where('scolarites.id', $id)->first();
        return view('pages.scolarites.edit_scolarite',
        compact(['data', 'liste_niveau_etude']));
    }
    // update
    public function update_scolarite_request(Request $request, $id)
    {
        if(!empty($id)){
            // dd($request->all()); die();
            if(empty($request->niveau_etude_id)){
                MessageService::isEmpty('classe');
                return back();
            }
            if(empty($request->price)){
                MessageService::isEmpty('prix');
                return back();
            }
            if(empty($request->school_year_start)){
                MessageService::isEmpty('année de début');
                return back();
            }
            if(empty($request->school_year_end)){
                MessageService::isEmpty('année de fin');
                return back();
            }

            $update_data = scolarite::Where('id', $id)->first();
            $update_data->niveau_etude_id = $request->niveau_etude_id;
            $update_data->price = $request->price;
            $update_data->school_year_start = $request->school_year_start;
            $update_data->school_year_end = $request->school_year_end;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_scolarite');
            }
        }
    }
    // delete
    public function delete_new_scolarite($id){
        $data = DB::table('scolarites')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return redirect()->route('dashboard.liste_scolarite');
        }
    }
//*🟠🟠🟠🟠*// 05.END SCOLARITE FUNCTIONS //*🟠🟠🟠🟠*//

//*🟠🟠🟠🟠*// 06. REGISTER STUDENT FUNCTIONS //*🟠🟠🟠🟠*//
    // pages
    public function add_new_student_page(){
        $liste_niveau_etude = niveau_etude::all();
        $author = 1;
        $liste_scolarite = scolarite::join('niveau_etudes', 'scolarites.niveau_etude_id', 'niveau_etudes.id')
        ->select('niveau_etudes.niveau_etude', 'scolarites.*')
        ->where('scolarites.author_id', $author)
        ->groupBy('scolarites.id', 'niveau_etude_id')
        ->get();

        return view('pages.fonctionalites.student_registers.add_student', compact(['liste_scolarite', 'liste_niveau_etude']));
    }

     // get
    public function liste_student()
    {
        $liste_admin = admin_account::join('roles', 'users.role_id', 'roles.id')
        ->select('roles.role', 'users.*')
        ->get();

        return view('pages.accounts.account_liste',
        compact(
            [
                'liste_admin'
            ]
        ));
    }

     // add
     public function add_new_student_request(Request $request)
     {
         if(empty($request->role_id)){
             MessageService::isEmpty('rôle');
             return back();
         }

         if(empty($request->fname)){
             MessageService::isEmpty('nom');
           return back();
         }

         if(empty($request->lname)){
             MessageService::isEmpty('prénoms');
           return back();
         }

         if(empty($request->email)){
             MessageService::isEmpty('email');
           return back();
         }

         if(empty($request->school)){
             MessageService::isEmpty('école');
           return back();
         }

         if(empty($request->phone)){
             MessageService::isEmpty('numéro de téléphone');
           return back();
         }

         if(empty($request->address)){
             MessageService::isEmpty('adresse');
           return back();
         }

         if(empty($request->city)){
             MessageService::isEmpty('la ville');
           return back();
         }

         if(empty($request->fonction)){
             MessageService::isEmpty('fonction');
           return back();
         }

         if(empty($request->matricule)){
             MessageService::isEmpty('matricule');
           return back();
         }

         if(empty($request->admin_img)){
             MessageService::isEmpty('photo');
           return back();
         }

        //  dd($request->all()); die();
         $add_data = new admin_account();

         if($request->hasFile('admin_img')):
            $file = $request->file('admin_img');
            $extension =  $file->getClientOriginalExtension();
            $filename ="admin_img".time().'.'.$extension;

            if($filename):
                $img = Image::make($file->getRealPath());
                $img->resize(600, 600);
                $img->save('documents/admin-img/'.$filename);
            else:
                MessageService::isErrorFailed();
                return back();
            endif;

            $path = "documents/admin-img/";
            $add_data->admin_img = URL::to('').'/'.$path.$filename;
        endif;

        if($request->accountActivation == "on"):
            $add_data->status = 1;
        endif;

        $add_data->role_id = $request->role_id;
        $add_data->fname = $request->fname;
        $add_data->lname = $request->lname;
        $add_data->email = $request->email;
        $add_data->school = $request->school;
        $add_data->phone = $request->phone;
        $add_data->address = $request->address;
        $add_data->city = $request->city;
        $add_data->fonction = $request->fonction;
        $add_data->matricule = $request->matricule;
        $add_data->slug = CodeGenerator::slug();

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_admin_account');
        }
     }

     // edit
     public function edit_new_student($id){
        $liste_school = school::all();
        $liste_role = role::all();
         $data = DB::table('users')
         ->join('roles', 'users.role_id', 'roles.id')
         ->select('roles.role', 'users.*')
         ->where('users.id', $id)->first();
         return view('pages.accounts.account_edit',
         compact(['data', 'liste_school', 'liste_role']));
     }
     // update
    public function update_student_request(Request $request, $id)
    {
        if(!empty($id)){

            // dd($request->all()); die();
            if(empty($request->role_id)){
                MessageService::isEmpty('rôle');
                return back();
            }

            if(empty($request->fname)){
                MessageService::isEmpty('nom');
              return back();
            }

            if(empty($request->lname)){
                MessageService::isEmpty('prénoms');
              return back();
            }

            if(empty($request->email)){
                MessageService::isEmpty('email');
              return back();
            }

            if(empty($request->school)){
                MessageService::isEmpty('école');
              return back();
            }

            if(empty($request->phone)){
                MessageService::isEmpty('numéro de téléphone');
              return back();
            }

            if(empty($request->address)){
                MessageService::isEmpty('adresse');
              return back();
            }

            if(empty($request->city)){
                MessageService::isEmpty('la ville');
              return back();
            }

            if(empty($request->fonction)){
                MessageService::isEmpty('fonction');
              return back();
            }

            if(empty($request->matricule)){
                MessageService::isEmpty('matricule');
              return back();
            }


            $update_data = admin_account::where('id', $id)->first();

            if(!empty($request->admin_img)){
                $update_data = admin_account::Where('id', $id)->first();
                if($request->hasFile('admin_img')):
                    $file = $request->file('admin_img');
                    $extension =  $file->getClientOriginalExtension();
                    $filename ="admin_img".time().'.'.$extension;

                    if($filename):
                        $img = Image::make($file->getRealPath());
                        $img->resize(600, 600);
                        $img->save('documents/admin-img/'.$filename);
                    else:
                        MessageService::isErrorFailed();
                        return back();
                    endif;

                    $path = "documents/admin-img/";
                    $update_data->admin_img = URL::to('').'/'.$path.$filename;
                endif;
            }

            $update_data->role_id = $request->role_id;
            $update_data->fname = $request->fname;
            $update_data->lname = $request->lname;
            $update_data->email = $request->email;
            $update_data->school = $request->school;
            $update_data->phone = $request->phone;
            $update_data->address = $request->address;
            $update_data->city = $request->city;
            $update_data->fonction = $request->fonction;
            $update_data->matricule = $request->matricule;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_admin_account');
            }
        }
    }
    // delete
    public function delete_new_student($id){
        $data = DB::table('users')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return view('pages.accounts.account_liste');
        }
    }
//*🟠🟠🟠🟠*// 06. REGISTER STUDENT FUNCTIONS //*🟠🟠🟠🟠*//


//*🟠🟠🟠🟠*// 07. NIVEAU ETUDE FUNCTIONS //*🟠🟠🟠🟠*//
    // pages
    public function add_new_niveau_etude_page(){
        return view('pages.other-pages.niveau_etude.add_niveau_etude');
    }

     // get
    public function liste_niveau_etude()
    {
        $liste_niveau_etude = niveau_etude::all();

        return view('pages.other-pages.niveau_etude.liste_niveau_etude',
        compact(
            [
                'liste_niveau_etude'
            ]
        ));
    }

     // add
     public function add_new_niveau_etude_request(Request $request)
     {
         if(empty($request->niveau_etude)){
             MessageService::isEmpty('niveau d\'étude');
             return back();
         }

        //  dd($request->all()); die();
        $add_data = new niveau_etude();
        $add_data->niveau_etude = $request->niveau_etude;
        $add_data->author_id = 1;
        $add_data->slug = CodeGenerator::slug();

        if($add_data->save()){
            MessageService::successFully();
            return redirect()->route('dashboard.add_niveau_etude');
        }
     }

     // edit
     public function edit_new_niveau_etude($id){
         $data = DB::table('niveau_etudes')
         ->where('id', $id)->first();
         return view('pages.other-pages.niveau_etude.edit_niveau_etude',
         compact(['data']));
     }
     // update
    public function update_niveau_etude_request(Request $request, $id)
    {
        if(!empty($id)){

            // dd($request->all()); die();
            if(empty($request->niveau_etude)){
                MessageService::isEmpty('niveau d\'étude');
                return back();
            }

            $update_data = niveau_etude::where('id', $id)->first();

            $update_data->niveau_etude = $request->niveau_etude;
            $update_data->author_id = 1;

            if($update_data->save()){
                MessageService::successFully();
                return redirect()->route('dashboard.liste_niveau_etude');
            }
        }
    }
    // delete
    public function delete_new_niveau_etude($id){
        $data = DB::table('niveau_etudes')->where('id', $id)->delete();

        if($data == true){
            MessageService::successFully();
            return view('pages.other-pages.niveau_etude.liste_niveau_etude');
        }
    }
//*🟠🟠🟠🟠*// 06. NIVEAU ETUDE FUNCTIONS //*🟠🟠🟠🟠*//

//* Niveau d'etude et refaire la logique de scolarite et classe *//
}
