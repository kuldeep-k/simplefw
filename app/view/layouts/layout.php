<html>
<head>
<title><?php echo $this->http_metas['title'] ?></title>
<!--<link rel="stylesheet" type="text/css" href="/css/app.css">-->
<link rel="stylesheet" type="text/css" href="<?php echo $this->AppConfig->site_root ?>css/blueprint/screen.css">
    
</head>
<body>
<div class="wrapper container">
<div class="header">My Company</div>
<div class="nav">
<!-- Nav Bar -->
</div>
<div class="message"> 
<?php echo $this->FlashMessage->dump(); ?>
</div>
<div class="content"><?php echo $this->content ?></div>
<div class="footer"></div>
</div>
</body>
</html>
