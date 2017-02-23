<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use UTEM\Utils\Rut;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'rut' => 'required|max:20|rut',
            'password' => 'required|min:6|confirmed',
            'nombre'=> 'required|max:10',
            'apellido'=> 'required|max:15',
            'direccion'=> 'required|max:40',
            'ncelular'=> 'required|max:8',
            'email'=> 'required|max:20',
            'sexo'=> ['required',Rule::in(['0','1'])]

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      $datos=array_except($data,['_token','rut','password_confirmation','password']);
      $rut = Rut::rut($data['rut']);
      $datos=array_add($datos,'rut',$rut);
      $datos=array_add($datos,'password',Hash::make($data['password']));

      DB::insert('insert into users (nombre, apellido,direccion,ncelular,email,rut,sexo,password) values(?,?,?,?,?,?,?,?)',
        [
          $datos['nombre'],
          $datos['apellido'],
          $datos['direccion'],
          $datos['ncelular'],
          $datos['email'],
          $rut,
          $datos['sexo'],
          Hash::make($datos['password'])
        ]);
        return DB::getPdo()->lastInsertId();
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->loginUsingId($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

}
