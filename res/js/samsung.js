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

    document.querySelectorAll('.video-sources').forEach((e)=>{
        e.addEventListener("click",()=>{
            $('body').append(`
                <div class="modal-container">
                    <span class="close-button" onclick="closeModal()"></span>
                    <div class="plyr__video-embed" id="player">
                        <iframe
                            src="https://www.youtube.com/embed/bTqVqk7FSmY?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                            allowfullscreen
                            allowtransparency
                            allow="autoplay"
                        ></iframe>
                    </div>
                </div>
            `);
        })
    })
    window.closeModal = () =>{
        $('.modal-container').remove();
    }

});

async function getVersion() {
    try {
        const res = await fetch('../res/php/values.php');
        if(!res.ok) throw new Error(`Error HTTP: ${res.status}`);
        const data = await res.json();
        return data.version;
    }
    catch {
        console.error(`Error en la solicitud Fetch ${error}`);
    }     
}

function gotosource(source){
    location.href = source;
}
