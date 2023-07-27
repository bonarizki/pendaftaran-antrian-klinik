@extends('layout.master')

@section('content')
    
            <div class="row px-5 pt-5 pb-3">
                <div class="col">
                    <div class="text-header">
                        Login
                    </div>
                </div>
            </div>
            <div class="row px-5 pb-4 ">
                <div class="col">
                    <div class="text-subheader">
                        Dapatkan Nomor Antrian
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-login-register">
                        <div class="card-body">
                            <form action="{{ url('login') }}" method="post">
                                @csrf
                                <div class="row px-4 pt-5 pb-1">
                                    <div class="col">
                                        @error('login_failed')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        @if(session('register_success'))
                                            <div class="alert alert-success" role="alert">
                                                {!! session('register_success') !!}
                                            </div>
                                        @endif
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input 
                                                type="email" 
                                                class="form-control @error('email') is-invalid @enderror" 
                                                name="email" 
                                                placeholder="Your Email"
                                                value="{{ old('email') }}"
                                            >
                                            @error('email')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                            
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input 
                                                type="password" 
                                                class="form-control @error('password') is-invalid @enderror " 
                                                name="password" 
                                                placeholder="password"
                                            >
                                            @error('password')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-4" >
                                    <div class="col">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-login-register" type="submit">
                                                <span style="color: white">Login</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row px-4 pt-4 pb-5">
                                <div class="col d-flex justify-content-center">
                                    Don’t Have An Account ? <a href="{{ url('register') }}">Register Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
@endsection
