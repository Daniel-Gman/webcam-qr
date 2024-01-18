# webcam-qr

# Hoe werkt dit project:

```
inhoud: 
1. Javascript Foto omzetten in base64 Binaire data
2. Base64 POST naar Save.php
3. Base64 binaire data omzetten in bin2hex(random_bytes(64)) . ".png"
4. Filenaam naar console pushen
5. Filenaam in qr krijgen
6. QR foto download optie
7. Filename string stuurt naar database
```

**1. Javascript foto omzetten in base64 Binaire data**

er word in Javascript een foto gemaakt doormiddel van: 
```
const video = document.getElementById('camera');
const button = document.getElementById('make__foto')
button.addEventListener("click", takePhoto);

<video id="camera"></video>
<section id="qrcode"></section>
<canvas id="canvas"></canvas>
 ```

**2. Base64 POST naar Save.php**

De foto word gemaakt doormiddel van ``` ctx.drawImage ```
de foto word met ```imageDataBase64 = canvas.toDataURL("image/png", 0.8); ``` omgezet in base64. de console logt de base64 binaire data en krijgt een GIGANTISH grote string met .png erachter.

**3. Base64  binaire data omzetten in bin2hex(random_bytes(64)) . ".png**

De foto word van binaire data omgezet naar een random hexcode met 64 characters. dat doet het doormiddel van ```$filename = bin2hex(random_bytes(64)) . ".png";```. deze 64 character string zal de filenaam worden en zal zo genoteerd worden in de database.

**4. Filenaam naar console pushen**

Deze stap is nogal simpel. ```$filename```zal naar de console gestuurd worden met ```console.log(`Bestandsnaam is ${fname}`);```. de foto in de bestandsnaam in de console zal ook gelijk in de DB staan.

**5. Filenaam in QR krijgen**

QR word opgeroepen via een publieke JSqr library. het is een oude library die al jaren niet geupdate is dus het is gelimiteerd met wat je kan doen. de data van de qr word bepaald met wat de text erin is. in mijn geval heb ik de qr geconnect met de link naar mijn main.php en heeft naast de URL Fname=.... staan. ```let url = `https://34882.hosts1.ma-cloud.nl/public/main.php?fname=${fname}`;```

**6 QR foto download optie**

De foto word opgehaald uit de folder waar de foto met Fname heen word gestuurd nadat het gemaakt is met javascript. ```$fullpath = "../source/uploads/" . $_GET["fname"];```. 
de foto display je op scherm met:
```
<img src="<?=$fullpath?>">
<br>
<a href="<?=$fullpath?>"download><button><p>Download foto!</p></button></a>
```
de href is de $fullpath die je hebt gemaakt met de file naam van Fname.

**7. Filename string stuurt naar database**

de foto die is gemaakt word omgezet in Fname en word naar de database gestuurd. 
de tabel heeft een collumn genaamd fname

```
$query = "INSERT INTO saves (fname) VALUES ('$filename')";
$result = $conn->query($query);
```
Alle fotos die gemaakt worden kan ik zien in mijn DB en word opgeslagen met ID en Fname.

*Einde documentatie*
