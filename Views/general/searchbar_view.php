<?php
class searchbar_view {
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

    public function searchbar($element_class) {
        ?>  
            <div class="search-container ml-16 mx-auto my-4 w-full h-11 max-w-md">
                <label for="searchInput" class="block text-lg font-medium text-gray-700 mb-2">Rechercher :</label>
                <input type="text" id="searchInput" placeholder="Effectuer une recherche..."
                    class="w-full p-3 border-2 border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 ease-in-out">
            </div>

            <p id="noResults" class="hidden text-red-500 text-sm">Aucun résultat trouvé.</p>

            <script>
                $(document).ready(function() {
                    $('#searchInput').on('keyup', function() {
                        const searchTerm = $(this).val().toLowerCase();
                        let found = false;

                        $('.<?php echo $element_class; ?>').each(function() {
                            const text = $(this).text().toLowerCase();
                            if (text.indexOf(searchTerm) > -1) {
                                $(this).removeClass('hidden'); // Afficher l'élément
                                found = true;
                            } else {
                                $(this).addClass('hidden'); // Masquer l'élément
                            }
                        });

                        // Affichage du message si aucun résultat
                        if (!found) {
                            $('#noResults').removeClass('hidden');
                        } else {
                            $('#noResults').addClass('hidden');
                        }
                    });
                });
            </script>
        <?php
    }

    public function display_searchbar_view($element_class){
        $instance = new searchbar_view();
        $instance->head_description();
        $instance->searchbar($element_class);
    }
}
