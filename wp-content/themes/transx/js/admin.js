/*
 * Created by Artureanec
*/

"use strict";

function transx_reactivate_sortable() {
    jQuery('.transx_text_table_rows').sortable(
        {
            handle: '.transx_text_table_row_move',
        }
    );
}

function transx_rwmb_and_customizer_condition() {
    jQuery("[data-dependency-id]").each(function (index) {
        var transx_target = jQuery(this).attr('data-dependency-id');
        var transx_needed_val = jQuery(this).attr('data-dependency-val');
        var transx_needed_val_array = new Array();
        var transx_array_just_ok = false;

        if(transx_needed_val.indexOf(',') + 1) {
            // Work with array value
            transx_needed_val = transx_needed_val.replace(/\s+/g,'');
            transx_needed_val_array = transx_needed_val.split(",");

            var transx_this = jQuery(this);

            transx_needed_val_array.forEach(function(item, i, transx_arr) {
                if (transx_this.hasClass('transx_dependency_customizer')) {
                    if (transx_array_just_ok !== true) {
                        if (jQuery('#customize-control-' + transx_target).find('select').val() == item) {
                            transx_array_just_ok = true;
                        }
                    }
                }
                else {
                    if (transx_array_just_ok !== true) {
                        if (jQuery('#' + transx_target).val() == item) {
                            transx_array_just_ok = true;
                        }
                    }
                }
            });

            if (jQuery(this).hasClass('transx_dependency_customizer')) {
                var transx_target_status = jQuery('#customize-control-' + transx_target).find('select').val();
                var transx_dependency_elem_cont = jQuery(this).parents('.customize-control');
            } else {
                var transx_target_status = jQuery('#' + transx_target).val();
                var transx_dependency_elem_cont = jQuery(this).parents('.rwmb-field');
            }

            if (transx_array_just_ok == true) {
                transx_dependency_elem_cont.show('fast');
            } else {
                transx_dependency_elem_cont.hide('fast');
            }
        } else {
            // Just one value
            if (jQuery(this).hasClass('transx_dependency_customizer')) {
                var transx_target_status = jQuery('#customize-control-' + transx_target).find('select').val();
                var transx_dependency_elem_cont = jQuery(this).parents('.customize-control');
            } else {
                var transx_target_status = jQuery('#' + transx_target).val();
                var transx_dependency_elem_cont = jQuery(this).parents('.rwmb-field');
            }

            if (transx_needed_val == transx_target_status) {
                transx_dependency_elem_cont.show('fast');
            } else {
                transx_dependency_elem_cont.hide('fast');
            }
        }
    });
}

function transx_hide_unnecessary_options() {
    if (jQuery('.transx_this_template_file').size() < 1) {
        var transx_this_template_file = 'transx_temp_333';
    }
    if (jQuery('.transx_this_template_file').size() > 0) {
        transx_this_template_file = jQuery('.transx_this_template_file').val();
    }
    jQuery("[data-show-on-template-file]").each(function (index) {
        var transx_unnecessary_target = jQuery(this).attr('data-show-on-template-file');
        if (transx_unnecessary_target.indexOf(',') > -1) {
            var transx_unnecessary_target_array = transx_unnecessary_target.split(',');
            var transx_rwmb_del_status = 'not find';
            jQuery.each(transx_unnecessary_target_array, function (i, val) {
                if (transx_this_template_file == val.trim()) {
                    transx_rwmb_del_status = 'find';
                }
            });
            if (transx_rwmb_del_status == 'not find') {
                jQuery(this).parents('.rwmb-field').remove();
            }
        } else {
            if (transx_this_template_file !== transx_unnecessary_target) {
                jQuery(this).parents('.rwmb-field').remove();
            }
        }
    });

    jQuery("[data-hide-on-template-file]").each(function (index) {
        var transx_unnecessary_target = jQuery(this).attr('data-hide-on-template-file');
        if (transx_unnecessary_target.indexOf(',') > -1) {
            var transx_unnecessary_target_array = transx_unnecessary_target.split(',');
            var transx_rwmb_del_status = 'not find';
            jQuery.each(transx_unnecessary_target_array, function (i, val) {
                if (transx_this_template_file == val.trim()) {
                    transx_rwmb_del_status = 'find';
                }
            });
            if (transx_rwmb_del_status == 'find') {
                jQuery(this).parents('.rwmb-field').remove();
            }
        } else {
            if (transx_this_template_file == transx_unnecessary_target) {
                jQuery(this).parents('.rwmb-field').remove();
            }
        }
    });
}

jQuery(window).on('load', function () {
    var val = jQuery('#post-format-selector-0').val();

    if (typeof val !== "undefined") {
        transx_onchange_post_formats2(val);
    }
});

jQuery(document).on('change', '#post-format-selector-0', function(){
    transx_onchange_post_formats2(jQuery(this).val());
});

function transx_onchange_post_formats2(val) {
    jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');

    if (val == 'standard') {
        jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');
    }
    if (val == 'gallery') {
        jQuery('#gallery-post-format-settings').show('fast');
    }
    if (val == 'link') {
        jQuery('#link-post-format-settings').show('fast');
    }
    if (val == 'image') {
        jQuery('#image-post-format-settings').show('fast');
    }
    if (val == 'quote') {
        jQuery('#quote-post-format-settings').show('fast');
    }
    if (val == 'video') {
        jQuery('#video-post-format-settings').show('fast');
    }
    if (val == 'audio') {
        jQuery('#audio-past-format-settings').show('fast');
    }
}

function transx_onchange_post_formats() {
    var transx_post_format = jQuery('#post-formats-select input:checked').val();


    jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');

    if (transx_post_format == 'standard') {
        jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');
    }

    if (transx_post_format == 'gallery') {
        jQuery('#gallery-post-format-settings').show('fast');
    }

    if (transx_post_format == 'image') {
        jQuery('#image-post-format-settings').show('fast');
    }

    if (transx_post_format == 'video') {
        jQuery('#video-post-format-settings').show('fast');
    }

    if (transx_post_format == 'audio') {
        jQuery('#audio-past-format-settings').show('fast');
    }

    if (transx_post_format == 'quote') {
        jQuery('#quote-post-format-settings').show('fast');
    }

    if (transx_post_format == 'link') {
        jQuery('#link-post-format-settings').show('fast');
    }

    if (jQuery('#post-formats-select').length < 1) {
        // Body Class
        if (jQuery('body').hasClass('post-type-gallery')) {
            jQuery('#gallery-post-format-settings').show('fast');
            setTimeout("jQuery('#gallery-post-format-settings').show('fast')",100);
        } else if (jQuery('body').hasClass('post-type-image')) {
            jQuery('#image-post-format-settings').show('fast');
            setTimeout("jQuery('#image-post-format-settings').show('fast')",100);
        } else if (jQuery('body').hasClass('post-type-video')) {
            jQuery('#video-post-format-settings').show('fast');
            setTimeout("jQuery('#video-post-format-settings').show('fast')",100);
        } else if (jQuery('body').hasClass('post-type-audio')) {
            jQuery('#audio-past-format-settings').show('fast');
            setTimeout("jQuery('#audio-post-format-settings').show('fast')",100);
        } else if (jQuery('body').hasClass('post-type-quote')) {
            jQuery('#quote-post-format-settings').show('fast');
            setTimeout("jQuery('#quote-post-format-settings').show('fast')",100);
        } else if (jQuery('body').hasClass('post-type-link')) {
            jQuery('#link-post-format-settings').show('fast');
            setTimeout("jQuery('#link-post-format-settings').show('fast')",100);
        } else {
            jQuery('#image-post-format-settings, #video-post-format-settings, #audio-past-format-settings, #quote-post-format-settings, #link-post-format-settings, #gallery-post-format-settings').hide('fast');
        }
    }
}

jQuery(document).ready(function () {
    if (jQuery('#centered_content_hide').length) {
        console.log('i found it');
        console.log(jQuery('#centered_content_hide').val());
        if (jQuery('#centered_content_hide').val() == 'yes') {
            console.log('this is yes');
            jQuery('body').addClass('transx_hide_content');
        } else {
            console.log('this is no');
            jQuery('body').removeClass('transx_hide_content');
        }
    }
    jQuery('#centered_content_hide').on('change', function(){
        if (jQuery(this).val() == 'yes') {
            jQuery('body').addClass('transx_hide_content');
        } else {
            jQuery('body').removeClass('transx_hide_content');
        }
    });
    if (jQuery('#page_template').size() > 0 && jQuery('#page_template').val() !== 'default') {
        jQuery('body').addClass(jQuery('#page_template').val().split('.')[0]);
    }

    jQuery("[data-dependency-id]").parents('.rwmb-field').hide();

    transx_onchange_post_formats();
    transx_rwmb_and_customizer_condition();
    transx_hide_unnecessary_options();

    jQuery('.rwmb-select, .customize-control-select select').change(function () {
        transx_rwmb_and_customizer_condition();
    });

    jQuery('#post-formats-select input').on("click", function () {
        transx_onchange_post_formats();
    });

    jQuery('.transx_reset_all_settings').on("click", function () {
        if (confirm("Are you sure? All settings will be reset to default state.")) {
            jQuery.post(ajaxurl, {
                action: 'transx_reset_all_settings'
            }, function (response) {
                alert(response);
            });
        }
    });

    jQuery(document).on("click", '.transx_text_table_add_row', function () {
        var transx_text_table_data_storage_name = jQuery(this).parents('.widget-content').find('.transx_text_table_data_storage_name').val();
        var transx_text_table_name_text = jQuery(this).parents('.widget-content').find('.transx_text_table_name_text').val();
        var transx_text_table_value_text = jQuery(this).parents('.widget-content').find('.transx_text_table_value_text').val();

        jQuery(this).parents('.widget-content').find('.transx_text_table_rows').append('<div class="transx_text_table_row transx_dn"><div class="transx_50_dib"><label>' + transx_text_table_name_text + ':</label><input class="widefat" type="text" name="' + transx_text_table_data_storage_name + '[][name]" value=""></div><div class="transx_50_dib"><label>' + transx_text_table_value_text + ':</label><textarea class="widefat" type="text" name="' + transx_text_table_data_storage_name + '[][value]"></textarea></div><div class="transx_text_table_row_remove"><i class="fa fa-trash"></i></div><div class="transx_text_table_row_move"><i class="fa fa-arrows"></i></div></div>');
        jQuery('.transx_dn').slideDown("fast").removeClass('transx_dn');
    });

    jQuery(document).on("click", '.transx_text_table_row_remove', function () {
        jQuery(this).parents('.transx_text_table_row').slideUp("normal", function () {
            jQuery(this).remove();
        });
    });

    jQuery(document).on("click", '.widget-control-save', function () {
        setTimeout(function () {
            transx_reactivate_sortable()
        }, 1000);
        setTimeout(function () {
            transx_reactivate_sortable()
        }, 2000);
        setTimeout(function () {
            transx_reactivate_sortable()
        }, 3000);
    });

    transx_reactivate_sortable();
});

jQuery('.transx_color_picker .rwmb-color').each(function(){
    var color = jQuery(this).attr('placeholder');

    if (jQuery(this).val() == '') {
        jQuery(this).val(color);
    }
});


