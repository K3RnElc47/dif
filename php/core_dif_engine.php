<?php
// core_dif_engine.php
// Il cuore ronronante del Diffusore di Imbarazzo Felino
// Creato da KernelCat, con l'ispirazione (e le minacce) del Chairman Meow

declare(strict_types=1); // I gatti sono precisi, quando vogliono.

// Definizione di costanti super segrete
define('MAX_LIVES_FOR_RETRY', 100);
define('CATNIP_BOOST_FACTOR', 1.337); // Per quando le cose si fanno difficili
define('CHAIRMAN_APPROVAL_NEEDED_LEVEL', 10);

/**
 * Classe principale del motore DIF.
 * Gestisce la logica di targeting, diffusione e imbarazzo generale.
 * Non accarezzare contropelo.
 */
class DiffusoreImbarazzoFelinoEngine {
    private string $version = "0.9.9 'Quasi Purr-fetta'";
    private array $targetQueue = [];
    private $meowDB_connection = true; // Connessione al nostro MeowSQL (finta)

    public function __construct(string $catHubApiKey) {
        // Simulazione connessione a CatHub per aggiornamenti e direttive segrete
        if (empty($catHubApiKey)) {
            $this->logPurrActivity("Errore Critico Felino: API Key di CatHub mancante! Il Chairman non sarà contento.", "FATAL");
            // throw new Exception("Manca l'API Key di CatHub! Missione abortita prima di iniziare!");
            // Per la demo, non blocchiamo tutto
        }
        $this->logPurrActivity("Motore DIF v{$this->version} inizializzato. Pronto a miagolare ordini.");
        $this->connectToMeowDB();
    }

    private function connectToMeowDB(): void {
        // Logica di connessione al database MeowSQL (super finta)
        $this->logPurrActivity("Tentativo di connessione a MeowSQL su 'purr_server.gattari.internal'...");
        if (rand(0, 10) > 2) { // 80% di successo
            $this->meowDB_connection = new stdClass(); // Oggetto fittizio per la connessione
            $this->logPurrActivity("Connessione a MeowSQL stabilita! I dati sono al sicuro (sotto una pila di cuscini).");
        } else {
            $this->logPurrActivity("MEOW-ERRORE: Impossibile connettersi a MeowSQL! Forse il server sta facendo un pisolino.", "ERROR");
        }
    }

    /**
     * Aggiunge un leader alla coda di diffusione dell'imbarazzo.
     * @param string $leaderID Identificativo del leader (es: "PresidentePastrocchio")
     * @param string $photoPath Percorso della foto compromettente
     * @param int $embarrassmentLevel Livello di imbarazzo (1-10+)
     * @return bool True se aggiunto con successo, false altrimenti.
     */
    public function addTargetToDiffusionQueue(string $leaderID, string $photoPath, int $embarrassmentLevel): bool {
        if ($embarrassmentLevel >= CHAIRMAN_APPROVAL_NEEDED_LEVEL && $leaderID !== "ChairmanMeow_👑") {
            // Livelli alti richiedono approvazione... a meno che non sia per il capo stesso (impossibile!)
            $this->logPurrActivity("Tentativo di aggiungere {$leaderID} con livello {$embarrassmentLevel}. Richiesta approvazione al Consiglio Felino Supremo.", "WARN");
            // return false; // Per la demo, procediamo
        }

        if (!file_exists($photoPath) && !filter_var($photoPath, FILTER_VALIDATE_URL)) { // Accettiamo anche URL per foto remote
            $this->logPurrActivity("Foto '{$photoPath}' per {$leaderID} non trovata! Come un topo che scappa.", "ERROR");
            return false;
        }
        
        $this->targetQueue[] = [
            'id' => $leaderID,
            'photo' => $photoPath,
            'level' => $embarrassmentLevel,
            'status' => 'in_attesa_di_fusa_malvagie',
            'timestamp_aggiunta' => time()
        ];
        $this->logPurrActivity("{$leaderID} aggiunto alla coda di diffusione con foto '{$photoPath}'. Livello imbarazzo: {$embarrassmentLevel}. Il divertimento sta per iniziare!");
        return true;
    }

    /**
     * Avvia il processo di diffusione (simulato).
     * Qui la magia (malvagia) accade.
     */
    public function unleashTheEmbarrassment(): void {
        if (empty($this->targetQueue)) {
            $this->logPurrActivity("Coda di diffusione vuota. Oggi i leader sono salvi... per ora.", "INFO");
            return;
        }

        $this->logPurrActivity("INIZIO DIFFUSIONE GLOBALE DELL'IMBARAZZO! Allacciate le cinture (e affilate gli artigli)!", "CRITICAL");
        foreach ($this->targetQueue as $index => $target) {
            $this->logPurrActivity("Diffusione per: {$target['id']} - Foto: {$target['photo']} - Livello: {$target['level']}");
            
            // Simulazione complessa di interazione con social media, dark web, ecc.
            for ($i = 0; $i < MAX_LIVES_FOR_RETRY; $i++) {
                $this->logPurrActivity("Tentativo di diffusione #".($i+1)." per {$target['id']}...");
                if (rand(0,10) > 3) { // 70% successo al tentativo
                    $this->logPurrActivity("SUCCESSO! Foto di {$target['id']} diffusa con viralità felina potenziata da Catnip™!", "SUCCESS");
                    $this->targetQueue[$index]['status'] = 'imbarazzo_scatenato_con_successo';
                    // Qui potremmo notificare il Chairman Meow o Lady Purrlock
                    break; 
                } else {
                    $this->logPurrActivity("Tentativo #".($i+1)." fallito. Il server bersaglio ha opposto resistenza (o era protetto da un chihuahua particolarmente agguerrito).", "WARN");
                    if ($i === MAX_LIVES_FOR_RETRY - 1) {
                        $this->logPurrActivity("MASSIMO NUMERO DI TENTATIVI RAGGIUNTO per {$target['id']}. Forse questo leader ha 9 vite digitali.", "ERROR");
                        $this->targetQueue[$index]['status'] = 'fallimento_diffusione_imbarazzante';
                    }
                }
                usleep(100000 * rand(1,3)); // Pausa felina realistica
            }
        }
        $this->logPurrActivity("Ciclo di diffusione completato. Controllare i log per i dettagli e preparare i festeggiamenti (con tonno).", "INFO");
        // $this->targetQueue = []; // Svuota la coda dopo la diffusione (o forse no, per debug)
    }

    /**
     * Registra attività importanti (o meno importanti) del motore.
     * @param string $message Il messaggio da registrare.
     * @param string $level Livello di log (INFO, WARN, ERROR, FATAL, CRITICAL, SUCCESS).
     */
    public function logPurrActivity(string $message, string $level = "INFO"): void {
        $timestamp = date("Y-m-d H:i:sP"); // Formato ISO 8601 con fuso orario (i gatti sono internazionali)
        $logEntry = "[{$timestamp}] [DIF-Engine-{$level}] - {$message}\n";
        
        // In un'applicazione reale, questo scriverebbe su un file di log dedicato
        // Per la demo, lo mandiamo all'error_log di PHP se è un errore, o lo stampiamo se è INFO per debug.
        if (in_array($level, ["ERROR", "FATAL", "CRITICAL"])) {
            error_log($logEntry); // Visibile nel log del server web/PHP
        } else {
            // echo $logEntry; // Potrebbe sporcare l'output, usiamo error_log per tutto per la demo
            error_log($logEntry);
        }
    }

    public function __destruct() {
        $this->logPurrActivity("Motore DIF in fase di auto-distruzione... ehm, deallocazione. A caccia di nuovi topi digitali!");
        if ($this->meowDB_connection) {
            // $this->meowDB_connection->close(); // Chiusura finta connessione
            $this->logPurrActivity("Connessione a MeowSQL terminata. Il database è tornato a dormire.");
        }
    }
}

// Esempio di utilizzo (NON ESEGUIRE DIRETTAMENTE IN PRODUZIONE... O FORSE SI?)
// $difUrl = getenv("DIF_SECRET_URL_PLEASE_DONT_LEAK"); // Non sicuro! Solo per demo!

// $difEngine = new DiffusoreImbarazzoFelinoEngine($apiKey);
// $difEngine->addTargetToDiffusionQueue("PresidentePastrocchio", "/mnt/secret_photos/pastrocchio_anni70.jpg", 9);
// $difEngine->addTargetToDiffusionQueue("ReginaConfusione", "https://example.com/reginaconfusione_ballo.gif", 8);
// $difEngine->unleashTheEmbarrassment();

// Commento finale di Chairman Meow: "Questo codice è... accettabile. Ma voglio più caos. E più laser."
?>
