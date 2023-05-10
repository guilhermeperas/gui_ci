<html>
  <head>
    <title>reCAPTCHA demo: Simple page</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <form action="<?=base_url("my_captcha/verificar")?>" method="POST">
      <div class="g-recaptcha" data-sitekey="6Lf5g_MlAAAAADGt2lWO4VdPwHEV2ENuGmgKvGu9"></div>
      <br/>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>