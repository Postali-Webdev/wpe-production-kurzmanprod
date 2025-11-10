<?php
require('../../..' . '/wp-config.php');
$wp->init();
$wp->parse_request();
$wp->query_posts();
$wp->register_globals();

global $wp_query;

$word = preg_replace("/[^A-Za-z0-9]/", " ", $_GET['word']);
$search_type = $_GET['search_type'];

$html = '';
$html .= '<li class="result">';
$html .= '<a href="urlString">';
$html .= '<div class="attorney-info">';
$html .= '<h3 id="searchResults">nameString</h3>';
$html .= '</div>';
$html .= '</a>';
$html .= '</li>';


// Check Length More Than One Character
if (strlen($word) >= 1 && $word !== ' ') {


    $sql = 'SELECT attorneypost.post_title as attorney_name,lastName.meta_value as attorney_last_name, attorneypost.guid as attorney_guid,  attorneypost.post_name as attorney_info 
            FROM wp_posts attorneypost 
            JOIN wp_postmeta lastName on lastName.meta_key="last_name" and attorneypost.ID = lastName.post_id  
            WHERE attorneypost.post_title like "%' . $word . '%"
            AND attorneypost.post_status ="publish"
            ORDER BY attorney_last_name ASC';

    $result = $wpdb->get_results($sql);
    if (count($result) > 0) {
        foreach ($result as $row) {
            // Format Output Strings And Hightlight Matches
            $display_name = preg_replace("/" . $word . "/i", "<b class='highlight'>" . $word . "</b>", $row->attorney_name);
            $display_url =  '/our-attorneys/'.$row->attorney_info.'/';

            // Insert Name
            $output = str_replace('nameString', $display_name, $html);

            // Insert URL
            $output = str_replace('urlString', $display_url, $output);

            // Output
            echo $output;
        }
    } else {

        $output = str_replace('urlString', '/our-attorneys/', $html);
        $output = str_replace('nameString', '<span><strong>Sorry, no results were found.</strong></span><span class="underline">Please click here to see all Kurzman Eisenberg attorneys.</span>', $output);
        $output = str_replace('functionString', '<em>Please search again</em>', $output);

        // Output
        echo $output;
        $wpdb->close();
    }

}

?>