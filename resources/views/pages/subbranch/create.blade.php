{{--======================
    Subbranch Section
====================--}}
@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    @breadcrumb(['links'=>[
    ['url'=>route('admin.subbranch.index'),'text' =>'Subbranch'],
    ['text' =>'Create Subbranch'],
    ]])
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Subbranch</h4>
                    <form method="POST" action="{{ route('admin.subbranch.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="relawanBranch">Branch</label>
                            <select id="relawanBranch" name="branch_id" class="form-control @if($errors->has('branch_id')) is-invalid @endif">
                                <option selected disabled>Choose Location...</option>
                                @foreach(App\Models\Branch::All() as $branch)
                                    <option value="{{ $branch->id }}" {{ (old('branch_id') || (isset($_GET['branch_id']) ? $_GET['branch_id'] : 0) == $branch->id ? "selected":"") }}>{{ $branch->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('branch_id'))
                                <div class="invalid-feedback">{{$errors->first('branch_id')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="subbranchName">Subbranch Name</label>
                            <input type="text" id="subbranchName" name="name" placeholder="Subbranch Name" value="{{ old('name') }}"
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



