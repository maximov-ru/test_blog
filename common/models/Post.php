<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $image_big
 * @property string $image_medium
 * @property integer $owner_id
 * @property string $post
 * @property string $public_from
 * @property string $create_time
 * @property string $update_time
 *
 * @property User $owner
 */
class Post extends \yii\db\ActiveRecord
{
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
            [['title'], 'required'],
            [['owner_id'], 'integer'],
            [['post'], 'string'],
            [['public_from', 'create_time', 'update_time'], 'safe'],
            [['image_big','image_medium'], 'string', 'max' => 45],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'image_big' => 'Image Big',
            'image_medium' => 'Image M',
            'owner_id' => 'Owner ID',
            'post' => 'Post',
            'public_from' => 'Public From',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    public function beforeSave($insert)
    {
        echo "before save";
        if (parent::beforeSave($insert)) {
            if($insert)
                $this->generateSlug();
            return true;
        } else {
            return false;
        }
    }

    private function generateSlug(){
        $slug = self::str_to_translit(mb_strtolower($this->title,'utf-8'));
        echo "slg:$slug";
        $i = 0;
        do{
            $post = Post::findOne(['slug'=>($slug.($i? '_'.$i : ''))]);
            if($post){
                $i++;
            }
        }while($post);
        echo "set ".$slug;
        $this->slug = $slug.($i? '_'.$i : '');
    }

    private static function str_to_translit($str)
    {
        return strtr($str, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'i', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'u', 'я' => 'ya',' '=>'-',','=>'','.'=>'','?'=>'','!'=>'','/'=>'-','\\'=>'','-','«'=>'','»'=>'','—'=>'','['=>'',']'=>'',':'=>''));
    }
}