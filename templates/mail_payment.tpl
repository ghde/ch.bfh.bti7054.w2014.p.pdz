++++++++++++++++++++++++++++++ ENGLISH VERSION AT THE BOTTOM ++++++++++++++++++++++++++++++

Hallo {$user->getFirstName()},

Vielen Dank für Ihre Bestellung bei "Plants for your Home".

Damit wir Ihre Bestellung so rasch als möglich versenden können, überweisen Sie uns bitte den Totalbetrag auf unser Konto:
IBAN: CHXX XXXX XXXX XXXX XXXX X
SWIFT: XYZ
Betrag: CHF {$price|number_format:2:".":","}
Verwendungszweck: Bestellung {$order->getId()}

Mit freundlichen Grüssen
Plants for your Home

+++++++++++++++++++++++++++++++++++++ ENGLISH VERSION +++++++++++++++++++++++++++++++++++++

Dear {$user->getFirstName()},

Thank you for your order at "Plants for your Home".

In order to deliver your plants to your home we kindly ask you to transfer the total amount to our bank account:
IBAN: CHXX XXXX XXXX XXXX XXXX X
SWIFT: XYZ
Amount: CHF {$price|number_format:2:".":","}
Intended Use: Order {$order->getId()}

Sincerely,
Plants for your Home