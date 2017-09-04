<?php include ('template/head.php'); ?>
<body>


<div class="container" id="registerForm">

<div class="card" style="width: 20rem;">
    <div class="card-block">
        <h4 class="card-title">Zarejestruj się</h4>
        <form method="post" action="index.php">
            <?php include ('lib/error.php')?>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label>Hasło</label>
                <input type="password" class="form-control" name="password_1" placeholder="Password">
            </div>
            <div class="form-group">
                <label>Powtórz hasło</label>
                <input type="password" class="form-control" name="password_2" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary" name="register">Zarejestruj się!</button>
            <p>
                Jesteś już zarejestrowany? <a href="login.php">Zaloguj się</a>
            </p>
        </form>
    </div>
</div>
</div>



<?php include ('template/footer.php'); ?>