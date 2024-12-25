<?php
require_once('Controllers/general/header_controller.php');

class header_view {
    public function head_description() {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="output.css" rel="stylesheet" />
            <script src="jquery-3.7.1.min.js"></script>
        </head>
        <?php
    }

   public function header() {
    ?>  
    <div class="bg-white shadow">
        <div class="flex items-center gap-4 p-2 max-md:flex-col">
            <!-- Logo Section -->
            <div class="flex w-16 max-md:w-full">
                <img
                    loading="lazy"
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/41094202a1aaf6a6d6b3cdd411f380852353af7ae37a006b61528f621b1b4963?placeholderIfAbsent=true&apiKey=d6bf1b26b54d4d00a83d0cde6eba6bf6"
                    alt="Company Logo"
                    class="object-contain w-full"
                />
            </div>

            <!-- Navigation Section -->
            <div class="flex flex-grow ml-2 max-md:ml-0 max-md:w-full">
                <nav aria-label="Main navigation" class="flex gap-4 text-sm font-medium text-stone-900">
                    <?php
                    try {
                        $controller = new header_controller();
                        $menu_list = $controller->get_menu_controller();
                        
                        foreach ($menu_list as $menu_item) {
                            echo '<div class="relative group">';
                            echo '<a class="hover:underline focus:outline-none focus:ring-1 focus:ring-stone-900" href="' . $menu_item["lien"] . '">' . $menu_item["nom"] . '</a>';

                            // Submenu
                            $submenu_list = $controller->get_submenu_controller($menu_item['ID']);
                            if (!empty($submenu_list)) {
                                echo '<div class="fixed z-[9999] left-0 hidden mt-1 w-40 bg-white shadow-md rounded group-hover:block">';
                                foreach ($submenu_list as $submenu_item) {
                                    echo '<a class="block px-3 py-1 text-gray-700 text-xs hover:bg-gray-100" href="' . $submenu_item["lien"] . '">' . $submenu_item["nom"] . '</a>';
                                }
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                    } catch (PDOException $ex) {
                        echo "<p>Erreur : " . $ex->getMessage() . "</p>";
                    }
                    ?>
                </nav>
            </div>
        </div>
    </div>
    <?php
}


    public function display_header_view(){
        $instance = new header_view();
        $instance->head_description();
        $instance->header();
    }
}