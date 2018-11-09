# AlexaKvg

## Abstract
Alexa asks the inofficial API of the Kieler Verkehrsgesellschaft (KVG) for departures at a Kiel bus stop (currently the one next to my house) and reads them back to the user.

## Todos
Currently, only one stop can be queried through Alexa. Need to figure out the slot model to query for specific stops. However, KVG has a non-consecutive numbering system for stops, so I'll need to figure that out first. The underlying KVG service supports querying different stops already, as long as their ID is known.

## Installation
As of now, the skill is not yet certified as critical features are missing. The only option to run it for yourself is to download a copy, host it on your machine and tell Amazon to query this machine using the Alexa skill builder. Installation is as simple as `git clone`, then `composer install` in the clone directory. Then use the skill builder to point the skill to your https endpoint. The Alexa endpoint is `stop/alexa` relative to your application URL.

## Live
Thanks to the magic of Heroku, you can try it out here: [https://alexakvg.herokuapp.com/web/stop/201/natural](Rankestraße). Json is here [https://alexakvg.herokuapp.com/web/stop/201/json](if you're not into the whole brevity thing)
 