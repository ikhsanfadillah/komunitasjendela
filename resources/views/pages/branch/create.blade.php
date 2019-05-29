{{--======================
    Branch Section
====================--}}
@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    @breadcrumb(['links'=>[
    ['url'=>route('admin.branch.index'),'text' =>'Branch'],
    ['text' =>'Create Branch'],
    ]])
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Branch</h4>
                    <form method="POST" action="{{ route('admin.branch.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="branchName">Name</label>
                            <input type="text" id="branchName" name="name" placeholder="Name" value="{{ old('name') }}"
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



