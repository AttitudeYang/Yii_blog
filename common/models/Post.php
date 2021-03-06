<?php

namespace common\models;
use common\models\Tag;
use common\models\Comment;
use yii\helpers\Html;


use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 *
 * @property Comment[] $comments
 * @property Adminuser $author
 * @property Poststatus $status0
 */
class Post extends \yii\db\ActiveRecord
{
 
    private $_oldtags;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status', 'author_id'], 'required'],
            [['content', 'tags'], 'string'],
            [['status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Adminuser::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Poststatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'status' => '状态',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'author_id' => '作者',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Adminuser::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Poststatus::className(), ['id' => 'status']);
    }


/////////重点
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->create_time=time();
                $this->update_time=time();
            }else
            {
                $this->update_time=time();
            }
            return true;
        }else
        {
            return false;
        }
    }


    public function afterFind()
    {
        parent::afterFind();
        $this->_oldtags=$this->tags;
    }

    public function afterSave($insert,$changeAttributes)
    {
        parent::afterSave($insert,$changeAttributes);
        Tag::updateFrequency($this->_oldtags,$this->tags);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        Tag::updateFrequency($this->tags,'');

    }

    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(
            [
                'post/detail',
                'id'=>$this->id,
                'title'=>$this->title,
            ]);
    }

    public function getBeginning($length=288)
    {
        $content=strip_tags($this->content);
        $tmplen=mb_strlen($content);
        $temstr=mb_substr($content,0,$length,'utf-8');
        return $temstr.($tmplen>$length ? '...' :'');
    }

    public function getCommentCount()
    {
        $count=Comment::find()->where(['post_id'=>$this->id,'status'=>2])->count();
        return $count;
    }

    // public function getTagLinks()
    // {
    //     $links=array();
    //     foreach (Tag::string2array($this->tags) as $tag) {
    //         $links[]=Html::a(Html::encode($tag),array('post/index','PostFrontSearch[tags]'=>$tag));
    //     }
    //     return $links;
    // }

}
