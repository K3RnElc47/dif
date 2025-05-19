<?php
// upload_kitten_handler.php
// Gestisce il caricamento delle foto imbarazzanti.
// Nome scelto da un gattino della squadra marketing. Non chiedete.

declare(strict_types=1);

require_once 'core_dif_engine.php'; // Il nostro motore preferito!

// Configurazione (dovrebbe essere in un file separato e sicuro, ma siamo gatti, ci piace il rischio)
define('UPLOAD_KITTEN_DIR', __DIR__ . '/../assets/uploads_embarrassing/'); // Attenzione ai permessi!
define('MAX_KITTEN_FILE_SIZE_MB', 9); // Non vogliamo gattini troppo pesanti
define('ALLOWED_KITTEN_TYPES', ['image/jpeg', 'image/png', 'image/gif']);

// Inizializza il motore DIF (con una API key fittizia per la demo)
// $apiKey = "MIAO123SECRETKEYFORTESTINGPURPOSESONLY"; // Non fare così nella vita reale!
// $difEngine = new DiffusoreImbarazzoFelinoEngine($apiKey);

// Per la demo, l'engine non verrà inizializzato qui per evitare output duplicati se incluso altrove
// ma solo loggato per questo script.
function logUploadActivity(string $message, string $level = "INFO"): void {
    $timestamp = date("Y-m-d H:i:sP");
    error_log("[{$timestamp}] [UploadKitten-{$level}] - {$message}\n");
}


header('Content-Type: application/json'); // Rispondiamo sempre in JSON, siamo moderni (quasi)
$response = ['status' => 'error', 'message' => 'Miao! Qualcosa è andato storto come un gomitolo arruffato.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    logUploadActivity("Ricevuta richiesta POST per caricamento foto imbarazzante.");

    if (isset($_FILES['embarrassing_photo']) && $_FILES['embarrassing_photo']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['embarrassing_photo'];
        $leaderName = isset($_POST['leader_name']) ? htmlspecialchars($_POST['leader_name']) : 'LeaderSconosciuto';
        $embarrassmentLevel = isset($_POST['embarrassment_level']) ? (int)$_POST['embarrassment_level'] : 7;
        $photoDescription = isset($_POST['photo_description']) ? htmlspecialchars($_POST['photo_description']) : 'Nessuna descrizione, ma sicuramente imbarazzante.';

        logUploadActivity("Tentativo di upload per: {$leaderName}, File: {$file['name']}, Livello: {$embarrassmentLevel}");

        // Validazione super felina
        if ($file['size'] > MAX_KITTEN_FILE_SIZE_MB * 1024 * 1024) {
            $response['message'] = 'Errore Felino! Il file è troppo pesante, più di un Maine Coon dopo pranzo!';
            logUploadActivity($response['message'], "ERROR");
            echo json_encode($response);
            exit;
        }

        $fileMimeType = mime_content_type($file['tmp_name']);
        if (!in_array($fileMimeType, ALLOWED_KITTEN_TYPES)) {
            $response['message'] = 'Miao-errore! Formato file non approvato dai nostri standard felini (Solo JPG, PNG, GIF)! Questo è un ' . $fileMimeType;
            logUploadActivity($response['message'] . " - Mime type rilevato: " . $fileMimeType, "ERROR");
            echo json_encode($response);
            exit;
        }

        // Creazione di un nome file "sicuro" e "univoco" (a modo nostro)
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $safeLeaderName = preg_replace("/[^a-zA-Z0-9_]/", "_", $leaderName); // Rimuove caratteri strani
        $newFileName = "DIF_IMG_" . $safeLeaderName . "_" . time() . "_" . rand(100,999) . "." . $fileExtension;
        $destinationPath = UPLOAD_KITTEN_DIR . $newFileName;

        // Assicuriamoci che la directory di upload esista (i gatti non amano le sorprese)
        if (!is_dir(UPLOAD_KITTEN_DIR)) {
            if (!mkdir(UPLOAD_KITTEN_DIR, 0755, true)) { // Permessi da gatto responsabile
                $response['message'] = 'Errore Critico da Gattile! Impossibile creare la directory di upload. Chiamare KernelCat!';
                logUploadActivity($response['message'], "FATAL");
                echo json_encode($response);
                exit;
            }
            logUploadActivity("Directory di upload creata: " . UPLOAD_KITTEN_DIR);
        }
        
        if (move_uploaded_file($file['tmp_name'], $destinationPath)) {
            $response['status'] = 'success';
            $response['message'] = "Miao! Foto di {$leaderName} caricata con successo felino in '{$newFileName}'! Pronta per la gloria (o la vergogna)!";
            $response['filepath'] = $destinationPath; // Utile per il motore DIF
            logUploadActivity($response['message'], "SUCCESS");

            // Qui si dovrebbe chiamare il $difEngine->addTargetToDiffusionQueue(...)
            // Ma per la demo, ci fermiamo qui per l'upload handler.
            // $difEngine->addTargetToDiffusionQueue($leaderName, $destinationPath, $embarrassmentLevel);
            logUploadActivity("TODO: Invocare DIF Engine per aggiungere '{$newFileName}' alla coda per {$leaderName}.");

        } else {
            $response['message'] = 'Errore da gattino maldestro! Impossibile spostare il file caricato. Forse il server ha bisogno di una grattatina.';
            logUploadActivity($response['message'] . " Errore PHP: " . $file['error'], "ERROR");
        }

    } else {
        $uploadError = isset($_FILES['embarrassing_photo']['error']) ? $_FILES['embarrassing_photo']['error'] : 'Nessun file inviato';
        $response['message'] = 'Nessun file "imbarazzante" ricevuto o errore durante il caricamento. Hai dimenticato di premere "Invia" con la zampetta giusta? Errore: ' . $uploadError;
        logUploadActivity($response['message'], "WARN");
    }
} else {
    $response['message'] = 'Metodo non miagolante. Accettiamo solo POST pieni di imbarazzo.';
    logUploadActivity($response['message'] . " Metodo usato: " . $_SERVER['REQUEST_METHOD'], "WARN");
}

echo json_encode($response);

// Commento di Lady Purrlock: "Questo script è... funzionale. Ma potrebbe usare più *panache* felino. E meno commenti ovvi."
?>
