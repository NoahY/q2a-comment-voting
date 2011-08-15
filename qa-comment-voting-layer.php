<?php

	class qa_html_theme_layer extends qa_html_theme_base {

		function option_default($option) {
			
			switch($option) {
				default:
					return false;
			}
			
		}

	// theme replacement functions

		function c_item_main($c_item)
		{
			$this->output('<div class="comment-vote-container">▲<br/>⚑</div>');
			qa_html_theme_base::c_item_main($c_item);
		}
	}

