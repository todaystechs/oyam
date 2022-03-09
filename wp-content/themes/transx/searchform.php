<?php
/*
 * Created by Artureanec
*/

$search_rand = mt_rand(0, 999);
?>

<form name="search_form" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="transx_search_form" id="search-<?php echo esc_attr($search_rand); ?>">
    <span class="transx_icon_search" onclick="javascript:document.getElementById('search-<?php echo esc_attr($search_rand); ?>').submit();">
        <svg class="icon">
            <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.19 0a8.19 8.19 0 016.47 13.212l5.04 5.04a1.024 1.024 0 11-1.448 1.448l-5.04-5.04A8.19 8.19 0 118.19 0zm0 2.048a6.143 6.143 0 100 12.285 6.143 6.143 0 000-12.285z"/></svg>
        </svg>
    </span>
    <input type="text" name="s" value="" placeholder="<?php echo esc_attr__('Search', 'transx'); ?>" title="<?php esc_html_e('Search the site...', 'transx'); ?>" class="form__field">
    <div class="clear"></div>
</form>
