<?php

namespace console\controllers;

use common\models\UserAccount;
use yii\console\Controller;
use common\models\User;

class UserController extends Controller
{
    public function actionPassword()
    {
        $password = null;
        $name = $this->prompt('Enter account name:');
        $user = User::find()->where(['username' => $name])->one();

        if (!$user) {
            $this->stderr('No user found with specified credentials!');
            return Controller::EXIT_CODE_ERROR;
        } else {
            $this->stdout("ID: {$user->id}" . PHP_EOL);
            $this->stdout("Name: {$user->username}" . PHP_EOL);
            $this->stdout("Email: {$user->email}" . PHP_EOL);
        }

        while (!$password)
            $password = $this->prompt("Enter new password:");

        if ($this->confirm("Are you sure to change password?")) {
            $user->password = $password;
            $user->save(false);
            $this->stdout("New password is: '{$password}'");
        } else {

            return Controller::EXIT_CODE_ERROR;
        }

        return Controller::EXIT_CODE_NORMAL;
    }
}