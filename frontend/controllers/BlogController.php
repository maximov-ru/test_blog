<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UrlManager;
use Zelenin\yii\extensions\Rss\RssView;

/**
 * BlogController implements the CRUD actions for Post model.
 */
class BlogController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex($page = 1)
    {
        $page = intval($page);
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->with(['owner'])->where('public_from <= NOW()')->orderBy('public_from DESC'),
            'pagination' => array(
                'pageSize' => 5,
                'page' => ($page - 1),
                'defaultPageSize' => 5,
                'forcePageParam' => false,
                /*'urlManager'=>[
                    'pattern' => 'blog/page<page:\d+>',
                    'route' => 'blog/index',
                    'suffix' => '/'
                ],*/
            ),
        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($slug)
    {
        //echo "123";die();
        $model = $this->findModel($slug);
        //var_dump($model->getAttributes());die();
        return $this->render('postView', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionRss()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->with(['owner'])->where('public_from <= NOW()')->orderBy('public_from DESC'),
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        $response = Yii::$app->getResponse();
        $headers = $response->getHeaders();

        $headers->set('Content-Type', 'application/rss+xml; charset=utf-8');

        $response->content = RssView::widget([
            'dataProvider' => $dataProvider,
            'channel' => [
                'title' => 'SEMrush Blog',
                'link' => Url::toRoute('/', true),
                'description' => 'SEMrush Blog',
                'language' => 'ru'
            ],
            'items' => [
                'title' => function ($model, $widget) {
                    return $model->title;
                },
                'description' => function ($model, $widget) {
                    return StringHelper::truncateWords($model->postPreview, 50);
                },
                'link' => function ($model, $widget) {
                    return 'http://test.danechka.com/blog/' . $model->slug;
                },
                'author' => function ($model, $widget) {
                    return $model->owner->username;
                },
                'guid' => function ($model, $widget) {
                    $date = \DateTime::createFromFormat('Y-m-d H:i:s', $model->public_from);
                    return 'http://test.danechka.com/blog/' . $model->slug . ' ' . $date->format(DATE_RSS);
                },
                'pubDate' => function ($model, $widget) {
                    $date = \DateTime::createFromFormat('Y-m-d H:i:s', $model->public_from);
                    return $date->format(DATE_RSS);
                }
            ]
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = Post::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}