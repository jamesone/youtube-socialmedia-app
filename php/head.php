<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Project - ?</title>

    <!-- CSS LINKS -->
    <link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../assets/styling/css/styles.css" >
    <link rel="stylesheet" type="text/css" href="../assets/styling/font-awesome/css/font-awesome.min.css" >
      <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->

    
    <!-- HEAD SCRIPTS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!--  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
    <script src="../assets/javascript/video.js"></script>
    <script src="../assets/javascript/jquery.functions.js"></script>


    <?php 
      include ('../dal/display/functions.php');
      require_once 'classes.php'; 
      $user_Id = "none";
      if(isset($_SESSION['logged'])){
        $user_logged = validate_key($_SESSION['logged']);

        // print_r_nice($user_logged);
        $_SESSION['id'] = $user_logged['uID'];
        $_SESSION['name'] = $user_logged['name'];
        $_SESSION['avatar'] = $user_logged['avatar'];

        $user_Id = $_SESSION['id'];
      } 

      
    ?>

   
</head>
<div class='nav-wrap'>
  <ul>
   <!-- Onclick bringup search container -->
      <a href='#' id='search-show'><li><i class="fa fa-search fa-2x"></i><br />
      Search</li></a>


      <a href='most-liked.php?vidNumber=0&cat=all&sort=1'>
        <li>
            <i class="fa fa-camera fa-2x"></i><br />
          Videos
        </li>
      </a>
      <a href='globalPlaylist.php'><li>
        <i class="fa fa-globe fa-2x"></i><br />
      Playlists</li></a>

      <a href='view-users.php'><li><i class="fa fa-users fa-2x"></i><br />
      Follow</li></a>

      <?php 
        if(isset($_SESSION['id'])){ 
          $loginout = "logout";
        }else{ 
          $loginout = "login";
        } 
      ?>
      <a href='<?php echo $loginout; ?>.php'><li>
        <i class="fa fa-login fa-2x"></i><br />
     <?php echo $loginout; ?></li></a>
      <div class='bottom-nav'>
      <li>
      <!-- Bottom section -->
      <?php
      /*
        If the user is logged in show the sidebar profile 

      */
        if($user_Id != "none"){
          $loggedIn = new user_profile($user_Id);
          $loggedIn->showUser();
                if(!($stmt->rowcount() == 0)){
                  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($rows as $key => $arrRows){
                    ?>
                      <img src='../assets/uploads/user/<?php echo $arrRows['avatar']; ?>' alt='User Profile' />
                      <a href='myprofile.php'>
                      <span class='nav-name'><?php echo $arrRows['name'];?></span>
        <?php
                    }
                  // print_r($rows);
                }
          
         

      ?>
      </a></li>
       <?php 
              $followers = $loggedIn->showAmountFollowers();
              echo "<div class='nav-followers'>".$followers."<span> followers</span></div>";
        }
        ?>
      </div>
  </ul>
</div>
 <div class='search-bar'>
      <div class='bar-head'>
           <input type='text' placeholder='Search for people, playlists...' />
      </div>
     
  </div>
<body>
<?php //ob_start(); ob_clean();?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1575010496082976";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</div>