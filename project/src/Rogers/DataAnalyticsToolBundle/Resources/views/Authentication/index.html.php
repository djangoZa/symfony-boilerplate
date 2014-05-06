<?php if(!empty($alert)): ?>
    <div class="alert">
        <?php echo $alert; ?>
    </div>
<?php endif?>

<form name="authentication" action="/authentication/login" method="post">
    <input type="text" name="username" value="<?php echo $username; ?>">
    <input type="password" name="password" value="<?php echo $password; ?>">
    <input type="checkbox" name="remember" value="1" <?php echo (!empty($remember)) ? 'checked' : null; ?>>
    <input type="submit" name="login" value="Login">
</form>