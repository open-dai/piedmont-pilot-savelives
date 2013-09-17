piedmont-pilot-savelives
========================
This is the repository of the pilot from Open-DAI european funded project (http://www.open-dai-eu)

Here you can find all that is needed to reproduce the pilot.

The pilot is composed of a web site developed using the YII framework that allows users to register and customize the flow that will get executed as a consequence of the usage of the smartphone application.
The flow is represented as an XML file that gets edited in the web application.
The user also gets the code to place in the smartphone to activate it.

The smarthpone will call a REST application that will in turn execute a business process in WSO2 BPS.
The process will use different services to send mail and save accident data.

The DB for the accident data is a virtualized DB deployed in TEIID.

