<?php
include "submit.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
      <link rel="shortcut icon" href="icon-search.PNG" type="text/img">
      <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
      <link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="drop.css">
      <script type="text/javascript" src="angular-1.7.8/angular.js">
      </script>
      <title>Advertise</title>
    </head>
  <body ng-app="myApp">
    <nav class="navbar navbar-expand-lg navbar-blue bg-info">
      <div class="container-fluid">
          <a class="navbar-brand text-capitalize text-white bg-info" href="myWeb.php"><h1>Wellcome To this web</h1></a>
          <a class="nav-link nav-tabs text-uppercase text-white bg-info" href="myWeb.php">Home</a>
      </div>
    </nav>

    <div class="row">
        <!--
          <div class="container-fluid border-right col-md-2">
            <ul>
              <li>
                <a href="#">Show dropdown</a>
                <ul>
                  <li><a href="#">Option 1</a></li>
                  <li><a href="#">Option 2</a></li>
                  <li><a href="#">Option 3</a></li>
                </ul>
              </li>
            </ul>
          </div>
        -->
      <div class="border-right col-md-1">
      </div>

      <div class="continer-fluid col-md-10">
        <div class="col-md-4 pb-3">
            <h5 class="h5 text-white bg-info">Register By Filling The Form Properly</h5>
        </div>
        <form class="form-horizontal"enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="myForm" role="form" ng-controller="formCont" novalidate>
          <div class="form-group col-sm-6 col-md-4">
              <input list="cities" class="form-control" placeholder="enter or choose city" name="city" ng-model="listInput" required>
              <datalist class="" id="cities">
                  <option value=""></option>
                  <option value="Addis Abeba">Bole</option>
                  <option value="Hawassa">bulbla</option>
                  <option value="Adama">01</option>
                  <option value="Dire Dawa">sabian</option>
              </datalist>
          </div>

          <div class="form-group col-sm-6 col-md-4">
            <input type="text" class="form-control" placeholder="Your sefer name" name="subcity" value="">
          </div>

          <div class="form-group col-sm-6 col-md-4">
            <input type="text" class="form-control" placeholder="Your specific location" name="sefer" value="">
          </div>
          <div class="form-group was-valid col-sm-6 col-md-4">
            <input type="text" class="form-control" placeholder="company name" name="company" value="">
          </div>
          <div class="form-group col-sm-6 col-md-4">
            <input type="text" class="form-control" placeholder="your buisness catagory" name="catagory" ng-model="catagory" value="" required>
          </div>
          <div class="col-md-6">
            <span ng-show="myForm.catagory.$touched && myForm.catagory.$invalid">
                <span style="color:red;" ng-show="myForm.catagory.$error.required">Catagory is required</span>
            </span>
          </div>
          <div class="form-group col-sm-6 col-md-4">
            <label class="form-text" for="detail">write your buisness promotion here:</label><br>
            <textarea class="form-control" name="detail" rows="5"></textarea>
          </div>
          <div class="form-group form-control-file col-sm-6 col-md-4">
            <input type="file" name="uploads[]" multiple>
          </div>
          <div class="form-group col-sm-10">
            <input type="submit" name="submit" class="btn btn-outline-primary btl-lg" value="Continue">
          </div>
        </form>
      </div>
    </div>
    <script>
      angular.module('myApp' , []).controller('formCont' , function($scope){
            //  $scope.catagory = "your buisness catagory";
      });
    </script>
  </body>
</html>
