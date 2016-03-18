/* PROGRAMMING FOR WEB II
 LAB 9 / TASK 5 ANSWER */

function check_dinners(number)
{
        re = /^([30|36|38]{2})([0-9]{12})$/;
        if (re.test(number))
        {
         alert("Correct format...");
        }
        else
        {
          alert("Wrong format...");
        }
}
check_dinners("30125212365212");
check_dinners("411252123652121");
