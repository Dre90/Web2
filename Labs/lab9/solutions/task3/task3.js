/* PROGRAMMING FOR WEB II
 LAB 9 / TASK 3 ANSWER */

function check_CreditCard(str)
{
        re = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
        if (re.test(str))
        {
         alert("Correct format...");
        }
        else
        {
          alert("Wrong format...");
        }
}
check_CreditCard("1234-5673-2345-3213");
check_CreditCard("123-5673-2345-3213");
