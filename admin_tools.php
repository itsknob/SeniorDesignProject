<!DOCTYPE HTML>  
<?php
session_start(); 

include "scripts.php";
    //Variables
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "inventory";
    //Connect and Select    
$con = makeConnection($dbhost, $dbuser, $dbpass, $dbname);

$db = new PDO('mysql:host=localhost;dbname=inventory;charset=utf8', 'root', 'root');
$itemList = $db->prepare('SELECT itemName FROM items');
$itemList->execute();
$itemList = $itemList->fetchAll(PDO::FETCH_ASSOC);
$items = array();
foreach($itemList as $item) {
    $items[] = $item['itemName'];
}

?>
<html>
<head>
</head>
<body>  

    <?php
    // define variables and set to empty values
    $twitter = "";
    $nameErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$twitter = test_input($_POST["twitter"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$twitter)) {
            $nameErr = "Please only enter your twitter handle without the '@'"; 
        }
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
  ?>

  <h1>Admin Tools</h1>
  <!--***********Twitter Handle******************-->
  <?php
  $twitterHandleText = changeTextFile("twitterHandle.txt", "twitter");
  ?>

  <h2>Enter Twitter Handle:</h2>
  <form action="" method="post" enctype="multipart/form-data">
    <textarea name="twitter"><?php echo htmlspecialchars($twitterHandleText) ?></textarea><br>
    <input type="submit" />
    <input type="reset" />
</form>

<br>
<!--********About Us Text*******************-->
<?php
$aboutUsText = changeTextFile("aboutUs.txt", "aboutUs");
?>

<h2>Enter about us:</h2>
<form action="" method="post" enctype="multipart/form-data">
    <textarea name="aboutUs" cols=48 rows=24><?php echo htmlspecialchars($aboutUsText) ?></textarea><br>
    <input type="submit" />
    <input type="reset" />
</form>

<!--*******************About Us Image***********-->
<h2>Upload About Us Picture</h2>
<form action="admin_tools.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="aboutPicSubmit">
</form>

<?php
if(isset($_POST["aboutPicSubmit"])) {
    uploadAboutPicture("fileToUpload");
}
?>

<!--********Maps Information*******************-->
<?php
$latText = changeTextFile("mapsLatitude.txt", "lat");
$longText = changeTextFile("mapsLongitude.txt", "long");
?>

<h2>Please Enter the Latitude and Longitude of the Location You Would Like to Appear on the Map:</h2>
<a href="https://support.google.com/maps/answer/18539?source=gsearch&hl=en">You can get the latitude and longitude of an address by following these instructions</a>
<form action="" method="post" enctype="multipart/form-data">
    Latitude:<br>
    <textarea name="lat" ><?php echo htmlspecialchars($latText) ?></textarea>
    <br>Longitude:<br>
    <textarea name="long" ><?php echo htmlspecialchars($longText) ?></textarea>
    <br>
    <input type="submit" />
    <input type="reset" />
</form>

<!--********Contact Us Info**************************-->
<?php
$contactInfoText = changeTextFile("contactInfo.txt", "contactInfo");
?>
<h2>Please Enter Contact Information- This Will Appear at the Top of the Locations and Contact Us Page:</h2>
<form action="" method="post" enctype="multipart/form-data">
    <textarea name="contactInfo" cols=48 rows=24><?php echo htmlspecialchars($contactInfoText) ?></textarea><br>
    <input type="submit" />
    <input type="reset" />
</form>

<!--********Location Information*******************-->
<?php
$locInfoText = changeTextFile("locationInfo.txt", "locationInfo");
?>

<h2>Please Enter Location Information - This Will Appear Above the Twitter Feed on the Locations and Contact Us page:</h2>
<form action="" method="post" enctype="multipart/form-data">
    <textarea name="locationInfo" cols=48 rows=24><?php echo htmlspecialchars($locInfoText) ?></textarea><br>
    <input type="submit" />
    <input type="reset" />
</form>

<!--*********Add product to database and menu********-->
<br><br>
<h2>Add product</h2>

    <?php
        addProductForm();

        if (isset($_POST["prodSubmit"])) {
            if ( isset($_POST["price"]) && isset($_POST["itemName"]) && !empty($_FILES["picLink"]["name"])) { //TODO: Add issets for things that need to be submitted, price and desc?
                uploadProdPic("picLink");
                $itemName = mysqli_real_escape_string($con, $_REQUEST['itemName']);
                $price = mysqli_real_escape_string($con, $_REQUEST['price']);
                $desc = mysqli_real_escape_string($con, $_REQUEST['desc']);
                $cal = mysqli_real_escape_string($con, $_REQUEST['cal']);
                $prot = mysqli_real_escape_string($con, $_REQUEST['prot']);
                $chol = mysqli_real_escape_string($con, $_REQUEST['chol']);
                $sodi = mysqli_real_escape_string($con, $_REQUEST['sodi']);
                $carb = mysqli_real_escape_string($con, $_REQUEST['carb']);
                $sugar = mysqli_real_escape_string($con, $_REQUEST['sugar']);
                $pic = mysqli_real_escape_string($con, basename($_FILES["picLink"]["name"]));
                $sql = $db->prepare("INSERT INTO items (itemName, price, description, calories, protein, choles, sodi, picLink, carbo, sugars)
                       VALUES ('$itemName', '$price', '$desc', '$cal', '$prot', '$chol', '$sodi', '$pic', '$carb', '$sugar')");
                if ($sql->execute()){
                    echo '<br>Product added successfully. Please refresh page to see changes.';
                } else {
                    echo 'error';

                }
            } else {
                echo '<br> Error: Please make sure to submit at least an item name, price, and picture.';
            }
        }
    ?>

    <!--************Upload Slideshow Pictures*************-->
    <h2>Upload Home Page Slideshow Pictures</h2>
    <form action="admin_tools.php" method="POST" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="slideshowFile" id="slideshowFile">
        <input type="submit" value="Upload Image" name="slideSubmit">
    </form>
    <?php
    $fi = new FilesystemIterator("images/slideshow/", FilesystemIterator::SKIP_DOTS);
    $sizeofSlideshow = iterator_count($fi);

    if(isset($_POST["slideSubmit"])) {
        if($sizeofSlideshow >= 4) {
            echo "Sorry, there are too many images already in the slideshow. Please delete some so there are less than 4 if you would like to upload more.";
        } else {
            uploadSlidePicture("slideshowFile");
        }
    }
    ?>
    <br><br><br>
    <!--*********Display Images already uploaded and handle deletion of image(s)********-->
    <button onclick="toggleImages()">Show Images Currently in Slideshow</button>
    <div id="myDIV" style="display:none">
        <?php
        $dirname = "images/slideshow/";
        $images = glob($dirname."*.png");
        if (count($images) == 0) {
            echo 'There are no images in the slideshow';
            goto a;
        }
        $count = 0;
        foreach($images as $image) {
            echo '<img src="'.$image.'" /><br />';
        }
        echo '<form action="" method="post" enctype="multipart/form-data">';
        foreach($images as $image) {
            $count = $count + 1;
            echo '<input type="checkbox" name="deleteImages[]" value="'.$image.'"> Delete Image '.$count.'<br>';
        }
        echo '<input type="submit" name="formSubmit" value="delete" />';

        if(isset($_POST["formSubmit"])){
            if (empty($_POST["deleteImages"])) {
                echo("You didn't select any images to be deleted.");
                goto a;
            }
            $checkedImages = $_POST['deleteImages'];
            $N = count($checkedImages);
            for($i=0; $i < $N; $i++)
            {
                if(unlink($checkedImages[$i])) {
                    echo '<br>Image successfully deleted(refresh page to see updated slideshow)';
                } else {
                    echo 'Image was not deleted';
                }
            }
        }
        a:
        ?>
    </div>

    <br><br>
    <!--**************Display products in database and handle deletion and adding/removing from menu -->
    <button type="button" onclick="toggleProducts()">Show Product Inventory</button>
    <div id="myProds" style="display:none">
        <?php
        foreach($items as $item) {
            echo '<input type="checkbox" name="checkProds[]" value="'.$item.'"> '.$item.'<br>';
        }
        echo '<input type="submit" name="delSubmit" value="delete" />';
        echo '<input type="submit" name="remSubmit" value="remove from menu" />';
        echo '<input type="submit" name="addSubmit" value="add to menu" />';
        echo '<input type="submit" name="editSubmit" value="edit" />';

        if(isset($_POST["delSubmit"])){
            if (empty($_POST["checkProds"])) {
                echo("You didn't select any products to be deleted.");
                goto b;
            }
            $checkedProds = $_POST['checkProds'];
            $N = count($checkedProds);
            for($i=0; $i < $N; $i++)
            {
                $checkedProds[$i] = mysql_real_escape_string($checkedProds[$i]);
                $sql = $db->prepare("DELETE FROM items WHERE itemName='$checkedProds[$i]'");
                $sql2 = $db->prepare("SELECT picLink FROM items WHERE itemName ='$checkedProds[$i]'");
                $sql2->execute();
                $sql2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
                $picToBeDel = $sql2[0]['picLink'];
                if ($sql->execute() && unlink("images/$picToBeDel")) {
                    echo "<br>Records were deleted successfully. Please refresh page to see changes.";
                }
                else {
                    echo "error";
                }
            }
        }
        if(isset($_POST["remSubmit"])){
            if (empty($_POST["checkProds"])) {
                echo("You didn't select any products to be removed from menu.");
                goto b;
            }
            $checkedProds = $_POST['checkProds'];
            $N = count($checkedProds);
            for($i=0; $i < $N; $i++)
            {
                $checkedProds[$i] = mysql_real_escape_string($checkedProds[$i]);
                $sql = $db->prepare("UPDATE items SET inMenu =0 WHERE itemName='$checkedProds[$i]'");
                if ($sql->execute()) {
                    echo "Records were removed from menu successfully.";
                }
                else {
                    echo "error";
                }
            }
        }
        if(isset($_POST["addSubmit"])){
            if (empty($_POST["checkProds"])) {
                echo("You didn't select any products to be added to menu.");
                goto b;
            }
            $checkedProds = $_POST['checkProds'];
            $N = count($checkedProds);
            for($i=0; $i < $N; $i++)
            {
                $checkedProds[$i] = mysql_real_escape_string($checkedProds[$i]);
                $sql = $db->prepare("UPDATE items SET inMenu =1 WHERE itemName='$checkedProds[$i]'");
                if ($sql->execute()) {
                    echo "Records were added to menu successfully.";
                }
                else {
                    echo "error";
                }
            }
        }
        b:
        ?>
        </div>
        <?php
        if(isset($_POST["editSubmit"])){
            if (empty($_POST["checkProds"])) {
                echo("You didn't select any products to be edited.");
                goto c;
            }
            $checkedProds = $_POST['checkProds'];
            $N = count($checkedProds);
            if ($N > 1) {
                echo("Please select only one product to be edited.");
                goto c;
            }
            $sql = $db->prepare("SELECT * FROM items WHERE itemName ='$checkedProds[0]'");
            $sql->execute();
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
            $sql = $sql[0];
            $_SESSION['sql'] = $sql;
            //print_r($sql);

            echo '<br><h2>Edit Product:</h2>';
            editProductForm($sql);
        }
        if(isset($_POST["changeSubmit"])) {
            $itemName = mysqli_real_escape_string($con, $_REQUEST['itemName']);
            $price = mysqli_real_escape_string($con, $_REQUEST['price']);
            $desc = mysqli_real_escape_string($con, $_REQUEST['desc']);
            $cal = mysqli_real_escape_string($con, $_REQUEST['cal']);
            $prot = mysqli_real_escape_string($con, $_REQUEST['prot']);
            $chol = mysqli_real_escape_string($con, $_REQUEST['chol']);
            $sodi = mysqli_real_escape_string($con, $_REQUEST['sodi']);
            $carb = mysqli_real_escape_string($con, $_REQUEST['carb']);
            $sugar = mysqli_real_escape_string($con, $_REQUEST['sugar']);
            $pic = mysqli_real_escape_string($con, basename($_FILES["picLink"]["name"]));
            
            if(!empty($pic)) {
                $sql = $db->prepare("SELECT count(*) FROM items WHERE picLink='".$_SESSION['sql']['picLink']."'");
                $sql->execute();
                $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
                $count = $sql[0]['count(*)'];
                if ($count == 1 && !empty($_SESSION['sql']['picLink'])) {
                    $delImg = $_SESSION['sql']['picLink'];
                    unlink("images/$delImg");
                }
                uploadProdPic("picLink");
                $sql = $db->prepare( 
                "UPDATE items 
                SET itemName='$itemName', price='$price', description='$desc', calories='$cal', protein='$prot', choles='$chol', 
                sodi='$sodi', picLink='$pic', carbo='$carb', sugars='$sugar'
                WHERE itemID='".$_SESSION['sql']['itemID']."'" );
                if ($sql->execute()){
                    echo '<br>Product edited successfully. Please refresh page to see changes.';
                } else {
                    echo '<br>Error. Product not edited successfully.';
                    print_r($sql->errorInfo()); 
                }
            } else {
                $sql = $db->prepare( 
                "UPDATE items 
                SET itemName='$itemName', price='$price', description='$desc', calories='$cal', protein='$prot', choles='$chol', 
                sodi='$sodi', carbo='$carb', sugars='$sugar'
                WHERE itemID='".$_SESSION['sql']['itemID']."'" );
                if ($sql->execute()){
                    echo '<br>Product edited successfully. Please refresh page to see changes.';
                } else {
                    echo '<br>Error. Product not edited successfully.';
                    print_r($sql->errorInfo()); 
                }
            }
        }
        c:

        ?>
    
    <!--*******Javascript that toggles displaying images********-->
    <script>
        function toggleImages() {
            var x = document.getElementById('myDIV');
            if (x.style.display === 'none') {
                x.style.display = 'block';
            } else {
                x.style.display = 'none';
            }
        }
        function toggleProducts() {
            var x = document.getElementById('myProds');
            if (x.style.display === 'none') {
                x.style.display = 'block';
            } else {
                x.style.display = 'none';
            }
        }
    </script>
</body>
</html>