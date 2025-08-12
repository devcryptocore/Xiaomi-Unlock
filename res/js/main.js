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