{{--======================
    Student Section
====================--}}
@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            @breadcrumb(['links'=>[
            ['text' =>'Student'],
            ]])

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-inline-block">List Student</h4>
                        <a href="{{Route('admin.student.create')}}" class="btn btn-primary btn-sm  d-inline-block float-right text-white">
                            <i class="mdi mdi-account-plus"></i> Create Student </a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Name</th>
                                    <th>Library</th>
                                    <th>Birthdate - Age</th>
                                    <th>action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mStudents as $i => $mStudent)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{ asset('images/faces/'.($mStudent->gender == App\Models\User::GENDER_MALE ? "boy" : "girl").'.png') }}" class="bg-inverse-dark" alt="image" />
                                        </td>
                                        <td>{{ $mStudent->name }}<br><small class="text-muted">{{ $mStudent->nickname }}</small></td>
                                        <td>{{ $mStudent->subbranch->name }}</td>

                                        <td>
                                            @isset($mStudent->dob) {{ date('M d, Y', strtotime($mStudent->dob)) }} - <small class=>{{ $mStudent->age().' y/o' }}</small>
                                            @endisset</td>
                                        <td>
                                            <a href="{{route('admin.student.edit',['id'=>$mStudent->id])}}" class="text-dark" style="font-size: 1.7em"><i class="mdi mdi-pencil"></i></a>
                                            <a href="#" class="text-dark" style="font-size: 1.7em"
                                               onclick="event.preventDefault(); document.getElementById('delete-user-form').submit();">
                                                <i class="mdi mdi-delete-empty"></i></a>


                                            <form id="delete-user-form" action="{{ route('admin.student.destroy',$mStudent->id) }}" method="POST" style="display: none;">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
