<!--
function logval()
{
    if(document.login.email.value == document.login.email.defaultValue)
	{
        alert("Enter your email address!");
		document.login.email.focus();
        return false;		
	}
	else if (document.login.password.value.length < 8 || document.login.password.value == "")
	{
	    alert("Enter your password! \n Password must be more than 8 characters containing 1 alphabet and 1 number!");
		document.login.password.focus();
		return false;
	}
	else
	{
	    return true;
	}
}
//-->