<?php

namespace console\controllers;

use common\models\Post;
use common\models\User;

class GrabController extends \yii\console\Controller
{
    public function actionIndex()
    {
        $ru_repl = ['сегодня в ', 'вчера в ', 'января', 'февряля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'ноября', 'декабря', ' в '];
        $en_repl = ['today ', 'yesterday ', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'November', 'December', ' 2015, '];
        $avatar_folder_path = \Yii::getAlias('@frontwebroot') . '/avatars';
        $images_folder_path = \Yii::getAlias('@frontwebroot') . '/post_images';

        $cont = file_get_contents('http://geektimes.ru/page2/');
        preg_match_all('|<a\shref\=\"(.*?)\"\sclass\=\"post_title\">|im', $cont, $matches);
        print_r($matches);
        $links = $matches[1];
        foreach ($links as $link) {
            $cont = file_get_contents($link);

            preg_match_all('|<div\sclass\=\"published\">(.*?)<\/div>|im', $cont, $matches);
            $p_date = $matches[1][0];
            $p_date = str_replace($ru_repl, $en_repl, $p_date);
            preg_match_all('|<span\sclass\=\"post_title\">(.*?)<\/span>|im', $cont, $matches);
            $title = $matches[1][0];
            //meta name="keywords" content="" />
            $keywords = '';
            preg_match_all('|<meta\sname\=\"keywords\"\scontent\=\"(.*?)\"\s\/>|im', $cont, $matches);
            if (isset($matches[1][0])) {
                $keywords = $matches[1][0];
            }
            preg_match_all('|<div\sclass=\"content\shtml_format">(.*?)<div\sclass\=\"clear\"><\/div>\s+<\/div>\s+<ul\sclass\=\"tags\">|ims', $cont, $matches);
            $content = $matches[1][0];
            preg_match_all('|<meta\sproperty\=\"og\:image\"\s+content\=\"(.*?)\"\s\/>|im', $cont, $matches);
            if (isset($matches[1][0])) {
                $post_image = $matches[1][0];
                if (substr($post_image, 0, 2) === '//') {
                    $post_image = 'http:' . $post_image;
                }
            } else {
                continue;
            }

            preg_match_all('|<img\ssrc\=\"(.*?)\"\sclass\=\"author-info__image-pic\"\/>|im', $cont, $matches);
            if (!isset($matches[1][0])) {
                continue;
            }
            $avatar = $matches[1][0];
            if (substr($avatar, 0, 2) === '//') {
                $avatar = 'http:' . $avatar;
            }
            preg_match_all('|<a\shref\=\".*?\"\sclass\=\"author-info__name\">(.*?)<\/a>|im', $cont, $matches);
            if (isset($matches[1][0])) {
                $author_name = $matches[1][0];
            }
            preg_match_all('|<a\shref\=\".*?\"\sclass\=\"author-info__nickname\">(.*?)<\/a>|im', $cont, $matches);
            if (!isset($matches[1][0])) continue;
            $author_nick = substr($matches[1][0], 1);

            print_r([$p_date, $title, $content, $avatar, $author_nick]);
            $user = User::findByUsername($author_nick);
            if (!$user) {
                $user = new User();
                $user->username = $author_nick;
                $user->password = 'fakeuserpass';

                file_put_contents($avatar_folder_path . '/' . basename($avatar), file_get_contents($avatar));
                $user->avatar = basename($avatar);
                $user->save();
            }
            $post = new Post();
            $post->owner_id = $user->getId();
            $post->post = $content;
            $post->title = $title;
            $post->keywords = $keywords;
            $post->create_time = date('Y-m-d H:i:s', strtotime($p_date));
            $post->update_time = date('Y-m-d H:i:s', strtotime($p_date));
            $post->public_from = date('Y-m-d H:i:s', strtotime($p_date));
            file_put_contents($images_folder_path . '/' . basename($post_image), file_get_contents($post_image));
            $image = \Yii::$app->image->load($images_folder_path . '/' . basename($post_image));
            $image->resize(330, 166);
            $image->save($images_folder_path . '/' . basename($post_image, '.jpg') . '_m.jpg');
            $image = \Yii::$app->image->load($images_folder_path . '/' . basename($post_image));
            $image->resize(780, 448);
            $image->save($images_folder_path . '/' . basename($post_image));
            $post->image_big = basename($post_image);
            $post->image_medium = basename($post_image, '.jpg') . '_m.jpg';
            if (!$post->save()) {
                print_r($post->getErrors());
            }
        }
    }

}