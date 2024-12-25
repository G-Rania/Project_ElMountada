<?php
require_once('../../Views/general/header_view.php');
require_once('../../Views/general/footer_view.php');

class homePageUser_view {
    public function head_description() {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="../../output.css" rel="stylesheet" />
            <script src="../../jquery-3.7.1.min.js"></script>
        </head>
        <?php
    }

     public function display_homePageUser_view() {
        $instance = new homePageUser_view();
        $header = new header_view();
        $footer = new footer_view();
        $instance->head_description();
        $header->header();
        $footer->footer();
    }
}