<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EasyStudio</title>

    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/grayscale.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
</head>
<body>

<!-- Header -->
<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase">SECRET CODES</h1>
        </div>
    </div>
</header>

<!-- About Section -->
<section id="about" class="about-section text-center">
    <div class="container">
        <div class="row" id="secret_code">
            <div class="col-lg-7 mx-auto">
                <i class="text-white fas fa-user-secret fa-2x"></i>
                <h2 class="text-white">NEW SECRET CODE</h2>
                <div class="card app-card py-4">
                    <div class="card-body text-center">
                        <form method="post" action="{{ route('store') }}">
                            @csrf
                            <div class="mb-4 form-row col-md-12">
                                <div class="col-md-4">
                                    <label for="validationServer01">Code Name:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text"
                                           class="form-control @if($errors->has('code_name')) is-invalid @endif"
                                           placeholder="Secret date start world war 3" name="code_name"
                                           value="{{ old('code_name') }}"
                                           required>
                                    @if($errors->has('code_name'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('code_name')}}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 form-row col-md-12">
                                <div class="col-md-4">
                                    <label for="validationServer01">Secret Code:</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="secret_code" required
                                              class="form-control app-textarea @if($errors->has('secret_code')) is-invalid @endif"
                                              rows="12"
                                              placeholder="{ssfsd?}-a4g {2022}">{{ old('secret_code') }}</textarea>
                                    @if($errors->has('secret_code'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('secret_code')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Save Code</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mx-auto">
                <i class="text-white fas fa-eye fa-2x"></i>
                <h2 class="text-white">ALL CODES</h2>
                <div class="card app-card py-4">
                    <div class="card-body text-center">
                        <div>
                            @foreach($codes as $code)
                                <div class="badge-info">{{ $code->code_name }}</div>
                                <div class="badge-danger">{{ $code->secret_code }}</div>
                                <div>
                                    @foreach($code->decode as $decode )
                                        {{ $decode->decode_code . ' '}}
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Signup Section -->
<section id="signup" class="signup-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto text-center">
                <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                <h2 class="text-white mb-5">CONTACT ME</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Address</h4>
                        <hr class="my-4">
                        <div class="small text-black-50">4923 Market Street, Orlando FL</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-envelope text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Email</h4>
                        <hr class="my-4">
                        <div class="small text-black-50">
                            <a href="#">hello@yourdomain.com</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-mobile-alt text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Phone</h4>
                        <hr class="my-4">
                        <div class="small text-black-50">+1 (555) 902-8832</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-black small text-center text-white-50">
    <div class="container">
        Copyright &copy; EASYSTUDIO {{ date('Y') }}
    </div>
</footer>

{{-- Scripts --}}
<script src="{{ asset('js/app.js') }}"></script>

@if($errors->has('code_name') || $errors->has('secret_code')
 || session()->has('success') || session()->has('warning'))
    <script defer>
        $('body,html').animate({
            scrollTop: $('#secret_code').offset().top
        }, 1000);
    </script>
@endif

{{-- Message Success and warning --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if(session()->has('success'))
    toastr.success('{{ session()->get('success') }}', 'Success', {
        timeOut: 2000,
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "3000",
        "hideDuration": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "tapToDismiss": false
    });
    @endif

    @if(session()->has('warning'))
    toastr.warning('{{ session()->get('warning') }}', 'Warning', {
        timeOut: 2000,
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "3000",
        "hideDuration": "3000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "tapToDismiss": false
    });
    @endif
</script>
</body>
</html>