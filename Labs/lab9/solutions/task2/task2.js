/* PROGRAMMING FOR WEB II
 LAB 9 / TASK 2 ANSWER */

function searchDate(str)
{
 var dateformat = /(\d\d?)\/(\d\d?)\/(\d{4})/;
 if (str.match(dateformat))
   {
     alert("Date found in the string.");
   }
 else
   {
     alert("Date not found in the string.");
   }
 }
 searchDate("Albert Einstein was born in Ulm, on 14/03/1879.");
