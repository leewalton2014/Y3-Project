<?php
/**
*implements chart.js library
*
*https://phppot.com/php/creating-dynamic-data-graph-using-php-and-chart-js/
*used as reference for setup of chart.js
*/
if (isset($_SESSION['user']) && $usertype == 3){
  //dash content
  echo "<div class='sidenav'>";
  echo "<ul>
    <li><a href='dashboard.php' class='emph'>Staff</a></li>
    <li><a href='dashboard.php' class='emph'>Welcome $username</a></li>
    <li><a href='newevent-form.php'>New Event</a></li>
    <li><a href='manage-events.php'>Manage Events</a></li>
    <li><a href='view-users.php'>View Users</a></li>
    <li><a href='data-analytics.php'>Data Analytics</a></li>
    <li><a href='manage-cms.php'>Manage Content</a></li>
    <li><a href='viewuser-bookings.php'>Your Bookings</a></li>
    <li><a href='update-userinfo.php?userID=$userid'>Update Account Info</a></li>
    <li><a href='update-password-form.php'>Change Password</a></li>
  </ul>";
  echo "</div>";
  echo "<div class='dash-main'>";
  echo "<div class='dash-main-infobox'>
  <p>Please logout of the system when not in use for data protection.</p>
  </div>";
  echo "<h2>Classes Sceduled</h2>";
  echo "<div class='chartContainer'>
        <canvas id='graphCanvas'></canvas>
    </div>";
  echo "</div>";
}else{
  header('Location: login-form.php');
  exit;
}

?>

<script>
  $(document).ready(function (){
    showGraph();
  });

  function showGraph(){
    {
      $.post("getClassData.php",
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
        var graphTarget = $("#graphCanvas");
        var barGraph = new Chart(graphTarget, {
            type: 'bar',
            data: chartdata
        });
      });
    }
  }

</script>
