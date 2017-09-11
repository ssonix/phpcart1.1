<?php include('template/head.php');
//include ('lib/functions/loggingin.php')?>
<body>


<div class="container" id="loginForm">
    <div class="card" style="width: 20rem;">
        <div class="card-block">
            <h4 class="card-title">Zaloguj się</h4>


            <form method="post" action="lib/functions/loggingin.php">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Wprowadz email" name="email">
                </div>
                <div class="form-group">
                    <label>Hasło</label>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <button type="submit" class="btn btn-primary" name="login">Zaloguj się</button>
                <p>
                    Nie jesteś zarejestrowany?<a href="register.php">Zarejestruj się</a>
                </p>
            </form>
        </div>
    </div>
</div>



<?php include('template/footer.php'); ?>