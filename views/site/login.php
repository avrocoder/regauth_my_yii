<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Тестовое задание - Авторизация</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="/public/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
	<link href="/public/css/style.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/public/js/jquery.datepick/jquery.datepick.css"> 
        <script src="/public/js/jquery.min.js"></script>
        <script type="text/javascript" src="/public/js/jquery.datepick/jquery.plugin.js"></script> 
        <script type="text/javascript" src="/public/js/jquery.datepick/jquery.datepick.js"></script>
        <script type="text/javascript" src="/public/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

<div class="wrapper">

 <header class="header">
        <ul>
            <li><a href="/index.php?r=user/registration"><?php echo $this::t('registration','Registration');?></a></li>
            <?php if(\components\UserIdentity::getUserLogin()===null):?>
                <li><a href="/index.php?r=site/login"><?php echo $this::t('registration','Sign In');?></a></li>
            <?php else:?>
                <li><a href="/index.php?r=user/profile"><?php echo \components\UserIdentity::getUserLogin();?></a>
                <li>(<a href='/index.php?r=site/logout'><?php echo $this::t('registration','Logout');?></a>)
                </li>
            <?php endif;?>

            <li><?php echo $this::t('site','Language');?></li>:
            <li><a href="/index.php?r=site/language&lang=ru">Русский</a></li>
            <li><a href="/index.php?r=site/language&lang=en">English</a></li>
            
        </ul>
    </header><!-- .header-->
    
    <main class="content">
        <p class="headpage"><?php echo $this::t('registration','Sign In');?></p>
        <form action="" method="post" name="login">
            <div>
                <span class="error"><?php echo $this::t('error',$model->message);?></span>
                <span class="error"><?php echo $model->getError('login');?></span>
                <label><?php echo $this::t('registration','Login');?>*</label>
                <input name="login[login]" type="text" id="login" value="<?php echo $model->login;?>" data-toggle="tooltip" data-placement="bottom" 
                       title='<?php echo $this::t('registration','Your login');?>' />
            </div>
            <div>
                <span class="error"><?php echo $model->getError('password');?></span>
                <label><?php echo $this::t('registration','Password');?>*</label>
                <input name="login[password]" type="password" id="password" value="<?php echo $model->password;?>" data-toggle="tooltip" data-placement="bottom" 
                       title='<?php echo $this::t('registration','Your password');?>' />
            </div>
            <div>
                <input type="submit" value="Ok" />
            </div>
        </form>
 
    </main><!-- .content -->

</div><!-- .wrapper -->

<footer class="footer">
    <p>2014</p>
</footer><!-- .footer -->


<script type="text/javascript">
    $('#birthday').datepick({dateFormat: 'dd.mm.yyyy'});
    $('form input').tooltip();
</script>

</body>
</html>