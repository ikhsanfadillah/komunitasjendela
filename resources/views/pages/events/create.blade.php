{{--======================
    Event Section
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

            flatpickr(".flatpickr-time",{
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
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
    ['url'=>route('admin.event.index'),'text' =>'Event'],
    ['text' =>'Form Event'],
    ]])
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Event Form</h4>


                    <form method="POST" action="{{ route('admin.event.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="eventName">Event Name<i class="text-danger">*</i></label>
                            <input type="text" id="eventName" name="name" placeholder="Name" value="{{ old('name') }}"
                                   class="form-control @if($errors->has('name')) is-invalid @endif">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="eventName">Slug<i class="text-danger">*</i></label>
                            <p class="slugfy mb-0">Lorem ipsum dolor sit.</p>
                            <input type="text" id="eventNickname" name="slug" placeholder="Nickname" value="{{ old('slug') }}"
                                   class="form-control @if($errors->has('slug')) is-invalid @endif">
                            @if($errors->has('slug'))
                                <div class="invalid-feedback">{{$errors->first('slug')}}</div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="eventCity">Type of Time</label>
                            <select id="eventCity" name="time_type" class="form-control selectpicker" title="Select Type of time">
                                @foreach(['day','date'] as $type)
                                    <option value="{{ $type }}" {{ (old('time_type') == $type ? "selected":"") }}>{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="eventDate">Date</label>
                            <input type="text" id="eventDate" name="date" placeholder="" value="{{ old('date') }}"
                                   class="flatpickr flatpickr-single form-control @if($errors->has('date')) is-invalid @endif">
                            @if($errors->has('date'))
                                <div class="invalid-feedback">{{$errors->first('date')}}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Days</label>
                            
                            <select id="selectVolunteers" name="day[]" class="selectpicker form-control @if($errors->has('day')) is-invalid @endif"
                                    multiple title="Select Days" data-multipleSeparator=",">
                                @foreach(App\Models\Event::$eventDays as $idx => $day)
                                    <option value="{{ $idx }}" {{ (old('day') == $idx ? "selected":"") }}>{{ $day }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('day'))
                                <div class="invalid-feedback">{{$errors->first('day')}}</div>
                            @endif
                        </div>

                        
                        <div class="form-group">
                            <label for="eventDate">Time</label>
                            <input type="text" id="eventTime" name="time" placeholder="Time" value="{{ old('time') }}"
                                   class="flatpickr flatpickr-time form-control @if($errors->has('time')) is-invalid @endif">
                            @if($errors->has('time'))
                                <div class="invalid-feedback">{{$errors->first('time')}}</div>
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



