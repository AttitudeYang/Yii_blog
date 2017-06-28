<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poststatus;

/* @var $this yii\web\View */
/* @var $model common\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search" style="border:solid 1px #eee; border-radius:5px; padding:10px; margin-bottom:10px;">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div style='height: auto;'>
        <div style='width:22%;height: auto;float:left;'> 
            <?= $form->field($model, 'title') ?>
        </div>
        <div style='width:22%;height: auto;float:left;margin-left: 10px;'> 
           <?= $form->field($model, 'content') ?>
        </div>
         <div style='width:22%;height: auto;float:left;margin-left: 10px;'> 
            <?= $form->field($model, 'tags') ?>
        </div>
         <div style='width:22%;height: auto;float:left;margin-left: 10px;'> 
             <?= $form->field($model, 'status')->dropDownList(Poststatus::find()
                                                ->select(['name','id'])
                                                ->indexBy('id')
                                                ->column(),
                                                ['prompt'=>'全部']) ?> 
           
            
             
        </div>
        <div style="clear:both"></div>
    </div>
   

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'author_id') ?>

    <div class="form-group ">
        <?= Html::submitButton('查询', ['class' => 'btn btn-primary ']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
