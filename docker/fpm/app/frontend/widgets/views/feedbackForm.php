<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use common\models\Feedback;

/** @var View $this */
/** @var Feedback $model */

$this->title = 'Feedback';
?>
<div class="row">
    <div class="col-lg-7">
        <?php
        $fbForm = ActiveForm::begin([
            'id' => 'feedback-form',
            'action' => Url::to(['/site/save']),
        ]);

        echo $fbForm->field($model, 'name')
            ->input('string', ['placeholder' => 'Enter your name']);

        echo $fbForm->field($model, 'phone')
            ->input('string', ['placeholder' => '+7(999)999-99-99']);
        ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']); ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
