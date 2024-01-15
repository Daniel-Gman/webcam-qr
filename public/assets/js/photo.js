function refreshPage() {
    window.location.reload();
};

const count = document.getElementById("time")
const width = 640, height = 480,
    canvas = document.getElementById("canvas");

ctx = canvas.getContext('2d');


let video = null, isSetup = false;

Setup();
function Setup() {
    if (!isSetup) {
        canvas.width = width;
        canvas.height = height;
        ////
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;
        ////
        canvas.style.backgroundColor = 'rgba(255, 255, 255, 0.49)';

        const video = document.getElementById('camera');
        const button = document.getElementById('make__foto')
        button.addEventListener("click", takePhoto);


        let timer;

        document.body.onkeyup = function (e) {
            if (e.key == "Space" || e.key == "" || e.code == "Space" || e.keyCode == 32) {
                startTimer();
            }
            function startTimer() {
                console.log('Timer started: 3 seconds');

                clearTimeout(timer);
                count.style.display = 'flex';

                let countdown = 3;

                function updateCountdown() {
                    count.innerHTML = countdown;
                    countdown--;

                    if (countdown >= 0) {
                        timer = setTimeout(updateCountdown, 1000);
                    } else {
                        console.log('Timer expired! Taking photo...');
                        takePhoto(e);
                        count.innerHTML = 'Cheese!';
                        count.style.fontSize = "18rem";
                        setTimeout(() => {
                            count.style.opacity = 0;
                        }, 1000)
                    }
                }
                count.style.opacity = 1;
                updateCountdown();
            }
        }

        navigator.mediaDevices
            .getUserMedia({ video: true, audio: false })
            .then((stream) => {
                video.srcObject = stream;
                video.play();
            }).catch((err) => {
                console.error(`Error obtaining video stream:\n ${err}`);
            });

        isSetup != isSetup;
    }
}
////
const title = document.getElementById("h2");
const imgdownload = document.getElementById("qrIMG");
const qrcodeContainer = document.getElementById("qrcode");
let qrcode = 0;

function takePhoto(e) {
    e.preventDefault();
    ctx.drawImage(video, 0, 0, width, height);
    video.style.opacity = "0";
    title.innerHTML = "Scan qr for Download!";
    title.style.fontSize = "4rem";
    imageDataBase64 = canvas.toDataURL("image/png", 0.8);
    console.log("imageDataBase64:", imageDataBase64);

    const xhr = new XMLHttpRequest();
    let fname;
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
            fname = xhr.response;

            console.log(`Bestandsnaam is ${fname}`);

            let url = `https://34882.hosts1.ma-cloud.nl/public/main.php?fname=${fname}`;

            if (qrcode != 0) {
                qrcode.clear();
                qrcode.makeCode(url);
            } else {
                qrcode = new QRCode(qrcodeContainer, {
                    text: url,
                });
            }
        }
    };

    xhr.open("POST", "save.php");
    xhr.send(JSON.stringify({
        base64: imageDataBase64
    }));
}