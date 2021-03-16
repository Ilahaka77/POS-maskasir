@extends('layouts.main')

@section('title', 'Supplier')

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
                        <h2 class="title-1">Supplier</h2>
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
                                        <th scope="col">Nama Supplier</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                    @foreach ($supplier as $key => $item)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_supplier }}</td>
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
          <h5 class="modal-title" id="createLabel">Tambah Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('supplier') }}" method="POST">
                @csrf
                
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Nama Supplier</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telepon" class="col-sm-3 col-form-label">No. Telepon</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}">
                    </div>
                </div>
                <div class="form-group row" >
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5">{{ old('alamat') }}</textarea>
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
          <h5 class="modal-title" id="updateLabel">Edit Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="formEdit" >
                @csrf
                @method('put')
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Nama Supplier</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telepon" class="col-sm-3 col-form-label">No. Telepon</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="no_telepon" id="no_telepon">
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
          <h5 class="modal-title" id="detailLabel">Detail Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td style="width: 150px">Nama Supplier</td>
                        <td scope="col" id="detailName"></td>
                    </tr>
                    <tr>
                        <td style="width: 150px">No. Telepon</td>
                        <td scope="col" id="detailTelepon"></td>
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

            // Get Data for Form Update
            $('.btnEdit').on('click', function(){
                const id = $(this).data('id');
                $('#formEdit').attr('action', `{{ url('supplier/${id}/edit') }}`);
                $.ajax({
                    url:`{{ url('supplier/getdata/${id}') }}`,
                    method:'get',
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        $('#formEdit #name').val(data.nama_supplier);
                        $('#formEdit #no_telepon').val(data.no_telepon);
                        $('#formEdit #alamat').val(data.alamat);
                    }
                });
            });

            //Get Data for Detail 
            $('.btnDetail').on('click', function(){
                const id = $(this).data('id');
                $.ajax({
                    url:`{{ url('supplier/getdata/${id}') }}`,
                    method:'get',
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        $('#detail #detailName').text(data.nama_supplier);
                        $('#detail #detailTelepon').text(data.no_telepon);
                        $('#detail #detailAlamat').text(data.alamat);
                    
                    }
                });
            });
        });
    </script>
@endsection