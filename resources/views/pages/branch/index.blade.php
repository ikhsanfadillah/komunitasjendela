{{--======================
    Branch Section
====================--}}
@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        @breadcrumb(['links'=>[
        ['text' =>'Branch'],
        ]])
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-inline-block">List Branch</h4>
                        <a href="{{Route('admin.branch.create')}}" class="btn btn-primary btn-sm  d-inline-block float-right text-white">
                            <i class="mdi mdi-account-plus"></i> Create Branch </a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        ID
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
                                @foreach($mBranches as $i => $mBranch)
                                    <tr>
                                        <td>{{ $mBranch->id }}</td>
                                        <td class="text-capitalize">{{ $mBranch->name }}</td>
                                        <td class="text-right" style="">
                                            <a href="{{ route('admin.branch.edit',['id'=>$mBranch->id])}}" class="text-dark"><i class="mdi mdi-pencil"></i></a>
                                            <a href="#" class="text-dark"
                                               onclick="event.preventDefault(); document.getElementById('delete-user-form').submit();">
                                                <i class="mdi mdi-delete-empty"></i></a>


                                            <div class="dropdown d-inline-block">
                                                <a class="text-dark" data-offset="30" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                                                    <a class="dropdown-item" href="{{ route('admin.subbranch.create',['branch_id'=>$mBranch->id]) }}">
                                                        <i class="mdi mdi-plus"></i> Create subbranch</a>
                                                    <a class="dropdown-item" href="{{ route('admin.branch.edit',['id'=>$mBranch->id]) }}">
                                                        <i class="mdi mdi-pencil"></i> Edit Branch</a>
                                                    <a class="dropdown-item" href="{{ route('admin.subbranch.create',['branch_id'=>$mBranch->id]) }}"
                                                       onclick="event.preventDefault(); document.getElementById('delete-user-form').submit();">
                                                        <i class="mdi mdi-delete-empty"></i> Delete Branch</a>
                                                    <form id="delete-user-form" action="{{ route('admin.branch.destroy',$mBranch->id) }}" method="POST" style="display: none;">
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

