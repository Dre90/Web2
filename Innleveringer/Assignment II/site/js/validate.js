// validate register form
function validate(form){
    fail = validate_username(form.username.value);
    fail += validate_email(form.email.value);
    fail += validate_password(form.password.value);
    fail += validate_firstname(form.firstname.value);
    fail += validate_lastname(form.lastname.value);

    if(fail === ''){ return true; } else { document.getElementById("error").innerHTML = fail ; return false; }
}

// validate log in form
function validateLogin(form){
    fail = validate_username(form.username.value);
    fail += validate_password(form.password.value);
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

// validate upload form
function validateUpload(form){
    fail = validate_title(form.title.value);
    fail += validate_category(form.category.value);
    fail += validate_fileToUpload(form.fileToUpload.value);
    fail += validate_text(form.text.value);
    if(fail === ''){ return true; } else { document.getElementById("error").innerHTML = fail ; return false; }
}

    function validate_title(title){
        var err = '';
        if(title.trim() === '') err = 'Title can not be empty.<br>';
        return err;
    }

    function validate_category(category){
        var err = '';
        if(category.trim() === '') err = 'Category can not be empty.<br>';
        return err;
    }

    function validate_fileToUpload(fileToUpload){
        var err = '';
        if(fileToUpload.trim() === '') err = 'Image can not be empty.<br>';
        return err;
    }

    function validate_text(text){
        var err = '';
        if(text.trim() === '') err = 'Text can not be empty.<br>';
        return err;
    }

    // validate edit form
    function validateEdit(form){
        fail = validate_title(form.title.value);
        fail += validate_category(form.category.value);
        fail += validate_text(form.text.value);
        if(fail === ''){ return true; } else { document.getElementById("error").innerHTML = fail ; return false; }
    }

        function validate_title(title){
            var err = '';
            if(title.trim() === '') err = 'Title can not be empty.<br>';
            return err;
        }

        function validate_category(category){
            var err = '';
            if(category.trim() === '') err = 'Category can not be empty.<br>';
            return err;
        }

        function validate_text(text){
            var err = '';
            if(text.trim() === '') err = 'Text can not be empty.<br>';
            return err;
        }
