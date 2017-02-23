<?php

namespace FSM\Model;

class blog_post_comment extends \Sky\Model
{

    const AQL = "
       blog_post_comment {
		
			[blog_post] as post,
			blog_post_id,
			fb_uid,
			twit_uid,
			google_uid,
			photo_uri,
			full_name,
			email,
			website,
			message,
			category,
			status,
			insert_time,
			update_time,
			mod__person_id,
			active			

	   }
    ";

	
	/**
     * DELETE A COMMENT
    */
	public function delete() {
		
		return $this->update(['status'=>3]);
				
	}


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
        return \FSM\Misc::getList('blog_post_comment', $params);
    }


}
