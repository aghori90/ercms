 /**************Restrict cut copy paste**************/
$(document).ready(function(){
    $('input').on("cut copy paste",function(e) {
       e.preventDefault();
    });
 });
$(window).on('load', function() {
  if ($('#preloader').length) {
    $('#preloader').delay(10).fadeOut('slow', function() {
      $(this).remove();
    });
  }
});
 /**************Check if input is a number**************/

function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;

return true;
}

/******************************************************/

/**************Start : Check if input is a alphabet**************/

 function isAlphabets(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 32 || charCode == 8) {
      return true;
    }

    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)) {
      return true;
    } else {
      return false;
    }

    return true;
  }

/******************************************************/

/**************Start : Check if input is alphanumeric**************/
function isAlphaNumeric(evt) { 
	var charCode = (evt.which) ? evt.which : event.keyCode
	var keyCode = evt.keyCode || evt.which;

	//Regex for Valid Characters i.e. Alphabets and Numbers.
	var regex = /^[A-Za-z0-9]+$/;
	//Validate TextBox value against the Regex.
	var isValid = regex.test(String.fromCharCode(charCode));
	if (!isValid) {
		return false;
	}
	return true;
}
/**************End : Check if input is alphanumeric**************/

/**************Start : Check if input is address**************/
function isAddress(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  var keyCode = evt.keyCode || evt.which;
  //Regex for Valid Characters i.e. Alphabets and Numbers.
  var regex = /^[A-Za-z0-9.,\b_ ]+$/;///^[A-Za-z0-9]+$/;
  //Validate TextBox value against the Regex.
  var isValid = regex.test(String.fromCharCode(charCode));
  if (!isValid) {
    return false;
  }
  return true;         
}
/**************End : Check if input is address**************/

/**************Check if input is a correct UID**************/
  function checkUID(element) {
		var disallowedAadhaar = '123412341234';	
		var uid = element.value;
		if(uid.length == 1)
		{
			$('#uid-error').remove();	
		}
    if(uid.length == 12)
    {    
  		if ((disallowedAadhaar === uid) || ( uid.length!= 0 && uid.length < 12  )) {
    		element.value = '';
    		$( "element" ).addClass( "invalid-feedback" );		
        alert("Please enter a valid Aadhaar number.");
    		//$( "em" ).empty('#uid-error');
    		//$('#uid-error').remove();
    		//$("p").text("Hello world!");
    		//$( "<em id=\"uid-error\" class=\"error invalid-feedback uid-error\">Please enter a valid Aadhaar number.</em>" ).insertAfter( element );
    		// $('#uid-error').html("Please enter a valid Aadhaar number.");
    		$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
    		return false;
    	}
       
      // Verhoeff algorithm
      var Verhoeff = {
        "d": [
          [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
          [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
          [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
          [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
          [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
          [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
          [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
          [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
          [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
          [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
        ],
        "p": [
          [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
          [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
          [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
          [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
          [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
          [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
          [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
          [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
        ],
        "j": [0, 4, 3, 2, 1, 5, 6, 7, 8, 9],
        "check": function(str) {
          var c = 0;
          str.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function(u, i, o) {
            c = Verhoeff.d[c][Verhoeff.p[i & 7][parseInt(u, 10)]];
          });
          return c;
          //return (c === 0);

        },
        "get": function(str) {

          var c = 0;
          str.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function(u, i, o) {
            c = Verhoeff.d[c][Verhoeff.p[(i + 1) & 7][parseInt(u, 10)]];
          });
          //alert('d '+Verhoeff.j[c]);
          return Verhoeff.j[c];
        }
      };

     // Verhoeff algorithm validator, by Avraham Plotnitzky. (aviplot at gmail)
      String.prototype.verhoeffCheck = (function() {
        var d = [
          [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
          [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
          [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
          [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
          [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
          [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
          [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
          [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
          [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
          [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
        ];
        var p = [
          [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
          [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
          [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
          [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
          [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
          [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
          [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
          [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
        ];
        var j = [0, 4, 3, 2, 1, 5, 6, 7, 8, 9];

        return function() {
          var c = 0;
          this.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function(u, i, o) {
            c = d[c][p[i & 7][parseInt(u, 10)]];
          });
          return (c === 0);
        };
      })();



    	if( Verhoeff['check'](uid) == 0 ){
    		$( "em" ).empty('#uid-error');
    		$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
    		return true;
    	}
    	else {
    		element.value = '';
    		$( "element" ).addClass( "invalid-feedback" );
        alert("Please enter a valid Aadhaar number");
    		/*$( "em" ).empty('#uid-error');
    		$('#uid-error').remove();
    		$( "<em id=\"uid-error\" class=\"error invalid-feedback\">Please enter a valid Aadhaar number.</em>" ).insertAfter( element );
    		$('#uid-error').html("Please enter a valid Aadhaar number.");*/
    		$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
    		return false;
    	}
    }
  }

/******************************************************/


/**************Check Mobile No**************/
function checkMobile(element)
{	
var mobile_no = element.value;
var mobile_pattern = /[6789][0-9]{9}/;
var found = mobile_no.match(mobile_pattern);
	if ((mobile_no.length !== 10) || (found!=mobile_no)) {
			element.value = '';
			$( "element" ).addClass( "invalid-feedback" );		
			$( "em" ).empty('#mobile-error');
			$( "<em id=\"mobile-error\" class=\"error invalid-feedback\">Please enter a valid mobile number.</em>" ).insertAfter( element );
			$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
			return false;		
	}
	else{	$( "em" ).empty('#mobile-error');
			$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
			return true;
	}


} 

/**********************************************************/


/**************Check if number is decimal**************/
 function isNumberDecimalkey(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot 
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get only two digits after decimal
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}


function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate()
        r.moveEnd('character', o.value.length)
        if (r.text == '') return o.value.length
        return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
}

/**********************************************************/

/*********** Start : function to validate uploaded file extension********/
function validateFileExtension(component,span_id,error_msg,extns)
{
   var flag=0;
   with(component)
   {
      var ext=value.substring(value.lastIndexOf('.')+1).toLowerCase();
	  
      for(i=0;i<extns.length;i++)
      {
         if(ext==extns[i])
         {
            flag=0;
            break;
         }
         else
         {
            flag=1;
         }
      }
	  
      if(flag!=0)
      {
         document.getElementById(span_id).innerHTML=error_msg;
         component.value="";
         //component.style.backgroundColor="#eab1b1";
         //component.style.border="thin solid #eab1b1";
         component.focus();
         return false;		 
      }
      else
      {	
		document.getElementById(span_id).innerHTML='';
         return true;
      }
   }
}
/*********** End : function to validate uploaded file extension********/

/************Start : function to validate uploaded file size********/
function validateFileSize(component,span_id,msg,maxSize)
{
   if(navigator.appName=="Microsoft Internet Explorer")
   {
      if(component.value)
      {
         var oas=new ActiveXObject("Scripting.FileSystemObject");
         var e=oas.getFile(component.value);
         var size=e.size;
      }
   }
   else
   {
      if(component.files[0]!=undefined)
      {
         size = component.files[0].size;
      }else
	  {
		return false;  
	  }
   }
   
   if(size!=undefined && size>maxSize)
   {
      document.getElementById(span_id).innerHTML=msg;
      component.value="";
      //component.style.backgroundColor="#eab1b1";
      //component.style.border="thin solid #000000";
      component.focus();
      return false;
   }
   else
   {	
		document.getElementById(span_id).innerHTML='';
      	return true;
   }
}

/************End : function to validate uploaded file size********/