{{--======================
    Create New Relawan
====================--}}

<link rel="stylesheet" href="{{asset('css/form.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{asset('vendors/cleavejs/cleave.min.js')}}"></script>
<script src="{{asset('vendors/cleavejs/cleave-phone.id.js')}}"></script>
<form method="POST" action="{{ route('admin.volunteer-attendance.multiple') }}" class="row px-4 pt-2 pb-4">
    @csrf
    <div class="form-group col-md-3">
        @php
            $mSubbranches = \App\Models\Subbranch::all();
        @endphp
        <label for="recipient-name" class="col-form-label">Library:</label>
        <select id="selectLibrary" name="subbranch" class="selectpicker form-control" data-container="body" data-size="5"
                data-live-search="true" title="Subbranch...">
            @foreach($mSubbranches as $i => $mSubbranch)
                <option value="{{$mSubbranch->id}}">{{$mSubbranch->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="recipient-name" class="col-form-label">Volunteer:</label>
        
        <select id="selectVolunteers" name="volunteers[]" class="selectpicker form-control @if($errors->has('user')) is-invalid @endif"
                data-live-search="true" multiple title="Volunteer..." data-multipleSeparator=",">
            @foreach(App\Models\User::All() as $mVolunteer)
                <option value="{{ $mVolunteer->id }}" {{ (old('user') == $mVolunteer->id ? "selected":"") }}>{{ $mVolunteer->name }}</option>
            @endforeach
        </select>
        @if($errors->has('user'))
            <div class="invalid-feedback">{{$errors->first('user')}}</div>
        @endif
    </div>
    <div class="form-group col-md-2">
        <label for="recipient-name" class="col-form-label">Date:</label>
        <input type="text" name="date" class="flatpickr flatpickr-single form-control" placeholder="Date">
    </div>
    <div class="form-group col-md-2">
        <label for="recipient-name" class="col-form-label">Time in:</label>
        <input type="text" name="time_in" class="flatpickr flatpickr-times form-control" placeholder="Time in">
    </div>
    <div class="form-group col-md-2">
        <label for="recipient-name" class="col-form-label">Time Out:</label>
        <input type="text" name="time_out" class="flatpickr flatpickr-times form-control" placeholder="Time Out">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-success mr-2">Submit</button>
    </div>
</form>
<script>
    $(document).ready(function () {
        let today = new Date();
        let timeNow = today.getHours() + ":" + today.getMinutes();

        flatpickr(".flatpickr-single",{
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            defaultDate: today
        });

        flatpickr(".flatpickr-times",{
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            defaultDate: timeNow
        });
    });
</script>









