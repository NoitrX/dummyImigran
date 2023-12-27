<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index() {
        return view('Auth.login');
    }

    public function register()
    {
        return view('Auth.register');
    }

    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email:dns'],
                'password' => ['required']
            ],
            [
                'email.required'=> 'Kolom Ini Harus Diisi!!',
                'password.required' => 'Password Wajib Diisi!!',
            ]);
    

            $user = User::where('email', $credentials['email'])->first();
    
            if ($user) {
                if ($user->status_account != 'Approved') {
                    throw new \Exception('Your account is not approved yet.');
                }
    
                if (Auth::guard('web')->attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended('/users');
                }
            }
    
        
            $admin = Admin::where('email', $credentials['email'])->first();
    
            if ($admin) {
                if (Auth::guard('admin')->attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended('/users');
                }
            }
    
            throw new \Exception('Invalid credentials');
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return redirect('/');
          }elseif(Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect('/');
          }
    }

    public function storePmi(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nama_bapak' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'agama' => 'required',
            'no_telp' => 'required',
            'no_surat_izin' => 'required',
            'pendidikan' => 'required',
            'status_menikah' => 'required',
            'doc_ktp' => 'required|mimes:pdf|max:3072',
            'doc_surat_izin' => 'required|mimes:pdf|max:3072',
            'foto' => 'required|mimes:png,jpg,jpeg|max:3072',
            'doc_kk' => 'required|mimes:pdf|max:3072',
            'doc_akta' => 'required|mimes:pdf|max:3072',
            'alamat' => 'required',        
         ]);

         if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(); 
        }

        try {
            $storeApi = $this->userRepository->addData($request);
            return redirect('/register')
            ->with('success', 'Pendaftaran berhasil! Silahkan Tunggu Admin Menghubungi Untuk verifikasi Data!');
        }catch(Exception $e)
        {
            $e;
        }  
    }
    public function checkEmail($email, $id = null) {
        $check = User::where('email', $email);
        if($id) $check = $check->where('id', '!=', $id);
        $check = $check->first();

        if ($check) throw ValidationException::withMessages(['email' => 'Email sudah ada']);
    }
}
