@extends('layouts.main')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Profil</h2>
                    </div>
                </div>
            </div>
            <div class="au-card m-t-25">
                <div class="au-card-inner">
                    <div class="row">
                        <div class="col-md-4 my-auto">
                            <div class="mx-auto d-block">
                                <div class="mx-auto d-block rounded-circle mt-3" 
                                style="width: 150px; height: 150px; overflow: hidden; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
                                ">
                                    <img class="mx-auto img-cir d-block" style="width:100%; height:100%" src="{{ !empty(Auth::user()->foto_profil)?Auth::user()->foto_profil : url('/images/no-image-available.png') }}" alt="Card image cap">
                                </div>
                                <h4 class="text-sm-center mt-3 mb-1">Photo Profile</h4>
                                <hr>
                                <div class="text-sm-center">
                                    <form action="{{ url('profil/editPhoto/'.Auth::user()->id) }}" method="post" id="formFoto" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <input type="file" name="foto_profil" id="foto_profil" style="display: none">
                                        <label for="foto_profil" class="btn btn-outline-primary">Ganti Foto Profil</label>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="container" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); word-wrap: break-word;">
                                <div class="row pt-3">
                                    <div class="col-md-3">Name</div>
                                    <div class="col-md-9">{{ $data->name }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">Email</div>
                                    <div class="col-md-9">{{ $data->email }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">Tanggal Lahir</div>
                                    <div class="col-md-9">{{ empty($data->tgl_lahir)?'-':$data->tgl_lahir }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">Umur</div>
                                    <div class="col-md-9">{{ $data->setUmur() }}</div>
                                </div>
                                <hr>
                                <div class="row" >
                                    <div class="col-md-3">Alamat</div>
                                    <div class="col-md-9">
                                        <p>{{ empty($data->alamat)?'-':$data->alamat }}</p>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#changePassword">Change Password</button>
                                <button type="button" class="btn btn-primary btnEdit" data-id="{{ $data->id }}" data-toggle="modal" data-target="#editProfil">Edit Profil</button>
                            </div>
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

{{-- Modal Change Password--}}
<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('profil/changePassword') }}" method="POST">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input class="form-control" type="password" name="old_password" id="old_password">
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
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

{{-- Modal Edit Profil --}}
<div class="modal fade" id="editProfil" tabindex="-1" aria-labelledby="editProfilLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfilLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('profil/edit') }}" method="POST">
                @csrf
                @method('put')

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}">
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
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#foto_profil').change(function(){
                $('#formFoto').submit();
            });

            $('.btnEdit').on('click', function(){
                const id = $(this).data('id');
                $.ajax({
                    url:'profil/getdata/'+id,
                    method:'get',
                    dataType:'json',
                    success:function(data){
                        $('#editProfil #name').val(data.name);
                        $('#editProfil #email').val(data.email);
                        $('#editProfil #tgl_lahir').val(data.tgl_lahir);
                        $('#editProfil #alamat').val(data.alamat);
                    }
                });
            });
        });
    </script>
@endsection