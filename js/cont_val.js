<!--
function contactVal()
{
if (document.contact.subject.value == document.contact.subject.defaultValue)
{
    alert('Write in your subject');
    document.contact.subject.focus();
    return false;
}
else if(document.contact.comments.value == "")
{
    alert('Fill in your comment');
    document.contact.comments.focus();
    return false;
}
else
{
    return true;
}
}
//-->