<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

include('includes/header.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form>
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="form1Example1" class="form-control" />
                <label class="form-label" for="form1Example1">Email address</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="form1Example2" class="form-control" />
                <label class="form-label" for="form1Example2">Password</label>
            </div>

            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                </div>
                </div>

                <div class="col">
                <a href="#!">Forgot password?</a>
                </div>
            </div>

            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>    
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>

