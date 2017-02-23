<?php

namespace FSM\Model;

class blog_post extends \Sky\Model
{

    const AQL = "
       blog_post {
		
			[blog_post_article]s as articles,
			[blog_post_comment]s as comments,
			[blog_post_votes]s as total_votes,
			[blog_post_vote]s as votes,
			title,
			slug,
			meta_keywords,
			shopping_keywords,
			final_keywords,
			meta_description,
			shopping_description,
			final_description,
			category,
			description,
			other_category_name,
			tagline,
			preview,
			body,
			href,
			status,
			published_time,
			post_datetime,
			featured,
			insert_time,
			update_time,
			mod__person_id,
			active			

	   }

	   person on person.id = blog_post.mod__person_id {
		   fname as posted_by_fname,
		   full_name as posted_by_full,
		   email as posted_by_email
	   }
    ";

	
	/**
     * DELETE A POST
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
        return \FSM\Misc::getList('blog_post', $params);
    }

	/**
     * 
     */
	public function setVote ($data) {
		
		$data['blog_post_id'] = $this->id;
		$data['title'] = $this->title;
		$bpv = new blog_post_vote($data);
		$bpv->save();
		 
	}
}
