<!DOCTYPE html>
<?php
	$companyName = "NUWC Juicing";

	session_start(); 

	error_reporting(0);
	if ($_SESSION['loggedin'] == false) {
	    http_response_code(404);
	    echo 'Oops! You need to log into an account to access this page.';
	    die();
	}
	error_reporting(-1);
	
	include "scripts.php";

	//Variables
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "user_information";

	//Connect and Select	
	$con = makeConnection($dbhost, $dbuser, $dbpass, $dbname);
	//Setup search for DB
	$query = "SELECT * from login_information";
	//Fetch from DB
	$result = mysqli_query($con, $query);
	//Hold Users from Database
	$userNameList = array();
	
	//Convert Data
	while($row = $result->fetch_assoc()){
		$userNameList[$row['user_id']] = (string)$row['user_name'];// => (string)$row['userName'];
	}

	//Debugging
	//var_dump($userNameList);

?>

<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<title>My Account</title>

		<link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span> 
					</button>
					<a class="navbar-brand" href="home.php"><?php echo $companyName ?></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="home.php">Home</a></li>
						<li><a href="menu.php">Menu</a></li>
						<li><a href="about.php">About Us</a></li> 
						<li><a href="locations_contact.php">Locations & Contact Us</a></li> 
					</ul>		
					<?php
						if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
							echo "
								<ul class='nav navbar-nav navbar-right'>
							   		<li class = 'active'><a href='my_account.php'><span class='glyphicon glyphicon-user'></span> My Account</a></li>
						    <!--   	<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li> -->
							   		<li><a href='logout.php'><span class glyphicon-shopping-logout'></span> Logout</a><li>
						   		</ul>
						   		"; // End of Navbar - Logged In 
						} else {
							echo "
								<ul class='nav navbar-nav navbar-right'>
									<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
						    <!--   	<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li> -->
								</ul>
								"; // End of Navbar - Logged Out
						} 
					?>

				</div>
			</div>
		</div>

		<h2>My Account</h2>
		
		<div class="main">
			<table style="font-size: 24px; margin-left: 3vw;">
				<tr>
					<td>
						Your Username: <?php echo $_SESSION['user_name']; ?>
					</td>
				</tr>
				<tr>
					<td>
						Your Email: <?php echo $_SESSION['user_email']; ?>
					</td>
				</tr>
			</table>
			<br>
      <br>
			<br>
			<?php 
	            if($_SESSION['isEmployee'] == true) {
	                echo '<a href="orders.php"><h4>Click Here to look at recent orders</h4></a>';
	            }
	            if($_SESSION['isAdmin'] == true){
	                echo "
	                    <a href='admin_tools.php'><h4>Click Here to Edit the Website</h4></a><br>
	                    <h4> Edit Employee's Status </h4>

	                    <!-- Edit Employee -->
						
						";
          
          echo "<form id='search-text-group' class='form-group'>
		        <div class='input-group'>
			        <input type='text' name='search_text' id='search_text'  placeholder='Search Employee' class='form-control' />
		        </div>
		    </form>";
				} 
			?>
			
<?php
				//echo var_dump($_GET);
				//echo var_dump($_POST);
				//If employee was updated
				if(isset($_GET['updated'])){
					echo "<b>Updated Employee</b><br>";
				}
				//If employee information is being changed.
				if(isset($_POST['updateButton']) && isset($_GET['go'])){
				}
				
			?>
    <div id="results"></div>
		</div>
    
    <script>
    
    function generateEmployeeData(employees){
      
      employees.forEach(function(d){
        
        
        var containerDiv = document.createElement('div');
        var informationDiv = document.createElement('div')
        
        var ul = document.createElement('ul');
        var br = document.createElement('br');
        var br2 = document.createElement('br');
        
        //form
        var form = document.createElement('form');
        form.setAttribute("action","editEmployee.php");
        form.setAttribute("method","POST");
        
        //labels
        var yesLabel = document.createElement('label');
        var noLabel = document.createElement('label');
        yesLabel.setAttribute("for","YesEmployed");
        noLabel.setAttribute("for","NotEmployed");
        
        //Radio buttons
        //buttons need to have the same name so only one is selected 
        var yesButton = document.createElement('input');
        var noButton = document.createElement('input');
        yesButton.setAttribute("type","radio");
        yesButton.setAttribute("name","Employee");
        yesButton.setAttribute("id","YesEmployed");
        
        noButton.setAttribute("type","radio");
        noButton.setAttribute("name","Employee");
        noButton.setAttribute("id","NotEmployed");
        
        if(d.isEmployee == 1){
          yesButton.setAttribute("checked","checked");
        }

        else{
          noButton.setAttribute("checked","checked");
        }
        
        //submit button
        var submit = document.createElement('input');
        submit.setAttribute("type","submit");
        submit.setAttribute("name","updateButton");
        submit.setAttribute("name","updateButton");
        submit.setAttribute("value","Update User");
        
       
        containerDiv.setAttribute("id","employeeContainer");
//        containerDiv.setAttribute("class","employeeContainer");
        informationDiv.setAttribute("id","employeeInformation");
//        informationDiv.setAttribute("class","employeeInformation");
        
        document.getElementById('results').appendChild(containerDiv)
        document.getElementById('employeeContainer').appendChild(informationDiv)
        document.getElementById('employeeInformation').appendChild(ul)

        
        
        
        var li = document.createElement('li');
        li.innerHTML = "Username: "
        
        var li2 = document.createElement('li');
        li2.innerHTML = "User ID: ";
        
        var li3 = document.createElement('li');
        li3.innerHTML = "User Email: "

				//generating the header for item card
				var employeeHeaderDiv = document.createElement("div");
				employeeHeaderDiv.setAttribute("class", "employeeHeader");
				//generating the name div for the header 
				var employeeNameDiv = document.createElement("div");
				employeeNameDiv.setAttribute("class", "employeeName");
				var employeeNameTextNode = document.createTextNode(d.user_name);
        var employeeEmail = document.createTextNode(d.user_email);

        
        ul.appendChild(li);
        ul.appendChild(li2);
        ul.appendChild(li3);
        li.innerHTML = li.innerHTML+ d.user_name;
        li2.innerHTML = li2.innerHTML+ d.user_id;
        li3.innerHTML = li3.innerHTML+ d.user_email;
        
        ul.appendChild(form);
        
        form.appendChild(noLabel);
        noLabel.innerHTML = "Not Employee"; 
        form.appendChild(noButton);
        form.appendChild(br);
        
        form.appendChild(yesLabel);
        yesLabel.innerHTML = "Employee";
        form.appendChild(yesButton);
        form.appendChild(br2)
        
        form.appendChild(submit);
                      
      });
        
     
    }
      function removeEmployeeData(){
        $("div#employeeContainer").remove();
      }
      
    		//Search bar functionality
		$(document).ready(function() {
			load_data();
			function load_data(query) {  
				$.ajax({
					url:"fetchUsers.php",
					method:"POST",
					data:{query:query},
					dataType: 'json',
					success:function(data) {
          
            console.log(data.length);
        //Ensures the returned array isn't longer than 50
        //Trims array to 50 if over to prevent displaying too many items
        if(data.length > 50);
            data.slice(0,49); 
            
          removeEmployeeData();  
          generateEmployeeData(data);
            
          
          console.log(data);
          
          
					}
				});
			}
    
			$('#search_text').keyup(function() {
				var search = $(this).val();
				if(search != '') {
					load_data(search);
				} else {
					load_data();
          //If search bar is empty remove all users from div
          if(search.length==0){
            removeEmployeeData();
          }
				}
			});
		});     
    
    
    </script>
    
	</body>  
</html>


