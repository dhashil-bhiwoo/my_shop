//last updated 22/7/14 10:21
<!--
function validate()
{			
    if( document.register.first_name.value == document.register.first_name.defaultValue )
    {
        alert( "Please provide your first name!" );
        document.register.first_name.focus() ;
        return false;
    }
    else if( document.register.last_name.value == document.register.last_name.defaultValue )
    {
        alert( "Please provide your last name!" );
        document.register.last_name.focus() ;
        return false;
    }
    else if(document.register.dob.value == "" )
    {
        alert( "Please provide your DOB" );
        document.register.dob.focus();
        return false;
    }
    else if( (document.register.address1.value) == (document.register.address1.defaultValue) )
    {
        alert( "Please provide your address line 1!" );
        document.register.address1.focus();
        return false;
    }
    else if( (document.register.address2.value) == (document.register.address2.defaultValue) )
    {
        document.register.address2.value = "";
    }
    else if( (document.register.states.value) == (document.register.states.defaultValue) )
    {
        document.register.states.value = "";
    }
    else if(((document.register.phone_number.value) != (document.register.phone_number.defaultValue)) && (isNaN(document.register.phone_number.value)))
    {
        alert("Optional: Please enter your phone number in the correct format!");
        document.register.phone_number.focus();
        return false;
    }
    else if( (document.register.mobile_number.value == "") || (isNaN( document.register.mobile_number.value )) )
    {
        alert( "Please provide a valid mobile number!" );
        document.register.mobile_number.focus();
        return false;
    }	   
    else if( (document.register.password.value == "") || (document.register.repassword.value == "") || (document.register.password.value.length < 8) )
    {
        alert( "Password must be more than 8 characters and must contain at least 1 numeric and 1 alphabet \n It can contain !@#$% \n Please insert and confirm your password!" );
        document.register.password.focus();
        return false;
    }
    else if( (document.register.password.value) != (document.register.repassword.value) )
    {
        alert("Password do not match!\n Try again.");
        document.register.repassword.focus() ;
        return false;
    }
    else if( document.register.email.value == "" )
    {
        alert("Please enter your email address!");
        document.register.email.focus() ;
        return false;
    }
   else
    {
        alert("Processing Registration.");
        return( true );
    }
}
//-->