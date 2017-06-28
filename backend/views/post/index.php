<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Poststatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id',
                'headerOptions'=>['width'=>'30px'],
            ],
            
            // 'title',
            [
                'attribute'=>'title',
                'value'=>function($model,$key)
                {
                    return Html::a($model->title,['post/view','id'=>$key]);
                },
                'format'=>'raw',
            ],

            // [
            //     'attribute'=>'content',
            //     'value'=>function($model)
            //     {
            //         return Html::encode($model->content);
            //     },
            //     'format'=>'html',
            // ],
            'tags:ntext',
            [
                'attribute'=>'status',
                'value'=>'status0.name',
                //有默认项
                'filter'=>Html::activeDropDownList($searchModel,'status',Poststatus::find()->select(['name','id'])->indexBy('id')->column(),['prompt'=>'全部','class'=>'form-control']),
                // 没有默认项 
                // 'filter'=>Poststatus::find()->select(['name','id'])->indexBy('id')->column(),
                'headerOptions'=>['width'=>'120px'],

            ],
            // 'create_time:datetime',
            [
                'attribute'=>'update_time',
                'label'=>'修改时间',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],
            [
                'attribute'=>'authorName',
                'label'=>'作者',
                'value'=>'author.nickname',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
