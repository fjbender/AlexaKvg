# AlexaKvg

## Abstract
Alea asks the inofficial API of the Kieler Verkehrsgesellschaft (KVG) for departures at a Kiel bus stop (currently the one next to my house) and reads them back to the user.

## Todos
Currently, only one stop can be queried through Alexa. Need to figure out the slot model to query for specific stops. However, KVG has a non-consecutive numbering system for stops, so I'll need to figure that out first. The underlying KVG service supports querying different stops already, as long as their ID is know.