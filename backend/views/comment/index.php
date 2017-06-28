<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建评论', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id',
                'contentOptions'=>['width'=>'30px'],
            ],
            // 'content:ntext',
            [
                'attribute'=>'content',
                'value'=>'beiginning',
            ],
            [
                'attribute'=>'status',
                'value'=>'status0.name',
                'filter'=>Html::activeDropDownList($searchModel,'status',['1'=>'待审核','2'=>'已审核'],['prompt'=>'全部','class'=>'form-control']),
                'contentOptions'=>function($model)
                    {
                        return ($model->status==1)?['class'=>'bg-danger']:[];
                    },
            ],
            [
                'attribute'=>'create_time',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],
            // 'userid',
            [
                'attribute'=>'user.username',
                'label'=>'用户名',
                'value'=>'user.username',
            ],
            // 'email:email',
            // 'url:url',
            // 'post_id',
            [
               'attribute'=>'post_id',

            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}{approve}',
                'buttons'=>[
                        'approve'=>function($url,$model,$key)
                            {
                                $options=[
                                    'title'=>Yii::t('yii','审核'),//yii翻译成指定的语言
                                    'aria-label'=>Yii::t('yii','审核'),
                                    'data-confirm'=>Yii::t('yii','你确定通过这条评论吗'),//提示框
                                    'data-method'=>'post',
                                    'data-pjax'=>'0',
                                ];
                                return Html::a('<span class="glyphicon glyphicon-edit"></span>',$url,$options);
                            },
                        ]

            ],
        ],
    ]); ?>
</div>
