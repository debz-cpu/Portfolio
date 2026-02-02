<?php
session_start();
$_SESSION['token'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
    <h2>Contact Us</h2>
    <p>Please leave your contact information below.</p>

    <form action="submit.php" method="post">

        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

        <label>Salutation</label>
        <select name="salutation">
            <option value="">-- Select --</option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Ms">Ms</option>
        </select>

        <label>Title</label>
        <select name="title">
            <option value="">-- Select --</option>
            <option value="DI">DI</option>
            <option value="Mag">Mag.</option>
            <option value="BA">B.A</option>
            <option value="MA">M.A</option>
            <option value="Dr">Dr.</option>
        </select>

        <label>First Name *</label>
        <input type="text" name="name" required>

        <label>Last Name *</label>
        <input type="text" name="surname" required>

        <label>Email *</label>
        <input type="email" name="email" required>

        <label>Gender *</label>
        <div class="radio-group">
            <label><input type="radio" name="gender" value="male" required> Male</label>
            <label><input type="radio" name="gender" value="female"> Female</label>
            <label><input type="radio" name="gender" value="other"> Other</label>
        </div>

        <label>Message *</label>
        <textarea name="comment" rows="4" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

</body>
</html>
