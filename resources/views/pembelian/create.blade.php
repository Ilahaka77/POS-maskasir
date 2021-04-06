@extends('layouts.main')

@section('title', 'Pembelian')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Pembelian Baru</h2>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        {{-- <div class="mb-4">
                            <div class="row mb-2">
                                <div class="col-md-2">Supplier</div>
                                <div class="col-md-10">: {{ $pembelian->supplier->nama_supplier }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">No. Telepon</div>
                                <div class="col-md-10">: {{ $pembelian->supplier->no_telepon }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Supplier</div>
                                <div class="col-md-10">: {{ $pembelian->supplier->alamat }}</div>
                            </div>
                        </div> --}}
                        <div class="mb-4">
                            <div class="row mb-2">
                                <div class="col-md-2">Supplier</div>
                                <div class="col-md-10">: -</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">No. Telepon</div>
                                <div class="col-md-10">: -</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Supplier</div>
                                <div class="col-md-10">: -</div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Input Barcode" aria-label="Input Kode Barang" aria-describedby="basic-addon2" id="cariBarang">
                                        <div class="input-group-append">
                                          <button type="button" class="btn btn-primary" id="basic-addon2" data-toggle="modal" data-target="#getBarang">. . .</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-data__tool-right">
                                    {{-- <a href="{{ url('/pembelian/cencel/'.$pembelian->id) }}" class="btn btn-danger"><i class="fas fa-times"></i> Cencel</a> --}}
                                    <a href="{{ url('/pembelian/cencel/') }}" class="btn btn-danger"><i class="fas fa-times"></i> Cencel</a>
                                </div>
                            </div>
                        </div>
                        <form action="" id="" method="post">
                            @csrf
                            @method('put')
                            <input type="text" name="id" value="" hidden>
                            <table class="table" id="list" >
                                <thead>
                                    <th>Code</th>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Sub Total</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="row mt-5">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body text-center" style="font-size: 64px">
                                            <span id="display_harga">Rp 0,00</span>
                                        </div>
                                        <div class="card-footer" style="font-size: 18px">
                                            <span id="terbilang"></span>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-2">Total</div>
                                        <div class="col-md"><input type="text" class="form-control" name="total_bayar" id="total_bayar"></div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-2">Diskon</div>
                                        <div class="col-md"><input type="number" class="form-control" name="diskon" id="diskon" max="100"></div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-2">Bayar</div>
                                        <div class="col-md"><input type="text" class="form-control" name="bayar" id="bayar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Pembelian</button>
                            </div>
                        </form>
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

{{-- pilih barang --}}
<div class="modal fade" id="getBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table" id="barang">
                <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $item)
                        <tr>
                            <td>{{ $item->barcode }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->harga_jual }}</td>
                            <td>
                                <button type="button" class="btn btn-primary pilihItem" data-id="{{ $item->barcode }}">Pilih</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>


@endsection

@section('script')
    <script>


        //insert barang from elemenet input
        $('#cariBarang').keypress(function(){
            if(event.which == 13){
                var code = $(this).val();
                additem(code);
            }
        })

        //insert barang from modal
        $('.pilihItem').on('click', function(){
            var id = $(this).data('id');
            additem(id);
            $('#getBarang').modal('hide');            
        })

        //remove list
        $(document).on('click', '.remove', function(){
            $(this).parents('tr').remove();
            getTotal();
        })

        //hitung sub total
        $(document).on('keyup', '.jumlah', function(){
            var harga = $(this).parents('tr').find('.harga').text()-0;
            var jumlah = $(this).val()-0;

            var total = harga * jumlah;
            $(this).parents('tr').find('.total').text(total);
            getTotal();
        })
        
        function additem(barcode){
            const code = barcode;
            $.ajax({
                url: `{{ url('/getitem/${code}') }}`,
                type: 'GET',
                dataType: 'JSON',
                success:function(data){
                        var td = $(`.kode:contains('${data.barcode}')`);
                        // alert(td.length);
                        if(td.length > 0){
                            var num = +td.parents('tr').find('.jumlah').val() + 1;
                            td.parents('tr').find('.jumlah').val(num);
                            td.parents('tr').find('.total').text(num*data.harga_jual);

                        }else{

                        var tr = '<tr>'+
                        `<td><span class="kode">${data.barcode}</span></td>`+
                        `<td><span class="barang">${data.nama_barang}</span></td>`+
                        `<td><span class="harga">${data.harga_jual}</span></td>`+
                        `<td><input type="text" name=""><input class="form-control jumlah" type="text" name="pembelian[][jumlah]" value="1"></td>`+
                        `<td><span class="total">${data.harga_jual * 1}</span></td>`+
                        `<td><button type="button" class="btn btn-danger remove"><i class="fas fa-times"></i></button></td>`+
                        `</tr>`;
                        $('#list tbody').append(tr);
                        }
                        // if(JQuery.inArray(data.barcode, )
                        
                    getTotal();
                },
                error:function(data){
                    console.log(data);
                }
            });
        }

        function getTotal(){
            var total = 0;
            $(document).find('.total').each(function(i,e){
                var harga = $(this).text()-0;
                total+=harga;
            });
            $('#total_bayar').val(total);
            $('#display_harga').text('Rp '+number_format(total));
            $('#terbilang').text(number_word(total)+" Rupiah");
        }

        function number_format(num){
            return num.toFixed(2).replace('.',',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        }

        //convert number to word
        var satuan = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan'];
        var belasan = ['Sepuluh', 'Sebelas', 'Dua Belas', 'Tiga Belas', 'Empat Belas', 'Lima Belas', 'Enam Belas', 'Tujuh Belas', 'Delapan Belas', 'Sembilan Belas']

        function convert_miliar(num){
            if(num >= 1000000000){
                return convert_ratusan(Math.floor(num/1000000000)) + " Miliar "+convert_juta(num%1000000000);
            }else{
                return convert_juta(num);
            }
        }

        function convert_juta(num){
            if(num >= 1000000){
                return convert_ratusan(Math.floor(num/1000000)) + " Juta " + convert_ribuan(num%1000000);
            }else{
                return convert_ribuan(num);
            }
        }

        function convert_ribuan(num){
            if(num > 999){
                if(Math.floor(num/1000) == 1){
                    return "Seribu " + convert_ratusan(num%1000);
                }else{
                    return convert_ratusan(Math.floor(num/1000)) + " Ribu " + convert_ratusan(num%1000);
                }
            }else{
                return convert_ratusan(num);
            }
        }

        function convert_ratusan(num){
            if(num > 99){
                if(Math.floor(num/100) == 1){
                    return "Seratus " + convert_puluhan(num%100);
                }else{
                    return satuan[Math.floor(num/100)] + " Ratus " + convert_puluhan(num%100);
                }
            }else{
                return convert_puluhan(num);
            }
        }

        function convert_puluhan(num){
            if(num < 10){
                return satuan[num];
            }else if(num >= 10 && num < 20){
                return belasan[Math.floor(num-10)];
            }else{
                return satuan[Math.floor(num/10)] + " Puluh " + satuan[num % 10];
            }
        }

        function number_word(num){
            if(num == 0){
                return "nol";
            }else{
                return convert_miliar(num);
            }
        }
        //End Convert Number to Word

        $(document).ready(function(){
            $('#barang').DataTable();
            
        });
        </script>
@endsection