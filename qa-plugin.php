<?php
        
/*              
        Plugin Name: Comment Voting
        Plugin URI: https://github.com/NoahY/q2a-comment-voting
        Plugin Description: Vote on comments
        Plugin Version: 0.1
        Plugin Date: 2011-08-15
        Plugin Author: NoahY
        Plugin Author URI:                              
        Plugin License: GPLv2                           
        Plugin Minimum Question2Answer Version: 1.3
*/                      
                        
                        
        if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
                        header('Location: ../../');
                        exit;   
        }               

        qa_register_plugin_module('module', 'qa-comment-voting-admin.php', 'qa_comment_voting_admin', 'Comment Voting Admin');
        
        qa_register_plugin_layer('qa-comment-voting-layer.php', 'Comment Voting Layer');
                        
                        
/*                              
        Omit PHP closing tag to help avoid accidental output
*/                              
                          

