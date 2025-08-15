$(window).on("load",()=> {
    if(document.querySelectorAll(".versionized")){
        document.querySelectorAll(".versionized").forEach((e) => {
            const attr = e.hasAttribute("src") ? "src" : e.hasAttribute("href") ? "href" : null;
            if (attr) {
                const original = e.getAttribute(attr);
                getVersion().then((version) => {
                    e.setAttribute(attr, `${original}?v=${version}`);
                });
            }
        });
    }
});

document.addEventListener("DOMContentLoaded",()=>{
    var images = document.querySelectorAll('.parallax-img');
    new simpleParallax(images, {
        scale: 1.5,
        delay: 1,
        transition: 'cubic-bezier(0,0,0,1)'
    });

    const url = "res/php/script.php?get-main-cards";
    const opc = {
        method: "GET",
        headers: {
            'Content-Type':'application/json'
        }
    }
    fetch(url,opc)
        .then(rsp => rsp.json())
        .then(res => {
            if(res.status == "success"){
                document.querySelector("#iniCards").innerHTML = res.cards;
            }
            else {
                document.querySelector("#iniCards").innerHTML = `<h3>No se ha podido obtener las tarjetas</h3>`;
            }
        })
    

    setTimeout(()=>{

        [
            '#samsungCards',
            '#xiaomiCards',
            '#honorCards',
            '#hyperosCards',
            '#icloudCards',
            '#unlocktoolCards'
        ].forEach(iniciarSlider);

        let inicards = tns({
            container: '#iniCards',
            items: 3,
            slideBy: 'page',
            mouseDrag: true,
            loop: true,
            autoplay: true,
            fixedWidth: 300,
            swipeAngle: false,
            nav: false,
            autoplayButtonOutput: false,
            controls: false,
            speed: 1000
        });

    },2000);

    
    window.closeModal = () =>{
        $('.modal-container').remove();
    }

    if(document.querySelector("#btWhatsapp")){
        document.querySelector("#btWhatsapp").addEventListener('click',()=>{
            Swal.fire({
                title: 'Contactenos por Whatsapp',
                html: `
                    <div class="ccard-container">
                        <div class="ws-head">
                            <div class="ws-logo"></div>
                            <div class="ws-text-container">
                                <h2>Iniciar una conversación</h2>
                                <span>
                                    !Hola, haga click el botón que corresponda a su región más cercana para contactar con nuestro equipo de soporte.
                                </span>
                            </div>
                        </div>
                        <span>Tiempo esperado de respuesta 10 minutos</span>
                        <button class="ws-button" onclick="go_to_ws('https://api.whatsapp.com/send?phone=573172127507&text=Hola%20a%20*Soporte%20Latino%20Am%C3%A9rica*')">
                            <img src="res/assets/images/ws-latam.webp" alt="ws-source"/>
                        </button>
                        <button class="ws-button" onclick="go_to_ws('https://api.whatsapp.com/send?phone=52990%20190%205618&text=Hola%20a%20*Soporte%20M%C3%A9xico*')">
                            <img src="res/assets/images/ws-mexico.webp" alt="ws-source"/>
                        </button>
                        <button class="ws-button" onclick="go_to_ws('https://api.whatsapp.com/send?phone=34627450100&text=Hola%20a%20*Soporte%20Spain*')">
                            <img src="res/assets/images/ws-espana.webp" alt="ws-source"/>
                        </button>
                    </div>
                `,
                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton: false
            });
        });
    }

    if(document.querySelector("#btTelegram")){
        document.querySelector("#btTelegram").addEventListener('click',()=>{
            Swal.fire({
                title: 'Contactenos por Telegram',
                html: `
                    <div class="ccard-container">
                        <div class="ws-head tg-head">
                            <div class="ws-logo telg"></div>
                            <div class="ws-text-container">
                                <h2>Iniciar una conversación</h2>
                                <span>
                                    !Hola, haga click el botón que corresponda a su región más cercana para contactar con nuestro equipo de soporte.
                                </span>
                            </div>
                        </div>
                        <span>Tiempo esperado de respuesta 10 minutos</span>
                        <button class="ws-button tgbtn" onclick="go_to_ws('https://api.whatsapp.com/send?phone=573172127507&text=Hola%20a%20*Soporte%20Latino%20Am%C3%A9rica*')">
                            <img src="res/assets/images/ws-latam.webp" alt="ws-source"/>
                        </button>
                    </div>
                `,
                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton: false
            });
        });
    }

    window.go_to_ws = (link) => {
        window.open(link);
    }

});

function set_video(source) {
    $('body').append(`
        <div class="modal-container">
            <span class="close-button" onclick="closeModal()"></span>
            <div class="plyr__video-embed" id="player">
                <iframe src="https://${source}" allowfullscreen allowtransparency allow="autoplay"></iframe>
            </div>
        </div>
    `);
}

function iniciarSlider(selector) {
    tns({
        container: selector,
        items: 4,
        autoplay: true,
        mouseDrag: true,
        fixedWidth: 300,
        nav: false,
        autoplayButtonOutput: false,
        controls: false,
        responsive: {
            600: {
                items: 2
            },
            900: {
                items: 3
            }
        }
    });
}

function gotosource(source){
    location.href = source;
}

async function getVersion() {
    try {
        const res = await fetch('res/php/values.php');
        if(!res.ok) throw new Error(`Error HTTP: ${res.status}`);
        const data = await res.json();
        return data.version;
    }
    catch {
        console.error(`Error en la solicitud Fetch ${error}`);
    }     
}

function get_source(brand,model){
    location.href = `brand/?brand=${brand}&model=${model}`;
}

function gotoseries(ref){
    location.href = `samsung/series/?ref=${ref}`;
}

function gotoitem(brand,model,ref){
    location.href = `item/?brand=${brand}&model=${model}&ref=${ref}`;
}