@extends('layout.master')

@section('content')
    
            <div class="row px-5 pt-5 pb-3">
                <div class="col d-flex justify-content-center">
                    <div class="text-header">
                        Selamat datang, {{ Auth::user()->name }}
                    </div>
                </div>
            </div>

            <div class="row" id="nomor-kosong">
                <div class="col">
                    <div class="card card-login-register">
                        <div class="card-body">
                            <div class="row pt-5">
                                <div class="cols pt-5 d-flex justify-content-center">
                                    <span style="text-align: center; color:black" class="text-header">
                                        Terimakasih Telah Berkunjung <br>
                                        Lekas sembuh ya
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

       
@endsection

@section('script')
    
@endsection
