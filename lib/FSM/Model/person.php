<?php

namespace FSM\Model;

class person extends \Sky\Model\person
{

    const AQL = "
        person {
			username,
			fname,
			lname,
			middle,
			full_name,
			title,
			phone,
			mobile,
			email,
			address,
			address2,
			city,
			state,
			zip,
			birthdate,
			status,
			password,
			password_hash,
			last_login_time,
			ip_address,
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
        return \FSM\Misc::getList('person', $params);
    }
	
	
    /**
     * Get the user associated with this person_id
     */
    public function getUser()
    {
        if (!$this->id) {
            return null;
        }
        return user::getOne([
            'where' => "admin.person_id = " . $this->id
        ]);
    }
	
}
