@extends('layout.master')

@section('content')
    
            <div class="row px-5 pt-5 pb-3">
                <div class="col d-flex justify-content-center">
                    <div class="text-header">
                        Selamat datang, {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
            <div class="row" id="nomor-antrian" hidden>
                <div class="col">
                    <div class="card card-login-register">
                        <div class="card-body">
                            <div class="row pt-2">
                                <div class="col d-flex justify-content-center">
                                    <div class="text-header" style="color: black">
                                        <b>Nomor Antrian</b>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col pt-5 d-flex justify-content-center">
                                    <button class="antrian">
                                        <div class="text-antrian" id="nomor">
                                            
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col pt-5 d-flex justify-content-center">
                                    <b style="text-align: center">Silahkan Lakukan Pemeriksaan Pasien 
                                    </b>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col pt-5 d-flex justify-content-center">
                                    <button class="btn btn-login-register" type="button" data-bs-toggle="modal" data-bs-target="#modal-resep">
                                        <span style="color: white"><b>Tulis Resep Obat<b></span>
                                    </button>
                                </div>
                            </div>
                            <div id="id-antrian" hidden></div>
                        </div>
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
                                        antrian selanjutnya belum <br>
                                        tersedia
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-resep" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Resep Obat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    Nama Pasien : <span id="nama-pasien"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="resep-obat" class="form-label">Resep Obat</label>
                                        <textarea class="form-control" id="resep-obat" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="simpanResep()">save</button>
                        </div>
                    </div>
                </div>
            </div>
       
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            getAntrianPasien()

            //Time in milliseconds [1 second = 1000 milliseconds ]    
            setInterval(function() { 
                getAntrianPasien()
            },3000)
            
        });

        getAntrianPasien = () => {
            $.ajax({
                type: "get",
                url : "{{ url('dokter/nomor-antrian') }}",
                success : function (res) {
                    let data = res.data;
                    
                    if (data !== null ) {
                        setData(data)
                    }else{
                        $("#nomor-kosong").attr("hidden",false);
                        $('#nomor-antrian').attr("hidden", true);
                    }
                }
            })
        }

        setData = (data) => {
            $("#nomor-kosong").attr("hidden",true);
            $('#nomor-antrian').attr("hidden", false);
            $("#nomor").text(data.nomor_antrian);
            $("#id-antrian").text(data.id);
            $('#nama-pasien').text(data.user.name);
        }

        simpanResep = () => {
            resep = $('#resep-obat').val();
            antrian_id = $('#id-antrian').text();

            $.ajax({
                type: "post",
                url: "{{url('dokter/simpan-resep')}}",
                data: {
                    "resep" : resep,
                    "antrian_id" : antrian_id
                },
                success: function (response) {

                    Swal.fire(
                        'Good job!',
                        'resep berhasil di simpan, panggil antrian selanjutnya',
                        'success'
                    )

                    $("#modal-resep").modal('hide');

                    getAntrianPasien()
                }
            });
        }
    </script>
@endsection
