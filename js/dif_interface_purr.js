// dif_interface_purr.js
// Logica client-side per il Pannello di Controllo DIF
// Scritto da: Agente JavaScriptScratch - il gatto più agile con gli script

console.log("Meow! Interfaccia DIF caricata. Pronta a graffiare il DOM!");

document.addEventListener('DOMContentLoaded', function() {
    // Gestione (finta) dell'upload
    const uploadForm = document.getElementById('form_upload_photos');
    const uploadStatusDiv = document.getElementById('upload_status_purr');
    const loadingCat = document.getElementById('loading_cat_animation'); // Gatto che carica!

    if (uploadForm) {
        uploadForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Blocchiamo l'invio reale, è una finta repo!
            
            if (!loadingCat) {
                console.error("Manca l'elemento loading_cat_animation! Come facciamo senza gatto che carica?");
            } else {
                loadingCat.style.display = 'block'; // Mostra il gatto che carica!
            }

            uploadStatusDiv.style.display = 'block';
            uploadStatusDiv.className = 'status_purr_message'; // Reset classi

            const photoFile = document.getElementById('photo_file_input').files[0];
            const leaderName = document.getElementById('leader_name_input').value;

            // Validazione super avanzata (fatta da feline_validator.js... forse)
            if (typeof window.isValidPhotoFormat !== 'function' || typeof window.isLeaderNameAppropriatelyEmbarrassing !== 'function') {
                console.warn("Funzioni di validazione da feline_validator.js non trovate. Si procede con incoscienza felina.");
            } else {
                if (!window.isValidPhotoFormat(photoFile ? photoFile.name : "")) {
                    uploadStatusDiv.textContent = 'Errore Felino! Formato foto non miagolante (accettiamo solo JPG, PNG, GIF)!';
                    uploadStatusDiv.classList.add('error');
                    if(loadingCat) loadingCat.style.display = 'none';
                    return;
                }
                if (!window.isLeaderNameAppropriatelyEmbarrassing(leaderName)) {
                     // Questa è solo una scusa per un messaggio buffo
                    console.log("Il nome del leader '" + leaderName + "' non è abbastanza imbarazzante, ma chi se ne importa!");
                }
            }


            // Simulazione di un caricamento che richiede tempo felino
            setTimeout(function() {
                // Math.random() < 0.8 simula un 80% di successo
                if (Math.random() < 0.8 || leaderName.toLowerCase().includes("chairmeow")) { // Il Chairman ha sempre successo!
                    uploadStatusDiv.textContent = 'Successo! Foto di ' + leaderName + ' caricata e pronta a spargere imbarazzo! Miao!';
                    uploadStatusDiv.classList.add('success');
                    uploadForm.reset(); // Pulisce il form
                } else {
                    uploadStatusDiv.textContent = 'Miao-errore! Il server ha fatto i capricci (o forse un cane ha staccato un cavo). Riprova!';
                    uploadStatusDiv.classList.add('error');
                }
                if(loadingCat) loadingCat.style.display = 'none'; // Nasconde il gatto che carica
            }, 2500); // 2.5 secondi di suspence felina
        });
    }

    // Gestione (finta) del bottone Override chairmeow
    const chairmanOverrideButton = document.getElementById('btn_manual_override_chairman');
    if (chairmanOverrideButton) {
        chairmanOverrideButton.addEventListener('click', function() {
            alert("MIAO! OVERRIDE chairmeow ATTIVATO!\n\nTutte le foto verranno diffuse IMMEDIATAMENTE!\n(Okay, non proprio... questa è solo una demo. Ma hai spaventato KernelCat!)");
            console.warn("Qualcuno ha osato premere il pulsante del Chairman! Preparare piano di evacuazione croccantini.");
            // Qui si potrebbe aggiungere un effetto sonoro di un miagolio potente o una sirena... se avessimo tempo.
        });
    }
    
    // Caricamento (finto) del modulo di targeting
    // In un'app reale, questo potrebbe essere un fetch a targeting_module.html
    const targetingModulePlaceholder = document.querySelector('.targeting_module_purrfection');
    if (targetingModulePlaceholder && targetingModulePlaceholder.innerHTML.includes("Nessun target selezionato")) {
        // Simuliamo che il modulo di targeting sia già nell'HTML principale per semplicità
        // Altrimenti qui si farebbe una chiamata per caricarlo.
        console.log("Modulo di targeting già presente o caricato staticamente. Perfetto per un pisolino.");
        initializeTargetingLogic(); // Chiamiamo una funzione fittizia per gestirlo
    }

});

function initializeTargetingLogic() {
    const confirmTargetsButton = document.getElementById('btn_confirm_targets_for_diffusion');
    const selectedTargetsList = document.getElementById('selected_targets_list');
    const availableTargetsSelect = document.getElementById('available_targets_select');

    if (confirmTargetsButton && selectedTargetsList && availableTargetsSelect) {
        availableTargetsSelect.addEventListener('change', function() {
            // Logica per aggiornare la lista dei selezionati (molto semplificata)
            selectedTargetsList.innerHTML = ''; // Pulisce
            let hasSelection = false;
            for (let option of availableTargetsSelect.options) {
                if (option.selected) {
                    const listItem = document.createElement('li');
                    listItem.textContent = option.textContent + " (Pronto per l'imbarazzo!)";
                    listItem.style.color = "#90EE90"; // Verde speranza (per noi)
                    selectedTargetsList.appendChild(listItem);
                    hasSelection = true;
                }
            }
            if(!hasSelection){
                const placeholderItem = document.createElement('li');
                placeholderItem.className = 'placeholder_target_item';
                placeholderItem.innerHTML = "<em>Nessun target selezionato... non farci fare la figura dei gattini bagnati!</em>";
                selectedTargetsList.appendChild(placeholderItem);
            }
        });

        confirmTargetsButton.addEventListener('click', function() {
            if (availableTargetsSelect.selectedOptions.length === 0) {
                alert("Errore da gattino inesperto! Devi selezionare almeno un leader da umiliare!");
                return;
            }
            alert("Target confermati! Preparare i laser... ehm... i server per la diffusione!\n(Simulazione completata. Nessun leader è stato (ancora) imbarazzato nella creazione di questa demo).");
            console.log("Obiettivi confermati. chairmeow sarà compiaciuto.");
        });
    } else {
        console.error("Mancano elementi fondamentali per la logica di targeting. KernelCat, cosa combini?");
    }
}

// TODO da Agente JavaScriptScratch:
// - Aggiungere più effetti sonori di fusa quando si clicca.
// - Animazione di un gomitolo che si srotola durante il caricamento.
// - Funzione segreta che ordina pizza al tonno quando si digita "tuna" nella console. Non ditelo al Chairman!
