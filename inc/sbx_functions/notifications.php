<?php

/**
 * SBX Starter Theme - Notification functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SBX_Starter_Theme
 */


/**
 * Send PHP errors to SBX Slack channel via webhooks
 * 
 * @hook init
 * @hooked sbx_wp_fatal_alert
 * @param int $error_level Minimum error level to report
 * @return void
 * @see https://www.php.net/manual/en/function.error-reporting.php
 * @package SBX_Starter_Theme
 */


/**
 * Show PHP errors during development and hide during production 
 */
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

if ($_ENV['PROJECT_ENV'] == 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


// Register action on the WP 'init' hook so that it executes on page load.
add_action('init', 'sbx_wp_fatal_alert');

// Register function with PHP so that it executes when there's a fatal error.
register_shutdown_function('sbx_wp_fatal_alert');

/**
 * To avoid spam posts on Slack during development,
 * disable the two actions above and use the normal PHP error reporting methods below,
 * then do the opposite during production deployment.
 */

function sbx_wp_fatal_alert()
{
    // Set a default error reporting level if non specified
    $error_level = 8;

    // 1. Check if errors
    // 2. Get the last error its reporting level is at most the specified reporting level
    // 3. Create a Slack post for the error
    // 4. Send the post to Slack
    // 5. Clear the last error

    $error = error_get_last();
    if ($error && $error['type'] <= $error_level) {

        // Create Slack error post
        $slack_post = sbx_create_slack_error_post($error);

        // Send error message to Slack
        sbx_send_slack_post_webhook($slack_post);

        // Clear the last error 
        error_clear_last();
    }
}

function sbx_create_slack_error_post(array $error)
{
    // Get error message data
    $error_message  = 'Error type: ' . substr(json_encode($error['type']), 1, -1) . '\n';
    $error_message .= 'Error message: ' . substr(json_encode($error['message']), 1, -1) . '\n';
    $error_message .= 'Error location: in ' . substr(json_encode($error['file']), 1, -1);
    $error_message .= ' on line ' . substr(json_encode($error['line']), 1, -1) . '\n';

    // Get site data
    $site_url = get_site_url(); // Escaped site URL
    $login_url = wp_login_url(); // Site Login URL
    $site_name = get_bloginfo('name'); // Site Name

    // Set Slack post title and color
    switch ($error['type']) {
        case 1:
            $title = 'Fatal runtime error on ' . $site_name . '\n';
            $color = '#D00000';
            break;

        case 2:
            $title = 'Non-fatal runtime error on ' . $site_name . '\n';
            $color = '#ffc400';
            break;

        case 8:
            $title = 'Runtime notice on ' . $site_name . '\n';
            $color = '#00e5ff';
            break;

        default:
            $title = 'There might be an error on ' . $site_name . '\n';
            $color = '#000000';
            break;
    }

    // Slack post message
    $message = $error_message;
    $message .= 'Visit <' . $site_url . '|' . $site_name . '>\n';
    $message .= 'Login to <' . $login_url . '|' . $site_name . '>\n';


    // Create Slack post object 
    $slack_post = new stdClass();
    $slack_post->title = $title;
    $slack_post->message = $message;
    $slack_post->color = $color;

    // Return Slack post object
    return $slack_post;
};

function sbx_send_slack_post_webhook(
    object $slack_post,
    string $webhook_url = "https://hooks.slack.com/services/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" // Default SBX Slack Webhook
) {

    // Get post data
    $title = $slack_post->title;
    $message = $slack_post->message;
    $color = $slack_post->color;

    // Set JSON post fields from $slack_post
    $post = [
        'payload' =>
        '{
            "attachments":[
                {
                    "fallback":"' . $title . ': ' . $message . '",
                    "color":"' . $color . '",
                    "fields": [
                        {
                        "title":"' . $title . '",
                        "value":"' . $message . '"
                        }
                    ]
                }
            ]
                
        }'
    ];

    // Initiate CURL
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Warning: Only enable during development (usually on Windows PCs)

    // Execute
    $response = curl_exec($ch);

    // Close the connection, release resources used
    curl_close($ch);

    // Response
    // var_dump($response); // Warning: Only enable during development
}
