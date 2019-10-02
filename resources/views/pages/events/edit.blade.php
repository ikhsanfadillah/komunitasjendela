{{--======================
    Event Section
====================--}}
@extends('layouts.admin')

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
                        <h4><b>Event Form</b></h4>
                        <form method="POST" action="{{ route('admin.event.update',['id'=>$mEvent->id]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="eventName">Event Name<i class="text-danger">*</i></label>
                                <input type="text" id="eventName" name="name" placeholder="Name" value="{{ old('name',$mEvent->name) }}"
                                       class="form-control @if($errors->has('name')) is-invalid @endif">

                                @php
                                    $rootUrl = (!empty($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . "/";
                                @endphp
                                <p class="text-muted pt-1"><span>{{$rootUrl}}</span><span id="slugPreview" class="text-black">{{ old('slug',$mEvent->slug) }}</span></p>
                                <input type="hidden" id="eventSlug" name="slug" placeholder="slug" value="{{ old('slug',$mEvent->slug) }}"
                                       class="form-control @if($errors->has('slug')) is-invalid @endif">

                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                @endif
                                @if($errors->has('slug'))
                                    <div class="invalid-feedback">{{$errors->first('slug')}}</div>
                                @endif
                            </div>

                            <div class="map-container mb-3" style="background: linear-gradient(120deg, #00e4d0, #5983e8); margin: 0 -1.81rem;">
                                <div id="latlongmap" class="" style="height: 300px"></div>
                                <div class="d:f j-c:s-b a-i:c flx-d:c-r p:.5 bg-light text-black">
                                    <small class="t-a:c">*Lingkaran <b class="text-danger">merah</b> menandakan jangkauan lokasi Absen</small>
                                    <span id="latlngspan">{{ "(" . old('latitude',$mEvent->latitude) . ", " . old('latitude',$mEvent->longitude) . ")" }}</span>
                                </div>
                            </div>

                            <div class="form-group d-none">
                                <label for="eventLat">Latitude<i class="text-danger">*</i></label>
                                <input type="text" id="eventLat" name="latitude" value="{{ old('latitude',number_format($mEvent->lat, 7)) }}"
                                       class="form-control @if($errors->has('latitude')) is-invalid @endif">
                                @if($errors->has('latitude'))
                                    <div class="invalid-feedback">{{$errors->first('latitude')}}</div>
                                @endif
                            </div>

                            <div class="form-group d-none">
                                <label for="eventLong">Longitude<i class="text-danger">*</i></label>
                                <input type="text" id="eventLong" name="longitude" value="{{ old('longitude',number_format($mEvent->long, 7)) }}"
                                       class="form-control @if($errors->has('longitude')) is-invalid @endif">
                                @if($errors->has('longitude'))
                                    <div class="invalid-feedback">{{$errors->first('longitude')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="eventTimeType">Type of Time</label>
                                <select id="eventTimeType" name="time_type" class="form-control selectpicker" title="Select Type of time">
                                    @foreach(['day','date'] as $type)
                                        <option value="{{ $type }}" {{ (old('time_type',$mEvent->time_type) == $type ? "selected":"") }}>{{ ucfirst($type) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" style="display: none">
                                <label for="eventDate">Date</label>
                                <input type="text" id="eventDate" name="date" placeholder="Pick a date" value="{{ old('date',$mEvent->date) }}"
                                       class="flatpickr flatpickr-single form-control @if($errors->has('date')) is-invalid @endif">
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">{{$errors->first('date')}}</div>
                                @endif
                            </div>

                            <div class="form-group" style="display: none">
                                <label for="recipient-name" class="col-form-label">Days</label>

                                <select id="eventDays" name="day[]" class="selectpicker form-control @if($errors->has('day')) is-invalid @endif"
                                        multiple title="Select Days" data-multipleSeparator=",">
                                    @foreach(App\Models\Event::$eventDays as $idx => $day)
                                        <option value="{{ $idx }}"
                                            {{ (collect(old('day'))->contains($idx)) ? 'selected':'' }}
                                            {{ (!empty($mEvent->day) && $mEvent->day != "null" && in_array($idx,json_decode($mEvent->day))) ? 'selected' : ''}}
                                        >
                                            {{ $day }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('day'))
                                    <div class="invalid-feedback">{{$errors->first('day')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="eventTime">Time</label>
                                <input type="text" id="eventTime" name="time" placeholder="Time" value="{{ old('time',$mEvent->time) }}"
                                       class="flatpickr flatpickr-time form-control @if($errors->has('time')) is-invalid @endif">
                                @if($errors->has('time'))
                                    <div class="invalid-feedback">{{$errors->first('time')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" placeholder="description" rows="2" class="form-control @if($errors->has('description')) is-invalid @endif">{{ old('description',$mEvent->description) }}</textarea>
                                @if($errors->has('description'))
                                    <div class="invalid-feedback">{{$errors->first('description')}}</div>
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

@section('styles')
    <link rel="stylesheet" href="{{asset('vendors/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
            integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
            crossorigin=""></script>
    <style>
        .bootstrap-select > button.btn-light{
            background: white !important;
        }
    </style>
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
            var eventTimeType = $("#eventTimeType").change(function () {
                if (this.value === "day"){
                    $('#eventDate').closest('.form-group').hide();
                    $('#eventDays').closest('.form-group').fadeIn();
                }
                else if (this.value === "date"){
                    $('#eventDays').closest('.form-group').hide();
                    $('#eventDate').closest('.form-group').fadeIn();
                }
            })
            var eventName = $(document).on('input',"#eventName",function () {
                $("#slugPreview").html(slugify(this.value));
                $("#eventSlug").val(slugify(this.value));
            });
            eventTimeType.change();
        });

        function slugify(string) {
            const a = 'àáäâãåăæąçćčđďèéěėëêęğǵḧìíïîįłḿǹńňñòóöôœøṕŕřßşśšșťțùúüûǘůűūųẃẍÿýźžż·/_,:;'
            const b = 'aaaaaaaaacccddeeeeeeegghiiiiilmnnnnooooooprrsssssttuuuuuuuuuwxyyzzz------'
            const p = new RegExp(a.split('').join('|'), 'g')

            return string.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
                .replace(/&/g, '-and-') // Replace & with 'and'
                .replace(/[^\w\-]+/g, '') // Remove all non-word characters
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, '') // Trim - from end of text
        }
    </script>
    <script>

        var inpLat = parseFloat(document.getElementById("eventLat").value) || -6.176195;
        var inpLong = parseFloat(document.getElementById("eventLong").value) || 106.826663;
        var mymap = L.map('latlongmap');
        var mmr = L.marker([0,0]);
        mmr.bindPopup('0,0');
        mmr.addTo(mymap);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {foo: 'bar',
            attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'}).addTo(mymap);
        mymap.on('click', onMapClick);
        settingMap(inpLat, inpLong,5);

        function isll(num) {
            var val = parseFloat(num);
            if (!isNaN(val) && val <= 90 && val >= -90)
                return true;
            else
                return false;
        }

        function onMapClick(e) {
            mmr.setLatLng(e.latlng);
            setui(e.latlng.lat,e.latlng.lng,mymap.getZoom());
        }

        function dec2dms(e,t) {
            document.getElementById("dms-lat").innerHTML = getdms(e, !0), document.getElementById("dms-lng").innerHTML = getdms(t, !1)
        }
        function getdms(e, t) {
            var n = 0, m = 0, l = 0, a = "X";
            return a = t && 0 > e ? "S" : !t && 0 > e ? "W" : t ? "N" : "E", d = Math.abs(e), n = Math.floor(d), l = 3600 * (d - n), m = Math.floor(l / 60), l = Math.round(1e4 * (l - 60 * m)) / 1e4, n + "&deg; " + m + "' " + l + "'' " + a
        }

        function settingMap(lt,ln,zm) {
            setui(lt,ln,zm);
            mmr.setLatLng(L.latLng(lt,ln));
            mymap.setView([lt,ln], zm);
            mmr.setPopupContent(lt + ',' + ln).openPopup();
        }


        function setui(lt,ln,zm) {
            lt = Number(lt).toFixed(6);
            ln = Number(ln).toFixed(6);
            mmr.setPopupContent(lt + ',' + ln).openPopup();
            setCircle(lt,ln);
            document.getElementById("eventLat").value=lt;
            document.getElementById("eventLong").value=ln;
            document.getElementById("latlngspan").innerHTML ="(" + lt + ", " + ln + ")";
        }

        var clickCircle;
        function setCircle(lt,ln){
            if (clickCircle != undefined) {
                mymap.removeLayer(clickCircle);
            };
            clickCircle = L.circle([lt,ln], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.3,
                radius: 250
            }).addTo(mymap);
        }

    </script>
@endsection



