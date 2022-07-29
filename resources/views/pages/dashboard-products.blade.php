@extends('layouts.dashboard')

@section('title')
Store Dashboard Product
@endsection

@section('content')
<div id="page-content-wrapper">
  <nav 
  class="navbar navbar-expand-lg navbar-light navbar-store fixed-top"
  data-aos="fade-down"
  >
  <div class="container-fluid"> 
    <button class="btn btn-secondary d-md-none mr-auto mr-2"
    id="menu-toggle">
      &laquo; Menu
    </button> 
    <button 
      class="navbar-toggler" 
      type="button" 
      data-toggle="collapse" 
      data-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    
  </div>
  </nav>
  
  <div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">My Products</h2>
        <p class="dashboard-subtitle">
          Manage it well and get money
        </p>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-12">
            <a href="{{ route('dashboard-product-create') }}" class="btn btn btn-danger">
              Add New Product
            </a>
          </div>
        </div>
        <div class="row mt-4">
          @foreach ($products as $product)
              <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('dashboard-product-delete', $product->id) }}" class="delete-gallery">
                  <img src="/images/icon-delete.svg" alt="">
                </a>
                <a href="{{ route('dashboard-product-details', $product->id) }}" 
                class="card card-dashboard-product d-block">
                <div class="card-body">
                  <!-- download png -->
                  <img src="{{ Storage::url($product->galleries->first()->photos ?? '') }}" alt="" class="w-100 mb-2">
                  <div class="product-title">{{ $product->name }}</div>
                  <div class="product-category">{{ $product->category->name }}</div>
                </div>
              </a>
              </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 