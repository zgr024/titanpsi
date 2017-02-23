<?php

namespace FSM\Model;

class blog_post_votes extends \Sky\Model
{

    const AQL = "
       blog_post_votes {
		
			[blog_post] as post,
			blog_post_id,
			type,
			west,
			southwest,
			midwest,
			northeast,
			southeast,
			insert_time,
			update_time,
			mod__person_id,
			active
				
	   }
    ";


    /**
     *
    */
    public static $_meta = [

        'requiredFields' => [
            #'field' => 'Field',
        ],

        'cachedLists' => [
            #'foreign_table_id',
        ],

        'readOnlyProperties' => [
            #'property_name',
        ],

        'readOnlyTables' => [
            #'table',
        ],

        'possibleErrors' => [

            'my_error_code' => [
                'message' => 'My Error Message',
                'fields' => ['field']
            ]

        ]
    ];


    /**
     * 
     */
    public static function getList($params) 
    {
        return \FSM\Misc::getList('blog_post_votes', $params);
    }


}
