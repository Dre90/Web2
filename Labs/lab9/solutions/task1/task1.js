/* PROGRAMMING FOR WEB II
 LAB 9 / TASK 1 ANSWER */

function upper_case(str)
{
   regexp = /^[A-Z]/;
   if (regexp.test(str))
    {
      alert("String's first character is uppercase");
    }
    else
    {
      alert("String's first character is not uppercase");
    }
}
upper_case('Abcd');
upper_case('abcd');
