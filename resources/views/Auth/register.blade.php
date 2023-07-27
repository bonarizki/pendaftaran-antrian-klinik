@extends('layout.master')

@section('content')
    
            <div class="row px-5 pt-3 pb-3">
                <div class="col">
                    <div class="text-header">
                        Register
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
                            <form action="{{ url('register') }}" method="post">
                                @csrf
                                <div class="row px-4 pt-3 pb-1">
                                    <div class="col">
                                        @error('register_failed')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input 
                                                type="text" 
                                                class="form-control @error('name') is-invalid @enderror" 
                                                name="name" 
                                                placeholder="Name"
                                                value="{{ old('name') }}"
                                            >
                                            @error('name')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                            
                                        </div>

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
                                            <label class="form-label">Phone Number</label>
                                            <input 
                                                type="number" 
                                                class="form-control @error('phone_number') is-invalid @enderror" 
                                                name="phone_number" 
                                                placeholder="Phone Number"
                                                value="{{ old('phone_number') }}"
                                            >
                                            @error('phone_number')
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

                                        <div class="mb-3">
                                            <label class="form-label">Verify Password</label>
                                            <input 
                                                type="password" 
                                                class="form-control @error('verify_password') is-invalid @enderror " 
                                                name="verify_password" 
                                                placeholder="verify password"
                                            >
                                            @error('verify_password')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-4" >
                                    <div class="col">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-login-register" type="submit">
                                                <span style="color: white">Register</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row px-4 pt-4 pb-5">
                                <div class="col d-flex justify-content-center">
                                    Already have an account? <a href="{{ url('/') }}">Login Here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
@endsection
