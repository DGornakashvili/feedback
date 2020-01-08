<?php

use yii\web\View;
use common\models\Feedback;
use frontend\widgets\FeedbackForm;

/** @var View $this */
/** @var Feedback $model */

$this->title = 'Feedback';
?>

<div class="site-index">

    <?= FeedbackForm::widget(['model' => $model]); ?>

</div>
