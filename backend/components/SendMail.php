<?php
    namespace backend\components;
    use Yii;

    class SendMail {
        public static function SendRegistration($email, $password, $role) {
            Yii::$app->mail->getView()->params['email'] = $email;
            Yii::$app->mail->getView()->params['password'] = $password;
            Yii::$app->mail->getView()->params['role'] = $role;
            Yii::$app->mail->compose('html')
                ->setFrom('info@priceclick.kz')
                ->setTo($email)
                ->setSubject('Вы были зарегистрированы на проекте Price Click' )
                ->send();
        }
    }
?>
