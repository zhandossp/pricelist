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
                ->setSubject('Вы были зарегистрированы на проекте Maint Control!' )
                ->send();
        }
        public static function SendFeedbackinf($name, $phone) {
            Yii::$app->mail->getView()->params['name'] = $name;
            Yii::$app->mail->getView()->params['phone'] = $phone;
            Yii::$app->mail->compose('html')
                ->setFrom('info@priceclick.kz')
                ->setTo('zhandosspecial@gmail.com')
                ->setSubject('Вам отправили заявку на обратную связь!' )
                ->send();
        }
    }
?>
