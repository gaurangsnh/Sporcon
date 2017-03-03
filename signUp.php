<?php
	#Start session
	session_start();
	#Database Connection
	include('config/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SportsNukkad.com</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Jasny Bootstrap CSS -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

    <!-- Theme CSS -->
    <link href="css/signUp.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">



</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <a class="navbar-brand" href="index.php">SportsNukkad</a>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>







<div class="signup">
  <div class="container">
	  <h2 class="signup-header">Sign Up</h2>
	  <form class="signup-container" method="POST" enctype="multipart/form-data">
	    <p><input type="text" placeholder="Name" name="name" id="name" required="required" autofocus="autofocus"></p>
	    <p><input type="text" placeholder="Phone" name="phone" id="phone" required="required"></p>
	    <p><input type="email" placeholder="Email" name="email" id="email" required="required"></p>
	    <p><input type="text" placeholder="Username" name="username" id="username" required="required"></p>
	    <p><input type="password" placeholder="Password" name="password" id="password" required="required"></p>
	    <p><input type="password" placeholder="Confirm Password" name="cPassword" id="cPassword" required="required" onchange="check()"></p><span id='message'></span>
	    <p>
	    	<div class="fileinput fileinput-new" data-provides="fileinput">
			  <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
			  <div>
			    <span class="btn btn-default btn-file" style="color:#E9E9E9;background:#3299BB;border:0px none #424242;box-shadow:none;text-shadow:none;font-size: 18px;"><span class="fileinput-new">Upload Pic</span><span class="fileinput-exists">Change</span><input type="file" name="pic" id="pic"></span>
			    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			  </div>
			</div>
	    </p>
	    <p><input type="submit" name="register" value="Register"></p>
	  </form>

	  <?php
	  if(isset($_REQUEST["register"])) {

		$name = $_POST["name"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		$username = $_POST["username"];
		$password = md5($_POST["password"]);
		$pic;
		$hash = md5(rand(0,1000));

	    if (file_exists($_FILES['pic']['tmp_name']) || is_uploaded_file($_FILES['pic']['tmp_name'])) {
	        $file   = $_FILES['pic'];
	        // print_r($file);  just checking File properties

	        // File Properties
	        $file_name  = $file['name'];
	        $file_tmp   = $file['tmp_name'];
	        $file_size  = $file['size'];
	        $file_error = $file['error'];

	        // Working With File Extension
	        $file_ext   = explode('.', $file_name);
	        $file_fname = explode('.', $file_name);

	        $file_fname = strtolower(current($file_fname));
	        $file_ext   = strtolower(end($file_ext));
	        $allowed    = array('jpeg','jpg','png','bmp');

	        if (in_array($file_ext,$allowed)) {
	            //print_r($_FILES);

	            if ($file_error === 0) {
	                if ($file_size <= 2000000) {
	                        $file_name_new     =  $file_fname . uniqid('',true) . '.' . $file_ext;
	                        $file_name_new    =  uniqid('',true) . '.' . $file_ext;
	                        $file_destination =  'uploads/' . $file_name_new;
							$pic = $file_name_new;
	                        // echo $file_destination;
	                        if (move_uploaded_file($file_tmp, $file_destination)) {
			                }
							else
							{
							    echo '<script language="javascript">';
								echo 'alert("Some error occured in uploading file. Please try again.")';
								echo '</script>';
								die();
							}
					}
	                else
	                {
	                	echo '<script language="javascript">';
						echo 'alert("Please upload an image less than 2MB.")';
						echo '</script>';
						die();
	                }
	            }
	        }
	        else
	        {
	        	echo '<script language="javascript">';
				echo 'alert("Invalid file. Please upload a valid Image.")';
				echo '</script>';
				die();
		     }
		}else {}

		$stmt = $dbc->prepare("INSERT INTO user
		(name, email, phone, username, password, pic, hash)
		VALUES (?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssss",$name, $email, $phone, $username, $password, $pic, $hash);
		if ($stmt->execute()) {

			$to      = $email; // Send email to our user
			$subject = 'SportsNukkad | Thanks for registering with us'; // Give the email a subject
			$message = '

			Thank you for signing up!
			Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

			------------------------
			Username: '.$username.'
			Password: '.$_POST["password"].'
			------------------------

			Please click this link to activate your account:
			http://localhost/Manish/sporcon/verify.php?username='.$username.'&hash='.$hash.'

			'; // Our message above including the link

			$headers = 'From:noreply@sportsnukkad.com' . "\r\n"; // Set from headers
			mail($to, $subject, $message, $headers); // Send our email

			echo "<script>window.location = 'http://localhost/Manish/sporcon/thanks.php'</script>";
			die();

		}else {
			echo '<script language="javascript">';
			echo 'alert("Some error occured in uploading file. Please try again.")';
			echo '</script>';
			die();
		}
		}
		?>
	</div>
</div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

	<!-- Jasny Bootstrap JavaScript -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/signUp.js"></script>


</body>
</html>
