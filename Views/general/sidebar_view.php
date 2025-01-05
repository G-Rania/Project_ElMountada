<?php

class sidebar_view {
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

    public function sidebar() {
        ?>  
        <div
            class="flex flex-col h-auto fixed w-1/5 lg:w-[18%] bg-teal-600 text-white font-medium"
            role="navigation"
            aria-label="Main Navigation"
        >
            <!-- Logo Section -->
            <div class="flex items-center justify-center py-6">
                <img
                    loading="lazy"
                    src="../../assets/general/logoFooter.png"
                    class="object-contain w-[180px] h-auto"
                    alt="Company Logo"
                />
            </div>

            <!-- Navigation Links -->
            <nav class="flex flex-col space-y-4 px-6 mt-4 overflow-y-auto">
                <a href="../Admin/partenairesAdmin.php" class="hover:bg-teal-700 hover:text-white rounded-lg px-3 py-2 transition-all duration-300">
                    Partenaires
                </a>
                <a href="" class="hover:bg-teal-700 hover:text-white rounded-lg px-3 py-2 transition-all duration-300">
                    Offres
                </a>
                <a href="#special-offers" class="hover:bg-teal-700 hover:text-white rounded-lg px-3 py-2 transition-all duration-300">
                    Offres spéciales
                </a>
                <a href="../Admin/cardRequests.php" class="hover:bg-teal-700 hover:text-white rounded-lg px-3 py-2 transition-all duration-300">
                    Demandes d'adhésion
                </a>
                <a href="#help" class="hover:bg-teal-700 hover:text-white rounded-lg px-3 py-2 transition-all duration-300">
                    Demandes d'aide
                </a>
                <a href="#member-management" class="hover:bg-teal-700 hover:text-white rounded-lg px-3 py-2 transition-all duration-300">
                    Gestion des membres
                </a>
                <a href="#events" class="hover:bg-teal-700 hover:text-white rounded-lg px-3 py-2 transition-all duration-300">
                    Évènements
                </a>
                <a href="#donations" class="hover:bg-teal-700 hover:text-white rounded-lg px-3 py-2 transition-all duration-300">
                    Gestion des dons
                </a>
                <a href="#statistics" class="hover:bg-teal-700 hover:text-white rounded-lg px-3 py-2 transition-all duration-300">
                    Statistiques
                </a>
            </nav>

            <!-- Footer or Additional Links -->
            <div class="mt-auto px-6 py-4 text-xs text-center border-t border-teal-500">
                <p>© 2025 El Mountada </p>
            </div>
        </div>
        <?php
    }

    public function display_sidebar_view(){
        $instance = new sidebar_view();
        $instance->head_description();
        $instance->sidebar();
    }
}
