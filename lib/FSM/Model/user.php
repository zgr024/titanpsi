<?php

namespace FSM\Model;

class user extends \Sky\Model
{

    const AQL = "
       admin {
		   [person],
		   access_group,
		   person_id,
		   status,
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
     * DELETE A USER
    */
	public function delete() {
		
		return $this->update(['active'=>0]);
				
	}


    /**
     * 
     */
    public static function getList($params) 
    {
        return \FSM\Misc::getList('admin', $params);
    }


}
