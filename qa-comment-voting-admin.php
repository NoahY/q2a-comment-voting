<?php
    class qa_comment_voting_admin {

        function option_default($option) {
            
            switch($option) {
                default:
                    return false;
            }
            
        }
        
        function allow_template($template)
        {
            return ($template!='admin');
        }       
            
        function admin_form(&$qa_content)
        {                       
                            
        // Process form input
            
            $ok = null;
            
            if (qa_clicked('comment_voting_save')) {
                qa_opt('voting_on_cs',(bool)qa_post_text('voting_on_cs'));
                $ok = 'Settings Saved.';
            }
            
                    
        // Create the form for display

            
            $fields = array();
            
            $fields[] = array(
                'label' => 'Enable comment voting',
                'tags' => 'NAME="voting_on_cs"',
                'value' => qa_opt('voting_on_cs'),
                'type' => 'checkbox',
            );

            return array(           
                'ok' => ($ok && !isset($error)) ? $ok : null,
                    
                'fields' => $fields,
             
                'buttons' => array(
                    array(
                        'label' => 'Save',
                        'tags' => 'NAME="comment_voting_save"',
                    )
                ),
            );
        }
    }

