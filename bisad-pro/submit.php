<?php
    include 'db_connect.php';

    $cmpny = $cty = $sefer = $ctgry = $dtil = "";

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
        $cmpny = $_POST["company"];
        $cty = $_POST["city"];
        $sefer = $_POST["sefer"];
        $subcity = $_POST["subcity"];
        $ctgry = $_POST["catagory"];
        $dtil = $_POST["detail"];
        //timestamp using time() function
        $date_time = "the time is ".date("m/d/y G.i:s <br>",time());

        //add location
        $slct_adrs = "SELECT adrs_id FROM location WHERE city='$cty' AND sub_city='$subcity' AND unique_name='$sefer'";
        $slct_query = mysqli_query($cnct,$slct_adrs);
        $no_rows = mysqli_num_rows($slct_query);
        $no_of_rows = mysqli_fetch_array($slct_query);
        if($no_rows == 0){
            $insert_adrs = "INSERT INTO location(city,sub_city,unique_name,geolocation) VALUES('$cty','$subcity','$sefer','')";
            $adrs_query = mysqli_query($cnct,$insert_adrs);
            if(!$adrs_query){
                die('Could Not Insert into Location' . mysql_error());
            }
            $slct_adrs_id = "SELECT adrs_id FROM location WHERE city='$cty' AND sub_city='$subcity' AND unique_name='$sefer'";
            $adrs_id = mysqli_query($cnct,$slct_adrs_id);
        }else{
            $adrs_id = $no_of_rows[0];
        }
        //insert(add) buisness catagory or type
        $cat_qry = "SELECT b_code FROM catagory WHERE type_name = '$ctgry'";
        $cat_query = mysqli_query($cnct,$cat_qry);
        $cat_rows = mysqli_num_rows($cat_query);
        $cat_rw = mysqli_fetch_array($cat_query);
        if($cat_rows == 0){
            $add_cat = "INSERT INTO catagory(type_name) VALUES('$ctgry')";
            $ad_cat_query = mysqli_query($cnct,$add_cat);
            if(!$ad_cat_query){
                die('Could Not Insert into catagory'.mysql_error());
            }
            $code_qry = "SELECT b_code FROM catagory WHERE type_name = '$ctgry'";
            $cat_id = mysqli_query($cnct,$code_qry);
        }else{
            $cat_id = $cat_rw[0];
        }
        //insert new advertisment
        $ad_insert = "INSERT INTO advertisements(type,name,description,address) VALUES('$ctgry','$cmpny','$dtil','$sefer')";
        $advrt_query = mysqli_query($cnct,$ad_insert);
        if(!$advrt_query){
            die('Could Not Insert into Advertisment'.mysql_error());
        }
        //get advertisment id
        $adv_qry = "SELECT ad_code FROM advertisements WHERE type = '$ctgry' AND address = '$sefer' AND name = '$cmpny' AND description = '$dtil'";
        $adv_code = mysqli_query($cnct,$adv_qry);
        $adv_rows = mysqli_fetch_array($adv_code);
        //echo "<br> the adv code".$adv_rows[0];
        //$cat_rows = mysqli_num_rows($cat_query);
        //for uploaded files
        
        if($_FILES["uploads"]["name"][0] != ""){
            //get current working directory
            $currentDir = getcwd();
            $uploadDir = "/uploads/";
            $error = [];
            $img = ['jpeg','jpg','png'];
            $video = ['mp4'];
            $total = count($_FILES["uploads"]["name"]);
            
            for($i=0;$i<$total;$i++){
                
                $fileName = $_FILES["uploads"]["name"][$i];
                $fileType = $_FILES["uploads"]["type"][$i];
                $fileSize = $_FILES["uploads"]["size"][$i];
                $fileTempName = $_FILES["uploads"]["tmp_name"][$i];
                // $uploadPath = $currentDir.$uploadDir.basename($fileName);
                $ext = strtolower(end(explode('.',$fileName)));
                if(in_array($ext,$img)){
                    $uploadPath = $currentDir.$uploadDir."/images/".basename($fileName);
                    $upload = move_uploaded_file($fileTempName,$uploadPath);
                        //insert the image path intothe database
                    $upldPath = "uploads/images/".basename($fileName);
                    $insrt_img = "INSERT INTO multimedia(ad_code,image,video) VALUES('$adv_rows[0]','$upldPath','')";
                    $img_qry = mysqli_query($cnct,$insrt_img);
                    if(!$img_qry){
                        die('Could Not Insert into Images'.mysql_error());
                    }
                    if(!$upload){
                        //echo "img is uploadded";
                    }
                }elseif (in_array($ext,$video)) {
                    $uploadPath = $currentDir.$uploadDir."/videos/".basename($fileName);
                    $upload = move_uploaded_file($fileTempName,$uploadPath);
                    $upldPath = "uploads/videos/".basename($fileName);
                    $insrt_vd = "INSERT INTO multimedia(ad_code,image,video) VALUES('$adv_rows[0]','','$upldPath')";
                    $vd_qry = mysqli_query($cnct,$insrt_vd);
                    if(!$vd_qry){
                        die('Could Not Insert into Videos'.mysql_error());
                    }
                    if($upload){
                        //echo "video is uploadded";
                    }
                }else{
                    
                    echo "un allowed extensions";
                }
            }

            // echo "<br>".count($_FILES["uploads"]["name"])."<br>";
        }
        else{
            echo "no";
        }
        //echo "<br>" .getcwd()."<br>" . $cmpny . "<br>" . $cty . "<br>" . $sefer . "<br>" . $ctgry . "<br>" . $dtil . "<br>". $date_time;
    }

 ?>
