<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    //字符串转数组
    public  static function string2array($tag)
    {
        return preg_split('/\s*,\s*/', trim($tag),-1,PREG_SPLIT_NO_EMPTY);
    }

    //数组转字符串
    public function array2string($tag)
    {
        return implode(',',$tag);
    }

    //添加tag
    public static function addtags($tags)
    {
        if(empty($tags)) return;
        foreach ($tags as $k => $name) 
        {
            $atag=Tag::find()->where(['name'=>$name])->one();
            $atagCount=Tag::find()->where(['name'=>$name])->count();
            if(!$atagCount)
            {
                $tag=new Tag;
                $tag->name=$name;
                $tag->frequency=1;
                $tag->save();
            }else
            {
                $atag->frequency+=1;
                $atag->save();
            }

        }

    }

    public static function removetags($tags)
    {
        if(empty($tags)) return;
        foreach ($tags as $k => $name) 
        {
            $atag=Tag::find()->where(['name'=>$name])->one();
            $atagCount=Tag::find()->where(['name'=>$name])->count();
            if($atagCount)
            {
                if($atag->frequency==1)
                {
                    $atag->delete();
                }else
                {
                    $atag->frequency-=1;
                    $atag->save();  
                }
            }
        }
    }

    public static function updateFrequency($oldtags,$newtags)
    {
        if(!empty($oldtags) || !empty($newtags))
        {
            $oldTagsArray=self::string2array($oldtags);
            $newTagsArray=self::string2array($newtags);
            self::addtags(array_diff($newTagsArray,$oldTagsArray));
            self::removetags(array_diff($oldTagsArray,$newTagsArray));
        }
    }

    public static function findTagWeights($limit=20)
    {
        $tag_size_level=5;

        $models=Tag::find()->orderBy('frequency desc')->limit($limit)->all();
        $total=Tag::find()->limit($limit)->count();

        $stepper=ceil($total/$tag_size_level);
        $tags=array();
        $counter=1;
        if($total>0)
        {
            foreach ($models as  $model) 
            {
                $weight=ceil($counter/$stepper)+1;
                $tags[$model->name]=$weight;
                $counter++;
            }
            ksort($tags);
        }
        return $tags;
    }




}
