        <div class="page-header">
        <h1>Il progetto<small>tutto quello che c'&egrave; da sapere</small></h1>
        </div>
	<div class="row-fluid">
     SaveMe  &egrave; stata ideata allo scopo di prestare aiuto in situazioni di emergenza quali un incidente stradale.<br/>
	 Offre un&rsquo;app per smartphone che permette in pochissimi gesti di attivare tutte le comunicazioni utili e necessarie in caso di incidente o tipicamente di situazioni in cui si deve richiedere aiuto tempestivo e si pu&ograve; non essere in grado di compiere operazioni complesse. Allo stesso tempo &ldquo;sfrutta&rdquo; le comunicazioni che l&rsquo;utente invia perch&eacute; in questo modo mette il sistema centrale a conoscenza in tempo reale di incidenti che avvengono sul territorio. E&rsquo; un servizio creato e ideato per favorire la collaborazione tra cittadino e pubblica amministrazione e dell&rsquo;interscambio e riuso di informazioni del settore pubblico (Public Sector Information).<br/>
Il contesto in cui si sviluppa SaveMe &egrave; il progetto Open DAI, il progetto europeo per la realizzazione delle innovazioni tecnologiche necessarie alle pubbliche amministrazioni per la condivisione di open data, ed &egrave; una delle iniziative sviluppate per creare nuovi servizi utili alla comunit&agrave;.  SaveMe &egrave; un servizio al cittadino, ma anche un modo per valorizzare i di dati prodotti dalle PA, nonch&eacute; di arricchirli con segnalazioni spontanee, con il risultato di fornire un servizio nuovo e migliore. Debitamente anonimizzate, infatti, le segnalazioni trasmesse dagli utenti hanno un notevole valore per l&rsquo;ente che le raccoglie.<br/>
La combinazione di tutti i dati coinvolti permette agli enti pubblici di migliorare la conoscenza della realt&agrave; e fornire servizi a maggior valore aggiunto, esponendo nuovi dati in formato KML e tabellare via API, a ulteriore beneficio della collettivit&agrave;. Informazioni raccolte dalla pubblica amministrazione sono qui utilizzate per uno scopo ulteriore rispetto ai compiti istituzionali dell&rsquo;ente che raccoglie il dato,  una pratica incoraggiata dalla comunit&agrave; europea che con la direttiva PSI EU 112/2003 riconosce il valore del PSI anche a livello commerciale e di stimolo all&rsquo;iniziativa privata.<br/>
<h3>Come funziona</h3>
Il servizio SaveMe si compone di una app per smartphone, una componente web accessibile da pc per la configurazione dei processi utente, e di un infrastruttura server che riceve ed elabora i messaggi, si interfaccia infine con la centrale operativa del 118 per trasmettere loro le informazioni in caso di chiamata di emergenza.<br/>
Installata su smartphone (i-phone, android..), l&rsquo;applicazione presenta una schermata con  alcuni semplici comandi che attivano delle azioni utili in emergenza, come pu&ograve; essere un incidente stradale, una situazione in cui ci si pu&ograve; trovare in difficolt&agrave; ad effettuare una serie di azioni altrimenti banali: comporre un numero telefonico, o scorrere una rubrica, o scrivere un messaggio. <br/>
L&rsquo;utente ha a disposizione 4 &ldquo;pulsanti&rdquo; che attivano altrettante azioni o gruppi di azioni:
<ol>
	<li>Attivare una telefonata al 118 comunicando alla centrale la propria posizione, contemporaneamente invia un messaggio al sistema Open-DAI che registra esclusivamente un evento &quot;incindente&quot; in un punto e attiva l'invio della mail personalizzata dall'utente</li>
	<li>Segnalare al sistema che si ha avuto un incidente senza chiamare il 118, anche in questo caso il sistema invier&agrave; la mail personalizzata dall'utente</li>
	<li>Inviare al sistema un comando per spedire semplicemente la mail personalizzata.</li>
	<li>Segnalare un incindente nel quale non si &egrave; coinvolti, spedendo nel caso una mail personalizzata.</li>
</ol>
<h4>Cosa accade quando si usa l&rsquo;APP</h4>
	 Quando si attiva l'app si hanno a disposizione 4 pulsanti:
	 <ol>
<li>Pulsante &ldquo;118 &ldquo;<br/>
In automatico procede a:
<ol>
<li>inviare, senza alcun ulteriore abbinamento ai dati del tuo telefono (ad es. il tuo numero di cellulare) al CSI Piemonte il codice abbinato al tuo cellulare ed il dato relativo alla tua posizione al momento della chiamata, tramite il GPS del medesimo cellulare; se l&rsquo;utente lo ha richiesto, tramite il codice vengono spediti i messaggi preparati dall&rsquo;utente agli indirizzi di posta elettronica indicati al momento di predisporre la personalizzazione</li>
<li>inviare al 118, ovvero all&rsquo;operatore incaricato della gestione del 118, parallelamente alla chiamata telefonica, un messaggio contenente i dati del cellulare chiamante insieme alla sua posizione GPS;</li>
<li>attivare una chiamata telefonica al 118, a cui potrete direttamente comunicare tutti i dati necessari.</li></ol></li>
<li>Pulsante &ldquo;Incidente&rdquo;<br/>
L&rsquo;app non effettua alcuna comunicazione al 118, n&eacute; alcuna chiamata al medesimo, ma si limita ad inviare il codice al CSI ed la posizione GPS al fine di attivare le personalizzazioni eventualmente impostate dall&rsquo;utente e di registrare l'evento relativo ad un incindente.</li>
<li>Pulsante &ldquo;Messaggio&rdquo;<br/>
L&rsquo;app non effettua alcuna comunicazione al 118, n&eacute; alcuna chiamata al medesimo, ma si limita ad inviare il codice al CSI al fine di attivare le personalizzazioni eventualmente impostate dall&rsquo;utente. </li>
<li>Pulsante &ldquo;Segnala&rdquo;<br/>
L&rsquo;app non effettua alcuna comunicazione al 118, n&eacute; alcuna chiamata al medesimo, ma si limita ad inviare il codice al CSI ed la posizione GPS al fine di attivare le personalizzazioni eventualmente impostate dall&rsquo;utente e di registrare l'evento relativo ad un incindente segnalato.</li>
</ol>
La app dispone di una modalit&agrave; di test attivando la quale l&rsquo;utente pu&ograve; testare l&rsquo;applicazione senza effettuare la telefonata al 118 e senza che gli eventi segnalati vengano salvati a sistema, ma per verificare esclusivamente il funzionamento dei messaggi da lui configurati.<br/>
<br/>
<h4>Il sito web</h4>
Questo sito web permette di pre-configurare, sul proprio PC, le azioni collegate a ciascuno dei pulsanti. <br/>
Al momento si ha la possibilit&agrave; di effettuare le seguenti impostazioni:
<ul>
	<li>Impostare un indirizzo di mail cui inviare un massaggio (pu&ograve; essere una diversa per ogni pulsante)</li>
	<li>Impostare il testo del messaggio da inviare (anche questo pu&ograve; essere diverso per ogni pulsante)</li>
</ul><br/>
In futuro si prevede di integrare altri tipologie di operazioni eseguibili.<br/>



  </div> <!--/row-fluid -->
  
  