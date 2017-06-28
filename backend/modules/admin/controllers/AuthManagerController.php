<?php

namespace backend\modules\admin\controllers;

use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class AuthManagerController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    
     protected function verbs()
    {
        $verbs = parent::verbs();
        $verbs['check'] = ['POST'];
        $verbs['menu'] = ['POST'];
        return $verbs;
    }

    public function actionMenu()
    {
    	var_dump(111);
    	die;
        $params = Yii::$app->request->post();
        if(trim($params['sysId']) == ''){
            return array('code'=>'503','info'=>'参数不能为空');
        }
    
        $menu = MenuHelper::getAssignedMenu($params['userId'],$params['sysId']);
        return array('code'=>'101','info'=>'操作成功','menu'=>$menu);
    }


    public function actionIndex()
    {
        return $this->render('index');
    }
}
