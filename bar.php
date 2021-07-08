<?php
session_start();
require_once('config.php');
?>
<style>
#chartdiv {
  backgroundColor: 'transparent';
  width: 720px;
  height: 490px;
}
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/kelly.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_kelly);
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

// Add data
chart.data = [{
  "Material": "Iron Ore",
  "Tonnes": <?php
				$sql = mysqli_query($con,"SELECT SUM(Capacity) AS SUM_Capacity FROM Materials_Data WHERE Basic_Type=1 AND Actual_Type=1");
				while($row = mysqli_fetch_array($sql))
				echo $row ['SUM_Capacity'];
				?>
}, {
  "Material": "Cooking Coal",
  "Tonnes": <?php
				$sql = mysqli_query($con,"SELECT SUM(Capacity) AS SUM_Capacity FROM Materials_Data WHERE Basic_Type=1 AND Actual_Type=2");
				while($row = mysqli_fetch_array($sql))
				echo $row ['SUM_Capacity'];
				?>
}, {
  "Material": "Boiler Coal",
  "Tonnes": <?php
				$sql = mysqli_query($con,"SELECT SUM(Capacity) AS SUM_Capacity FROM Materials_Data WHERE Basic_Type=1 AND Actual_Type=3");
				while($row = mysqli_fetch_array($sql))
				echo $row ['SUM_Capacity'];
				?>
}, {
  "Material": "Coal Tar",
  "Tonnes": <?php
				$sql = mysqli_query($con,"SELECT SUM(Capacity) AS SUM_Capacity FROM Materials_Data WHERE Basic_Type=2 AND Actual_Type=4");
				while($row = mysqli_fetch_array($sql))
				echo $row ['SUM_Capacity'];
				?>
}, {
  "Material": "Coke Dust",
  "Tonnes": <?php
				$sql = mysqli_query($con,"SELECT SUM(Capacity) AS SUM_Capacity FROM Materials_Data WHERE Basic_Type=2 AND Actual_Type=5");
				while($row = mysqli_fetch_array($sql))
				echo $row ['SUM_Capacity'];
				?>
}, {
  "Material": "NutsCoke",
  "Tonnes": <?php
				$sql = mysqli_query($con,"SELECT SUM(Capacity) AS SUM_Capacity FROM Materials_Data WHERE Basic_Type=2 AND Actual_Type=6");
				while($row = mysqli_fetch_array($sql))
				echo $row ['SUM_Capacity'];
				?>
}, {
  "Material": "Angles",
  "Tonnes": <?php
				$sql = mysqli_query($con,"SELECT SUM(Capacity) AS SUM_Capacity FROM Materials_Data WHERE Basic_Type=3 AND Actual_Type=7");
				while($row = mysqli_fetch_array($sql))
				echo $row ['SUM_Capacity'];
				?>
}, {
  "Material": "Wire Rods",
  "Tonnes": <?php
				$sql = mysqli_query($con,"SELECT SUM(Capacity) AS SUM_Capacity FROM Materials_Data WHERE Basic_Type=3 AND Actual_Type=8");
				while($row = mysqli_fetch_array($sql))
				echo $row ['SUM_Capacity'];
				?>
}, {
  "Material": "Beams",
  "Tonnes": <?php
				$sql = mysqli_query($con,"SELECT SUM(Capacity) AS SUM_Capacity FROM Materials_Data WHERE Basic_Type=3 AND Actual_Type=9");
				while($row = mysqli_fetch_array($sql))
				echo $row ['SUM_Capacity'];
				?>
}];

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "Material";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 270;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 50;

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "Tonnes";
series.dataFields.categoryX = "Material";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

// on hover, make corner radiuses bigger
var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

// Cursor
chart.cursor = new am4charts.XYCursor();

}); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>
