<?php

namespace FSM;

class FormControls {

    /**
     *  @param array $params
     *      date -- selected date
     *      field -- TODO
     *      month_field
     *      day_field
     *      year_field
     */
    public static function birthdate($params = array())
    {
        // selected value
        if ($params['date']) {
            $dob = explode('/', date('m/d/Y', strtotime($params['date'])));
            $dob_month = $dob[0];
            $dob_day = $dob[1];
            $dob_year = $dob[2];
        }
        $dob_month = $params['month_value'] ?: $dob_month;
        $dob_day = $params['day_value'] ?: $dob_day;
        $dob_year = $params['year_value'] ?: $dob_year;

        // field names
        $month_field = $params['month_field'] ?: 'birthdate_m';
        $day_field = $params['day_field'] ?: 'birthdate_d';
        $year_field = $params['year_field'] ?: 'birthdate_y';
?>
        <div class="birthdate">
            <select name="<?=$month_field?>" 
                <?=$params['required']?'required':''?>
                <?=$params['disabled']?'disabled':''?>
            >
                <option value="">Month</option>
<?php
            for ($i = 1; $i <= 12; $i++) {
                $m = str_pad($i, 2, "0", STR_PAD_LEFT);
                $month = date('F', strtotime("$i/1/1999"));
?>
                <option value="<?=$m?>"
<?php
                if ($m == $dob_month) {
?>
                    selected="selected"
<?php
                }
?>
                ><?=$month?></option>
<?php
            }
?>
            </select>
            <span class="date-divider">/</span>
            <select name="<?=$day_field?>"
                <?=$params['required']?'required':''?>
                <?=$params['disabled']?'disabled':''?>
            >
                <option value="">Day</option>
<?php
            for ($i = 1; $i <= 31; $i++) {
                $d = str_pad($i, 2, "0", STR_PAD_LEFT);
?>
                <option value="<?=$d?>"
<?php
                if ($d == $dob_day) {
?>
                    selected="selected"
<?php
                }
?>
                ><?=$d?></option>
<?php
            }
?>
            </select>
            <span class="date-divider">/</span>
            <select name="<?=$year_field?>"
                <?=$params['required']?'required':''?>
                <?=$params['disabled']?'disabled':''?>
            >
                <option value="">Year</option>
<?php
            for ($i = date('Y') - 16; $i >= date('Y') - 110; $i--) {
?>
                <option value="<?=$i?>"
<?php
                if ($i == $dob_year) {
?>
                    selected="selected"
<?php
                }
?>
                ><?=$i?></option>
<?php
            }
?>
            </select>
        </div>
<?php
    }



    /**
     *  @param array $params
     *      date -- selected date
     *      field
     *      month_field
     *      year_field
     */
    public static function monthYear($params = array())
    {
        // selected value
        if ($params['date']) {
            $date = explode('/', date('m/d/Y', strtotime($params['date'])));
            $date_month = $date[0];
            //$date_day = $date[1];
            $date_year = $date[2];
        }
        $date_month = $params['month_value'] ?: $date_month;
        $date_year = $params['year_value'] ?: $date_year;

        // field names
        $month_field = $params['month_field'] ?: $params['field'] . '_m';
        $year_field = $params['year_field'] ?: $params['field'] . '_y';
?>
        <div>
            <select name="<?=$month_field?>">
                <option value="">Month</option>
<?php
            for ($i = 1; $i <= 12; $i++) {
                $m = str_pad($i, 2, "0", STR_PAD_LEFT);
                $month = date('F', strtotime("$i/1/1999"));
?>
                <option value="<?=$m?>"
<?php
                if ($m == $date_month) {
?>
                    selected="selected"
<?php
                }
?>
                ><?=$month?></option>
<?php
            }
?>
            </select>
            <span class="date-divider">/</span>
            <select name="<?=$year_field?>">
                <option value="">Year</option>
<?php
            for ($i = date('Y'); $i >= date('Y') - 110; $i--) {
?>
                <option value="<?=$i?>"
<?php
                if ($i == $date_year) {
?>
                    selected="selected"
<?php
                }
?>
                ><?=$i?></option>
<?php
            }
?>
            </select>
        </div>
<?php
    }



    /**
     * @param array $params
     *      name -- the name of the select element
     *      class -- the class of the select element
     *      value -- the country code of the selected country
     */
    public static function country($params = array())
    {
        global $common_countries, $countries;

        $name = $params['name'] ?: 'country';
        $class = $params['class'] ?: '';
        $value = $params['value'] ?: '';

?>
        <div>
            <select
                name="<?=$name?>"
                class="<?=$class?>">
<?php
            foreach ($common_countries as $country_code => $country_name) {
?>
                <option value="<?=$country_code?>"
<?php
                if ($value == $country_code) {
?>
                    selected="selected"
<?php
                }
?>
                ><?=$country_name?></option>
<?php
            }
?>
                <option value="">-----</optiom>
<?php
            foreach ($countries as $country_code => $country_name) {
?>
                <option value="<?=$country_code?>"
<?php
                // don't mark it selected if it's already marked selected
                // in the short list at the top
                if ($value == $country_code && !$common_countries[$country_code]) {
?>
                    selected="selected"
<?php
                }
?>
                ><?=$country_name?></option>
<?php
            }
?>
            </select>
        </div>
<?php
    }


    /**
     *
     */
    public static function state($params = array())
    {
        $us_states = [
            'AK' => 'Alaska',
            'AL' => 'Alabama',
            'AR' => 'Arkansas',
            'AZ' => 'Arizona',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DC' => 'District of Columbia',
            'DE' => 'Delaware',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'GU' => 'Guam',
            'HI' => 'Hawaii',
            'IA' => 'Iowa',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'MA' => 'Massachusetts',
            'MD' => 'Maryland',
            'ME' => 'Maine',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MO' => 'Missouri',
            'MS' => 'Mississippi',
            'MT' => 'Montana',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'NE' => 'Nebraska',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NV' => 'Nevada',
            'NY' => 'New York',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'PR' => 'Puerto Rico',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VA' => 'Virginia',
            'VI' => 'Virgin Islands',
            'VT' => 'Vermont',
            'WA' => 'Washington',
            'WI' => 'Wisconsin',
            'WV' => 'West Virginia',
            'WY' => 'Wyoming',
            'AA' => 'Armed Forces (AA)',
            'AE' => 'Armed Forces (AE)',
            'AP' => 'Armed Forces (AP)'
        ];

        $name = $params['name'] ?: 'state';
        $value = $params['value'] ?: '';
?>
        <div>
            <select name="<?=$name?>"
                <?=$params['required']?'required':''?>
                <?=$params['disabled']?'disabled':''?>
            >
                <option value="">State</option>
<?php
            foreach ($us_states as $st => $us_state) {
?>
                <option value="<?=$st?>"
<?php
                if ($st == $value) {
?>
                    selected="selected"
<?php
                }
?>
                ><?=$st?></option>
<?php
            }
?>
            </select>
        </div>
<?php
    }


    /**
     *
     */
    public static function title($params = array())
    {
        global $person_titles;

        $name = $params['name'] ?: 'title';
        $value = $params['value'] ?: '';
?>
        <div>
            <select name="<?=$name?>">
                <option>Select</option>
<?php
            foreach ($person_titles as $title) {
?>
                <option value="<?=$title?>"
<?php
                if ($title == $value) {
?>
                    selected="selected"
<?php
                }
?>
                ><?=$title?></option>
<?php
            }
?>
            </select>
        </div>
<?php
    }

}
