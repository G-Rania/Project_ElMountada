<?php
require_once('../../Controllers/landingPage_controller.php');
require_once('../../Controllers/User/connexionUser_controller.php');
require_once('../../Views/general/header_view.php');
require_once('../../Views/general/footer_view.php');

class landingPage_view {
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

   public function header_landingPage_view() {
    ?>
    <div class="flex justify-between items-center">
        <?php
            // Affichage du header ici
            $header = new header_view();
            $header->header();
        ?>
        <div class="flex flex-row gap-6 mr-7">
            <button id="signinBtn" class="text-lg text-white bg-[#339989] hover:bg-[#226e63] px-3 py-1 rounded-full focus:outline-none">
                <span>Se connecter</span>
            </button>
            <button id="signupBtn" class="text-lg text-[#339989] border-[#339989] border-2 hover:bg-[#339989] hover:text-white px-3 py-1 rounded-full focus:outline-none">
                <span>S'inscrire</span>
            </button>
        </div>
    </div>

    <!-- Redirection to signin/signup pages -->
    <script>
        document.getElementById('signinBtn').addEventListener('click', function() {
            window.location.href = '../User/signinUser.php'; 
        });
        document.getElementById('signupBtn').addEventListener('click', function() {
            window.location.href = '../User/signupUser.php'; 
        });
    </script>

    <?php
}


    public function diaporama() {
        ?>
        <div class="relative w-full overflow-hidden bg-gray-100 mb-10">
            <!-- Diaporama Container -->
            <div id="carousel" class="flex transition-transform duration-700 ease-in-out">
                <?php
                try {
                    $controller = new landingPage_controller();
                    $diaporama_pics = $controller->get_diaporama_controller();
                    foreach ($diaporama_pics as $diaporama_pic) {
                        echo '<div class="flex-shrink-0 w-full">';
                        echo '<img src="' . $diaporama_pic["lien"] . '" class="w-full h-[400px] object-cover" alt="Diaporama Image">';
                        echo '</div>';
                    }
                } catch (PDOException $ex) {
                    echo "<p>Erreur : " . $ex->getMessage() . "</p>";
                }
                ?>
            </div>

            <!-- Navigation Buttons -->
            <button id="prev" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-[#339989] text-white px-4 py-2 rounded-full hover:bg-aquaPastel z-10">
                &larr;
            </button>
            <button id="next" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-[#339989] text-white px-4 py-2 rounded-full hover:bg-aquaPastel z-10">
                &rarr;
            </button>
        </div>

        <script>
            const carousel = document.getElementById('carousel');
            const slides = carousel.children;
            const totalSlides = slides.length;
            let currentIndex = 0;

            // Function to update the carousel's position
            function updateCarousel(index) {
                const offset = -index * 100;
                carousel.style.transform = `translateX(${offset}%)`;
            }

            // Prev Button
            document.getElementById('prev').addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateCarousel(currentIndex);
            });

            // Next Button
            document.getElementById('next').addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateCarousel(currentIndex);
            });

            // Auto-scroll every 5 seconds
            setInterval(() => {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateCarousel(currentIndex);
            }, 5000);
        </script>
        <?php
    }

    public function donnate() {
        ?>
        <div class="flex flex-col md:flex-row mb-8 gap-6 items-start font-semibold text-zinc-800 mt-10">
            <img
                loading="lazy"
                src="../../assets/general/moon.png"
                alt=""
                class="object-contain shrink-0 w-[150px] aspect-[0.92]"
            />
            <div class="flex flex-col gap-4 items-center">
                <h2 class="text-3xl max-md:text-2xl">
                    Soutenez notre mission
                </h2>
                <p class="text-xl text-center">
                    Chaque don compte pour transformer des vies et bâtir un avenir meilleur. Contribuez aujourd'hui pour aider ceux qui en ont besoin. Votre générosité fait la différence !
                </p>
                <button id="donnate" class="flex gap-4 justify-center items-center px-4 py-2 text-lg text-white bg-[#339989] hover:bg-[#7DE2D1] rounded-full">
                    <span>Faire un don</span>
                    <img
                        loading="lazy"
                        src="https://cdn.builder.io/api/v1/image/assets/TEMP/b64ce410081577e3512f9c717ccbd19ecd1ac231205fc643010c44b972c39509?placeholderIfAbsent=true&apiKey=d6bf1b26b54d4d00a83d0cde6eba6bf6"
                        alt=""
                        class="w-6"
                    />
                </button>
            </div>
            <img
                loading="lazy"
                src="../../assets/general/ellipse.png"
                alt=""
                class="object-contain shrink-0 w-[120px]"
            />
        </div>

        <!-- Modale pour afficher compte ccp -->
        <div id="donnationModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-xl font-bold text-gray-900 mb-4">Compte CCP : <span class="font-semibold">2233455566</span></p>
                <div class="flex justify-end space-x-4">
                    <button id="closeBtn" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Fermer</button>
                </div>
            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Ouvrir la modale
            document.getElementById("donnate").addEventListener("click", () => {
               document.getElementById('donnationModal').classList.remove('hidden');
            });

            // Fermer la modale
            document.getElementById("closeBtn").addEventListener("click", () => {
                document.getElementById('donnationModal').classList.add('hidden');
            });

        });
    </script>
        <?php
    }

  public function events() {
    ?>
    <div class="flex flex-col">
        <!-- Section Title -->
        <div class="self-start text-3xl ml-6 mt-10 font-semibold text-zinc-800 max-md:text-4xl" role="heading" aria-level="2">
            Nos activités
        </div>

        <!-- Horizontal Scrollable Container -->
        <div class="flex overflow-x-auto space-x-5 mt-6 px-6 no-scrollbar">
            <?php
            try {
                $controller = new landingPage_controller();
                $event_list = $controller->get_events_controller();
                
                foreach ($event_list as $event) {
                    ?>
                    <!-- Event Card -->
                    <div class="flex-shrink-0 w-72 bg-white rounded-lg shadow-lg p-4 text-neutral-900">
                        <img 
                            loading="lazy" 
                            alt="Image représentant une campagne de dons de sang"
                            class="object-cover w-full h-40 rounded-lg"
                            src="<?php echo $event['img']; ?>"
                        />
                        <div class="flex flex-col mt-4">
                            <!-- Event Date -->
                            <div 
                                class="gap-2.5 self-start px-3 py-1 text-sm bg-emerald-300 rounded-full text-zinc-800"
                                role="tag"
                            >
                                <?php echo $event['date_evenement']; ?>
                            </div>
                            <!-- Event Name -->
                            <div class="mt-4 text-xl font-semibold tracking-normal" role="heading" aria-level="3">
                                <?php echo $event['nom']; ?>
                            </div>
                            <!-- Event Description -->
                            <div class="mt-2 text-sm leading-6 text-gray-700">
                                <?php echo $event['description']; ?>
                            </div>
                        </div>
                        <!-- Read More Link -->
                        <button
                           data-event-info='<?php echo json_encode($event); ?>'
                           class="readMoreBtn self-end mt-4 text-sm text-emerald-500 hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-300">
                            Lire la suite →
                        </button>
                    </div>
                    <?php
                }
            } catch (PDOException $ex) {
                echo "<p>Erreur : " . $ex->getMessage() . "</p>";
            }
            ?>
        </div>
        <a
            href="#"
            class="gap-5 self-end mt-4 mr-10 text-base leading-10 rounded-lg text-neutral-900 hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-300 max-md:mt-10 max-md:mr-2.5"
            aria-label="Voir toutes nos activités"
            >
            Voir toutes nos activités
            <span class="text-teal-600" aria-hidden="true">→</span>
        </a>
    </div>

    <!-- Modal -->
    <div id="eventModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white w-11/12 max-w-lg rounded-lg shadow-2xl p-6 relative flex">
            <!-- Image -->
            <img 
                id="modalImg" 
                class="w-1/3 h-32 object-cover rounded-lg shadow-md mr-4" 
                alt="Image de l'événement"
            />

            <!-- Content -->
            <div class="flex flex-col justify-between w-2/3">
                <!-- Close Button -->
                <button 
                    id="closeModal" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                    aria-label="Fermer la modale"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Event Title -->
                <h2 class="text-lg font-bold text-gray-800 tracking-tight mb-2" id="modalTitle"></h2>

                <!-- Event Date and Time -->
                <p class="text-sm font-semibold text-gray-900 mb-2" id="modalDate"></p>
                <p class="text-sm font-semibold text-gray-900 mb-4" id="modalTime"></p>

                <!-- Event Description -->
                <p class="text-sm leading-relaxed text-gray-700 mb-4" id="modalDescription"></p>

                <!-- Register Button -->
                <button
                    id="registerEventBtn"
                    href="#"
                    class=" items-center justify-center inline-block px-2 py-2 text-sm font-semibold text-white bg-emerald-500 rounded-full shadow-md hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                >
                    Je participe comme bénévole
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
       document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('eventModal');
        const closeModal = document.getElementById('closeModal');
        const registerBtn = document.getElementById('registerEventBtn');

        let selectedEventId = null;

        document.querySelectorAll('.readMoreBtn').forEach(button => {
            button.addEventListener('click', function () {
                const eventData = JSON.parse(this.getAttribute('data-event-info'));

                // Mettre à jour la modale avec les données de l'événement
                document.getElementById('modalTitle').textContent = eventData.nom;
                document.getElementById('modalDate').textContent = `Date : ${eventData.date_evenement}`;
                document.getElementById('modalTime').textContent = `Heure : ${eventData.heure_evenement}`;
                document.getElementById('modalDescription').textContent = eventData.texte;
                document.getElementById('modalImg').src = eventData.img;

                selectedEventId = eventData.ID; 

                // Afficher la modale
                modal.classList.remove('hidden');
            });
        });

        // Bouton "Je participe comme bénévole"
        registerBtn.addEventListener('click', () => {
            if (selectedEventId) {
                fetch('../../Routers/User/registerEvent.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ event_id: selectedEventId }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Inscription réussie !');
                            location.reload(); // Recharger la page
                        } else {
                            alert('Erreur : ' + data.message);
                        }
                    })
                    .catch(error => console.error('Erreur:', error))
                    .finally(() => {
                        modal.classList.add('hidden');
                        selectedEventId = null; // Réinitialiser l'ID sélectionné
                    });
            } else {
                alert('Aucun événement sélectionné.');
            }
        });

        // Bouton pour fermer la modale
        closeModal.addEventListener('click', function () {
            modal.classList.add('hidden');
        });

        // Clic en dehors de la modale pour la fermer
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
    </script>

    <!-- Inline Style -->
    <style>
        /* Remove scrollbar for horizontal scrolling */
        .no-scrollbar {
            -ms-overflow-style: none; /* Internet Explorer 10+ */
            scrollbar-width: none; /* Firefox */
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none; /* Safari and Chrome */
        }
    </style>
    <?php
}


 public function impact(){
    ?>
    <div class="px-4 py-10 max-w-screen-xl mx-auto">
        <!-- Titre centré -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold text-zinc-800">Notre impact</h2>
        </div>

        <div class="flex justify-between items-center max-md:flex-col">
            <div class="flex flex-col items-center w-full max-w-[150px]">
                <img
                    loading="lazy"
                    src="../../assets/general/impact1.png"
                    alt="Donation impact icon"
                    class="object-contain w-[100px] h-[100px] mb-4"
                />
                <div class="text-center text-base text-zinc-800">Plus de 200000DA de dons par mois</div>
            </div>
            <div class="flex flex-col items-center w-full max-w-[150px]">
                <img
                    loading="lazy"
                    src="../../assets/general/impact2.png"
                    alt="Monthly donation statistics icon"
                    class="object-contain w-[100px] h-[100px] mb-4"
                />
                <div class="text-center text-base text-zinc-800">Plus de 5000 enfants profitant de vêtements chaque hiver</div>
            </div>
            <div class="flex flex-col items-center w-full max-w-[150px]">
                <img
                    loading="lazy"
                    src="../../assets/general/impact3.png"
                    alt="Annual volunteer statistics icon"
                    class="object-contain w-[100px] h-[100px] mb-4"
                />
                <div class="text-center text-base text-zinc-800">Plus de 70 bénévolats par année</div>
            </div>
        </div>
        </div>
    </div>
    <?php
}

   public function offers() {
    ?>
    <div class="px-4 py-10 max-w-screen-xl mx-auto">
        <h2 class="text-center text-3xl font-semibold text-zinc-800 mb-6">Nos Offres</h2>
        <div class="overflow-x-auto">
            <table id="offersTable" class="w-full bg-offWhite border-separate border-spacing-0 rounded-lg">
                <thead class="text-left text-zinc-800 bg-offWhite rounded-t-lg">
                    <tr>
                        <th class="px-4 py-2 border-b border-white">Wilaya</th>
                        <th class="px-4 py-2 border-b border-white">Catégorie</th>
                        <th class="px-4 py-2 border-b border-white">Offre</th>
                        <th class="px-4 py-2 border-b border-white">Réduction</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-offWhite">
                    <?php
                    try {
                        $controller = new landingPage_controller();
                        $offers = $controller->get_offers_controller();
                        foreach ($offers as $index => $offer) {
                            echo "<tr class='text-zinc-800 hidden border-b border-white'>
                                    <td class='px-4 py-2 border-b border-white'>" . $offer["wilaya"] . "</td>";
                            try {
                                $controller2 = new landingPage_controller();
                                echo "<td class='px-4 py-2 border-b border-white'>" . $controller2->get_categoryOffer_controller($offer["idPartenaire"]) . "</td>";
                            } catch (PDOException $ex) {
                                echo "<td class='px-4 py-2 text-red-500'>Erreur</td>";
                            }
                            echo "<td class='px-4 py-2 border-b border-white'>" . $offer["nom"] . "</td>
                                  <td class='px-4 py-2 border-b border-white'>" . $offer["pourcentage"] . "%</td>
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

public function partners() {
    ?>
    <div class="self-start text-3xl ml-6 mt-10 mb-10 font-semibold text-zinc-800 max-md:text-4xl" role="heading" aria-level="2">
        Nos partenaires
    </div>
    <!-- Section contenant les logos alignés horizontalement -->
    <div class="flex mb-10 justify-center items-center gap-6 px-6">
        <?php
        try {
            $controller = new landingPage_controller();
            $partner_list = $controller->get_partners_controller(); 
            foreach ($partner_list as $partner) {
                ?>
                <!-- Carte pour chaque logo -->
                <div class="w-40 h-40 flex justify-center items-center">
                    <img 
                        loading="lazy" 
                        alt="<?php echo htmlspecialchars($partner['nom']); ?>" 
                        class="w-full h-full object-contain p-2" 
                        src="<?php echo htmlspecialchars($partner['logo']); ?>"
                    />
                </div>
                <?php
            }
        } catch (PDOException $ex) {
            echo "<p>Erreur : " . $ex->getMessage() . "</p>";
        }
        ?>
    </div>
    <?php
}



    public function display_landingPage_view() {
        $instance = new landingPage_view();
        $footer = new footer_view();
        $instance->head_description();
        $instance->header_landingPage_view();
        $instance->diaporama();
        $instance->donnate();
        $instance->events();
        $instance->impact();
        $instance->offers();
        $instance->partners();
        $footer->footer();
    }
}
