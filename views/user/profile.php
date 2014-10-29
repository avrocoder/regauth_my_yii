<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Тестовое задание - Профайл</title>
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
            <li>
                <?php if(\components\Lang::getLanguage()!=='ru'):?>
                <a href="/index.php?r=site/language&lang=ru">Русский</a>
                <?php else:?>
                Русский
                <?php endif;?>
            </li>
            <li>
                <?php if(\components\Lang::getLanguage()!=='en'):?>
                <a href="/index.php?r=site/language&lang=en">English</a>
                <?php else:?>
                English
                <?php endif;?>
            </li>
        </ul>
    </header><!-- .header-->

    <main class="content">
        <div class="profile">
            <p class="headpage"><?php echo $this::t('registration','Profile'); ?></p>
            <?php if(!empty($model->photo)):?>
            <div>
                <span class="field"><?php echo $this::t('registration','Photo'); ?>:</span>
                <span><img src="<?php echo '/public/images/avatars/' . $model->photo;?>" /></span>
            </div>
            <?php endif;?>
            <div>
                <span class="field"><?php echo $this::t('registration','Login'); ?>:</span>
                <span class="value"><?php echo $model->login;?></span>
            </div>
            <div>
                <span class="field"><?php echo $this::t('registration','Email'); ?>:</span>
                <span><?php echo htmlspecialchars($model->email);?></span>
            </div>
            <div>
                <span class="field"><?php echo $this::t('registration','Surname'); ?>:</span>
                <span><?php echo htmlspecialchars($model->surname);?></span>
            </div>
            <div>
                <span class="field"><?php echo $this::t('registration','Name'); ?>:</span>
                <span><?php echo htmlspecialchars($model->name);?></span>
            </div>
            <div>
                <span class="field"><?php echo $this::t('registration','Patronymic'); ?>:</span>
                <span><?php echo htmlspecialchars($model->patronymic);?></span>
            </div>
            <div>
                <span class="field"><?php echo $this::t('registration','Birthday'); ?>:</span>
                <span><?php echo Date('d.m.Y',$model->birthday);?></span>
            </div>
            <div>
                <span class="field"><?php echo $this::t('registration','Marital Status'); ?>:</span>
                <span><?php echo htmlspecialchars($model->maritalStatus);?></span>
            </div>
            <div>
                <span class="field"><?php echo $this::t('registration','Location'); ?>:</span>
                <span><?php echo htmlspecialchars($model->location);?></span>
            </div>
            <div>
                <span class="field"><?php echo $this::t('registration','Phone'); ?>:</span>
                <span><?php echo htmlspecialchars($model->phone);?></span>
            </div>
            <div>
                <span class="field"><?php echo $this::t('registration','Education'); ?>:</span>
                <span><?php echo htmlspecialchars($model->education);?></span>
            </div>
            <div>
                <span class="field"><?php echo $this::t('registration','Experience'); ?>:</span>
                <span><?php echo htmlspecialchars($model->experience);?></span>
            </div>
            <div>
                <span class="field"><?php echo nl2br(htmlspecialchars($this::t('registration','More information'))); ?>: </span>
                <span><?php echo $model->moreInformation;?></span>
            </div>
        </div>
    </main><!-- .content -->
</div><!-- .wrapper -->

<footer class="footer">
    <p>2014</p>
</footer><!-- .footer -->

</body>
</html>