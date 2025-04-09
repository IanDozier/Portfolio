<?php require 'includes/header.php';?>
<?php if (isset($_POST['send']) && $_POST['send'] == "Send") {
  $error = array();

	if (!empty($_POST['name'])) {
		$name = trim($_POST['name']);
  }
	else
		$missing['name'] = "Name is required";

  if (!empty($_POST['company'])) {
    $company = trim($_POST['company']);
  }
  else{
    $missing['company'] = "Your company name is required";
  }

  if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$email = trim($_POST['email']);
  }
  else{
    $missing['email'] = "Email is NOT valid and is required";
  }


  $compare = false;

  if (!empty($_POST['password'])) {
      $password = trim($_POST['password']);
  } else {
      $missing['password'] = "Enter a password";
      $password = null;
  }

  if (!empty($_POST['re_try_password'])) {
      $repass = trim($_POST['re_try_password']);
  } else {
      $missing['re_try_password'] = "Please confirm your password";
      $repass = null;
  }

  
  if (!empty($password) && !empty($repass) && strcmp($password, $repass) != 0) {
      $missing['password'] = "Passwords didn't match";
      $missing['re_try_password'] = "Try again";
      $compare = false;
  } elseif (!empty($password) && !empty($repass)) {
      $compare = true;
  }

  if(empty($missing) && $compare){
    try{
      require_once ('../../pdo_connect.php');
      $sql = "SELECT email FROM USERS WHERE email = :email";
      $stmt = $dbc->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      $numRows = $stmt->rowCount();
      if ($numRows == 1){
        $error['exist_email'] = 'Email already exists. Proceed to Login at the top.';
      }else{
      $sql = "INSERT INTO USERS (name, company, email, pw) VALUES (?, ?, ?, ?)";
      $stmt = $dbc->prepare($sql);
      $password_hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt->bindParam(1, $name);
      $stmt->bindParam(2, $company);
      $stmt->bindParam(3, $email);
      $stmt->bindParam(4, $password_hash);
      $stmt->execute();
      $_SESSION['name'] = $name;
      $_SESSION['company'] = $company;
      $_SESSION['email'] = $email;
  
      header("Location: index.php");
      exit;
    }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
  }

}
?>
<form method="post" action="info.php">
    <fieldset>
        <legend>Tell me about yourself and register to stay updated</legend>

        <?php if (isset($error['exist_email'])) echo '<p class = "warning">' .$error['exist_email']. '</p>'; ?>
        <p><label>Name<br>
        <?php if(isset($missing['name'])) echo '<p class = "warning">' .$missing['name']. '</p>';?>
        <input type="text" name="name" id="Name"
        <?php if(isset($name)) echo 'value = "'. htmlspecialchars($name). '"';?>>
        </label></p>

        <p><label>Company or occupation<br>
        <?php if(isset($missing['company'])) echo '<p class = "warning">' .$missing['company']. '</p>';?>
        <input type="text" name="company" id="Company"
        <?php if(isset($company)) echo 'value = "'. htmlspecialchars($company). '"';?>>
        </label></p>

        <p><label>Email<br>
        <?php if(isset($missing['email'])) echo '<p class = "warning">' .$missing['email']. '</p>';?>
        <input type="text" name="email" id="Email"
        <?php if(isset($email)) echo 'value = "'. htmlspecialchars($email). '"';?>>
        </label></p>

        <p><label>Password<br>
        <?php if(isset($missing['password'])) echo '<p class = "warning">' .$missing['password']. '</p>';?>
        <input type="password" name="password" id="Password">
        </label></p>

        <p><label>Re-try Password<br>
        <?php if(isset($missing['re_try_password'])) echo '<p class = "warning">' .$missing['re_try_password']. '</p>';?>
        <input type="password" name="re_try_password" id="PasswordRedo">
        </label></p>

    </fieldset>
    <p><input type="submit" name="send" value="Send"></p>   
</form>
<?php include('includes/footer.php'); ?>