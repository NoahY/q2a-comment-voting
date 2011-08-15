<?php

	class qa_html_theme_layer extends qa_html_theme_base {

		function option_default($option) {
			
			switch($option) {
				default:
					return false;
			}
			
		}
		function head_script() {
			qa_html_theme_base::head_script();
			$this->output("
<script>
	function ajaxCommentVote(elem, oldvote)
	{
		var ens=elem.name.split('_');
		var postid=ens[1];
		var vote=parseInt(ens[2]);
		var anchor=ens[3];
		qa_ajax_post(
			'vote', 
			{postid:postid, vote:vote},
			function(lines) {
				if (lines[0]=='1') {
					document.getElementById('voting_'+postid).innerHTML=lines[1]);
				} else if (lines[0]=='0') {
					var mess=document.getElementById('errorbox');
					if (!mess) {
						var mess=document.createElement('div');
						mess.id='errorbox';
						mess.className='qa-error';
						mess.innerHTML=lines[1];
					}
					var postelem=document.getElementById(anchor);
					postelem.parentNode.insertBefore(mess, postelem);
				} else {
					alert('Unexpected response from server - please try again.');
				}
			}
		);
		return false;
	} 	
</script>");
		}
		function head_custom() {
			qa_html_theme_base::head_custom();
			$this->output('
<style>
	.comment-vote-container {
		float: left;
		margin-right: 6px;
		color: silver;
	}
	.comment-vote-item:hover {
		color:black;
		cusor:pointer
	}
	.comment-vote-item-selected {
		color:orange;
		cusor:pointer
	}
</style>');

		}

	// theme replacement functions

		function c_item_main($c_item)
		{
			$vote=0;
			$flag=0;
			foreach($comment_votes as $vote) {
				if($vote['postid'] == $c_item['raw']['postid']) {
					$vote = $vote['vote'];
					break;
				}
			}
			$this->output('<div class="comment-vote-container"><span class="comment-vote-item'.($vote==1?'-selected':'').'" name="vote_'.$c_item['raw']['postid'].'_1_c'.$c_item['raw']['postid'].'" onclick="ajaxCommentVote(this);">▲</span><br/><span id="voting_'.$c_item['raw']['postid'].'">'.($c_item['raw']['netvotes']!=0?$c_item['raw']['netvotes']:'').'"</span><br/><span class="comment-vote-item'.($vote==-1?'-selected':'').'" onclick="ajaxCommentVote(this);" name="vote_'.$c_item['raw']['postid'].'_-1_c'.$c_item['raw']['postid'].'">▼</span></div>');
			qa_html_theme_base::c_item_main($c_item);
		}

	// db variable
	
	var $logged_in_userid = qa_get_logged_in_userid();
	
	var $comment_votes = ($logged_in_userid
		?qa_db_read_all_assoc(
			qa_db_query_sub(
				'SELECT ^uservotes.vote AS vote, ^uservotes.postid AS postid  FROM ^posts,^uservotes WHERE ^uservotes.vote<>0 AND ^uservotes.userid=# AND ^uservotes.postid=^posts.postid AND ^posts.type=$',
				$logged_in_userid, 'C'
			)
		)
		:null
	);


	}

