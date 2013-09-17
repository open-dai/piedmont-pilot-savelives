        <div class="page-header">
        <h1>Il progetto<small> everything you need to know</small></h1>
        </div>
	<div class="row-fluid">
     SaveMe  &egrave; stata ideata allo scopo di prestare aiuto in situazioni di emergenza quali un incidente stradale. Offre un&rsquo;app per smartphone che permette in pochissimi gesti di attivare tutte le comunicazioni utili e necessarie in caso di incidente o tipicamente di situazioni in cui si deve richiedere aiuto tempestivo e si pu&ograve; non essere in grado di compiere operazioni complesse. Allo stesso tempo &ldquo;sfrutta&rdquo; le comunicazioni che l&rsquo;utente invia perch&eacute; in questo modo mette il sistema centrale a conoscenza in tempo reale di incidenti che avvengono sul territorio. E&rsquo; un servizio creato e ideato a favore della collaborazione tra cittadino e pubblica amministrazione e dell&rsquo;interscambio e riuso di informazioni del settore pubblico (Public Sector Information).<br/>
Il contesto in cui si sviluppa SaveMe &egrave; il progetto Open DAI, il progetto europeo per la realizzazione delle innovazioni tecnologiche necessarie alle pubbliche amministrazioni per la condivisione di open data, ed &egrave; una delle iniziative sviluppate per creare nuovi servizi utili alla comunit&agrave;.  SaveMe &egrave; un servizio al cittadino, ma anche un modo per valorizzare i di dati prodotti dalle PA, nonch&eacute; di arricchirli con segnalazioni spontanee, con il risultato di fornire un servizio nuovo e migliore. Debitamente anonimizzate, infatti, le segnalazioni trasmesse dagli utenti hanno un notevole valore per l&rsquo;ente che le raccoglie.<br/>
La combinazione di tutti i dati coinvolti permette agli enti pubblici di migliorare la conoscenza della realt&agrave; e fornire servizi a maggior valore aggiunto, esponendo nuovi dati in formato KML e tabellare via API, a ulteriore beneficio della collettivit&agrave;. Informazioni raccolte dalla pubblica amministrazione sono qui utilizzate per uno scopo ulteriore rispetto ai compiti istituzionali dell&rsquo;ente che raccoglie il dato,  una pratica incoraggiata dalla comunit&agrave; europea che con la direttiva PSI EU 112/2003 riconosce il valore del PSI anche a livello commerciale e di stimolo all&rsquo;iniziativa privata.<br/>
<h3>Come funziona</h3>
Il servizio SaveMe si compone di una app per smartphone, una componente web accessibile da pc per la configurazione dei processi utente, e di un infrastruttura server che riceve ed elabora i messaggi.<br/>
Installata su smartphone (i-phone, android..), l&rsquo;applicazione presenta una schermata con  alcuni semplici comandi che attivano delle azioni utili in emergenza, come pu&ograve; essere un incidente stradale, una situazione in cui ci si pu&ograve; trovare in difficolt&agrave; ad effettuare una serie di azioni altrimenti banali: comporre un numero telefonico, o scorrere una rubrica, o scrivere un messaggio. <br/>
L&rsquo;utente ha a disposizione 4 &ldquo;pulsanti&rdquo; che attivano altrettante azioni o gruppi di azioni:
<ol>
	<li>Inviare una richiesta di soccorso al 118 comunicando al sistema la propria posizione, ma nessun dato personale</li>
	<li>Segnalare al sistema che si ha avuto un incidente senza chiamare il 118</li>
	<li>inviare al sistema un comando per eseguire il proprio flusso di azioni</li>
	<li>Segnalare un incindente nel quale non si è coinvolti</li>
</ol>
<ol>
	<li>Invia un messaggio al sistema regionale  di emergenza, invia un messaggio al sistema di OpenDAI, attiva una chiamata telefonica al sistema di emergenza (numero telefonico pe le emergenze nazionali 118)</li>
	<li>Invia un messaggio al sistema di OpenDAI. Questo messaggio indica che l&rsquo;utente &egrave; stato coinvolto in un incidente ma che non &egrave; necessario l&rsquo;intervento di emergenza.</li>
	<li>Invia un messaggio al sistema di OpenDAI, ma non vi &egrave; stato alcun incidente. Questo messaggio ha lo scopo di segnalare che &egrave; avvenuto un incidente, anche se non si &egrave; coinvolti nello stesso.</li>
</ol>
	 
La componente web permette di pre-configurare, sul proprio PC, le azioni collegate a ciascuno dei pulsanti. Si accede alla componente dalla url XXX  effettuando la registrazione con login e password.<br/>
Il sistema fornisce quindi un identificativo da utilizzare per configurare l&rsquo;app sullo smartphone.<br/>
Si ha la possibilit&agrave; di effettuare le seguenti impostazioni:
<ul>
	<li>Impostare un indirizzo di mail cui inviare un massaggio (può essere una diversa per ogni pulsante)</li>
	<li>Impostare il testo del messaggio da inviare (anche questo può essere diverso per ogni pulsante)</li>
</ul>


Il sistema si occupa di validare le impostazioni inserite dall&rsquo;utente. Attivando la modalit&agrave; &ldquo;test&rdquo; l&rsquo;utente pu&ograve; testare l&rsquo;applicazione senza inviare effettive segnalazioni al sistema di emergenza!

  </div> <!--/row-fluid -->
  
  