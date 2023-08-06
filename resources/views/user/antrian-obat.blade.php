@extends('layout.master')

@section('content')
    
            <div class="row px-5 pt-5 pb-3">
                <div class="col d-flex justify-content-center">
                    <div class="text-header">
                        Selamat Datang ,{{ Auth::user()->name }}
                    </div>
                </div>
            </div>
            <div class="row px-5 pb-4 ">
                <div class="col">
                    <div class="text-subheader">
                        Nomor Antrian Obat
                    </div>
                </div>
            </div>
            <div class="row" id="nomor-antrian">
                <div class="col">
                    <div class="card card-login-register">
                        <div class="card-body">
                            <div class="row pt-5">
                                <div class="col pt-5 d-flex justify-content-center">
                                    <button class="antrian">
                                        <div class="text-antrian" id="nomor">
                                            
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col pt-5 d-flex justify-content-center">
                                    <b style="text-align: center">Silahkan Tunggu Hingga Nomor 
                                        <br> 
                                    Antrian Dipanggil</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            getNomorAntrian()

            // Time in milliseconds [1 second = 1000 milliseconds ]    
            setInterval(function() { 
                cekAntrian()
            },  3000);
        });

        getNomorAntrian = () => {
            $.ajax({
                type: "get",
                url: "{{ url('/user/obat-antrian')}}",
                success: function (response) {
                    let data = response.data;
                    if (data.status === 'done') {
                        window.location.href = "{{ url('user/done') }}";
                    }else{
                        setNomorAntrian(data)
                    }
                }
            });
        }

        setNomorAntrian = (data) => {
            $("#nomor").text(data.nomor_antrian);
        }
    </script>
@endsection
