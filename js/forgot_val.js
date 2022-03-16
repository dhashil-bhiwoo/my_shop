<!--
function forgotval()
{
    if( document.forgot.email.value == "" )
	{
	    alert("Please enter your email address!");
	    document.forgot.email.focus() ;
	    return false;
	}
    else if( (document.forgot.mobile_number.value == "") || (isNaN( document.forgot.mobile_number.value )) )
    {
		alert( "Please provide a valid mobile number!" );
        document.forgot.mobile_number.focus();
        return false;
	}
    else if( (document.forgot.new_password.value == "") || (document.forgot.conf_password.value == "") || (document.forgot.new_password.value.length < 8) )
	{
	    alert( "Password must be more than 8 characters.\n It can contain !@#$%^&*()_ \n Please insert and confirm your password!" );
	    document.forgot.new_password.focus();
	    return false;
	}
	else if( (document.forgot.new_password.value) != (document.forgot.conf_password.value) )
	{
	    alert("Password do not match!\n Try again.");
	    document.forgot.conf_password.focus() ;
	    return false;
	}
    else
    {
        alert("Processing!");
        return true;
    }
}
//-->