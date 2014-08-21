<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use infoweb\pages\AppAsset;
AppAsset::register($this);

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
        'id'=>'grid-pjax'
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
                            'title' => Yii::t('app', 'Toggle active'),
                            'data-pjax' => '0',
                            'data-toggle-active' => $model->id,
                            'data-toggle' => 'tooltip',
                            //'data-placement' => 'left',
                        ]);
                    },
                ],
                'updateOptions'=>['title' => 'Update', 'data-toggle' => 'tooltip'],
                'deleteOptions'=>['title' => 'Delete', 'data-toggle' => 'tooltip'],
                'width' => '100px',
            ],
        ],
        'responsive' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => 88],
        'hover' => true,
    ]);
    ?>
    <?php Pjax::end(); ?>

</div>