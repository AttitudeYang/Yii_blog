<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template'=>'<tr><th style="width:120px;">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'id',
            'title',
            [
                'attribute'=>'content',
                'format'=>'raw',
            ],
            'tags:ntext',
            [
                'attribute'=>'status',
                'value'=>function($model){
                    return $model->status0->name;
                }
            ],
            [
                'label'=>'创建时间',
                'attribute'=>'create_time',
                'value'=>date('Y-m-d H:i:s',$model->create_time),
            ],
            [
                'label'=>'更新时间',
                'attribute'=>'update_time',
                'value'=>date('Y-m-d H:i:s',$model->update_time),
            ],
            [
                'label'=>'作者',
                'attribute'=>'author_id',
                'value'=>$model->author->nickname,

            ],
        ],
    ]) ?>

</div>
