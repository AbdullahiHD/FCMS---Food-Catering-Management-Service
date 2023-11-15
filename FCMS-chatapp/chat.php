<?php
  session_start();
  include_once "php/config.php";
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
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM staff WHERE UserId = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../FCMS-Assets/images/sample-user.png" alt="">
        <div class="details">
          <span><?php echo $row['FirstName']. " " . $row['LastName'] ?></span>
          <p class="Activetext"><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
