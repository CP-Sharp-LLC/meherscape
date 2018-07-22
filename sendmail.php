<?php
$email = $_POST['email'];

$result = mail('ayaan@meherscape.com', 'Meherscape Contact Request from ' . $email, 'The contact form has been triggered', 'FROM: notification@maherscape.com');
if($result)
{
$result = mail('nishar@meherscape.com', 'Meherscape Contact Request from ' . $email, 'The contact form has been triggered', 'FROM: notification@maherscape.com');
$result = mail('mahedisan@meherscape.com', 'Meherscape Contact Request from ' . $email, 'The contact form has been triggered', 'FROM:  notification@maherscape.com');
}
else
{
    echo 'fail';
    die();
}

echo 'success';