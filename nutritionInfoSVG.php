<?php 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "juicing";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$query = "SELECT * FROM items WHERE itemId = 5";

$result = mysqli_query($con, $query);

$data[] = array();
while ( $row = $result->fetch_assoc() ){
    $data[] = json_encode($row);
}
$jsonData = json_encode( $data[1] );

echo $jsonData;

mysqli_close($con);

?>
<html>
<head> 
<br><br>This is the head <br><br>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.5.0/d3.js"></script>
<script>
	var currentItem = JSON.parse(<?php echo $jsonData; ?>);
	var margin = {top: 30, right: 10, bottom: 15, left: 10};
    var width = 260;
    var height = 175;
	
    var svg = d3.select("body")
                .append("svg")
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
		
</script>
<body>
<br> This is the body
</body>
</html>