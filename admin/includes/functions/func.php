<?php

    // function title to get title Name

    function title(){
        GLOBAL $title;
        if (isset($title)){
            echo $title;
        } else {
            echo 'Furniture';
        }
    }


    // function time_ago for date

    function time_ago($timestamp){

        $time_ago = strtotime($timestamp);
        $current_time = time();
        $time_difference = $current_time - $time_ago;
        $seconds = $time_difference;
        $minutes = round($seconds / 60 );           // Value 60 is seconds
        $hours   = round($seconds / 3600);          // Value 3600 is 60 minutes * 60 seconds
        $days    = round($seconds / 86400);         // Value 86400 is 24 hours * 60 minutes * 60 seconds
        $weeks   = round($seconds / 604800);        // Value 604800 is 7 days * 24 hours * 60 minutes * 60 seconds
        $month   = round($seconds / 2629440);       // Value 2629440 is ((365 + 365 + 365 + 365 + 266) / 5 / 12) * 24 hours * 60 minutes * 60 seconds
        $years   = round($seconds / 31553280);      // Value 31553280 is (365 + 365 + 365 + 365 + 266) / 5 * 24 hours * 60 minutes * 60 seconds

        if ($seconds <= 60){

            return 'Just Now';

        } elseif ($minutes <= 60){

            if ($minutes == 1){
                return 'one minute ago';
            } else{
                return $minutes . 'minutes ago';
            }

        } elseif ($hours <= 24){

            if ($hours == 1){
                return 'one hour ago';
            } else {
                return 'about ' . $hours . ' hours ago';
            }

        } elseif ($days <= 7){
            if ($days == 1){
                return 'one day ago';
            } else {
                return 'about ' . $days . ' days ago';
            }
        } elseif ($weeks <= 4.3) {
            if ($weeks == 1){
                return 'a week ago';
            } else {
                return 'about ' .$weeks . ' weeks ago';
            }
        } elseif ($month <= 12){
                if ($month == 1){
                    return 'about month ago';
                } else{
                    return 'about ' . $month . ' months ago';
                }
        } else {
            if ($years == 1){
                return 'one year ago';
            } else {
                return 'about ' . $years . ' years ago';
            }
        }
    }


