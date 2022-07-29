@extends('layouts.app')

@section('title')
Store Cart Page
@endsection

@section ('content')
<div class="page-content page-cart">
  <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item active">
                <a href="/index.html">Home</a>
              </li>
              <li class="breadcrumb-item active">
                Cart
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <section class="store-cart">
      <div class="container"> 
        <form action="{{ route('checkout') }}" enctype="multipart/form-data" method="POST">
          @csrf
            <div class="row" data-aos="fade-up" data-aos-delay="100">
              <div class="col-12 table-responsive">
                <table class="table table-borderless table-cart">
                  <thead>
                    <tr>
                      <td></td>
                      <td>image</td>
                      <td>Name &amp; Seller</td>
                      <td>Price</td>
                      <td>Rental Date</td>
                    </tr>
                  </thead>
                  <tbody>
                    @php $totalPrice = 0;
                    @endphp
                    @foreach ($carts as $cart)
                    <tr>
                      <td style="width: 5%;">
                          <a href="{{ route('cart-delete', $cart->id) }}" class="delete-gallery">
                            @csrf
                            <img src="/images/icon-delete.svg" alt="">
                          </a>
                      </td>
                      <td style="width: 25%;">
                        @if ($cart->product->galleries)
                          <img 
                            src="{{ Storage::url($cart->product->galleries->first()->photos) }}" 
                            alt="" 
                            class="cart-image"/>
                        @endif
                      </td>
                      <td style="width: 35%;">
                        <div class="product-title">{{ $cart->product->name }}</div>
                        <div class="product-subtitle">by {{ $cart->product->user->store_name }}</div>
                      </td>
                      <td style="width: 20%;">
                          <div class="product-title" 
                          {{-- v-model="price" :class="{'is-invalid' : this.price_unavailable}" --}}
                          >${{ number_format($cart->product->price) }}</div>
                        <div class="product-subtitle">USD</div>
                      </td>
                      <td style="width: 35%;" id="date">
                        <input 
                          type="date" 
                          @change="checkForRentalDateAvailability()"
                          class="form-control @error('rental_date') is-invalid @enderror" 
                          :class="{'is-invalid' : this.rental_date_unavailable}"
                          name="rental_date" 
                          value="{{ old('rental_date') }}"
                          required
                          v-model="rental_date"
                          placeholder="rental_date"
                          autocomplete="rental_date"
                          autofocus
                          >
                            @error('rental_date')
                                <span class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </span>
                                  @enderror
                        </div>
                      </td>
                    </tr>
                    @php $totalPrice += $cart->product->price @endphp
                    @endforeach
              </tbody>
              </table>
              </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
              <div class="col-12">
                <hr>
              </div>
              <div class="col-12">
                <h2 class="mb-4">
                  Address Details
                </h2>
              </div>
            </div>
            <input type="hidden"  name="total_price" value="{{ $totalPrice }}">
            <div class="row mb-2" id="locations" data-aos="fade-up" data-aos-delay="200">
              {{-- <div class="col-md-4">
                <div class="form-grub">
                  <label for="addressone">Date</label>
                  
                {{-- </div> --}}
              {{-- </div> --}}
              <div class="col-md-6">
                <div class="form-grub">
                  <label for="addressone">Address 1</label>
                  <input 
                  type="text" 
                  class="form-control" 
                  id="addressone" 
                  name="addressone" 
                  value="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-grub">
                  <label for="addresstwo">Address 2</label>
                  <input 
                  type="text" 
                  class="form-control" 
                  id="addresstwo" 
                  name="addresstwo" 
                  value="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-grub">
                  <label for="provinces_id">Province</label>
                  <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id">
                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-grub">
                  <label for="regencies_id">City</label>
                  <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-grub">
                  <label for="zip_code">Postal Code</label>
                  <input 
                  type="text" 
                  class="form-control" 
                  id="zip_code" 
                  name="zip_code" 
                  value="61261">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-grub">
                  <label for="country">Country</label>
                  <input 
                  type="text" 
                  class="form-control" 
                  id="country" 
                  name="country" 
                  value="Indonesia">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-grub">
                  <label for="phone_number">Mobile</label>
                  <input 
                  type="text" 
                  class="form-control" 
                  id="phone_number" 
                  name="phone_number" 
                  value="+628 8123 456789">
                </div>
              </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
              <div class="col-12">
                <hr>
              </div>
              <div class="col-12">
                <h2 class="mb-4">
                  Payment Information
                </h2>
              </div>
            </div>
            
            <div class="row" data-aos="fade-up" data-aos-delay="200">
              <div class="col-4 col-md-2">  
                <div class="product-title">$0</div>
                <div class="product-subtitle">Country Tax</div>
              </div>
              <div class="col-4 col-md-3">  
                <div class="product-title">$0</div>
                <div class="product-subtitle">Product Insurance</div>
              </div>
              <div class="col-4 col-md-2">  
                <div class="product-title">$0</div>
                <div class="product-subtitle">Ship to Jakarta</div>
              </div>
              <div class="col-4 col-md-2">  
                <div class="product-title text-success">${{ number_format($totalPrice ?? 0) }}</div>
                <div class="product-subtitle">Total</div>
              </div>
              <div class="col-8 col-md-3">
                {{-- <a href="" type="submit :disabled: "this.rental_date_unavailable" class="btn btn-success mt-4 px-4 btn-block">
                  <img src="/images/icon-delete.svg" alt="">Checkout Now
                </a> --}}
                <button type="submit" class="btn btn-success mt-4 px-4 btn-block" :disabled="this.rental_date_unavailable">Checkout Now</button>
              </div>
            </div>
        </form>
      </div>
  </section>
</div>
@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  Vue.use(Toasted);

  var date = new Vue({
    el: "#date",
    mounted(){
      AOS.init();
    },
    methods: {
      checkForRentalDateAvailability: function() {
        var self = this;
        axios.get('{{ route('api-date-check') }}', {
          params: {
            rental_date: this.rental_date,
            products_id: this.products_id,
          }
        })
            .then(function (response) {
              console.log(response.data)
              if(response.data == 'Available') {
                self.$toasted.show(
                  "Tanggal tersedia! Silahkan lanjut langkah selanjutnya!",
                  {
                    position: "top-center",
                    className: "rounded",
                    duration: 1000,
                  }
                );
                self.rental_date_unavailable = false;
                self.products_id_unavailable = false;

              } else {
                  self.$toasted.error(
                  "Maaf, tampaknya produk sudah terpesan pada tanggal ini.",
                  {
                    position: "top-center",
                    className: "rounded",
                    duration: 1000,
                  }
                );
                self.rental_date_unavailable = true;
                self.products_id_unavailable = true;
              }
              // handle success
              console.log(response);
            });
        }
    },
    data() {
      return {
        rental_date: "",
        products_id:"16",
        rental_date_unavailable: false,
        products_id_unavailable: false,
      }
    },
  });
</script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
          AOS.init();
          this.getProvincesData();
        },
        data: {
          // rental_date: "date",
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null
        },
        methods: {
          getProvincesData(){
            var self = this;
            axios.get('{{ route('api-provinces') }}')
            .then(function(response){
              self.provinces = response.data;
            })
          },
          getRegenciesData(){
            var self = this;
            axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
            .then(function(response){
              self.regencies = response.data;
            })
          },
        },
        watch: {
          provinces_id: function(val, oldVal){
            this.regencies_id = null;
            this.getRegenciesData();
          }
        }
      });
    </script>
@endpush