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

    public function header_homePageUser_view($idUser) {
    try {
        echo '<div class="flex justify-between items-center">';
        $header = new header_view();
        $header->header();
        $controller = new homePageUser_controller();
        $card = $controller->get_cardUser_controller($idUser);

        if ($card == 0) {
            echo '<div class="flex flex-row gap-6 mr-7">
                <button id="buyCardBtn" class="text-base text-[#339989] border-[#339989] border-2 hover:bg-[#339989] hover:text-white px-3 py-1 rounded-full focus:outline-none">
                <span>Acheter une carte</span>
                </button>
                </div>';
        } else {
            // Remplissage des données de la carte
            echo '<div class="flex flex-row gap-6 mr-7">
                <button id="updateCardBtn" class="text-base text-[#339989] border-[#339989] border-2 hover:bg-[#339989] hover:text-white px-3 py-1 rounded-full focus:outline-none">
                <span>Mettre à jour la carte</span>
                </button>
                <button id="displayCardBtn" data-card-info=\'' . json_encode($card) . '\' class="text-base text-white bg-[#339989] hover:bg-[#226e63] px-3 py-1 rounded-full focus:outline-none">
                    <span>Ma carte</span>
                </button>
                </div>';
        }
        echo '</div>';

        // Boîte de dialogue (modal)
        echo '
        <div id="cardModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-xl font-semibold text-[#339989] mb-4">Ma Carte</h2>
                <div id="cardDetails" class="text-gray-700">
                    <div class="flex justify-center mb-4">
                        <img id="cardPhoto" src="" alt="Photo de la carte" class="w-32 h-32 rounded-full shadow-md">
                    </div>
                    <p><strong>ID Carte :</strong> <span id="cardId"></span></p>
                    <p><strong>Nom :</strong> <span id="nom"></span></p>
                    <p><strong>Prénom :</strong> <span id="prenom"></span></p>
                    <p><strong>Type de carte :</strong> <span id="cardType"></span></p>
                    <p><strong>Date expiration :</strong> <span id="cardExpiry"></span></p>
                </div>
                <div class="flex justify-end mt-4">
                    <button id="closeModalBtn" class="text-white bg-[#339989] hover:bg-[#226e63] px-4 py-2 rounded-full">Fermer</button>
                </div>
            </div>
        </div>';
    } catch (PDOException $ex) {
        echo "<p class='text-red-500'>Erreur : " . $ex->getMessage() . "</p>";
        return;
    }
    ?>
    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('buyCardBtn')?.addEventListener('click', function () {
                window.location.href = '../User/subscriptionUser.php';
            });

            document.getElementById('updateCardBtn')?.addEventListener('click', function () {
                window.location.href = '../User/subscriptionUser.php';
            });

            document.getElementById('displayCardBtn')?.addEventListener('click', function () {
                const cardInfo = JSON.parse(this.getAttribute('data-card-info'));
                document.getElementById('cardId').textContent = cardInfo.ID;
                document.getElementById('nom').textContent = cardInfo.nom;
                document.getElementById('prenom').textContent = cardInfo.prenom;
                document.getElementById('cardType').textContent = cardInfo.type_carte_nom;
                document.getElementById('cardExpiry').textContent = cardInfo.date_exp;

                const photoElement = document.getElementById('cardPhoto');
                photoElement.src = cardInfo.photo;
                photoElement.alt = `Photo de ${cardInfo.nom} ${cardInfo.prenom}`;

                document.getElementById('cardModal').classList.remove('hidden');
            });

            document.getElementById('closeModalBtn')?.addEventListener('click', function () {
                document.getElementById('cardModal').classList.add('hidden');
            });
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

    <!-- Modale pour suivi des dons -->
        <div id="traceModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-xl font-bold text-gray-900 mb-4">Compte CCP : <span class="font-semibold">2233455566</span></p>
                <p class="text-lg font-medium text-gray-800 mb-4">Voulez vous garder trace de vos dons ?</p>
                <div class="flex justify-end space-x-4">
                    <button id="acceptBtn" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-700">Accepter</button>
                    <button id="refuseBtn" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Refuser</button>
                </div>
            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Ouvrir la modale
            document.getElementById("donateButton").addEventListener("click", () => {
               document.getElementById('traceModal').classList.remove('hidden');
            });

            // Fermer la modale
            document.getElementById("refuseBtn").addEventListener("click", () => {
                document.getElementById('traceModal').classList.add('hidden');
            });

            // Confirmer l'acceptation dans la modale
            document.getElementById("acceptBtn").addEventListener("click", () => {
                window.location.href = '../User/donnation.php';
            });
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
            <table id="specialOffersTable" class="w-full bg-offWhite border-separate border-spacing-0 rounded-lg">
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
      <script>
            document.addEventListener("DOMContentLoaded", function () {
                const rows = document.querySelectorAll("#specialOffersTable tbody tr");
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
            <button
                id="allOffersBtn" class="justify-end self-end mt-4 text-sm text-emerald-500 hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-300">
                Voir toutes les offres →
            </button>
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

             // Ouvrir la page des remises
            document.getElementById("allOffersBtn").addEventListener("click", () => {
                window.location.href = '../User/allOffers.php';
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
        $instance->header_homePageUser_view($idUser);
        $instance->heroSection();
        $instance->specialOffersUser($idUser);
        $instance->offersUser($idUser);
        $landingPageElement->events();
        $footer->footer();
    }
}