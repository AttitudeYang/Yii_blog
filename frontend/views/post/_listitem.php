<?php

use yii\helpers\Html;
use common\models\Tag;
?>

<div class='post'>
	<div class='title'>
		<h2><a href="<?=$model->url;?>"><?=Html::encode($model->title);  ?></a></h2>
	</div>
	<div class='author'>
		<span class='glyphicon glyphicon-time' aria-hidden='true'> <em><?=date('Y-m-d H:i:s',$model->create_time);  ?></em></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<span class='glyphicon glyphicon-user' aria-hidden='true'><em><?=Html::encode($model->author->nickname); ?></em> </span>
	</div>
	<br>
	<div class="content">
		<?=$model->beginning; ?>
	</div>
	<div class="nav">
		<span class='glyphicon glyphicon-tag' aria-hidden='true'></span>
		<?php 
		$links=array();
        foreach (Tag::string2array($model->tags) as $tag) {
            $links[]=Html::a(Html::encode($tag),array('post/index','PostSearch[tags]'=>$tag));
        }
		echo implode(',',$links);?>
		<br>

	</div>
	<div class='comment'>
		<?=Html::a('评论('.$model->commentCount.')',$model->url.'#comments') ?>
	</div>


</div>

