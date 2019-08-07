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
                        <div class="card-image" style="background-image: url('')"></div>
                        <h4 class="card-title">Edit Branch : {{$mBranch->name}}</h4>
                        <form method="POST" action="{{ route('admin.branch.update',['id'=>$mBranch->id]) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="branchName">Name</label>
                                <input type="text" id="branchName" name="name" placeholder="{{ $mBranch->name }}" value="{{ $mBranch->name }}"
                                       class="form-control @if($errors->has('name')) is-invalid @endif">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                            
                            <button type="submit" class="btn btn-success mr-2">Update</button>
                        </form>
                        <hr>
                        <div class="row">
                            <span class="col-6 text-muted">
                                Branches
                            </span>
                            <div class="col-6 text-right">
                                <a href="{{ route('admin.subbranch.create',['branch_id'=>$mBranch->id]) }}" class="btn btn-xs btn-primary">
                                    Add Subbranch
                                </a>
                            </div>
                            <ul class="col-12 ml-3">
                            @foreach ($mBranch->subbranch as $i => $subbranch)
                                <li>
                                    {{ $subbranch->name }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection