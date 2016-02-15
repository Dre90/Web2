<?php
/* PROGRAMMING FOR WEB II
   LAB 3 / TASK 1 ANSWER */

$currMonth=date('F', time());
if ($currMonth == 'August'){
  echo "<p>It's August, so it's really hot.</p>";
}else{
  echo "<p>Not August, so at least not in the peak of the heat.</p>";
}

?>   
