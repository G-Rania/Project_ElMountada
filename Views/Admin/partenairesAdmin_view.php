<?php
require_once('../../Views/general/sidebar_view.php');
require_once('../../Controllers/Admin/partenairesAdmin_controller.php');

class partenairesAdmin_view {
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

    public function partenaires() {
        ?>
    <div class="px-4 py-10 max-w-screen-xl mx-auto">
        <h2 class=" text-left text-2xl font-semibold text-zinc-800 mb-3">Partenaires</h2>

        <!-- Bouton Ajouter Partenaire -->
        <div class="mb-6 mt-0 flex justify-end">
            <button id="addPartnerBtn" class="px-4 py-2 flex items-center bg-[#339989] text-white font-semibold rounded-lg hover:bg-[#226e63]">
                <span class="mr-2 text-xl font-bold">+</span> Ajouter Partenaire
            </button>
        </div>

        <!-- Table des partenaires -->
        <div class="overflow-x-auto">
            <table id="partnersTable" class="w-full bg-offWhite border-separate border-spacing-0 rounded-3xl">
                <thead class="text-left text-zinc-800 bg-offWhite rounded-t-lg">
                    <tr>
                        <th class="px-4 py-2 border-b border-white">Partenaire</th>
                        <th class="px-4 py-2 border-b border-white">Logo</th>
                        <th class="px-4 py-2 border-b border-white">Catégorie</th>
                        <th class="px-4 py-2 border-b border-white">Nom d'utilisateur</th>
                        <th class="px-4 py-2 border-b border-white">Email</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-offWhite">
                    <?php
                    try {
                        $controller = new partenairesAdmin_controller();
                        $partenaires = $controller->get_partenaires_controller();
                        foreach ($partenaires as $partenaire) {
                            echo "<tr class='text-zinc-800 hidden border-b border-white'>
                                    <td class='px-4 py-2 border-b border-white'>" . $partenaire["nom"] . "</td>
                                    <td class='px-4 py-2 border-b border-white'>
                                       <img class='w-20 h-20 object-contain' src=" . $partenaire["logo"] . "></td>
                                    <td class='px-4 py-2 border-b border-white'>" . $partenaire["categorie"] . "</td>
                                    <td class='px-4 py-2 border-b border-white'>" . $partenaire["username"] . "</td>
                                    <td class='px-4 py-2 border-b border-white'>" . $partenaire["email"] . "</td>
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
            <button id="prevPage" class="px-4 py-2 mx-1 text-sm font-medium text-white bg-[#339989] rounded-lg hover:bg-[#226e63]" disabled>
                Précédent
            </button>
            <button id="nextPage" class="px-4 py-2 mx-1 text-sm font-medium text-white bg-[#339989] rounded-lg hover:bg-[#226e63]">
                Suivant
            </button>
        </div>
    </div>

    <script>
            document.addEventListener("DOMContentLoaded", function () {
                const rows = document.querySelectorAll("#partnersTable tbody tr");
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

    <!-- Modale pour Ajouter Partenaire -->
    <div id="addPartnerModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
            <h3 class="text-lg font-semibold text-zinc-800 mb-4">Ajouter un nouveau partenaire</h3>
            <form action="./partenairesAdmin.php" method="post" id="addPartnerForm">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-zinc-800 mb-1" for="nom">Nom du partenaire</label>
                    <input type="text" id="nom" name="nom" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#339989] focus:border-[#339989]">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-zinc-800 mb-1" for="description">Description</label>
                    <input type="text" id="description" name="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#339989] focus:border-[#339989]">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-zinc-800 mb-1" for="logo">Logo (URL)</label>
                    <input type="text" id="logo" name="logo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#339989] focus:border-[#339989]">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-zinc-800 mb-1" for="categorie">Catégorie</label>
                    <input type="text" id="categorie" name="categorie" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#339989] focus:border-[#339989]">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-zinc-800 mb-1" for="ville">Ville</label>
                    <input type="text" id="ville" name="ville" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#339989] focus:border-[#339989]">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-zinc-800 mb-1" for="email">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#339989] focus:border-[#339989]">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" id="cancelAddPartner" class="px-4 py-2 text-sm font-medium text-zinc-800 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#339989] rounded-lg hover:bg-[#226e63]">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("addPartnerBtn").addEventListener("click", function () {
            document.getElementById("addPartnerModal").classList.remove("hidden");
        });

        document.getElementById("cancelAddPartner").addEventListener("click", function () {
            document.getElementById("addPartnerModal").classList.add("hidden");
        });
    </script>
    <?php
    }

    public function display_partenairesAdmin_view() {
        ?>
        <div class="flex flex-col">
            <?php
            $sidebar = new sidebar_view();
            $sidebar->display_sidebar_view();
            ?>
            <main class="flex-1 ml-[18%] px-4">
                <?php
                $this->partenaires();
                ?>
            </main>
        </div>
        <?php
    }
}
?>
