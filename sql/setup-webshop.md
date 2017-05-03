SQL API för webshop
===================

## Varukorgen

#### Lägg till produkt

"CALL addToCart(customer_id, product_id, amount)"

#### Ta bort från varukorgen

"CALL removeFromCart(cartRow_id, amount_to_remove)"

Om "amount_to_remove" är lika mycket som antalet som finns i varukorgen tas hela varukorgsraden
bort, annars tas bara det angivna antalet bort.

#### Visa alla produkter

"SELECT * FROM webshop_Vcart [WHERE Cart = ?]"

Varje kund är associerad med ett varukorgs-id, använd det för att visa varukorgen för
en specifik kund.



## Order

#### Skapa ny order

"CALL createOrder(cart_id)"

Skapar en order utifrån den specifierade varukorgen.

#### Ta bort order

"CALL removeOrder(order_id)"

Ordern försvinner inte från databasen utan dess "deleted"-kolumn fylls bara med
nuvarande datum och tid. Ordern kommer efteråt inte att synas i databasens order-vyer.

#### Visa kort information om alla ordrar

"SELECT * FROM webshop_Vorder"

Kort info om själva ordern och vilken kund den är associerad med.

#### Visa detaljerad information om alla ordrar

"SELECT * FROM webshop_VorderDetails [WHERE OrderNumber = ?]"

Ange "OrderNumber" (order_id) för att se alla produkter i en viss order.

#### Visa plocklista för order

"SELECT * FROM webshop_Vplocklist"

Lägger till extra information om var produkterna i en order kan hämtas.



## Beställningsrapport

#### Visa rapport

"SELECT * FROM webshop_VorderMore"

När det bara finns högst 5 st kvar av en viss produkt i lagret kommer den att läggas
till i den här rapporten. Beställ och lägg till nya för att raden ska försvinna.
