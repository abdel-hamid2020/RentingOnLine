function validate() {
    var isValid = true;

    var name = $("#name").val();
    var numero = $("#numero").val();
    var subject = $("#subject").val();
    var message = $("#message").val();

    if (name == "") {
        $("#name").css('border', '#fb0505 1px solid');
        isValid = false;
    }
    if (numero == "") {
        $("#numero").css('border', '#fb0505 1px solid');
        isValid = false;
    }
    
    if (subject == "") {
        $("#subject").css('border', '#fb0505 1px solid');
        isValid = false;
    }
    if (message == "") {
        $("#message").css('border', '#fb0505 1px solid');
        isValid = false;
    }
    return isValid;
}