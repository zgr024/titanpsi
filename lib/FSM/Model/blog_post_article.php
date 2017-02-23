<?php

namespace FSM\Model;

class blog_post_article extends \Sky\Model
{

    const AQL = "
	    blog_post_article {
		
			[blog_post_article_detail]s as details,
			blog_post_id,
			img_src,
			category,
			iorder,
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
        return \FSM\Misc::getList('blog_post_article', $params);
    }


}
