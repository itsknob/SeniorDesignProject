<!DOCTYPE html>
<?php
	session_start();
	$CompanyName = "NUWC Juicing";
//~~~ Begin Menu Formatting ~~~//
	//Debugging
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	//Used to set session information
	include "scripts.php";
	//Variables
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "juicing";
  
    $db = new PDO('mysql:host=localhost;dbname=juicing;charset=utf8', 'root', '');
    $itemList = $db->prepare('SELECT * FROM items');
    $itemList->execute();
    $itemList = $itemList->fetchAll(PDO::FETCH_ASSOC);
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
		<link rel="stylesheet" type="text/css" href="styles.css">
		<link rel="javascript" type="text/javascript" href="scripts/scripts.js">
		
    <style>
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}
.dropbtn:hover, .dropbtn:focus {
    background-color: #3e8e41;
}
#myInput {
    border-box: box-sizing;
    background-image: url('searchicon.png');
    background-position: 14px 12px;
    background-repeat: no-repeat;
    font-size: 16px;
    padding: 14px 20px 12px 45px;
    border: none;
}
.dropdown {
    float: right;
    position: relative;
    display: inline-block;
}
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f6f6f6;
    min-width: 230px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    right: 0;
    z-index: 1;
}
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}
.dropdown a:hover {background-color: #ddd}
.show {display:block;}
</style>

	</head>
	<body>
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
		        		<li class = "active"><a href="menu.php">Menu</a></li>
		        		<li><a href="about.php">About Us</a></li> 
		        		<li><a href="locations_contact.php">Locations & Contact Us</a></li> 
		      		</ul>		
					<?php
						if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
							echo "
								<ul class='nav navbar-nav navbar-right'>
						       		<li><a href='my_account.php'><span class='glyphicon glyphicon-user'></span> My Account</a></li>
						       		<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li>
						       		<li><a href='logout.php'><span class glyphicon-shopping-logout'></span> Logout</a><li>
						   		</ul>
						   		"; // End of Navbar - Logged In 
						} else {
							echo "
								<ul class='nav navbar-nav navbar-right'>
									<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
									<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li>
								</ul>
								"; // End of Navbar - Logged Out
						} 
					?>
		    	</div>
		  	</div>
		</nav>
		<div id="menu-content" align="center">
			<h2>Welcome to the Menu Page</h2>
		
		<div class="main">
      
      <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon">Search</span>
        <input type="text" name="search_text" id="search_text"  placeholder="Search by Drink Details" class="form-control" />
        </div>
      </div>
      
      <br />
      <div id="result"></div>     
      <br />
      
		<!--      Checkboxes-->
		  <div class="checkboxes">
			  <!--    Calories-->
			<div class="calories-filter">
			<p><strong>Filter by Calories</strong></p>
			
			<form>
			  <label class="filterlabels"><input type="checkbox" id="box1" class="calories" value="300">Less than 300</label><br>
			  <label class="filterlabels"><input type="checkbox" class="calories" value="500">Less than 500</label><br>    
			</form>
			</div>
			
			  <!--    Sugar-->
		  <div class="sugar-filter">
			<p><strong>Filter by Sugar (g)</strong></p>
			
			<form>
			  <label class="filterlabels"><input type="checkbox" class="sugars" value="5">Less  than 5</label><br>
			  <label class="filterlabels"><input type="checkbox" class="sugars" value="10">Less than 10</label><br>    
			</form>
		  </div>    
		<!--      Prices-->
		  <div class="price-filter">
			<p><strong>Filter by Price</strong></p>
			
			<form>
			  <label class="filterlabels"><input type="checkbox" class="price" value="5">Less  than $5</label><br>
			  <label class="filterlabels"><input type="checkbox" class="price" value="10">Less than $10</label><br>    
			</form>
			</div>
		</div>  
	  
		<div id="menu-item-container">
		</div>
		</div>   
    
    <script>
      $(document).ready(function(){

      load_data();

      function load_data(query)
    {  
      $.ajax({
      url:"fetch.php",
      method:"POST",
      data:{query:query},
      dataType: 'json',
      success:function(data){
        console.log(data);
        $('#result').html(data);
        }
      });
    }
      $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != ''){
          load_data(search);
        }
        else
        {
          load_data();
        }
      });
    });
    </script>  
      
      
      
	<script src="scripts/scripts.js"> </script>  
    <script>
		var newItemList = [];
		var allItemsArray = <?php echo json_encode($itemList); ?>;
		
			for(var i = 0; i < allItemsArray.length; i++){
				var tempItem = new ItemJS();
				var object = allItemsArray[i];
				tempItem.name = object.itemName;
				tempItem.picture = object.picLink;
				tempItem.description = object.description;
				tempItem.cost = object.price;
			
				//Save to Array at index [i]
				newItemList[i] = tempItem;
			}
			console.log(allItemsArray);
			
			newItemList.forEach(function (d){
				var itemCardDiv = document.createElement('div');
				itemCardDiv.setAttribute("class", "itemcard");
				document.getElementById('menu-item-container').appendChild(itemCardDiv);
				
				var itemName = document.createElement('div');
				itemName.setAttribute("class", "itemname");
				var itemCard = document.getElementsByClassName //ERROR
			});
			
			//JQuery to implement additional divs to each item card
			$(document).ready(function(){
				$(".itemcard").append("<div class='itemname'></div>").append("<div class='itemstripe'></div>").append("<div class='itemimage'></div>").append("<div class='itemdescription'></div>").append("<div class='itemnutritionbutton'></div>");
			});
			
			allItemsArray.forEach(function (d){
				var name = document.get
			});
			
			</script>

    <script>             
    //If checkbox is checked send a request to run a query on the database FROM items WHERE .class '<' this.value then echo the results
      $(":checkbox").on("change",function() {
    
        $('input').not(this).prop('checked', false); 
        //If no checkboxes are checked display all menu items
    if($("input:checked" ).length == 0){
      
      var newItemList = [];
				var allItemsArray = <?php echo json_encode($itemList); ?>;
				//console.log("AllItemArray: " + allItemsArray);
				//Convert PHP Items to Javascript Items
				for(var i = 0; i < allItemsArray.length; i++){
					var tempItem = new ItemJS();
					var object = allItemsArray[i];
					//console.log(object);
					tempItem.name = object.itemName;
					tempItem.picture = object.picLink;
					tempItem.description = object.description;
					tempItem.cost = object.price;
				
					//Save to Array at index [i]
					newItemList[i] = tempItem;
				}
		
				//Call function to format data
      container = (createTableFormattedListOfItems(newItemList)); 
      $('#menu-item-container').empty().append(container);
    }  
      
      //runs code in reference to selected checkbox  
      if (this.checked) {
        let boxClass = $(this).attr('class');
        let boxValue = $(this).attr('value');
        //let caloriesValue = $(this).attr('value');
        console.log(boxClass);
        $.ajax({
          type: 'POST',
          url: 'showItems.php',
          data: { class: boxClass, value: boxValue },
          dataType: 'json',
         error: function(xhr,textStatus,err)
          {
            console.log("readyState: " + xhr.readyState);
            console.log("responseText: "+ xhr.responseText);
            console.log("status: " + xhr.status);
            console.log("text status: " + textStatus);
            console.log("error: " + err);
          },
          success: function(result) {
            console.log("hello world");
            console.log(result);
            //console.log(JSON.parse(result));
          // here is the code that will run on client side after running showItems.php on server
                  
                  
        var newItemList = [];
				//var allItemsArray = filteredList;
				//console.log("AllItemArray: " + allItemsArray);
				//Convert PHP Items to Javascript Items
				for(var i = 0; i < result.length; i++){
					var tempItem = new ItemJS();
					var object = result[i];
					//console.log(object);
					tempItem.name = object.itemName;
					tempItem.picture = object.picLink;
					tempItem.description = object.description;
					tempItem.cost = object.price;
				
					//Save to Array at index [i]
					newItemList[i] = tempItem;
				}
		    
				//Call function to format data
        container = (createTableFormattedListOfItems(newItemList));    
            
		//document.getElementById('menu-item-container').appendChild(container);	//Was itemArray
        
         $('#menu-item-container').empty().append(container);
    
        // function below reloads current page
        //location.reload();
              }
          });
      }        
  });     
    </script>  
      
		</div>
	</body>
</html>