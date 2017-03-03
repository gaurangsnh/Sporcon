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

    <title>Sporcon.com</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/index.css" rel="stylesheet">

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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top">Sporcon</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Login</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#">Write an article</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#">Search</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                	<div class="btn-group" role="group" aria-label="...">
	                    <button type="button" class="btn btn-default active">Home</button>
						<button type="button" class="btn btn-default">Cricket</button>
					 	<button type="button" class="btn btn-default">Football</button>
						<button type="button" class="btn btn-default">Hockey</button>
						<button type="button" class="btn btn-default">Tennis</button>
	                	<button type="button" class="btn btn-default">Badminton</button>
                	</div>
                </div>
            </div>
        </div>
    </header>

 
     <!-- Content Section -->
    <section class="success" id="content">
        <div class="container">
            <div class="top-filter">
            	<p>
            		<button class="but" type="button" id="newest"> Newest </button>
            	</p>
            	<p class="bar"> | </p>
            	<p>
            		<button class="but" type="button" id="trending"> Trending </button>
            	</p>
            	<p class="bar"> | </p>
            	<p>
            		<button class="but" type="button" id="followed"> Followed </button>
            	</p>
            </div>
            <div class="article-block">
	        	<div class="content" id="newestDiv" style="display: inherit;">    
		            <?php
		            $sql = "SELECT * FROM articles ORDER BY timestamp DESC";
					$result = $db->query($sql);
					if($result->num_rows){
					   	while ($row = $result->fetch_object()) {
					        $id = $row->id;	
					        $title = $row->title;
					        $keyword = $row->keyword;
					        $category = $row->category;
					        $content = $row->content;
					        $pic = $row->pic;
					        $timestamp = $row->timestamp;
			            ?>
			            <br />
			            <br />
			            <div class="article-content">
			            	<div class="left">
				            	<h3><?php echo"$title" ?></h3>
			                	<p><?php echo"$content" ?></p>
			                    <h6><time class="timeago" datetime="<?php echo"$timestamp" ?>"><?php echo"$timestamp" ?></time></h6>
		                    </div>
		                    <div class="right" style="background-image: url('<?php if (empty($pic)){?>img/defaultThumbnail-article.png<?php }else{?>uploads/<?php echo $pic;} ?>');">
		                    	
		                    </div>
			            </div> 
			            
			            <?php
						}
					}	            
		            ?>
	            </div>
	            <div class="content" id="trendingDiv">    
		            <?php
		            $sql = "SELECT * FROM articles ORDER BY timestamp ASC";
					$result = $db->query($sql);
					if($result->num_rows){
					   	while ($row = $result->fetch_object()) {
					        $id = $row->id;	
					        $title = $row->title;
					        $keyword = $row->keyword;
					        $category = $row->category;
					        $content = $row->content;
					        $pic = $row->pic;
					        $timestamp = $row->timestamp;
			            ?>
			            <br />
			            <br />
			            <div class="article-content">
			            	<div class="left">
				            	<h3><?php echo"$title" ?></h3>
			                	<p><?php echo"$content" ?></p>
			                    <h6><time class="timeago" datetime="<?php echo"$timestamp" ?>"><?php echo"$timestamp" ?></time></h6>
		                    </div>
		                    <div class="right" style="background-image: url('<?php if (empty($pic)){?>img/defaultThumbnail-article.png<?php }else{?>uploads/<?php echo $pic;} ?>');">
		                    	
		                    </div>
			            </div> 
			            
			            <?php
						}
					}	            
		            ?>
	            </div>           
            </div>
        </div>
    </section>
 
 
 

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        <p>AB Homes, Sai Baba Temple Road,
                            <br>Kundalahalli Gate, Bangalore - 560037</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About Sporcon</h3>
                        <p>Sporcon is an all sports website, wherein users can read, write, share and post comments.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Sporcon 2017
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Login Modal -->
    <div class="modal fade login" id="loginModal">
	      <div class="modal-dialog login animated">
		      <div class="modal-content">
		         <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Please enter Credentials</h4>
                </div>
                <div class="modal-body">  
                    <div class="box">
                         <div class="content">
                            
                            <div class="error" style="color:#18BC9C;background:#424242;border:0px none #424242;box-shadow:none;text-shadow:none"></div>
                            <div class="form loginBox" method="post" id="loginForm">
                                <form method="post" accept-charset="UTF-8">
                                <input class="form-control" type="text" placeholder="Username" name="username" id="username">
                                <input class="form-control" type="password" placeholder="Password" name="password" id="password">
                                <a href="javascript: showPasswordForm();" class="pwd">Forgot Password</a>
                                <p></p>
                                <input class="btn btn-default btn-login wow bounceIn animated" data-wow-duration="0.8s" data-wow-delay="0.5s" type="button" value="Login" name="submit" id="submit" onclick="loginAjax()">
                                </form>
                            </div>
                         </div>
                    </div>
                <div class="box">
                        <div class="content passwordBox" style="display:none;">
                         <div class="form">
                            <form method="post" html="{:multipart=>true}" data-remote="true" action="studentForgotPassword.php" accept-charset="UTF-8">
                            <input id="emailpwd" class="form-control" type="text" placeholder="Email" name="email">
                            <p></p>
                            <input class="btn btn-default btn-password wow bounceIn animated" data-wow-duration="0.8s" data-wow-delay="0.5s" type="submit" value="Mail password" name="commit">
                            </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    <div class="forgot password-footer" style="display:none;">
                        <span class="foot">Back to <a href="javascript: showLoginForm();" style="color:#18BC9C;">Login</a>
                        </span>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <div class="forgot login-footer">
                        <span class="foot">Don't have an account?
                             <a href="studentSignUp.php" style="color:#18BC9C;"> Sign Up</a>
                        </span>
                    </div>
                </div>   
		      </div>
	      </div>
	  </div>
	  <!-- End of Login Modal -->
    

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/index.js"></script>

</body>

</html>
