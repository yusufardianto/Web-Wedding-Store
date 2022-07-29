<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct()
    {
        $this->middleware('guest');
    }
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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['nullable', 'string', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'store_name' => isset($data['store_name']) ? $data['store_name'] : '',
            'categories_id' => isset($data['categories_id']) ? $data['categories_id'] : NULL,
            'nik' => isset($data['nik']) ? $data['nik'] : '',
            'phone_number' => isset($data['phone_number']) ? $data['phone_number'] : '',
            //upload image
            // $image = $request->file('ktp');
            // $image->storeAs('assets/user', $image->hashName());
            // $datakategori = Kategori::create([
            //     'ktp'     => $image->hashName(),    
            // ]);
            'ktp' => isset($data['ktp']) ? $data['ktp'] : '',
            // ->store('assets/user', 'public'),
            'pas_foto' => isset($data['pas_foto']) ? $data['pas_foto'] : '',
            // ->store('assets/user', 'public'),
            'surat_izin' => isset($data['surat_izin']) ? $data['surat_izin'] : '',
            // ->store('assets/user', 'public'),
            'store_status' => isset($data['is_store_open']) ? 1 : 0,
        ]);
    }
    // public function render()
    // {
    //     return view('livewire.auth.register')->extends('layouts.auth');
    // }
    public function success()
    {
        return view('livewire.auth.success');
    }

    public function check(Request $request)
    {
        return User::where('email', $request->email)->count() > 0 ? 'Unavailable' : 'Available';
    }
}
