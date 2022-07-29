@extends('layouts.admin')

@section('title')
Store Dashboard Transaction
@endsection

@push('addon-style')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
@endpush

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">Dashboard</h2>
      <p class="dashboard-subtitle">
        Big result start from the small one
      </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12 mt-2">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Transaction Product</button>
            </li>
            {{-- <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Buy Product</button>
            </li> --}}
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              @foreach ($sellTransactions as $transaction)
              <a href="{{ route('transaction.index', $transaction->id) }}" 
              class="card card-list dblock"
              >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-1">
                      <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}" class="w-50"/>
                    </div>
                    <div class="col-md-4">
                      {{ $transaction->product->name }}
                    </div>
                    <div class="col-md-3">
                      {{ $transaction->product->user->store_name }}
                    </div>
                    <div class="col-md-3">
                      {{ $transaction->created_at }}
                    </div>
                    <div class="col-md-1 d-none d-md-block">
                      <img src="/images/dashboard-arrow-right.svg" alt="">
                    </div>
                  </div>
                </div>
              </a>
              <a href="{{ route('transaction.show', $transaction->id) }}" 
                class="card card-list dblock"
                >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-1">
                      <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}" class="w-75"/>
                    </div>
                    <div class="col-md-4">
                      {{ $transaction->product->name ?? '' }}
                    </div>
                    <div class="col-md-3">
                      {{ $transaction->transaction->user->name ?? '' }}
                    </div>
                    <div class="col-md-3">
                      {{ $transaction->craated_at ?? '' }}
                    </div>
                    <div class="col-md-1 d-none d-md-block">
                      <img src="/images/dashboard-arrow-right.svg" alt="">
                    </div>
                  </div>
                </div>
              </a>
              @endforeach
              
              @foreach ($buyTransactions as $transaction)
              <a href="{{ route('transaction.show', $transaction->id) }}" 
              class="card card-list dblock"
              >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-1">
                      @if ($transaction->product->galleries)
                        <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}" class="w-50"/>
                      @endif
                    </div>
                    <div class="col-md-4">
                      {{ $transaction->product->name }}
                    </div>
                    <div class="col-md-3">
                      {{ $transaction->product->user->store_name }}
                    </div>
                    <div class="col-md-3">
                      {{ $transaction->created_at }}
                    </div>
                    <div class="col-md-1 d-none d-md-block">
                      <img src="/images/dashboard-arrow-right.svg" alt="">
                    </div>
                  </div>
                </div>
              </a>
              @endforeach
            </div>
          </div>                      
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/vendor/vue/vue.js"></script>
<script>
  var transactionDetails = new Vue({
    el: '#transactionDetails',
    data: {
      status: "{{ $transaction->shipping_status }}",
      resi: "{{ $transaction->resi }}",
    },
  });
</script>
@endpush