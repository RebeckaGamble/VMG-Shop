<?php

require_once __DIR__ . "/../../classes/Template.php";


Template::header("Frakt och Leverans");

?>

<div class="linkpage">

    <h2>Frakt och Leveransvillkor</h2>
    <p>Vi erbjuder fri frakt vid köp över 499 kronor. Vid order under 499 kronor tillkommer en fraktkostnad på 49 kronor.</p>
    <p>Vi packar din order inom 24 timmar, sen tar det mellan 1-5 vardagar för leverans.</p>
    <br>
    <p>
        <h3>Ombud</h3>
        Vi erbjuder leverans med Postnord och DB Schenker till valt ombud. Paketet måste hämtas ut 
        inom 14 dagar om inte annat anges av ditt ombud, annars sänds försändelsen tillbaka till oss
        där du som kund debiteras en kostnad av frakt såväl som returfrakt på 69 kronor. 
    </p>
    <p>
    <h3>Hemleverans</h3>
    Vi erbjuder hemleverans med Best Transport, DHL, Postnord och Airmee.
    Paketet lämnas vid dörern om inte annat kommit överens med dig och vald transportör.
    Har du angett att du ska ta emot beställningen men inte är där när den anländer kommer den
    att sändas tillbaka och du som kund debiteras för både frakt och returfrakt på 69 kronor. 
    </p>
</div>

<?php

Template::footer();