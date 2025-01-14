<?php
require_once('../../Views/general/header_view.php');
require_once('../../Views/general/footer_view.php');
require_once('../../Controllers/Partenaire/cardOffers_controller.php');

class cardOffers_view {
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

    public function cardOffers($idCard, $idComptePartenaire) {
        ?>
        <section class="py-16 bg-white">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6 text-[#339989]">Offres Valables</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-lg table-auto">
                        <thead class="bg-[#339989] text-white">
                            <tr>
                                <th class="px-6 py-3 text-left">Nom de l'offre</th>
                                <th class="px-6 py-3 text-left">Pourcentage</th>
                                <th class="px-6 py-3 text-left">Wilaya</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                try {
                                    $controller = new cardOffers_controller();
                                    $cardOffers = $controller->get_cardOffers_controller($idCard,$idComptePartenaire);
                                    foreach ($cardOffers as $cardOffer) {
                                        echo "<tr>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>" . $cardOffer["nom_offre"] . "</td>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>" . $cardOffer["pourcentage"] . "%</td>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>" . $cardOffer["wilaya"] . "</td>
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
        </section>
        <?php
    }

    public function display_cardOffers_view($idCard,$idComptePartenaire) {
        $footer = new footer_view();
        $this->head_description();
        $this->cardOffers($idCard,$idComptePartenaire);
        $footer->footer();
    }
}
?>
