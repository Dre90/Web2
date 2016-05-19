function validateCustomer(form){
    fail = validate_fileToUpload(form.fileToUpload.value);
    if(fail === ''){ return true; } else { document.getElementById("errorCustomer").innerHTML = fail ; return false; }
}
function validateAccount(form){
    fail = validate_fileToUpload(form.fileToUpload.value);
    if(fail === ''){ return true; } else { document.getElementById("errorAccount").innerHTML = fail ; return false; }
}
function validateTransaction(form){
    fail = validate_fileToUpload(form.fileToUpload.value);
    if(fail === ''){ return true; } else { document.getElementById("errorTransaction").innerHTML = fail ; return false; }
}

function validate_fileToUpload(fileToUpload){
    var err = '';
    if(fileToUpload.trim() === '') err = 'You have to choose a file to upload.';
    return err;
}
