<?php

namespace backend\controllers;

use Yii;
use backend\models\Accounts;
use backend\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\libraries\RBAC;
use backend\libraries\Notify;
use yii\filters\AccessControl;
use backend\libraries\Commons;
use backend\libraries\Statuses;

/**
 * AccountsController implements the CRUD actions for Accounts model.
 */
class AccountsController extends Controller
{
    public $layout = 'main_g_inside';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create','view','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Accounts models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!RBAC::can(RBAC::manage_accounts)){throw new NotFoundHttpException(Notify::access_message);}

        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Accounts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(!RBAC::can(RBAC::manage_accounts)){throw new NotFoundHttpException(Notify::access_message);}
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Accounts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!RBAC::can(RBAC::manage_accounts)){throw new NotFoundHttpException(Notify::access_message);}
        $model = new Accounts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Accounts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(!RBAC::can(RBAC::manage_accounts)){throw new NotFoundHttpException(Notify::access_message);}
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Accounts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     *
    public function actionDelete($id)
    {
        if(!RBAC::can(RBAC::manage_accounts)){throw new NotFoundHttpException(Notify::access_message);}
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    */

    /**
     * Finds the Accounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Accounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Accounts::findOne($id)) !== null) {
            return $model;
        }

        /*
        Boilerplate
        if(Yii::$app->user->identity->client_id != RBAC::super_client)//If client not equal to super
        {
            if (($model = Accounts::find()->where('client_id='.Yii::$app->user->identity->client_id.' or client_id IN (SELECT id FROM clients where parent_id='.Yii::$app->user->identity->client_id.') and id ='.$id)->one() !== null)) {
                $model = Accounts::find()->where('client_id='.Yii::$app->user->identity->client_id.' or client_id IN (SELECT id FROM clients where parent_id='.Yii::$app->user->identity->client_id.') and id ='.$id)->one();
                return $model;
            }
        }else{
                if (($model = Accounts::findOne($id)) !== null) {
                    $model = Accounts::findOne($id);
                    return $model;
                }
               
            }

        
        */

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
