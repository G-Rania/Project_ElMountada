<?php
require_once('../../Controllers/general/footer_controller.php');

class footer_view {
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

    public function footer() {
        ?>  
            <div
            class="flex gap-5 justify-between mb-3 items-start w-full max-md:max-w-full bg-[#339989]"
            role="contentinfo"
            >
            <div class="flex flex-col self-start">
                <div class="flex self-start text-xl text-center text-teal-800">
                <img
                    loading="lazy"
                    src="../../assets/general/logoFooter.png"
                    class="object-contain shrink-0 w-32 max-w-full aspect-[1.27]"
                    alt="El Mountada Logo"
                />
                </div>
                <div class="flex flex-col pl-5 w-96 mt-2 text-sm text-white max-md:pl-5">
                <div>
                    Notre association caritative œuvre pour soutenir les personnes dans le
                    besoin, offrir des opportunités et bâtir un avenir meilleur grâce à la
                    solidarité et à votre générosité
                </div>
                <div class="flex flex-row">
                    <?php
                     try {
                        $controller = new footer_controller();
                        $link = $controller->get_socialMediaLink_controller("facebook");
                        echo '<a href = "'.$link.'">
                        <img
                        loading="lazy"
                        src="../../assets/socialMedia/facebook.png"
                        class="object-contain mt-7 max-w-full aspect-[4.33] w-[104px]"
                        alt="facebook icon"
                        />
                        </a>';
                        $link = $controller->get_socialMediaLink_controller("instagram");
                        echo '<a href = "'.$link.'">
                        <img
                        loading="lazy"
                        src="../../assets/socialMedia/instagram.png"
                        class="object-contain mt-7 max-w-full aspect-[4.33] w-[104px]"
                        alt="instagram icon"
                        />
                        </a>';
                        $link = $controller->get_socialMediaLink_controller("linkedin");
                        echo '<a href = "'.$link.'">
                        <img
                        loading="lazy"
                        src="../../assets/socialMedia/linkedin.png"
                        class="object-contain mt-7 max-w-full aspect-[4.33] w-[104px]"
                        alt="linkedin icon"
                        />
                        </a>';
                     } catch (PDOException $ex){
                        echo"<p>Erreur : " . $ex->getMessage() . "</p>";
                     }
                    ?>
                </div>
                </div>
            </div>
            <nav class="flex flex-col items-start self-end mt-8 text-sm text-white" aria-label="Website Links">
                <div class="self-stretch text-xl font-semibold">Website Links</div>
                <a href="#" class="mt-10 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500">Accueil</a>
                <a href="#" class="mt-10 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500">Nos activités</a>
                <a href="#" class="mt-10 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500">Nos offres</a>
                <a href="#" class="mt-10 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500">Nos partenaires</a>
                <a href="#" class="mt-9 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500">Contactez nous</a>
            </nav>
            <nav class="flex flex-col items-start my-auto text-sm text-white" aria-label="Partners">
                <div class="self-stretch text-xl font-semibold">Nos partenaires</div>
                <a href="#" class="mt-10 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500">Hôtels</a>
                <a href="#" class="mt-10 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500">Cliniques</a>
                <a href="#" class="mt-9 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500">Ecoles</a>
                <a href="#" class="mt-10 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500">Agences de voyage</a>
            </nav>
            <div class="flex flex-col mt-11 mr-9 my-auto text-sm text-white whitespace-nowrap" role="navigation" aria-label="Language Selection">
                <div class="text-xl font-semibold max-md:mr-1.5">Langues</div>
                <button class="gap-2.5 px-4 py-3.5 mt-5 text-teal-600 bg-white rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500">
                Français
                </button>
                <button class="self-start mt-4 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500">
                Arabe
                </button>
                <button class="self-start mt-9 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-500">
                Anglais
                </button>
            </div>
            </div>
        <?php
    }

    public function display_footer_view(){
        $instance = new footer_view();
        $instance->head_description();
        $instance->footer();
    }
}
