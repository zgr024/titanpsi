<?php

namespace FSM;

class Api extends \Sky\Api
{

    /**
     *  API resources defined by
     *
     *      resource => [       # /api/v1/resource
     *          class => ,      # \My\Api\ClassName
     *          alias =>,       # (optional)
     *          singluar =>     # (optional)
     *      ]
     *
     *  @var array
     */
    public static $resources = [

        'memebers' => [
            'class' => '\FSM\Api\Member'
        ]

    ];


    /**
     *
     */
    public static $documentation_settings = [
        // 'oauth_token' => 'mytoken',
        // 'sampleID' => 1
    ];


    /**
     *
     */
    public static $url = [
        'protocol' => 'https',
        'domain' => 'flirtskirtormarry.com',
        'url' => '/api/v1'
    ];

}
