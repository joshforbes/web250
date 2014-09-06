<!DOCTYPE html>
<html lang="en">
<head>
    <title>Validation Homework</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Permanent+Marker' rel='stylesheet' type='text/css'>
    <link href="css/main.css" rel="stylesheet">
</head>

<body>
<div class="top-bar">
    <div class="account-container">
        <?php if(isset($this->data['auth']) && $this->data['auth']->loggedIn()): ?>
            <a href="login.php?profile"><?= $this->data['username']; ?></a>
            <a href="login.php?logout"><button class="btn btn-danger">Logout</button></a>
        <?php else: ?>
            <a href="login.php?login"><button class="btn btn-primary">Login</button></a>
        <?php endif; ?>
    </div>
</div>
<div class="container">
    <?php require($templatePath); ?>
</div>
</body>

</html>