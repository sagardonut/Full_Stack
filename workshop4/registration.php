<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Show output
    echo "User $username with email $email has been registered.";

    // New user data
    $userData = [
        'username' => $username,
        'email' => $email,
        'password' => $password
    ];

    $filePath = 'users.json';

    // Check if file exists
    if (file_exists($filePath)) {
        $existingData = file_get_contents($filePath);

        $users = json_decode($existingData, true);

        if (!is_array($users)) {
            $users = [];
        }
    } else {
        $users = [];
        echo " File does not exist. Creating new file.";
    }
    $users[] = $userData;


    file_put_contents($filePath, json_encode($users, JSON_PRETTY_PRINT));

    echo " Data saved successfully!";
}

?>