<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>PPS OIL</title>
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='shortcut icon' type='image/x-icon' href="{!! asset('assets/img/favicon.ico') !!}" />
    <style>
        body {
            background-image: url("{!! asset('assets/img/login_img.jpg') !!}");
            opacity: 0.9;
            background-color: #a8611f;
            background-size: cover;
            position: relative;
            z-index: 1;
        }


        .login-container {
            max-width: 400px;
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;

        }

        .card {
            background-image: url("{!! asset('assets/img/card_img.jpg') !!}");
            background-size: cover;
            border-color: #7c6519;
            backdrop-filter: saturate(160%) blur(10px);
            border-radius: 16px;
            top: 10px;
            right: 10px;

        }

        form .input_box {
            height: 50px;
            width: 100%;
            position: relative;
            margin-top: 15px;
        }

        .input_box input {
            height: 100%;
            width: 100%;
            outline: none;
            border-radius: 5px;
            padding-left: 45px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .input_box .icon {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: rgb(22, 3, 3);
        }

        .form-group button:hover {
            background-color: #fda500;
            color: #300600;

        }

        /* input[type=text]:focus {
        border: 3px solid #2c0600;
      }
      input[type=password]:focus {
        border: 3px solid #2c0600;
      } */

        .btn {
            color: white;
            background-color: #300600;
        }

        .alert-danger {
            color: #f50119;
            background-color: #ffffff;
            border-color: #fa0019;
        }
    </style>

</head>

<body>
    <div class="container login-container">

        <div class="card">
            <div class="card-header">
                <h4 class="text-center" style="color: #300600; font-family:sans-serif; ">PPS Agro Foods</h4>
                {{-- <img src="../assets/img/pps.png" height="60" width="100"> --}}
            </div>
            <h5 class="text-error text-center semi-bold">
                @if (session('success'))
                    <div class="alert alert-danger">
                        <strong> {{ session('success') }}</strong>
                    </div>
                @endif
            </h5>
            <div class="card-body">
                <form action="/login-post/" method="POST" onsubmit="validation">
                    @csrf
                    <div class="form-group">

                        <div class="input_box">
                            <input type="text" id="name" type="name" class="form-control" name="name"
                                tabindex="1" autofocus placeholder="Username">
                            <div class="icon"> <i class='fa fa-user' style='color: blue;width:30px'></i></div>
                        </div>
                        <div class="size">
                            @if (session('error'))
                                <label style="color: red"><i class="fa fa-warning"
                                        style="font-size:20px;color:red"></i>&nbsp;{{ session('error') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input_box">
                            <input type="password" id="password" type="password" class="form-control" name="password"
                                tabindex="2" placeholder="Password">



                            <div class="icon"><i class='fa fa-lock' style='color: blue;width:30px'></i></div>
                        </div>
                        <div class="size">
                            @if (session('errors'))
                                <label style="color: red"><i class="fa fa-warning"
                                        style="font-size:20px;color:red"></i>&nbsp;{{ session('errors') }}</label>
                            @endif
                        </div>

                    </div>
                    <div class="form-group">
                        <button type="submit" onclick="login_form(name.value,password.value)" class="btn  btn-block"
                            tabindex="4" style="border-radius: 15px;">
                            <b>Login</b>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>
