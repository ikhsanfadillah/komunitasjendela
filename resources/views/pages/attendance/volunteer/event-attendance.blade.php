<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="{{asset('vendors/cleavejs/cleave.min.js')}}"></script>
    <script src="{{asset('vendors/cleavejs/cleave-phone.id.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <title>Document</title>
    <style>
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
        .login-block{
            background: linear-gradient(0deg, #ffffff, #e52d27, #b31217);
            background-size: 400% 400%;

            -webkit-animation: AnimationName 10s ease infinite;
            -moz-animation: AnimationName 10s ease infinite;
            animation: AnimationName 10s ease infinite;
            float:left;
            width:100%;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 10px;
        }

        @-webkit-keyframes AnimationName {
            0%{background-position:50% 0%}
            50%{background-position:50% 100%}
            100%{background-position:50% 0%}
        }
        @-moz-keyframes AnimationName {
            0%{background-position:50% 0%}
            50%{background-position:50% 100%}
            100%{background-position:50% 0%}
        }
        @keyframes AnimationName {
            0%{background-position:50% 0%}
            50%{background-position:50% 100%}
            100%{background-position:50% 0%}
        }
        .banner-sec{background:url(https://ceknricek.com/photo/plugin/article/2018/1541482771_1-org.jpg)  no-repeat left bottom; background-size:cover; min-height:30vh; border-radius: 10px 10px 0px 0px; padding:0;}
        .container{background:#fff; border-radius: 10px; }
        .login-sec{padding: 15px 30px 50px; position:relative;}
        .login-sec .copy-text{padding-top:50px; font-size:13px; text-align:center;}
        .login-sec .copy-text i{color:#e52d27;}
        .login-sec .copy-text a{color:#b31217;}
        .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #b31217;}
        .login-sec h2:after{content:" "; width:100px; height:5px; background:#e52d27; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
        .btn-login{background: #b31217; color:#fff; font-weight:600;}
        .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
        .banner-text h2{color:#fff; font-weight:600;}
        .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
        .banner-text p{color:#fff;}

        @media (min-width: 576px) {
            .banner-sec{
                min-height:30vh; border-radius: 10px 0px 0px 10px;
            }
            .login-sec{padding: 50px 30px; position:relative;}

        }
    </style>
</head>
<body style="">

<!------ Include the above in your HEAD tag ---------->

<section class="login-block">
    <div class="container">
        <form method="POST" action="{{ route('volunteer-attendance.self-attending') }}" class="row">
            <div class="col-md-8 banner-sec p-3" style="display: flex;flex-direction: column-reverse;">
                <h5 class="text-white d-none d-sm-block">Bangga jadi anak indonesia</h5>
                <h1 class="text-white d-none d-sm-block">HUT RI 74</h1>
            </div>
            <div class="col-md-4 login-sec">
                <h2 class="text-center">Halo, Jendelis</h2>
                <div class="login-form">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $mEvent->id }}">
                    <input type="hidden" name="long" id="long">
                    <input type="hidden" name="lat" id="lat">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-capitalize">no handphone</label>
                        <input type="text" name="phone" class="form-control cleave-phone" placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="text-capitalize">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-login  btn-block float-right">Submit</button>

                </div>
                <div class="copy-text">Selamat hari kemerdekaan <i class="fa fa-heart"></i> by Jendelist</div>
            </div>
        </form>
    </div>
</section>
<script>

    var alertType = "{{ Session::get('alert-type') }}";
    var alertMessage = "{{ Session::get('alert-message') }}";


    var cleavePhone = new Cleave('.cleave-phone',{
        cleavePhone: true,
        blocks: [3,3,9],
        prefix  : "+62",
        delimiters: [" "," "]
    });
    $(document).ready(function () {
        getLocation();
        console.log(alertType != "", alertType,alertMessage);

        if (alertType != ""){
            Swal.fire({
                position: 'center',
                type: alertType,
                title: alertMessage,
                showConfirmButton: true,
                timer: 8000
            })
        }
    })

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        $('#long').val(position.coords.latitude );
        $('#lat').val(position.coords.longitude);
    }

</script>
</body>
</html>