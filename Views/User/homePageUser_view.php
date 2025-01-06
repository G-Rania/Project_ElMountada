<?php
require_once('../../Views/general/header_view.php');
require_once('../../Views/general/footer_view.php');
require_once('../../Controllers/User/homePageUser_controller.php');
require_once('../../Views/landingPage_view.php');

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
            <button id="subscriptionBtn" class="text-base text-[#339989] border-[#339989] border-2 hover:bg-[#339989] hover:text-white px-3 py-1 rounded-full focus:outline-none">
                <span>Acheter une carte</span>
            </button>
            <button id="displayCardBtn" class="text-base text-white bg-[#339989] hover:bg-[#226e63] px-3 py-1 rounded-full focus:outline-none">
                <span>Ma carte</span>
            </button>
        </div>
    </div>

    <!-- Redirection to subscription page -->
    <script>
        document.getElementById('subscriptionBtn').addEventListener('click', function() {
            window.location.href = '../User/subscriptionUser.php'; 
        });
         document.getElementById('displayCardBtn').addEventListener('click', function() {
            window.location.href = '../User/cardUser.php'; 
        });
    </script>

    <?php
}

    public function heroSection() {
    ?>
    <div class="bg-gradient-to-r from-[#339989] to-[#226e63] text-white py-20 mb-9">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col lg:flex-row items-center justify-between">
            <!-- Left Content -->
            <div class="lg:w-1/2 text-center lg:text-left">
                <h1 class="text-5xl font-extrabold mb-6">
                    Aidez-nous à transformer des vies
                </h1>
                <p class="text-lg mb-8">
                    Chaque don fait une différence. Contribuez aujourd'hui et soutenez notre mission
                    d'apporter de l'espoir et des opportunités aux communautés dans le besoin.
                </p>
                <button id="donateButton" class="text-lg font-medium text-[#226e63] bg-white px-6 py-3 rounded-full shadow-lg hover:bg-gray-100 hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-hand-holding-heart mr-2"></i> Faire un don
                </button>
            </div>

            <!-- Right Content -->
            <div class="lg:w-1/3 h-auto max-w-xs mt-10 lg:mt-0 flex justify-center lg:justify-end">
                <img src="../../assets/general/illustration-donation.svg" alt="Illustration donation" class="w-2/3 lg:w-full max-w-md">
            </div>
        </div>
    </div>

    <script>
        document.getElementById('donateButton').addEventListener('click', function() {
            window.location.href = '../User/donationPage.php'; // Remplacez par le lien correct
        });
    </script>
    <?php
}

    public function specialOffersUser($idUser){
        try {
        $controller = new homePageUser_controller();
        $offers = $controller->get_specialOffersUser_controller($idUser);

        if (!$offers) {
            return; 
        }
    } catch (PDOException $ex) {
        echo "<p class='text-red-500'>Erreur : " . $ex->getMessage() . "</p>";
        return; 
    }
    ?>
      <div class="px-4 py-10 max-w-screen-xl mx-auto">
        <h2 class="text-left ml-5 text-xl font-semibold text-zinc-800 mb-6">Offres speciales</h2>
        <div class="overflow-x-auto">
            <table id="offersTable" class="w-full bg-offWhite border-separate border-spacing-0 rounded-lg">
                <thead class="text-left text-zinc-800 bg-offWhite rounded-t-lg">
                    <tr>
                        <th class="px-4 py-2 border-b border-white">Wilaya</th>
                        <th class="px-4 py-2 border-b border-white">Catégorie</th>
                        <th class="px-4 py-2 border-b border-white">Etablissement</th>
                        <th class="px-4 py-2 border-b border-white">Offre</th>
                        <th class="px-4 py-2 border-b border-white">Date fin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-offWhite">
                    <?php
                    foreach ($offers as $index => $offer) {
                        echo "<tr class='text-zinc-800 hidden border-b border-white'>
                                <td class='px-4 py-2 border-b border-white'>" . $offer["ville"] . "</td>
                                <td class='px-4 py-2 border-b border-white'>" . $offer["categorie"] . "</td>
                                <td class='px-4 py-2 border-b border-white'>" . $offer["nom_partenaire"] . "</td>
                                <td class='px-4 py-2 border-b border-white'>" . $offer["description_offre"] . "</td>
                                <td class='px-4 py-2 border-b border-white'>" . $offer["date_fin"] . "</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
      </div>
    <?php
}
    public function offersUser($idUser) {
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
        <div class="overflow-x-auto">
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
                    foreach ($offers as $index => $offer) {
                        echo "<tr class='text-zinc-800 hidden border-b border-white'>
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

        <!-- Pagination -->
        <div class="flex justify-center mt-6 space-x-2">
            <button id="prevPage" class="px-4 py-2 mx-1 text-sm font-medium text-white bg-[#7DE2D1] rounded-lg hover:bg-[#339989]" disabled>
                Précédent
            </button>
            <button id="nextPage" class="px-4 py-2 mx-1 text-sm font-medium text-white bg-[#7DE2D1] rounded-lg hover:bg-[#339989]">
                Suivant
            </button>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const rows = document.querySelectorAll("#offersTable tbody tr");
                const rowsPerPage = 10;
                let currentPage = 1;

                const renderTable = () => {
                    rows.forEach((row, index) => {
                        row.classList.add("hidden");
                        if (
                            index >= (currentPage - 1) * rowsPerPage &&
                            index < currentPage * rowsPerPage
                        ) {
                            row.classList.remove("hidden");
                        }
                    });

                    // Gérer l'état des boutons
                    document.getElementById("prevPage").disabled = currentPage === 1;
                    document.getElementById("nextPage").disabled = currentPage * rowsPerPage >= rows.length;
                };

                document.getElementById("prevPage").addEventListener("click", () => {
                    if (currentPage > 1) {
                        currentPage--;
                        renderTable();
                    }
                });

                document.getElementById("nextPage").addEventListener("click", () => {
                    if (currentPage * rowsPerPage < rows.length) {
                        currentPage++;
                        renderTable();
                    }
                });

                renderTable(); // Initialisation
            });
        </script>
    </div>
    <?php
}


     public function display_homePageUser_view($idUser) {
        $instance = new homePageUser_view();
        $footer = new footer_view();
        $landingPageElement = new landingPage_view();
        $instance->head_description();
        $instance->header_homePageUser_view();
        $instance->heroSection();
        $instance->specialOffersUser($idUser);
        $instance->offersUser($idUser);
        $landingPageElement->events();
        $footer->footer();
    }
}