<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="shortcut icon" href="icon-search.PNG" type="text/img">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
    <script type="text/javascript" src="angular-1.7.8/angular.js">
    </script>
    <title></title>
  </head>
  <body ng-app="myApp" ng-controller="myCont">

    <!-- Navigtion -->
    <nav class="navbar navbar-expand-md navbar-blue bg-info">
    <div class="container-fluid">
      <a class="navbar-brand text-white bg-info" href="#"><h1>Wellcome To this web</h1></a>
<!---
      <button type="button" class="navbar-toggler" ng-click="myFunc()">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul ng-show="showMe" class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home</a>
      </li>
    </ul> -->
    </div>
    </nav>
    <nav class="sticky-top">
    <div class="container-fluid navbar navbar-red bg-dark text-white sticky-top fixed-top">
        <form role = "form" name="form1" method="post" action="myWeb.php">
      <label for="search"><h3><small>Find whatever you want around you by searching:</small></h3></label>
      <input class="form-coltrol" type="search" name="search_value" ng-model="sear" onfocus="this.placeholder='';" onblur="this.placeholder='Search spacific place'" placeholder="Search spacific place">
      <input type="submit" name="search" value="GO">
<!-- search button
      <input type="image" class="btn btn-outline-info btn-sm bg-white" src="icon-search.PNG" alt="GO" name="" value="">
      <button type="button" class="btn btn-outline-info btn-sm"><img src="icon-search.PNG" alt="Search"></button>
-->
    </form>
  </div></nav>
    <!-- Jumbotron -->
      <div class="row container-fluid padding m-sm-auto p-sm-2 pb-2 pb-sm-3 pt-sm-3 border rounded">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10 text-secondary color-white">
          <p class="text-primary"><h5>Do you have your own buissness? Then why dont you advertise here! be available for everyone!</h5></p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2">
          <a href="advertisment.php">
            <button type="button" class="btn btn-outline-dark btn-sm">Register Here..</button>
          </a>
        </div>
      </div>
   <!-- commenting the carousel part
    <div class="carousel slide" data-ride="carousel">
      <!-- Indicators --><!--
      <ol class="carousel-indicators">
        <li  ng-click="myItem(0)"></li>
        <li ng-click="myItem(1)">
        </li>
        <li ng-click="myItem(2)"></li>
        <li ng-click="myItem(3)"></li>
      </ol>

      <!-- Wrapper for slides --><!--
      <div class="carousel-inner" role="listbox">
        <div class="item active" ng-show="showZero">
          <img src="Sc.PNG" alt="Chania">
          <div class="carousel-caption">
            <h1 class="display-2">My Website</h1>
            <h3>My web using Angular and bootstrap</h3>
            <button type="button" class="btn btn-outline-light btn-lg">Andi</button>
            <button type="button" class="btn btn-success btn-lg">Get More</button>
          </div>
        </div>

        <div class="item" ng-show="showOne">
          <img src="trm.PNG" alt="Chania">
        </div>

        <div class="item" ng-show="showTwo">
          <img src="Sc.PNG" alt="Flower">
          <div class="carousel-caption">
            <h1 class="display-2">It will help you to find your place</h1>
            <h3>My web using Angular and bootstrap</h3>
            <button type="button" class="btn btn-outline-light btn-lg" ng-click="myItem(0)">Back to 1</button>
            <button type="button" class="btn btn-primary btn-lg">Get More</button>
          </div>
        </div>

        <div class="item" ng-show="showThree">
          <img src="Sc.PNG" alt="Flower">
        </div>
      </div>
    </div>
    end of carousel -->
<!--- Cards -->
<div class="row padding positon-fixed">

<div class="container-fluid col-4 col-sm-3 col-md-2 col-lg-2 border-right padding">
  <h4 class="h5 text-center text-white bg-info p-0">Select By Catagory</h4>
  <hr class="p-0">

<ul class="list-group list-inline-item list-unstyled align-items-center p-0">
  <li><a href="#"><button type="button" class="btn btn-outline-transparent btn-sm">Hotel and Restaurant</button></a></li>
  <li><a href="#"><button type="button" class="btn btn-outline-transparent btn-sm">Hotel and Restaurant</button></a></li>
  <li><a href="#"><button type="button" class="btn btn-outline-secondary btn-sm">Hotel and Restaurant</button></a></li>
  <li><a href="#"><button type="button" class="btn btn-outline-transparent btn-sm">Hotel and Restaurant</button></a></li>
  <li><a href="#"><button type="button" class="btn btn-outline-secondary btn-link btn-sm">Hotel and Restaurant</button></a></li>

</ul>

</div>
<div class="container-fluid col-8 col-sm-9 col-md-10 col-lg-10 padding">
  <div class="row padding">


    <?php
  //  include 'retrive.php';
    include 'db_connect.php';

    $geolocation = "";
    $slct_advs = "SELECT * FROM advertisements";
    $slct_qry = mysqli_query($cnct,$slct_advs);
    if(!$slct_qry )
    {
    die('Could not get data: ' . mysql_error());
    }
// if users are searching using  placename
if(isset($_POST['search'])&&$_POST["search_value"]!=""){
  $search_val = $_POST["search_value"];
   // write a search match and display back to the user code Here
   //
  echo $search_val;
}
  //else
  else{

    while($row = mysqli_fetch_assoc($slct_qry)):

          $adv_code = "{$row['ad_code']}";
          $firm_name = "{$row['name']}";
          $bsns_type = "{$row['type']}";
          //while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
          $detail = "{$row['description']}";
          $address = "{$row['address']}";
    // get the location
          $get_loc = "SELECT city,sub_city FROM location WHERE unique_name = '$address'";
          $loc_qry = mysqli_query($cnct,$get_loc);
          $loc_row = mysqli_fetch_array($loc_qry);
        //  echo "<br>".$address.",".$loc_row[0],",".$loc_row[1];
    // get multimedia like image
          $get_img = "SELECT image,video FROM multimedia WHERE ad_code = '$adv_code'";
          $mml_qrry = mysqli_query($cnct,$get_img);
          while($row2 = mysqli_fetch_assoc($mml_qrry)):
            $img = "{$row2['image']}";
            $vid = "{$row2['video']}";
          ?>
        <div class="col-sm-6 col-md-4 col-lg-3 padding pb-3 pb-md-3">
          <div class="panel panel-default card padding">
            <div class="panel-heading">
              <h4><?php echo $firm_name; ?></h4>
              <h5><?php echo $bsns_type; ?></h5>
            </div>
            <div class="panel-body p-2">
              <?php if(($img != '')&&($vid =='')){?>
                 <img class="card-img w-90" style="height:200px;"  src="<?php echo $img; ?>" alt=''>'
              <?php }elseif(($img == '')&&($vid != '')){?>
                <iframe class='embed-responsive-item w-75' onload="this.pause();" src='<?php echo $vid; ?>'></iframe>
          <?php    } ?>
              <p class="card-text"><?php echo $detail; ?></p>
              <form class="" action="showdetail.php" method="post">
                  <input type="text" name="hold" value="<?php echo $adv_code; ?>" hidden>
                  <input type="submit" class="btn btn-outline-info btn-sm" name="submit" value="show detail">
              </form>
            </div>
            <div class="panel-footer">
              <strong class="text-uppercase">Location:</strong>
              <h5 class="text-uppercase"><?php echo $loc_row[0]."     "; ?><small><strong ><?php echo $loc_row[1]; ?></strong></small></h5>
              <strong>
             <i><?php echo $address; ?></i>
              </strong>
            </div>
        </div>
        </div>
        <?php endwhile ?>
      <?php endwhile ?>



    <div class="col-sm-6 col-md-4 col-lg-3 padding pb-3 pb-md-3">
      <div class="panel panel-default card padding">
        <div class="panel-heading">
          <h4>Alison Fashion House </h4>
        </div>
        <div class="panel-body padding">
          <img class="card-img w-75"  src="a.jpg" alt="">
          <p class="card-text">In this restaurant you can get what ever you want</p>
          <a href="#" class="btn btn-outline-secondary">View Detail</a>
        </div>
      <div class="panel-footer">
        <strong>Location:</strong> around Mesalemya in front of the church
      </div>
    </div>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3 pb-3 pb-md-3">
      <div class="card panel">
        <div class="card-body">
          <img class="card-img-top"src="b.jpg" alt="">
          <h4 class="card-title">Food Resturant</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. In this restaurant you can get what ever you want</p>
          <a href="#" class="btn btn-outline-secondary">View Detail</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 pb-3 pb-md-3">
      <div class="card panel">
        <div class="card-body">
          <img class="card-img-top"src="b.jpg" alt="">
          <h4 class="card-title">Food Resturant</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. In this restaurant you can get what ever you want</p>
          <a href="#" class="btn btn-outline-secondary">View Detail</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 pb-3 pb-md-3">
      <div class="card panel">
        <div class="card-body">
          <h4 class="card-title">Higer Clinic</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. In this restaurant you can get what ever you want</p>
          <a href="#" class="btn btn-outline-secondary">View Detail</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 pb-3 pb-md-3">
      <div class="card panel">
        <div class="card-body">
          <img class="card-img-top"src="b.jpg" alt="">
          Around Highschool
          <h4 class="card-title">Food Resturant and Cafee</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. In this restaurant you can get what ever you want</p>
          <a href="#" class="btn btn-outline-secondary">View Detail</a>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3 pb-3 pb-md-3">
      <div class="card panel panel-default">
        <div class="panel-heading">
          Babe Tour guiding
        </div>
        <div class="panel-body">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. In this restaurant you can get what ever you
          <a href="#" class="btn btn-outline-secondary">View Detail</a>
        </div>
        <div class="panel-footer">
          location: around piasa 3rd way
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3 pb-3 pb-md-3">
      <div class="card panel">
        <div class="card-body">
          <img class="card-img-top"src="c.jpg" alt="">
          <h4 class="card-title">Food Resturant</h4>
          <p class="card-text">In this restaurant you can get what ever you want</p>
          <a href="#" class="btn btn-outline-secondary">View Detail</a>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3 pb-3 pb-md-3">
      <div class="card panel">
        <div class="card-body">
          <img class="card-img-top"src="b.jpg" alt="">
          <h4 class="card-title">Food Resturant</h4>
          <a href="#" class="btn btn-outline-secondary">View Detail</a>
        </div>
      </div>
    </div>
  <?php } ?>
  </div>
</div>
</div>


<footer>
<div class="container-fluid padding">
<div class="row text-center">
<div class="col-12">
  <hr class="light">
  <h5>More information</h5>
  <hr class="light">
  <p>About us</p>
  <p>Read more</p>
  <p>And more...</p>
</div>
<div class="col-12">
<hr class="light">
<h5>&copy; All Rights Are Reserved.</h5>
</div>
</div>
</div>
</footer>

<script>
  angular.module("myApp",[]).controller("myCont",function($scope){
    $scope.showMe = false;
    $scope.showZero = true;
    $scope.showOne = false;
    $scope.showTwo = false;
    $scope.showThree = false;

    $scope.myFunc = function(){
      $scope.showMe = !$scope.showMe;
    }
    $scope.myItem = function(x){
      if (x==0) {
        $scope.showOne = false;
        $scope.showTwo = false;
        $scope.showThree = false;
        $scope.showZero = true;
      }
      else if(x==1){
      $scope.showZero = false;
      $scope.showTwo = false;
      $scope.showThree = false;
      $scope.showOne = true;}
      else if (x==2) {
        $scope.showOne = false;
        $scope.showZero = false;
        $scope.showThree = false;
        $scope.showTwo = true;
      }
      else if (x==3) {
        $scope.showOne = false;
        $scope.showTwo = false;
        $scope.showZero = false;
        $scope.showThree = true;
      }
    }
  });
</script>
  </body>
</html>
