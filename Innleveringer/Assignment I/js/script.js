function validateUpload(form){

    fail = validate_fileToUpload(form.fileToUpload.value);

    if(fail === ''){ return true; } else { document.getElementById("error").innerHTML = fail ; return false; }
}

function validate_fileToUpload(fileToUpload){
    var err = '';
    if(fileToUpload.trim() === '') err = 'You have to choose a file to upload.';
    return err;
}
