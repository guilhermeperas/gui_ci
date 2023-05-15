<?
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <?
        if(isset($error))
            echo $error;
    ?>
    <div id="container">
        <form action="<?=base_url('Login/login')?>" method="post" enctype="multipart/form-data">
            <div>
                <label>Nome</label>
                <input type="text" name="username"/>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password"/>
            </div>
            <div>
                <input type="submit" value="Entrar"/>
            </div>
        </form>
    </div>
</body>
</html>