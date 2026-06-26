<?php 
function run_query($version,$dp,$sql) {
    if ($version == "5") {
       $result = mysql_query($sql);
    } else {
       $result = mysqli_query($dp,$sql);
    }
    return $result;
  }
function run_fetch($version,$result) {
    if ($version == "5") {
       $row = mysql_fetch_array($result);
    } else {
       $row = mysqli_fetch_array($result);
    }
    return $row;
  }
function run_free($version,$result) {
    if ($version == "5") {
       mysql_free_result($result);
    } else {
       mysqli_free_result($result);
    }
  }
?>
