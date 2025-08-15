<?php
    if(isset($_GET['brand'])){
        $marca = $_GET['brand'];
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
<body>
    <main class="main-container">
        <div class="navbar">
            <img id="lgo" src="../res/assets/images/samsung_icon.svg" alt="Logo Samsung">
            <h1 id="ttl">Series A1-FRP</h1>
        </div>
        <section class="section samsungarea" id="samsung">
            <img src="../res/assets/images/principalbg/seriessbanner.png" class="parallax-img" alt="Imagen con parallax" style="max-width: 100%;">
        </section>
        <section class="section-contain" id="scontainer"></section>
        <section class="section mark-section">
            <img src="../res/assets/images/<?=$marca;?>.svg" alt="Samsung Icon">
            <h2><?=$marca;?> Videos</h2>
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
            let model = '<?=$modelo;?>';
            const cons = "../admin/upload.php?getBrandModel";
            const dt = new FormData();
            dt.append("brand",brand);
            dt.append("model",model);
            fetch(cons,{
                method: "POST",
                body: dt
            })
                .then(rr => rr.json())
                .then(rps => {console.log(rps)
                    if(rps.status == 'success'){
                        document.querySelector("#lgo").setAttribute("src",`../res/assets/images/${brand}_icon.svg`);
                        document.querySelector("#ttl").innerText = rps.title;
                        document.querySelector("#scontainer").innerHTML = rps.tarjetas;
                    }
                })
        })();
    </script>
</body>
</html>
<?php
    }
    else {
        header("Location: ../");
    }
?>