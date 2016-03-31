
function validate(form){
    fail = validate_username(form.username.value);
    fail += validate_email(form.email.value);
    fail += validate_password(form.password.value);
    fail += validate_firstname(form.firstname.value);
    fail += validate_lastname(form.lastname.value);

    if(fail === ''){ return true; } else { document.getElementById("error").innerHTML = fail ; return false; }
}
function validate_username(username){
    var err = '';
    if(username.trim() === '') err = 'Username can not be empty.<br>';
    return err;
}
function validate_email(email){
    var err = '';
    if(email.trim() === '') err = 'E-mail can not be empty.<br>';
    return err;
}
function validate_password(password){
    var err = '';
    if(password.trim() === '') err = 'Password can not be empty.<br>';
    return err;
}
function validate_firstname(firstname){
    var err = '';
    if(firstname.trim() === '') err = 'Firstname can not be empty.<br>';
    return err;
}
function validate_lastname(lastname){
    var err = '';
    if(lastname.trim() === '') err = 'Lastname can not be empty.<br>';
    return err;
}
