<?php
//object oriented approach - Seems pointless but still like it.
				class user_profile {
					public $_userID;

					public function __construct($userID){
						$this->_userID = $userID;
					}
					
					public function showUser(){
						userProfile($this->_userID);
							
					}
					public function showPlaylist(){
						showPlaylist($this->_userID);
					}
					public function showPost(){
						showPost($this->_userID);
					}
					public function showAmountFollowers(){
						showFollowers($this->_userID);
					}
					

				}
				class data_input {
					public $_userID;

					public function __construct($userID){
						$this->_userID = $userID;
					}

					public function insertPost($post_data, $num){
						insertPost($this->_userID, $post_data,$num);
					}
					public function recordUserLikes($num, $val){
						recordLikes($num, $this->_userID, $val);
					}



				}
				?>