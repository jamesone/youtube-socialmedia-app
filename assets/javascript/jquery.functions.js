var loaded=false;
$(document).ready(function() {
	loaded=true;
	var catSection = $('.cat-wrap').clone();
	var chosenCatFormat = $('.chosen-format').clone();
	//Categories array:
	selectValues = new Array();

	$('.show-hide-cats').click(function(){
		$('.cat-wrap').toggle();
		$(this).text();
	});
	$('.show-hide-cats').bind('click', function() {
    	$(this).html($(this).html() == 'Hide categories' ? 'Show categories' : 'Hide categories');
	});

	// //Variables:
	// var embedCode = $('.video_embed').val();
	// var userID = $('.video_user').val();
	// console.log("0");

	// $('.btn-share-vid').click(function(e) {
	// 	e.preventDefault();
	// 	status_details ="hi";
	// 	// var status_details = $('.txtShareVidStatus').text();

	// 	// if(status_details == ""){
	// 	// 	status_details = "null";
	// 	// }
	// 	// console.log("1");
	// 	//insertPost($staticTestUser, $post_details, $showVideos);
	// 	$.ajax({
	// 		    type: "POST",
	// 		    url: "../dal/ajax.php",
	// 		    data:{ user : userID, post_details: status_details, video_embed: embedCode},
	// 		    success: function(data){
	// 		        $('.share-wrap').append("<div class='success'>Shared to your wall</div>");
	// 		    }

	// 		});
	// 	console.log("3");


	// });

	$('#search-show').click(function() {
		$('.search-bar').slideToggle('fast');
	});
	$('.cat-chooser .cat-item:first-child').hover(function() {
		$(this).next('.sub-cats-wrap').fadeIn();
	});
	//Variables for the below .cat-item function()
	
	first = true;
	
	$('.cat-item').click(function() {
		var missLoop = false;

		//Works on getting all li's checked
		if($(this).has('title')){
			$(this).next('.sub-cats-wrap').find('li').addClass('clicked');
		}
		// if(!$(this).attr('title', "checked")){
		// 		$(this).next('.sub-cats-wrap').find('li').addClass('clicked');
		// 	}else{
		// 		$(this).next('.sub-cats-wrap').find('li').removeClass('clicked');
		// 	}
		
				//If first click don't run
				if(first == false){
					//Check to see if the item has been clicked
					for(var i=0;i<selectValues.length;i++){
						if($(this).text() == selectValues[i]){
							selectValues.splice(i, 1);
							missLoop=true;
						}
					}
				}
				//If a value has been removed, don't push to array.
				if(!missLoop){
					selectValues.push($(this).text());
				}

			first=false;

		$(this).toggleClass('clicked');
		showCats();
	});

	function showCats(){
		var cat_span="";
		if(selectValues.length != 0){
			for(var i=0; i<selectValues.length; i++){
				cat_span += '<span class="chosen-format">'+selectValues[i]+'</span>';
			}
			$('.chosen-cats').html(cat_span);

		}
		else{
				$('.chosen-cats').html('<span class="chosen-format">All</span>');
			}
	}
	//If the doc's been loaded run this once. 
	if(loaded){
		showCats();
	}
			
});
	$('body').on('click', '.chosen-format', function(){
				var value = $(this).text();
				alert(value);
				// var index = $.inArray(value, selectValues);
				// selectValues.splice(index, 1);
				// alert(index);
	});


	/*
		Generic functions below 
		showvideo from playlist, deleteUserPost,submit post
	*/
	//Global variables
	post_counter = 0;
		$('.playlist-item').click(function() {
			$(this).next(".playlist-video-show").toggle('slow/400/fast');
			// $(this).mouseenter(function(event) {
			// 	/* Act on the event */
			// });
			$(this).attr({
				title: 'click to close'
			});
			// .css({
			// 	width: '400px'
			// });;
			// $('.playlist-video-show').fadeIn('slow/400/fast', function() {
			// 	$(this).css({
			// 		display: 'inline-block',
			// 		width: '400px'
			// 	});
			// });
				});
		function delUserPost(postID){
			if(confirm("Are you sure?")){
			var postId = postID;
			$.ajax({
			    type: "POST",
			    url: "../bll/del_comment.php",
			    data:{ postID : postId },
			    success: function(data){
			        $('#post'+postId).remove();
			        // $('.user-decision').html("<div class='deleted-comment'>comment deleted</div>");
			    }
			});
			}
		}


            $('.submit_post').click(function(event) {
            	var loggedInUser = $('#ajax_logged_in').val();
            	var postData = $('.post_data').val();


		            $.ajax({
		            type: "POST", // HTTP method POST or GET
		            url: "../dal/ajax.php", //Where to make Ajax calls
		            data:{ loggedInUser : loggedInUser, postData : postData } , //Form variables
		            success:function(response){
		            	post_counter+=1;
		                // $("#responds").append(response);
		                // $("#contentText").val(''); //empty text field on successful
		                // $("#FormSubmit").show(); //show submit button
		                // $("#LoadingImage").hide(); //hide loading image
		                var post = "";

		                //Make it so we can get the latest post to put number in here so can delete from database.
		             	post += "<div class='post-wrap' id='appended_"+post_counter+"'>";
							post += "<div class='post-head'>";
								post += "<img class='prof-img' src='../assets/uploads/user/default.png' alt='profile_pic' />";
									//Put name and post time here
									post += new Date();
							post += "</div>";
						post  += "<div class='post-content'>";
							post += postData;

						// post += "<iframe width="560" height="315" src=\"https://www.youtube.com/embed/<?php echo $embedCode; ?>\" frameborder="0" allowfullscreen></iframe>

						post += "</div>"; //End of post content
							//Post footer - Have delete post here.
							post += "<div class='post-footer'>";
								post += "<a href='#' onClick=''>Delete Post</a>";
							post += "</div>";
						post += "</div>";//End of post wrap

						$('.appended-posts').prepend(post);
		                $('.post_data').val("");


		            },
		            error:function (xhr, ajaxOptions, thrownError){
		                // $("#FormSubmit").show(); //show submit button
		                // $("#LoadingImage").hide(); //hide loading image
		                alert("EROR: " + thrownError);
		            }
	        });
		});

			/*
				Function used for deletion of comments
			*/
		function delpost(id){
			if(confirm("Are you sure?")){
				var cID = id;
				$.ajax({
					type: "POST",
					url: "../bll/del_comment.php",
					data:{ cID : id },
					success: function(data){
					$('#comment'+id).remove();
					$('.user-decision').html("<div class='deleted-comment'>comment deleted</div>");
					}
				});
			}
		}


	