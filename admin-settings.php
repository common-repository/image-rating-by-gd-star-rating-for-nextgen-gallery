<div class="wrap">
    <?php screen_icon(); ?>
    <h2><?= esc_html(NggGdsrImageRating::instance()->pluginTitle) ?> Options</h2>

    <form method="post" action="options.php">
        <? settings_fields( 'ngggdsr_general_options' ); ?>
        <? do_settings_sections('nextgen-gdstarrating-image-rating/admin-settings.php') ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row">GD Star Rating shortcode</th>
                <td><input type="text" name="ngggdsr_option_shortcode" value="<?php echo get_option('ngggdsr_option_shortcode'); ?>" /></td>
            </tr>
        </table>

        <? submit_button(); ?>
    </form>
</div>