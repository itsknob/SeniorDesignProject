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
 
<!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- D3 library for method chaining in SVG generation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.5.0/d3.js"></script>

<!-- Our scripts folder -->
<script src="scripts/scripts.js"></script> 

<html>
	<head>
		<title>Menu Page</title>
		<link rel="stylesheet" type="text/css" href="menustylesheet.css">
		<link rel="javascript" type="text/javascript" href="scripts/scripts.js">
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
			<div id="imgmodal" class="modal">
				<span class="close">&times;</span>
				<img id="image-content" class="imagemodal-content">
			</div>
			<div id="svgmodal" class="modal">
				<span class="close">&times;</span>
			</div>

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

			<!--      Filtering 	-->
			<div id="filterdi" class="filterdiv">
				<button onclick="showFiltersDropdown()" class="hamburger hamburger--elastic" type="button">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
				<div class="filtertext">Filter Search</div>
			</div>
			<div id="filtersdrop" class="filtersdropdown">
				<ul>
					<li onclick="calHighLow()">Calories High to Low</li>
					<li onclick="calLowHigh()">Calories Low to High</li>
					<li onclick="sugHighLow()">Sugars High to Low</li>
					<li onclick="sugLowHigh()">Sugars Low to High</li>
					<li onclick="protHighLow()">Protein High to Low</li>
					<li onclick="protLowHigh()">Protein Low to High</li>
				</ul>
			</div>

			<!-- Where we append our item cards -->
			<div id="menu-item-container">
			</div>
		</div>
	 
   
 
	 
	 
	<script>
		var allItemsArray = <?php echo json_encode($itemList); ?>;

		//create item cards for each item
		allItemsArray.forEach(function (d){
			var itemCardDiv = document.createElement('div');
			var className = "itemcard" + d.itemID;
			itemCardDiv.setAttribute("id", className);
			itemCardDiv.setAttribute("class", "itemcard");
			document.getElementById('menu-item-container').appendChild(itemCardDiv);
		});

		function generateItemCards(itemArray){

			itemArray.forEach(function (d){
				//selecting the current item card
				var currentTargetDivId = "itemcard" + d.itemID;
				var targetDiv = document.getElementById(currentTargetDivId);

				//generating the header for item card
				var itemHeaderDiv = document.createElement("div");
				itemHeaderDiv.setAttribute("class", "itemheader");
				//generating the name div for the header 
				var itemNameDiv = document.createElement("div");
				itemNameDiv.setAttribute("class", "itemname");
				var itemNameTextNode = document.createTextNode(d.itemName);
				//prevent issues with display if the name for an item is too long
				if(itemNameTextNode.length > 15){
					itemNameTextNode = document.createTextNode(d.itemName.slice(0,13) + "...");
				}
				itemNameDiv.appendChild(itemNameTextNode);
				//generating the price div for the header
				var itemPriceDiv = document.createElement("div");
				itemPriceDiv.setAttribute("class", "itemprice");
				//fixing the values to be 2 decimals no matter what
				var fixedValue = parseFloat(d.price).toFixed([2]);
				var itemPriceTextNode = document.createTextNode("$" + fixedValue);
				itemPriceDiv.appendChild(itemPriceTextNode);
				//adding the name and price to the header
				itemHeaderDiv.appendChild(itemNameDiv);
				itemHeaderDiv.appendChild(itemPriceDiv);

				//generating the image for the item card
				var itemImageDiv = document.createElement("div");
				itemImageDiv.setAttribute("class", "itemimage");
				var itemImage = document.createElement("img");
				itemImage.setAttribute("id", "img" + d.itemID);
				itemImage.setAttribute("class", "image");
				itemImage.setAttribute("src", "images/" + d.picLink);
				itemImage.setAttribute("alt", d.itemName + " image.");
				itemImageDiv.appendChild(itemImage);

				//generating the description for item card
				var itemDescriptionDiv = document.createElement("div");
				itemDescriptionDiv.setAttribute("class", "itemdescription");
				var itemDescriptionTextNode = document.createTextNode(d.description);
				itemDescriptionDiv.appendChild(itemDescriptionTextNode);

				//generating the buttons for item card
				var itemButtonsDiv = document.createElement("div");
				itemButtonsDiv.setAttribute("class", "itembuttons");
				//generating the div for add to cart button
				var itemAddToCartDiv = document.createElement("div");
				itemAddToCartDiv.setAttribute("class", "itemaddtocartbutton");
				var itemAddToCartButton = document.createElement("button");
				itemAddToCartButton.setAttribute("class", "cartbutton");
				itemAddToCartDiv.appendChild(itemAddToCartButton);
				//generating the nutrition div
				var itemNutritionInfoDiv = document.createElement("div");
				itemNutritionInfoDiv.setAttribute("class", "itemnutritionbutton");
				var itemNutritionButton = document.createElement("button");
				itemNutritionButton.setAttribute("class", "nutritionbutton");
				itemNutritionButton.setAttribute("id", d.itemID);
				itemNutritionInfoDiv.appendChild(itemNutritionButton);
				//adding the buttons to the button div
				itemButtonsDiv.appendChild(itemAddToCartDiv);
				itemButtonsDiv.appendChild(itemNutritionInfoDiv);

				//append all divs to target card
				targetDiv.appendChild(itemHeaderDiv);
				targetDiv.appendChild(itemImageDiv);
				targetDiv.appendChild(itemDescriptionDiv);
				targetDiv.appendChild(itemButtonsDiv);
			});
		}



		//ensure item array isn't longer than 20. 
		//if longer than 20 items, trim it to 20 only to avoid displaying too many items.
		if(allItemsArray.length < 21){
			generateItemCards(allItemsArray);
		}else{
			generateItemCards(allItemsArray.slice(0, 20));
		}

		//Handling the modal for image clicks "imgmodal" in DOM
		$(document).ready(function() {
			//image modal document variables
			var imagemodal = document.getElementById('imgmodal');
			var modalImg = document.getElementById('image-content');
			//nutrition modal document variables
			var svgmodal = document.getElementById('svgmodal');

			//When an image is clicked, display that image in the image modal
			$('.image').click(function() {
				modalImg.setAttribute("src", this.src);
				imagemodal.style.display = "block";
			});

			//When a nutrition information button is clicked, loop through allItemsArray for the id 
			//use that item's information in allItemsArray to generate the SVG 
			$('.nutritionbutton').click(function() {
				var currentID = this.id;
				allItemsArray.forEach(function(d) {
					if(currentID == d.itemID){
						generateSVG(d);
						//change liveSVG using function
						svgmodal.style.display = "block";
					}
				});
			});

			$('.close').click(function(){
				//remove and clear image modal
				imagemodal.style.display = "none";
				modalImg.removeAttribute("src");
				//remove and clear svg modal
				if(svgmodal.getAttribute("style") == "display: block;"){
					svgmodal.style.display = "none";
					document.getElementById('svg-content').remove();
				}
			})

		});

   /*********************************************************************************************************
	*	When filters are used, we want to select elements by class name and remove all "itemcard"			*
	*	After, we can call the generate item cards function using the new array from SQL statements 		*
	*	based on each filter used.  																		*
	*	We also want to --- document.getElementById("filtersdrop").classList.toggle("show");				*
	*********************************************************************************************************/
		function showFiltersDropdown(){
			document.getElementById("filtersdrop").classList.toggle("show");
			document.getElementById("filterdi").classList.toggle("dropdownmarginremover");
		}

		function removeItemCards (){
			$("div.itemcard").remove();
			$("#filterdi").toggleClass("dropdownmarginremover");
			$("#filtersdrop").toggleClass("show");
    		$(".hamburger").toggleClass("is-active");
		}

		//Filter function calls to generate cards
		function calHighLow(){
			removeItemCards();
			//Run SQL statement to obtain all items with a value for calories
			//Sort the returned array by highest calories to lowest calories using sort algorithm.
			//call the generate item cards function with the array
		}

		function calLowHigh(){
			removeItemCards();
			
		}

		function sugHighLow(){
			removeItemCards();
			
		}

		function sugLowHigh(){
			removeItemCards();
			
		}

		function protHighLow(){
			removeItemCards();
			
		}

		function protLowHigh(){
			removeItemCards();
			
		}

		var $hamburger = $(".hamburger");
  			$hamburger.on("click", function(e) {
    		$hamburger.toggleClass("is-active");
  		});


		function generateSVG(currentItem){
			var margin = {top: 30, right: 10, bottom: 15, left: 10};
		    var width = 260;
		    var height = 175;
			
		    var svg = d3.select("#svgmodal")
		                .append("svg")
		                .attr("id", "svg-content")
		                .attr("class", "svgmodal-content")
		                .attr("width", width + margin.left + margin.right)
		                .attr("height", height + margin.top + margin.bottom)
		                .append("g")
		                .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
						
			svg.append("text")
		        .attr("x", 0)
		        .attr("y", 5)
		        .attr("font-family", "Franklin Gothic Medium")
				.attr("font-size", 35)
		        .text("Nutrition Facts");
				
			svg.append("line")
				.attr("x1", 0)
				.attr("y1", 20)
				.attr("x2", 260)
				.attr("y2", 20)
				.attr("style", "stroke:black;stroke-width:15");
				
			svg.append("text")
		        .attr("x", 0)
		        .attr("y", 43)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:900")
		        .text("Calories");	
			
			svg.append("text")
		        .attr("x", 52)
		        .attr("y", 43)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:500")
		        .text(currentItem.calories);
				
			svg.append("line")
		        .attr("x1", 0)
				.attr("y1", 50)
				.attr("x2", 260)
				.attr("y2", 50)
				.attr("style", "stroke:black;stroke-width:4");
				
			svg.append("text")
		        .attr("x", 175)
		        .attr("y", 65)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:900")
		        .text("% Daily Value");
			
			
			svg.append("line")
		        .attr("x1", 0)
				.attr("y1", 70)
				.attr("x2", 260)
				.attr("y2", 70)
				.attr("style", "stroke:black;stroke-width:1");
				
			svg.append("text")
		        .attr("x", 0)
		        .attr("y", 85)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:900")
		        .text("Cholesterol");

			svg.append("text")
		        .attr("x", 68)
		        .attr("y", 85)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:500")
		        .text(currentItem.choles + "mg");
				
			svg.append("text")
				.attr("x", 235)
				.attr("y", 85)
				.attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:900")
				//Calculate Cholesterol Daily Based on variable (300mg day)
		        .text(Math.round(((currentItem.choles / 300) * 100)) + "%");	
			
			
			svg.append("line")
		        .attr("x1", 0)
				.attr("y1", 90)
				.attr("x2", 260)
				.attr("y2", 90)
				.attr("style", "stroke:black;stroke-width:1");
				
			svg.append("text")
		        .attr("x", 0)
		        .attr("y", 105)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:900")
		        .text("Sodium");

			svg.append("text")
		        .attr("x", 45)
		        .attr("y", 105)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:500")
		        .text(currentItem.sodi + "mg");	
				
			svg.append("text")
				.attr("x", 235)
				.attr("y", 105)
				.attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:900")	
				//Calculate Sodium Daily Based on variable (2400mg day)
		        .text(Math.round(((currentItem.sodi / 2400) * 100)) + "%");
				
			//Carbohydrate / Sugars
			svg.append("line")
		        .attr("x1", 0)
				.attr("y1", 110)
				.attr("x2", 260)
				.attr("y2", 110)
				.attr("style", "stroke:black;stroke-width:1");
			
			svg.append("text")
		        .attr("x", 0)
		        .attr("y", 125)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:900")
		        .text("Total Carbohydrate");
			
			svg.append("text")
		        .attr("x", 116)
		        .attr("y", 125)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:500")
		        .text(currentItem.carbo + "g");	
			
			svg.append("text")
				.attr("x", 235)
				.attr("y", 125)
				.attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:900")	
				//Calculate Total Carbohydrate Daily Based on variable (300g day)
		        .text(Math.round(((currentItem.carbo / 300) * 100)) + "%");
				
			svg.append("line")
		        .attr("x1", 0)
				.attr("y1", 130)
				.attr("x2", 260)
				.attr("y2", 130)
				.attr("style", "stroke:black;stroke-width:1");
			
			svg.append("text")
		        .attr("x", 15)
		        .attr("y", 145)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:500")
		        .text("Sugars");
			
			svg.append("text")
		        .attr("x", 57)
		        .attr("y", 145)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:500")
		        .text(currentItem.sugars + "g");	
			
			//Protein		
			svg.append("line")
		        .attr("x1", 15)
				.attr("y1", 150)
				.attr("x2", 260)
				.attr("y2", 150)
				.attr("style", "stroke:black;stroke-width:1");
				
			svg.append("text")
		        .attr("x", 0)
		        .attr("y", 165)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:900")
		        .text("Protein");

			svg.append("text")
		        .attr("x", 45)
		        .attr("y", 165)
		        .attr("font-family", "Helvetica Black")
				.attr("font-size", 13)
				.attr("style", "font-weight:500")
		        .text(currentItem.protein + "g");
				
			svg.append("line")
		        .attr("x1", 0)
				.attr("y1", 173)
				.attr("x2", 260)
				.attr("y2", 173)
				.attr("style", "stroke:black;stroke-width:4");
				
			svg.append("rect")
				.attr("x", -5)
				.attr("y", -25)
				.attr("width", 270)
				.attr("height", 210)
				.attr("style", "fill:none;stroke-width:1;stroke:black");
		}
	</script>

		</div>
	</body>
</html>