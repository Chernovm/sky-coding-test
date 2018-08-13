<?php

use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p><a class="btn btn-lg btn-success" href="index.php?r=site%2Fregistration">Straight ahead to registration</a></p>
    </div>

    <?= GridView::widget([
        'dataProvider' => $skyUsersProvider,
        'columns' => [
            'id',
            'firstname',
            'lastname',
            'patronymic',
            'email',
            'legal_body',
            'private_enterpreneur',
            'tax_number',
            'company_name'
        ],
    ]) ?>

</div>
