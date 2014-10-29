<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Тестовое задание - Регистрация</title>
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
        <p class="headpage"><?php echo $this::t('registration','Registration'); ?></p>
        <?php
        if ($model->hasErrors())
        {
            echo '<div class="all_errors">';
            echo 'Please correct the following errors:' . "\n";
            foreach ($model->getErrors() as $values) 
            {
                foreach ($values as $value) 
                {
                    echo '<div>' . $value . '</div>';
                }
            }
            echo '</div>';
        }
        ?>
        
        <form action="" method="post" name="registration" enctype="multipart/form-data">
            <div>
                <span class="error"><?php echo $this::t('error',$model->getError('login'));?></span>
                <label><?php echo $this::t('registration','Login'); ?>*</label>
                <input name="registration[login]" type="text" id="login" value="<?php echo $model->login;?>" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Login can consist of letters (a-z), numbers(0-9), symbols [-] [.] [_]'); ?>" />
            </div>
            <div>
                <span class="error"><?php echo $model->getError('password');?></span>
                <label><?php echo $this::t('registration','Password'); ?>*</label>
                <input name="registration[password]" type="password" id="password" value="<?php echo $model->password;?>" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Password (at least 6 symblos)'); ?>" />
            </div>
            <div>
                <span class="error"><?php echo $model->getError('email');?></span>
                <label><?php echo $this::t('registration','Email'); ?>*</label>
                <input name="registration[email]" type="text" id="email" value="<?php echo $model->email;?>" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','E-mail address'); ?>"/>
            </div>
            <div>
                <span class="error"><?php echo $model->getError('surname');?></span>
                <label><?php echo $this::t('registration','Surname'); ?>*</label>
                <input name="registration[surname]" type="text" id="surname" value="<?php echo $model->surname;?>" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Your surname'); ?>"/>
            </div>
            <div>
                <span class="error"><?php echo $model->getError('name');?></span>
                <label><?php echo $this::t('registration','Name'); ?>*</label>
                <input name="registration[name]" type="text" id="name" value="<?php echo $model->name;?>" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Your name'); ?>" />
            </div>
            <div>
                <span class="error"><?php echo $model->getError('patronymic');?></span>
                <label><?php echo $this::t('registration','Patronymic'); ?>*</label><input name="registration[patronymic]" type="text" id="patronymic" value="<?php echo $model->patronymic;?>" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Your patronymic'); ?>" />
            </div>
            <div>
                <span class="error"><?php echo $model->getError('photo');?></span>
                <label><?php echo $this::t('registration','Photo'); ?>*</label><input name="registration[photo]" type="file" id="photo" value="<?php echo $model->photo;?>" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Your photo'); ?>" />
            </div>
            <div>
                <span class="error"><?php echo $model->getError('birthday');?></span>
                <label><?php echo $this::t('registration','Birthday'); ?>*</label>
                <input name="registration[birthday]" type="text" id="birthday" value="<?php echo $model->birthday;?>" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Date of birth in the format dd.mm.yyyy'); ?>" />
            </div>
            <div>
                <span class="error"><?php echo $model->getError('maritalStatus');?></span>
                <label><?php echo $this::t('registration','Marital Status'); ?>*</label>
                <select name="registration[maritalStatus]" id="maritalStatus" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Your marital status'); ?>" >
                    <option value=""><?php echo $this::t('registration','Please select marital status');?></option>
                    <option value="single"><?php echo $this::t('registration','Single'); ?></option>
                    <option value="married"><?php echo $this::t('registration','Married'); ?></option>
                </select>
            </div>
            <div>
                <span class="error"><?php echo $model->getError('location');?></span>
                <label><?php echo $this::t('registration','Location'); ?>*</label>
                <input name="registration[location]" type="text" id="location" value="<?php echo $model->location;?>" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Location (country, city, street, building)'); ?>" />
            </div>
            <div>
                <span class="error"><?php echo $model->getError('phone');?></span>
                <label><?php echo $this::t('registration','Phone'); ?>*</label>
                <input name="registration[phone]" type="text" id="phone" value="<?php echo $model->phone;?>" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Phone number'); ?>" />
            </div>
            <div>
                <span class="error"><?php echo $model->getError('education');?></span>
                <label><?php echo $this::t('registration','Education'); ?>*</label>
                <select name="registration[education]" id="maritalStatus" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Your education'); ?>" >
                    <option value=""><?php echo $this::t('registration','Please select education'); ?></option>
                    <option value="higher"><?php echo $this::t('registration','Higher education'); ?></option>
                    <option value="technical"><?php echo $this::t('registration','Technical school'); ?></option> 
                    <option value="secondary"><?php echo $this::t('registration','Secondary education'); ?></option>
                </select>
            </div>
            <div>
                <span class="error"><?php echo $model->getError('experience');?></span>
                <label><?php echo $this::t('registration','Experience'); ?>*</label>
                <input name="registration[experience]" type="text" id="experience" value="<?php echo $model->experience;?>" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Years of experience'); ?>"/>
            </div>
            <div>
                <span class="error"><?php echo $model->getError('moreInformation');?></span>
                <label><?php echo $this::t('registration','More information'); ?></label>
                <textarea name="registration[moreInformation]" id="moreInformation" rows="5" data-toggle="tooltip" data-placement="bottom" 
                       title="<?php echo $this::t('registration','Additional information about yourself'); ?>"><?php echo $model->experience;?></textarea>
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