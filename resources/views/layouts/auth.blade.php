{{-- @extends('layouts.base')

@section('body')
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </div>
@endsection --}}


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />        
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')

  </head>

  <body>
    {{-- Navbar --}}
    @include('includes.navbar-auth')

    {{-- Page Content --}}
    @yield('content')

   {{-- Footer --}}
    @include('includes.footer')
    
  

    <!-- Bootstrap core JavaScript -->
   {{-- Script --}}
   @stack('prepend-script')
   @include('includes.script')
   @stack('addon-script')

  </body>
</html>
