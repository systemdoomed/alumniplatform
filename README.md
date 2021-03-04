# alumniplattform
1. Installation

Eine Alumni-Plattform der ehemalige Studenten der Berufsakademie Leipzig. Diese soll die Kommunikation untereinander ermöglichen und Kontaktdaten bereitstellen. 

Anmeldedaten an der Datenbank sind über die dbh.php.inc Datei im Ordner/php/includes anzupassen.

Die Anwendung selbst läuft Webbasiert.

Um die Anwendung zum laufen zu bekommen benötigt es eine MySQL- Datenbank genannt AlumniDatenbank.

Getestet ist diese Datenbank mit dem Programm XAMPP.

Diese bietet sowohl die Anbindung einer Datenbank als auch den Webserver.

Zunächst die XAMPP Oberfläche öffnen und die Dienste MySQL Database und Apache Web Server starten.

Dann die Datenbank Oberfläche mittels diesem Link aufrufen http://localhost/phpmyadmin/.

Nun die Datenbank erstellen und die SQL Dateien aus dem Repository importieren in diese Datenbank.

Im Ordner XAMPP->xamppfiles->->htdocs->php Die php-Dateien aus dem git mit dieser Dateistruktur kopieren.

2. Nutzung

Um nun die Webanwendung zu starten, localhost/index.php eingeben.

Ein Standarduser mit Administratorrechten auf der Website ist:

Email: root@root.de Passwort:root 

Diese ist im Login Bereich einzugeben.

Hiermit kann ein registrierter Benutzer unter Kontakte verifiziert werden.

Als Mitarbeiter ist die Seminargruppe BA das Abschlussjahr mit 0000 zu füllen.

Außerdem kann sich ein Nutzer im Registrierungsmenü registrieren.

Nachdem der Nutzer vom Administrator verifiziert wurde (Kontakt Menü) kann der Nutzer sich einloggen.

Damit hat er Zugriff zu den Daten seiner Kommilitonen die die selbe Studienrichtung und Abschlussjahr haben.

Es lässt sich auch darin suchen.
