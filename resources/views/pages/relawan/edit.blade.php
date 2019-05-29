{{--======================
    Relawan Section
====================--}}
@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendors/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('vendors/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('vendors/cleavejs/cleave.min.js')}}"></script>
    <script src="{{asset('vendors/cleavejs/cleave-phone.id.js')}}"></script>
    <script>
        $(document).ready(function () {
            flatpickr(".flatpickr-single",{
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });

            var cleaveNIK = new Cleave('.cleave-nik',{
                numericOnly: true,
                blocks: [4,4,4,4],
                delimiters: [" "]
            });
            var cleavePhone = new Cleave('.cleave-phone',{
                cleavePhone: true,
                blocks: [3,3,9],
                prefix  : "+62",
                delimiters: [" "," "]
            });

        })
    </script>

@endsection

@section('content')
    <div class="content-wrapper">
        @breadcrumb(['links'=>[
        ['url'=>route('admin.relawan.index'),'text' =>'Relawan'],
        ['text' =>'Edit Relawan'],
        ]])
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit {{$mRelawan->name}} Profile</h4>
                        <form method="POST" action="{{ route('admin.relawan.update',['id'=>$mRelawan->id]) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="relawanName">Name<i class="text-danger">*</i></label>
                                <input type="text" id="relawanName" name="name" placeholder="Name" value="{{ $mRelawan->name }}"
                                       class="form-control @if($errors->has('name')) is-invalid @endif">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="relawanEmail">Email<i class="text-danger">*</i></label>
                                <input type="email" id="relawanEmail" name="email" placeholder="Email" value="{{ $mRelawan->email }}"
                                       class="form-control @if($errors->has('email')) is-invalid @endif">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">{{$errors->first('email')}}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="relawanNIK">NIK</label>
                                <input type="text" id="relawanNIK" name="nik" placeholder="NIK" value="{{ $mRelawan->detail->nik ?? '' }}"
                                       class="cleave-nik form-control @if($errors->has('nik')) is-invalid @endif">
                                @if($errors->has('nik'))
                                    <div class="invalid-feedback">{{$errors->first('nik')}}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="relawanPhone">Phone</label>
                                <input type="text" id="relawanPhone" name="phone" placeholder="{{ str_replace("+62","",$mRelawan->detail->phone ?? '') }}" value="{{ str_replace("+62","",$mRelawan->detail->phone ?? '') }}"
                                       class="cleave-phone form-control @if($errors->has('phone')) is-invalid @endif">
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">{{$errors->first('phone')}}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="" class="d-block">Gender</label>

                                <div class="form-radio form-radio-flat d-inline-block mr-3 mt-0">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="flatRadios1" id="flatRadios1" value="M"
                                               {{isset($mRelawan->detail->gender) ? ($mRelawan->detail->gender == 'M' ? 'checked':'' ) : ''}}> Male
                                        <i class="input-helper"></i></label>
                                </div>
                                <div class="form-radio form-radio-flat d-inline-block mr-3 mt-0">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="flatRadios1" id="flatRadios2" value="F"
                                               {{isset($mRelawan->detail->gender) ? ($mRelawan->detail->gender == 'F' ? 'checked':'' ) : ''}}> Female
                                        <i class="input-helper"></i></label>
                                </div>
                                @if($errors->has('gender'))
                                    <div class="invalid-feedback">{{$errors->first('gender')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="relawanDOB">Date of Birth </label>
                                <input type="text" id="relawanDOB" name="dob" placeholder="Date of Birth" value="{{ old('dob') ?? $mRelawan->detail->dob  }}"
                                       class="flatpickr flatpickr-single form-control @if($errors->has('dob')) is-invalid @endif">
                                @if($errors->has('dob'))
                                    <div class="invalid-feedback">{{$errors->first('dob')}}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="relawanJoinDate">Join Date</label>
                                <input type="text" id="relawanJoinDate" name="join_dt" placeholder="Join Date" value="{{ old('join_dt') ?? $mRelawan->detail->join_dt }}"
                                       class="flatpickr flatpickr-single form-control @if($errors->has('join_dt')) is-invalid @endif">
                                @if($errors->has('join_dt'))
                                    <div class="invalid-feedback">{{$errors->first('join_dt')}}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="relawanCity">City</label>
                                <select id="relawanCity" name="city_id" class="form-control @if($errors->has('city_id')) is-invalid @endif">
                                    <option selected>Choose Location...</option>
                                    @foreach(App\Models\City::All() as $city)
                                        <option value="{{ $city->id }}" {{ (old('city_id') == $city->id ? "selected":"") }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('city_id'))
                                    <div class="invalid-feedback">{{$errors->first('city_id')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="relawanAddress">Address</label>
                                <textarea id="relawanAddress" rows="2" name="address" placeholder="e.g. (Jl. Bahagia, No. 60, RT 001/002, Manggarai, Jakarta Barat)"
                                          class="form-control @if($errors->has('address')) is-invalid @endif">{{ old('address') }}</textarea>
                                @if($errors->has('address'))
                                    <div class="invalid-feedback">{{$errors->first('address')}}</div>
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