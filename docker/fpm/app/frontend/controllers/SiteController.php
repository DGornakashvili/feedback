<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Feedback;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Displays index page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'model' => new Feedback(),
        ]);
    }

    /**
     * Saves feedback
     */
    public function actionSave()
    {
        $model = new Feedback();

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Обращение сохранено');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка сохранения');
            }
        }

        $this->redirect(Yii::$app->request->referrer);
    }
}
