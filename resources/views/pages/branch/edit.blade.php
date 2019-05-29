{{--======================
    Branch Section
====================--}}
@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('scripts')
@endsection

@section('content')
    <div class="content-wrapper">
        @breadcrumb(['links'=>[
        ['url'=>route('admin.branch.index'),'text' =>'Branch'],
        ['text' =>'Edit Branch'],
        ]])
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Branch : {{$mBranch->name}}</h4>
                        <form method="POST" action="{{ route('admin.branch.update',['id'=>$mBranch->id]) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="branchName">Name</label>
                                <input type="text" id="branchName" name="name" placeholder="{{ str_replace("+62","",$mBranch->detail->name ?? '') }}" value="{{ str_replace("+62","",$mBranch->detail->name ?? '') }}"
                                       class="form-control @if($errors->has('name')) is-invalid @endif">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection