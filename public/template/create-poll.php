<?php
/**
 * The create poll page.
 *
 * @link       http://www.wbcomdesigns.com
 * @since      4.3.0
 *
 * @package    Buddypress_Polls
 * @subpackage Buddypress_Polls/public
 */


if(!empty($_GET['poll_id'])){
	$post_id = isset($_GET['poll_id']) ? $_GET['poll_id']: '';
	$post = get_post($post_id);

	$poll_type = get_post_meta( $post_id, 'poll_type', true );
	$start_time = get_post_meta( $post_id, '_wbpoll_start_date', true );
	$end_date = get_post_meta( $post_id, '_wbpoll_end_date', true );
	$never_expire = get_post_meta( $post_id, '_wbpoll_never_expire', true );
	$show_result_after_expire = get_post_meta( $post_id, '_wbpoll_show_result_before_expire', true );
	$multivote = get_post_meta( $post_id, '_wbpoll_multivote', true );

	$answers = get_post_meta( $post_id, '_wbpoll_answer', true );
	$image_answer_url = get_post_meta( $post_id, '_wbpoll_full_size_image_answer', true );
	$image_answer_url = isset($image_answer_url) ? $image_answer_url : array();

	$video_answer_url = get_post_meta( $post_id, '_wbpoll_video_answer_url', true );
	$video_answer_url = isset($video_answer_url) ? $video_answer_url : array();

	$audio_answer_url = get_post_meta( $post_id, '_wbpoll_audio_answer_url', true );
	$audio_answer_url = isset($audio_answer_url) ? $audio_answer_url : array();

	$html_content = get_post_meta( $post_id, '_wbpoll_html_answer', true );
	$html_content = isset($html_content) ? $html_content : array();

	$video_import_info = get_post_meta( $post_id, '_wbpoll_video_import_info', true );
	$video_import_info = isset($video_import_info) ? $video_import_info : array();

	$audio_import_info = get_post_meta( $post_id, '_wbpoll_audio_import_info', true );
	$audio_import_info = isset($audio_import_info) ? $audio_import_info : array();

	$options = [];

	if($poll_type == 'default'){
		foreach($answers as $key => $ans){
			$options[$key] = $ans;
		}
	}else if($poll_type == 'image'){
		foreach($answers as $key => $ans){
			$options[$key] = array(
				'ans' => $ans,
				'image' => $image_answer_url[$key],
			);
		}
	}else if($poll_type == 'video'){
		foreach($answers as $key => $ans){
			$options[$key] = array(
				'ans' => $ans,
				'video' => $video_answer_url[$key],
				'suggestion' => $video_import_info[$key],
			);
		}
	}else if($poll_type == 'audio'){
		foreach($answers as $key => $ans){
			$options[$key] = array(
				'ans' => $ans,
				'audio' => $audio_answer_url[$key],
				'suggestion' => $audio_import_info[$key],
			);
		}
	}else if($poll_type == 'html'){
		foreach($answers as $key => $ans){
			$options[$key] = array(
				'ans' => $ans,
				'html' => $html_content[$key],
			);
		}
	}
}

if(isset($poll_type) && !empty($poll_type)){
	$poll_type = $poll_type;
}else{
	$poll_type = '';
}

?>

<div class="main-poll-create">
	<div class="deshboard-top">
		<?php if(isset($_GET['poll_id']) && !empty($_GET['poll_id'])){ ?>
			<div class="main-title">
			<h3><?php esc_html_e( 'Edit Poll', 'buddypress-polls' ); ?></h3>
		</div>
		<?php }else{?>
			<div class="main-title">
			<h3><?php esc_html_e( 'Add Poll', 'buddypress-polls' ); ?></h3>
		</div>
		<?php } ?>
		
	</div>
	<div class="poll-create">
	<?php if (is_user_logged_in()) { ?>
		<form id="wbpolls-create" class="wbpolls-create">
			<input type="hidden" name="author_id" id="author_id" value="<?php echo get_current_user_id(); ?>">
			<input type="hidden" name="poll_id" id="poll_id" value="<?php if(isset($post_id) && !empty($post_id)) { echo $post_id; } ?>">
			<div class="form-group">
				<label for="polltitle"><?php esc_html_e( 'Poll Title', 'buddypress-polls' ); ?></label>
				<input type="text" class="form-control" name="title" id="polltitle" value="<?php echo $post->post_title; ?>">
				<span id="error_title" style="color:red;"></span>
			</div>
			<div class="form-group">
				<label for="polltitle"><?php esc_html_e( 'Poll Description', 'buddypress-polls' ); ?></label>
				<!-- <textarea class="form-control wp_editor" name="content" id="poll-content"></textarea> -->
				<?php
				$content = $post->post_content; // Set initial content if needed

				// Output the Rich Textarea
				wp_editor($content, 'poll-content', array(
					'textarea_name' => 'content', // Replace with your desired field name
					'editor_height' => 300, // Set the height of the editor
					// Additional settings and configurations can be added here
				));
				?>
			</div>
			<div class="form-group">
				<label for="polltitle"><?php esc_html_e( 'Poll Type', 'buddypress-polls' ); ?></label>
				<select class="form-control" name="poll_type" id="poll_type">
					<option value="" <?php if($poll_type == ''){ echo "selected"; }?>><?php esc_html_e( 'Select Poll Type', 'buddypress-polls' ); ?></option>
					<option value="default" <?php if($poll_type == 'default'){ echo "selected"; }?>><?php esc_html_e( 'Text', 'buddypress-polls' ); ?></option>
					<option value="image" <?php if($poll_type == 'image'){ echo "selected"; }?>><?php esc_html_e( 'Image', 'buddypress-polls' ); ?></option>
					<option value="video" <?php if($poll_type == 'video'){ echo "selected"; }?>><?php esc_html_e( 'Video', 'buddypress-polls' ); ?></option>
					<option value="audio" <?php if($poll_type == 'audio'){ echo "selected"; }?>><?php esc_html_e( 'Audio', 'buddypress-polls' ); ?></option>
					<option value="html" <?php if($poll_type == 'html'){ echo "selected"; }?>><?php esc_html_e( 'HTML', 'buddypress-polls' ); ?></option>
				</select>
				<span id="error_type" style="color:red;"></span>
			</div>
			<?php if($poll_type == 'default'){ ?>
				<div class="wbpolls-answer-wrap">
					<div class="row wbpoll-list-item" id="type_text" style="">
						<div class="ans-records text_records">
							<div class="ans-records-wrap">
								<label>Text Answer</label>
								<input name="_wbpoll_answer[]" id="wbpoll_answer" class="wbpoll_answer" type="text" value="<?php echo $options[0]; ?>">
								<input type="hidden" id="wbpoll_answer_extra_type" value="default" name="_wbpoll_answer_extra[][type]"> 
							</div>
							<a class="add-field extra-fields-text" data-id="<?php echo count($options); ?>" href="#">Add More</a>
						</div>
						<div class="text_records_dynamic">
							<?php 
							foreach($options as $key => $optn){ 
								if($key != 0){ ?>
									<div class="remove remove2">
										<div class="ans-records-wrap">
											<label>Text Answer</label>
											<input name="_wbpoll_answer[]" id="wbpoll_answer" class="wbpoll_answer" type="text" value="<?php echo $optn; ?>">
											<input type="hidden" id="wbpoll_answer_extra_type" value="default" name="_wbpoll_answer_extra[][type]"> 
										</div>
										<a class="add-field extra-fields-text" data-id="<?php echo count($options); ?>" href="#">Add More</a>
										<a href="#" class="remove-field btn-remove-text">Remove Fields</a>
									</div>
									<?php } 
								} ?>
						</div>
					</div>
				</div>
			<?php }elseif($poll_type == 'image'){ ?>
				<div class="wbpolls-answer-wrap">
					<div class="row wbpoll-list-item" id="type_image" style="">
						<div class="ans-records image_records">
							<div class="ans-records-wrap">
								<div class="wbpoll-image-input-preview">
									<div class="wbpoll-image-input-preview-thumbnail" id="wbpoll-image-input-preview-thumbnail">
									<img width="266" height="266" src="<?php echo $options[0]['image']; ?>">
									</div>
									
								</div>
								<div class="wbpoll-image-input-details">
									<label>Image Answer</label>
									<input name="_wbpoll_answer[]" id="wbpoll_answer" type="text" class="wbpoll_answer" value="<?php echo $options[0]['ans']; ?>">
									<input type="hidden" id="wbpoll_answer_extra_type" value="image" name="_wbpoll_answer_extra[][type]">
									<label>Image URL</label>
									<input name="_wbpoll_full_size_image_answer[]" class="wbpoll_image_answer_url" id="wbpoll_image_answer_url" type="url" value="<?php echo $options[0]['image']; ?>">
									<button type="button" class="bpolls-attach dashicons dashicons-admin-media" id="bpolls-attach-image"></button>
								</div>
							</div>
							<a class="add-field extra-fields-image" data-id="<?php echo count($options); ?>" href="#">Add More</a>
						</div>
						<?php 
							foreach($options as $key => $optn){ 
								if($key != 0){ ?>
									<div class="image_records_dynamic"><div class="remove remove2">
										<div class="ans-records-wrap">
											<div class="wbpoll-image-input-preview">
												<div class="wbpoll-image-input-preview-thumbnail" id="wbpoll-image-input-preview-thumbnail"><img width="266" height="266" src="<?php echo $optn['image']; ?>"></div>
											</div>
											<div class="wbpoll-image-input-details">
												<label>Image Answer</label>
												<input name="_wbpoll_answer[]" id="wbpoll_answer" type="text" class="wbpoll_answer" value="<?php echo $optn['ans']; ?>">
												<input type="hidden" id="wbpoll_answer_extra_type" value="image" name="_wbpoll_answer_extra[][type]">
												<label>Image URL</label>
												<input name="_wbpoll_full_size_image_answer[]" class="wbpoll_image_answer_url" id="wbpoll_image_answer_url" type="url" value="<?php echo $optn['image']; ?>">
												<button type="button" class="bpolls-attach dashicons dashicons-admin-media" id="bpolls-attach-image"></button>
											</div>
										</div>
										<a class="add-field extra-fields-image" data-id="<?php echo count($options); ?>" href="#">Add More</a>
										<a href="#" class="remove-field btn-remove-image">Remove Fields</a></div>
									</div>
								<?php } 
							} ?>
					</div>
				</div>
			<?php }elseif($poll_type == 'video'){ ?>
				<div class="wbpolls-answer-wrap">
					<div class="row wbpoll-list-item" id="type_video" style="">
						<div class="ans-records video_records">
							<div class="ans-records-wrap">
								<div class="wbpoll-image-input-preview">
									<div class="wbpoll-image-input-preview-thumbnail">
									<?php if($options[0]['suggestion'] == 'yes'){ ?>
										<iframe width="420" height="345" src="<?php echo $options[0]['video']; ?>"></iframe>
									<?php }else{ ?>
										<video src="<?php echo $options[0]['video']; ?>" controls="" poster="" preload="none"></video>
									<?php }?>
									</div>
								</div>
								<div class="wbpoll-image-input-details">
									<label>Video Answer</label>
									<input name="_wbpoll_answer[]" id="wbpoll_answer" type="text" class="wbpoll_answer" value="<?php echo $options[0]['ans']; ?>">
									<input type="hidden" id="wbpoll_answer_extra_type" value="video" name="_wbpoll_answer_extra[][type]">
									<label>Video URL</label>
									<input name="_wbpoll_video_answer_url[]" id="wbpoll_video_answer_url" class="wbpoll_video_answer_url" type="url" value="<?php echo $options[0]['video']; ?>">
									<button type="button" class="bpolls-attach dashicons dashicons-admin-media" id="bpolls-attach-video"></button>
									<div class="wbpoll-input-group-suggestions hide_suggestion" style="display:none;">
										<span>Import information from ?</span> 
										<input type="checkbox" class="yes_video" id="yes" name="_wbpoll_video_import_info[]" value="yes" <?php if($options[0]['suggestion'] == 'yes'){ echo "checked"; }?>>
										<label for="yes">Yes</label>
										<input type="checkbox" id="no" name="_wbpoll_video_import_info[]" value="no" <?php if($options[0]['suggestion'] == 'no'){ echo "checked"; }?>>
										<label for="no">No</label>
									</div>
								</div>
							</div>
							<a class="add-field extra-fields-video" data-id="<?php echo count($options); ?>" href="#">Add More</a>
						</div>
						<?php 
							foreach($options as $key => $optn){ 
								if($key != 0){ ?>
								<div class="video_records_dynamic"><div class="remove remove2">
									<div class="ans-records-wrap">
										<div class="wbpoll-image-input-preview">
											<div class="wbpoll-image-input-preview-thumbnail">
											<?php if($optn['suggestion'] == 'yes'){ ?>
												<iframe width="420" height="345" src="<?php echo $optn['video']; ?>"></iframe>
											<?php }else{ ?>
												<video src="<?php echo $optn['video']; ?>" controls="" poster="" preload="none"></video>
											<?php }?>
											</div>
										</div>
										<div class="wbpoll-image-input-details">
											<label>Video Answer</label>
											<input name="_wbpoll_answer[]" id="wbpoll_answer" type="text" class="wbpoll_answer" value="<?php echo $optn['ans']; ?>">
											<input type="hidden" id="wbpoll_answer_extra_type" value="video" name="_wbpoll_answer_extra[][type]">
											<label>Video URL</label>
											<input name="_wbpoll_video_answer_url[]" id="wbpoll_video_answer_url" class="wbpoll_video_answer_url" type="url" value="<?php echo $optn['video']; ?>">
											<button type="button" class="bpolls-attach dashicons dashicons-admin-media" id="bpolls-attach-video"></button>
											<div class="wbpoll-input-group-suggestions hide_suggestion" style="display:none;">
												<span>Import information from ?</span> 
												<input type="checkbox" class="yes_video" id="yes" name="_wbpoll_video_import_info[]" value="yes" <?php if($optn['suggestion'] == 'yes'){ echo "checked"; }?>>
												<label for="yes">Yes</label>
												<input type="checkbox" id="no" name="_wbpoll_video_import_info[]" value="no" <?php if($optn['suggestion'] == 'no'){ echo "checked"; }?>>
												<label for="no">No</label>
											</div>
										</div>
									</div>
									<a class="add-field extra-fields-video" data-id="<?php echo count($options); ?>" href="#">Add More</a>
									<a href="#" class="remove-field btn-remove-video">Remove Fields</a></div>
								</div>
						<?PHP }
						} ?>
					</div>
				</div>
			<?php }elseif($poll_type == 'audio'){ ?>
				<div class="wbpolls-answer-wrap">
					<div class="row wbpoll-list-item" id="type_audio" style="">
						<div class="ans-records audio_records">
							<div class="ans-records-wrap">
								<div class="wbpoll-image-input-preview">
									<div class="wbpoll-image-input-preview-thumbnail">
									<?php if($options[0]['suggestion'] == 'yes'){ ?>
										<iframe width="420" height="345" src="<?php echo $options[0]['audio']; ?>"></iframe>
									<?php }else{ ?>
										<audio src="<?php echo $options[0]['audio']; ?>" controls="" preload="none"></audio>
									<?php }?>
									</div>
								</div>
								<div class="wbpoll-image-input-details">
									<label>Audio Answer</label>
									<input name="_wbpoll_answer[]" id="wbpoll_answer" class="wbpoll_answer" type="text" value="<?php echo $options[0]['ans']; ?>">
									<input type="hidden" id="wbpoll_answer_extra_type" value="audio" name="_wbpoll_answer_extra[][type]">
									<label>Audio URL</label>
									<input name="_wbpoll_audio_answer_url[]" id="wbpoll_audio_answer_url" class="wbpoll_audio_answer_url" type="url" value="<?php echo $options[0]['audio']; ?>">
									<button type="button" class="bpolls-attach dashicons dashicons-admin-media" id="bpolls-attach-audio"></button>
									<div class="wbpoll-input-group-suggestions hide_suggestion" style="display:none;"><span>Import information from ?</span>
									<input type="checkbox" class="yes_audio" id="yes" name="_wbpoll_audio_import_info[]" value="yes" <?php if($options[0]['suggestion'] == 'yes'){ echo "checked"; }?>>
									<label for="yes">Yes</label>
									<input type="checkbox" id="no" name="_wbpoll_audio_import_info[]" value="no" <?php if($options[0]['suggestion'] == 'no'){ echo "checked"; }?>>
									<label for="no">No</label><br></div>
								</div>
							</div>
							<a class="add-field extra-fields-audio" data-id="<?php echo count($options); ?>" href="#">Add More</a>
						</div>
						<?php 
							foreach($options as $key => $optn){ 
								if($key != 0){ ?>
								<div class="audio_records_dynamic"><div class="remove remove2">
									<div class="ans-records-wrap">
										<div class="wbpoll-image-input-preview">
											<div class="wbpoll-image-input-preview-thumbnail">
											<?php if($optn['suggestion'] == 'yes'){ ?>
												<iframe width="420" height="345" src="<?php echo $optn['audio']; ?>"></iframe>
											<?php }else{ ?>
												<audio src="<?php echo $optn['audio']; ?>" controls="" preload="none"></audio>
											<?php }?>
											</div>
										</div>
										<div class="wbpoll-image-input-details">
											<label>Audio Answer</label>
											<input name="_wbpoll_answer[]" id="wbpoll_answer" class="wbpoll_answer" type="text" value="<?php echo $optn['ans']; ?>">
											<input type="hidden" id="wbpoll_answer_extra_type" value="audio" name="_wbpoll_answer_extra[][type]">
											<label>Audio URL</label>
											<input name="_wbpoll_audio_answer_url[]" id="wbpoll_audio_answer_url" class="wbpoll_audio_answer_url" type="url" value="<?php echo $optn['audio']; ?>">
											<button type="button" class="bpolls-attach dashicons dashicons-admin-media" id="bpolls-attach-audio"></button>
											<div class="wbpoll-input-group-suggestions hide_suggestion" style="display:none;"><span>Import information from ?</span>
											<input type="checkbox" class="yes_audio" id="yes" name="_wbpoll_audio_import_info[]" value="yes" <?php if($optn['suggestion'] == 'yes'){ echo "checked"; }?>>
											<label for="yes">Yes</label>
											<input type="checkbox" id="no" name="_wbpoll_audio_import_info[]" value="no" <?php if($optn['suggestion'] == 'no'){ echo "checked"; }?>>
											<label for="no">No</label><br></div>
										</div>
									</div>
									<a class="add-field extra-fields-audio" data-id="<?php echo count($options); ?>" href="#">Add More</a>
									<a href="#" class="remove-field btn-remove-audio">Remove Fields</a></div>
								</div>
							<?PHP }
								} ?>
					</div>
				</div>
			<?php }elseif($poll_type == 'html'){ ?>
				<div class="wbpolls-answer-wrap">
					<div class="row wbpoll-list-item" id="type_html" style="">
						<div class="ans-records html_records">
							<div class="ans-records-wrap">								
								<label>HTML Answer</label>
								<input name="_wbpoll_answer[]" id="wbpoll_answer" class="wbpoll_answer" type="text" value="<?php echo $options[0]['ans']; ?>">
								<label>HTML Content</label>
								<textarea name="_wbpoll_html_answer[]" id="wbpoll_html_answer_textarea" class="wbpoll_html_answer_textarea tiny"><?php echo $options[0]['html']; ?></textarea>
								<input type="hidden" id="wbpoll_answer_extra_type" value="html" name="_wbpoll_answer_extra[][type]">
							</div>
							<a class="add-field extra-fields-html" data-id="<?php echo count($options); ?>" href="#">Add More</a>
						</div>
						<?php 
							foreach($options as $key => $optn){ 
								if($key != 0){ ?>
								<div class="html_records_dynamic"><div class="remove remove1">
									<div class="ans-records-wrap">								
										<label>HTML Answer</label>
										<input name="_wbpoll_answer[]" id="wbpoll_answer" class="wbpoll_answer" type="text" value="<?php echo $optn['ans']; ?>">
										<label>HTML Content</label>
										<textarea name="_wbpoll_html_answer[]" id="wbpoll_html_answer_textarea" class="wbpoll_html_answer_textarea tiny"><?php echo $optn['html']; ?></textarea>
										<input type="hidden" id="wbpoll_answer_extra_type" value="html" name="_wbpoll_answer_extra[][type]">
									</div>
									<a class="add-field extra-fields-html" data-id="<?php echo count($options); ?>" href="#">Add More</a>
									<a href="#" class="remove-field btn-remove-html">Remove Fields</a></div>
								</div>
							<?PHP }
								} ?>
					</div>
				</div>
			<?php }?>

			<div class="wbpolls-answer-wrap">
				<!-- for text type -->
				<div class="row wbpoll-list-item" id="type_text" style="display:none;">
					<div class="ans-records text_records">
						<div class="ans-records-wrap">
							<label><?php esc_html_e( 'Text Answer', 'buddypress-polls' ); ?></label>
							<input name="_wbpoll_answer[]" id="wbpoll_answer" class="wbpoll_answer" type="text" value="">
							<input type="hidden" id="wbpoll_answer_extra_type" value="default" name="_wbpoll_answer_extra[][type]"> 
						</div>
						<a class="add-field extra-fields-text" data-id="0" href="#"><?php esc_html_e( 'Add More', 'buddypress-polls' ); ?></a>
					</div>
					<div class="text_records_dynamic"></div>
				</div>

				<!-- for image type -->
				<div class="row wbpoll-list-item" id="type_image" style="display:none;">
					<div class="ans-records image_records">
						<div class="ans-records-wrap">
							<div class="wbpoll-image-input-preview">
								<div class="wbpoll-image-input-preview-thumbnail" id="wbpoll-image-input-preview-thumbnail">
								</div>
							</div>
							<div class="wbpoll-image-input-details">
								<label><?php esc_html_e( 'Image Answer', 'buddypress-polls' ); ?></label>
								<input name="_wbpoll_answer[]" id="wbpoll_answer" type="text" class="wbpoll_answer" value="">
								<input type="hidden" id="wbpoll_answer_extra_type" value="image" name="_wbpoll_answer_extra[][type]">
								<label><?php esc_html_e( 'Image URL', 'buddypress-polls' ); ?></label>
								<input name="_wbpoll_full_size_image_answer[]" class="wbpoll_image_answer_url" class="wbpoll_image_answer_url" id="wbpoll_image_answer_url"  type="url" value="">
								<button type='button' class="bpolls-attach dashicons dashicons-admin-media" id="bpolls-attach-image"></button>
							</div>
						</div>
						<a class="add-field extra-fields-image" data-id="0" href="#"><?php esc_html_e( 'Add More', 'buddypress-polls' ); ?></a>
					</div>
					<div class="image_records_dynamic"></div>
				</div>

				<!-- for video type -->
				<div class="row wbpoll-list-item" id="type_video" style="display:none;">
					<div class="ans-records video_records">
						<div class="ans-records-wrap">
							<div class="wbpoll-image-input-preview">
								<div class="wbpoll-image-input-preview-thumbnail">
								</div>
							</div>
							<div class="wbpoll-image-input-details">
								<label><?php esc_html_e( 'Video Answer', 'buddypress-polls' ); ?></label>
								<input name="_wbpoll_answer[]" id="wbpoll_answer" type="text" class="wbpoll_answer" value="">
								<input type="hidden" id="wbpoll_answer_extra_type" value="video" name="_wbpoll_answer_extra[][type]">
								<label><?php esc_html_e( 'Video URL', 'buddypress-polls' ); ?></label>
								<input name="_wbpoll_video_answer_url[]" id="wbpoll_video_answer_url" class="wbpoll_video_answer_url"  type="url" value="">
								<button type='button' class="bpolls-attach dashicons dashicons-admin-media" id="bpolls-attach-video"></button>
								<div class="wbpoll-input-group-suggestions hide_suggestion" style="display:none;">
									<span><?php esc_html_e( 'Import information from ?', 'buddypress-polls' ); ?></span> 
									<input type="checkbox" class="yes_video" id="yes" name="_wbpoll_video_import_info[]" value="yes">
									<label for="yes"><?php esc_html_e( 'Yes', 'buddypress-polls' ); ?></label>
									<input type="checkbox" id="no" name="_wbpoll_video_import_info[]" value="no">
									<label for="no"><?php esc_html_e( 'No', 'buddypress-polls' ); ?></label>
								</div>
							</div>
						</div>
						<a class="add-field extra-fields-video" data-id="0" href="#"><?php esc_html_e( 'Add More', 'buddypress-polls' ); ?></a>
					</div>
					<div class="video_records_dynamic"></div>
				</div>

				<!-- for audio type -->
				<div class="row wbpoll-list-item" id="type_audio" style="display:none;">
					<div class="ans-records audio_records">
						<div class="ans-records-wrap">
							<div class="wbpoll-image-input-preview">
								<div class="wbpoll-image-input-preview-thumbnail">
								</div>
							</div>
							<div class="wbpoll-image-input-details">
								<label><?php esc_html_e( 'Audio Answer', 'buddypress-polls' ); ?></label>
								<input name="_wbpoll_answer[]" id="wbpoll_answer" class="wbpoll_answer" type="text" value="">
								<input type="hidden" id="wbpoll_answer_extra_type" value="audio" name="_wbpoll_answer_extra[][type]">
								<label><?php esc_html_e( 'Audio URL', 'buddypress-polls' ); ?></label>
								<input name="_wbpoll_audio_answer_url[]" id="wbpoll_audio_answer_url" class="wbpoll_audio_answer_url" type="url" value="">
								<button type='button' class="bpolls-attach dashicons dashicons-admin-media" id="bpolls-attach-audio"></button>
								<div class="wbpoll-input-group-suggestions hide_suggestion" style="display:none;"><span><?php esc_html_e( 'Import information from ?', 'buddypress-polls' ); ?></span>
								<input type="checkbox" class="yes_audio" id="yes" name="_wbpoll_audio_import_info[]" value="yes">
								<label for="yes"><?php esc_html_e( 'Yes', 'buddypress-polls' ); ?></label>
								<input type="checkbox" id="no" name="_wbpoll_audio_import_info[]" value="no">
								<label for="no"><?php esc_html_e( 'No', 'buddypress-polls' ); ?></label><br></div>
							</div>
						</div>
						<a class="add-field extra-fields-audio" data-id="0" href="#"><?php esc_html_e( 'Add More', 'buddypress-polls' ); ?></a>
					</div>
					<div class="audio_records_dynamic"></div>
				</div>

				<!-- for html type -->
				<div class="row wbpoll-list-item" id="type_html" style="display:none;">
					<div class="ans-records html_records">
						<div class="ans-records-wrap">
							
							<label><?php esc_html_e( 'HTML Answer', 'buddypress-polls' ); ?></label>
							<input name="_wbpoll_answer[]" id="wbpoll_answer" class="wbpoll_answer" type="text" value="">
							<label><?php esc_html_e( 'HTML Content', 'buddypress-polls' ); ?></label>
							<textarea name="_wbpoll_html_answer[]" id="wbpoll_html_answer_textarea" class="wbpoll_html_answer_textarea tiny"></textarea>
							<input type="hidden" id="wbpoll_answer_extra_type" value="html" name="_wbpoll_answer_extra[][type]">
						</div>
						<a class="add-field extra-fields-html" data-id="0" href="#"><?php esc_html_e( 'Add More', 'buddypress-polls' ); ?></a>
					</div>
					<div class="html_records_dynamic"></div>
				</div>
			</div>
			<span id="error_ans" style="color:red;"></span>

			<div class="wbcom-polls-option-wrap">
				<table class="form-table wbpoll-answer-options">
					<tbody>
						<tr>
							<th><label for="_wbpoll_start_date"><?php esc_html_e( 'Start Date', 'buddypress-polls' ); ?></label></th>
							<td><input type="text" class="wbpollmetadatepicker hasDatepicker" name="_wbpoll_start_date" id="_wbpoll_start_date" value="<?php if(!empty($start_time)){ echo $start_time; }else{ echo date('Y-m-d H:i:s');}  ?>" size="30">
								<span class="description"><?php esc_html_e( 'Poll Start Date. [Note: Field required. Default is today]', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
						<tr>
							<?php
							$currentDate = date('Y-m-d H:i:s');
							$nextSevenDays = date('Y-m-d H:i:s', strtotime($currentDate . ' +7 days'));
							?>
							<th><label for="_wbpoll_end_date"><?php esc_html_e( 'End Date', 'buddypress-polls' ); ?></label></th>
							<td><input type="text" class="wbpollmetadatepicker hasDatepicker" name="_wbpoll_end_date" id="_wbpoll_end_date" value="<?php if(!empty($end_date)){ echo $end_date; }else{ echo $nextSevenDays; } ?>" size="30">
								<span class="description"><?php esc_html_e( 'Poll End Date. [Note: Field required. Default is next seven days.]', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="_wbpoll_never_expire"><?php esc_html_e( 'Never Expire', 'buddypress-polls' ); ?></label></th>
							<td>
								<fieldset class="radio_fields">
									<legend class="screen-reader-text"><span><?php esc_html_e( 'input type="radio"', 'buddypress-polls' ); ?></span></legend>
									<label class="wbpoll-answer-options-radio-field" title="g:i a" for="_wbpoll_never_expire-radio">
										<input id="_wbpoll_never_expire-radio" type="radio" name="_wbpoll_never_expire" value="1" <?php if(!empty($never_expire) && $never_expire == 1){ ?>  checked="checked" <?php } ?>>
										<span><?php esc_html_e( 'Yes', 'buddypress-polls' ); ?></span>
									</label>
									<label class="wbpoll-answer-options-radio-field" title="g:i a" for="_wbpoll_never_expire-radio">
										<input id="_wbpoll_never_expire-radio" type="radio" name="_wbpoll_never_expire" value="0" <?php if(!empty($never_expire) && $never_expire == 0){ ?> checked="checked" <?php } ?>>
										<span><?php esc_html_e( 'No', 'buddypress-polls' ); ?></span>
									</label>
								</fieldset>
								<span class="description"><?php esc_html_e( 'Select if you want your poll to never expire.(can be override from shortcode param)', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="_wbpoll_show_result_before_expire"><?php esc_html_e( 'Show Result After Expires', 'buddypress-polls' ); ?></label></th>
							<td>
								<fieldset class="radio_fields">
									<legend class="screen-reader-text"><span><?php esc_html_e( 'input type="radio"', 'buddypress-polls' ); ?></span></legend>
									<label class="wbpoll-answer-options-radio-field" title="g:i a" for="_wbpoll_show_result_before_expire-radio">
										<input id="_wbpoll_show_result_before_expire-radio" type="radio" name="_wbpoll_show_result_before_expire" value="1" <?php if(!empty($show_result_after_expire) && $show_result_after_expire == 1){ ?>  checked="checked" <?php } ?>>
										<span><?php esc_html_e( 'Yes', 'buddypress-polls' ); ?></span>
									</label>
									<label class="wbpoll-answer-options-radio-field" title="g:i a" for="_wbpoll_show_result_before_expire-radio">
										<input id="_wbpoll_show_result_before_expire-radio" type="radio" name="_wbpoll_show_result_before_expire" value="0" <?php if(!empty($show_result_after_expire) && $show_result_after_expire == 0){ ?>  checked="checked" <?php } ?>>
										<span><?php esc_html_e( 'No', 'buddypress-polls' ); ?></span>
									</label>
								</fieldset>
								<span class="description"><?php esc_html_e( 'Select if you want poll to show result After expires. After expires the result will be shown always. Please check it if poll never expires.', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="_wbpoll_multivote"><?php esc_html_e( 'Enable Multi Choice', 'buddypress-polls' ); ?></label></th>
							<td>
								<fieldset class="radio_fields">
									<legend class="screen-reader-text"><span><?php esc_html_e( 'input type="radio"', 'buddypress-polls' ); ?></span></legend>
									<label class="wbpoll-answer-options-radio-field" title="g:i a" for="_wbpoll_multivote-radio">
										<input id="_wbpoll_multivote-radio" type="radio" name="_wbpoll_multivote" value="1" <?php if(!empty($multivote) && $multivote == 1){ ?>  checked="checked" <?php } ?>>
										<span><?php esc_html_e( 'Yes', 'buddypress-polls' ); ?></span>
									</label>
									<label class="wbpoll-answer-options-radio-field" title="g:i a" for="_wbpoll_multivote-radio">
										<input id="_wbpoll_multivote-radio" type="radio" name="_wbpoll_multivote" value="0" <?php if(!empty($multivote) && $multivote == 0){ ?>  checked="checked" <?php } ?>>
										<span><?php esc_html_e( 'No', 'buddypress-polls' ); ?></span>
									</label>
								</fieldset>
								<span class="description"><?php esc_html_e( 'Can user vote multiple option', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
						<?php $option_value = get_option('wbpolls_settings');
						if(!empty($option_value)){
							$wbpolls_user_add_extra_op = isset($option_value['wbpolls_user_add_extra_op']) ? $option_value['wbpolls_user_add_extra_op'] : '';
						}
						if($wbpolls_user_add_extra_op == 'yes'){ ?>
						<tr id="addtitonal_option" style="display:none;">
							<th><label for="_wbpoll_multivote"><?php esc_html_e( 'Add Additional fields', 'buddypress-polls' ); ?></label></th>
							<td>
								<fieldset class="radio_fields">
									<legend class="screen-reader-text"><span><?php esc_html_e( 'input type="radio"', 'buddypress-polls' ); ?></span></legend>
									<label class="wbpoll-answer-options-radio-field" title="g:i a" for="_wbpoll_multivote-radio">
										<input id="_wbpoll_multivote-radio" type="radio" name="_wbpoll_add_additional_fields" value="1">
										<span><?php esc_html_e( 'Yes', 'buddypress-polls' ); ?></span>
									</label>
									<label class="wbpoll-answer-options-radio-field" title="g:i a" for="_wbpoll_multivote-radio">
										<input id="_wbpoll_multivote-radio" type="radio" name="_wbpoll_add_additional_fields" value="0" checked="checked">
										<span><?php esc_html_e( 'No', 'buddypress-polls' ); ?></span>
									</label>
								</fieldset>
								<span class="description"><?php esc_html_e( 'Add Additional fields functionality only for text poll.', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Poll Create', 'buddypress-polls' ); ?></button>

		</form>
		<div class="wbpoll-voted-info wbpoll-success" id="pollsuccess" style="display:none;"></div>
		<?php }else{ ?>
		<div class="wbpoll_wrapper wbpoll_wrapper-1324 wbpoll_wrapper-content_hook" data-reference="content_hook"><p class="wbpoll-voted-info wbpoll-alert"><?php esc_html_e( 'This page content only for login members.', 'buddypress-polls' ); ?> </p></div>
	<?php } ?>
	</div>
</div>
 