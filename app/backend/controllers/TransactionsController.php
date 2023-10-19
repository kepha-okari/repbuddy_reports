<?php

namespace backend\controllers;

use Yii;
use backend\models\Transactions;
use backend\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\libraries\RBAC;
use backend\libraries\Notify;
use yii\filters\AccessControl;
use backend\libraries\Commons;
use backend\libraries\Statuses;

/**
 * TransactionsController implements the CRUD actions for Transactions model.
 */
class TransactionsController extends Controller
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
     * Lists all Transactions models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!RBAC::can(RBAC::manage_transactions)){throw new NotFoundHttpException(Notify::access_message);}

        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transactions model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(!RBAC::can(RBAC::manage_transactions)){throw new NotFoundHttpException(Notify::access_message);}
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transactions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!RBAC::can(RBAC::manage_transactions)){throw new NotFoundHttpException(Notify::access_message);}
        $model = new Transactions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Transactions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(!RBAC::can(RBAC::manage_transactions)){throw new NotFoundHttpException(Notify::access_message);}
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Transactions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     *
    public function actionDelete($id)
    {
        if(!RBAC::can(RBAC::manage_transactions)){throw new NotFoundHttpException(Notify::access_message);}
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    */

    /**
     * Finds the Transactions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transactions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transactions::findOne($id)) !== null) {
            return $model;
        }

        /*
        Boilerplate
        if(Yii::$app->user->identity->client_id != RBAC::super_client)//If client not equal to super
        {
            if (($model = Transactions::find()->where('client_id='.Yii::$app->user->identity->client_id.' or client_id IN (SELECT id FROM clients where parent_id='.Yii::$app->user->identity->client_id.') and id ='.$id)->one() !== null)) {
                $model = Transactions::find()->where('client_id='.Yii::$app->user->identity->client_id.' or client_id IN (SELECT id FROM clients where parent_id='.Yii::$app->user->identity->client_id.') and id ='.$id)->one();
                return $model;
            }
        }else{
                if (($model = Transactions::findOne($id)) !== null) {
                    $model = Transactions::findOne($id);
                    return $model;
                }
               
            }

        
        */

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
