<?php
/* PROGRAMMING FOR WEB II
   LAB 3 / TASK 4 ANSWER */

//Generate an HTML table
echo "<table border=\"1\">";

//Generate table data showing the numbers 1-7 multiplied by each other,
//starting with the rows.
for ($row=1; $row<=7; $row++){
  echo "<tr>\n";
  //Generate each entry in the row to create the columns.
  for ($col=1; $col<=7; $col++){
    //First, do the math.
    $x=$col * $row;
    //Then send the value to the table with the table data tags.
    echo "<td>$x</td>\n";
  }
  echo "</tr>";
}
echo "</table>";

?>   
