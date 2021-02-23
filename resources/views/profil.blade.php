@extends('layouts.main')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
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
                        <div class="col-md-4">
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
                        <div class="col-md">
                            <div class="container" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)">
                                <div class="row pt-3">
                                    <div class="col-md-4">Name</div>
                                    <div class="col-md-8">{{ Auth::user()->name }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">Email</div>
                                    <div class="col-md-8">{{ Auth::user()->email }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">Umur</div>
                                    <div class="col-md-8">{{ \Carbon\Carbon::parse(Auth::user()->tgl_lahir)->diff(Carbon::now())->format('%y') }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">Name</div>
                                    <div class="col-md-8">{{ Auth::user()->name }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">Name</div>
                                    <div class="col-md-8">{{ Auth::user()->name }}</div>
                                </div>
                                <hr>
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
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#foto_profil').change(function(){
                $('#formFoto').submit();
            });
        });
    </script>
@endsection