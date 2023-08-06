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
                        Nomor Antrian Pasien
                    </div>
                </div>
            </div>
            <div class="row" id="daftar">
                <div class="col">
                    <div class="card card-login-register">
                        <div class="card-body">
                            <div>
                                <div class="row pt-5">
                                    <div class="col pt-5 d-flex justify-content-center">
                                        <button class="antrian">
                                            <div class="text-header" onclick="getNomorAntrian()">
                                                Daftar <br> Antrian
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row px-4 pt-4 pb-5">
                                <div class="col pt-5 d-flex justify-content-center">
                                    <b>Anda Belum Melimeliki Nomor Antrian <br> Silahkan Tekan Tombol "Daftar Antrian"</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="nomor-antrian" hidden>
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
            cekAntrian()

            //Time in milliseconds [1 second = 1000 milliseconds ]    
            setInterval(function() { 
                cekAntrian()
            },  3000);
        });

        cekAntrian = () => {
            $.ajax({
                type: "get",
                url : "{{ url('user/cek-antrian') }}",
                success : function (res) {
                    let data = res.data;
                    if (data.status === 'aktif') {
                        setNomorAntrian(data)
                    }else{
                        window.location.href = "{{ url('user/antrian-obat') }}";
                    }
                }
            })
        }

        getNomorAntrian = () => {
            $.ajax({
                type: "post",
                url: "{{ url('/user/daftar-antrian')}}",
                success: function (response) {
                    let data = response.data;

                    Swal.fire(
                        'Good job!',
                        'anda sudah mendapat nomor antrian',
                        'success'
                    )
                    
                }
            });
        }

        setNomorAntrian = (data) => {
            $("#daftar").attr("hidden",true);
            $('#nomor-antrian').attr("hidden", false);
            $("#nomor").text(data.nomor_antrian);
        }
    </script>
@endsection
