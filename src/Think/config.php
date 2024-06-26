<?php
    //将该文件拷贝到项目配置目录下
    return [
        /*
        |--------------------------------------------------------------------------
        | 企业ID
        |--------------------------------------------------------------------------
        |
        | 每个企业都拥有唯一的corpid，获取此信息可在管理后台“我的企业”－“企业信息”下查看“企业ID”（需要有管理员权限）。
        |
        */

        'corp_id' => 'xxxxxxxxxxxxxxxxx',

        /*
        |--------------------------------------------------------------------------
        | 默认应用
        |--------------------------------------------------------------------------
        |
        | 定义默认使用的应用。
        |
        */

        'default' => 'contacts',

        /*
        |--------------------------------------------------------------------------
        | 应用列表
        |--------------------------------------------------------------------------
        |
        | 定义应用列表，如果某个应用的某些配置用不到或者不存在，可以不定义。
        |
        */

        'agents' => [
            'contacts' => [
                'agent_id' => 0,
                'secret' => 'xxxxxxxxxxxxxxxxx',
                'token' => 'xxxxxxxxxxxxxxxxx',
                'aes_key' => 'xxxxxxxxxxxxxxxxx',
            ],

            //...
        ],
    ];

