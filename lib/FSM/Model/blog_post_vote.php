<?php

namespace FSM\Model;

class blog_post_vote extends \Sky\Model
{

    const AQL = "
       blog_post_vote {
		
			[blog_post] as post,
			blog_post_id,
			title,
			location,
			vote,
			ip_address,
			lat,
			lng,
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
        return \FSM\Misc::getList('blog_post_vote', $params);
    }
	
	public static function getLastID() {		
		$rs = sql_array("SELECT max(id) as id FROM blog_post_vote");
		$id = $rs[0]['id']?$rs[0]['id']:0;
		return $id;
	}

}