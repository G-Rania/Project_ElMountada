<?php
require_once('../../Controllers/User/subscriptionUser_controller.php');
require_once('../../Views/general/header_view.php');
require_once('../../Views/general/footer_view.php');


class subscriptionUser_view {
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

public function subscriptionUser() {
    ?>  
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 space-y-6">
            <div class="text-center">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6">Demander une carte</h2>
                <p class="text-sm text-gray-500">Veuillez remplir les informations suivantes pour demander une carte.</p>
            </div>
            <form 
                class="space-y-6" 
                id="subscriptionForm" 
                action="./subscriptionUser.php" 
                method="post" 
                enctype="multipart/form-data"
            >
                <!-- Type de carte -->
                <div>
                    <label for="typeCarte" class="block text-sm font-medium text-gray-600 mb-2">Type de carte</label>
                    <select 
                        id="typeCarte" 
                        name="typeCarte" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                        required
                    >
                        <option>Sélectionner une carte</option>
                        <?php
                        try {
                            $controller = new subscriptionUser_controller();
                            $cartes = $controller->get_typesCarte_controller();
                            foreach ($cartes as $carte) {
                                echo "<option value='{$carte['ID']}'> {$carte['nom']} - {$carte['prix']} DA</option>";
                            }
                        } catch (PDOException $ex) {
                            echo "<p>Erreur : " . $ex->getMessage() . "</p>";
                        }
                        ?>
                    </select>
                </div>
                <!-- Photo -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-600 mb-2">Photo</label>
                    <input 
                        type="file" 
                        id="photo" 
                        name="photo" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                        accept="image/*"
                        required
                    />
                </div>
                <!-- Pièce d'identité -->
                <div>
                    <label for="piece_identite" class="block text-sm font-medium text-gray-600 mb-2">Pièce d'identité</label>
                    <input 
                        type="file" 
                        id="piece_identite" 
                        name="piece_identite" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                        accept="image/*"
                        required
                    />
                </div>
                <!-- Reçu de paiement -->
                <div>
                    <label for="recu_paiement" class="block text-sm font-medium text-gray-600 mb-2">Reçu de paiement</label>
                    <input 
                        type="file" 
                        id="recu_paiement" 
                        name="recu_paiement" 
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



    public function display_subscriptionPage_view(){
        $instance = new subscriptionUser_view();
        $header = new header_view();
        $footer = new footer_view();
        $instance->head_description();
        $header->header();
        $instance->subscriptionUser();
        $footer->footer();
    }
}