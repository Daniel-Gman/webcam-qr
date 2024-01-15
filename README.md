# webcam-qr

# Hoe werkt dit project:

```
inhoud: 
1. Javascript Foto omzetten in base64 Binaire data
2. Base64 POST naar Save.php
3. Base64 binaire data omzetten in bin2hex(random_bytes(64)) . ".png
4. Filenaam naar console pushen
5. Filenaam in qr krijgen
6. QR redirect naar nieuwe pagina en download optie
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

