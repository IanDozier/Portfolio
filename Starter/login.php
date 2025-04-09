<?php require 'includes/header.php'; ?>
<?php
    if (isset($_POST['login']) && $_POST['login'] == "Login"){
        $errors = array();
        if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $email = trim($_POST['email']);
        }
        else
            $errors['email'] = 'Email is required and MUST be valid';

        if (!empty($_POST['password'])){
            $password = trim($_POST['password']);
        }
        else
            $errors['password'] = 'Password is required';

        while(!$errors){

            try{
                require_once '../../pdo_connect.php';
                $sql = "SELECT * FROM USERS WHERE email = :email";
                $stmt = $dbc->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $numRows = $stmt->rowCount();
                if ($numRows==0) 
				$errors['no_email'] = "That email address wasn't found";
                else { // email found, validate password
                    $result = $stmt->fetch(); //convert the result object pointer to an associative array 
                    $pw_hash=$result['pw'];
                    if (password_verify($password, $pw_hash)) { //passwords match
                        $name = $result['name'];
                        session_start();
                        $_SESSION['name'] = $name;
                        $_SESSION['email'] = $email;
                        header('Location: index.php');
                        exit;
                    }
                    else {
                        $errors['wrong_pw'] = "That isn't the correct password";
                    }
                } 
            }catch (PDOException $e){
                echo $e->getMessage();	
            }
            
        }

    }
?>

<form method = "post" action = "login.php">
    <fieldset><legend>Login</legend>
        <?php if ($errors) echo "<h2 class=\"warning\">Please fix the item(s) indicated.</h2>";
              if ($errors['email']) echo "<p class=\"warning\">{$errors['email']}</p>"; 
              if ($errors['no_email']) echo "<p class=\"warning\">{$errors['no_email']}</p>"; 
        ?>
        <p><label for = "email">Email<br>
        <input type = "text" name = "email" id = "email" 
        value = <?php if (isset($email) &&!$errors['no_email']) { echo htmlspecialchars($email); } ?>>
        </label></p>

        <?php if ($errors['pw']) echo "<p class=\"warning\">{$errors['password']}</p>";    
			  if ($errors['wrong_pw']) echo "<p class=\"warning\">{$errors['wrong_pw']}</p>"; 
		?>
        <p><label for="password">Password<br>
        <input type = "password" name = "password" id = "password">
        </label></p>

        
    </fieldset>
    <p><input type = "submit" name = "login" value = "Login"></p>
</form>
<?php include 'includes/footer.php'; ?>