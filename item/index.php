<?php
    if(isset($_GET['brand'])){
        $marca = $_GET['brand'];
        $ref = $_GET['ref'];
        $modelo = $_GET['model'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../res/assets/images/logoxiaomiunlock.webp" type="image/x-icon">
    <link rel="stylesheet" href="../res/css/style.css" class="versionized">
    <link rel="stylesheet" href="../res/css/sections.css" class="versionized">
    <link rel="stylesheet" href="../res/css/animations.css" class="versionized">
    <script src="../res/js/jquery.min.js"></script>
    <script src="../res/js/samsung.js?version=1.0.11"></script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <script type="module" src="../res/js/simpleParallax.min.js"></script>
    <link rel="stylesheet" href="../res/css/tinyslider.css">
    <script src="../res/js/tinyslider.js"></script>
</head>
<style>
    #userform {
        max-width: 400px;
        width: 50%;
        margin: 20px auto;
        padding: 20px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.08);
        font-family: 'Segoe UI', sans-serif;
    }
    .nimput {
        position: relative;
        margin-bottom: 20px;
    }
    .nimput input[type="tel"],
    .nimput input[type="text"] {
        width: 100%;
        padding: 12px 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        outline: none;
        transition: 0.3s;
        background: #f9f9f9;
    }
    .nimput input[type="tel"]:focus,
    .nimput input[type="text"]:focus {
        border-color: #0078ff;
        box-shadow: 0px 0px 5px rgba(0, 120, 255, 0.3);
        background: #fff;
    }
    .nimput label {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #777;
        font-size: 14px;
        pointer-events: none;
        transition: 0.3s ease;
        background: white;
        padding: 0 4px;
    }
    .nimput input:focus + label,
    .nimput input:not(:placeholder-shown) + label {
        top: -8px;
        font-size: 12px;
        color: #0078ff;
    }
    #userform input[type="submit"] {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #0078ff, #0056d2);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s ease;
    }
    #userform input[type="submit"]:hover {
        background: linear-gradient(135deg, #0056d2, #003e99);
    }
    .nimtext {
        height: 80px;
    }
    .nimtext p {
        font-size: 16px;
    }
    @media screen and (max-width: 800px) {
        #userform {
            width: 100%;
        }
    }
</style>
<body>
    <main class="main-container">
        <div class="navbar">
            <img id="lgo" src="../res/assets/images/samsung_icon.svg" alt="Logo Samsung">
            <h1 id="ttl">Series A1-FRP</h1>
        </div>
        <section class="section-contain" id="scontainer"></section>
        <section class="section mark-section">
            <img src="../res/assets/images/<?=$marca;?>.svg" alt="Samsung Icon">
            <h2>Testimonios <?=$marca." ".$ref;?></h2>
        </section>
        <section class="section-contain">
            <div class="sub-video-cont">
                <div class="video-sources especial-video"></div>
                <div class="video-sources especial-video"></div>
            </div>
            <div class="sub-video-cont"> 
                <div class="video-sources especial-video"></div>
                <div class="video-sources especial-video"></div>
            </div>
        </section>
    </main>
    <script>
        (()=>{
            let brand = '<?=$marca;?>';
            let model = '<?=$ref;?>';
            const cons = "../admin/upload.php?getItem";
            const dt = new FormData();
            dt.append("modelo",model);
            fetch(cons,{
                method: "POST",
                body: dt
            })
                .then(rr => rr.json())
                .then(rps => {console.log(rps)
                    if(rps.status == 'success'){
                        document.querySelector("#lgo").setAttribute("src",`../res/assets/images/${brand}_icon.svg`);
                        document.querySelector("#ttl").innerText = `${model}`;
                        document.querySelector("#scontainer").innerHTML = rps.tarjetas;
                    }
                })
        })();
        setTimeout(()=>{
            if(document.querySelector("#userform")){
                document.querySelector("#userform").addEventListener("submit", (e) => {
                    e.preventDefault();
                    const form = document.querySelector("#userform");
                    const ury = "../admin/upload.php?solicitar_desbloqueo";
                    const formData = new FormData(form);
                    let camposVacios = [];
                    form.querySelectorAll("[required]").forEach(input => {
                        if (!input.value.trim()) {
                            camposVacios.push(input.name);
                        }
                    });
                    if (camposVacios.length > 0) {
                        alert("Por favor, completa los campos: " + camposVacios.join(", "));
                        return;
                    }
                    fetch(ury,{
                        method: "POST",
                        body: formData
                    })
                        .then(rss => rss.json())
                        .then(rpa => {
                            if(rpa.status == "success"){
                                location.href = rpa.enlace;
                            }
                        })
                    
                });
            }
        },1000);

    </script>
</body>
</html>
<?php
    }
    else {
        header("Location: ../");
    }
?>