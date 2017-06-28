<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use common\models\Tag;
use frontend\components\TagsCloudWidget;
use frontend\components\RctReplyWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("@web/css/tag_style.css");
$this->registerJsFile("@web/js/tag_lrtk.js");
?>

<div class='container'>
    <div class='row'>
            
        <div class='col-md-8'>
            <?=ListView::widget([
                'id'=>'postList',
                'dataProvider'=>$dataProvider,
                'itemView'=>'_listitem',//子视图 显示一篇文章的标题等内容
                'layout'=>'{items} {pager}',
                'pager'=>[
                        'maxButtonCount'=>10,
                        'nextPageLabel'=>Yii::t('app','下一页'),
                        'prevPageLabel'=>Yii::t('app','上一页'),
                        ],


            ])  ?>
        </div>
        <div class='col-md-4'>
            <div class='col-md-1'></div>
            <div class='col-md-11'>

                    <!-- 搜索框-->
                     <div class='searchbox'>
                                <ul class='list-group'>
                                    <li class='list-group-item'>
                                        <span class='glyphicon glyphicon-search' aria-hidden='true'> </span>查找文章
                                    </li>
                                    <li class='list-group-item'>
                                    <form class="form-inline" action="index.php?r=post/index" id='w0' method='get'>
                                        <div class="form-group" >
                                        <input type="text" class="form-control" name="PostSearch[title]" id="w0input" placeholder="按标题" style='width:172px'>
                                        </div>
                                        <button type="submit" class="btn btn-default">搜索</button>
                                    </form>
                                    </li>
                                </ul>
                       </div>

                    <!-- 标签云 -->
                        <div class='tagsbox'>
                            <ul class='list-group'>
                                <li class='list-group-item'>
                                    <span class='glyphicon glyphicon-search' aria-hidden='true'> </span>标签云
                                </li>
                                <li class='list-group-item'>
                                <?=
                                TagsCloudWidget::widget(['tags'=>$tags])
                                 ?>
                

                                </li>
                            </ul>
                        </div>

                    <!-- 最近回复 -->
                        <div class='commentbox'>
                            <ul class='list-group'>
                                <li class='list-group-item'>
                                    <span class='glyphicon glyphicon-search' aria-hidden='true'> </span>最新回复
                                </li>
                                <li class='list-group-item'>
                                 <?=RctReplyWidget::widget(['recentcomments'=>$recentComments]) ?>
                                </li>
                            </ul>
                        </div>



            </div>
       
        </div>
    </div>


</div>




