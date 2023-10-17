<!DOCTYPE html>
<!-- saved from url=(0042)https://suitex.simplify360.com/clientLogin -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Social Media Monitoring, Engagement Console,linkedin, digg, delicious, Facebook, Twitter, brand Managament, Social Media Analytics">
<meta name="description" content="Simplify360 Offers a one stop solution to the social media needs of a business and lets you engage with your customers and interpret your social presence. Join Simplify360� to become a social investor and see the future of business unfold.">
<title>Login -Simplify360 </title>
<link rel="shortcut icon" href="https://suitex.simplify360.com/images/Logo_360.png;jsessionid=ECD1EDA7AD96F94D4C9E1D0CB5CE5661">


<link href="./Login -Simplify360_files/font-awesome.css" rel="stylesheet" type="text/css">
<link href="./Login -Simplify360_files/login-box_current.css" rel="stylesheet" type="text/css">
<link href="./Login -Simplify360_files/components.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="./Login -Simplify360_files/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./Login -Simplify360_files/bootstrap-extended.min.css">
<!--     BEGIN: Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="./Login -Simplify360_files/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="./Login -Simplify360_files/icheck.css">
    <link rel="stylesheet" type="text/css" href="./Login -Simplify360_files/custom.css">
<!--     END: Vendor CSS -->

<script type="text/javascript" src="./Login -Simplify360_files/jquery.min.js.download"></script>
<script type="text/javascript" src="./Login -Simplify360_files/jquery-ui-1.13.0.min.js.download"></script>
<script src="./Login -Simplify360_files/jquery.validate.min.js.download" type="text/javascript"></script>
<script src="./Login -Simplify360_files/additional-methods.js.download" type="text/javascript"></script>

<style>
.error{
color: red;
}
.btn-outline-primary {
    color: white;
    border-color: #00b5b8;
}
.btn-outline-primary:hover {
    color: white;
    background-color: #002168;
       border-color: white;
}
.btn-outline-primary {
    color: #00b5b8 !important;
    border-color: #00b5b8 !important;
}
.card-header {
    padding: 1.5rem 1.5rem;
    margin-bottom: 0;
    background-color: #fff;
}
.form-control {
	height: calc(2.75rem + 2px)
}
.px-1 {
	padding-left : 1rem !important;
	padding-right : 1rem !important;
}
.py-1 {
	padding-top : 1rem !important;
	padding-bottom : 1rem !important
}
body {
	font-size : 0.9rem;
}
.btn {
    color: #404e67;
    text-align: center;
    vertical-align: middle;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    line-height: 1.25;
    border-radius: 0.25rem;
}
html body.bg-full-screen-image {
    background: url(./bg-2.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    background-size: cover;
}
</style>
<script type="text/javascript">
$(document).ready(function() {


	$(".intro-text").html('<div class="sec1"><h1>Stay Social, Stay Relevant</h1></div> <h3 class="m-t-35">Up your social media game with Simplify360&#39;s unique solution for all your Social Media needs.With us, keeping your customers happy and your prospects tempted, is just so SIMPLE! </h3>');

	$('#div2').hide();

	$('#signin').validate( {
        errorElement: 'span',
        errorClass: 'error',
        focusInvalid: true,
        ignore: "",
        rules: {
        	emailId: {
        	required: true

            },

            password: {

            	required: true
              }
        },
		messages: {
			password: {
				required: 'Please enter a password'
			}
		}
    } );

	$('#signin').submit(function() {

		var c = '', k = 'Simplify360';
		var input = $("#login_password").val();
	    while (k.length < input.length)
	    {
	         k += k;
	    }
	    for(var i=0; i<input.length; i++)
	    {
	        var value1 = input[i].charCodeAt(0);
	        var value2 = k[i].charCodeAt(0);

	        var xorValue = value1 ^ value2;

	        var xorValueAsHexString = xorValue.toString("16");

	        if (xorValueAsHexString.length < 2) {
	            xorValueAsHexString = "0" + xorValueAsHexString;
	        }

	        c += xorValueAsHexString;
	    }

	    $("#login_password").val(c);
	    return true;

	});

	$('input[type=submit]').click(function() {
	    $(this).attr('disabled', 'disabled');
	    $(this).parents('form').submit();
	});

});
</script>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                      <a href="#"><img class="logo-st" src="./pss.png"> <br><br>LOgin</a>
                                    </div>

											<h5 class="text-error text-center semi-bold">

											</h5>
                                </div>
                                <div class="card-content">

                                    <div class="card-body">
                                    		<form method="post" class="form-horizontal" id="signin" action="{{ route('login.post') }}">
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control valid" id="name" name="name" placeholder="Username" required="" aria-describedby="login_emailId-error" aria-invalid="false"><span id="login_emailId-error" class="error" style="display: none;"></span>
                                                <div class="form-control-position">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" autocomplete="false" class="form-control valid" id="password" name="password" size="30" maxlength="2048" placeholder="Password" required="" aria-describedby="login_password-error" aria-invalid="false"><span id="login_password-error" class="error" style="display: none;"></span>
                                                <div class="form-control-position">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-sm-6 col-12 text-center text-sm-left pr-0">

                                                </div>

                                            </div>
                                            <button type="submit" class="btn btn-outline-primary btn-block" id="rp" onclick="login_form(name.value,password.value)"><i class="fa fa-unlock"></i> Login</button>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>



</body><!-- END: Body--></html>
