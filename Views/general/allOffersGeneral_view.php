<?php
require_once('../../Views/general/header_view.php');
require_once('../../Views/general/footer_view.php');
require_once('../../Controllers/landingPage_controller.php');

class allOffersGeneral_view {
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

     public function allOffersGeneral() {
    ?>
    <div class="px-4 py-10 max-w-screen-xl mx-auto">
        <h2 class="text-center text-3xl font-semibold text-zinc-800 mb-6">Nos Offres</h2>
        <div class="overflow-x-auto">
            <table id="offersTable" class="w-full bg-offWhite border-separate border-spacing-0 rounded-lg">
                <thead class="text-left text-zinc-800 bg-offWhite rounded-t-lg">
                    <tr>
                        <th class="px-4 py-2 border-b border-white">Wilaya</th>
                        <th class="px-4 py-2 border-b border-white">Catégorie</th>
                        <th class="px-4 py-2 border-b border-white">Offre</th>
                        <th class="px-4 py-2 border-b border-white">Réduction</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-offWhite">
                    <?php
                    try {
                        $controller = new landingPage_controller();
                        $offers = $controller->get_offers_controller();
                        foreach ($offers as $offer) {
                            echo "<tr class='text-zinc-800 border-b border-white'>
                                    <td class='px-4 py-2 border-b border-white'>" . $offer["wilaya"] . "</td>";
                            try {
                                $controller2 = new landingPage_controller();
                                echo "<td class='px-4 py-2 border-b border-white'>" . $controller2->get_categoryOffer_controller($offer["idPartenaire"]) . "</td>";
                            } catch (PDOException $ex) {
                                echo "<td class='px-4 py-2 text-red-500'>Erreur</td>";
                            }
                            echo "<td class='px-4 py-2 border-b border-white'>" . $offer["nom"] . "</td>
                                  <td class='px-4 py-2 border-b border-white'>" . $offer["pourcentage"] . "%</td>
                                  </tr>";
                        }
                    } catch (PDOException $ex) {
                        echo "<p class='text-red-500'>Erreur : " . $ex->getMessage() . "</p>";
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </div>
    <?php
}


     public function display_allOffersGeneral_view() {
        $instance = new allOffersGeneral_view();
        $header = new header_view();
        $footer = new footer_view();
        $instance->head_description();
        $header->display_header_view();
        $instance->allOffersGeneral();
        $footer->footer();
    }
}