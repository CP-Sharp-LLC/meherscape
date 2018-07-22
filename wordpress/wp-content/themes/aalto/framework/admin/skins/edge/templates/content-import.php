<div class="edgtf-tabs-content">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="import">
            <div class="edgtf-tab-content">
                <h2 class="edgtf-page-title"><?php esc_html_e('Import', 'aalto'); ?></h2>
                <form method="post" class="edgtf_ajax_form edgtf-import-page-holder" data-confirm-message="<?php esc_html_e('Are you sure, you want to import Demo Data now?', 'aalto'); ?>">
                    <div class="edgtf-page-form">
                        <div class="edgtf-page-form-section-holder">
                            <h3 class="edgtf-page-section-title"><?php esc_html_e('Import Demo Content', 'aalto'); ?></h3>
                            <div class="edgtf-page-form-section">
                                <div class="edgtf-field-desc">
                                    <h4><?php esc_html_e('Import', 'aalto'); ?></h4>
                                    <p><?php esc_html_e('Choose demo content you want to import', 'aalto'); ?></p>
                                </div>
                                <div class="edgtf-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <select name="import_example" id="import_example" class="form-control edgtf-form-element dependence">
                                                    <option value="aalto"><?php esc_html_e('Aalto Demo', 'aalto'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgtf-page-form-section">
                                <div class="edgtf-field-desc">
                                    <h4><?php esc_html_e('Import Type', 'aalto'); ?></h4>
	                                <p><?php esc_html_e('Import Type', 'aalto'); ?></p>
                                </div>
                                <div class="edgtf-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <select name="import_option" id="import_option" class="form-control edgtf-form-element">
                                                    <option value=""><?php esc_html_e('Please Select', 'aalto'); ?></option>
                                                    <option value="complete_content"><?php esc_html_e('All', 'aalto'); ?></option>
                                                    <option value="content"><?php esc_html_e('Content', 'aalto'); ?></option>
                                                    <option value="widgets"><?php esc_html_e('Widgets', 'aalto'); ?></option>
                                                    <option value="options"><?php esc_html_e('Options', 'aalto'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgtf-page-form-section">
                                <div class="edgtf-field-desc">
                                    <h4><?php esc_html_e('Import attachments', 'aalto'); ?></h4>
                                    <p><?php esc_html_e('Do you want to import media files?', 'aalto'); ?></p>
                                </div>
                                <div class="edgtf-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="field switch">
                                                    <label class="cb-enable dependence"><span><?php esc_html_e('Yes', 'aalto'); ?></span></label>
                                                    <label class="cb-disable selected dependence"><span><?php esc_html_e('No', 'aalto'); ?></span></label>
                                                    <input type="checkbox" id="import_attachments" class="checkbox" name="import_attachments" value="1">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgtf-page-form-section">
                                <div class="edgtf-field-desc">
                                    <input type="submit" class="btn btn-primary btn-sm " value="<?php esc_html_e('Import', 'aalto'); ?>" name="import" id="edgtf-import-demo-data" />
                                </div>
                                <div class="edgtf-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="edgtf-import-load"><span><?php esc_html_e('The import process may take some time. Please be patient.', 'aalto') ?> </span><br />
                                                    <div class="edgtf-progress-bar-wrapper html5-progress-bar">
                                                        <div class="progress-bar-wrapper">
                                                            <progress id="progressbar" value="0" max="100"></progress>
                                                        </div>
                                                        <div class="progress-value">0%</div>
                                                        <div class="progress-bar-message">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgtf-page-form-section edgtf-import-button-wrapper">
                                <div class="alert alert-warning">
                                    <strong><?php esc_html_e('Important notes:', 'aalto') ?></strong>
                                    <ul>
                                        <li><?php esc_html_e('Please note that import process will take time needed to download all attachments from demo web site.', 'aalto'); ?></li>
                                        <li> <?php esc_html_e('If you plan to use shop, please install WooCommerce before you run import.', 'aalto')?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>