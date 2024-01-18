<?php
    require __DIR__ . '/vendor/autoload.php';

    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];

    $app_id = '1742651';
    $app_key = '8da1dbd0b7aeee60873d';
    $app_secret = 'e3f49321b033928a7c8e';
    $app_cluster = 'ap2';

    $pusher = new Pusher\Pusher($app_key, $app_secret, $app_id, ['cluster' => $app_cluster]);

    $data['message'] = array(

        'email' => $email,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'phone' => $phone,
    );

    $pusher->trigger('test_chat_app', 'my-event', $data);
    echo "student added"
?>