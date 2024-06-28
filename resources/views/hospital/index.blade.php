
@extends('layout.home')
@section('title','Rumah Sakit')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@section('content')

<main id="main" class="main">

<div class="pagetitle">
<h1>Dashboard</h1>
<nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active">Rumah Sakit</li>
    </ol>
</nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    
    <div class="card"> 
        <div class="card-body "> 
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List Rumah Sakit</h5>
                            <button type="button" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#basicModal">
                               Tambah
                            </button>
                            <!-- Table with stripped rows -->
                            <table class="table table-striped mt-2" id="hospital-table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Rumah Sakit</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                            
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>

</main><!-- End #main -->

<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title .modal-title" id="exampleModalLongTitle">Tambah Rumah Sakit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" id="frm-hospital">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id" id="id" class="form-control" />
                <div class="row">
                        <div class="col-md-12"> 
                            <label> Nama Rumah Sakit</label>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" autofocus/>
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <label> Alamat </label>
                            <div class="form-group">
                                <textarea name="address" class="form-control" id="address"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <label> Telepon </label>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control" id="phone"/>
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <label> Email </label>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" id="email"/>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-success" id="btn-save">Simpan</button>
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal" id="btn-close">Batal</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    var table

    $(document).ready(function () {
        
        // Load Data
        getHospitals()

        // Open Modal
        $(".btn-add").click(function(e){
            e.preventDefault()
            $("#basicModal").modal("show")
            $(".modal-title").text("Tambah Rumah Sakit")
            $("#btn-save").text("Simpan")
            $("#id").val("")
            $("#name").val("")
            $("#address").val("")
            $("#email").val("")
            $("#phone").val("")
        })
        
        // Close Modal
        $("#btn-close").click(function(e){
            e.preventDefault()
            $("#basicModal").modal("hide")
        })

        $("#frm-hospital").on("submit", function(e){
            e.preventDefault()

            if($("#name").val() == ""){
                $.alert({
                        title: 'Pesan!',
                        content: 'Nama rumah sakit tidak boleh kosong !',
                });
                return 
            }

            if($("#address").val() == ""){
                $.alert({
                        title: 'Pesan!',
                        content: 'Alamat rumah sakit tidak boleh kosong !',
                });
                return 
            }

            if($("#phone").val() == ""){
                $.alert({
                        title: 'Pesan!',
                        content: 'Nomor telepon rumah sakit tidak boleh kosong !',
                });
                return 
            }

            if($("#email").val() == ""){
                $.alert({
                        title: 'Pesan!',
                        content: 'Email rumah sakit tidak boleh kosong !',
                });
                return 
            }

            $.ajax({
                type: "POST",
                url: "/api/hospitals",
                data: {
                    id : $("#id").val(),
                    name : $("#name").val(),
                    email : $("#email").val(),
                    phone : $("#phone").val(),
                    address : $("#address").val(),
                },
                dataType: "JSON",
                success: function (response) {
                    if(response.status == 200){
                        $("#basicModal").modal("hide")
                        $.confirm({
                            title: 'Pesan ',
                            content: 'Data rumah sakit berhasil diperbarui !',
                            buttons: {
                                Ya: {
                                    btnClass: 'btn-success any-other-class',
                                    action: function(){
                                        getHospitals()
                                    }
                                },
                            }
                        });
                    }
                }
            });
        })
    });

    function getHospitals(){
        if (table != null) {
            table.destroy();
        }

        table =  $("#hospital-table").DataTable({
                lengthChange: false,
                searching: false,
                destroy: true,
                processing: true,
                serverSide: true,
                bAutoWidth: true,
                scrollCollapse : true,
                language: {
                emptyTable: "Data tidak tersedia",
                zeroRecords: "Tidak ada data yang ditemukan",
                infoFiltered: "",
                infoEmpty: "",
                paginate: {
                    previous: "‹",
                    next: "›",
                },
                info: "Menampilkan _START_ dari _END_ dari _TOTAL_ Rumah Sakit",
                aria: {
                        paginate: {
                            previous: "Previous",
                            next: "Next",
                        },
                    },
                },
                ajax:{
                    url :  '/api/hospitals',
                    type: "GET",
                    data: "data"
                },
                columns: [
                    {
                        data: null,
                        width: "5%",
                    },
                    {
                        data: null,
                    },
                    {
                        data: null,
                    },
                    {
                        data: null,
                    },
                    {
                        data: null,
                    },
                    {
                        data: null,
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        searchable: false,
                        orderable: false,
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).addClass("text-center");
                            $(td).html(table.page.info().start + row + 1);
                        },
                    },
                    {
                        targets: 1,
                        searchable: false,
                        orderable: false,
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).html(rowData.name);
                        },
                    },
                    {
                        targets: 2,
                        searchable: false,
                        orderable: false,
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).html(rowData.address);
                        },
                    },
                    {
                        targets: 3,
                        searchable: false,
                        orderable: false,
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).html(rowData.phone);
                        },
                    },
                    {
                        targets: 4,
                        searchable: false,
                        orderable: false,
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).html(rowData.email);
                        },
                    },
                    {
                        targets: 4,
                        searchable: false,
                        orderable: false,
                        createdCell: function (td, cellData, rowData, row, col) {
                            $(td).html(rowData.phone);
                        },
                    },
                    {
                        targets: 5,
                        searchable: false,
                        orderable: false,
                        createdCell: function (td, cellData, rowData, row, col) {
                            var html = ""
                            var disabled = ""
                            html = "<button type='button' class='btn btn-sm btn-warning' onclick='detail("+rowData.id+")' "+disabled+"> Ubah </button> <button type='button' class='btn btn-sm btn-danger' onclick='confirm("+rowData.id+")' "+disabled+"> Hapus </button>"
                            $(td).html(html);
                        },
                    },
                ],
            })
    }

    function detail(id){
        $.ajax({
            type: "POST",
            url: "/api/hospitals/detail",
            data: {
                id : id
            },
            dataType: "JSON",
            success: function (response) {
                var data = response.data
                $("#basicModal").modal("show")
                $(".modal-title").text("Detail Rumah Sakit")
                $("#btn-save").text("Ubah")
                $("#id").val(data.id)
                $("#name").val(data.name)
                $("#address").val(data.address)
                $("#phone").val(data.phone)
                $("#email").val(data.email)
            }
        });
    }

    function confirm(id){
        $.confirm({
            title: 'Pesan ',
            content: 'Apa anda yakin akan menghapus data ini ?',
            buttons: {
                Ya: {
                    btnClass: 'btn-red any-other-class',
                    action: function(){
                        remove(id)
                    }
                },
                Batal: {
                    btnClass: 'btn-secondary',
                },
            }
        });
    }

    function remove(id){
        $.ajax({
            type: "POST",
            url: "/api/hospitals/delete",
            data: {
                id : id,
            },
            dataType: "JSON",
            success: function (response) {
                if(response.status == 200){
                    $.confirm({
                        title: 'Pesan',
                        content: 'Data rumah sakit berhasil dihapus !',
                        buttons: {
                            Ya: {
                                btnClass: 'btn-success any-other-class',
                                action: function(){
                                    getHospitals()
                                }
                            },
                        }
                    });
                }
            }
        });
    }
      
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
@endsection

@section('pagespecificscripts')
   
@stop