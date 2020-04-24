<?php


namespace app\modules\crud\controllers\api;


use app\modules\crud\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class ActiveController extends \yii\rest\ActiveController
{

    public function behaviors()
    {
//        return parent::behaviors();
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                'basicAuth' => [
                    'class' => \yii\filters\auth\HttpBasicAuth::className(),
                    'auth' => function ($username, $password) {
                        $user = User::find()->where(['username' => $username])->one();
                        if ($user->verifyPassword($password)) {
                            return $user;
                        }
                        return null;
                    },
                ],
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }


}
