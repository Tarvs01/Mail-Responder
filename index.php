<?php

$first_name = $_POST['First_name'];
$last_name = $_POST['Last_name'];
$buyer_email = $_POST['email'];
$phoneNumber = $_POST['Phone_number'];
$whatsappNumber = $_POST['Whatsapp_Number'];
$message = $_POST['Message'];
/* echo $_POST['name']."<br>";
echo $_POST['email']."<br>";
echo $_POST['text']."<br>"; */
$json = $_POST['json'];
$wad = json_decode($json);

$buyer_message = "This is a confirmation mail for your order of:"."<br><br>";

/* foreach($wad as $key => $value)
{
    $buyer_message = $buyer_message."<b>$key x($value)</b>"."<br>";
} */

$buyer_message = $buyer_message."<br>Kindly wait for a mail containing the payment and delivery process";
// echo $buyer_message;

$seller_message = "An order has been placed with details:"."<br>";
$seller_message = $seller_message."Name: $name"."<br>";
$seller_message = $seller_message."Email: $buyer_email"."<br>";
$seller_message = $seller_message."Remark: $message"."<br>";
$seller_message = $seller_message."<br><br>Products:<br>";
/* foreach($wad as $key => $value)
{
    $seller_message = $seller_message."<b>$key x($value)</b>"."<br>";
} */

$seller_message = $seller_message."<br>Kindly reply as soon as possible";
// echo $seller_message;

require_once './vendor/autoload.php';
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
// Create a Transport object 
$transport = Transport::fromDsn('gmail://literaryedits@gmail.com:nkbshfyderjtiyeb@smtp.gmail.com:587');
// Create a Mailer object 
$mailer = new Mailer($transport); 
// Create an Email object 
$email = (new Email());
// Set the "From address" 
$email->from('literaryedits@gmail.com');
// Set the "From address" 
$email->to($buyer_email);
// Set a "subject" 
$email->subject('Order Confirmation');
// Set the plain-text "Body" 
$email->text('This is the plain text body of the message.\nThanks,\nAdmin');
// Set HTML "Body" 
$email->html($buyer_message);
// Add an "Attachment" 
//$email->attachFromPath('/path/to/example.txt');
// Add an "Image" 
//$email->embed(fopen('/path/to/mailor.jpg', 'r'), 'nature');
// Send the message 
if(!$mailer->send($email)){
    echo "buyer success";
}
else{
    echo "buyer failure";
}

$seller_mailer = new Mailer($transport);
$seller_mail = (new Email());
$seller_mail->from('literaryedits@gmail.com');
$seller_mail->to('tervenda18@gmail.com');
$seller_mail->subject('Order Placement');
$seller_mail->text('This is the plain text body of the message.\nThanks,\nAdmin');
$seller_mail->html($seller_message);

if(!$seller_mailer->send($seller_mail)){
    echo "seller success";
}
else{
    echo "seller failure";
}


?>