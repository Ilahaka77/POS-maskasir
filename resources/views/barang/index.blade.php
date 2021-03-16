@extends('layouts.main')

@section('title', 'Barang')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Barang</h2>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div>
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                </div>
                                <div class="table-data__tool-right">
                                    <button type="button" class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#create"><i class="fas fa-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <table id="table_id" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Barcode</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Merek</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                    @foreach ($barang as $key => $item)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td style="width: 200px">{{ $item->barcode }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ $item->merek }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td style="width: 200px">
                                            <button class="btn btn-primary btnDetail" style="width: 40px; font-size:12px;" data-id="{{ $item->id }}" data-toggle="modal" data-target="#detail"><i class="fas fa-info"></i></button>
                                            <button class="btn btn-primary btnEdit" style="width: 40px; font-size:12px;" data-id="{{ $item->id }}" data-toggle="modal" data-target="#update"><i class="fas fa-pen"></i></button>
                                            <button class="btn btn-danger"  style="width: 40px; font-size:12px;"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Create --}}
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createLabel">Tambah Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('member') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kategori" class="col-sm-3 col-form-label">kategori</label>
                    <div class="col-sm-9">
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="merek" class="col-sm-3 col-form-label">Merek</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="merek" name="merek" id="merek" value="{{ old('merek') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" name="stok" id="stok" value="{{ old('stok') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" name="stok" id="stok" value="{{ old('stok') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" name="stok" id="stok" value="{{ old('stok') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" name="stok" id="stok" value="{{ old('stok') }}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
      </div>
    </div>
</div>

{{-- Modal Update --}}
<div class="modal fade" id="update" tabindex="-1" aria-labelledby="updateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateLabel">Edit Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="formEdit" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <div class="mx-auto d-flex justify-content-center">
                        <img class="mx-auto d-block image img-cir" src="{{ asset('images/no-image-available.png') }}" alt="Card image cap" id="display_edit"  style="width: 150px; height:150px;">
                    </div>
                    <hr>
                    <div class="card-text text-sm-center">
                        <input type="file" name="foto_profil" id="foto_profil_edit" style="display: none">
                        <label for="foto_profil_edit" class="btn btn-outline-primary">Pilih Foto</label>
                        @error('foto_profil')
                            <span style="display: block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="date" name="tgl_lahir" id="edit_tanggal">
                    </div>
                </div>
                <div class="form-group row" >
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
      </div>
    </div>
</div>

{{-- Modal Detail --}}
<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailLabel">Detail Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="mx-auto d-flex justify-content-center">
                <img class="mx-auto d-block image img-cir" src="{{ asset('images/no-image-available.png') }}" alt="Card image cap" id="display"  style="width: 150px; height:150px;">
            </div>
            <hr>
            <table class="table">
                <tbody>
                    <tr>
                        <td style="width: 150px">Kode Member</td>
                        <td scope="col" id="detailKode"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Nama</td>
                        <td scope="col" id="detailName"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Email</td>
                        <td scope="col" id="detailEmail"></td>
                    </tr><tr>
                        <td style="width: 150px">Umur</td>
                        <td scope="col" id="detailUmur"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Tgl. Lahir</td>
                        <td scope="col" id="detailTgl"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Alamat</td>
                        <td scope="col" id="detailAlamat"></td>
                    </tr>
                </tbody>
            </table>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var table = $('#table_id').DataTable();
            // Display image
            $('#foto_profil').change(function(){
                const file = this.files[0];

                if(file){
                    const reader = new FileReader();

                    reader.addEventListener("load", function(){
                        document.getElementById('display').setAttribute('src', this.result);
                    });
                    
                    reader.readAsDataURL(file);
                }
            });
            $('#foto_profil_edit').change(function(){
                const file = this.files[0];

                if(file){
                    const reader = new FileReader();

                    reader.addEventListener("load", function(){
                        document.getElementById('display_edit').setAttribute('src', this.result);
                    });
                    
                    reader.readAsDataURL(file);
                }
            });

            // Get Data for Form Update
            $('.btnEdit').on('click', function(){
                const id = $(this).data('id');
                $('#formEdit').attr('action', `{{ url('member/${id}/edit') }}`);
                $.ajax({
                    url:`{{ url('member/getdata/${id}') }}`,
                    method:'get',
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        $('#formEdit img').attr('src', data.foto_profil);
                        $('#formEdit #name').val(data.name);
                        $('#formEdit #email').val(data.email);
                        $('#formEdit #edit_tanggal').val(data.tgl_lahir);
                        $('#formEdit #alamat').val(data.alamat);
                    }
                });
            });

            //Get Data for Detail 
            $('.btnDetail').on('click', function(){
                const id = $(this).data('id');
                $.ajax({
                    url:`{{ url('member/getdata/${id}') }}`,
                    method:'get',
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        dob = new Date(data.tgl_lahir);
                        var today = new Date();
                        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                        $('#detail img').attr('src', data.foto_profil);
                        $('#detail #detailName').text(data.name);
                        $('#detail #detailKode').text(data.kode_member);
                        $('#detail #detailRole').text(data.role);
                        $('#detail #detailEmail').text(data.email);
                        if (data.tgl_lahir == null) {
                            $('#detail #detailTgl').text('-');
                            $('#detail #detailUmur').text('-');
                        } else {
                            $('#detail #detailTgl').text(data.tgl_lahir);
                            $('#detail #detailUmur').text(age);
                        }
                        (data.alamat !== null)?$('#detail #detailAlamat').text(data.alamat):$('#detail #detailAlamat').text('-');
                    
                    }
                });
            });
        });
    </script>
@endsection