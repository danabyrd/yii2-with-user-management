<?php
return [
    'id' => 'app-common-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        /* Next block is Yii v2.0.13 default
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
        ],
        */
        /* The two items below must be commented out to enable superadmin logon 
         * when yii2-user-management extension is installed
         */        
        'user' => [
            //'class' => 'yii\web\User',
            //'identityClass' => 'common\models\User',
        ],          
        
    ],
];
