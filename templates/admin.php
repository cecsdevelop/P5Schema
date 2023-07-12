<?php
/**
 * @package p5schema
 * 
 * Admin General
 */
?>
<div class='wrap'>
    <h1>Admin.php</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php
            settings_fields( 'p5schema_option_group' );
            do_settings_sections( 'p5Schema_general' );
            submit_button('Save Schema');
        ?>

    </form>
</div>


