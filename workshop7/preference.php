<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $value = $_POST['theme'];
    setcookie('theme', $value, time() + 86400 * 30, "/"); // 30 days
    $_COOKIE['theme'] = $value; // reflect immediately without reload
}

// Read cookie or set default
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';

// Apply CSS values
$bg  = ($theme === 'dark') ? '#000' : '#fff';
$color = ($theme === 'dark') ? '#fff' : '#000';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Theme Preference</title>
    <style>
        body {
            background-color: <?= $bg ?>;
            color: <?= $color ?>;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .card {
            background: <?= $theme === 'dark' ? '#111' : '#f5f5f5' ?>;
            padding: 20px;
            border-radius: 10px;
            max-width: 300px;
        }

        button {
            padding: 10px 15px;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Choose Your Theme</h2>

<div class="card">
    <form method="POST">
        <label>
            <input type="radio" name="theme" value="light" <?= $theme === 'light' ? 'checked' : '' ?>>
            Light Mode
        </label>
        <br><br>

        <label>
            <input type="radio" name="theme" value="dark" <?= $theme === 'dark' ? 'checked' : '' ?>>
            Dark Mode
        </label>
        <br><br>

        <button type="submit">Save Preference</button>
    </form>
</div>

</body>
</html>
