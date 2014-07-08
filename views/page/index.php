<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
            'modelClass' => 'Page',
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin([
        'id'=>'grid-pajax'
    ]); ?>
    <?php echo GridView::widget([
        'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'title',
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'active',
                'vAlign'=>'middle',
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete} {active}',
                'buttons' => [
                    'active' => function ($url, $model) {
                        if ($model->active == true)
                        {
                            $icon = 'glyphicon-eye-open';
                        } else {
                            $icon = 'glyphicon-eye-close';
                        }

                        return Html::a('<span class="glyphicon ' . $icon . '"></span>', $url, [
                            'title' => Yii::t('app', 'Update'),
                            'data-pjax' => '0',
                        ]);
                    },                    
                ],
                //'viewOptions'=>['title'=> 'View', 'data-toggle'=>'tooltip'],
                //'updateOptions'=>['title'=> 'Update', 'data-toggle'=>'tooltip'],
                //'deleteOptions'=>['title'=> 'Delete', 'data-toggle'=>'tooltip'],
            ],
        ],
        'responsive' => true,
        'floatHeader' => true,
        'hover' => true
    ]);
    ?>
    <?php Pjax::end(); ?>

</div>