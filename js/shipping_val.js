<!--
function shippingVal()
{
    if(document.updateAddress.ship_address1.value == document.updateAddress.ship_address1.defaultValue )
    {
        alert( "Please provide the shipping address 1!" );
        document.updateAddress.ship_address1.focus() ;
        return false;
    }
    else if(document.updateAddress.ship_address2.value == document.updateAddress.ship_address2.defaultValue )
    {
        document.updateAddress.ship_address2.value = "";
    }
    else if( document.updateAddress.ship_states.value == document.updateAddress.ship_states.defaultValue )
    {
        alert( "Please provide the state!" );
        document.updateAddress.ship_states.focus() ;
        return false;
    }
    else
    {
        alert("Processing New Shipping Address.");
        return( true );
    }
}
//-->