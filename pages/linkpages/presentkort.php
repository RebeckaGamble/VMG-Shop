<?php

require_once __DIR__ . "/../../classes/Template.php";

Template::header("Presentkort");

?>
<div class="linkpage">
    <h2>Presentkort</h2>
    <p>Giltighetstiden för våra presentkort är 1 år från dagen då det beställs. 
        Du kan köpa ett presentkort med samma betalsätt som vid en beställning, du kan dock inte
        betala ett presentkort med ett annat presentkort. 
    </p>
    <br>
    <p>
        <h3>Köp presentkort</h3>
        Du kan köpa ett digitalt eller fysiskt presentkort. <br> <br>
        <div class="link-btn"><button>Digitalt presentkort</button> <button>Fysiskt presentkort</button></div>
    </p>
    <br>
    <p>
        <h3>Kontrollera saldo</h3>
        Här kan du kontrollera ditt saldo och giltighetstiden på ditt presentkort <br> <br>
        <button>Se ditt saldo</button>
    </p>
</div>

<?php

Template::footer();