<?php

function eduvibe_child_enqueue_styles() {
	wp_enqueue_style( 'eduvibe-child-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'eduvibe_child_enqueue_styles', 100 );

function replace_student_text_script() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        function replaceStudentText() {
            $('body').html(function(i, html) {
                return html.replace(/Students/g, 'people');
            });
        }

        // Call the function on page load
        replaceStudentText();

        // Optional: Call the function again when AJAX content loads
        $(document).on('ajaxComplete', function() {
            replaceStudentText();
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'replace_student_text_script');
