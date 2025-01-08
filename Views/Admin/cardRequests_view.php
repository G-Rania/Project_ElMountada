<?php
require_once('../../Views/general/sidebar_view.php');
require_once('../../Controllers/Admin/cardRequests_controller.php');

class cardRequests_view {
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

    public function cardRequests(){
        ?>
    <div class="px-4 py-10 max-w-screen-xl mx-auto">
        <h2 class=" text-left text-2xl font-semibold text-zinc-800 mb-6">Demandes de carte</h2>

        <!-- Zone de recherche et filtres -->
        <div class="mb-6 flex flex-wrap items-center space-x-4">
            <input id="searchInput" type="text" class="px-4 py-2 border rounded-lg w-full max-w-xs" placeholder="Rechercher...">
        </div>

        <div class="overflow-x-auto">
            <table id="cardRequestsTable" class="w-full bg-offWhite border-separate border-spacing-0 rounded-3xl">
                <thead class="text-left text-zinc-800 bg-offWhite rounded-t-lg">
                    <tr>
                        <th class="px-4 py-2 border-b border-white">Nom</th>
                        <th class="px-4 py-2 border-b border-white">Prénom</th>
                        <th class="px-4 py-2 border-b border-white">Nom d'utilisateur</th>
                        <th class="px-4 py-2 border-b border-white">Email</th>
                        <th class="px-4 py-2 border-b border-white">Téléphone</th>
                        <th class="px-4 py-2 border-b border-white">Photo</th>
                        <th class="px-4 py-2 border-b border-white">Pièce d'identité</th>
                        <th class="px-4 py-2 border-b border-white">Reçu de paiement</th>
                        <th class="px-4 py-2 border-b border-white">Date de demande</th>
                        <th class="px-4 py-2 border-b border-white">Type de carte</th>
                        <th class="px-4 py-2 border-b border-white">Actions</th>
                    </tr>
                </thead>
                <tbody class="cardRequestsBody divide-y divide-offWhite">
                    <?php
                        try {
                            $controller = new cardRequests_controller();
                            $card_requests = $controller->get_cardRequests_controller();
                            foreach ($card_requests as $card_request) {
                                echo "<tr class='text-zinc-800 hidden border-b border-white'>
                                        <td class='px-4 py-2 border-b border-white'>" . $card_request["nom"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>" . $card_request["prenom"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>" . $card_request["username"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>" . $card_request["email"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>" . $card_request["num_tlp"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>
                                            <a href='" . $card_request["photo"] . "' target='_blank' class='text-blue-500 hover:underline'>Voir photo</a>
                                        </td>
                                        <td class='px-4 py-2 border-b border-white'>
                                            <a href='" . $card_request["piece_identite"] . "' target='_blank' class='text-blue-500 hover:underline'>Voir pièce identité</a>
                                        </td>
                                        <td class='px-4 py-2 border-b border-white'>
                                            <a href='" . $card_request["recu_paiement"] . "' target='_blank' class='text-blue-500 hover:underline'>Voir reçu de paiement</a>
                                        </td>
                                        <td class='px-4 py-2 border-b border-white'>" . $card_request["date"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>" . $card_request["type_carte_nom"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>
                                            <button class='accept-btn text-green-500 hover:text-green-700 mx-1' data-id='" . $card_request["ID"] . "'>
                                                <i class='fas fa-check-circle'></i>
                                            </button>
                                            <button class='refuse-btn text-red-500 hover:text-red-700 mx-1' data-id='" . $card_request["ID"] . "'>
                                                <i class='fas fa-times-circle'></i>
                                            </button>
                                        </td>
                                    </tr>";
                            }
                        } catch (PDOException $ex) {
                            echo "<p class='text-red-500'>Erreur : " . $ex->getMessage() . "</p>";
                        }
                    ?>

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-6 space-x-2">
            <button id="prevPage" class="px-4 py-2 text-sm font-medium text-white bg-[#339989] rounded-lg hover:bg-[#226e63]" disabled>
                Précédent
            </button>
            <button id="nextPage" class="px-4 py-2 text-sm font-medium text-white bg-[#339989] rounded-lg hover:bg-[#226e63]">
                Suivant
            </button>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const rows = document.querySelectorAll("#cardRequestsTable tbody tr");
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

                document.getElementById("searchInput").addEventListener("input", (e) => {
                    const searchText = e.target.value.toLowerCase();
                    rows.forEach(row => {
                        row.style.display = row.innerText.toLowerCase().includes(searchText) ? "" : "none";
                    });
                });

                renderTable();
            });
        </script>
    </div>
    <?php
    }

    public function display_cardRequests_view() {
    ?>
    <div class="flex flex-col">
        <?php
        $sidebar = new sidebar_view();
        $sidebar->display_sidebar_view();
        ?>
        <main class="flex-1 ml-[18%] px-4">
            <?php
            $this->cardRequests();
            ?>
        </main>
    </div>
    <?php
}
}
