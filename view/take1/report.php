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
            <p><strong>Hur kändes det att jobba med PHP PDO, SQL och MySQL?</strong></p>
            <p>
                Jag har jobbat en del med det innan så det kändes bra, det var väl egentligen inga konstigheter.
                Tycker det är ett rätt tydligt sätt att jobba på och man har bra koll på vad som händer. De sista delarna
                i MySQL-uppgiften har jag inte använt så mycket innan, som t.ex. sub-queries och INNER JOIN så det var bra
                att få lite mer kött på benen kring det.
            </p>
            <p><strong>Reflektera kring koden du skrev för att lösa uppgifterna, klasser, formulär, integration Anax
                Lite?</strong></p>
            <p>
                Jag utgick mycket ifrån Database-klassen som finns på github.com/canax/Database. Borde nog egentligen ha
                kopierat det direkt istället för att skriva själv då det tog sin lilla tid att få ordning på allt. I
                $app har jag lagt in Database-klassen, en Query-klass som utför olika queries till databasen som t.ex.
                att hämta alla användare och lägga till en ny användare, en Functions-klass som har metoder för att t.ex.
                skapa en html-tabell och slå ihop två arrays till en query-sträng. Den klassen kan nog bli rätt stor i
                slutändan så man kanske borde dela upp den i olika klasser. Jag har också lagt in en User-klass som håller
                koll på den inloggade användarens properties och har metoder för att bl.a. uppdatera användarens data i
                databasen. Det finns mycket jag skulle kunna förbättra i koden som att spara namnet på “user”-tabellen i
                databasen och se till att återanvända mer kod istället för att skriva nytt. Stylen på admin-sidan har jag
                inte lagt så mycket tid på som jag borde så det ser väl lite sisådär ut. Det har dock tagit lång tid att
                bli klar med kursmomentet så jag kände i slutet att jag inte riktigt hinner fixa till det. Kanske senare.
                Själva strukturen känns ändå okej kan jag tycka, men lite finjusteringar skulle inte skada. Jag har lagt
                in en del färdiga användare till sidan. Vill man logga in som admin kan man skriva “Johndoe” (användarnamn)
                “admin” (lösenord). Vill man logga in som en vanlig användare kan man skriva “Mumin” och “123”. Skillnaden
                syns när man är inloggad och klickar på användarnamnet i navbaren. Där kan en admin klicka på “Admin”-länken
                som för denne till admin-sidan där det går att redigera användare m.m. Admin kan ändra en användares “nivå”.
                Nivå 1 betyder att man är en vanlig användare, och nivå 2 betyder att man har admin-behörigheter. Jag
                sparade cookien “lastUser” där jag sparar användarnamnet på den senast inloggade användaren. När man går
                in på inloggningssidan bör därför användarnamnet redan vara ifyllt om man varit inloggad förut.
            </p>
            <p><strong>Känner du dig hemma i ramverket, dess komponenter och struktur?</strong></p>
            <p>
                Jo, jag känner mig mindre och mindre vilsen kring hur allt är upplagt. Måste jag ändra eller lägga till
                något vet jag oftast var jag ska lägga filer eller skriva om kod. Det känns rätt ordnat och bra nu när
                man har hunnit jobba en del med det. Sen har jag ju inte direkt stenkoll på vad all kod gör, speciellt det
                som ligger i vendor-mappen, men jag vet ändå hur jag kan dra nytta av klasserna som finns där.
            </p>
            <p><strong>Hur bedömer du svårighetsgraden på kursens inledande kursmoment, känner du att du lär dig
                något/bra saker?</strong></p>
            <p>
                Själva uppgifterna är bra och lärorika. Man lär sig hur man kan lägga upp koden och hur man kan tänka när
                man skapar ett sådant här ramverk. Dock har alla kursmomenten tagit väldigt lång tid att genomföra. 4 dagar
                har jag i alla fall fått se till att ha till godo när jag har påbörjat varje moment, vilket nog är lite i
                det högsta laget. Man vill ju gärna ha tid att sitta och experimentera lite, men jag har känt mig rätt
                stressad att försöka hinna klart alltihop inom den tidsramen som finns. Extrauppgifterna har jag därför
                inte gett mig på alls. Webbapps-momenten har jag lyckats bli klar med på högst 2 dagar så det har underlättat
                en del. Så bra uppgifter men lite för mycket jobb för min del i alla fall.
            </p>
            <h3>Kmom04</h3>
            <p><strong>Finns något att säga kring din klass för textfilter, eller rent allmänt om formattering och
                filtrering av text som sparas i databasen av användaren?</strong></p>
            <p>
                Jag gjorde först en egen Textfilter-klass som fungerade bra, men jag kollade också sen lite på den färdiga
                versionen som fanns tillgänglig. Hittade några förbättringar där som jag snodde och la in i min version.
                Jag har aldrig använt sånt här förut så det var kul att se hur det funkar. Är ju egentligen rätt enkelt
                när man väl ser vad som händer under huven (Markdown-klassen var ju dock lite större så den är väl kanske
                inte fullt så enkel).
            </p>
            <p><strong>Berätta hur du tänkte när du strukturerade klasserna och databasen för webbsidor och
                bloggposter?</strong></p>
            <p>
                Jag följde metoden som användes i övningen, så det blev väl inte så värst mycket eget tänk där. Jag hämtar
                dem alltid som objekt från databasen och skriver ut den information jag vill åt. Jag har en Query-klass
                som utför olika förfrågningar till databasen och den har nu fått utökning med en massa metoder för att
                hämta all content, content av en viss typ, content med ett visst id, lägga till ny content o.s.v.
                Dessa gör jag alltid i route-filerna och så skickar jag sen vidare objekten till template-filerna.
                Det blir ju en del logik i själva template-filerna nu när jag skriver ut allt innehåll genom
                foreach-loopar, så kanske man skulle ha haft en funktion som fixar det istället?
            </p>
            <p><strong>Förklara vilka routes som används för att demonstrera funktionaliteten för webbsidor och
                blogg (så att en utomstående kan testa).</strong></p>
            <p>
                För att se på slutresultaten av allt innehåll klickar man på “Innehåll” i navbaren och sedan på
                vilken sorts innehåll man vill se (sida, blogg eller block). Sedan är det lätt att klicka sig vidare.
                Block-sidan är lite ful men jag ville att det skulle vara tydligt vilka delar som är ifrån databasen
                så det får vara så (är väl lite lat där också). För att lägga till, redigera och ta bort innehåll får
                man logga in som admin (“admin”, “admin”), klicka på användarnamnet längst upp till höger i navbaren,
                klicka på admin i dropdownen och sedan på “Redigera innehåll”. Då ser man en tabell på allt innehål
                som finns plus en länk till “Lägga till”-sidan. Även borttaget innehåll syns här, vet inte om det är
                tänkt så. Länkarna för att redigera eller ta bort finns under “Action”-kolumnen i tabellen. Sedan är
                det enkelt att klicka sig fram själv. Textfilter-uppgiften kommer man till genom att klicka på
                “Textfilter” i navbaren.
            </p>
            <p><strong>Hur känns det att dokumentera databasen så här i efterhand?</strong></p>
            <p>
                Reverse engineer var superenkelt att använda och känns väldigt behändig att ha tillgång till. Nu
                har jag ju inte gjort några komplicerade tabeller med foreign keys och annat så det är finns väl
                inte så mycket annat att säga än så länge än att det känns enkelt.
            </p>
            <p><strong>Om du är självkritisk till koden du skriver i Anax Lite, ser du förbättringspotential och
                möjligheter till alternativ struktur av din kod?</strong></p>
            <p>
                Jo, efter varje vecka känns det som att jag skulle vilja gå in i koden och finslipa och ändra lite.
                Blir dock inget p.g.a. tidsbrist. Att det finns mycket att ändra på beror väl delvis på att man
                lär sig en del nytt varje vecka och ser förbättringspotential på det gamla arbetet. Ett exempel är
                att jag i början hämtade $_GET och $_POST-variabler utan någon funktion eller metod, vilket jag
                ändrat på nu. Jag skrev först också en getGet-metod och en getPost-metod i min Functions-klass, men
                nu i veckan såg jag att det redan finns i Request-klassen så jag har ändrat lite i den och använder
                den nu istället. Finns en del funktioner jag kanske borde lägga in också som att redirecta utan
                att använda header-funktionen och att rendera vyer från router-filerna på ett enklare sätt. Sen
                borde jag också ha använt en config-fil för att lägga in namnen på users- och content-tabellerna
                från databasen i min Query-klass. De har jag nu skrivit in själv direkt i __construct-metoden. När
                jag la in en sidebar med ett “block” som innehåll fick jag ändra lite i min layout-fil där jag
                lägger in alla vyer. Jag använder ju Bootstrap och fick skriva om lite för att få in sidebaren och
                nu har det nog blivit lite knas med resterande sidor vad gäller html-struktur, så där borde jag
                städa upp en del och ändra. Och så finns det annat att ändra på också förstås men texten börjar bli
                lång nu så det får räcka.
            </p>
            <h3>Kmom05</h3>
            <p><strong>Gick det bra att komma igång med det vi kallar programmering av databas, med transaktioner,
                lagrade procedurer, triggers, funktioner?</strong></p>
            <p>
                Jo, det gick rätt bra. Det är kul att få ha provat på lite mer avancerad programmering med MySQL
                än att bara skapa vanliga tabeller och sedan göra det mesta av jobbet i PHP. Har provat på
                transaktioner lite grann innan men allt annat var nytt för mig. Allt känns ju väldigt användbart.
            </p>
            <p><strong>Hur är din syn på att programmera på detta viset i databasen?</strong></p>
            <p>
                Att kunna skapa ett API till databasen gör ju att koden i PHP och anax-lite blir snyggare och
                tydligare. Vet ju dock inte hur det skiljer sig med hastighet och så mellan att göra så här och som
                jag gjort innan, men att göra mer programmering i databasen känns som en bra metod. Det kan ju också
                vara lättare att testa saker om man slipper blanda in PHP i det hela. Ser man först till att alla
                procedurer och sånt funkar i databasen och sedan får problem i PHP så blir det lättare att felsöka.
            </p>
            <p><strong>Några reflektioner kring din kod för backenden till webbshopen?</strong></p>
            <p>
                Känner väl när jag bläddrar omkring i Workbench bland alla 100-tals rader kod att det vore bra att
                organisera det lite bättre. Fyller man på med fler och fler tabeller blir det i slutändan lite
                jobbigt att scrolla omkring så mycket så det hade ju inte varit fel att kunna dela upp allt i olika
                filer. Vet inte om det är möjligt, men det är i alla fall en nackdel med hur jag har jobbat nu.
                Hade ju också kunnat flytta runt lite så att jag kanske t.ex. sorterar funktioner, vyer och procedurer
                på egna platser. Är lite väl kaotiskt nu kan jag tycka då jag bara har lagt tabellerna i början av
                koden och resten ligger lite hipp som häpp.
            </p>
            <p><strong>Något du vill säga om koden generellt i och kring Anax Lite?</strong></p>
            <p>
                Nu har jag inte ändrat något i databashanteringen när det gäller tidigare kursmoment så koden är ju
                inte enhetlig på den fronten, och så är det garanterat om jag kollar på övrig kod också. Har inte
                blivit att jag i efterhand har ändrat så mycket i tidigare kod när jag lärt mig skriva på ett nytt
                sätt, så det största problemet nu är väl att det ser ut som att olika personer har skrivit koden
                beroende på var man kollar. Så en genomgång av all kod hade inte varit fel. Hade ju också kunnat
                lägga in mer exceptions-filer, config-filer och annat till mina egna klasser. Men annars tycker jag
                väl att det är ganska enkelt att jobba med ramverket som det är nu. Känner mig mer och mer bekväm
                med att skapa nya routes och använda klasserna där det passar. Får väl kanske chansen att göra en
                mer städad version i projektet om jag gissar rätt.
            </p>
            <h3>Kmom06</h3>
            <p><strong>Var du bekant med begreppet index i databaser sedan tidigare?</strong></p>
            <p>
                Jo, jag har provat på att lägga in index förut. Dock har jag aldrig använt EXPLAIN förut och fått
                se hur det kan skilja sig mellan att använda det och inte. Fick ju lite problem med att använda
                fulltext-index i bths databas eftersom att InnoDB inte verkar ha stött det i tidigare
                MySQL-versioner. Det verkar som att det hade funkat med MyISAM, men jag hoppade över det.
            </p>
            <p><strong>Berätta om hur du jobbade i uppgiften om index och vilka du valde att lägga till och
                skillnaden före/efter.</strong></p>
            <p>
                Jag tänkte utifrån ett kundperspektiv vilka sökningar som kunde vara relevanta och valde
                namnet på spelet, plattformen som spelet tillhör och namn på kategorierna. Söker man efter
                ett visst spel behöver man förstås kolla efter namnen på alla spelen så det fick ett
                vanligt index, hade tänkt köra med ett fulltext-index för att göra det lättare att hitta
                saker men då hade jag tydligen varit tvungen att ändra storage engine från InnoDB till
                MyISAM så jag tänkte att jag hoppar över det så inget går snett. En kund kanske bara är
                intresserad av spel till en viss plattform (t.ex. Playstation 4 eller Xbox One) så den
                kolumnen fick också ett vanligt index. Dessa två kolumner finns i min produkt-tabell och
                skillnaden efter att jag lagt in indexen var att enbart de rader som stämmer överens med
                WHERE-frågan behövdes besökas istället för en full table scan. En kund kanske också vill
                leta efter spel av en viss kategori (t.ex. action eller adventure) så jag la in ett index
                på den kolumnen i min kategori-tabell. Dessa kommer alltid vara unika så jag skapa indexet
                genom att göra kolumnen UNIQUE. Kanske man till och med kan låta namnet på kategorin vara
                en primary key. Även här blev skillnaden att bara den rad som stämmer överens med WHERE-frågan
                behöver besökas istället för en full table scan.
            </p>
            <p><strong>Har du tidigare erfarenheter av att skriva kod som testar annan kod?</strong></p>
            <p>
                Jo, det blev ju en hel del enhetstestning med unittest i oopython-kursen. PHPUnit känns
                ju väldigt likartat så man kände sig rätt hemma fort.
            </p>
            <p><strong>Hur ser du på begreppet enhetstestning och att skriva testbar kod?</strong></p>
            <p>
                Tycker att det är användbart och gör att man känner sig säkrare i att koden funkar som
                man tänkt. Dock är det ju lätt att ligga på latsidan och strunta i det, men det
                underlättar faktiskt när man väl ha gjort det. Gör man ett väldigt litet program så kan
                det ju dock kännas lite onödigt. Sen vet jag inte vad jag tycker om att skriva testbar kod
                bara för den skull att den ska gå att testa. Är den testbar kan man lätt kolla om den
                funkar som tänkt, men det kan ju bli några extra rader kod. Jaja, kanske det är bra i
                slutändan om man vill minska risken för problem senare.
            </p>
            <p><strong>Hur gick det att hitta testbar kod bland dina klasser i Anax Lite?</strong></p>
            <p>
                De flesta klasserna jag gjort är ju beroende av andra klasser eller databasen så det var
                inte hur mycket som helst av välja bland. Började med att försöka göra ett test till min
                Session-klass, men då blev det problem när jag skulle starta en session. Kanske har att
                göra med att den slås igång från terminalen eller nåt. Struntade i alla fall i det då
                och valde Textfilter-klassen istället. Den är i och för sig beroende av Markdown-klassen,
                men jag tänkte det får vara då jag inte injectar den eller så. Fixade 100% i kodtäckning
                så det blev ju rätt bra. Man märker ju dock att 100% kodtäckning inte betyder att allt
                nödvändigtvis funkar som det ska då alla utfall egentligen inte är testade.
            </p>
            <h3>Kmom07-10</h3>
            <p>Redovisningstext</p>
        </div>
    </div>
</div>