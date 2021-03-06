<?php
  session_start();
  if(isset($_COOKIE['UIDN'])){
    $_SESSION['UCLIN'] = $_COOKIE['UCLIN'];
		$_SESSION['ROLE'] = $_COOKIE['ROLE'];
		$_SESSION['EMAIL'] = $_COOKIE['EMAIL'];
    $_SESSION['UIDN'] = $_COOKIE['UIDN'];
    if($_SESSION['ROLE'] == 'student'){
      header("location: http://localhost:8090/sharifahmad2061.github.io/student.html");
    }else{
      header("location: http://localhost:8090/sharifahmad2061.github.io/teacher.html");
    }  
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
  <title>materialize</title>
</head>

<body>
  <article class="container">
    <div class="row">
      <!-- start of row -->
      <div class="card col s12 m10 offset-m1 l8 offset-l2" id="card0">
        <!-- start of card -->
        <a id="form_sup_fab" class="btn-floating waves-effect waves-light black my_edge_fab my_xl">
          <i class="fa fa-pencil" style="line-height: 100px; font-size:5rem;"></i>
        </a>
        <div class="card-content">
          <span class="card-title">SIGN IN</span>
          <form id="form_sin" class="card-content" action="sin.up" method="post"> <!-- form -->
            <div class="input-field tooltipped" data-position="top" data-delay="50" data-tooltip="Registration Number">
              <i class="fa fa-user prefix"></i>
              <input id="reg_sin" type="number" name="uidn" class="validate" min="000000" max="999999" required="required">
              <label for="reg_sin" data-error="format: 139743">UIDN</label>
            </div>
            <div class="input-field">
              <i class="fa fa-key prefix"></i>
              <input id="pass_sin" type="password" name="psd" class="validate" required="required" maxlength="15">
              <label for="pass_sin">Password</label>
            </div>
          </form>
          <div class="card-action">
            <button id="button_sin" class="btn btn-large waves-effect waves-light black">GO
              <i class="fa fa-send right"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- end of card -->
      <!-- start of card -->
      <div class="card col s12 m10 offset-m1 l8 offset-l2 black white-text" id="card1" style="display:none;">
        <a id="form_sin_fab" class="btn-floating white my_edge_fab my_xl">
          <i class="fa fa-times black-text" style="line-height: 100px; font-size:5rem;"></i>
        </a>
        <div class="card-content">
          <span class="card-title">SIGN UP</span>
          <form id="form_sup" class="card-content" action="sup.php" method="post">  <!-- form -->
            <div class="input-field">
              <i class="fa fa-address-book prefix"></i>
              <input id="fname_sup" type="text" name="fname" class="validate" pattern="[a-zA-Z]+"  maxlength="15" required="required">
              <label for="fname_sup" data-error="only english letters">First Name</label>
            </div>
            <div class="input-field">
              <i class="fa fa-address-book prefix"></i>
              <input id="lname_sup" type="text" name="lname" class="validate" pattern="[a-zA-Z]+"  maxlength="15" required="required">
              <label for="lname_sup" data-error="only english letters">Last Name</label>
            </div>
            <div class="input-field tooltipped" data-position="top" data-delay="50" data-tooltip="Registration Number">
              <i class="fa fa-user prefix"></i>
              <input id="reg_sup" type="number" name="uidn" class="validate" min="000000" max="999999" required="required">
              <label for="reg_sup" data-error="format: 139743">UIDN</label>
            </div>
            <div class="input-field">
              <i class="fa fa-envelope prefix"></i>
              <input id="email_sup" type="email" name="email" class="validate" pattern=".+@seecs.edu.pk"  maxlength="40" required="required">
              <label for="email_sup" data-error="format: xyz.seecs.edu.pk">Email</label>
            </div>
            <div class="input-field" id="role_sup">
              <i class="fa fa-caret-square-o-down prefix"></i>
              <select name="role" required="required">
                <option disabled selected>Choose Your Option</option>
                <option value="student">student</option>
                <option value="teacher">Teacher</option>
              </select>
              <label>Role</label>
            </div>
            <div class="input-field">
              <i class="fa fa-key prefix"></i>
              <input id="pass_sup" type="password" name="psd" class="validate"  maxlength="15" required="required">
              <label for="pass_sup">Password</label>
            </div>
          </form>
        </div>
        <div class="card-action">
          <button id="button_sup" class="btn btn-large white black-text waves-effect waves-light">GO
            <i class="fa fa-send right "></i>
          </button>
        </div>
      </div>
    </div>
    <!-- end of row -->
  </article>
  <script src="jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script src="script.js"></script>
</body>

</html>



<!-- 62763975414-0q0ujc2bgmka98b33fh22b6ci07o6c8m.apps.googleusercontent.com -->