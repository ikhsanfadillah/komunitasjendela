{{--======================
    Student Section
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
                numericOnly: true,
                blocks: [3,3,9],
                prefix: '+62',
                delimiters: [" "," "]
            });

        })
    </script>

@endsection

@section('content')
<div class="content-wrapper">
    @breadcrumb(['links'=>[
    ['url'=>route('admin.student.index'),'text' =>'Student'],
    ['text' =>'Form Student'],
    ]])
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Student Form</h4>


                    <form method="POST" action="{{ route('admin.student.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="isActive">Is Active</label><br>

                            <label class="input-toggle">
                                <input id="isActive" name="is_active" type="checkbox"
                                {{(old('is_active')? 'checked':'' )}}>
                                <span></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="studentSubbranch">Library<i class="text-danger">*</i></label>
                            <select id="studentSubbranch" name="subbranch_id" class="form-control @if($errors->has('subbranch_id')) is-invalid @endif">
                                <option selected disabled>Choose Library</option>
                                @foreach(App\Models\Subbranch::All() as $subbranch)
                                    <option value="{{ $subbranch->id }}" {{ (old('subbranch_id') == $subbranch->id ? "selected":"") }}>Perpus {{ $subbranch->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('subbranch_id'))
                                <div class="invalid-feedback">{{$errors->first('subbranch_id')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="studentName">Student Name<i class="text-danger">*</i></label>
                            <input type="text" id="studentName" name="name" placeholder="Name" value="{{ old('name') }}"
                                   class="form-control @if($errors->has('name')) is-invalid @endif">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="studentName">Nickname<i class="text-danger">*</i></label>
                            <input type="text" id="studentNickname" name="nickname" placeholder="Nickname" value="{{ old('nickname') }}"
                                   class="form-control @if($errors->has('nickname')) is-invalid @endif">
                            @if($errors->has('nickname'))
                                <div class="invalid-feedback">{{$errors->first('nickname')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="" class="d-block">Gender</label>

                            <div class="form-radio form-radio-flat d-inline-block mr-3 mt-0">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="flatRadios1" id="flatRadios1" value="M" checked
                                    {{isset($mRelawan->gender) ? ($mRelawan->gender == 'M' ? 'checked':'' ) : ''}}> Laki-laki
                                    <i class="input-helper"></i></label>
                            </div>
                            <div class="form-radio form-radio-flat d-inline-block mr-3 mt-0">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="flatRadios1" id="flatRadios2" value="F"
                                    {{isset($mRelawan->gender) ? ($mRelawan->gender == 'F' ? 'checked':'' ) : ''}}> Perempuan
                                    <i class="input-helper"></i></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="studentPhone">Phone</label>
                            <input type="text" id="studentPhone" name="phone" placeholder="Phone" value="{{ old('phone') }}"
                                   class="cleave-phone form-control @if($errors->has('phone')) is-invalid @endif">
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">{{$errors->first('phone')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="studentDOB">DOB</label>
                            <input type="text" id="studentDOB" name="dob" placeholder="Date of Birth" value="{{ old('dob') }}"
                                   class="flatpickr flatpickr-single form-control @if($errors->has('dob')) is-invalid @endif">
                            @if($errors->has('dob'))
                                <div class="invalid-feedback">{{$errors->first('dob')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="studentJoinDate">Join Date</label>
                            <input type="text" id="studentJoinDate" name="join_dt" placeholder="Join Date" value="{{ old('join_dt') }}"
                                   class="flatpickr flatpickr-single form-control @if($errors->has('join_dt')) is-invalid @endif">
                            @if($errors->has('join_dt'))
                                <div class="invalid-feedback">{{$errors->first('join_dt')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="studentCity">City</label>
                            <select id="studentCity" name="city_id" class="form-control @if($errors->has('city_id')) is-invalid @endif">
                                <option selected disabled>Choose City</option>
                                @foreach(App\Models\City::All() as $city)
                                    <option value="{{ $city->id }}" {{ (old('city_id') == $city->id ? "selected":"") }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('city_id'))
                                <div class="invalid-feedback">{{$errors->first('city_id')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="studentAddress">Address</label>
                            <textarea id="studentAddress" rows="3" name="address"
                                      class="form-control @if($errors->has('address')) is-invalid @endif">{{ old('address') }}</textarea>
                            @if($errors->has('address'))
                                <div class="invalid-feedback">{{$errors->first('address')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="studentReligion">Religion</label>
                            <select id="studentReligion" name="religion" class="form-control @if($errors->has('religion')) is-invalid @endif">
                                <option selected disabled>Choose Religion</option>
                                @php
                                $religions = ['Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu']
                                @endphp
                                @foreach($religions as $religion)
                                    <option value="{{ $religion }}" {{ (old('religion') == $religion ? "selected":"") }}>{{ $religion }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('religion'))
                                <div class="invalid-feedback">{{$errors->first('religion')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="studentSchoolname">School Name</label>
                            <input type="text" id="studentSchoolname" name="schoolname" placeholder="School Name" value="{{ old('schoolname') }}"
                                   class="form-control @if($errors->has('schoolname')) is-invalid @endif">
                            @if($errors->has('schoolname'))
                                <div class="invalid-feedback">{{$errors->first('schoolname')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="studentGrade">Class / Grade</label>
                            <select id="studentGrade" name="grade" class="form-control @if($errors->has('grade')) is-invalid @endif">
                                <option selected disabled>Choose Class / Grade</option>
                                @php
                                    $grades = [
                                    'Taman kanak-kanak'=>['PAUD','TK A','TK B'],
                                    'Sekolah Dasar'=>['SD 1','SD 2','SD 3','SD 4','SD 5','SD 6'],
                                    'Sekolah Menengah Pertama / Sederajat'=>['SMP 1','SMP 2','SMP 3'],
                                    'Sekolah Menengah Atas / Sederajat'=>['SMA 1','SMA 2','SMA 3']
                                ];
                                @endphp
                                @foreach($grades as $group => $grade)
                                    <optgroup label="{{$group}}">
                                        @foreach($grade as $kelas)
                                            <option value="{{ $kelas }}" {{ (old('grade') == $kelas ? "selected":"") }}>{{ $kelas }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @if($errors->has('grade'))
                                <div class="invalid-feedback">{{$errors->first('grade')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="studentTotalSaudara">Number Of Siblings</label>
                            <input type="number" id="studentTotalSaudara" name="number_of_siblings" placeholder="jumlah saudara kandung" value="{{ old('number_of_siblings') }}"
                                   class="form-control @if($errors->has('number_of_siblings')) is-invalid @endif">
                            @if($errors->has('number_of_siblings'))
                                <div class="invalid-feedback">{{$errors->first('number_of_siblings')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="studentOrder">Order</label>
                            <input type="number" id="studentOrder" name="order" placeholder="Urutan kesaudaraan cont:(ke '3' dari n bersaudara)" value="{{ old('order') }}"
                                   class="form-control @if($errors->has('order')) is-invalid @endif">
                            @if($errors->has('order'))
                                <div class="invalid-feedback">{{$errors->first('order')}}</div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



