<?php
require_once('../../Views/general/header_view.php');
require_once('../../Views/general/footer_view.php');
require_once('../../Controllers/User/homePageUser_controller.php');
require_once('../../Views/User/homePageUser_view.php');

class allOffers_view {
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

    public function allOffersUser($idUser) {
    try {
        $controller = new homePageUser_controller();
        $offers = $controller->get_offersUser_controller($idUser);

        if (!$offers) {
            return; 
        }
    } catch (PDOException $ex) {
        echo "<p class='text-red-500'>Erreur : " . $ex->getMessage() . "</p>";
        return; 
    }
    ?>
    <div class="px-4 py-10 max-w-screen-xl mx-auto">
        <h2 class="text-left ml-5 text-xl font-semibold text-zinc-800 mb-6">Offres disponibles</h2>
        <div class="overflow-x-auto flex flex-col">
            <table id="offersTable" class="w-full bg-offWhite border-separate border-spacing-0 rounded-lg">
                <thead class="text-left text-zinc-800 bg-offWhite rounded-t-lg">
                    <tr>
                        <th class="px-4 py-2 border-b border-white">Wilaya</th>
                        <th class="px-4 py-2 border-b border-white">Catégorie</th>
                        <th class="px-4 py-2 border-b border-white">Etablissement</th>
                        <th class="px-4 py-2 border-b border-white">Offre</th>
                        <th class="px-4 py-2 border-b border-white">Réduction</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-offWhite">
                    <?php
                    foreach ($offers as $offer) {
                        echo "<tr class='text-zinc-800 border-b border-white'>
                                <td class='px-4 py-2 border-b border-white'>" . $offer["wilaya"] . "</td>
                                <td class='px-4 py-2 border-b border-white'>" . $offer["categorie"] . "</td>
                                <td class='px-4 py-2 border-b border-white'>" . $offer["nom_partenaire"] . "</td>
                                <td class='px-4 py-2 border-b border-white'>" . $offer["nom_offre"] . "</td>
                                <td class='px-4 py-2 border-b border-white'>" . $offer["pourcentage"] . "%</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
    </div>
    <?php
}


     public function display_allOffers_view($idUser) {
        $instance = new allOffers_view();
        $footer = new footer_view();
        $homePageElement = new homePageUser_view();
        $instance->head_description();
        $homePageElement->header_homePageUser_view($idUser);
        $instance->allOffersUser($idUser);
        $footer->footer();
    }
}