
<link rel="stylesheet" href="{{asset('vendors/flatpickr/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('css/form.css')}}">

<script src="{{asset('vendors/flatpickr/flatpickr.min.js')}}"></script>
<style>
    .table-navigation{
        padding: 0.8rem 1.2rem;
    }
    .pagination{
        margin: 0;
    }
</style>

<div class="table-navigation d:f a-i:c" style="border-width: 1px 0; border-color: #dee2e6; border-style: solid">
    <form id="searchForm" class="form-inline d-inline-flex ">
        <div class="m-r:.5">
            <i class="mdi mdi-magnify text-muted position-absolute" style="padding: 5px 9px;"></i>
            <input id="inptSearchVolunteer" type="text" class="form-control" style="padding-left: 30px;" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <button type="submit" class="btn btn-primary d:n">Submit</button>
    </form>
    <button class="btn-inverse-outline-secondary rounded-circle border-0 text-muted m-r:.5 cur:p" aria-expanded="false" data-toggle="modal" data-target="#filterModal" style=" font-size: 1.2em">
        <span class="mdi mdi-plus"></span>
    </button>
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalTitle" aria-hidden="true">
        <form class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document" action="{{ route('admin.volunteer-attendance.index') }}">
            <div class="modal-content border-0">
                <div class="modal-header text-white a-i:c">
                    <button type="button" class="close text-white col t-a:l p-0" style="opacity:0.9;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="mdi mdi-close"></span>
                    </button>

                    <button type="submit" class="btn btn-inverse-outline-light border-0 text-white f-w:700">Apply Filter</button>
                </div>
                <div class="modal-body bg-white" style="min-width: 200px;">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text p-x:.1">
                                    <div class="checkbox">
                                        <input type="checkbox" id="checkbox_1">
                                        <label for="checkbox_1"></label>
                                    </div>
                                </div>
                            </div>
                            @php $mSubbranches = \App\Models\Subbranch::all(); @endphp
                            <select id="relawanCity" name="user" class="selectpicker form-control @if($errors->has('user')) is-invalid @endif"
                                    data-live-search="true" multiple title="Choose Library">
                            @foreach($mSubbranches as $mSubbranch)
                                <option value="{{$mSubbranch->id}}">{{$mSubbranch->name}}</option>
                            @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">{{$errors->first('user')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dateRange">Date Range</label>
                        <input type="text" id="dateRange" name="dob" placeholder="Date range" value="{{ old('dob') }}"
                               class="flatpickr flatpickr-range form-control @if($errors->has('dob')) is-invalid @endif">
                        @if($errors->has('dob'))
                            <div class="invalid-feedback">{{$errors->first('dob')}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="actionForm" action="{{ route('admin.volunteer-attendance.index') }}" method="get" style="display: none">
        <form action="" class="d-inline">
            @method('DELETE')
            @csrf
            <input  type="text" name="checkedID" class="inpCheckedID">
            <button class="btn btn-danger">Delete</button>
        </form>
        <button id="btnDeactiveUser" class="btn btn-light">Deactive</button>
        <button id="btnActiveUser" class="btn btn-light">Active</button>
    </div>
</div>
<div class="table-container">
    <form class="table-responsive" data-simplebar style="max-height: 70vh;">
        <table id="dTable1" class="table table-hover" >
            <thead>
            <tr>
                <th class="pr-1" style="padding: 16px">
                    <div class="form-check form-check-flat">
                        <label class="form-check-label pl-0">
                            <input type="checkbox" class="checkboxAll form-check-input" value="checkedAll">
                        </label>
                    </div>
                </th>
                <th>Status</th>
                <th>Volunteer</th>
                <th>Checker</th>
                <th>library</th>
                <th>Date</th>
                <th>In</th>
                <th>Out</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if(count($mVolunteerAttendances) > 0)
                @foreach($mVolunteerAttendances as $i => $mVolunteerAttendance)
                    <tr>
                        <td class="pr-1" style="padding: 16px">
                            <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                    <input type="checkbox" class="checkboxTr form-check-input" value="{{$mVolunteerAttendance->id}}">
                                </label>
                            </div>
                        </td>
                        <td>
                            <b class="text-{{ ($mVolunteerAttendance->status)?'success':'muted' }}">{{ ($mVolunteerAttendance->status)?'Prensent':'Absent' }}</b>
                        </td>
                        <td>{{ $mVolunteerAttendance->volunteer->name }} </td>
                        <td>{{ $mVolunteerAttendance->checker->name ?? '' }}</td>
                        <td>{{ $mVolunteerAttendance->subbranch->name }}</td>
                        <td>{{ $mVolunteerAttendance->date }}</td>
                        <td>{{ $mVolunteerAttendance->time_in }}</td>
                        <td>{{ $mVolunteerAttendance->time_out }}</td>
                        <td>
                            <div class="dropdown d-inline-block">
                                <a class="text-dark text-center" style="font-size: 1.3em" data-offset="30" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                                    <form action="{{ route('admin.volunteer-attendance.destroy',$mVolunteerAttendance->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="dropdown-item" type="submit"><i class="mdi mdi-delete-empty"></i> Deleasdte</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="t-a:c">
                        <span >No Data</span>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </form>
</div>
@if($mVolunteerAttendances->count() > 0)
<div class="d:f j-c:s-b p:1" style="border-top: 1px solid #dee2e6;">
    <div></div>
    {{ $mVolunteerAttendances->links() }}
</div>
@endif

<script>
    $(document).ready(function() {
        jCheckboxes = $("#dTable1 .checkboxTr");
        jCheckboxAll = $("#dTable1 .checkboxAll");
        btnActiveUser = document.getElementById('btnActiveUser');
        btnDeactiveUser = document.getElementById('btnDeactiveUser');
        inptSearchVolunteer = document.getElementById('inptSearchVolunteer');

        var checkedIDs = () => {
            let checkedCheckbox =$('#dTable1>tbody>tr:visible .checkboxTr:checkbox:checked');
            if(checkedCheckbox.length){
                $('#searchForm').hide();
                $('#actionForm').fadeIn();
            }else{
                $('#searchForm').fadeIn();
                $('#actionForm').hide();
            }
            return checkedCheckbox.map(function() {
                return this.value;
            }).get().join(",");
        };

        jCheckboxAll.change(function () {
            jCheckboxes.prop('checked', $(this).prop("checked"));
            $('.inpCheckedID').val(checkedIDs());
        });
        jCheckboxes.change(function () {
            $('.inpCheckedID').val(checkedIDs());
        });

        btnActiveUser.onclick = function () {
            checkedID = $('.inpCheckedID').val();
            checkID = checkedID.split(',').forEach(function (id, i) {
                document.querySelector("input[name='cbxIsActive'][value='"+id+"']").checked = true;
            });
        };
        btnDeactiveUser.onclick = function () {
            checkedID = document.querySelector('.inpCheckedID').value;
            checkID = checkedID.split(',').forEach(function (id, i) {
                document.querySelector("input[name='cbxIsActive'][value='"+id+"']").checked = false;
            });
        }

        inptSearchVolunteer.addEventListener("keyup", function() {
            var tRows = document.querySelectorAll("#dTable1>tbody>tr");
            searchVal = inptSearchVolunteer.value.toLowerCase();
            tRows.forEach(function(tr) {
                if (tr.textContent.trim().toLowerCase().indexOf(searchVal) > -1)
                    tr.style.display = 'table-row';
                else tr.style.display = 'none';
            });
        });

        flatpickr(".flatpickr-range",{
            mode: 'range',
            maxDate: "today",
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
    } );
</script>