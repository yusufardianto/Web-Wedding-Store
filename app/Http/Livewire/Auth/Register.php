<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Validated;
use Illuminate\Foundation\Auth\RegistersUsers;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class Register extends Component
{
    use RegistersUsers;
    use WithPagination;
    /** @var string */
    public $name = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $passwordConfirmation = '';

    // protected $redirectTo = RouteServiceProvider::HOME;

    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $categories = Category::all();
        return view('livewire.auth.register', [
            'categories' => $categories
        ]);
    }

    // public function register(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'store_name' => ['nullable', 'string', 'max:255'],
    //         'phone_number' => ['nullable', 'string', 'max:255'],
    //         'nik' => ['nullable', 'string', 'max:255'],
    //         'categories_id' => ['nullable', 'integer', 'exists:categories,id'],
    //         'is_store_open' => ['required'],
    //     ]);
    // }
    // protected function create(Request $request, array $data)
    // {
    //     dd($data);
    //     $ktp = $request->file('ktp')->store('assets/user', 'public');
    //     dd($ktp);
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'store_name' => isset($data['store_name']) ? $data['store_name'] : '',
    //         'categories_id' => isset($data['categories_id']) ? $data['categories_id'] : NULL,
    //         'store_status' => isset($data['is_store_open']) ? 1 : 0,
    //         // 'ktp' => file('ktp')->store('assets/product', 'public'),
    //         'categories_id' => isset($data['categories_id']) ? $data['categories_id'] : NULL,
    //         'store_status' => isset($data['is_store_open']) ? 1 : 0,
    //     ]);
    // }
    public function register(array $data)
    {
        // dd($request->all());
        return Validator::make($data, [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
            'store_name' => ['nullable', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'max:255'],
            'categories_id' => ['nullable', 'integer', 'exists:categories,id'],
            'is_store_open' => ['required'],
        ]);
        // $ktp = $request->file('ktp')->store('assets/user', 'public');
        // dd($ktp);
        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
            'store_name' => isset($data['store_name']) ? $data['store_name'] : '',
            'phone_number' => isset($data['phone_number']) ? $data['phone_number'] : '',
            'nik' => isset($data['nik']) ? $data['nik'] : '',
            // $data['photos'] = $request->file('photos')->store('assets/product', 'public'),
            'categories_id' => isset($data['categories_id']) ? $data['categories_id'] : NULL,
            'store_status' => isset($data['is_store_open']) ? 1 : 0,

            // 'store_name' => $request->post('store_name', NULL),
            // 'phone_number' => $request->post('phone_number', NULL),
            // 'nik' => $request->post('nik', NULL),
            // $data['photos'] = $request->file('photos')->store('assets/product', 'public'),
            // 'categories_id' => isset($data['categories_id']) ? $data['categories_id'] : NULL,
            // 'store_status' => isset($data['is_store_open']) ? 1 : 0,
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended(route('home'));
    }


    public function render()
    {
        return view('livewire.auth.register', [
            'categories' => Category::latest()->get(),
        ])->extends('layouts.auth');
    }
    public function success()
    {
        return view('livewire.auth.success');
    }
    public function check(Request $request)
    {
        return User::where('email', $request->email)->count() > 0 ? 'Unavailable' : 'Available';
    }
}
