<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class authController extends Controller
{

    public function index()
    {
        return view('auth.index');
    }
    
     function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

     function callback()
    {
        $user = Socialite::driver('google')->user();
        $id = $user->id;
        $email = $user->email;
        $name = $user->name;
        $avatar = $user->avatar;


        $cek = User::where('email', $email)->count();
        if($cek > 0 ) {
         
        $avatar_file = $id .".jpg";
        $fileContact = file_get_contents($avatar);  
        File::put(public_path('admin/images/faces/$avatar_files'), $fileContact); 
        // ini akan mengupdate data jika sudah ada 
        // serta akan membuat data jika belum ada            
        $user = User::updateOrCreate(

                             ['email'=> $email],
                             [
                              'name' => $name,
                              'google_id' => $id,
                              'avatar' => $avatar_file// avatar file ini gabungan dari id google avatar nya dan extensi nya
                             ]   
             );      
            Auth::login($user); 
            return redirect()->to('dashboard');

        } else {
            return redirect()->to('auth')->with('error', 'account yg kamu masukan tidak diizinkan untuk mengunakan halaman Admin');
        }             
    }

     function logout(Request $request): RedirectResponse
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/auth');
    }
}
