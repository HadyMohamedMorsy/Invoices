<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\attachments;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\UploadFileTrait;

class RegisterController extends Controller
{

        use UploadFileTrait;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name'                      => ['required', 'string', 'max:255'],
            'email'                     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'                  => ['required', 'string', 'min:8', 'confirmed'],
            'file'                      => 'required|max:10000|mimes:pdf,png,jpg',
        ],
        [
            'file.required'             => 'this file is require to upload',
            'file.max'                  => 'this file maximum 10000kb',
            'file.mimes'                => 'this type is Strange'
        ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     * 
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
                
        // $this->UploadFile($data['file'], 'images/users' , $user->id);

        $requestFile = $data['file'];
        // Take Extension 
        
        $file_extension = $requestFile->getClientOriginalExtension();

        $file_name = time().'.'.$file_extension;
        
        // Upload Your File On The Server
        $requestFile->move('images/users', $file_name);

        User::find($user->id)->photoAttach()->create([
            'image_name' => $file_name,
            'type'       => $file_extension
        ]);

        return $user;

    }
}
