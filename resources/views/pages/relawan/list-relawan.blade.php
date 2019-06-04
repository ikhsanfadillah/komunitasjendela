<style>
    .table-navigation{
        padding: 0.8rem 1.2rem;
    }
</style>
<div class="table-navigation" style="border-width: 1px 0; border-color: #dee2e6; border-style: solid">
    <form id="searchForm" class="form-inline">
        <div class="mr-2">
            <i class="mdi mdi-magnify text-muted position-absolute" style="padding: 5px 9px;"></i>
            <input id="inptSearchVolunteer" type="text" class="form-control" style="padding-left: 30px;" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div id="actionForm" action="{{ route('admin.relawan.index') }}" method="get" style="display: none">
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
<form class="table-responsive" data-simplebar style="max-height: 70vh;">
    <table id="dTable1" class="table table-hover">
        <thead>
        <tr>
            <th class="pr-1" style="padding: 16px">
                <div class="form-check form-check-flat">
                    <label class="form-check-label pl-0">
                        <input type="checkbox" class="checkboxAll form-check-input" value="checkedAll">
                    </label>
                </div>
            </th>
            <th>Active</th>
            <th class="px-1"></th>
            <th>Name</th>
            <th>Email</th>
            <th>Birthdate</th>
            <th>Join Date</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @for($j = 0 ; $j < 7 ; $j ++ )
            @foreach($mRelawans as $i => $mRelawan)
            <tr>
                <td class="pr-1" style="padding: 16px">
                    <div class="form-check form-check-flat">
                        <label class="form-check-label">
                            <input type="checkbox" class="checkboxTr form-check-input" value="{{$mRelawan->id}}">
                        </label>
                    </div>
                </td>
                <td>
                    <label class="input-toggle">
                        <input class="isActive" name="cbxIsActive" value="{{$mRelawan->id}}" type="checkbox" value="{{$mRelawan->id}}" {{ $mRelawan->isActive ? 'checked' : '' }}>
                        <span></span>
                    </label>
                </td>
                <td class="py-1 px-1">
                    @if($mRelawan->detail()->exists())
                        <img src="{{ asset('images/faces/'.($mRelawan->detail->gender == App\Models\User::GENDER_MALE ? "boy" : "girl").'.png') }}" class="bg-inverse-dark" alt="image" />
                    @else
                        <img src="{{ asset('images/faces/boy.png') }}" class="bg-inverse-dark" alt="image" />
                    @endif
                </td>
                <td>{{ $mRelawan->name }}</td>
                <td>{{ $mRelawan->email }}</td>

                <td>@isset($mRelawan->detail->dob) {{ date('M d, Y', strtotime($mRelawan->detail->dob)) }} @endisset</td>
                <td>@isset($mRelawan->detail->dob) {{ date('M d, Y', strtotime($mRelawan->detail->join_dt)) }} @endisset</td>
                <td>
                    <form action="{{ route('admin.relawan.destroy',$mRelawan->id) }}" method="POST">

                    <div class="dropdown d-inline-block">
                        <a class="text-dark text-center" style="font-size: 1.3em" data-offset="30" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                            <a class="dropdown-item" href="{{ route('admin.relawan.edit',['id'=>$mRelawan->id]) }}">
                                <i class="mdi mdi-pencil"></i> Edit Relawan</a>

                            @method('DELETE')
                            @csrf
                            <button class="dropdown-item" type="submit"><i class="mdi mdi-delete-empty"></i> Delete Relawan</button>
                        </div>
                    </div>
                    </form>
                </td>
            </tr>
        @endforeach
        @endfor
        </tbody>
    </table>
</form>

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

    } );
</script>