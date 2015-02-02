# createdbfiles
ZF2 Modul - Es wird ein Datensatz aus der angegebenen Tabelle gelesen und anhand der Keys die entsprechenden Dateien für das Model Verzeichnis erstellt.

# Installation
* Im Module Verzeichnis ein neues Verzeichnis mit dem Namen Createdevdbfiles erstellen
* Dateien in das Verzeichnis Createdevdbfiles kopieren
* application.config.php anpassen

# application.config.php
```
return array(
  'modules' => array(
    'Application',
    'Createdevdbfiles',
    ....
),
```
# Ausführen
http://[meineprojekturl]/createdevdbfiles