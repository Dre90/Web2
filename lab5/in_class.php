<?php

  $people = array("Peter", "Joe","Glenn","Cleveland");

  echo "<pre>";

  echo current($people) . "<br>";

  echo next($people) . "<br>";

  echo current($people) . "<br>";

  echo prev($people) . "<br>";

  echo end($people) . "<br>";

  echo prev($people) . "<br>";

  echo current($people) . "<br>";

  echo reset($people) . "<br>";

  echo next($people) . "<br>";

  print_r (each($people));

?>
