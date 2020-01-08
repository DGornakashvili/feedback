<?php

namespace frontend\widgets;

use common\models\Feedback;
use yii\base\Exception;
use yii\base\Widget;

/**
 * Class FeedbackForm
 * @package frontend\widgets
 */
class FeedbackForm extends Widget
{
    /** @var Feedback $model */
    public $model;

    /**
     * Displays feedback form
     *
     * @return string
     * @throws Exception
     */
    public function run()
    {
        if (is_a($this->model, Feedback::class)) {
            return $this->render('feedbackForm', ['model' => $this->model]);
        }

        throw new Exception('Error: Valid Model is - ' . Feedback::class);
    }
}