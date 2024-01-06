<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Province;
use App\Models\Regency;
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
        $province = Province::all();
        $regency = Regency::all();
        return view('Auth.register', compact('regency', 'province'));
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
    
               
                    if ($user->level == 'direktur') {
                        return redirect()->intended('/direktur');
                        return 'ini direktur';
                    } elseif ($user->level == 'admin') {
                        return redirect()->intended('/dashboard');
                    }
                }
            }
    
            $admin = Admin::where('email', $credentials['email'])->first();
    
            if ($admin) {
                if (Auth::guard('admin')->attempt($credentials)) {
                    $request->session()->regenerate();
    
           
                    if ($admin->level == 'direktur') {
                        return redirect()->intended('/direktur');
                    } elseif ($admin->level == 'admin') {
                        return redirect()->intended('/users');
                    }elseif($admin->level == 'pewawancara') {
                        return redirect()->intended('/users-wawancara');
                    }
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


        // dd($request->all());
    
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
            'no_nik' => 'required|numeric|digits:16',
            'no_kk' => 'required|numeric|digits:16',
            'pendidikan' => 'required',
            'status_menikah' => 'required',
            'doc_ktp' => 'required|mimes:pdf|max:3072',
            'doc_surat_izin' => 'required|mimes:pdf|max:3072',
            'foto' => 'required|mimes:png,jpg,jpeg|max:3072',
            'doc_kk' => 'required|mimes:pdf|max:3072',
            'doc_akta' => 'required|mimes:pdf|max:3072',
            'buku_nikah' => 'mimes:pdf|max:3072',
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

    public function getKab(Request $request, $regencyId)
    {
            $regency = Regency::with('province')->find($regencyId);

            if (!$regency) {
                return response()->json(['error' => 'Regency not found'], 404);
            }

            $provinceName = $regency->province->name;

            return response()->json(['province' => $provinceName]);
            }
}
