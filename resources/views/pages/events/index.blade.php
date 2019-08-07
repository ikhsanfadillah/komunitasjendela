{{--======================
    Event Section
====================--}}
@extends('layouts.admin')

@section('styles')
    <script src="{{asset('vendors/qrcode/qrcode.js')}}"></script>
@endsection
@section('scripts')

    
    <script type="text/javascript">
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width: 250,
            height: 250,
            colorDark : "#000000",
            colorLight : "#00000000",
            correctLevel : QRCode.CorrectLevel.M
        });
        $(document).ready(function(){
            $('.showQrcode').click(function(){
                var url = $(this).data('url');
                var title = $(this).data('title');
                $('.eventTitle').text(title)
                $('.qrCodeModal .eventLink').attr('href',url)
                $('.qrCodeModal .eventLink').html(url);
                
                qrcode.makeCode(url);
            })
        })
    </script>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            @breadcrumb(['links'=>[
            ['text' =>'Event'],
            ]])

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-inline-block">List Event</h4>
                        <a href="{{Route('admin.event.create')}}" class="btn btn-primary btn-sm  d-inline-block float-right text-white">
                            <i class="mdi mdi-account-plus"></i> Create Event </a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Type</th>
                                    <th>Day</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mEvents as $i => $mEvent)
                                    <tr>
                                        <td>{{ $mEvent->name }}</td>
                                        <td><a href="{{ url('/attendance/volunteer/'.$mEvent->slug) }}">{{ $mEvent->slug }} <i class="fa fa-link"></i></a></td>
                                        <td>{{ $mEvent->type }}</td>
                                        <td>{{ $mEvent->day }}</td>
                                        <td>{{ $mEvent->date }}</td>
                                        <td>{{ $mEvent->time }}</td>

                                        <td>
                                            <a href="#" class="text-dark showQrcode" style="font-size: 1.7em" data-toggle="modal" data-target=".qrCodeModal" data-title="{{ $mEvent->name }}" data-url="{{ url('/attendance/volunteer/'.$mEvent->slug) }}"><i class="mdi mdi-qrcode"></i></a>
                                            <a href="{{route('admin.event.edit',['id'=>$mEvent->id])}}" class="text-dark" style="font-size: 1.7em"><i class="mdi mdi-pencil"></i></a>
                                            <a href="#" class="text-dark" style="font-size: 1.7em"
                                               onclick="event.preventDefault(); document.getElementById('delete-user-form').submit();">
                                                <i class="mdi mdi-delete-empty"></i></a>


                                            <form id="delete-user-form" action="{{ route('admin.event.destroy',$mEvent->id) }}" method="POST" style="display: none;">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade qrCodeModal" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0">
                <div class="modal-header text-white a-i:c">
                    <button type="button" class="close text-white col t-a:l p-0" style="opacity:0.9;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="mdi mdi-close"></span>
                    </button>
                    <h4 class="modal-title col t-a:c" id="attendanceModalTitle" style="">QRCode</h4>
                    <span class="col"></span>
                </div>
                <div class="modal-body d:f flx-d:c a-i:c">
                    <h4 class="eventTitle">Subam Lorem, ipsum.</h4>
                    <div id="qrcode"></div>
                    <p class="h5 p-t:.7"> URL : <a href="" class="eventLink ">Subam Lorem, ipsum.</a></p>
                   
                </div>
            </div>
        </div>
    </div>
@endsection
