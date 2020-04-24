<?php


namespace app\modules\crud\controllers\api\resources;

use yii\helpers\ArrayHelper;

class Club extends \app\modules\crud\models\Club
{
    public function fields()
    {

        return ['nombre_club','equipos'];

//        return ArrayHelper::merge(
//            parent::fields(),
//            [
//                'equipos'
//            ]
//        );
    }

    public function extraFields()
    {
        return ['created_at','created_by','updated_at','updated_by'];
    }


    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['club_id' => 'id_club']);
    }

}
