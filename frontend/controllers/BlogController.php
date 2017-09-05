<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use common\models\Destination;
use common\models\User;
use common\models\Post;
use common\models\PostComment;
use common\models\Category;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;

use yii\web\BadRequestHttpException;


/**
 * Blog controller
 */
class BlogController extends Controller
{
    
    public function actionIndex($destination=null)
    {
        
        $query = Post::find()->where(['post.type'=>Post::TYPE_BLOG,'post.status'=>Post::STATUS_PUBLISHED]); 
        $model=null;
        if(isset($destination)){
            $model=$this->findDestination($destination);

            $query->joinWith(['categories ctg']);
            $query->andWhere(['ctg.id'=>$model->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>21,
            ]
        ]);
        
        return $this->render('index',[
            'model'=>$model,
            'dataProvider'=>$dataProvider
        ]);  
        
    }



    public function actionView($alias=null)
    {
        $post=$this->findPost($alias);
        $comment=$this->newComment($post);

        return $this->render('view',[
            'model'=>$post,
            'comment'=>$comment,
            //'msg'=>$msg,
        ]); 

        
    }


    public function actionAuthor($author)
    {
        $model=$this->findAuthot($author);

        $query = Post::find()->where(['post.type'=>Post::TYPE_BLOG,'post.status'=>Post::STATUS_PUBLISHED]); 
        $query->andWhere(['created_by'=>$model->id]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>21,
            ]
        ]);
        
        return $this->render('author',[
            'model'=>$model,
            'dataProvider'=>$dataProvider
        ]);  
        
    }

    public function actionTag($tag)
    {
        $query = Post::find()->where(['post.type'=>Post::TYPE_BLOG,'post.status'=>Post::STATUS_PUBLISHED]); 
        $query->andFilterWhere(['like', 'tags', $tag]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>21,
            ]
        ]);
        
        return $this->render('tag',[
            'tag'=>$tag,
            'dataProvider'=>$dataProvider
        ]);  
        
    }


    protected function newComment($post)
    {
        $comment=new PostComment;
        $comment->post_id=$post->id;

        if(!Yii::$app->user->isGuest){
            $comment->created_by=Yii::$app->user->identity->id;
            $comment->updated_by=Yii::$app->user->identity->id;
            $comment->author=Yii::$app->user->identity->fullName;
            $comment->email=Yii::$app->user->identity->email;
        }
        
        if ($comment->load(Yii::$app->request->post()) && $post->addComment($comment)){
            

            if($comment->status==PostComment::STATUS_PENDING)
                Yii::$app->session->setFlash('success',Yii::t('app','Thank you for your comment. Your comment will be posted once it is approved.'),false);
            $this->refresh('#respond');
            
        }
        
        return $comment;

    }

    

    /*========================================================
    //
    // Поиск моделей
    //
    ========================================================*/

    protected function findPost($alias)
    {
        if (($model = Post::findByAlias($alias)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findDestination($alias)
    {
        if (($model = Destination::findByAlias($alias)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAuthot($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

    
}
