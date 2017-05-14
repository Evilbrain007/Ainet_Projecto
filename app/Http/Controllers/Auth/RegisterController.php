<?php

namespace App\Http\Controllers\Auth;

use App\Department;
use App\Http\Controllers\Controller;
use App\Jobs\SendVerificationEmail;
use App\PasswordReset;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        //Register Function Overriden from class "RegistersUsers"
        //Laravel Code
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        ////////

        //Our Code
        if ($request->file('file')->isValid()) {
            $path = $request->file('file')->store('userImages');
            /*$imageManager = new ImageManager();
            $img = $imageManager->make($path);*/
            $user->setAttribute('profile_photo', $path);
        }

        // activation token
        $activation = PasswordReset::where('email', $user->email)->first();
        $user->save();
        ////////

        dispatch(new SendVerificationEmail($activation, $user));

        $title = 'Verificação de conta';
        return view('auth.verification', compact('title'));

        /* old code
        //Laravel Code
        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
        */
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|size:9',
            'department_id' => 'required',
            'file' => 'image',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'department_id' => $data['department_id'],
        ]);
    }

    public function showRegistrationForm()
    {
        $title = "Página de Registo";
        $departments = Department::all();
        return view('auth.register', compact('departments', 'title'));
    }

    public function verify($token)
    {
        $activation = PasswordReset::first('token', $token);
        $user = User::first('email', $activation->email);
        $user->blocked = 0;
        if ($user->save()) {
            $title = "Email confirmado";
            return view('auth.emailconfirm', compact('title', 'user'));
        }
    }

    protected function registered(Request $request, $user)
    {
        redirect(route('home'));
    }


}
