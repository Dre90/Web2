
<html>
<head>
    <script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
<script>


$(document).ready(function(){
    $.ajax({url: "getusers.php", success: function(result){
        $("#users").html(result);
    }});

$("#add").click(function(){
    var user = {
        name : $("#name").val(),
        surname : $("#surname").val()
    }



    var user = $.post("adduser.php", user);
    // user.done(function (data) {
    //
    // })


    $.ajax({url: "getusers.php", success: function(result){
        $("#users").html(result);
    }});
});

});

</script>
</head>
<body>
<h2>Add user</h2>
    <!-- <form action="display.php" method="post"> -->
        <label for="name">Name</label>
            <input type="text" name="name" value="" id="name">
        <label for="surname">Surname</label>
            <input type="text" name="surname" value="" id="surname">
        <input type="submit" name="submit" value="Add" id="add">
    <!-- </form> -->


<div id="users"></div>

</body>
</html>
