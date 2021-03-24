<?php

namespace App\Http\Controllers\Capturer;
use App\Http\Controllers\Controller;
use App\Model\Capturer;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest:capturer')->except('logout');
    }

	public function showLoginForm()
    {
        return view('auth.login', ['url' => 'capturers']);
    }

    public function login(Request $request)
	{
	    $validate = Validator::make($request->all(), [
            'email'   => 'required|email|exists:capturers,email',
            'password' => 'required|min:6'
        ],
        [
            'email.exists' => 'Email doesn'."'".'t exist!',
            'email.required' => 'Please enter an Email!',
            'password.required' => 'Please enter a Password!',
        ] );

        if($validate->fails())
        {
            return back()->withInput($request->only('email', 'remember'))->withErrors($validate);
        }
        // return $request;

	    if (Auth::guard('capturer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
	    	
	        return redirect('capturers/dashboard');
	    }
	    return back()->withInput($request->only('email'))->withErrors(['password'=>'Wrong password!']);
	}

	public function showRegisterForm()
    {
        $url = 'capturers';
        return view('auth.register', ['url' => $url]);
    }

    protected function create(Request $request)
    {
        // return$request;
        $validate = Validator::make($request->all(), [
            'name'   => 'required|string|max:255',
            'email'   => 'required|email|unique:toilet_owners,email',
            'password' => 'required|min:6|confirmed',
            'mobileno' => 'required|numeric|min:10|unique:toilet_owners,mobileno',
        ],
        [
            'email.unique' => 'Email already exists try logging-in or use another!',
            'mobileno.unique' => 'Phone number exists try logging-in or use another!',
            'email.required' => 'Please enter an Email!',
            'password.required' => 'Please enter a Password!',
        ] );

        if($validate->fails())
        {
            return back()->withInput($request->except('password'))->withErrors($validate);
        }
        $writer = Capturer::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobileno' => $request['mobileno'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('capturer/login')->withInput($request->only('email'))->with('reg.msg',' Registered successfully, please login');
    }
    
	public function logout(Request $request)
    {
        Auth::guard('capturer')->logout();

        $request->session()->forget('capturer');

        return redirect()->route('to.login');
    }
}

