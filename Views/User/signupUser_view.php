<?php
require_once('../../Controllers/User/connexionUser_controller.php');

class signupUser_view {
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

  public function signupUser() {
    ?>  
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="flex flex-col-reverse md:flex-row bg-white shadow-lg rounded-lg overflow-hidden max-w-4xl">
            <!-- Left Side - Image Section -->
            <div class="w-full md:w-1/2">
                <img 
                    src="../../assets/general/signUp.jpg" 
                    alt="Sign in illustration" 
                    class="h-full object-cover"
                />
            </div>

            <!-- Right Side - Form Section -->
            <div class="w-full md:w-1/2 p-6 sm:p-12">
                <div class="flex flex-col items-center">
                    <img 
                        src="../../assets/general/logoElMountada.png" 
                        alt="Company Logo" 
                        class="w-20 h-20 mb-6"
                    />
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Créer un compte</h2>
                </div>
                <?php
                    //Display error
                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="text-red-500 text-sm mb-4">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                    }
                ?>
                <form class="mt-4 space-y-4" id="signupUser" action="./signupUser.php" method="post">
                    <!--nom + prenom-->
                    <div class="flex flex-row gap-4">
                        <!-- nom -->
                        <div>
                        <label for="nom" class="block text-sm text-gray-600">Nom</label>
                        <input 
                            type="text" 
                            id="nom" 
                            name="nom" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            required
                        />
                        </div>
                        <!-- prénom -->
                        <div>
                        <label for="prenom" class="block text-sm text-gray-600">Prénom</label>
                        <input 
                            type="text" 
                            id="prenom" 
                            name="prenom" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            required
                        />
                        </div>
                    </div>
                    <!-- Phone number -->
                    <div>
                        <label for="password" class="block text-sm text-gray-600">Numéro de téléphone</label>
                        <input 
                            type="tel" 
                            id="num_tlp" 
                            name="num_tlp" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            required
                        />
                    </div>
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm text-gray-600">Nom d'utilisateur</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            required
                        />
                    </div>
                     <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm text-gray-600">Adresse email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            required
                        />
                    </div>
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm text-gray-600">Mot de passe</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            required
                        />
                    </div>
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full px-4 py-2 text-white bg-teal-600 hover:bg-teal-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50"
                    >
                        S'inscrire
                    </button>
                </form>
                <div class="mt-4 text-center">
                    <a href="./signinUser.php" class="text-sm text-teal-600 hover:underline">Vous avez déjà un compte ? Connectez-vous</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}



    public function display_signupUser_view(){
        $instance = new signupUser_view();
        $instance->head_description();
        $instance->signupUser();
    }
}