{{--======================
    Relawan Section
====================--}}
@extends('layouts.admin')

@section('styles')
    <style>
        .nav.nav-tabs{
            border-bottom-width: 1px;
            padding: 0 1.5rem;
            font-weight: 700;
        }
        .card-header{
            padding: 0;
            border: none;
            border-radius: 10px 10px 0 0 !important;
        }
        .nav-tabs .nav-link{
            border: none;
            padding: 1rem 1.5rem;
        }
        .nav-link:hover{
            border: none;
        }
        a.nav-link{
            color: #9a9a9a;
        }
        .nav-tabs .nav-link.active{
            border: none;
            border-bottom: 2px solid #308ee0;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            @breadcrumb(['links'=>[
            ['text' =>'Relawan'],
            ]])

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div id="myTab" role="tablist" class="card-header" style="background-color: white">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active"  id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Volunteer list</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">create new</a>
                            </li>
                        </ul>
                        <a href="{{Route('admin.relawan.create')}}" class="btn btn-primary btn-sm  d-none float-right text-white">
                            <i class="mdi mdi-account-plus"></i> Create Relawan </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                @include('pages.relawan.list-relawan',['mRelawans'=>$mRelawans])
                            </div>
                            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @include('pages.relawan.create-partial');
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
