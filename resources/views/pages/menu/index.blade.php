{{--======================
    Menu Section
====================--}}
@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            @breadcrumb(['links'=>[
            ['text' =>'Menu'],
            ]])

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-inline-block">List Menu</h4>
                        <a href="{{Route('admin.menu-builder.create')}}" class="btn btn-primary btn-sm  d-inline-block float-right text-white">
                            <i class="mdi mdi-account-plus"></i> Create Menu </a>
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
                                    <th class="text-right">
                                        action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mMasterMenus as $i => $mMasterMenu)
                                    <tr>
                                        <td>{{ $mMasterMenu->id }}</td>
                                        <td>{{ $mMasterMenu->name }}</td>
                                        <td class="text-right">

                                            <div class="dropdown d-inline-block">
                                                <a class="text-dark" data-offset="30" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                                                    <a class="dropdown-item" href="{{ route('admin.menu-builder.edit',['branch_id'=>$mMasterMenu    ->id]) }}">
                                                         Menu builder
                                                    </a>
                                                    <a class="dropdown-item" href="#"
                                                       onclick="event.preventDefault(); document.getElementById('deleteMasterMenu').submit();">
                                                         Delete
                                                    </a>
                                                    <form id="deleteMasterMenu" action="{{ route('admin.menu-builder.destroy',['branch_id'=>$mMasterMenu    ->id]) }}" method="POST" style="display: none;">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
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
