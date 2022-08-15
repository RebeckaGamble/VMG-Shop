<?php

require_once __DIR__ . "/../../classes/Template.php";


Template::header("Betalning");

?>
 <div class="linkpage">

    <h2>Betalning</h2>
    <p>
        I samarbete med Klarna erbjuder vi fakturabetalning, delbetalning, 
        kontokortsbetalning, Swish samt direktbetalning. 
        Genom att lämna information i kassan godkänner du Klarnas villkor. 
        Genom att klicka på "Slutför köp" godkänner du VMG's <a href=""> allmänna villkor.</a>
    </p>
    <br>
    <p>
        <h3>Kortbetalning</h3>
        Du kan välja att betala din beställning med kort. Vid kortbetalning kan du använda 
        dig av VISA eller Mastercard/Eurocard. Vid beställning görs en reservation av 
        köpesumman på ditt konto. Pengarna dras först när varorna skickas.

        Alla kortbetalningar hanteras av Klarna AB som kontrollerar att kortet är godkänt 
        för köp. Kvittot på din betalning skickas med e-post.
    </p>
    <p>
        <h3>Fakturabetalning</h3>
        Fakturan skickas till angiven e-post adress och ska betalas inom 30 dagar från fakturadatum.
        Om du inte betalar inom förfallodatum skickas en påminnelsefaktura med en påminnelseavgift på 
        29 kronor. 
    </p>
    <p>
        <h3>Swish</h3>
        Med swish betalar du din order på en gång. Ange telefonnummer i kassan, öppna swish appen 
        och signera med ditt Bankid. 
    </p>
</div>

<?php

Template::footer();