<?php

/*
   Class: AaltoEdgeMultipleImages
   A class that initializes Edge Multiple Images
*/

class AaltoEdgeMultipleImages implements iAaltoEdgeRender {
	private $name;
	private $label;
	private $description;
	
	function __construct( $name, $label = "", $description = "" ) {
		global $aalto_edge_Framework;
		$this->name        = $name;
		$this->label       = $label;
		$this->description = $description;
		$aalto_edge_Framework->edgtfMetaBoxes->addOption( $this->name, "" );
	}
	
	public function render( $factory ) {
		global $post;
		?>
		
		<div class="edgtf-page-form-section">
			<div class="edgtf-field-desc">
				<h4><?php echo esc_html( $this->label ); ?></h4>
				<p><?php echo esc_html( $this->description ); ?></p>
			</div>
			<div class="edgtf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<ul class="edgtf-gallery-images-holder clearfix">
								<?php
								$image_gallery_val = get_post_meta( $post->ID, $this->name, true );
								if ( $image_gallery_val != '' ) {
									$image_gallery_array = explode( ',', $image_gallery_val );
								}
								
								if ( isset( $image_gallery_array ) && count( $image_gallery_array ) != 0 ):
									foreach ( $image_gallery_array as $gimg_id ):
										$gimage_wp = wp_get_attachment_image_src( $gimg_id, 'thumbnail', true );
										echo '<li class="edgtf-gallery-image-holder"><img src="' . esc_url( $gimage_wp[0] ) . '"/></li>';
									endforeach;
								endif;
								?>
							</ul>
							<input type="hidden" value="<?php echo esc_attr( $image_gallery_val ); ?>" id="<?php echo esc_attr( $this->name ) ?>" name="<?php echo esc_attr( $this->name ) ?>">
							<div class="edgtf-gallery-uploader">
								<a class="edgtf-gallery-upload-btn btn btn-sm btn-primary" href="javascript:void(0)"><?php esc_html_e( 'Upload', 'aalto' ); ?></a>
								<a class="edgtf-gallery-clear-btn btn btn-sm btn-default pull-right" href="javascript:void(0)"><?php esc_html_e( 'Remove All', 'aalto' ); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

/*
   Class: AaltoEdgeImagesVideos
   A class that initializes Edge Images Videos
*/
class AaltoEdgeImagesVideos implements iAaltoEdgeRender {
	private $label;
	private $description;
	
	function __construct( $label = "", $description = "" ) {
		$this->label       = $label;
		$this->description = $description;
	}
	
	public function render( $factory ) {
		global $post;
		?>
		
		<div class="edgtf_hidden_portfolio_images" style="display: none">
			<div class="edgtf-page-form-section">
				<div class="edgtf-field-desc">
					<h4><?php echo esc_html( $this->label ); ?></h4>
					<p><?php echo esc_html( $this->description ); ?></p>
				</div>
				<div class="edgtf-section-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-2">
								<em class="edgtf-field-description"><?php esc_html_e( 'Order Number', 'aalto' ); ?></em>
								<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x"/>
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-12">
								<em class="edgtf-field-description"><?php esc_html_e( 'Image', 'aalto' ); ?></em>
								<div class="edgtf-media-uploader">
									<div style="display: none" class="edgtf-media-image-holder">
										<img src="" alt="" class="edgtf-media-image img-thumbnail"/>
									</div>
									<div style="display: none" class="edgtf-media-meta-fields">
										<input type="hidden" class="edgtf-media-upload-url" name="portfolioimg_x" id="portfolioimg_x"/>
										<input type="hidden" class="edgtf-media-upload-height" name="edgtf_options_theme[media-upload][height]" value=""/>
										<input type="hidden" class="edgtf-media-upload-width" name="edgtf_options_theme[media-upload][width]" value=""/>
									</div>
									<a class="edgtf-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e( 'Select Image', 'aalto' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'aalto' ); ?>"><?php esc_html_e( 'Upload', 'aalto' ); ?></a>
									<a style="display: none;" href="javascript: void(0)" class="edgtf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'aalto' ); ?></a>
								</div>
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-3">
								<em class="edgtf-field-description"><?php esc_html_e( 'Video Type', 'aalto' ); ?></em>
								<select class="form-control edgtf-form-element edgtf-portfoliovideotype" name="portfoliovideotype_x" id="portfoliovideotype_x">
									<option value=""></option>
									<option value="youtube"><?php esc_html_e( 'YouTube', 'aalto' ); ?></option>
									<option value="vimeo"><?php esc_html_e( 'Vimeo', 'aalto' ); ?></option>
									<option value="self"><?php esc_html_e( 'Self Hosted', 'aalto' ); ?></option>
								</select>
							</div>
							<div class="col-lg-3">
								<em class="edgtf-field-description"><?php esc_html_e( 'Video ID', 'aalto' ); ?></em>
								<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfoliovideoid_x" name="portfoliovideoid_x"/>
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-12">
								<em class="edgtf-field-description">Video image</em>
								<div class="edgtf-media-uploader">
									<div style="display: none" class="edgtf-media-image-holder">
										<img src="" alt="" class="edgtf-media-image img-thumbnail"/>
									</div>
									<div style="display: none" class="edgtf-media-meta-fields">
										<input type="hidden" class="edgtf-media-upload-url" name="portfoliovideoimage_x" id="portfoliovideoimage_x"/>
										<input type="hidden" class="edgtf-media-upload-height" name="edgtf_options_theme[media-upload][height]" value=""/>
										<input type="hidden" class="edgtf-media-upload-width" name="edgtf_options_theme[media-upload][width]" value=""/>
									</div>
									<a class="edgtf-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e( 'Select Image', 'aalto' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'aalto' ); ?>"><?php esc_html_e( 'Upload', 'aalto' ); ?></a>
									<a style="display: none;" href="javascript: void(0)" class="edgtf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'aalto' ); ?></a>
								</div>
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-4">
								<em class="edgtf-field-description"><?php esc_html_e( 'Video mp4', 'aalto' ); ?></em>
								<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfoliovideomp4_x" name="portfoliovideomp4_x"/>
							</div>
						</div>
						<div class="row next-row">
							<div class="col-lg-12">
								<a class="edgtf_remove_image btn btn-sm btn-primary" href="/" onclick="javascript: return false;"><?php esc_html_e( 'Remove portfolio image/video', 'aalto' ); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php
		$no               = 1;
		$portfolio_images = get_post_meta( $post->ID, 'edgtf_portfolio_images', true );
		if ( count( $portfolio_images ) > 1 && aalto_edge_core_plugin_installed() ) {
			usort( $portfolio_images, "edgtf_core_compare_portfolio_videos" );
		}
		while ( isset( $portfolio_images[ $no - 1 ] ) ) {
			$portfolio_image = $portfolio_images[ $no - 1 ];
			?>
			
			<div class="edgtf_portfolio_image" rel="<?php echo esc_attr( $no ); ?>" style="display: block;">
				<div class="edgtf-page-form-section">
					<div class="edgtf-field-desc">
						<h4><?php echo esc_html( $this->label ); ?></h4>
						<p><?php echo esc_html( $this->description ); ?></p>
					</div>
					<div class="edgtf-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<em class="edgtf-field-description"><?php esc_html_e( 'Order Number', 'aalto' ); ?></em>
									<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfolioimgordernumber_<?php echo esc_attr( $no ); ?>" name="portfolioimgordernumber[]" value="<?php echo isset( $portfolio_image['portfolioimgordernumber'] ) ? esc_attr( stripslashes( $portfolio_image['portfolioimgordernumber'] ) ) : ""; ?>"/>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="edgtf-field-description"><?php esc_html_e( 'Image', 'aalto' ); ?></em>
									<div class="edgtf-media-uploader">
										<div<?php if ( stripslashes( $portfolio_image['portfolioimg'] ) == false ) { ?> style="display: none"<?php } ?> class="edgtf-media-image-holder">
											<img src="<?php if ( stripslashes( $portfolio_image['portfolioimg'] ) == true ) { echo esc_url( aalto_edge_get_attachment_thumb_url( stripslashes( $portfolio_image['portfolioimg'] ) ) ); } ?>" alt="" class="edgtf-media-image img-thumbnail"/>
										</div>
										<div style="display: none" class="edgtf-media-meta-fields">
											<input type="hidden" class="edgtf-media-upload-url" name="portfolioimg[]" id="portfolioimg_<?php echo esc_attr( $no ); ?>" value="<?php echo stripslashes( $portfolio_image['portfolioimg'] ); ?>"/>
											<input type="hidden" class="edgtf-media-upload-height" name="edgtf_options_theme[media-upload][height]" value=""/>
											<input type="hidden" class="edgtf-media-upload-width" name="edgtf_options_theme[media-upload][width]" value=""/>
										</div>
										<a class="edgtf-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e( 'Select Image', 'aalto' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'aalto' ); ?>"><?php esc_html_e( 'Upload', 'aalto' ); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="edgtf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'aalto' ); ?></a>
									</div>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-3">
									<em class="edgtf-field-description"><?php esc_html_e( 'Video Type', 'aalto' ); ?></em>
									<select class="form-control edgtf-form-element edgtf-portfoliovideotype" name="portfoliovideotype[]" id="portfoliovideotype_<?php echo esc_attr( $no ); ?>">
										<option value=""></option>
										<option <?php if ( $portfolio_image['portfoliovideotype'] == "youtube" ) { echo "selected='selected'"; } ?> value="youtube"><?php esc_html_e( 'YouTube', 'aalto' ); ?></option>
										<option <?php if ( $portfolio_image['portfoliovideotype'] == "vimeo" ) { echo "selected='selected'"; } ?> value="vimeo"><?php esc_html_e( 'Vimeo', 'aalto' ); ?></option>
										<option <?php if ( $portfolio_image['portfoliovideotype'] == "self" ) { echo "selected='selected'"; } ?> value="self"><?php esc_html_e( 'Self Hosted', 'aalto' ); ?></option>
									</select>
								</div>
								<div class="col-lg-3">
									<em class="edgtf-field-description"><?php esc_html_e( 'Video ID', 'aalto' ); ?></em>
									<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfoliovideoid_<?php echo esc_attr( $no ); ?>" name="portfoliovideoid[]" value="<?php echo isset( $portfolio_image['portfoliovideoid'] ) ? esc_attr( stripslashes( $portfolio_image['portfoliovideoid'] ) ) : ""; ?>"/>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="edgtf-field-description">Video image</em>
									<div class="edgtf-media-uploader">
										<div<?php if ( stripslashes( $portfolio_image['portfoliovideoimage'] ) == false ) { ?> style="display: none"<?php } ?> class="edgtf-media-image-holder">
											<img src="<?php if ( stripslashes( $portfolio_image['portfoliovideoimage'] ) == true ) { echo esc_url( aalto_edge_get_attachment_thumb_url( stripslashes( $portfolio_image['portfoliovideoimage'] ) ) ); } ?>" alt="" class="edgtf-media-image img-thumbnail"/>
										</div>
										<div style="display: none" class="edgtf-media-meta-fields">
											<input type="hidden" class="edgtf-media-upload-url" name="portfoliovideoimage[]" id="portfoliovideoimage_<?php echo esc_attr( $no ); ?>" value="<?php echo stripslashes( $portfolio_image['portfoliovideoimage'] ); ?>"/>
											<input type="hidden" class="edgtf-media-upload-height" name="edgtf_options_theme[media-upload][height]" value=""/>
											<input type="hidden" class="edgtf-media-upload-width" name="edgtf_options_theme[media-upload][width]" value=""/>
										</div>
										<a class="edgtf-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e( 'Select Image', 'aalto' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'aalto' ); ?>"><?php esc_html_e( 'Upload', 'aalto' ); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="edgtf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'aalto' ); ?></a>
									</div>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-4">
									<em class="edgtf-field-description"><?php esc_html_e( 'Video mp4', 'aalto' ); ?></em>
									<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfoliovideomp4_<?php echo esc_attr( $no ); ?>" name="portfoliovideomp4[]" value="<?php echo isset( $portfolio_image['portfoliovideomp4'] ) ? esc_attr( stripslashes( $portfolio_image['portfoliovideomp4'] ) ) : ""; ?>"/>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<a class="edgtf_remove_image btn btn-sm btn-primary" href="/" onclick="javascript: return false;"><?php esc_html_e( 'Remove portfolio image/video', 'aalto' ); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			$no ++;
		}
		?>
		<br/>
		<a class="edgtf_add_image btn btn-sm btn-primary" onclick="javascript: return false;" href="/"><?php esc_html_e( 'Add portfolio image/video', 'aalto' ); ?></a>
		<?php
	}
}

/*
   Class: AaltoEdgeImagesVideos
   A class that initializes Edge Images Videos
*/

class AaltoEdgeImagesVideosFramework implements iAaltoEdgeRender {
	private $label;
	private $description;
	
	function __construct( $label = "", $description = "" ) {
		$this->label       = $label;
		$this->description = $description;
	}
	
	public function render( $factory ) {
		global $post;
		?>
		
		<div class="edgtf-hidden-portfolio-images" style="display: none">
			<div class="edgtf-portfolio-toggle-holder">
				<div class="edgtf-portfolio-toggle edgtf-toggle-desc">
					<span class="number">1</span>
					<span class="edgtf-toggle-inner"><?php esc_html_e( 'Image - ', 'aalto' ); ?><em><?php esc_html_e( 'Order Number', 'aalto' ); ?></em></span>
				</div>
				<div class="edgtf-portfolio-toggle edgtf-portfolio-control">
					<span class="toggle-portfolio-media"><i class="fa fa-caret-up"></i></span>
					<a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="edgtf-portfolio-toggle-content">
				<div class="edgtf-page-form-section">
					<div class="edgtf-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<div class="edgtf-media-uploader">
										<em class="edgtf-field-description"><?php esc_html_e( 'Image', 'aalto' ); ?></em>
										<div style="display: none" class="edgtf-media-image-holder">
											<img src="" alt="" class="edgtf-media-image img-thumbnail">
										</div>
										<div class="edgtf-media-meta-fields">
											<input type="hidden" class="edgtf-media-upload-url" name="portfolioimg_x" id="portfolioimg_x">
											<input type="hidden" class="edgtf-media-upload-height" name="edgtf_options_theme[media-upload][height]" value="">
											<input type="hidden" class="edgtf-media-upload-width" name="edgtf_options_theme[media-upload][width]" value="">
										</div>
										<a class="edgtf-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e( 'Select Image', 'aalto' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'aalto' ); ?>"><?php esc_html_e( 'Upload', 'aalto' ); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="edgtf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'aalto' ); ?></a>
									</div>
								</div>
								<div class="col-lg-2">
									<em class="edgtf-field-description"><?php esc_html_e( 'Order Number', 'aalto' ); ?></em>
									<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x">
								</div>
							</div>
							<input type="hidden" name="portfoliovideoimage_x" id="portfoliovideoimage_x">
							<input type="hidden" name="portfoliovideotype_x" id="portfoliovideotype_x">
							<input type="hidden" name="portfoliovideoid_x" id="portfoliovideoid_x">
							<input type="hidden" name="portfoliovideomp4_x" id="portfoliovideomp4_x">
							<input type="hidden" name="portfolioimgtype_x" id="portfolioimgtype_x" value="image">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="edgtf-hidden-portfolio-videos" style="display: none">
			<div class="edgtf-portfolio-toggle-holder">
				<div class="edgtf-portfolio-toggle edgtf-toggle-desc">
					<span class="number">2</span>
					<span class="edgtf-toggle-inner"><?php esc_html_e( 'Video - ', 'aalto' ); ?><em><?php esc_html_e( 'Order Number', 'aalto' ); ?></em></span>
				</div>
				<div class="edgtf-portfolio-toggle edgtf-portfolio-control">
					<span class="toggle-portfolio-media"><i class="fa fa-caret-up"></i></span>
					<a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="edgtf-portfolio-toggle-content">
				<div class="edgtf-page-form-section">
					<div class="edgtf-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<div class="edgtf-media-uploader">
										<em class="edgtf-field-description"><?php esc_html_e( 'Cover Video Image', 'aalto' ); ?></em>
										<div style="display: none" class="edgtf-media-image-holder">
											<img src="" alt="" class="edgtf-media-image img-thumbnail">
										</div>
										<div style="display: none" class="edgtf-media-meta-fields">
											<input type="hidden" class="edgtf-media-upload-url" name="portfoliovideoimage_x" id="portfoliovideoimage_x">
											<input type="hidden" class="edgtf-media-upload-height" name="edgtf_options_theme[media-upload][height]" value="">
											<input type="hidden" class="edgtf-media-upload-width" name="edgtf_options_theme[media-upload][width]" value="">
										</div>
										<a class="edgtf-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e( 'Select Image', 'aalto' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'aalto' ); ?>"><?php esc_html_e( 'Upload', 'aalto' ); ?></a>
										<a style="display: none;" href="javascript: void(0)" class="edgtf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'aalto' ); ?></a>
									</div>
								</div>
								<div class="col-lg-10">
									<div class="row">
										<div class="col-lg-2">
											<em class="edgtf-field-description"><?php esc_html_e( 'Order Number', 'aalto' ); ?></em>
											<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x">
										</div>
									</div>
									<div class="row next-row">
										<div class="col-lg-2">
											<em class="edgtf-field-description"><?php esc_html_e( 'Video Type', 'aalto' ); ?></em>
											<select class="form-control edgtf-form-element edgtf-portfoliovideotype" name="portfoliovideotype_x" id="portfoliovideotype_x">
												<option value=""></option>
												<option value="youtube"><?php esc_html_e( 'YouTube', 'aalto' ); ?></option>
												<option value="vimeo"><?php esc_html_e( 'Vimeo', 'aalto' ); ?></option>
												<option value="self"><?php esc_html_e( 'Self Hosted', 'aalto' ); ?></option>
											</select>
										</div>
										<div class="col-lg-2 edgtf-video-id-holder">
											<em class="edgtf-field-description" id="videoId"><?php esc_html_e( 'Video ID', 'aalto' ); ?></em>
											<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfoliovideoid_x" name="portfoliovideoid_x">
										</div>
									</div>
									<div class="row next-row edgtf-video-self-hosted-path-holder">
										<div class="col-lg-4">
											<em class="edgtf-field-description"><?php esc_html_e( 'Video mp4', 'aalto' ); ?></em>
											<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfoliovideomp4_x" name="portfoliovideomp4_x">
										</div>
									</div>
								</div>
							</div>
							<input type="hidden" name="portfolioimg_x" id="portfolioimg_x">
							<input type="hidden" name="portfolioimgtype_x" id="portfolioimgtype_x" value="video">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php
		$no               = 1;
		$portfolio_images = get_post_meta( $post->ID, 'edgtf_portfolio_images', true );
		if ( count( $portfolio_images ) > 1 && aalto_edge_core_plugin_installed() ) {
			usort( $portfolio_images, "edgtf_core_compare_portfolio_videos" );
		}
		while ( isset( $portfolio_images[ $no - 1 ] ) ) {
			$portfolio_image = $portfolio_images[ $no - 1 ];
			if ( isset( $portfolio_image['portfolioimgtype'] ) ) {
				$portfolio_img_type = $portfolio_image['portfolioimgtype'];
			} else {
				if ( stripslashes( $portfolio_image['portfolioimg'] ) == true ) {
					$portfolio_img_type = "image";
				} else {
					$portfolio_img_type = "video";
				}
			}
			
			if ( $portfolio_img_type == "image" ) { ?>
				<div class="edgtf-portfolio-images edgtf-portfolio-media" rel="<?php echo esc_attr( $no ); ?>">
					<div class="edgtf-portfolio-toggle-holder">
						<div class="edgtf-portfolio-toggle edgtf-toggle-desc">
							<span class="number"><?php echo esc_html( $no ); ?></span>
							<span class="edgtf-toggle-inner"><?php esc_html_e( 'Image - ', 'aalto' ); ?><em><?php echo stripslashes( $portfolio_image['portfolioimgordernumber'] ); ?></em></span>
						</div>
						<div class="edgtf-portfolio-toggle edgtf-portfolio-control">
							<a href="#" class="toggle-portfolio-media"><i class="fa fa-caret-down"></i></a>
							<a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
						</div>
					</div>
					<div class="edgtf-portfolio-toggle-content" style="display: none">
						<div class="edgtf-page-form-section">
							<div class="edgtf-section-content">
								<div class="container-fluid">
									<div class="row">
										<div class="col-lg-2">
											<div class="edgtf-media-uploader">
												<em class="edgtf-field-description"><?php esc_html_e( 'Image', 'aalto' ); ?></em>
												<div<?php if ( stripslashes( $portfolio_image['portfolioimg'] ) == false ) { ?> style="display: none"<?php } ?> class="edgtf-media-image-holder">
													<img src="<?php if ( stripslashes( $portfolio_image['portfolioimg'] ) == true ) { echo esc_url( aalto_edge_get_attachment_thumb_url( stripslashes( $portfolio_image['portfolioimg'] ) ) ); } ?>" alt="" class="edgtf-media-image img-thumbnail"/>
												</div>
												<div style="display: none" class="edgtf-media-meta-fields">
													<input type="hidden" class="edgtf-media-upload-url" name="portfolioimg[]" id="portfolioimg_<?php echo esc_attr( $no ); ?>" value="<?php echo stripslashes( $portfolio_image['portfolioimg'] ); ?>"/>
													<input type="hidden" class="edgtf-media-upload-height" name="edgtf_options_theme[media-upload][height]" value=""/>
													<input type="hidden" class="edgtf-media-upload-width" name="edgtf_options_theme[media-upload][width]" value=""/>
												</div>
												<a class="edgtf-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e( 'Select Image', 'aalto' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'aalto' ); ?>"><?php esc_html_e( 'Upload', 'aalto' ); ?></a>
												<a style="display: none;" href="javascript: void(0)" class="edgtf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'aalto' ); ?></a>
											</div>
										</div>
										<div class="col-lg-2">
											<em class="edgtf-field-description"><?php esc_html_e( 'Order Number', 'aalto' ); ?></em>
											<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfolioimgordernumber_<?php echo esc_attr( $no ); ?>" name="portfolioimgordernumber[]" value="<?php echo isset( $portfolio_image['portfolioimgordernumber'] ) ? esc_attr( stripslashes( $portfolio_image['portfolioimgordernumber'] ) ) : ""; ?>">
										</div>
									</div>
									<input type="hidden" id="portfoliovideoimage_<?php echo esc_attr( $no ); ?>" name="portfoliovideoimage[]">
									<input type="hidden" id="portfoliovideotype_<?php echo esc_attr( $no ); ?>" name="portfoliovideotype[]">
									<input type="hidden" id="portfoliovideoid_<?php echo esc_attr( $no ); ?>" name="portfoliovideoid[]">
									<input type="hidden" id="portfoliovideomp4_<?php echo esc_attr( $no ); ?>" name="portfoliovideomp4[]">
									<input type="hidden" id="portfolioimgtype_<?php echo esc_attr( $no ); ?>" name="portfolioimgtype[]" value="image">
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			} else {
				?>
				<div class="edgtf-portfolio-videos edgtf-portfolio-media" rel="<?php echo esc_attr( $no ); ?>">
					<div class="edgtf-portfolio-toggle-holder">
						<div class="edgtf-portfolio-toggle edgtf-toggle-desc">
							<span class="number"><?php echo esc_html( $no ); ?></span>
							<span class="edgtf-toggle-inner"><?php esc_html_e( 'Video - ', 'aalto' ); ?><em><?php echo stripslashes( $portfolio_image['portfolioimgordernumber'] ); ?></em></span>
						</div>
						<div class="edgtf-portfolio-toggle edgtf-portfolio-control">
							<a href="#" class="toggle-portfolio-media"><i class="fa fa-caret-down"></i></a>
							<a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
						</div>
					</div>
					<div class="edgtf-portfolio-toggle-content" style="display: none">
						<div class="edgtf-page-form-section">
							<div class="edgtf-section-content">
								<div class="container-fluid">
									<div class="row">
										<div class="col-lg-2">
											<div class="edgtf-media-uploader">
												<em class="edgtf-field-description"><?php esc_html_e( 'Cover Video Image', 'aalto' ); ?></em>
												<div<?php if ( stripslashes( $portfolio_image['portfoliovideoimage'] ) == false ) { ?> style="display: none"<?php } ?> class="edgtf-media-image-holder">
													<img src="<?php if ( stripslashes( $portfolio_image['portfoliovideoimage'] ) == true ) { echo esc_url( aalto_edge_get_attachment_thumb_url( stripslashes( $portfolio_image['portfoliovideoimage'] ) ) ); } ?>" alt="" class="edgtf-media-image img-thumbnail"/>
												</div>
												<div style="display: none" class="edgtf-media-meta-fields">
													<input type="hidden" class="edgtf-media-upload-url" name="portfoliovideoimage[]" id="portfoliovideoimage_<?php echo esc_attr( $no ); ?>" value="<?php echo stripslashes( $portfolio_image['portfoliovideoimage'] ); ?>"/>
													<input type="hidden" class="edgtf-media-upload-height" name="edgtf_options_theme[media-upload][height]" value=""/>
													<input type="hidden" class="edgtf-media-upload-width" name="edgtf_options_theme[media-upload][width]" value=""/>
												</div>
												<a class="edgtf-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_html_e( 'Select Image', 'aalto' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'aalto' ); ?>"><?php esc_html_e( 'Upload', 'aalto' ); ?></a>
												<a style="display: none;" href="javascript: void(0)" class="edgtf-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'aalto' ); ?></a>
											</div>
										</div>
										<div class="col-lg-10">
											<div class="row">
												<div class="col-lg-2">
													<em class="edgtf-field-description"><?php esc_html_e( 'Order Number', 'aalto' ); ?></em>
													<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfolioimgordernumber_<?php echo esc_attr( $no ); ?>" name="portfolioimgordernumber[]" value="<?php echo isset( $portfolio_image['portfolioimgordernumber'] ) ? esc_attr( stripslashes( $portfolio_image['portfolioimgordernumber'] ) ) : ""; ?>">
												</div>
											</div>
											<div class="row next-row">
												<div class="col-lg-2">
													<em class="edgtf-field-description"><?php esc_html_e( 'Video Type', 'aalto' ); ?></em>
													<select class="form-control edgtf-form-element edgtf-portfoliovideotype" name="portfoliovideotype[]" id="portfoliovideotype_<?php echo esc_attr( $no ); ?>">
														<option value=""></option>
														<option <?php if ( $portfolio_image['portfoliovideotype'] == "youtube" ) { echo "selected='selected'"; } ?> value="youtube"><?php esc_html_e( 'YouTube', 'aalto' ); ?></option>
														<option <?php if ( $portfolio_image['portfoliovideotype'] == "vimeo" ) { echo "selected='selected'"; } ?> value="vimeo"><?php esc_html_e( 'Vimeo', 'aalto' ); ?></option>
														<option <?php if ( $portfolio_image['portfoliovideotype'] == "self" ) { echo "selected='selected'"; } ?> value="self"><?php esc_html_e( 'Self Hosted', 'aalto' ); ?></option>
													</select>
												</div>
												<div class="col-lg-2 edgtf-video-id-holder">
													<em class="edgtf-field-description"><?php esc_html_e( 'Video ID', 'aalto' ); ?></em>
													<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfoliovideoid_<?php echo esc_attr( $no ); ?>" name="portfoliovideoid[]" value="<?php echo isset( $portfolio_image['portfoliovideoid'] ) ? esc_attr( stripslashes( $portfolio_image['portfoliovideoid'] ) ) : ""; ?>"/>
												</div>
											</div>
											<div class="row next-row edgtf-video-self-hosted-path-holder">
												<div class="col-lg-4">
													<em class="edgtf-field-description"><?php esc_html_e( 'Video mp4', 'aalto' ); ?></em>
													<input type="text" class="form-control edgtf-input edgtf-form-element" id="portfoliovideomp4_<?php echo esc_attr( $no ); ?>" name="portfoliovideomp4[]" value="<?php echo isset( $portfolio_image['portfoliovideomp4'] ) ? esc_attr( stripslashes( $portfolio_image['portfoliovideomp4'] ) ) : ""; ?>"/>
												</div>
											</div>
										</div>
									</div>
									<input type="hidden" id="portfolioimg_<?php echo esc_attr( $no ); ?>" name="portfolioimg[]">
									<input type="hidden" id="portfolioimgtype_<?php echo esc_attr( $no ); ?>" name="portfolioimgtype[]" value="video">
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			$no ++;
		}
		?>
		
		<div class="edgtf-portfolio-add">
			<a class="edgtf-add-image btn btn-sm btn-primary" href="#"><i class="fa fa-camera"></i><?php esc_html_e( 'Add Image', 'aalto' ); ?></a>
			<a class="edgtf-add-video btn btn-sm btn-primary" href="#"><i class="fa fa-video-camera"></i><?php esc_html_e( 'Add Video', 'aalto' ); ?></a>
			<a class="edgtf-toggle-all-media btn btn-sm btn-default pull-right" href="#"><?php esc_html_e( 'Expand All', 'aalto' ); ?></a>
		</div>
		<?php
	}
}

class AaltoEdgeTwitterFramework implements iAaltoEdgeRender {
	public function render( $factory ) {
		$twitterApi = EdgeTwitterApi::getInstance();
		$message    = '';
		
		if ( ! empty( $_GET['oauth_token'] ) && ! empty( $_GET['oauth_verifier'] ) ) {
			if ( ! empty( $_GET['oauth_token'] ) ) {
				update_option( $twitterApi::AUTHORIZE_TOKEN_FIELD, $_GET['oauth_token'] );
			}
			
			if ( ! empty( $_GET['oauth_verifier'] ) ) {
				update_option( $twitterApi::AUTHORIZE_VERIFIER_FIELD, $_GET['oauth_verifier'] );
			}
			
			$responseObj = $twitterApi->obtainAccessToken();
			if ( $responseObj->status ) {
				$message = esc_html__( 'You have successfully connected with your Twitter account. If you have any issues fetching data from Twitter try reconnecting.', 'aalto' );
			} else {
				$message = $responseObj->message;
			}
		}
		
		$buttonText = $twitterApi->hasUserConnected() ? esc_html__( 'Re-connect with Twitter', 'aalto' ) : esc_html__( 'Connect with Twitter', 'aalto' );
		?>
		<?php if ( $message !== '' ) { ?>
			<div class="alert alert-success" style="margin-top: 20px;">
				<span><?php echo esc_html( $message ); ?></span>
			</div>
		<?php } ?>
		<div class="edgtf-page-form-section" id="edgtf_enable_social_share">
			<div class="edgtf-field-desc">
				<h4><?php esc_html_e( 'Connect with Twitter', 'aalto' ); ?></h4>
				<p><?php esc_html_e( 'Connecting with Twitter will enable you to show your latest tweets on your site', 'aalto' ); ?></p>
			</div>
			<div class="edgtf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<a id="edgtf-tw-request-token-btn" class="btn btn-primary" href="#"><?php echo esc_html( $buttonText ); ?></a>
							<input type="hidden" data-name="current-page-url" value="<?php echo esc_url( $twitterApi->buildCurrentPageURI() ); ?>"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }
}

class AaltoEdgeInstagramFramework implements iAaltoEdgeRender {
	public function render( $factory ) {
		$instagram_api = EdgeInstagramApi::getInstance();
		$message       = '';
		
		//if code wasn't saved to database
		if ( ! get_option( 'edgtf_instagram_code' ) ) {
			//check if code parameter is set in URL. That means that user has connected with Instagram
			if ( ! empty( $_GET['code'] ) ) {
				//update code option so we can use it later
				$instagram_api->storeCode();
				$instagram_api->getAccessToken();
				$message = esc_html__( 'You have successfully connected with your Instagram account. If you have any issues fetching data from Instagram try reconnecting.', 'aalto' );
				
			} else {
				$instagram_api->storeCodeRequestURI();
			}
		}
		
		$buttonText = $instagram_api->hasUserConnected() ? esc_html__( 'Re-connect with Instagram', 'aalto' ) : esc_html__( 'Connect with Instagram', 'aalto' );
		?>
		<?php if ( $message !== '' ) { ?>
			<div class="alert alert-success" style="margin-top: 20px;">
				<span><?php echo esc_html( $message ); ?></span>
			</div>
		<?php } ?>
		<div class="edgtf-page-form-section" id="edgtf_enable_social_share">
			<div class="edgtf-field-desc">
				<h4><?php esc_html_e( 'Connect with Instagram', 'aalto' ); ?></h4>
				<p><?php esc_html_e( 'Connecting with Instagram will enable you to show your latest photos on your site', 'aalto' ); ?></p>
			</div>
			<div class="edgtf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<a class="btn btn-primary" href="<?php echo esc_url( $instagram_api->getAuthorizeUrl() ); ?>"><?php echo esc_html( $buttonText ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }
}

/*
   Class: AaltoEdgeImagesVideos
   A class that initializes Edge Images Videos
*/
class AaltoEdgeOptionsFramework implements iAaltoEdgeRender {
	private $label;
	private $description;
	
	function __construct( $label = "", $description = "" ) {
		$this->label       = $label;
		$this->description = $description;
	}
	
	public function render( $factory ) {
		global $post;
		?>
		
		<div class="edgtf-portfolio-additional-item-holder" style="display: none">
			<div class="edgtf-portfolio-toggle-holder">
				<div class="edgtf-portfolio-toggle edgtf-toggle-desc">
					<span class="number">1</span>
					<span class="edgtf-toggle-inner">Additional Sidebar Item <em><?php esc_html_e( '(Order Number, Item Title)', 'aalto' ); ?></em></span>
				</div>
				<div class="edgtf-portfolio-toggle edgtf-portfolio-control">
					<span class="toggle-portfolio-item"><i class="fa fa-caret-up"></i></span>
					<a href="#" class="remove-portfolio-item"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="edgtf-portfolio-toggle-content">
				<div class="edgtf-page-form-section">
					<div class="edgtf-section-content">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-2">
									<em class="edgtf-field-description"><?php esc_html_e( 'Order Number', 'aalto' ); ?></em>
									<input type="text" class="form-control edgtf-input edgtf-form-element" id="optionlabelordernumber_x" name="optionlabelordernumber_x">
								</div>
								<div class="col-lg-10">
									<em class="edgtf-field-description"><?php esc_html_e( 'Item Title', 'aalto' ); ?></em>
									<input type="text" class="form-control edgtf-input edgtf-form-element" id="optionLabel_x" name="optionLabel_x">
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="edgtf-field-description"><?php esc_html_e( 'Item Text', 'aalto' ); ?></em>
									<textarea class="form-control edgtf-input edgtf-form-element" id="optionValue_x" name="optionValue_x"></textarea>
								</div>
							</div>
							<div class="row next-row">
								<div class="col-lg-12">
									<em class="edgtf-field-description"><?php esc_html_e( 'Enter Full URL for Item Text Link', 'aalto' ); ?></em>
									<input type="text" class="form-control edgtf-input edgtf-form-element" id="optionUrl_x" name="optionUrl_x">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		$no         = 1;
		$portfolios = get_post_meta( $post->ID, 'edgtf_portfolios', true );
		if ( count( $portfolios ) > 1 && aalto_edge_core_plugin_installed() ) {
			usort( $portfolios, "edgtf_core_compare_portfolio_options" );
		}
		while ( isset( $portfolios[ $no - 1 ] ) ) {
			$portfolio = $portfolios[ $no - 1 ];
			?>
			<div class="edgtf-portfolio-additional-item" rel="<?php echo esc_attr( $no ); ?>">
				<div class="edgtf-portfolio-toggle-holder">
					<div class="edgtf-portfolio-toggle edgtf-toggle-desc">
						<span class="number"><?php echo esc_html( $no ); ?></span>
						<span class="edgtf-toggle-inner"><?php esc_html_e( 'Additional Sidebar Item - ', 'aalto' ); ?><em>(<?php echo stripslashes( $portfolio['optionlabelordernumber'] ); ?>, <?php echo stripslashes( $portfolio['optionLabel'] ); ?>)</em></span>
					</div>
					<div class="edgtf-portfolio-toggle edgtf-portfolio-control">
						<span class="toggle-portfolio-item"><i class="fa fa-caret-down"></i></span>
						<a href="#" class="remove-portfolio-item"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="edgtf-portfolio-toggle-content" style="display: none">
					<div class="edgtf-page-form-section">
						<div class="edgtf-section-content">
							<div class="container-fluid">
								<div class="row">
									<div class="col-lg-2">
										<em class="edgtf-field-description"><?php esc_html_e( 'Order Number', 'aalto' ); ?></em>
										<input type="text" class="form-control edgtf-input edgtf-form-element" id="optionlabelordernumber_<?php echo esc_attr( $no ); ?>" name="optionlabelordernumber[]" value="<?php echo isset( $portfolio['optionlabelordernumber'] ) ? esc_attr( stripslashes( $portfolio['optionlabelordernumber'] ) ) : ""; ?>">
									</div>
									<div class="col-lg-10">
										<em class="edgtf-field-description"><?php esc_html_e( 'Item Title', 'aalto' ); ?></em>
										<input type="text" class="form-control edgtf-input edgtf-form-element" id="optionLabel_<?php echo esc_attr( $no ); ?>" name="optionLabel[]" value="<?php echo esc_attr( stripslashes( $portfolio['optionLabel'] ) ); ?>">
									</div>
								</div>
								<div class="row next-row">
									<div class="col-lg-12">
										<em class="edgtf-field-description"><?php esc_html_e( 'Item Text', 'aalto' ); ?></em>
										<textarea class="form-control edgtf-input edgtf-form-element" id="optionValue_<?php echo esc_attr( $no ); ?>" name="optionValue[]"><?php echo esc_attr( stripslashes( $portfolio['optionValue'] ) ); ?></textarea>
									</div>
								</div>
								<div class="row next-row">
									<div class="col-lg-12">
										<em class="edgtf-field-description"><?php esc_html_e( 'Enter Full URL for Item Text Link', 'aalto' ); ?></em>
										<input type="text" class="form-control edgtf-input edgtf-form-element" id="optionUrl_<?php echo esc_attr( $no ); ?>" name="optionUrl[]" value="<?php echo stripslashes( $portfolio['optionUrl'] ); ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			$no ++;
		}
		?>
		
		<div class="edgtf-portfolio-add">
			<a class="edgtf-add-item btn btn-sm btn-primary" href="#"><?php esc_html_e( 'Add New Item', 'aalto' ); ?></a>
			<a class="edgtf-toggle-all-item btn btn-sm btn-default pull-right" href="#"><?php esc_html_e( 'Expand All', 'aalto' ); ?></a>
		</div>
		<?php
	}
}

class AaltoEdgeRepeater implements iAaltoEdgeRender {
	private $label;
	private $description;
	private $name;
	private $fields;
	private $num_of_rows;
	private $button_text;
	
	function __construct( $fields, $name, $label = '', $description = '', $button_text = '' ) {
		global $aalto_edge_Framework;
		
		$this->label       = $label;
		$this->description = $description;
		$this->fields      = $fields;
		$this->name        = $name;
		$this->num_of_rows = 1;
		$this->button_text = ! empty( $button_text ) ? $button_text : esc_html__( 'Add New Item', 'aalto' );
		
		$counter = 0;
		foreach ( $this->fields as $field ) {
			
			if ( ! isset( $this->fields[ $counter ]['options'] ) ) {
				$this->fields[ $counter ]['options'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['args'] ) ) {
				$this->fields[ $counter ]['args'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['hidden'] ) ) {
				$this->fields[ $counter ]['hidden'] = false;
			}
			if ( ! isset( $this->fields[ $counter ]['label'] ) ) {
				$this->fields[ $counter ]['label'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['description'] ) ) {
				$this->fields[ $counter ]['description'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['default_value'] ) ) {
				$this->fields[ $counter ]['default_value'] = '';
			}
			
			$aalto_edge_Framework->edgtfMetaBoxes->addOption( $this->fields[ $counter ]['name'], $this->fields[ $counter ]['default_value'] );
			$counter ++;
		}
	}
	
	public function render( $factory ) {
		global $post;
		
		$clones = array();
		
		if ( ! empty( $post ) ) {
			$clones = get_post_meta( $post->ID, $this->fields[0]['name'], true );
		}
		
		$sortable_class = 'edgtf-sortable-holder';
		
		foreach ( $this->fields as $field ) {
			if ( $field['type'] == 'textareahtml' ) {
				$sortable_class = '';
				break;
			}
		}
		?>
		<div class="edgtf-repeater-wrapper">
			<div class="edgtf-repeater-fields-holder <?php echo esc_attr( $sortable_class ); ?> clearfix">
				<?php if ( empty( $clones ) ) { //first time
					$counter = 0; ?>
					<div class="edgtf-repeater-fields-row edgtf-initially-hidden">
						<div class="edgtf-repeater-fields-row-inner">
							<div class="edgtf-repeater-sort">
								<i class="fa fa-sort"></i>
							</div>
							<?php foreach ( $this->fields as $field ) { ?>
								<div class="edgtf-repeater-field-item">
									<?php
									$factory->render( $field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array(
										'index' => 0,
										'value' => $field['default_value']
									) );
									?>
								</div>
								<?php
								$counter ++;
							} ?>
							<div class="edgtf-repeater-remove">
								<a class="edgtf-clone-remove" href="#"><i class="fa fa-times"></i></a>
							</div>
						</div>
					</div>
				<?php } else {
					$j      = 0;
					$index  = 0;
					$values = array();
					foreach ( $this->fields as $field ) {
						if ( $j ++ === 0 ) { // avoid unnecessary get_post_meta call
							$values[] = $clones;
						} else {
							$values[] = get_post_meta( $post->ID, $field['name'], true );
						}
					}
					while ( isset( $clones[ $index ] ) ) { // rows
						$count = 0; ?>
						<div class="edgtf-repeater-fields-row">
							<div class="edgtf-repeater-fields-row-inner">
								<div class="edgtf-repeater-sort">
									<i class="fa fa-sort"></i>
								</div>
								<?php foreach ( $this->fields as $field ) { // columns ?>
									<div class="edgtf-repeater-field-item">
										<?php
										$factory->render( $field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array(
											'index' => $index,
											'value' => $values[ $count ][ $index ]
										) );
										?>
									</div>
									<?php
									$count ++;
								} ?>
								<div class="edgtf-repeater-remove">
									<a class="edgtf-clone-remove" href="#"><i class="fa fa-times"></i></a>
								</div>
							</div>
						</div>
						<?php
						++ $index;
					}
					$this->num_of_rows = $index;
				}
				?>
			</div>
			<div class="edgtf-repeater-add">
				<a class="edgtf-clone btn btn-sm btn-primary" data-count="<?php echo esc_attr( $this->num_of_rows ) ?>" href="#"><?php echo esc_html( $this->button_text ); ?></a>
			</div>
		</div>
		<?php
	}
}

class AaltoEdgeTableRepeater implements iAaltoEdgeRender {
	private $label;
	private $description;
	private $name;
	private $fields;
	private $num_of_rows;
	private $button_text;
	
	function __construct( $fields, $name, $label = '', $description = '', $button_text = '' ) {
		global $aalto_edge_Framework;
		
		$this->label       = $label;
		$this->description = $description;
		$this->fields      = $fields;
		$this->name        = $name;
		$this->num_of_rows = 1;
		$this->button_text = ! empty( $button_text ) ? $button_text : esc_html__( 'Add New', 'aalto' );
		
		$counter = 0;
		foreach ( $this->fields as $field ) {
			if ( ! isset( $this->fields[ $counter ]['options'] ) ) {
				$this->fields[ $counter ]['options'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['args'] ) ) {
				$this->fields[ $counter ]['args'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['hidden'] ) ) {
				$this->fields[ $counter ]['hidden'] = false;
			}
			if ( ! isset( $this->fields[ $counter ]['label'] ) ) {
				$this->fields[ $counter ]['label'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['description'] ) ) {
				$this->fields[ $counter ]['description'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['default_value'] ) ) {
				$this->fields[ $counter ]['default_value'] = '';
			}
			
			$aalto_edge_Framework->edgtfMetaBoxes->addOption( $this->fields[ $counter ]['name'], $this->fields[ $counter ]['default_value'] );
			$counter ++;
		}
	}
	
	public function render( $factory ) {
		global $post;
		
		$clones = array();
		
		if ( ! empty( $post ) ) {
			$clones = get_post_meta( $post->ID, $this->fields[0]['name'], true );
		}
		
		$sortable_class = 'edgtf-sortable-holder';
		
		foreach ( $this->fields as $field ) {
			if ( $field['type'] == 'textareahtml' ) {
				$sortable_class = '';
				break;
			}
		}
		?>
		<div class="edgtf-repeater-wrapper edgtf-question-answers">
			<table class="edgtf-repeater-fields-holder edgtf-table-layout <?php echo esc_attr( $sortable_class ); ?> clearfix">
				<thead>
				<tr>
					<th><?php esc_html_e( 'Order', 'aalto' ) ?></th>
					<?php foreach ( $this->fields as $field ) { ?>
						<th><?php echo esc_html( $field['th'] ); ?></th>
					<?php } ?>
					<th><?php esc_html_e( 'Remove', 'aalto' ) ?></th>
				</tr>
				</thead>
				<tbody class="edgtf-sortable-holder">
				<?php if ( empty( $clones ) ) { //first time
					$counter = 0; ?>
					<tr class="edgtf-repeater-fields-row edgtf-initially-hidden">
						<td class="edgtf-repeater-sort">
							<i class="fa fa-sort"></i>
						</td>
						<?php foreach ( $this->fields as $field ) { ?>
							<td>
								<?php
								$factory->render( $field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array(
									'index' => 0,
									'value' => $field['default_value']
								) );
								$counter ++;
								?>
							</td>
						<?php } ?>
						<td class="edgtf-repeater-remove">
							<a class="edgtf-clone-remove" href="#"><i class="fa fa-times"></i></a>
						</td>
					</tr>
				<?php } else {
					$j      = 0;
					$index  = 0;
					$values = array();
					foreach ( $this->fields as $field ) {
						if ( $j ++ === 0 ) { // avoid unnecessary get_post_meta call
							$values[] = $clones;
						} else {
							$values[] = get_post_meta( $post->ID, $field['name'], true );
						}
					}
					while ( isset( $clones[ $index ] ) ) { // rows
						$count = 0; ?>
						<tr class="edgtf-repeater-fields-row">
							<td class="edgtf-repeater-sort">
								<i class="fa fa-sort"></i>
							</td>
							<?php foreach ( $this->fields as $field ) { // columns ?>
								<td>
									<?php
									$factory->render( $field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array(
										'index' => $index,
										'value' => $values[ $count ][ $index ]
									) );
									?>
								</td>
								<?php
								$count ++;
							} ?>
							<td class="edgtf-repeater-remove">
								<a class="edgtf-clone-remove" href="#"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php
						++ $index;
					}
					$this->num_of_rows = $index;
				}
				?>
				</tbody>
			</table>
			<div class="edgtf-repeater-add">
				<a class="edgtf-clone btn btn-sm btn-primary" data-count="<?php echo esc_attr( $this->num_of_rows ) ?>" href="#"><?php echo esc_html( $this->button_text ); ?></a>
			</div>
		</div>
		<?php
	}
}

class AaltoEdgeRowRepeater implements iAaltoEdgeRender {
	private $label;
	private $description;
	private $name;
	private $fields;
	private $num_of_rows;
	private $button_text;
	
	function __construct( $fields, $name, $label = '', $description = '', $button_text = '' ) {
		global $aalto_edge_Framework;
		
		$this->label       = $label;
		$this->description = $description;
		$this->fields      = $fields;
		$this->name        = $name;
		$this->num_of_rows = 1;
		$this->button_text = ! empty( $button_text ) ? $button_text : esc_html__( 'Add New Item', 'aalto' );
		
		$counter = 0;
		foreach ( $this->fields as $field ) {
			
			if ( ! isset( $this->fields[ $counter ]['options'] ) ) {
				$this->fields[ $counter ]['options'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['args'] ) ) {
				$this->fields[ $counter ]['args'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['hidden'] ) ) {
				$this->fields[ $counter ]['hidden'] = false;
			}
			if ( ! isset( $this->fields[ $counter ]['label'] ) ) {
				$this->fields[ $counter ]['label'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['description'] ) ) {
				$this->fields[ $counter ]['description'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['default_value'] ) ) {
				$this->fields[ $counter ]['default_value'] = '';
			}
			
			$aalto_edge_Framework->edgtfMetaBoxes->addOption( $this->fields[ $counter ]['name'], $this->fields[ $counter ]['default_value'] );
			$counter ++;
		}
	}
	
	public function render( $factory ) {
		global $post;
		
		$clones = array();
		
		if ( ! empty( $post ) ) {
			$clones = get_post_meta( $post->ID, $this->fields[0]['name'], true );
		}
		
		$sortable_class = 'edgtf-sortable-holder';
		
		foreach ( $this->fields as $field ) {
			if ( $field['type'] == 'textareahtml' ) {
				$sortable_class = '';
				break;
			}
		}
		?>
		<div class="edgtf-repeater-wrapper edgtf-repeater-row-type">
			<div class="edgtf-repeater-fields-holder <?php echo esc_attr( $sortable_class ); ?> clearfix">
				<?php if ( empty( $clones ) ) { //first time
					$counter = 0; ?>
					<div class="edgtf-repeater-fields-row edgtf-initially-hidden">
						<div class="edgtf-repeater-fields-row-inner">
							<div class="edgtf-repeater-sort">
								<i class="fa fa-sort"></i>
							</div>
							<div class="edgtf-repeater-rows-holder">
								<div class="row">
									<?php foreach ( $this->fields as $field ) { ?>
										<div class="col-lg-<?php echo esc_attr( $field['size'] ) ?>">
											<?php
											$factory->render( $field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array(
												'index' => 0,
												'value' => $field['default_value']
											) );
											?>
										</div>
										<?php
										$counter ++;
									} ?>
								</div>
							</div>
							<div class="edgtf-repeater-remove">
								<a class="edgtf-clone-remove" href="#"><i class="fa fa-times"></i></a>
							</div>
						</div>
					</div>
				<?php } else {
					$j      = 0;
					$index  = 0;
					$values = array();
					foreach ( $this->fields as $field ) {
						if ( $j ++ === 0 ) { // avoid unnecessary get_post_meta call
							$values[] = $clones;
						} else {
							$values[] = get_post_meta( $post->ID, $field['name'], true );
						}
					}
					while ( isset( $clones[ $index ] ) ) { // rows
						$count = 0; ?>
						<div class="edgtf-repeater-fields-row">
							<div class="edgtf-repeater-fields-row-inner">
								<div class="edgtf-repeater-sort">
									<i class="fa fa-sort"></i>
								</div>
                                <div class="edgtf-repeater-rows-holder">
                                    <?php foreach ( $this->fields as $field ) { // columns ?>
                                        <div class="col-lg-<?php echo esc_attr( $field['size'] ) ?>">
                                            <?php
                                            $factory->render( $field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array(
                                                'index' => $index,
                                                'value' => $values[ $count ][ $index ]
                                            ) );
                                            ?>
                                        </div>
                                        <?php
                                        $count ++;
                                    } ?>
                                </div>
								<div class="edgtf-repeater-remove">
									<a class="edgtf-clone-remove" href="#"><i class="fa fa-times"></i></a>
								</div>
							</div>
						</div>
						<?php
						++ $index;
					}
					$this->num_of_rows = $index;
				}
				?>
			</div>
			<div class="edgtf-repeater-add">
				<a class="edgtf-clone btn btn-sm btn-primary" data-count="<?php echo esc_attr( $this->num_of_rows ) ?>" href="#"><?php echo esc_html( $this->button_text ); ?></a>
			</div>
		</div>
		<?php
	}
}

class AaltoEdgeParentChildRepeater implements iAaltoEdgeRender {
	private $num_of_rows;
	private $name;
	private $label;
	private $description;
	private $fields;
	private $not_used_fields;
	
	function __construct( $name, $label = '', $description = '', $fields ) {
		global $aalto_edge_Framework;
		
		$this->num_of_rows = 1;
		$this->name        = $name;
		$this->label       = $label;
		$this->description = $description;
		$this->fields      = $fields;
		
		$counter = 0;
		foreach ( $this->fields as $field ) {
			if ( ! isset( $this->fields[ $counter ]['options'] ) ) {
				$this->fields[ $counter ]['options'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['args'] ) ) {
				$this->fields[ $counter ]['args'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['hidden'] ) ) {
				$this->fields[ $counter ]['hidden'] = false;
			}
			if ( ! isset( $this->fields[ $counter ]['label'] ) ) {
				$this->fields[ $counter ]['label'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['description'] ) ) {
				$this->fields[ $counter ]['description'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['default_value'] ) ) {
				$this->fields[ $counter ]['default_value'] = '';
			}
			
			$counter ++;
		}
		$this->not_used_fields = $this->fields;
		$aalto_edge_Framework->edgtfMetaBoxes->addOption( $this->name, "" );
	}
	
	public function render( $factory ) {
		global $post;
		
		$clones = array();
		if ( ! empty( $post ) ) {
			$clones = get_post_meta( $post->ID, $this->name, true );
		}
		?>
		<div class="edgtf-repeater-wrapper">
			<div class="edgtf-repeater-fields-holder edgtf-enable-pc edgtf-sortable-holder clearfix" data-fields-number="<?php echo esc_attr( sizeof( $this->fields ) ) ?>">
				<?php if ( empty( $clones ) ) {
					foreach ( $this->fields as $field ) {
						$sorting_class = 'edgtf-sort-' . $field['role'];
						if ( $field['role'] == 'parent' ) {
							$sorting_class .= ' first-level';
						} else {
							$sorting_class .= ' second-level';
						}
						?>
						<div class="edgtf-repeater-fields-row <?php echo esc_attr( $sorting_class ); ?> edgtf-initially-hidden" data-name="<?php echo esc_attr( $field['name'] ); ?>">
							<div class="edgtf-repeater-fields-row-inner">
								<div class="edgtf-repeater-sort">
									<i class="fa fa-sort"></i>
								</div>
								<div class="edgtf-repeater-field-item">
									<?php
									$factory->render( $field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array(
										'index' => 0,
										'name'  => $this->name,
										'value' => $field['default_value']
									) );
									?>
								</div>
								<div class="edgtf-repeater-remove">
									<a class="edgtf-clone-remove" href="#" data-name="<?php echo esc_attr( $field['name'] ); ?>"><i class="fa fa-times"></i></a>
								</div>
							</div>
						</div>
					<?php }
				} else {
					$index = 0;
					$values = $clones;
					foreach ( $values as $value ) {
						if ( is_numeric( $value ) ) {
							$type = get_post_type( $value );
							foreach ( $this->fields as $key => $field ) {
								if ( $field['name'] == $type ) {
									unset( $this->not_used_fields[ $key ] );
									$sorting_class = 'edgtf-sort-' . $field['role'];
									if ( $field['role'] == 'parent' ) {
										$sorting_class .= ' first-level';
									} else {
										$sorting_class .= ' second-level';
									} ?>
									<div class="edgtf-repeater-fields-row <?php echo esc_attr( $sorting_class ); ?>" data-name="<?php echo esc_attr( $field['name'] ); ?>">
										<div class="edgtf-repeater-fields-row-inner">
											<div class="edgtf-repeater-sort">
												<i class="fa fa-sort"></i>
											</div>
											<div class="edgtf-repeater-field-item">
												<?php
												$factory->render( $field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array(
													'index' => $index,
													'name'  => $this->name,
													'value' => $value
												) );
												?>
											</div>
											<div class="edgtf-repeater-remove">
												<a class="edgtf-clone-remove" data-name="<?php echo esc_attr( $field['name'] ); ?>" href="#"><i class="fa fa-times"></i></a>
											</div>
										</div>
									</div>
									<?php
								}
							}
						} else {
							foreach ( $this->fields as $key => $field ) {
								if ( $field['role'] == 'parent' ) {
									unset( $this->not_used_fields[ $key ] );
									$sorting_class = 'edgtf-sort-parent';
									$sorting_class .= ' first-level';
									?>
									<div class="edgtf-repeater-fields-row <?php echo esc_attr( $sorting_class ); ?>" data-name="<?php echo esc_attr( $field['name'] ); ?>">
										<div class="edgtf-repeater-fields-row-inner">
											<div class="edgtf-repeater-sort">
												<i class="fa fa-sort"></i>
											</div>
											<div class="edgtf-repeater-field-item">
												<?php
												$factory->render( $field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array(
													'index' => $index,
													'name'  => $this->name,
													'value' => $value
												) );
												?>
											</div>
											<div class="edgtf-repeater-remove">
												<a class="edgtf-clone-remove" href="#" data-name="<?php echo esc_attr( $field['name'] ); ?>"><i class="fa fa-times"></i></a>
											</div>
										</div>
									</div>
									<?php
								}
							}
						}
						++ $index;
					}
					
					foreach ( $this->not_used_fields as $field ) {
						$sorting_class = 'edgtf-sort-' . $field['role'];
						if ( $field['role'] == 'parent' ) {
							$sorting_class .= ' first-level';
						} else {
							$sorting_class .= ' second-level';
						}
						?>
						<div class="edgtf-repeater-fields-row <?php echo esc_attr( $sorting_class ); ?> edgtf-initially-hidden"
						     data-name="<?php echo esc_attr( $field['name'] ); ?>">
							<div class="edgtf-repeater-fields-row-inner">
								<div class="edgtf-repeater-sort">
									<i class="fa fa-sort"></i>
								</div>
								<div class="edgtf-repeater-field-item">
									<?php
									$factory->render( $field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $field['hidden'], array(
										'index' => 0,
										'name'  => $this->name,
										'value' => $field['default_value']
									) );
									?>
								</div>
								<div class="edgtf-repeater-remove">
									<a class="edgtf-clone-remove" href="#" data-name="<?php echo esc_attr( $field['name'] ); ?>"><i class="fa fa-times"></i></a>
								</div>
							</div>
						</div>
					<?php }
				}
				?>
			</div>
			<?php foreach ( $this->fields as $field ) { ?>
				<div class="edgtf-repeater-add">
					<a class="edgtf-clone btn btn-sm btn-primary" data-count="<?php echo esc_attr( $this->num_of_rows ) ?>" data-name="<?php echo esc_attr( $field['name'] ) ?>" href="#"><?php echo esc_html( $field['button_text'] ); ?></a>
				</div>
			<?php } ?>
		</div>
		<?php
	}
}

class AaltoEdgeFieldAddress extends AaltoEdgeFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {
		$col_width = 12;
		if ( isset( $args["col_width"] ) ) {
			$col_width = $args["col_width"];
		}
		
		$suffix = ! empty( $args['suffix'] ) ? $args['suffix'] : false;
		
		$class = $id = $country = $lat_field = $long_field = '';
		if ( ! empty( $repeat ) ) {
			if ( array_key_exists( 'index', $repeat ) ) {
				$id = $name . '-' . $repeat['index'];
			} else {
				$id = $name;
			}
			if ( array_key_exists( 'name', $repeat ) ) {
				$name = $repeat['name'];
			}
			$name  .= '[]';
			$value = $repeat['value'];
			$class = 'edgtf-repeater-field';
		} else {
			$id    = $name;
			$value = aalto_edge_option_get_value( $name );
		}
		
		if ( $label === '' && $description === '' ) {
			$class .= ' edgtf-no-description';
		}
		
		if ( isset( $args['country'] ) && $args['country'] != '' ) {
			$country = $args['country'];
		}

        if ( isset( $args['latitude_field'] ) && $args['latitude_field'] != '' ) {
            $lat_field = $args['latitude_field'];
        }

        if ( isset( $args['longitude_field'] ) && $args['longitude_field'] != '' ) {
            $long_field = $args['longitude_field'];
        }
		?>
		
		<div class="edgtf-page-form-section edgtf-address-field <?php echo esc_attr( $class ); ?>" data-country="<?php echo esc_attr( $country ); ?>" data-lat-field="<?php echo esc_attr( $lat_field ); ?>" data-long-field="<?php echo esc_attr( $long_field ); ?>" id="edgtf_<?php echo esc_attr( $id ); ?>"<?php if ( $hidden ) { ?> style="display: none"<?php } ?>>
			<div class="edgtf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="edgtf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-<?php echo esc_attr( $col_width ); ?>">
							<?php if ( $suffix ) : ?>
							<div class="input-group">
								<?php endif; ?>
								<input type="text" class="form-control edgtf-input edgtf-form-element" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( htmlspecialchars( $value ) ); ?>"/>
								<?php if ( $suffix ) : ?>
									<div class="input-group-addon"><?php echo esc_html( $args['suffix'] ); ?></div>
								<?php endif; ?>
								<?php if ( $suffix ) : ?>
							</div>
						<?php endif; ?>
							<div class="map_canvas"></div>
							<button id="find" class="btn btn-primary"><?php esc_html_e( 'Place the pin on the map', 'aalto' ); ?></button>
							<a id="reset" href="#" style="display:none;"><?php esc_html_e( 'Reset Marker', 'aalto' ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}