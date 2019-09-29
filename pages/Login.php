<?php
$title = 'Login';

require_once( dirname( dirname( __FILE__ ) ).'/shared/layout.php' );
?>


    <!-- Custom styles for this template -->
    <link href="../wwwroot/css/login.css" rel="stylesheet">

    <form class="form-signin needs-validation" novalidate>
        <div class="text-center mb-4">
            <img class="mb-4" src="/wwwroot/img/privacy-policy.svg" alt="" width="140" height="140">
            <h1 class="h3 mb-3 font-weight-normal">Policy Now</h1>
            <p>Think Simple!</p>
        </div>

        <div class="form-label-group">
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus autocomplete="off">
            <label for="inputEmail">Email address</label>
            <div class="invalid-feedback">
                Please provide a valid Email address.
            </div>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required autocomplete="off">
            <label for="inputPassword">Password</label>
            <div class="invalid-feedback">
                Please provide a valid password.
            </div>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="form-label-group">
            <a href="#">Forgot my password?</a>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; <?php echo date( "Y" ); ?></p>
    </form>

    <script src="https://www.google.com/recaptcha/api.js?render=6LdHqLoUAAAAAOgySHu22j9NvGNCPMJmuZVARm7N"></script>
    <script src="../wwwroot/js/login.js"/></script>

<?php require_once( dirname( dirname( __FILE__ ) ).'/shared/footer.php' ); ?>