@extends('layouts.auth')
@section('title', 'Create a new account')

<div class="page-content page-auth" id="register">
    <div class="section-storepauth" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center justify-content-center row-login">
          <div class="col-lg-4">
            <h2>
              Memulai untuk jual beli<br>
              dengan cara terbaru
            </h2>
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group">
                <label>Full Name</label>
                {{-- <input type="text" class="form-control is-valid" v-model="name" autofocus> --}}
                <input id="name" 
                type="text" 
                v-model="name" 
                class="form-control @error('name') is-invalid @enderror" 
                name="name" 
                value="{{ old('name') }}" 
                required 
                autocomplete="name" 
                autofocus>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                
                {{-- <input wire:model.lazy="name" id="name" type="text" required autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror --}}
              </div>
              <div class="form-group">
                <label>Email Address</label>
                {{-- <input type="email" class="form-control is-invalid" v-model="email"> --}}
                <input id="email" 
                  type="email" 
                  v-model="email"
                  @change="checkForEmailAvailability()"
                  class="form-control @error('email') is-invalid @enderror" 
                  :class="{'is-invalid' : this.email_unavailable}"
                  name="email" 
                  value="{{ old('email') }}" 
                  required 
                  autocomplete="email" 
                  autofocus>
                @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Password</label>
                {{-- <input type="Password" class="form-control w-75"> --}}
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Konfirmasi Password</label>
                {{-- <input type="Password" class="form-control w-75"> --}}
                <input id="password-confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  required autocomplete="new-password" autofocus>
                @error('password_confirm')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
              {{-- <div class="form-group">
                <label>Store</label>
                <p class="text-muted">
                  Apakah anda juga ingin membuat toko?
                </p>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" 
                  class="custom-control-input" 
                  name="is_store-open" 
                  id="openStoreTrue" 
                  v-model="is_store_open" 
                  :value="true">
                  <label for="openStoreTrue" class="custom-control-label">
                    Iya, boleh
                  </label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" 
                  class="custom-control-input" 
                  name="is_store-open" 
                  id="openStoreFalse" 
                  v-model="is_store_open" 
                  :value="false">
                  <label for="openStoreFalse" class="custom-control-label">
                    Enggak, makasih
                  </label>
                </div>
              </div> --}}
              <div class="form-group" >
                <label>Nama Toko</label>
                <input type="text" 
                  {{-- v-model="store_name"  --}}
                  id="store_name" 
                  class="form-control @error ('store_name') is-invalid @enderror" 
                  name="store_name" 
                  required 
                  autocomplete="store_name"
                  autofocus>
                @error('store_name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
              <div class="form-group" >
                <label>Nomor yang dapat dihubungi</label>
                <input type="text" 
                  {{-- v-model="phone_number"  --}}
                  id="phone_number" 
                  class="form-control @error ('phone_number') is-invalid @enderror" 
                  name="phone_number" 
                  required 
                  autocomplete="phone_number"
                  autofocus>
                @error('phone_number')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
              <div class="form-group" v-if="is_store_open">
                <label>Nik</label>
                <input type="text" 
                  {{-- v-model="nik"  --}}
                  id="nik" 
                  class="form-control @error ('nik') is-invalid @enderror" 
                  name="nik" 
                  required 
                  autocomplete="nik"
                  autofocus>
                @error('nik')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
              <div class="form-group" >
                <label>Pas Foto</label>
                <input type="file" 
                  {{-- v-model="pas_foto"  --}}
                  id="pas_foto" 
                  class="form-control @error ('pas_foto') is-invalid @enderror" 
                  name="pas_foto" 
                  required 
                  autocomplete="pas_foto"
                  autofocus>
                @error('pas_foto')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
              <div class="form-group" >
                <label>Foto Ktp</label>
                <input type="file" 
                  {{-- v-model="ktp"  --}}
                  id="ktp" 
                  class="form-control @error ('ktp') is-invalid @enderror" 
                  name="ktp" 
                  required 
                  autocomplete="ktp"
                  autofocus>
                @error('ktp')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
              <div class="form-group" >
                <label>Surat Izin Buka Toko</label>
                <input type="file" 
                  {{-- v-model="surat_izin"  --}}
                  id="surat_izin" 
                  class="form-control @error ('surat_izin') is-invalid @enderror" 
                  name="surat_izin" 
                  required 
                  autocomplete="surat_izin"
                  autofocus>
                @error('surat_izin')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                @enderror
              </div>
              <div class="form-group" >
                <label>Kategori</label>
                <select name="categories_id" class="form-control">
                  <option value="" disabled>Select Category</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                   {{-- @forelse ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @empty
                    <option value="" disabled>No Category</option>
                  @endforelse --}}
                </select>
              </div>
              <button type="submit" class="btn btn-success btn-block mt-4" :disabled="this.email_unavailable">Sign Up Now</button>
              <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-4">Back to Sign in</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  

{{-- <div class="container hide" style="display: none">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}">
            <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
        </a>

        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            Create a new account
        </h2>

        <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
            Or
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                sign in to your account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form wire:submit.prevent="register">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 leading-5">
                        Name
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                    </div>
                    <input wire:model.lazy="name" id="name" type="text" required autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                        Email address
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="email" id="email" type="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                        Password
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="password" id="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 leading-5">
                        Confirm Password
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.lazy="passwordConfirmation" id="password_confirmation" type="password" required class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 appearance-none rounded-md focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                            Register
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- @endsection --}}

@push('addon-script')
  <script src="/vendor/vue/vue.js"></script>
  <script src="https://unpkg.com/vue-toasted"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      Vue.use(Toasted);

      var register = new Vue({
        el: '#register',
        mounted() {
          AOS.init();
          
        },
        methods: {
          checkForEmailAvailability: function() {
            var self = this;
            axios.get('{{ route('api-register-check') }}', {
              params: {
                  email: this.email
              }
            })
                .then(function (response) {
                  if(response.data == 'Available') {
                    self.$toasted.show(
                      "Email anda tersedia! Silahkan lanjut langkah selanjutnya!",
                      {
                        position: "top-center",
                        className: "rounded",
                        duration: 1000,
                      }
                    );
                    self.email_unavailable = false;

                  } else{
                      self.$toasted.error(
                      "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
                      {
                        position: "top-center",
                        className: "rounded",
                        duration: 1000,
                      }
                    );
                    self.email_unavailable = true;
                  }
                  // handle success
                  console.log(response);
                });
            }
        },
        data() {
            return {
            name: "Puspita Kharisma",
            email: "kharis@gmail.com",
            is_store_open: true,
            store_name: "",
            email_unavailable: false
          }
        },
      });
    </script>

@endpush