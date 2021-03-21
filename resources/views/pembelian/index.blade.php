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
                                    <a href="{{ url('/pembelian/baru') }}" class="btn btn-primary" style="float: right"><i class="fas fa-plus"></i> Pembelian Baru</a>
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
                                                <button type="button" class="btn btn-primary"><i class="fas fa-eye"></i></button>
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
<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailLabel">Detail Barang</h5>
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
                        $(`#formEdit #kategori option[value="${data.kategori_id}"]`).attr('selected', 'selected');
                        $('#formEdit #merek').val(data.merek);
                        $('#formEdit #diskon').val(data.diskon);
                        $('#formEdit #stok').val(data.stok);
                        $('#formEdit #harga_beli').val(data.harga_beli);
                        $('#formEdit #harga_jual').val(data.harga_jual);
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