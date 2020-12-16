---
title: "Dokumentation"
---
API-dokumentation
=========================

### 1. IP-validering med geografisk position

På sidan [Ip-adresser](http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ip) finns möjlighet att validera IP-adresser och få fram dess geografiska position (koordinater, stad, land). Båda formulären kan användas direkt på sidan, det understa kommer att presentera svaret i JSON-format i webbläsaren. Ett alternativt sätt är att anropa JSON-API:t direkt i URL:en.

<b>Exempel</b> (sökning på t.ex. ip-adressen 8.8.8.8):<br><br>
...htdocs/ipApi/validateIpApi?ipAdress=8.8.8.8<br>
...htdocs/ipApi/validateIpApi?ipAdress=1.2.3<br>
...htdocs/ipApi/validateIpApi?ipAdress=193.150.214.141


<b>Testa</b>

<!-- alt lägg in länkar istället -->

<form action="ipApi/validateIpApi">
    ...ipApi/validateIpApi?ipAdress=
    <input type="submit" name="ipAdress" value="8.8.8.8" style="background-color:#62c25d;">
    <input type="submit" name="ipAdress" value="193.150.214.141" style="background-color:#62c25d;">
    <input type="submit" name="ipAdress" value="1.2.3" style="background-color:#f76765;"><br>
</form>
<br>

### 2. Väderprognos eller -historik för geografisk position

På sidan [Väder](http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weather) kan du söka på en ip-adress eller koordinater för att få fram väderprognos eller väderhistorik och karta över platsen. För att få samma data-resultat i JSON-format anropar du REST-API:t i URL:en på följande vis:

<h4>--> Exempel för 7-dagarsprognos (&type=coming)</h4>

<b>Ip-adresser: 8.8.8.8 (Mountain View) och 193.150.214.141 (Malmö)</b><br>

...htdocs/weatherApi/search?location=
<a href="http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherApi/search?location=8.8.8.8&type=coming" style="color:#62c25d;font-size:20px;">8.8.8.8</a> &type=coming<br>
...htdocs/weatherApi/search?location=
<a href="http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherApi/search?location=193.150.214.141&type=coming" style="color:#62c25d;font-size:20px;">193.150.214.141</a>
&type=coming<br>

<h4>--> Exempel för 5-dagarshistorik (&type=past)</h4>

<b>Koordinater: 59.40,13.51 (Karlstad) och 52.52,13.41 (Berlin)</b><br>

...htdocs/weatherApi/search?location=
<a href="http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherApi/search?location=59.40,13.51&type=past" style="color:#62c25d;font-size:20px;">59.40,13.51</a> &type=past<br>
...htdocs/weatherApi/search?location=
<a href="http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherApi/search?location=52.52,13.41&type=past" style="color:#62c25d;font-size:20px;">52.52,13.41</a>
&type=past<br>
