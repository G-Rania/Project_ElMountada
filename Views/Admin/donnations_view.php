<?php
require_once('../../Views/general/sidebar_view.php');
require_once('../../Controllers/Admin/donnations_controller.php');
require_once('../../Controllers/User/donnation_controller.php');

class donnations_view {
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

    public function donnations() {
        ?>
        <div class="px-4 py-10 max-w-screen-xl mx-auto">
            <h2 class="text-left text-2xl font-semibold text-zinc-800 mb-6">Liste des dons</h2>

            <!-- Recherche et filtres -->
            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Rechercher un utilisateur ou un numéro CCP..." 
                    class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" 
                />
                <select id="categoryFilter" class="w-full md:w-1/4 px-4 py-2 border rounded-lg focus:ring focus:ring-green-300">
                    <option value="">Toutes les catégories</option>
                    <?php
                    // Récupérer les catégories pour le filtre
                    $controller = new donnation_controller();
                    $categories = $controller->get_categoriesAide_controller();
                    foreach ($categories as $category) {
                        echo "<option value='{$category['nom']}'>{$category['nom']}</option>";
                    }
                    ?>
                </select>
                <input 
                    type="number" 
                    id="amountFilter" 
                    placeholder="Montant minimum..." 
                    class="w-full md:w-1/4 px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" 
                />
            </div>

            <!-- Tableau -->
            <div class="overflow-x-auto">
                <table id="donnationsTable" class="w-full bg-offWhite border-separate border-spacing-0 rounded-3xl">
                    <thead class="text-left text-zinc-800 bg-offWhite rounded-t-lg">
                        <tr>
                            <th class="px-4 py-2 border-b border-white">Nom d'utilisateur</th>
                            <th class="px-4 py-2 border-b border-white">Numéro CCP</th>
                            <th class="px-4 py-2 border-b border-white">Montant</th>
                            <th class="px-4 py-2 border-b border-white">Catégorie d'aide</th>
                            <th class="px-4 py-2 border-b border-white">Reçu de virement</th>
                            <th class="px-4 py-2 border-b border-white">Date</th>
                            <th class="px-4 py-2 border-b border-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="donnationsBody divide-y divide-offWhite">
                        <?php
                        try {
                            $controller2 = new donnations_controller();
                            $donnations = $controller2->get_donnations_controller();
                            foreach ($donnations as $donnation) {
                                echo "<tr class='text-zinc-800'>
                                        <td class='px-4 py-2 border-b border-white'>" . $donnation["username"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>" . $donnation["num_ccp"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>" . $donnation["montant"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>" . $donnation["categorie_aide_nom"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>
                                            <a href='" . $donnation["recu_virement"] . "' target='_blank' class='text-blue-500 hover:underline'>Voir photo</a>
                                        </td>
                                        <td class='px-4 py-2 border-b border-white'>" . $donnation["date"] . "</td>
                                        <td class='px-4 py-2 border-b border-white'>
                                            <button class='accept-btn text-green-500 hover:text-green-700 mx-1' data-id='" . $donnation["ID"] . "'>Accepter</button>
                                            <button class='refuse-btn text-red-500 hover:text-red-700 mx-1' data-id='" . $donnation["ID"] . "'>Refuser</button>
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
        </div>

        <!-- Script de gestion des filtres -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const searchInput = document.getElementById("searchInput");
                const categoryFilter = document.getElementById("categoryFilter");
                const amountFilter = document.getElementById("amountFilter");
                const rows = document.querySelectorAll("#donnationsTable tbody tr");

                const filterTable = () => {
                    const searchText = searchInput.value.toLowerCase();
                    const category = categoryFilter.value.toLowerCase();
                    const minAmount = parseFloat(amountFilter.value) || 0;

                    rows.forEach(row => {
                        const username = row.children[0].textContent.toLowerCase();
                        const ccp = row.children[1].textContent.toLowerCase();
                        const amount = parseFloat(row.children[2].textContent) || 0;
                        const categoryName = row.children[3].textContent.toLowerCase();

                        const matchesSearch = username.includes(searchText) || ccp.includes(searchText);
                        const matchesCategory = category === "" || categoryName.includes(category);
                        const matchesAmount = amount >= minAmount;

                        if (matchesSearch && matchesCategory && matchesAmount) {
                            row.classList.remove("hidden");
                        } else {
                            row.classList.add("hidden");
                        }
                    });
                };

                searchInput.addEventListener("input", filterTable);
                categoryFilter.addEventListener("change", filterTable);
                amountFilter.addEventListener("input", filterTable);
            });
        </script>
        <?php
    }

    public function display_donnations_view() {
        ?>
        <div class="flex flex-col">
            <?php
            $sidebar = new sidebar_view();
            $sidebar->display_sidebar_view();
            ?>
            <main class="flex-1 ml-[18%] px-4">
                <?php
                $this->donnations();
                ?>
            </main>
        </div>
        <?php
    }
}
?>
