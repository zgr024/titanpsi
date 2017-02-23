<?php

namespace FSM\Model;

class blog_post_article_detail extends \Sky\Model
{

    const AQL = "
	    blog_post_article_detail {
		
			blog_post_article_id,
			category,
			name,
			price,
			description,
			href,
			href_display,
			iorder,
			ht_left_bubble,
			ht_right_bubble,
			ht_left_bubble_top,
			ht_right_bubble_top,
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
        return \FSM\Misc::getList('blog_post_article_detail', $params);
    }


}
