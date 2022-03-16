<!--
function validate()
{			
    if( document.profile.first_name.value == "" )
    {
        alert( "Please provide your first name!" );
        document.profile.first_name.focus() ;
        return false;
    }
    else if( document.profile.last_name.value == "" )
    {
        alert( "Please provide your last name!" );
        document.profile.last_name.focus() ;
        return false;
    }
    else if(document.profile.dob.value == "" )
    {
        alert( "Please provide your DOB" );
        document.profile.dob.focus();
        return false;
    }
    else if(document.profile.address1.value == "" )
    {
        alert( "Please provide your address line 1!" );
        document.profile.address1.focus();
        return false;
    }
    else if(isNaN(document.profile.phone_number.value))
    {
        alert("Optional: Please enter your phone number in the correct format!");
        document.profile.phone_number.focus();
        return false;
    }
    else if( (document.profile.mobile_number.value == "") || (isNaN( document.profile.mobile_number.value )) )
    {
        alert( "Please provide a valid mobile number!" );
        document.profile.mobile_number.focus();
        return false;
    }	   
    else if( document.profile.email.value == "" )
    {
        alert("Please enter your email address!");
        document.profile.email.focus() ;
        return false;
    }
   else
    {
        alert("Processing Registration.");
        return( true );
    }
}
//-->