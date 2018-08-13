<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\RegistrationAsset;
use yii\bootstrap\Alert;

RegistrationAsset::register($this);

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-registration">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        echo Alert::widget([
            'options' => [
                'class' => (empty($message) ? 'alert-info' : 'alert-success'),
            ],
            'body' => (empty($message) ? 'Please fill out the following fields to register new sky-user:' : $message),
        ]);
    ?>
    <!-- <p></p> -->

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-register']); ?>

                <?= $form->field($model, 'legal_body')->DropDownList(['0' => 'No', '1' => 'Yes']) ?>
                
                <?= $form->field($model, 'private_enterpreneur')->DropDownList(['0' => 'No', '1' => 'Yes']) ?>

                <?= $form->field($model, 'firstname')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'lastname') ?>

                <?= $form->field($model, 'patronymic') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'tax_number') ?>

                <?= $form->field($model, 'company_name') ?>

                <div class="form-group">
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
