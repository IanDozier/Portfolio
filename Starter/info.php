<?php require('header.php'); ?>
<?php if (isset($_GET['submit']) && $_GET['submit'] == "Send message") {
	if (!empty($_GET['name']))
		$name = $_GET['name'];
	else
		$missing['name'] = "Name is required";

	if (!empty($_GET['company']))
		$company = $_GET['company'];
	else
		$missing['company'] = "Company name is required";

    if (!empty($_GET['email']))
		$email = $_GET['email'];
	else
		$missing['email'] = "Email address is required";

}
?>
<form method="get" action="info.php">
    <fieldset>
        <legend>Tell me about yourself</legend>
        <p><label>Name<br>
        <input type="text" name="name" id="Name">

        <p><label>Company<br>
        <input type="text" name="company" id="Company">

        <p><label>Email<br>
        <input type="text" name="email" id="Email">
        </label></p>
    </fieldset>
    <p><input type="submit" name="send"value="Send"></p>   
</form>
<?php include('footer.php'); ?>