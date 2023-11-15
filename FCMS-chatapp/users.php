<?php 
  session_start();
  include_once "../FCMS-PHP/config.php";
  if(!isset($_SESSION['user_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
<link rel="stylesheet" href="../FCMS-CSS/chatcss.css">

<nav>
        <a href="#" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
        </a>
        <ul>
            <li><a href="../FCMS-chatapp/users.php">Chat</a></li>
            <li><a href="../FCMS-PHP/StaffDashboardFahad.php">Dashboard</a></li>
            <li><a href="../FCMS-PHP/StaffPendingRequestsFahad.php">Pending Requests</a></li>
            <li><a href="../FCMS-PHP/StaffActiveOrdersFahad.php">Active Orders</a></li>
            <li><a href="../FCMS-PHP/StaffProfilePage.php">Profile</a></li>
            <li><a href="../FCMS-PHP/Guides.php">Guides</a></li>
            
        </ul>
    </nav>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM staff WHERE UserId = {$_SESSION['user_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="../FCMS-Assets/images/sample-user.png" alt="">
          <div class="details">
            <span><?php echo $row['FirstName'] . ' '. $row['LastName']?></span>
            <p><?php echo $row['Position']; ?></p>
          </div>
        </div>
        
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
