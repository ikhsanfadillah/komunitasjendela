{{--======================
    Relawan Section
====================--}}
@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            @breadcrumb(['links'=>[
            ['text' =>'Relawan'],
            ]])

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-inline-block">List Relawan</h4>
                        <a href="{{Route('admin.relawan.create')}}" class="btn btn-primary btn-sm  d-inline-block float-right text-white">
                            <i class="mdi mdi-account-plus"></i> Create Relawan </a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        User
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Birthdate
                                    </th>
                                    <th>
                                        Join Date
                                    </th>
                                    <th>
                                        action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mRelawans as $i => $mRelawan)
                                    <tr>
                                        <td class="py-1">
                                            @if($mRelawan->detail()->exists())
                                                <img src="{{ asset('images/faces/'.($mRelawan->detail->gender == App\Models\User::GENDER_MALE ? "boy" : "girl").'.png') }}" class="bg-inverse-dark" alt="image" />
                                            @else
                                                <img src="{{ asset('images/faces/boy.png') }}" class="bg-inverse-dark" alt="image" />
                                            @endif
                                        </td>
                                        <td>{{ $mRelawan->name }}</td>
                                        <td>{{ $mRelawan->email }}</td>

                                        <td>@isset($mRelawan->detail->dob) {{ date('M d, Y', strtotime($mRelawan->detail->dob)) }} @endisset</td>
                                        <td>@isset($mRelawan->detail->dob) {{ date('M d, Y', strtotime($mRelawan->detail->join_dt)) }} @endisset</td>
                                        <td>
                                            <a href="{{route('admin.relawan.edit',['id'=>$mRelawan->id])}}" class="text-dark" style="font-size: 1.7em"><i class="mdi mdi-pencil"></i></a>
                                            <a href="#" class="text-dark" style="font-size: 1.7em"
                                               onclick="event.preventDefault(); document.getElementById('delete-user-form').submit();">
                                                <i class="mdi mdi-delete-empty"></i></a>
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
