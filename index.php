<?php 
  include "php/config.php";
  $new_url = "";
  if(isset($_GET)){
    foreach($_GET as $key=>$val){
      $u = mysqli_real_escape_string($conn, $key);
      $new_url = str_replace('/', '', $u);
    }
      $sql = mysqli_query($conn, "SELECT full_url FROM url WHERE shorten_url = '{$new_url}'");
      if(mysqli_num_rows($sql) > 0){
        $sql2 = mysqli_query($conn, "UPDATE url SET clicks = clicks + 1 WHERE shorten_url = '{$new_url}'");
        if($sql2){
            $full_url = mysqli_fetch_assoc($sql);
            header("Location:".$full_url['full_url']);
          }
      }
  }
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CS 355 Home Page</title>
  <link rel="stylesheet" href="style.css">

  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
</head>
<body>
   <!-- NAVBAR BEGINS HERE-->
   <nav id="navbar">
     <ul>
       <li class="dropdown">
         <a href="index.php" class="dropbtn">Home</a>
         <div class ="dropdown-content">
         </div>
       </li>
       <li class="dropdown">
         <a href="#" class="dropbtn">Course</a>
         <div class="dropdown-content">
           <a href="https://tophat.com/" target="_blank">TopHat</a>
           <a href="https://tinyurl.com/CSCI355-Summer2021" target="_blank">Course Google Drive</a>
           <a href="https://www.w3schools.com/" target="_blank">W3Schools</a>
         </div>
       </li>
       <li class="dropdown">
         <a href="#" class="dropbtn">About</a>
         <div class="dropdown-content">
           <a href="developer.html">About The Developer</a>
           <a href="contact.html">Contact</a>
         </div>
       </li>
       <li class="dropdown">
         <a href="register.html" class="dropbtn">Login/Register</a>
         <div class ="dropdown-content">
         </div>
       </li>
      </ul>
   </nav>
   <!--NAVBAR ENDS HERE-->
   <div class="centerHeader">
   <text>Hey there! Welcome to Pravesh's website</text>
   </div>



  <div class="wrapper">
    <form action="#" autocomplete="off">
      <input type="text" spellcheck="false" name="full_url" placeholder="Enter or paste a long url" required>
      <i class="url-icon uil uil-link"></i>
      <button>Shorten</button>
    </form>
    <?php
      $sql2 = mysqli_query($conn, "SELECT * FROM url ORDER BY id DESC");
      if(mysqli_num_rows($sql2) > 0){;
        ?>
          <div class="statistics">
            <?php
              $sql3 = mysqli_query($conn, "SELECT COUNT(*) FROM url");
              $res = mysqli_fetch_assoc($sql3);

              $sql4 = mysqli_query($conn, "SELECT clicks FROM url");
              $total = 0;
              while($count = mysqli_fetch_assoc($sql4)){
                $total = $count['clicks'] + $total;
              }
            ?>
            <span>Total Links: <span><?php echo end($res) ?></span> & Total Clicks: <span><?php echo $total ?></span></span>
            <a href="php/delete.php?delete=all">Clear All</a>
        </div>
        <div class="urls-area">
          <div class="title">
            <li>Shorten URL</li>
            <li>Original URL</li>
            <li>Clicks</li>
            <li>Action</li>
          </div>
          <?php
            while($row = mysqli_fetch_assoc($sql2)){
              ?>
                <div class="data">
                <li>
                  <a href="http://localhost/url/<?php echo $row['shorten_url']?>" target="_blank">
                  <?php
                    if('localhost/url/' .strlen($row['shorten_url']) > 50){
                      echo 'localhost/url/'.substr($row['shorten_url'], 0, 50);
                    }else{
                      echo 'localhost/url/'.$row['shorten_url'];
                    }
                  ?>
                  </a>
                </li> 
                <li>
                  <?php
                    if(strlen($row['full_url']) > 60){
                      echo substr($row['full_url'], 0, 60);
                    }else{
                      echo $row['full_url'];
                    }
                  ?>
                </li> 
              </li>
                <li><?php echo $row['clicks'] ?></li>
                <li><a href="php/delete.php?id=<?php echo $row['shorten_url'] ?>">Delete</a></li>
              </div>
              <?php
            }
          ?>
      </div>
        <?php
      }
    ?>
  </div>

  <div class="blur-effect"></div>
  <div class="popup-box">
  <div class="info-box">Your short link is ready. You can also edit your short link now but can't edit once you saved it.</div>
  <form action="#" autocomplete="off">
    <label>Edit your shorten url</label>
    <input type="text" spellcheck="false" value="" >
    <i class="copy-icon uil uil-copy-alt"></i>
    <button>Save</button>
  </form>
  </div>

  <script src="script.js"></script>

</body>
</html>

