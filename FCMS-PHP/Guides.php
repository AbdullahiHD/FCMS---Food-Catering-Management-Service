<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../FCMS-Assets/Main.css">
  <title>Guides</title>
  <style>
    /* Add a style for the guides-nav */
    .guides-nav {
      position: fixed;
      margin-top: 94px;
      top: 0;
      left: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 10px;
      background-color: rgb(11, 11, 10);
      color: #D6D6D6;
      font-family: Arial, sans-serif;
      width: 130px;
      height: 100vh;
    }

    .guides-nav a {
      color: goldenrod;
      margin: 15px;
      font-family: 'Franklin Gothic Medium', sans-serif;
      text-decoration: none;
      font-weight: bold;
      text-transform: capitalize;
      font-size: 17px;
    }

    .guides-nav a:hover {
      color: #FFD100;
    }

    
    .content {
      margin-left: 150px;
      margin-top: 94px; 
      padding: 20px;
    }

    #customerInteraction {
      background-color: #202020; /* Set background color */
      padding: 20px; /* Add padding for content inside the box */
      border-radius: 8px ; /* Add border radius for rounded corners */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
      border: 1px solid #FFD100;/* Add a subtle box shadow for depth */
    }

    #customerInteraction main {
      line-height: 1.6; /* Set line height for better readability */
    }

    #customerInteraction ol {
      padding-left: 20px; /* Add left padding for ordered list */
    }

    #customerInteraction ol li {
      margin-bottom: 15px; /* Add bottom margin to create space between list items */
      text-align: left; /* Align list items to the left */
    }

    #customerInteraction p {
      margin-bottom: 15px; /* Add bottom margin to create space between paragraphs */
      text-align: left; /* Align paragraphs to the left */
    }

    #trainingMaterials {
      display: none; /* Initially hide the Training Materials div */
    }

    .ordered-guideline {
      display: flex;
      flex-direction: column;
    }

  </style>
</head>
<body>

<!-- Original Navbar -->
<nav>
  <a href="#" class="logolink">
    <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
  </a>
  <ul>
    <li><a href="../FCMS-chatapp/users.php">Chat</a></li>
    <li><a href="StaffDashboardFahad.php">Dashboard</a></li>
    <li><a href="StaffPendingRequestsFahad.php">Pending Requests</a></li>
    <li><a href="StaffActiveOrdersFahad.php">Active Orders</a></li>
    <li><a href="StaffProfilePage.php">Profile</a></li>
    <li><a href="Guides.php">Guides</a></li>
  </ul>
</nav>

<!-- Guides Navigation -->
<div class="guides-nav">
  <a href="#customerInteraction" id="customerInteractionLink">Customer Interaction Guidelines</a>
  <a href="#trainingMaterials" id="trainingMaterialsLink">Training Materials</a>
</div>

<!-- Guides Content -->
<div class="content">
  <div id="customerInteraction">
    <h2>Customer Interaction Guidelines</h2>
    <main>
        <p>At Food Gourmet, we are committed to maintaining the highest level of integrity in our interactions with customers. Our Integrity Guidelines serve as a foundation for building trust and ensuring transparency. Please familiarize yourself with the following:</p>

        <ol class="ordered-guideline">
            <li><strong>Honesty and Transparency:</strong> We believe in open communication. We will provide accurate and transparent information regarding our products, services, and pricing.</li>
            
            <li><strong>Quality Assurance:</strong> We are dedicated to delivering high-quality food and drink catering services. If you ever have concerns about the quality of our offerings, please contact us immediately.</li>

            <li><strong>Privacy and Security:</strong> Your privacy is important to us. We have implemented security measures to protect your personal information.</li>

            <li><strong>Feedback and Improvement:</strong> We value your feedback. If you have suggestions or encounter issues, please let us know. Your input helps us continually improve our services.</li>

            <li><strong>Commitment to Promotions:</strong> Any promotions or discounts will be presented truthfully. We will honor the terms and conditions associated with our promotional offers.</li>
        </ol>

        <p>By engaging with Food Gourmet, you agree to adhere to these Integrity Guidelines. We appreciate your trust and look forward to serving you with the utmost integrity.</p>
    </main>
  </div>

  <div id="trainingMaterials">
    <h2>Training Materials</h2>
    <div class="youtube-video">
      <iframe width="1058" height="595" src="https://www.youtube.com/embed/v_0ka95U15g" title="FCMS Training Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
  </div>
</div>

<!-- JavaScript to handle active link indication and content visibility -->
<script>
  document.getElementById('customerInteractionLink').addEventListener('click', function() {
    document.getElementById('customerInteractionLink').style.borderBottom = '4px solid #FFDD10';
    document.getElementById('trainingMaterialsLink').style.borderBottom = 'none';
    document.getElementById('customerInteraction').style.display = 'block';
    document.getElementById('trainingMaterials').style.display = 'none';
  });

  document.getElementById('trainingMaterialsLink').addEventListener('click', function() {
    document.getElementById('trainingMaterialsLink').style.borderBottom = '4px solid #FFDD10';
    document.getElementById('customerInteractionLink').style.borderBottom = 'none';
    document.getElementById('customerInteraction').style.display = 'none';
    document.getElementById('trainingMaterials').style.display = 'block';
  });
</script>

</body>
</html>
