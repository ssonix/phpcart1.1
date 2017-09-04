<?php include ('template/head.php'); ?>
<body>


<div class="container" id="loginForm">
    <div class="card" style="width: 20rem;">
        <div class="card-block">
            <h4 class="card-title">Zaloguj się</h4>


            <form method="post" action="login.php">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Wprowadz email">
                </div>
                <div class="form-group">
                    <label>Hasło</label>
                    <input type="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary" name="login">Zaloguj się</button>
                <p>
                    Nie jesteś zarejestrowany?<a href="index.php">Zarejestruj się</a>
                </p>
            </form>
        </div>
    </div>
</div>



<?php include ('template/footer.php'); ?>