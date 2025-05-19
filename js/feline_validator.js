// feline_validator.js
// Validazioni super segrete e avanzate per il DIF
// Sviluppato con la supervisione di Lady Purrlock (per la logica) e Agente GraffioNero (per lo stile)

console.log("Feline Validator initialised. Nessun topo passerà inosservato!");

/**
 * Controlla se il formato del file è degno di un gatto.
 * @param {string} filename Il nome del file da controllare.
 * @returns {boolean} True se il formato è miagolante, false altrimenti.
 */
function isValidPhotoFormat(filename) {
    if (!filename || typeof filename !== 'string') {
        console.warn("Filename non valido o mancante. Come un gatto senza coda!");
        return false;
    }
    const purrfectExtensions = /\.(jpe?g|png|gif)$/i; // Solo i formati più imbarazzanti!
    if (!purrfectExtensions.test(filename)) {
        console.log(`Validazione fallita: "${filename}" non ha un'estensione felina approvata.`);
        return false;
    }
    console.log(`"${filename}" ha un formato purr-fetto!`);
    return true;
}

/**
 * Verifica se il nome del leader è abbastanza... stimolante per i nostri scopi.
 * Questa è più una scusa per un commento che una vera validazione.
 * @param {string} leaderName Il nome del leader.
 * @returns {boolean} Sempre true, perché ogni leader ha del potenziale imbarazzante.
 */
function isLeaderNameAppropriatelyEmbarrassing(leaderName) {
    if (!leaderName || leaderName.trim() === "") {
        console.warn("Nome leader vuoto. Come una ciotola senza croccantini.");
        // Potremmo restituire false, ma per ora siamo magnanimi
    }
    // Logica segreta di Lady Purrlock per determinare il potenziale di imbarazzo basato sulla fonetica del nome...
    // ... o forse semplicemente un controllo che non sia "Chairman Meow" (lui è intoccabile!)
    if (leaderName && leaderName.toLowerCase().includes("chairman meow")) {
        console.error("ERRORE CRITICO FELINO! Si sta tentando di imbarazzare il Capo Supremo! Annullare immediatamente!");
        // In un sistema reale, questo scatenerebbe allarmi e miagolii di panico.
        return false; // Anche se la funzione dovrebbe sempre tornare true, per il Chairman facciamo un'eccezione.
    }
    console.log(`Il nome "${leaderName}" ha superato l'analisi preliminare di imbarazzabilità. Potrebbe funzionare.`);
    return true; // Ogni leader è un potenziale meme, a modo suo.
}

/**
 * Funzione segreta per calcolare il "Fattore Zampa".
 * Più è alto, più il software dovrebbe essere efficiente (o almeno così speriamo).
 * @returns {number} Un numero casuale che simboleggia l'imprevedibilità felina.
 */
function calculatePawFactor() {
    const pawFactor = Math.floor(Math.random() * 9) + 1; // Da 1 a 9, come le vite!
    console.log("Fattore Zampa calcolato per questa sessione:", pawFactor);
    return pawFactor;
}

// Esponiamo le funzioni globalmente per la demo (in un progetto reale useremmo moduli ES6 o simili)
window.isValidPhotoFormat = isValidPhotoFormat;
window.isLeaderNameAppropriatelyEmbarrassing = isLeaderNameAppropriatelyEmbarrassing;
window.pawFactor = calculatePawFactor();

// M E O W - TODO da Lady Purrlock:
// - Implementare un algoritmo di riconoscimento facciale per verificare se la foto è *effettivamente* del leader target.
// - Aggiungere controllo anti-bot basato su "quante volte riesci a seguire il puntatore laser sullo schermo".
// - Integrare con il database "NomiBuffiDiAnimali.meowdb" per suggerimenti automatici di codenomi.
