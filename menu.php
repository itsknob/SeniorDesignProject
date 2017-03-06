<!DOCTYPE html>
<?php
session_start();
$CompanyName = "NUWC Juicing";
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<html>
	<head>
		<title>Menu Page</title>
		<link rel="stylesheet" type"text/css" href="styles.css">
	</head>
	<body>

	<!-- Tried to get the navbar to change if the user is logged in. It doesnt work though. -->
	<?php
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		include 'navbar_authorized.php';
	} else {
		include 'navbar_unauthorized.php';
	}
	?>
		<!-- Once the php code above works this can be deleted -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
		 	<div class="container-fluid">
		    	<div class="navbar-header">
		     		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span> 
		      		</button>
		    		<a class="navbar-brand" href="home.php"><?php echo $CompanyName; ?></a>
		    	</div>
		    	<div class="collapse navbar-collapse" id="myNavbar">
		      		<ul class="nav navbar-nav">
		        		<li><a href="home.php">Home</a></li>
		        		<li class="active"><a href="menu.php">Menu</a></li>
		        		<li><a href="about.php">About Us</a></li> 
		        		<li><a href="locations_contact.php">Locations & Contact Us</a></li> 
		      		</ul>
		      		<ul class="nav navbar-nav navbar-right">
		        		<li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		        		<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		        		<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
		      		</ul>
		    	</div>
		  	</div>
		</nav>
		Welcome to the Menu Page
      
 <!--  Search Bar-->
   <form  method="post" action="search.php?go"  id="searchform"> 
     <input  type="text" name="input" placeholder="Search..."> 
 	  <input  type="submit" name="submit" value="Search"> 
   </form> 
    
<!-- Live Search  -->
  <script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","get_item.php?q="+str,true);
        xmlhttp.send();
    }
}
  </script>
 
   <form>
     <select name="users" onchange="showUser(this.value)">
      <option value="">Select an item:</option>
      <option value="1">Sandra's Greens</option>
      <option value="2">Super Beetox</option>
      <option value="3">Sunshine</option>
      <option value="4">Carrot Medley</option>
      <option value="5">Papaya Splash</option>
     </select>
   </form>
<br>
<div id="txtHint"><b>Person info will be listed here...</b></div>
    
    
    
    
	</body>
</html>