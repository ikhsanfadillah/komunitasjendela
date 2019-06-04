{{--======================
    Subbranch Section
=====================--}}

@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('scripts')
@endsection

@section('content')
    <div class="content-wrapper">
        @breadcrumb(['links'=>[
        ['url'=>route('admin.subbranch.index'),'text' =>'Subbranch'],
        ['text' =>'Edit Subbranch'],
        ]])
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Subbranch : {{$mSubbranch->name}}</h4>
                        <form method="POST" action="{{ route('admin.subbranch.update',['id'=>$mSubbranch->id]) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="subbranchName">Name</label>
                                <input type="text" id="subbranchName" name="name" placeholder="Subbranch name" value="{{ old('name') ?? $mSubbranch->name }}"
                                       class="form-control @if($errors->has('name')) is-invalid @endif">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="relawanBranch">Branch</label>
                                <select id="relawanBranch" name="branch_id" class="form-control @if($errors->has('branch_id')) is-invalid @endif">
                                    <option selected disabled>Choose Location...</option>
                                    @foreach(App\Models\Branch::All() as $branch)
                                        <option value="{{ $branch->id }}" {{ (old('branch_id') || $mSubbranch->branch_id == $branch->id ? "selected":"") }}>{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('branch_id'))
                                    <div class="invalid-feedback">{{$errors->first('branch_id')}}</div>
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