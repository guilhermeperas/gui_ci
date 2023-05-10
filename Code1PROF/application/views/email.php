<?
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHPMAILER</title>
</head>
<body>
    <div id="container">
        <form action="<?=base_url('email/send')?>" method="post" enctype="multipart/form-data">
            <div>
                <label>Para</label>
                <input type="text" name="to"/>
            </div>
            <div>
                <label>Assunto</label>
                <input type="text" name="subj"/>
            </div>
            <div>
                <label>Message</label>
                <input type="text" name="msg"/>
            </div>
            <div>
                <input type="submit" value="Enviar"/>
            </div>
        </form>
    </div>
</body>
</html>