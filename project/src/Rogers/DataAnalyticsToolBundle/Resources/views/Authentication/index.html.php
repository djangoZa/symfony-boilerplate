<?php $view->extend('RogersDataAnalyticsToolBundle::login.html.php') ?>

<?php $view['slots']->start('body') ?>
<div class="row">
    <div class="logo">
        <img src="/images/logo_title.png" width="320px">
    </div>
</div>
<div class="row">
    <div class="panel">
        <form name="authentication" action="/authentication/login" method="post" role="form">

            <p class="lead"><?php echo $view['translator']->trans('Login to your account') ?></p>

            <?php if(!empty($alert)): ?>
                <div class="alert alert-danger">
                    <?php echo $view['translator']->trans($alert) ?>
                </div>
            <?php endif?>
            
            <div class="form-group">
                <label class="sr-only" for="username"><?php echo $view['translator']->trans('Username') ?></label>
                <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo $view['translator']->trans('Username') ?>" value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <label class="sr-only" for="username"><?php echo $view['translator']->trans('Password') ?></label>
                <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo $view['translator']->trans('Password') ?>" value="<?php echo $password; ?>">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" value="1" <?php echo (!empty($remember)) ? 'checked' : null; ?>>
                    <?php echo $view['translator']->trans('Remember me next time') ?>
                </label>
            </div>
            <input type="submit" name="login" value="<?php echo $view['translator']->trans('Login') ?>" class="btn btn-success">
        </form>
    </div>
</div>
<?php $view['slots']->stop() ?>