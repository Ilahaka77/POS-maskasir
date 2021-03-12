@extends('layouts.main')

@section('title', 'Staff')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Staff</h2>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div>
                            <h3 class="title-2">recent reports</h3>
                            <button class="btn btn-primary" style="float: right"><i class="fas fa-plus"></i> Tambah</button>
                        </div>
                        <div class="mt-5">
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col"></th>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <td scope="row">No.</td>
                                            <td>Nama</td>
                                            <td>Email</td>
                                            <td>Role</td>
                                            <td>
                                                <a href="" class="btn btn-primary"><i class="fas fa-info"></i> Detail</a>
                                                <a href="" class="btn btn-primary"><i class="fas fa-pencil"></i> Edit</a>
                                                <a href="" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </thead>
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
@endsection
