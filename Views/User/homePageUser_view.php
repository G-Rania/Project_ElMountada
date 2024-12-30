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

    public function header_homePageUser_view() {
    ?>
    <div class="flex justify-between items-center">
        <?php
            //display header
            $header = new header_view();
            $header->header();
        ?>
        <div class="flex flex-row gap-6 mr-7">
            <button id="subscriptionBtn" class="text-lg text-white bg-[#339989] hover:bg-[#226e63] px-3 py-1 rounded-full focus:outline-none">
                <span>Acheter une carte</span>
            </button>
        </div>
    </div>

    <!-- Redirection to subscription page -->
    <script>
        document.getElementById('subscriptionBtn').addEventListener('click', function() {
            window.location.href = '../User/subscriptionUser.php'; 
        });
    </script>

    <?php
}

     public function display_homePageUser_view() {
        $instance = new homePageUser_view();
        $footer = new footer_view();
        $instance->head_description();
        $instance->header_homePageUser_view();
        $footer->footer();
    }
}