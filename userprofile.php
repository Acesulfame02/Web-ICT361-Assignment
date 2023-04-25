<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $bio = $_POST['bio'];

    // Validate form data
    $errors = array();
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    }
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email is invalid';
    }
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    }
    if (empty($bio)) {
        $errors['bio'] = 'Bio is required';
    }

    // If there are no errors, save the data and redirect to the profile page
    if (empty($errors)) {
        // Save data to the database or file system
        // Redirect to profile page
        header('Location: /profile.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>
    <form method="post">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
            <?php if (isset($errors['name'])) { echo $errors['name']; } ?>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
            <?php if (isset($errors['email'])) { echo $errors['email']; } ?>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <?php if (isset($errors['password'])) { echo $errors['password']; } ?>
        </div>
        <div>
            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio"><?php echo isset($bio) ? htmlspecialchars($bio) : ''; ?></textarea>
            <?php if (isset($errors['bio'])) { echo $errors['bio']; } ?>
        </div>
        <div>
            <button type="submit">Save</button>
        </div>
    </form>
</body>
</html>