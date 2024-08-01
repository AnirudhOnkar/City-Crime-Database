<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Signup Form</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap">
  <style>
    /* Your existing CSS styles here */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    html,
    body {
      display: grid;
      height: 100%;
      width: 100%;
      place-items: center;
      background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6);
    }

    ::selection {
      background: #1a75ff;a
      color: #fff;
    }

    .wrapper {
      overflow: hidden;
      max-width: 390px;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
    }

    .wrapper .title-text {
      display: flex;
      width: 200%;
    }

    .wrapper .title {
      width: 50%;
      font-size: 35px;
      font-weight: 600;
      text-align: center;
      transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .wrapper .slide-controls {
      position: relative;
      display: flex;
      height: 50px;
      width: 100%;
      overflow: hidden;
      margin: 30px 0 10px 0;
      justify-content: space-between;
      border: 1px solid lightgrey;
      border-radius: 15px;
    }

    .slide-controls .slide {
      height: 100%;
      width: 100%;
      color: #fff;
      font-size: 18px;
      font-weight: 500;
      text-align: center;
      line-height: 48px;
      cursor: pointer;
      z-index: 1;
      transition: all 0.6s ease;
    }

    .slide-controls label.signup {
      color: #000;
    }

    .slide-controls .slider-tab {
      position: absolute;
      height: 100%;
      width: 50%;
      left: 0;
      z-index: 0;
      border-radius: 15px;
      background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6);
      transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    input[type="radio"] {
      display: none;
    }

    #signup:checked~.slider-tab {
      left: 50%;
    }

    #signup:checked~label.signup {
      color: #fff;
      cursor: default;
      user-select: none;
    }

    #signup:checked~label.login {
      color: #000;
    }

    #login:checked~label.signup {
      color: #000;
    }

    #login:checked~label.login {
      cursor: default;
      user-select: none;
    }

    .wrapper .form-container {
      width: 100%;
      overflow: hidden;
    }

    .form-container .form-inner {
      display: flex;
      width: 200%;
    }

    .form-container .form-inner form {
      width: 50%;
      transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .form-inner form .field {
      height: 50px;
      width: 100%;
      margin-top: 20px;
    }

    .form-inner form .field input {
      height: 100%;
      width: 100%;
      outline: none;
      padding-left: 15px;
      border-radius: 15px;
      border: 1px solid lightgrey;
      border-bottom-width: 2px;
      font-size: 17px;
      transition: all 0.3s ease;
    }

    .form-inner form .field input:focus {
      border-color: #1a75ff;
    }

    .form-inner form .field input::placeholder {
      color: #999;
    }

    form .field input:focus::placeholder {
      color: #1a75ff;
    }

    .form-inner form .signup-link {
      text-align: center;
      margin-top: 30px;
    }

    .form-inner form .signup-link a {
      color: #1a75ff;
      text-decoration: none;
    }

    .form-inner form .signup-link a:hover {
      text-decoration: underline;
    }

    form .btn {
      height: 50px;
      width: 100%;
      border-radius: 15px;
      position: relative;
      overflow: hidden;
    }

    form .btn .btn-layer {
      height: 100%;
      width: 300%;
      position: absolute;
      left: -100%;
      background: -webkit-linear-gradient(right, #003366, #004080, #0059b3, #0073e6);
      border-radius: 15px;
      transition: all 0.4s ease;
    }

    form .btn:hover .btn-layer {
      left: 0;
    }

    form .btn input[type="submit"] {
      height: 100%;
      width: 100%;
      z-index: 1;
      position: relative;
      background: none;
      border: none;
      color: #fff;
      padding-left: 0;
      border-radius: 15px;
      font-size: 20px;
      font-weight: 500;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="title-text">
      <div class="title login">Login Form</div>
      <div class="title signup">Signup Form</div>
    </div>
    <div class="form-container">
      <div class="slide-controls">
        <input type="radio" name="slide" id="login" checked>
        <input type="radio" name="slide" id="signup">
        <label for="login" class="slide login">Login</label>
        <label for="signup" class="slide signup">Signup</label>
        <div class="slider-tab"></div>
      </div>
      <div class="form-inner">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login">
          <div class="field">
            <input type="text" placeholder="Email Address" name="login_email" required>
          </div>
          <div class="field">
            <input type="password" placeholder="Password" name="login_password" required>
          </div>
          <div class="field">
            <input type="text" placeholder="User ID" name="login_user_id" required>
          </div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" name="login_submit" value="Login">
          </div>
          <div class="signup-link">Not a member? <a href="">Signup now</a></div>
        </form>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="signup">
          <div class="field">
            <input type="text" placeholder="Email Address" name="signup_email" required>
          </div>
          <div class="field">
            <input type="password" placeholder="Password" name="signup_password" required>
          </div>
          <div class="field">
            <input type="text" placeholder="User ID" name="signup_user_id" required>
          </div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" name="signup_submit" value="Signup">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- About Crime button -->
<a href="about.php" target="_blank">About Crime</a>


  <script>
  const loginText = document.querySelector(".title-text .login");
  const loginForm = document.querySelector("form.login");
  const loginBtn = document.querySelector("label.login");
  const signupBtn = document.querySelector("label.signup");
  const signupLink = document.querySelector("form .signup-link a");

  // Function to handle successful login redirection to a new tab
  function redirectToProjNewTab() {
    const url = 'proj.php';
    const win = window.open(url, '_blank');
    win.focus();
  }

  signupBtn.onclick = (() => {
    loginForm.style.marginLeft = "-50%";
    loginText.style.marginLeft = "-50%";
  });

  loginBtn.onclick = (() => {
    loginForm.style.marginLeft = "0%";
    loginText.style.marginLeft = "0%";
  });

  signupLink.onclick = (() => {
    signupBtn.click();
    return false;
  });

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "mydatabase");

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Signup form handling
   // Signup form handling
if (isset($_POST['signup_submit'])) {
  $signup_email = $_POST['signup_email'];
  $signup_password = $_POST['signup_password'];
  $signup_user_id = $_POST['signup_user_id'];

  // Check if email already exists
  $check_query = "SELECT * FROM users WHERE email='$signup_email'";
  $result = $conn->query($check_query);
  if ($result->num_rows > 0) {
    echo '<script>alert("Email already exists. Please login instead.")</script>';
  } else {
    // Insert new user into database
    $insert_query = "INSERT INTO users (email, password, user_id) VALUES ('$signup_email', '$signup_password', '$signup_user_id')";
    if ($conn->query($insert_query) === TRUE) {
      echo '<script>alert("Signup successful. Please login.")</script>';
    } else {
      echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
  }
}

// Login form handling
if (isset($_POST['login_submit'])) {
  $login_email = $_POST['login_email'];
  $login_password = $_POST['login_password'];
  $login_user_id = $_POST['login_user_id'];

  // Check if email and password match
  $login_query = "SELECT * FROM users WHERE email='$login_email' AND password='$login_password' AND user_id='$login_user_id'";
  $result = $conn->query($login_query);
  if ($result->num_rows > 0) {
    echo '<script>alert("Login successful!")</script>';
    echo '<script>window.open("proj.php", "_blank")</script>';
  } else {
    echo '<script>alert("Invalid email, password, or user ID.")</script>';
  }
}


    $conn->close();
  }
  ?>
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Database connection
  $conn = new mysqli("localhost", "root", "", "mydatabase");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Signup form handling
  if (isset($_POST['signup_submit'])) {
    $signup_email = $_POST['signup_email'];
    $signup_password = $_POST['signup_password'];

    // Check if email already exists
    $check_query = "SELECT * FROM users WHERE email='$signup_email'";
    $result = $conn->query($check_query);
    if ($result->num_rows > 0) {
      echo '<script>alert("Email already exists. Please login instead.")</script>';
    } else {
      // Insert new user into database
      $insert_query = "INSERT INTO users (email, password) VALUES ('$signup_email', '$signup_password')";
      if ($conn->query($insert_query) === TRUE) {
        echo '<script>alert("Signup successful. Please login.")</script>';
      } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
      }
    }
  }

  // Login form handling
  if (isset($_POST['login_submit'])) {
    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

    // Check if email and password match
    $login_query = "SELECT * FROM users WHERE email='$login_email' AND password='$login_password'";
    $result = $conn->query($login_query);
    if ($result->num_rows > 0) {
      echo '<script>alert("Login successful!")</script>';
      echo '<script>window.open("proj.php", "_blank")</script>';
    } else {
      echo '<script>alert("Invalid email or password.")</script>';
    }
  }

  $conn->close();
}
?>

</body>

</html>
