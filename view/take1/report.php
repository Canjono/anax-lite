<div class="container" role="main">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <h1>Redovisningar</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>Kmom01</h3>
            <p><strong>Hur känns det att hoppa rakt in i klasser med PHP, gick det bra?</strong></p>
            <p>
                Jo, det gick bra. Vi har ju jobbat med klasser en hel del i Python nu innan så det är väl
                egentligen inga konstigheter hittills. Skillnaden blir väl att bli kompis med “public”,
                “private”, etc. Jag tycker ju att allt blir så mycket roligare när man jobbar
                objektsorienterat så det är bara kul än så länge.
            </p>
            <p><strong>Berätta om dina reflektioner kring ramverk, anax-lite och din me-sida.</strong></p>
            <p>
                Det kändes ju rätt överväldigande att jobba med anax-flat i design-kursen så att få börja om
                med anax-lite känns rätt bra. Det är ju mycket kod jag inte har koll på även här, men själva
                strukturen har jag väl ändå ett någorlunda hum om. Speciellt om man jämför med hur mycket koll
                jag hade på anax-flat. Får hoppas på att det framöver blir lättare och lättare att förstå hur
                allt funkar och att det inte blir mer och mer förvirrande. Det är ju mycket moduler och allt
                vad det är som läggs in nu i början som jag inte känner att jag har tid att sätta mig in i just
                nu. Det kändes inte allt för svårt att skriva ihop koden till me-sidan tack vare handledningen
                som fanns till hands. Jag hoppas att jag gjort som det är tänkt med navbaren då det endast är
                själva navigeringen jag skapat enligt anvisningarna. Jag använder ju Bootstrap till stylingen
                och hela header-delen tillhör ju navbaren där, men jag har alltså hårdkodat allt i headern
                förutom själva navigeringen som skapas dynamiskt utifrån arrayen jag gjorde. Jag har lagt
                länken till “gissa numret”-spelet på about-sidan.
            </p>
            <p><strong>Gick det bra att komma igång med MySQL, har du liknande erfarenheter sedan tidigare?</strong>
            </p>
            <p>
                Jo, det gick bra. Jag har jobbat en del med MySQL innan så början var lätt. Har dock inte använt
                MySQL Workbench innan, men det var ju lätt att få igång så. Vi fick ju också göra någon labb i
                en tidigare kurs där man fick en rejäl genomkörare av MySQL (eller var det sqlite?). Ser fram
                emot att få lära mig mer avancerade kommandon. Förhoppningsvis får vi prova på att koppla ihop
                flera tabeller med varandra då jag känner att jag skulle vilja vässa mina kunskaper kring det.
            </p>
            <h3>Kmom02</h3>
            <p><strong>Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar
                med de olika sätten?</strong></p>
            <p>
                Om man med “skriva kod inuti ramverket” menar att t.ex. lägga in den i app-objektet och utnyttja
                andra klasser i det så är det väl lätt hänt att koden blir alltför beroende av resten av ramverket.
                Kan då tänka mig att om något ändras i någon annan klass så kan saker och ting lätt gå sönder på andra
                ställen. Jag har ju i Session-klassen t.ex. använt mig av $app->url och det gäller ju att den funkar
                precis som den gör nu för att Session-klassen inte ska behöva skrivas om. Fördelen är ju att man kan
                utnyttja resten av ramverkets delar och minska andelen kod i nya klasser. Men det känns bra att
                skriva kod inuti ramverket än så länge. Kan tänka mig att det säkert går att utnyttja mer än jag gör.
            </p>
            <p><strong>Hur väljer du att organisera dina vyer?</strong></p>
            <p>
                Jag har skapat en layout-fil som jag utgår ifrån när jag hanterar olika routes. Det är ju direkt efter
                ett av exemplena i någon övning vi gjorde. Tycker det blir rätt snyggt när headern och footer alltid
                ligger där automatiskt och man bara fyller på med innehållet mellan dem.
            </p>
            <p><strong>Berätta om hur du löste integreringen av klassen Session.</strong></p>
            <p>
                Har gjort så att jag lägger in session-objektet i $app i index.php och startar den direkt där. Alla
                sidor använder ju inte session så det kanske egentligen vore bättre att starta den i route-filen
                istället, men det kändes så enkelt att göra så här så det blev så. Har väldigt lite php-kod i själva
                vyerna och har lagt den mesta logiken i route-filen. Klickar man t.ex. på “increment” så kommer det
                nya numret att hämtas och ändras i config/route/session.php-filen och sedan redirecta tillbaka till
                “session”-routen.
            </p>
            <p><strong>Berätta om hur du löste uppgiften med Tärningsspelet 100/Månadskalendern, hur du tänkte,
                planerade och utförde uppgiften samt hur du organiserade din kod?</strong></p>
            <p>
                Jag gjorde månadskalendern eftersom att jag vanligtvis avskyr att syssla med datum och tid, så jag
                tänkte att jag nu kanske kunde bli vän med en massa datum-funktioner. Planeringen skötte jag inge
                vidare då jag var lite osäker på hur jag skulle lösa uppgiften. Jag började bara testa en massa
                inbyggda datum-funktioner för att kolla vad man kan göra och byggde Calendar-klassen allteftersom.
                Så mitt fokus var egentligen bara att få det att funka. I Calendar sparas information om den nuvarande
                månaden man tittar på i variabler så att man t.ex. lätt får tag i antalet dagar, första dagen i månaden,
                namn på månaden, etc. Även antalet dagar i föregående månad sparas. Sedan har jag metoder som ändrar
                månad till föregående eller nästa, returnerar månaden som en html-tabell, får tag på namnet på månadens
                bild, etc. Jag hade nog kunnat göra det snyggare genom att kanske spara månaden som en egen klass och
                injecta url-klassen i Calendar för att skapa länkar så det blir mindre kod i vyerna. Jag lägger in
                Calendar i app-objektet. Lite onödigt kanske då Calendar bara används på ett ställe i hemsidan. Jag
                har en egen route-fil till kalendern som hanterar routerna “calendar”, “calendar/previous” och
                “calendar/next”. Så här i efterhand hade jag säkert gjort lite annorlunda om jag hade börjat om, men det
                har tagit en hel del tid att bli klar med kmom02 så jag får ta med lärdomarna till någon framtida uppgift.
            </p>
            <p><strong>Några tankar kring SQL så här långt?</strong></p>
            <p>
                Det har varit kul än så länge att göra uppgifterna. Speciellt nu när jag har börjat lite med de inbyggda
                funktionerna. Det är ju egentligen rätt enkla uppgifter än så länge och man får kanske lite för mycket
                hjälp ibland. Men det kan vara rätt skönt att slippa köra fast överallt. Man lär sig ju ändå så. Försöker
                utgå ifrån manualen så mycket jag kan för att förhoppningsvis bli vän med den. Hade dock lite svårt att
                hitta info om hur man ska använda LIKE i manualen så där fick det bli lite google-sökning. Så riktigt
                bästisar är vi väl inte än.
            </p>
            <h3>Kmom03</h3>
            <p>Redovisningstext</p>
            <h3>Kmom04</h3>
            <p>Redovisningstext</p>
            <h3>Kmom05</h3>
            <p>Redovisningstext</p>
            <h3>Kmom06</h3>
            <p>Redovisningstext</p>
            <h3>Kmom07-10</h3>
            <p>Redovisningstext</p>
        </div>
    </div>
</div>