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

    public function partenaires(){
        ?>
    <div class="px-4 py-10 max-w-screen-xl mx-auto">
        <h2 class=" text-left text-2xl font-semibold text-zinc-800 mb-6">Partenaires</h2>
        <div class="overflow-x-auto">
            <table id="offersTable" class="w-full bg-offWhite border-separate border-spacing-0 rounded-lg">
                <thead class="text-left text-zinc-800 bg-offWhite rounded-t-lg">
                    <tr>
                        <th class="px-4 py-2 border-b border-white">Partenaire</th>
                        <th class="px-4 py-2 border-b border-white">Logo</th>
                        <th class="px-4 py-2 border-b border-white">Catégorie</th>
                        <th class="px-4 py-2 border-b border-white">Nom d'utilisateur</th>
                        <th class="px-4 py-2 border-b border-white">Email</th>
                        <th class="px-4 py-2 border-b border-white">Modifier</th>
                        <th class="px-4 py-2 border-b border-white">Supprimer</th>
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
                                       <img src=" . $partenaire["logo"] . "></td>
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