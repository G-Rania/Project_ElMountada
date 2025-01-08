<?php
require_once('../../Views/general/sidebar_view.php');
require_once('../../Controllers/Admin/users_controller.php');

class users_view {
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

    public function users(){
        ?>
    <div class="px-4 py-10 max-w-screen-xl mx-auto">
        <h2 class=" text-left text-2xl font-semibold text-zinc-800 mb-6">Utilisateurs</h2>
        <div class="overflow-x-auto">
            <table id="offersTable" class="w-full bg-offWhite border-separate border-spacing-0 rounded-3xl">
                <thead class="text-left text-zinc-800 bg-offWhite rounded-t-lg">
                    <tr>
                        <th class="px-4 py-2 border-b border-white">Nom</th>
                        <th class="px-4 py-2 border-b border-white">Prénom</th>
                        <th class="px-4 py-2 border-b border-white">Nom d'utilisateur</th>
                        <th class="px-4 py-2 border-b border-white">Email</th>
                        <th class="px-4 py-2 border-b border-white">Numéro de téléphone</th>
                        <th class="px-4 py-2 border-b border-white">Carte</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-offWhite">
                    <?php
                    try {
                        $controller = new users_controller();
                        $users = $controller->get_users_controller();
                        foreach ($users as $user) {
                            echo "<tr class='text-zinc-800 hidden border-b border-white'>
                                    <td class='px-4 py-2 border-b border-white'>" . $user["nom"] . "</td>
                                    <td class='px-4 py-2 border-b border-white'>" . $user["prenom"] . "</td>
                                    <td class='px-4 py-2 border-b border-white'>" . $user["username"] . "</td>
                                    <td class='px-4 py-2 border-b border-white'>" . $user["email"] . "</td>
                                    <td class='px-4 py-2 border-b border-white'>" . $user["num_tlp"] . "</td>
                                    <td class='px-4 py-2 border-b border-white'>";
                                    if ($user["isMember"] == 1) {
                                            echo "<button data-card-info='" . json_encode($user) . "' class='displayCardBtn text-lg text-[#339989] border-[#339989] border-2 hover:bg-[#339989] hover:text-white px-3 py-1 rounded-full focus:outline-none'>
                                                    <span>Voir carte</span>
                                                </button>";
                                        } else {
                                            // Affiche un message si l'utilisateur n'est pas membre
                                            echo "<span class='text-red-500'>Non membre</span>";
                                        }
                                    echo "</td></tr>";
                        }
                    } catch (PDOException $ex) {
                        echo "<p class='text-red-500'>Erreur : " . $ex->getMessage() . "</p>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Affichage carte -->
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
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-6 space-x-2">
            <button id="prevPage" class="px-4 py-2 mx-1 text-sm font-medium text-white bg-[#339989] rounded-lg hover:bg-[#226e63]" disabled>
                Précédent
            </button>
            <button id="nextPage" class="px-4 py-2 mx-1 text-sm font-medium text-white bg-[#339989] rounded-lg hover:bg-[#226e63]">
                Suivant
            </button>
        </div>

        <script>

            // Gestionnaire pour ouvrir la modal

            document.querySelectorAll(".displayCardBtn").forEach(btn => {
                btn.addEventListener("click", function () {
                const cardInfo = JSON.parse(this.getAttribute('data-card-info'));
                if (cardInfo.idCarte){
                    document.getElementById('cardId').textContent = cardInfo.idCarte;
                    document.getElementById('nom').textContent = cardInfo.nom;
                    document.getElementById('prenom').textContent = cardInfo.prenom;
                    document.getElementById('cardType').textContent = cardInfo.type_carte_nom;
                    document.getElementById('cardExpiry').textContent = cardInfo.date_exp;

                    const photoElement = document.getElementById('cardPhoto');
                    photoElement.src = cardInfo.photo;
                    photoElement.alt = `Photo de ${cardInfo.nom} ${cardInfo.prenom}`;

                    document.getElementById('cardModal').classList.remove('hidden');
                }
                });
            });

            // Gestionnaire pour fermer la modal
            document.getElementById('closeModalBtn').addEventListener('click', function () {
                document.getElementById('cardModal').classList.add('hidden');
            });

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


    public function display_users_view() {
    ?>
    <div class="flex flex-col">
        <?php
        $sidebar = new sidebar_view();
        $sidebar->display_sidebar_view();
        ?>
        <main class="flex-1 ml-[18%] px-4">
            <?php
            $this->users();
            ?>
        </main>
    </div>
    <?php
}

}