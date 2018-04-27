<?php
if(!isset($_POST['submit']))
{
    //This page should not be accessed directly. Need to submit the form.
    echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

//Validate first
if(empty($name)||empty($visitor_email)||empty($phone)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'balbirrajput@gmail.com';//<== update the email address
$email_subject = "New Form submission";
$email_body = $name."\n".$message."\n".$visitor_email."\n".$phone;

//$print_mail = "\n $visitor_email";  
//$to = "\n balbirrajput@gmail.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail('balbirrajput1990@gmail.com',$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('https://balbirtabashi.github.io/eduoracle/');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 