<?php
require_once('../../Controllers/User/donnation_controller.php');
require_once('../../Views/general/header_view.php');
require_once('../../Views/general/footer_view.php');


class donnation_view {
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

public function donnation() {
    ?>  
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 space-y-6">
            <div class="text-center">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6">Suivre mon dons</h2>
                <p class="text-sm text-gray-500">Veuillez remplir les informations suivantes pour suivre vos dons</p>
            </div>
            <form 
                class="space-y-6" 
                id="donnationForm" 
                action="./donnation.php" 
                method="post" 
                enctype="multipart/form-data"
            >
                <!-- Type d'aide' -->
                <div>
                    <label for="typeCarte" class="block text-sm font-medium text-gray-600 mb-2">Catégorie d'aide</label>
                    <select 
                        id="categorieAide" 
                        name="categorieAide" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                    >
                        <option>Sélectionner une catégorie d'aide</option>
                        <?php
                        try {
                            $controller = new donnation_controller();
                            $categories = $controller->get_categoriesAide_controller();
                            foreach ($categories as $categorie) {
                                echo "<option value='{$categorie['ID']}'> {$categorie['nom']}</option>";
                            }
                        } catch (PDOException $ex) {
                            echo "<p>Erreur : " . $ex->getMessage() . "</p>";
                        }
                        ?>
                    </select>
                </div>

                <!-- numéro ccp -->
                <div>
                <label for="num_ccp" class="block text-sm text-gray-600">Numéro de compte CCP</label>
                <input 
                    type="text" 
                    id="num_ccp" 
                    name="num_ccp" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                    required
                />
                </div>

                <!-- montant -->
                <div>
                <label for="montant" class="block text-sm text-gray-600">Montant</label>
                <input 
                    type="text" 
                    id="montant" 
                    name="montant" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                    required
                />
                </div>
        
                <!-- Reçu de virement -->
                <div>
                    <label for="recu_virement" class="block text-sm font-medium text-gray-600 mb-2">Reçu de paiement</label>
                    <input 
                        type="file" 
                        id="recu_virement" 
                        name="recu_virement" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                        accept="image/*"
                        required
                    />
                </div>
                <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3 px-4 text-white bg-teal-600 hover:bg-teal-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50 transition duration-200"
                    >
                        Envoyer
                    </button>
            </form>
        </div>
    </div>
    <?php
}


    public function display_donnationPage_view(){
        $instance = new donnation_view ();
        $header = new header_view();
        $footer = new footer_view();
        $instance->head_description();
        $header->header();
        $instance->donnation();
        $footer->footer();
    }
}