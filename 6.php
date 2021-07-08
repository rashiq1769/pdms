<?php
session_start();
require_once('config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>
<link href="style.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
.box
{
 width:700px;
 border:1px solid #ccc;
 background-color:#fff;
 border-radius:5px;
 margin-top:100px;
}
</style>


    </head>

<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">PDMS <i class="fa fa-server" aria-hidden="true"></i></span>
</div>

<!-- Sidebar/menu -->
    <div class="w3-container"></div>
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
		<br><br>
    <div class="w3-col s4">
      <img src="avatar.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome</span><br>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>Overview</a>
    <a href="4.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-bar-chart" aria-hidden="true"></i>  Production Details</a>
    <a href="5.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-files-o" aria-hidden="true"></i>  Peak Values</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue w3-card-4"><i class="fa fa-upload fa-fw"></i>  Upload</a>
  </div>
</nav>
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
<div class="w3-row-padding w3-margin-bottom">
<div class="w3-container">
<?php
$output = '';
if(isset($_POST["import"]))
{
 $tmp=explode(".", $_FILES["excel"]["name"]);
 $extension = end($tmp);// For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("Classes/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<label class='text-success'>Data Inserted</label><br /><table class=' w3-table w3-striped w3-bordered w3-border w3-hoverable w3-gray w3-table-all w3-card-4 w3-animate-zoom '>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=1; $row<=$highestRow; $row++)
   {
    $output .= "<tr>";
    $Month = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $Year = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $Basic_Type = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $Actual_Type = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
    $Capacity = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
    $Entry_Date = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());

    $query = "INSERT INTO Materials_Data(Month,Year,Basic_Type,Actual_Type,Capacity,Entry_Date) VALUES ('".$Month."', '".$Year."','".$Basic_Type."','".$Actual_Type."','".$Capacity."','".$Entry_Date."')";


    mysqli_query($con, $query);
    $output .= '<td>'.$Month.'</td>';
    $output .= '<td>'.$Year.'</td>';
    $output .= '<td>'.$Basic_Type.'</td>';
    $output .= '<td>'.$Actual_Type.'</td>';
    $output .= '<td>'.$Capacity.'</td>';
    $output .= '<td>'.$Entry_Date.'</td>';

    $output .= '</tr>';
   }
  }
  $output .= '</table>';

 }
 else
 {
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 }
}
?>


    <!-- Import form (start) -->
<div class="popup_import">
<div class="w3-container w3-margin w3-animate-right">
<div class="w3-card-4" style="width:100%;">
<header class="w3-container w3-black ">
<h2 class="w3-center"><i class="fa fa-upload" aria-hidden="true"></i> Up Load</h2>
</header><br><br><br>

<div class="w3-container w3-center" >
<form method="post" enctype="multipart/form-data">
<input type="file" name="excel"/><br><br>

<input type="submit"  class="w3-btn  w3-black w3-round-xxlarge btn btn-info"   name="import"  value="Upload"/><br>
</form>
<br />
<br />

<?php
echo $output;
?>




</div><br><br><br>
</div>
</div>

    </div>

<div class="w3-container w3-margin">

</div>
<!-- Displaying imported users -->

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

    </div>
    </div>
    </div>
    </body>
</html>
