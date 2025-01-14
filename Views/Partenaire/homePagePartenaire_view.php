<?php
require_once('../../Views/general/header_view.php');
require_once('../../Views/general/footer_view.php');
require_once('../../Controllers/Partenaire/homePagePartenaire_controller.php');

class homePagePartenaire_view {
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

    public function heroSection() {
        ?>
        <section class="relative bg-gradient-to-r  from-[#b5e3d5] via-[#67b7a1] to-[#339989] text-white py-24">
            <div class="container mx-auto text-center">
                <h1 class="text-5xl font-bold mb-6">Bienvenue sur votre espace Partenaire</h1>
                <p class="text-lg mb-8">Gérez vos offres et cartes avec facilité, efficacité et sécurité.</p>
                <a href="#search" class="bg-white text-[#339989] px-8 py-3 text-xl font-semibold rounded-full hover:bg-gray-100 transition-all">Commencer</a>
            </div>
            <div class="absolute w-28 top-0 left-0 rounded-lg m-4">
                <img
                    loading="lazy"
                    src="../../assets/general/logoElMountada.png"
                    alt="Company Logo"
                    class="object-contain w-full"
                />
            </div>
        </section>
        <?php
    }

    // Formulaire de recherche d'ID de carte
    public function searchCardId() {
        ?>
        <section id="search" class="py-16 bg-[#f0fdf8]">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6 text-[#339989]">Rechercher une carte</h2>
                <form method="post" action="cardOffers.php" class="flex justify-center space-x-4">
                    <input type="text" id="cardId" name="cardId" placeholder="Entrez l'ID de la carte" required class="px-6 py-3 rounded-lg border-2 border-[#67b7a1] text-lg focus:outline-none focus:border-[#339989]" />
                    <button type="submit" class="bg-[#339989] text-white px-6 py-3 rounded-lg text-lg hover:bg-[#267d6e] transition-all">Rechercher</button>
                </form>
            </div>
        </section>
        <?php
    }

    // Liste des offres disponibles
    public function display_offers($idComptePartenaire) {
        ?>
        <section class="py-16 bg-white">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6 text-[#339989]">Vos Offres</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-lg table-auto">
                        <thead class="bg-[#339989] text-white">
                            <tr>
                                <th class="px-6 py-3 text-left">Nom de l'offre</th>
                                <th class="px-6 py-3 text-left">Pourcentage</th>
                                <th class="px-6 py-3 text-left">Wilaya</th>
                                <th class="px-6 py-3 text-left">Type de carte</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                try {
                                    $controller = new homePagePartenaire_controller();
                                    $offers = $controller->get_offersPartenaire_controller($idComptePartenaire);
                                    foreach ($offers as $offer) {
                                        echo "<tr>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>" . $offer["nom"] . "</td>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>" . $offer["pourcentage"] . "%</td>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>" . $offer["wilaya"] . "</td>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>" . $offer["type_carte_nom"] . "</td>
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

    public function display_homePagePartenaire_view($idComptePartenaire) {
        $instance = new homePagePartenaire_view();
        $footer = new footer_view();
        
        $instance->head_description();
        $this->heroSection();
        $this->searchCardId();
        $this->display_offers($idComptePartenaire);
        
        $footer->footer();
    }
}
?>
