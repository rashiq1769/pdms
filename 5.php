<?php
session_start();
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<title>Dashboard</title>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">PDMS <i class="fa fa-server" aria-hidden="true"></i></span>
</div>

<!-- Sidebar/menu -->
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
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue w3-card-4"><i class="fa fa-files-o" aria-hidden="true"></i>  Peak Values</a>
    <a href="6.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-upload fa-fw"></i>  Upload</a>
  </div>
</nav><br>
<div class="w3-main " style="margin-left:300px;margin-top:42px;">
<div class="w3-row-padding w3-margin-bottom">
<div class="w3-container w3-animate-right">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
</style>


<div class="w3-display ">
<div class="w3-centre">
<div class="w3-container">
<div class="w3-container  w3-black ">
<h2 class="w3-center"><i class="fa fa-database" aria-hidden="true"></i> Peak Values</h2>
</div>
<div class="w3-container w3-white  w3-card-4  w3-padding-16">
<form action="/action_page.php" target="_blank" id="ajaxform">
<br>
<div class="w3-row-padding" style="margin:0 -16px;">
<div class="w3-half w3-margin-bottom">
<label><i class="fa fa-calendar-o"></i> From </label>
<input class="w3-input w3-border" type="text" placeholder=" YYYY-MM-DD " id="from"  required>
</div>

<div class="w3-half">
<label><i class="fa fa-calendar-o"></i> To </label>
<input class="w3-input w3-border" type="text" placeholder=" YYYY-MM-DD " id="to"  required>
</div>

<div class="w3-row-padding" style="margin:0 -16px;">
<div class="w3-container "><br><br>
<?php
$sql = "SELECT * FROM Basic_Materials";
$result2 = mysqli_query($con, $sql);
$options = "";
while($row2 = mysqli_fetch_array($result2))
{
$options = $options."<option value=$row2[0]>$row2[1]</option>";
}
?>
<div class="w3-half">
<select id='basicMaterial' onchange="populateActualMaterials()">
<?php echo $options;?>
</select></div>
<div class="w3-half">
<select id='actualMaterial' ></select></div>
<div class="w3-row-padding" style="margin:0 -16px;">
<div class="w3-container w3-margin-bottom"><br><br>
<button class="w3-button w3-dark-grey" type="button" onclick="getActualMaterialData()"><i class="fa fa-search w3-margin-right" ></i>  Get Data  </button>

</div>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div id="container">
<table id="table" class=' w3-table w3-striped w3-bordered w3-border w3-hoverable w3-gray w3-table-all w3-card-4 w3-animate-zoom'>
</table>
</div>
<script type="text/javascript">
function populateActualMaterials(){
$('#actualMaterial').empty();
var basicMaterial = $("#basicMaterial").val()==undefined?1:$("#basicMaterial").val();
console.info(basicMaterial);
$.ajax({ 'url' : 'utility.php',
          'method' : 'POST',
          'data' : {
          'id' : basicMaterial,
          'api' : 'getActualMaterial'
},
          'success' : function(dlist){
                        console.info(dlist);
                        var dlist = JSON.parse(dlist);
                        for(var i=0; i<dlist.length;i++)
                          $('#actualMaterial').append('<option value='+dlist[i].id+'>'+dlist[i].desc+'</option>')
                      }
                    }
                  );
                }
$(document).ready(function(){
  //$('#from').datepicker({'format' : 'yyyy-mm-dd'});
  //$('#to').datepicker({'format' : 'yyyy-mm-dd'});
populateActualMaterials();
}
);


function getActualMaterialData(){
  $("#table").empty();
  var basicMaterial = $("#basicMaterial").val()==undefined?1:$("#basicMaterial").val();
  console.info(basicMaterial);

  var actualMaterial = $("#actualMaterial").val()==undefined?1:$("#actualMaterial").val();
  console.info(actualMaterial);

var from=document.getElementById("from").value;



console.info(from);

var to=document.getElementById("to").value;

$.ajax({ 'url' : 'utility.php',
          'method' : 'POST',
          'data' : {
          'bid' : basicMaterial,
          'aid': actualMaterial,
          'from':from,
          'to':to,
          'api' : 'getActualMaterialData'
},
         'success' : function(dlist){
           console.info(dlist);
var dlist = JSON.parse(dlist);
           var len = dlist.length;
       var txt = "";
       if(len > 0){
         var txt1="<tr><th>Month</th><th>Year</th><th>Capacity</th></tr>";
          $("#table").append(txt1);
           for(var i=0;i<len;i++){

                   txt = "<tr><td>"+dlist[i].month+"</td><td>"+dlist[i].year+"</td><td>"+dlist[i].capacity+"</td></tr>";
                   $("#table").append(txt);
           }
    

}
        


                     $('#actualMaterial').append('<option value='+dlist[i].id+'>'+dlist[i].desc+'</option>')
            

                   }});
                 }









</script>
</div>
</div>
</div>
</div>









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
    </form>
    </div>
    </div>
    </div>
    </div>
    </body>


</html>
