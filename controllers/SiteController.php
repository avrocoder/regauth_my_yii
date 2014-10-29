<?php

namespace controllers;

class SiteController extends BaseController {
    
   public function actionLogin()
   {
        if (\components\UserIdentity::getUserLogin()!==null)
            $this->redirect('user/profile');
        $model=new \models\Login;
        if (isset($_POST['login']))
        {
            $model->setAttributes($_POST['login']);
            if($model->validate()&&$model->login())
            {
                $this->redirect('user/profile');
            }
        }
        
        $this->render('login',['model'=>$model]);
   }
   
   public function actionLanguage()
   {
       if(isset($_GET['lang']))
       {            
           $lang=\components\Lang::getInstance();
           $lang->setLanguage($_GET['lang']);
           $this->redirect('back');
       }
       else
       {
           throw new \Exception("Doesn't exist parameter lang in the url");
       }
        
   }
   
   public function actionLogout()
   {
       \components\UserIdentity::logout();
        $this->redirect('back');
   }
   
}

