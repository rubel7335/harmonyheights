<?php ?>
    <p>Submit the word you see below:</p>
    <p id="captImg"><?php echo $captchaImg; ?></p>
    <a onclick="captcha(this)" ><img height="25" width="100" src="<?php echo base_url().'assets/appimages/refresh.png'; ?>"/></a>
  
    <form method="post">
        <input type="text" name="captcha" value=""/>
        <input type="submit" name="submit" value="SUBMIT"/>
    </form>
</body>
</html>