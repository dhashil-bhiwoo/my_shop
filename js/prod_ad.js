<!--
function addProductValidation()
{
    if( (document.addprod.name.value) == (document.addprod.name.defaultValue) )
    {
        alert('Please set the product name');
        document.addprod.name.focus();
        return false;
    }
    else if( (document.addprod.description.value) == (document.addprod.description.defaultValue) )
    {
        alert('Please add the product description');
        document.addprod.description.focus();
        return false;
    }
    else if(isNaN(document.addprod.price.value))
    {
        alert('Please set the product price');
        document.addprod.price.focus();
        return false;
    }
    else if(document.addprod.file.files.length < 1)
    {
        alert("You Forgot to select an image");
        return false;
    }
    else
    {
        alert('Adding Product in Process');
        return true;
    }
}

function Checkfiles()
{
    var fieldImage = document.addprod.file;
    var fileName = fieldImage.value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
    if(ext == "png" || ext == "PNG" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG")
    {
    return true;
    } 
    else
    {
        alert("Upload Png or Jpg images only");
        fieldImage.value = "";
        fieldImage.focus();
    return false;
    }
}
//-->