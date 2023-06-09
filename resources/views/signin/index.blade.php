<!-- ======= Hero Section ======= -->
<section id="hero">

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 text-center pt-5 pt-lg-0 order-2 order-lg-1">
          <div data-aos="zoom-out">
            <h1>{{ $title }}</h1>
          </div>
        </div>
      </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about pb-5">
        <div class="container">
  
          <div class="row">

            {{-- gambar --}}
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header">Silahkan Login</div>
                    <div class="card-body">

                        <div class="alert alert-info">
                            <?php if(session()->get('username_client') !='') { ?>
                                Halo <strong>{{ session()->get('nama_client') }}</strong> Silahkan melanjutkan transaksi.
                            <?php }else{ ?>
                                <strong>Perhatian: </strong>Sedang bertransaksi? Silahkkan <a href="{{ asset('keranjang/checkout') }}">Checkout di sini</a>
                            <?php } ?>
                        </div>

                        {{-- error input --}}
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                        @endif
          
                        <form action="{{ asset('signin/proses-login') }}" method="post" accept-charset="utf-8">
                            {{ csrf_field() }}
                            
                            <div class="form-group row mb-3">
                                <label class="col-md-3">Email (Username)</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3">Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required>
                                </div>
                            </div>
                        
                            <div class="form-group row mb-3">
                                <label class="col-md-3"></label>
                                <div class="col-md-9">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-sign-in"></i> Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end gambar --}}


          </div>
  
        </div>
      </section><!-- End About Section -->

  </main>