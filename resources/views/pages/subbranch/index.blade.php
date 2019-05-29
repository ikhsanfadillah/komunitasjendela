{{--======================
    Subbranch Section
====================--}}
@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        @breadcrumb(['links'=>[
        ['text' =>'Subbranch'],
        ]])
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-inline-block">List Subbranch</h4>
                        <a href="{{Route('admin.subbranch.create')}}" class="btn btn-primary btn-sm  d-inline-block float-right text-white">
                            <i class="mdi mdi-account-plus"></i> Create Subbranch </a>
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
                                    <th>
                                        Branch Of
                                    </th>
                                    <th class="text-right">
                                        action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mSubbranches as $i => $mSubbranch)
                                    <tr>
                                        <td>{{ $mSubbranch->id }}</td>
                                        <td class="text-capitalize">{{ $mSubbranch->name }}</td>
                                        <td class="text-capitalize">{{ $mSubbranch->branch->name }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.subbranch.edit',['id'=>$mSubbranch->id])}}" class="text-dark" style="font-size: 1.7em"><i class="mdi mdi-pencil"></i></a>
                                            <a href="#" class="text-dark" style="font-size: 1.7em"
                                               onclick="event.preventDefault(); document.getElementById('delete-user-form').submit();">
                                                <i class="mdi mdi-delete-empty"></i></a>

                                            <form id="delete-user-form" action="{{ route('admin.subbranch.destroy',$mSubbranch->id) }}" method="POST" style="display: none;">
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
