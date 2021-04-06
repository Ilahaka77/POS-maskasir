@extends('layouts.main')

@section('title', 'Pembelian')

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
                        <h2 class="title-1">Pembelian</h2>
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
                                    <button type="button" class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#create"><i class="fas fa-plus"></i> Pembelian Baru</button>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <table id="table_id" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Supplier</th>
                                        <th scope="col">Total Item</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Diskon</th>
                                        <th scope="col">Total Bayar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($pembelian as $item)
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->nama_supplier }}</td>
                                            <td>{{ $item->total_item }}</td>
                                            <td>{{ $item->total_harga }}</td>
                                            <td>{{ $item->diskon }}</td>
                                            <td>{{ $item->total_bayar }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail"><i class="fas fa-eye"></i></button>
                                            </td>
                                        @endforeach
                                    </tr>
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

{{-- Modal Detail --}}


{{-- Modal Select Supplier --}}
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table">
            <thead>
                <tr>
                    <th>Supplier</th>
                    <th>No. Telepon</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                
                    @foreach ($supplier as $item)
                        <tr>
                            <td>{{ $item->nama_supplier }}</td>                        
                            <td>{{ $item->no_telepon }}</td>          
                            <td>
                                <a href="{{ url('/pembelian/baru/'.$item->id) }}" class="btn btn-primary">Pilih</a>
                            </td>     
                        </tr>             
                    @endforeach
            </tbody>
          </table>
        </div>
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
            var table = $('.table').DataTable();

        });
    </script>
@endsection