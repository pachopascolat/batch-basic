<?php


namespace app\modules\crud\models;


use Da\User\Model\Token;
use yii\base\NotSupportedException;

class User extends \Da\User\Model\User
{

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $tokenModel = Token::findOne(['code'=>$token]);
        if($tokenModel) {
            return self::findOne($tokenModel->user_id);
        }
    }

    public function verifyPassword($password){
        return \Yii::$app->getSecurity()->validatePassword($password,$this->password_hash);
    }
}
