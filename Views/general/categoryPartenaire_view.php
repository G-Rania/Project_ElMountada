<?php
require_once('../../Views/general/header_view.php');
require_once('../../Views/general/footer_view.php');
require_once('../../Controllers/general/categoryPartenaire_controller.php');

class categoryPartenaire_view {
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

     public function categoryPartenaire($category) {
    ?>
        <section class="py-16 bg-white">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6 text-[#339989]"><?php echo htmlspecialchars($category); ?></h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-lg table-auto">
                        <thead class="bg-[#339989] text-white">
                            <tr>
                                <th class="px-6 py-3 text-left">Logo</th>
                                <th class="px-6 py-3 text-left">Nom</th>
                                <th class="px-6 py-3 text-left">Description</th>
                                <th class="px-6 py-3 text-left">Ville</th>
                                <th class="px-6 py-3 text-left">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                try {
                                    $controller = new categoryPartenaire_controller();
                                    $partners = $controller->get_categoryPartanaires_controller($category);
                                    foreach ($partners as $partner) {
                                        echo "<tr>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>
                                            <img class='w-20 h-20 object-cover rounded-md' src=" . $partner["logo"] . "></td>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>" . $partner["nom"] . "</td>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>" . $partner["description"] . "</td>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>" . $partner["ville"] . "</td>
                                            <td class='px-6 py-4 border-b border-[#67b7a1]'>" . $partner["email"] . "</td>
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

     public function display_categoryPartenaire_view($category) {
        $header = new header_view();
        $footer = new footer_view();
        $this->head_description();
        $header->display_header_view();
        $this->categoryPartenaire($category);
        $footer->footer();
    }
}