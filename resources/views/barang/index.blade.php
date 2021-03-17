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
          <h5 class="modal-title" id="createLabel">Tambah Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('barang') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="barcode" class="col-sm-3 col-form-label">Barcode</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="barcode" id="barcode" value="{{ old('barcode') }}">
                    </div>
                </div>
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
                        <input class="form-control" type="text" name="merek" id="merek" value="{{ old('merek') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="stok" id="stok" value="{{ old('stok') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="diskon" class="col-sm-3 col-form-label">Diskon</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="diskon" id="diskon" value="{{ old('diskon') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga_beli" class="col-sm-3 col-form-label">Harga Beli</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="harga_beli" id="harga_beli" value="{{ old('harga_beli') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="harga_jual" id="harga_jual" value="{{ old('harga_jual') }}">
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
                <div class="form-group row">
                    <label for="barcode" class="col-sm-3 col-form-label">Barcode</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="barcode" id="barcode" value="{{ old('barcode') }}">
                    </div>
                </div>
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
                        <input class="form-control" type="text" name="merek" id="merek" value="{{ old('merek') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="stok" id="stok" value="{{ old('stok') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="diskon" class="col-sm-3 col-form-label">Diskon</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="diskon" id="diskon" value="{{ old('diskon') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga_beli" class="col-sm-3 col-form-label">Harga Beli</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="harga_beli" id="harga_beli" value="{{ old('harga_beli') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="harga_jual" id="harga_jual" value="{{ old('harga_jual') }}">
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
            <table class="table">
                <tbody>
                    <tr>
                        <td style="width: 150px">Barcode</td>
                        <td scope="col" id="detailBarcode"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Nama Barang</td>
                        <td scope="col" id="detailNama"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Kategori</td>
                        <td scope="col" id="detailKategori"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Merek</td>
                        <td scope="col" id="detailMerek"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Stok</td>
                        <td scope="col" id="detailStok"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Diskon</td>
                        <td scope="col" id="detailDiskon"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Harga Beli</td>
                        <td scope="col" id="detailBeli"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Harga Jual</td>
                        <td scope="col" id="detailJual"></td>
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

            // Get Data for Form Update
            $('.btnEdit').on('click', function(){
                const id = $(this).data('id');
                $('#formEdit').attr('action', `{{ url('barang/${id}/edit') }}`);
                $.ajax({
                    url:`{{ url('barang/getdata/${id}') }}`,
                    method:'get',
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        $('#formEdit #barcode').val(data.barcode);  
                        $('#formEdit #nama_barang').val(data.nama_barang);
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
                    url:`{{ url('barang/getdata/${id}') }}`,
                    method:'get',
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        $('#detail #detailBarcode').text(data.barcode);
                        $('#detail #detailNama').text(data.nama_barang);
                        $('#detail #detailKategori').text(data.kategori);
                        $('#detail #detailMerek').text(data.merek);
                        $('#detail #detailDiskon').text(data.diskon+'%');
                        $('#detail #detailStok').text(data.stok);
                        $('#detail #detailBeli').text(data.harga_beli);
                        $('#detail #detailJual').text(data.harga_jual);
                    
                    }
                });
            });
        });
    </script>
@endsection