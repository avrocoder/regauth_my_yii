<?php

namespace controllers;

class UserController extends BaseController {
    
    public function actionRegistration()
    {
        $model = new \models\User('registration');
        if (isset($_POST['registration']))
        {
            $model->setAttributes($_POST['registration']);
            if ($model->validate())
            {
               $mysqli = \components\DB::connect(); 
               
               $insert=$mysqli->prepare("INSERT INTO `user` (login,password,
                   surname,name,patronymic,birthday,location,maritalStatus,
                   education,experience,phone,email,moreInformation,photo) 
                   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
               
               $password= \components\UserIdentity::hash($model->password,\components\Config::get('salt'));
               $birthday=strtotime($model->birthday);
               
               //loadind image
               if(!empty($_FILES['registration']['name']['photo']))
               {
                   $path_directory = $_SERVER['DOCUMENT_ROOT'] . '/public/images/avatars/';
                   $filename=$_FILES['registration']['name']['photo'];
                   preg_match('/.*(\\..*)$/', $filename, $matches);
                   $filename=$model->login . $matches[1];
                   $source=$_FILES['registration']['tmp_name']['photo'];
                   $target=$path_directory . $filename;
                   if (move_uploaded_file($source, $target)===false)
                   {
                       throw new \Exception('Failed to load photo');
                   }
               
               }
               // finished loading image
               
               $insert->bind_param('sssssdsssdssss', $model->login,$password,
                       $model->surname,$model->name,$model->patronymic,$birthday,
                       $model->location,$model->maritalStatus,$model->education,$model->experience,
                       $model->phone,$model->email,$model->moreInformation,$filename);
               
               if ($insert->execute()===false)
               {
                   throw new \Exception('Failed to add record. Please, try again later.');
               }
               
               \components\UserIdentity::setUserLogin($model->login);
               $this->redirect('user/profile');
            }
        }
        
        $this->render('registration', ['model'=>$model]);
    }
    
    public function actionProfile()
    {
        if(\components\UserIdentity::getUserLogin()===null)
            $this->redirect('user/registration');
        
        if (\components\UserIdentity::getUserLogin()===null)
        {
            throw new \Exception('You are not logged in');
        }
        
        $model=new \models\User();
        $model->getModelFromDb(\components\UserIdentity::getUserLogin());
        $this->render('profile', ['model'=>$model]);
    }
    
}
