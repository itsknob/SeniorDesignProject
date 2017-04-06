<!DOCTYPE HTML>  
<?php
session_start();
$CompanyName = "NUWC Juicing";
    //Used to set session information
include "scripts.php";
    //Variables
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "admin_tools";
$con = makeConnection($dbhost, $dbuser, $dbpass, $dbname);

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
    <form action="" method="post">
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
    <form action="" method="post">
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

    <!--********Contact Us Information*******************-->
    <?php
    $contactInfoText = changeTextFile("contactInfo.txt", "contactInfo");
    ?>

    <h2>Please Enter Contact Information- This Will Appear at the Top of the Locations and Contact Us Page:</h2>
    <form action="" method="post">
        <textarea name="contactInfo" cols=48 rows=24><?php echo htmlspecialchars($contactInfoText) ?></textarea><br>
        <input type="submit" />
        <input type="reset" />
    </form>

    <!--********Location Information*******************-->
    <?php
    $locInfoText = changeTextFile("locationInfo.txt", "locationInfo");
    ?>

    <h2>Please Enter Location Information - This Will Appear Above the Twitter Feed on the Locations and Contact Us page:</h2>
    <form action="" method="post">
        <textarea name="locationInfo" cols=48 rows=24><?php echo htmlspecialchars($locInfoText) ?></textarea><br>
        <input type="submit" />
        <input type="reset" />
    </form>

    <!--************Upload Slideshow Pictures*************-->
    <h2>Upload Home Page Slideshow Pictures</h2>
    <form action="admin_tools.php" method="post" enctype="multipart/form-data">
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
        echo '<form action="" method="post">';
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
    </script>
    
</body>
</html>