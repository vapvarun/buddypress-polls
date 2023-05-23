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

?>

<div class="main-poll-create">
	<div class="deshboard-top">
		<div class="main-title">
			<h3><?php esc_html_e( 'Create Poll', 'buddypress-polls' ); ?></h3>
		</div>
	</div>
	<div class="poll-create">
		<form id="wbpolls-create" class="wbpolls-create">
			<div class="form-group">
				<label for="polltitle"><?php esc_html_e( 'Poll Title', 'buddypress-polls' ); ?></label>
				<input type="text" class="form-control" name="poll_title" id="polltitle">
			</div>
			<div class="form-group">
				<label for="polltitle"><?php esc_html_e( 'Poll Description', 'buddypress-polls' ); ?></label>
				<textarea class="form-control" name="poll_description"></textarea>
			</div>
			<div class="form-group">
				<label for="polltitle"><?php esc_html_e( 'Poll Type', 'buddypress-polls' ); ?></label>
				<select class="form-control" name="poll_type" id="poll_type">
					<option value=""><?php esc_html_e( 'Select Poll Type', 'buddypress-polls' ); ?></option>
					<option value="default"><?php esc_html_e( 'Text', 'buddypress-polls' ); ?></option>
					<option value="image"><?php esc_html_e( 'Image', 'buddypress-polls' ); ?></option>
					<option value="video"><?php esc_html_e( 'Video', 'buddypress-polls' ); ?></option>
					<option value="audio"><?php esc_html_e( 'Audio', 'buddypress-polls' ); ?></option>
					<option value="html"><?php esc_html_e( 'HTML', 'buddypress-polls' ); ?></option>
				</select>
			</div>

			<div class="wbpolls-answer-wrap">
				<!-- for text type -->
				<div class="row wbpoll-list-item" id="type_text" style="display:none;">
					<div class="ans-records text_records">
						<div class="ans-records-wrap">
							<label><?php esc_html_e( 'Text Answer', 'buddypress-polls' ); ?></label>
							<input name="_wbpoll_answer[]" type="text" value="">
						</div>
						<a class="add-field extra-fields-text" href="#"><?php esc_html_e( 'Add More', 'buddypress-polls' ); ?></a>
					</div>
					<div class="text_records_dynamic"></div>
				</div>

				<!-- for image type -->
				<div class="row wbpoll-list-item" id="type_image" style="display:none;">
					<div class="ans-records image_records">
						<div class="ans-records-wrap">
							<div class="wbpoll-image-input-preview">
								<div class="wbpoll-image-input-preview-thumbnail">
								</div>
							</div>
							<div class="wbpoll-image-input-details">
								<label><?php esc_html_e( 'Image Answer', 'buddypress-polls' ); ?></label>
								<input name="_wbpoll_answer[]" type="text" value="">
								<label><?php esc_html_e( 'Image URL', 'buddypress-polls' ); ?></label>
								<input name="_wbpoll_full_size_image_answer[]" type="url" value="">
							</div>
						</div>
						<a class="add-field extra-fields-image" href="#"><?php esc_html_e( 'Add More', 'buddypress-polls' ); ?></a>
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
								<input name="_wbpoll_answer[]" type="text" value="">
								<label><?php esc_html_e( 'Video URL', 'buddypress-polls' ); ?></label>
								<input name="_wbpoll_video_answer_url[]" type="url" value="">
							</div>
						</div>
						<a class="add-field extra-fields-video" href="#"><?php esc_html_e( 'Add More', 'buddypress-polls' ); ?></a>
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
								<input name="_wbpoll_answer[]" type="text" value="">
								<label><?php esc_html_e( 'Audio URL', 'buddypress-polls' ); ?></label>
								<input name="_wbpoll_audio_answer_url[]" type="url" value="">
							</div>
						</div>
						<a class="add-field extra-fields-audio" href="#"><?php esc_html_e( 'Add More', 'buddypress-polls' ); ?></a>
					</div>
					<div class="audio_records_dynamic"></div>
				</div>

				<!-- for html type -->
				<div class="row wbpoll-list-item" id="type_html" style="display:none;">
					<div class="ans-records html_records">
						<div class="ans-records-wrap">
							<label><?php esc_html_e( 'HTML Answer', 'buddypress-polls' ); ?></label>
							<textarea name="_wbpoll_answer[]"></textarea>
						</div>
						<a class="add-field extra-fields-html" href="#"><?php esc_html_e( 'Add More', 'buddypress-polls' ); ?></a>
					</div>
					<div class="html_records_dynamic"></div>
				</div>
			</div>

			<div class="wbcom-polls-option-wrap">
				<table class="form-table wbpoll-answer-options">
					<tbody>
						<tr>
							<th><label for="_wbpoll_start_date"><?php esc_html_e( 'Start Date', 'buddypress-polls' ); ?></label></th>
							<td><input type="text" class="wbpollmetadatepicker hasDatepicker" name="_wbpoll_start_date" id="_wbpoll_start_date-date-1183" value="2023-05-10 07:46:11" size="30">
								<span class="description"><?php esc_html_e( 'Poll Start Date. [Note: Field required. Default is today]', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="_wbpoll_end_date"><?php esc_html_e( 'End Date', 'buddypress-polls' ); ?></label></th>
							<td><input type="text" class="wbpollmetadatepicker hasDatepicker" name="_wbpoll_end_date" id="_wbpoll_end_date-date-1183" value="2023-05-16 07:46:11" size="30">
								<span class="description"><?php esc_html_e( 'Poll End Date. [Note: Field required. Default is next seven days.]', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="_wbpoll_user_roles"><?php esc_html_e( 'Who Can Vote', 'buddypress-polls' ); ?></label></th>
							<td>
								<select name="_wbpoll_user_roles[]" id="_wbpoll_user_roles-chosen-1183" class="selecttwo-select select2-hidden-accessible" multiple="" data-select2-id="_wbpoll_user_roles-chosen-1183" tabindex="-1" aria-hidden="true">
									<option value="administrator" selected="selected" data-select2-id="2"><?php esc_html_e( 'Administrator', 'buddypress-polls' ); ?></option>
									<option value="editor" selected="selected" data-select2-id="3"><?php esc_html_e( 'Editor', 'buddypress-polls' ); ?></option>
									<option value="author" selected="selected" data-select2-id="4"><?php esc_html_e( 'Author', 'buddypress-polls' ); ?></option>
									<option value="contributor" selected="selected" data-select2-id="5"><?php esc_html_e( 'Contributor', 'buddypress-polls' ); ?></option>
									<option value="subscriber" selected="selected" data-select2-id="6"><?php esc_html_e( 'Subscriber', 'buddypress-polls' ); ?></option>
									<option value="customer"><?php esc_html_e( 'Customer', 'buddypress-polls' ); ?></option>
									<option value="shop_manager"><?php esc_html_e( 'Shop manager', 'buddypress-polls' ); ?></option>
								</select>
								<span class="description"><?php esc_html_e( 'Which user role will have vote capability', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="_wbpoll_content"><?php esc_html_e( 'Show Poll Description in Shortcode', 'buddypress-polls' ); ?></label></th>
							<td>
								<fieldset class="radio_fields">
									<legend class="screen-reader-text"><span><?php esc_html_e( 'input type="radio"', 'buddypress-polls' ); ?></span></legend>
									<label title="g:i a" for="_wbpoll_content-radio-1183-1">
										<input id="_wbpoll_content-radio-1183-1" type="radio" name="_wbpoll_content" value="1" checked="checked">
										<span><?php esc_html_e( 'Yes', 'buddypress-polls' ); ?></span>
									</label><label title="g:i a" for="_wbpoll_content-radio-1183-0">
										<input id="_wbpoll_content-radio-1183-0" type="radio" name="_wbpoll_content" value="0">
										<span><?php esc_html_e( 'No', 'buddypress-polls' ); ?></span>
									</label>
								</fieldset>
								<span class="description"><?php esc_html_e( 'Select if you want to show content.', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="_wbpoll_never_expire"><?php esc_html_e( 'Never Expire', 'buddypress-polls' ); ?></label></th>
							<td>
								<fieldset class="radio_fields">
									<legend class="screen-reader-text"><span><?php esc_html_e( 'input type="radio"', 'buddypress-polls' ); ?></span></legend>
									<label title="g:i a" for="_wbpoll_never_expire-radio-1183-1">
										<input id="_wbpoll_never_expire-radio-1183-1" type="radio" name="_wbpoll_never_expire" value="1">
										<span><?php esc_html_e( 'Yes', 'buddypress-polls' ); ?></span>
									</label><label title="g:i a" for="_wbpoll_never_expire-radio-1183-0">
										<input id="_wbpoll_never_expire-radio-1183-0" type="radio" name="_wbpoll_never_expire" value="0" checked="checked">
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
									<label title="g:i a" for="_wbpoll_show_result_before_expire-radio-1183-1">
										<input id="_wbpoll_show_result_before_expire-radio-1183-1" type="radio" name="_wbpoll_show_result_before_expire" value="1" checked="checked">
										<span><?php esc_html_e( 'Yes', 'buddypress-polls' ); ?></span>
									</label><label title="g:i a" for="_wbpoll_show_result_before_expire-radio-1183-0">
										<input id="_wbpoll_show_result_before_expire-radio-1183-0" type="radio" name="_wbpoll_show_result_before_expire" value="0">
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
									<label title="g:i a" for="_wbpoll_multivote-radio-1183-1">
										<input id="_wbpoll_multivote-radio-1183-1" type="radio" name="_wbpoll_multivote" value="1">
										<span><?php esc_html_e( 'Yes', 'buddypress-polls' ); ?></span>
									</label><label title="g:i a" for="_wbpoll_multivote-radio-1183-0">
										<input id="_wbpoll_multivote-radio-1183-0" type="radio" name="_wbpoll_multivote" value="0" checked="checked">
										<span><?php esc_html_e( 'No', 'buddypress-polls' ); ?></span>
									</label>
								</fieldset>
								<span class="description"><?php esc_html_e( 'Can user vote multiple option', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="_wbpoll_vote_per_session"><?php esc_html_e( 'Votes Per Session', 'buddypress-polls' ); ?></label></th>
							<td><input type="number" class="regular-text" name="_wbpoll_vote_per_session" id="_wbpoll_vote_per_session-number-1183" value="1" size="30">
								<span class="description"><?php esc_html_e( 'Votes Per Session', 'buddypress-polls' ); ?></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Poll Create', 'buddypress-polls' ); ?></button>
		</form>
	</div>
</div>
