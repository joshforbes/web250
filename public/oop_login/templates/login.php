<div class="login-container">
    <h1>Login</h1>

    <?php if(isset($this->data['errors'])): ?>
        <div class="error-container">
            <p><?= $this->data['errors']; ?></p>
        </div>
    <?php endif; ?>
    <form action="index.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>