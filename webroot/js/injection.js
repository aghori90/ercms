$(document).ready(function(){
    /** Start : Html Inject Query Prevention */
    $( ".htmlInj" ).keypress(function(e) {
        var key = e.keyCode;
        var id  = $(this).attr('id');
        if ( (key >= 33 && key <= 43) || (key >= 46 && key <= 46) || (key >= 57 && key <= 64) || (key >= 90 && key <= 95) || (key >= 122 && key <= 187) || (key >= 191 && key <= 255) ) {
            //$(".htmlInj").html("<i class='fa fa-check correct' aria-hidden='true'></i>");
            $('#'+id).css('border-color', 'red');
            $('#'+id).attr('placeholder', 'Invalid value !.');
            e.preventDefault();
        }
    });
    /** Ended : Html Inject Query Prevention */
    /** Start : Username Check in Login */
    $( ".lgnUserName" ).keypress(function(e) {
        var key = e.keyCode;
        // alert(key);return false;
        var id  = $(this).attr('id');
        if ( (key >= 33 && key <= 43) || (key >= 45 && key <= 46) || (key >= 57 && key <= 63) || (key >= 91 && key < 95) || (key >= 123 && key <= 187) || (key >= 191 && key <= 255) ) {
            $('#'+id).css('border-color', 'red');
            $('#'+id).attr('placeholder', 'Invalid Character !.');
            e.preventDefault();
        }
    });
    /** Ended : Username Check in Login */
    /** Start : Username Check in Login */
    $( ".lgnPassWord" ).keypress(function(e) {
        var key = e.keyCode;
        var id  = $(this).attr('id');
        if ( (key >= 33 && key <= 43) || (key >= 45 && key <= 46) || (key >= 57 && key <= 63) || (key >= 91 && key <= 95) || (key >= 123 && key <= 187) || (key >= 191 && key <= 255) ) {
            $('#'+id).css('border-color', 'red');
            $('#'+id).attr('placeholder', 'Invalid Character !.');
            e.preventDefault();
        }
    });
    /** Ended : Username Check in Login */
    /** Start : Integer Type Input */
    $( ".numonly" ).keypress(function(e) {
        var key = e.keyCode;
        var id  = $(this).attr('id');
        if (key >= 31 && key <= 46 || key >= 58 && key <= 126) {
            $('#'+id).val('');
            $('#'+id).css('border-color', 'red');
            $('#'+id).attr('placeholder', 'Invalid value, Only integer accepted !.');
            e.preventDefault();
        }
    });
    /** Ended : Integer Type Input */
    /** Start : For character text only */
    $( ".txtOnly" ).keypress(function(e) {
        var key = e.keyCode;
        var id  = $(this).attr('id');
        if (key >= 33 && key <= 64) {
            $('#'+id).val('');
            $('#'+id).css('border-color', 'red');
            $('#'+id).attr('placeholder', 'Invalid value, Only character accepted !.');
        	e.preventDefault();
        }
    });
    /** Ended : For character text only */
    /** Start : For Street Address Type Input */
    $(".ads").keypress(function (e) {
        var key = e.keyCode;
        var id  = $(this).attr('id');
        if ( (key >= 33 && key <= 43) || (key >= 45 && key <= 47) || (key >= 57 && key <= 64) || (key >= 90 && key <= 96) || (key >= 122 && key <= 255) ) {
            $('#'+id).val('');
            $('#'+id).css('border-color', 'red');
            $('#'+id).attr('placeholder', 'Invalid value !.');
        	e.preventDefault();
        }
    });
    /** Ended : For Street Address Type Input */
    /** Start : Bank IFS Code */
    $(".bkifsc").keypress(function (e) {
        var key = e.keyCode;
        var id  = $(this).attr('id');
        if ( (key >= 33 && key <= 43) || (key >= 45 && key <= 47) || (key >= 57 && key <= 64) || (key >= 90 && key <= 96) || (key >= 122 && key <= 255) ) {
            $('#'+id).val('');
            $('#'+id).css('border-color', 'red');
            $('#'+id).attr('placeholder', 'Invalid value !.');
        	e.preventDefault();
        }
    });
    /** Ended : Bank IFS Code */
    /** Start : Advertisement Number */
    $(".advNo").keypress(function (e) {
        var key = e.keyCode;
        //alert("key = " + key);return false;
        var id  = $(this).attr('id');
        if ( (key > 45 && key < 47) || (key >= 57 && key < 64) || (key >= 90 && key <= 96) || (key >= 122 && key <= 255) ) {
            $('#'+id).val('');
            $('#'+id).css('border-color', 'red');
            $('#'+id).attr('placeholder', 'Invalid value !.');
        	e.preventDefault();
        }
    });
    /** Ended : Advertisement Number */
    /** Start : Acknowledgement Number */
    $(".ackNoValid").keypress(function (e) {
        var key = e.keyCode;
        //alert("key = " + key);//return false;
        var id  = $(this).attr('id');
        if ( (key > 45 && key < 48) || (key > 57) ) {
            $('#'+id).val('');
            $('#'+id).css('border-color', 'red');
            $('#'+id).attr('placeholder', 'Invalid character !.');
        	e.preventDefault();
        }/*else{
            $('#'+id).val('');
            $('#'+id).css('border-color', 'green');
        }*/
    });
    /** Ended : Acknowledgement Number */
});
