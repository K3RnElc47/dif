<?php
// scheduler_catnap.php
// Il nostro pianificatore di diffusione super avanzato.
// Si attiva preferibilmente durante i pisolini pomeridiani (catnap), quando nessuno se lo aspetta.

declare(strict_types=1);
require_once 'core_dif_engine.php';

function logSchedulerActivity(string $message, string $level = "INFO"): void {
    $timestamp = date("Y-m-d H:i:sP");
    // Scriviamo su un file di log dedicato per lo scheduler
    $logFile = __DIR__ . '/../logs/scheduler_catnap.log'; // Assicurarsi che la dir logs esista e sia scrivibile
    if (!is_dir(dirname($logFile))) mkdir(dirname($logFile), 0755, true);
    file_put_contents($logFile, "[{$timestamp}] [SchedulerCatnap-{$level}] - {$message}\n", FILE_APPEND);
}

logSchedulerActivity("Scheduler CatNap attivato. Controllo se è ora di un pisolino... o di scatenare il caos.");

// Logica super complessa per decidere quando eseguire la diffusione
// Per esempio, solo nelle notti di luna piena, o quando il Chairman Meow lo comanda con un miagolio speciale.

$oraDelCrimine = false; // È ora di agire?

// Esempio: esegui solo tra le 2 e le 4 del mattino (ora dei gatti)
$currentHour = (int)date('G');
if ($currentHour >= 2 && $currentHour < 4) {
    logSchedulerActivity("È l'ora dei gatti ({$currentHour}:00)! Condizioni perfette per la diffusione!");
    $oraDelCrimine = true;
} else {
    logSchedulerActivity("Non è ancora l'ora giusta ({$currentHour}:00). Lo scheduler torna a dormire. Zzzzz...");
}

// Oppure, una possibilità casuale per la demo
if (!$oraDelCrimine && rand(1, 100) <= 5) { // 5% di possibilità di attivazione casuale per test
    logSchedulerActivity("Attivazione casuale dello scheduler! Qualche gattino si è seduto sulla tastiera?", "WARN");
    $oraDelCrimine = true;
}


if ($oraDelCrimine) {
    logSchedulerActivity("INIZIO PROCEDURA DI DIFFUSIONE PIANIFICATA!", "CRITICAL");
    
    // SIMULAZIONE PER DEMO (il DIF Engine vero e proprio andrebbe chiamato qui)
    logSchedulerActivity("SIMULAZIONE: Il DIF Engine sarebbe stato invocato qui per processare la coda dal database MeowSQL.", "INFO");
    logSchedulerActivity("SIMULAZIONE: Foto imbarazzanti diffuse con successo felino! Il mondo ora è un posto più... divertente.", "SUCCESS");

    logSchedulerActivity("PROCEDURA DI DIFFUSIONE PIANIFICATA COMPLETATA! Ora un meritato pisolino.", "CRITICAL");

} else {
    logSchedulerActivity("Nessuna azione di diffusione oggi. Troppo sole per lavorare. Meglio un altro sonnellino.");
}

logSchedulerActivity("Scheduler CatNap ha terminato il suo ciclo. Ronf.");

// Commento di KernelCat: "Questo scheduler è più affidabile di me dopo una scorpacciata di tonno. Forse."
// Commento del Chairman Meow: "Voglio un pulsante 'Anticipa Pisolino e Scatena Caos Ora' in questo scheduler!"
?>
