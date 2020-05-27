<?php
/**
*implements chart.js library
*
*https://phppot.com/php/creating-dynamic-data-graph-using-php-and-chart-js/
*used as reference for setup of chart.js
*/
include 'functions.php';
setSessionPath();
startHTML('Newcastle Sport','Booking System');
makeNav();
makeTitle('Data Analytics');
if (isset($_SESSION['user']) && $_SESSION['userType'] >= 3){
echo "<div class='mainBody'>";
echo "<a href='dashboard.php' class='big-button'>Back to dashboard</a><br>";
echo "<h2>Bookings for Classes</h2>";
echo "<div class='chartContainer'>
      <canvas id='bookingCanvas'></canvas>
  </div>";
echo "<h2>Facility Usage</h2>";
echo "<div class='chartContainer'>
      <canvas id='facilityCanvas'></canvas>
  </div>";

}else{
  header('Location: login-form.php');
  exit;
}
?>
<script>
  $(document).ready(function (){
    showBookingGraph();
    showFacilityGraph();
  });

  function showBookingGraph(){
    {
      $.post("getBookingData.php",
      function (data){
        console.log(data);
        var classNames = [];
        var count = [];

        for (var i in data) {
          classNames.push(data[i].className);
          count.push(data[i].count);
        }
        var chartdata = {
          labels: classNames,
          datasets: [
            {
              label: 'Class Data',
              backgroundColor: '#FF7171',
              borderColor: '#46d5f1',
              hoverBackgroundColor: '#ddd',
              hoverBorderColor: '#666666',
              data: count
            }
          ]
        };
        var graphTarget = $("#bookingCanvas");
        var barGraph = new Chart(graphTarget, {
            type: 'bar',
            data: chartdata
        });
      });
    }
  }
  function showFacilityGraph(){
    {
      $.post("getFacilityData.php",
      function (data){
        console.log(data);
        var classNames = [];
        var count = [];

        for (var i in data) {
          classNames.push(data[i].description);
          count.push(data[i].count);
        }
        var chartdata = {
          labels: classNames,
          datasets: [
            {
              label: 'Facility Usage',
              backgroundColor: '#FF7171',
              borderColor: '#46d5f1',
              hoverBackgroundColor: '#ddd',
              hoverBorderColor: '#666666',
              data: count
            }
          ]
        };
        var graphTarget = $("#facilityCanvas");
        var barGraph = new Chart(graphTarget, {
            type: 'bar',
            data: chartdata
        });
      });
    }
  }

</script>
<?php
echo "</div>";
makeFooter();
endHTML();
?>
