<!DOCTYPE html>
<?php
	session_start();
	include "popItems.php";
	$CompanyName = "NUWC Juicing";
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "inventory";
	    //Connect and Select    
	$con = makeConnection($dbhost, $dbuser, $dbpass, $dbname);

	$db = new PDO('mysql:host=localhost;dbname=inventory;charset=utf8', 'root', 'root');
	$dotd = file_get_contents("adminTools/dotd.txt");
	$sql = $db->prepare("SELECT * FROM items WHERE itemName = '".$dotd."'");
	$sql->execute();
	$dotd = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<script type='text/JavaScript'>
		var dotd = <?php echo json_encode($dotd[0]); ?>;
</script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- D3 library for method chaining in SVG generation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.5.0/d3.js"></script>

<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type"text/css" href="styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

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
		        		<li class = "active"><a href="home.php">Home</a></li>
		        		<li><a href="menu.php">Menu</a></li>
		        		<li><a href="about.php">About Us</a></li> 
		        		<li><a href="locations_contact.php">Locations & Contact Us</a></li> 
		      		</ul>		
					<?php
						if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
							echo "
								<ul class='nav navbar-nav navbar-right'>
						       		<li><a href='my_account.php'><span class='glyphicon glyphicon-user'></span> My Account</a></li>
						    <!--   	<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li> -->
						       		<li><a href='logout.php'><span class glyphicon-shopping-logout'></span> Logout</a><li>
						   		</ul>
						   		"; // End of Navbar - Logged In 
						} else {
							echo "
								<ul class='nav navbar-nav navbar-right'>
									<li><a class='active' href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
						    <!--   	<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li> -->
								</ul>
								"; // End of Navbar - Logged Out
						} 
					?>
		    	</div>
		  	</div>
		</nav>
	
	<div class="main">
		<div id="imgmodal" class="modals">
			<span class="close">&times;</span>
			<img id="image-content" class="imagemodal-content">
		</div>
		<div id="svgmodal" class="modals">
			<span class="close">&times;</span>
		</div>
		<!-- Most Popular Menu Items -->
		<h3>Most Popular Items</h3>
		<div class="popItems well">
			<table class="table">
				<thead>
					<tr>
						<th style="width:25px;font-size:22px;">Rank</th>
						<th style="text-align:center;font-size:22px;">Item</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td id="rank1"></td>
					</tr>
					<tr>
						<td>2</td>
						<td id="rank2"></td>
					</tr>
					<tr>
						<td>3</td>
						<td id="rank3"></td>
					</tr>
					<tr>
						<td>4</td>
						<td id="rank4"></td>
					</tr>
					<tr>
						<td>5</td>
						<td id="rank5"></td>
					</tr>
				</tbody>
			</table>
		</div>

		<h3>Deal of the Day</h3>
		<div id="dealoftheday" class="dealOfDay well">

		</div>
		<?php
		$twitterHandle = file_get_contents('adminTools/twitterHandle.txt');
		?>
		<div class="twitterFeed well">
			<a class="twitter-timeline" 
			href=<?php echo "https://twitter.com/$twitterHandle" ?>> Tweets by nuwcJuicing </a>
			<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div>
		<div class="footer ">
	<!--    Slideshow-->
	<div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: 100%">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class  ="carousel-inner" role="listbox">
		<?php
			$dirname = "images/slideshow/";
	        $images = glob($dirname."*.png");
	        if (count($images) == 0) {
	            echo 'There are no images in the slideshow';
	            goto a;
	        }
	        $count = -1;

	        echo '<div class="item active">
					<img src="'.$images[0].'" alt="Chania">
				</div>';

	        foreach($images as $image) {
	        	$count = $count + 1;
	        	if($count == 0)
	        		continue;
	        	echo '<div class="item">
					<img src="'.$images[$count].'" alt="Chania">
				</div>';
	        }
	        a:
        ?>

		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	</div>
	<!--End Slideshow   -->

		
	</div>
	<script>
		var popularItems = <?php echo json_encode($pop);?>;
		popularItems = popularItems.sort(function(a,b){
		return (b.sales - a.sales);
		})

		popularItems = popularItems.slice(0,5);

		$("#rank1").html(popularItems[0].itemName);
		$("#rank2").html(popularItems[1].itemName);
		$("#rank3").html(popularItems[2].itemName);
		$("#rank4").html(popularItems[3].itemName);
		$("#rank5").html(popularItems[4].itemName);


		var dealOfTheDay = [{calories: dotd["calories"], carbo: dotd["carbo"], choles: dotd["choles"], 
                                    description: dotd["description"],
                                    itemID: dotd["itemID"], itemName: dotd["itemName"], picLink: dotd["picLink"], price:dotd["price"], protein:dotd["protein"], sodi:dotd["sodi"], sugars:dotd["sugars"]}];

		dealOfTheDay.forEach(function (d){
			var targetDiv = document.getElementById("dealoftheday");
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
			//generating the div for add to cart button NEEDS TO BE IN FORM FOR HREF
			var itemAddToCartDiv = document.createElement("div");
			itemAddToCartDiv.setAttribute("class", "itemaddtocartbutton dealbuttons");
			var itemAddToCartForm = document.createElement("form");
			var dealOfTheDayURL = "http://ec2-54-202-178-202.us-west-2.compute.amazonaws.com/menu.php?action=add&itemID=" + d.itemID;
			itemAddToCartForm.setAttribute("action", dealOfTheDayURL);
			var itemAddToCartButton = document.createElement("button");
			itemAddToCartButton.setAttribute("class", "dotdcheckout");
			itemAddToCartButton.innerHTML = "Checkout!";
			itemAddToCartForm.appendChild(itemAddToCartButton);
			itemAddToCartDiv.appendChild(itemAddToCartForm);
			//generating the nutrition div
			var itemNutritionInfoDiv = document.createElement("div");
			itemNutritionInfoDiv.setAttribute("class", "itemnutritionbutton dealbuttons");
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

		$(document).ready(function() {
			//image modal document variables
			var imagemodal = document.getElementById('imgmodal');
			var modalImg = document.getElementById('image-content');
			//nutrition modal document variables
			var svgmodal = document.getElementById('svgmodal');
			//When an image is clicked, display that image in the image modal
			$(document).on('click', ".image", function() {
				modalImg.setAttribute("src", this.src);
				imagemodal.style.display = "block";
			});
			//When a nutrition information button is clicked, loop through allItemsArray for the id 
			//use that item's information in allItemsArray to generate the SVG 
			$(document).on('click', ".nutritionbutton", function() {
				var currentID = this.id;
				dealOfTheDay.forEach(function(d) {
					if(currentID == d.itemID) {
						generateSVG(dealOfTheDay[0]);
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
</body>
</html>
