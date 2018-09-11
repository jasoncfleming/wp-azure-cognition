<?php

class MSAT_PictureSubtitle
{
    /* Get the data from the API using the post_id */
    public static function msat_picture_subtitle_get_data( $post_id ) {
        $image_url = wp_get_attachment_url( $post_id, 'large' );
        $endpoint = get_option( MSAT_AccessibilityTools::MSAT_PICTURE_SUBTITLE_DESCRIBE_URL, 'https://westcentralus.api.cognitive.microsoft.com/vision/v1.0' );
        $endpoint_url = esc_url( trailingslashit( $endpoint ) . 'describe' );
        if ( !$api_key = get_option( MSAT_AccessibilityTools::MSAT_COMPUTER_VISION_API )) {
		  return false;
	    }
        
        if ( !$image_url ) {
            return false;
        } 
        
        $picture_specs = wp_remote_post(
            $endpoint_url, array(
                "body" => '{"url" : "' . $image_url . '"}',
                "headers" => array(
                    "Ocp-Apim-Subscription-Key" => get_option( MSAT_AccessibilityTools::MSAT_COMPUTER_VISION_API ),
                    'Content-Type' => 'application/json'
                ),
                "timeout" => 60
             )
        );
        return $picture_specs;
    }
    /* WP Hook on add attachment */
    public static function msat_picture_subtitle_wp_add_attachment_hook( $post_id, $errors = 0 ) {
        $result = MSAT_PictureSubtitle::msat_picture_subtitle_set_subtitle( $post_id );
        if ( is_wp_error($result) ) {
            if ($errors < 3) { /* Try more times (API's instabilities) */
                MSAT_PictureSubtitle::msat_picture_subtitle_wp_add_attachment_hook( $post_id, $errors ++ );
            } else {
                wp_die("Failed to send photo. Please try again.");
            }
        }
    }

    /* Generate the Subtitle */
    public static function msat_picture_subtitle_set_subtitle( $post_id ) {
        $confidence = get_option( MSAT_AccessibilityTools::MSAT_CONFIDENCE ) / 100;
        /* Don't override the actual alt */

        if (get_post_meta($post_id, '_wp_attachment_image_alt', true) != "") {
            update_post_meta( $post_id, MSAT_AccessibilityTools::MSAT_POST_META_OPTIMIZED, MSAT_AccessibilityTools::MSAT_OPTIMIZED_STATUS_EXISTS );
        } else {
            $picture_specs = MSAT_PictureSubtitle::msat_picture_subtitle_get_data( $post_id );
            if ( is_wp_error( $picture_specs ) ) {
                return false;
            } else {
                $picture_specs = json_decode( $picture_specs["body"] );
                if ( round( $picture_specs->description->captions[0]->confidence, 2 ) >= $confidence) {
                    $legend = $picture_specs->description->captions[0]->text;
                    $args = array( 
                        'ID'           => $post_id, 
                        'post_title'   => $legend
                    );
                    wp_update_post( $args );
                    update_post_meta( $post_id, '_wp_attachment_image_alt', $legend );
                }
            }

            update_post_meta( $post_id, MSAT_AccessibilityTools::MSAT_POST_META_OPTIMIZED, MSAT_AccessibilityTools::MSAT_OPTIMIZED_STATUS_OK );
        }
    
        return $post_id;
    }
    
    /* Call the next image to optimize (used in bulk optimization) */
    public static function msat_bulk_optimize_images() {
        global $wpdb;
        $image_id = 0;
        $return_id = 0;
        $error = false;
        $finished = false;
        
        $bulk_images = get_posts( array(
            'post_type' => 'attachment',
            'posts_per_page' => 1,
            'post_mime_type' =>'image',
            'meta_query' => array(
                array(
                    'key' => MSAT_AccessibilityTools::MSAT_POST_META_OPTIMIZED,
                    'compare' => 'NOT EXISTS'
                )
            )
        ) );
    
        if (is_array($bulk_images) && count($bulk_images) > 0) {
            foreach ($bulk_images as $image) {
                $image_id = $image->ID;
                $return_id = MSAT_PictureSubtitle::msat_picture_subtitle_set_subtitle( $image_id );
                if ($return_id == 0 || $return_id === false) {
                    $error = true;
                }
            }
        } else {
            $finished = true;
        }

        header('Content-Type: application/json');

        echo json_encode( array(
            "id" => $image_id,
            "error" => $error,
            "finished" => $finished
        ) );

        wp_die();
    }
}
