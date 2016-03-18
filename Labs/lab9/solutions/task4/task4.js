/* PROGRAMMING FOR WEB II
 LAB 9 / TASK 4 ANSWER */

function check_number(number)
{
        re = /^\+\d{2}\s\d{3}\s\d{3}\s\d{2}$/;
        if (re.test(number))
        {
         alert("Correct format...");
        }
        else
        {
          alert("Wrong format...");
        }
}
check_number("+41 401 222 12");
check_number("+21 23 232 12");
