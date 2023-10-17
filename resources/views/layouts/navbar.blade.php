<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="form-inline mr-auto">
  <ul class="navbar-nav mr-3">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a></li>
    <li><a href="#" class="nav-link nav-link-lg fullscreen-btn"><i data-feather="maximize"></i></a></li>
  </ul>
</div>
<section>
  <div class="container">
    <div class="icons">
    </div>
    <div class="time">
      <div class="time-colon">
        <div class="time-text">
          <span class="num hour_num">08</span>
          <span class="text">Hours</span>
        </div>
        <span class="colon" style="color: #F0F8FF">:</span>
      </div>
      <div class="time-colon">
        <div class="time-text">
          <span class="num min_num">45</span>
          <span class="text">Minutes</span>
        </div>
        <span class="colon" style="color: #F0F8FF">:</span>
      </div>
      <div class="time-colon">
        <div class="time-text">
          <span class="num sec_num">06</span>
          <span class="text">Seconds</span>
        </div>
        <span class="am_pm" style="font-size: 10px;">AM</span>
      </div>
    </div>
  </div>

</section>
<ul class="navbar-nav navbar-right" style="display: flex; align-items: center;">
  <div><label class="label_let" style="font-size: 16px; margin: 0;"><?php echo strtoupper($perm_details['session_user_name']); ?></label></div>&nbsp;&nbsp;
{{-- Image Onclick --}}
<div>
    <img src="https://www.freeiconspng.com/thumbs/help-icon/help-icon-22.png" class="user-img-radious-style shake-image" alt="Shaking Image" onclick="my_img()"   title="Help Tips.." style="cursor: pointer">
    <div id="message">Help Tips..</div>
</div>

{{-- End --}}
{{-- {!! asset('assets/img/h.jpg') !!} --}}

  <li class="dropdown" data-toggle="tooltip" data-placement="top">
    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <img alt="image" src="{!! asset('assets/img/user_icon.png') !!}" class="user-img-radious-style">
      <span class="d-sm-none d-lg-inline-block"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right pullDown" style="background-color: #3085d6;border-radius: 10px; z-index: 1;" >
        <div class="hello-section">
            Hello..!
        </div>
        <div class="profile-section">
            <a href="{{ route('profile') }}" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile</a>
        </div>

    </div>
  </li>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <div class="logout-icon" id="logout-link">
    <i class="fas fa-sign-out-alt"></i>
    Logout
  </div>
</ul>
<script>

  document.getElementById("logout-link").addEventListener("click", function(event) {
    event.preventDefault();
    window.location.href = "/logout";
  });
  function my_img() {
    Swal.fire({
        title: '<div style="display: flex; align-items: center; color: white;"><img src="../assets/img/h3.jpeg" alt="Image" style="max-width: 80px; max-height: 80px; margin-right: 10px;">Help Tips...</div>',
      html: `
        <div class="custom-container" style="font-family: 'Roboto', Cursive;">
          <div class="custom-content-class">
            D To C <i class='fas fa-arrow-right' style='color: #339c9e;'></i> Dealer To Company
          </div>
          <div class="custom-content-class">
            D To S <i class='fas fa-arrow-right' style='color: #339c9e;'></i> Dealer To Shop
          </div>
          <div class="custom-content-class">
            UOM <i class='fas fa-arrow-right' style='color: #339c9e;'></i> Unit Of Measure
          </div>
          <div class="custom-content-class">
            HSN Code <i class='fas fa-arrow-right' style='color: #339c9e;'></i> Harmonized System of Nomenclature
          </div>
        </div>
      `,
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Okay',
      customClass: {
        popup: 'custom-popup-class',
        content: 'custom-content-class',
      },
    });
  }
  </script>
</body>
</html>


<style>
    .swal2-title{
        background-color: #666c9f;
    }
    .user-img-radious-style {
    border-radius: 50%;
    width: 100px;
    height: 100px;
    transition: transform 0.2s;
  }

  .shake-image:hover {
    transform: scale(1.1);
  }

  #message {
    display: none;
    position: absolute;
    bottom: -20px;
    left: 86%;
    transform: translateX(-50%);
    background-color: rgba(56, 51, 51, 0.7);
    color: white;
    padding: 2px;
    border-radius: 10px;
  }

.shake-image {
  animation: shake 3s infinite;
}

@keyframes shake {
  0%, 100% {
    transform: translateX(0);
  }
  10%, 30%, 50%, 70%, 90% {
    transform: translateX(-5px);
  }
  20%, 40%, 60%, 80% {
    transform: translateX(5px);
  }
}
    .custom-container {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      margin: 5px 0;
    }

    .custom-content-class {
      text-align: left;
      margin-top: 5px;
      margin-bottom: 2px;
      color: #070b0e;
    }
    .swal2-confirm {
  border-radius: 25px; /* Adjust the radius as needed */
  color: #3085d6; /* Set button text color */
  background-color: rgba(58, 52, 71, 1); /* Set button background color */
}
    #swal2-title {
       color: #a9a0a0; /* Replace with your desired color */
    }


    #mass {
        background-color: #567aed;
        color: rgb(255, 255, 255); /* Set the color you want here */
        font-weight: bold;
        padding: 10px;
        }

.navbar-nav {
  display: flex;
  align-items: center;
  list-style: none;
  margin: 0;
  padding: 0;
}


.dropdown {
  position: relative;
  margin-right: 10px;
}


.dropdown .nav-link-user {
  display: flex;
  align-items: center;
  text-decoration: none;
  color: #333;
}
.user-img-radious-style {
  width: 30px;
  height: 30px;
  border-radius: 50%;
}


.dropdown-menu {
            width: 200px; /* Set a width for the dropdown */
        }
        .tooltip {
  position: relative;
  display: inline-block;
  border-bottom: px dotted black;
}
        /* Style for the "Hello!" section */
        .hello-section {
            background-color: #567aed; /* Set the background color you want here */
            color: #fff;
            padding: 10px; /* Add some padding for spacing */
        }

        /* Style for the "Profile" section */
        .profile-section {
            background-color: #ffffff; /* Set the background color you want here */
            padding: 10px; /* Add some padding for spacing */
        }


.dropdown:hover .dropdown-menu {
  display: block;
}

.dropdown-item {
  display: block;
  padding: 8px 12px;
  text-decoration: none;
  color: #333;
}

.label_let {
  font-size: 16px;
  margin: 0;
  color:white;
}

body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.logout-icon {
  display: inline-flex;
  align-items: center;
  padding: 5px;
  background-color: #3498db;
  color: #fff;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.logout-icon i {
  margin-right: 5px;
  font-size: 14px;
  transition: transform 0.3s ease;
}

.logout-icon:hover {
  background-color: rgb(250, 0, 0);
}

.logout-icon:hover i {
  transform: rotate(360deg);
}

@import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap');
.container .icons i.fa-sun{
  opacity: 0;
  pointer-events: none;
}
section.dark .container .icons i.fa-sun{
  opacity: 1;
  pointer-events: auto;
  font-size: 16px;
}
section .container .time{
  display: flex;
  align-items: center;
}
.container .time .time-colon{
  display: flex;
  align-items: center;
  position: relative;
  /* color: white; */
}
.time .time-colon .am_pm{
  position: absolute;
  top: 0;
  right: -20px;
  font-size: 20px;
  font-weight: 700;
  letter-spacing: 1px;
  color: white;
}
section.dark .time .time-colon .am_pm{
  color: #fff;
}
.time .time-colon .time-text{
  height: 49px;
  width: 64px;
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
  background: #F0F8FF;
  border-radius: 6px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}
section.dark .time .time-colon .time-text{
  background: #24292D;
}
.time .time-colon .time-text,
.time .time-colon .colon{
  font-size: 20px;
  font-weight: 400;
}
section.dark .time .time-text .num,
section.dark .time .colon{
  color: #fff;
}
.time .time-colon .colon{
  font-size: 20px;
  margin: 0 10px;
}
.time .time-colon .time-text .text{
  font-size: 12px;
  font-weight: 400;
  letter-spacing: 2px;
}
section.dark  .time .time-colon .text{
  color: #fff;
}
</style>
<script>

setInterval(() => {
  let date = new Date(),
    hour = date.getHours(),
    min = date.getMinutes(),
    sec = date.getSeconds();

  let d;
  d = hour < 12 ? "AM" : "PM";
  hour = hour > 12 ? hour - 12 : hour;
  hour = hour == 0 ? (hour = 12) : hour;

  hour = hour < 10 ? "0" + hour : hour;
  min = min < 10 ? "0" + min : min;
  sec = sec < 10 ? "0" + sec : sec;

  document.querySelector(".hour_num").innerText = hour;
  document.querySelector(".min_num").innerText = min;
  document.querySelector(".sec_num").innerText = sec;
  document.querySelector(".am_pm").innerText = d;
}, 1000);
</script>
