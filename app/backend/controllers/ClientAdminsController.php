<?php

namespace backend\controllers;

use Yii;
use backend\models\ClientAdmins;
use backend\models\ClientAdminsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\libraries\RBAC;
use backend\libraries\Notify;
use yii\filters\AccessControl;
use backend\libraries\Commons;
use backend\libraries\Statuses;

/**
 * ClientAdminsController implements the CRUD actions for ClientAdmins model.
 */
class ClientAdminsController extends Controller
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
     * Lists all ClientAdmins models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!RBAC::can(RBAC::manage_clientadmins)){throw new NotFoundHttpException(Notify::access_message);}

        $searchModel = new ClientAdminsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClientAdmins model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(!RBAC::can(RBAC::manage_clientadmins)){throw new NotFoundHttpException(Notify::access_message);}
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ClientAdmins model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!RBAC::can(RBAC::manage_clientadmins)){throw new NotFoundHttpException(Notify::access_message);}
        $model = new ClientAdmins();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }


        // if(!RBAC::can(RBAC::manage_members)){throw new NotFoundHttpException(Notify::access_message);}
        // $model = new Members();
        // $posted_data = Yii::$app->request->post();

        // $phone = $posted_data;

        // if($phone==NULL)
        // {
        //     // Set session
        //     Yii::$app->session->setFlash('error', 'Invalid Phone number '.(string)$phone);
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        //     exit;
        // }

        if ($model->load(Yii::$app->request->post()) ) {

            // Create MEMBER Wallet account 
            $model->password_hash = Commons::hashString($model->email);
            $model->password_reset_token = Commons::hashString($model->email.$model->msisdn);
            $model->save();# Save

            Yii::$app->session->setFlash('success', 'Successfully created admin member account - '.$model->msisdn);

            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ClientAdmins model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(!RBAC::can(RBAC::manage_clientadmins)){throw new NotFoundHttpException(Notify::access_message);}
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ClientAdmins model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     *
    public function actionDelete($id)
    {
        if(!RBAC::can(RBAC::manage_clientadmins)){throw new NotFoundHttpException(Notify::access_message);}
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    */

    /**
     * Finds the ClientAdmins model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClientAdmins the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClientAdmins::findOne($id)) !== null) {
            return $model;
        }

        /*
        Boilerplate
        if(Yii::$app->user->identity->client_id != RBAC::super_client)//If client not equal to super
        {
            if (($model = ClientAdmins::find()->where('client_id='.Yii::$app->user->identity->client_id.' or client_id IN (SELECT id FROM clients where parent_id='.Yii::$app->user->identity->client_id.') and id ='.$id)->one() !== null)) {
                $model = ClientAdmins::find()->where('client_id='.Yii::$app->user->identity->client_id.' or client_id IN (SELECT id FROM clients where parent_id='.Yii::$app->user->identity->client_id.') and id ='.$id)->one();
                return $model;
            }
        }else{
                if (($model = ClientAdmins::findOne($id)) !== null) {
                    $model = ClientAdmins::findOne($id);
                    return $model;
                }
               
            }

        
        */

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
