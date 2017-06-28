<?php 

namespace frontend\components;
use Yii;
use yii\Base\Widget;
use yii\helpers\Html;

class TagsCloudWidget extends Widget
{
	public $tags;

	public function init()
	{
		parent::init();
	}

	public function run()
	{
		$tagString='';
		$frontStyle=array(
			"6"=>'danger',
			'5'=>'info',
			'4'=>'warning',
			'3'=>'primary',
			'2'=>'success',
			);
		foreach ($this->tags as $tag=>$weight) 
		{
			$tagString.='<a href="'.Yii::$app->homeUrl.'?r=post/index&PostSearch[tags]='.$tag.'">'.'<h4 style="display:inline-block;margin-right:10px;margin-bottom:1px;"><span class="label label-'.$frontStyle[$weight].'">'.$tag.'</span></h4></a>';
		}
		return $tagString;
	}
}







 ?>