{{--======================
    Volunteer Section
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
            line-height: 3.5em;
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
            ['text' =>'Volunteer Attendances'],
            ]])

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div id="myTab" role="tablist" class="card-header" style="background-color: white">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="active nav-link p-y:0 p-x:1"  id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                                    Volunteer list</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-y:0 p-x:1 "  id="insert-tab" data-toggle="tab" href="#insert" role="tab" aria-controls="insert" aria-selected="false">
                                    Absen manual</a>
                            </li>
                        </ul>

                        <a href="{{ route('admin.student-attendance.create')}}" class="btn btn-primary btn-sm  d-none float-right text-white">
                            <i class="mdi mdi-account-plus"></i> Create Volunteer </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                @include('pages.attendance.volunteer.main-list',['mVolunteerAttendances'=>$mVolunteerAttendances])
                            </div>
                            <div class="tab-pane fade" id="insert" role="tabpanel" aria-labelledby="insert-tab">
                                @include('pages.attendance.volunteer.create-partial',['mVolunteerAttendances'=>$mVolunteerAttendances])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
