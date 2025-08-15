<?php
    date_default_timezone_set('America/Bogota');
    $accode = date('Ymd');
    if(isset($_GET['adminaccess']) && $_GET['adminaccess'] === $accode."_admin"){
        $v = time();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario Responsive</title>
<link rel="stylesheet" href="../res/css/sweetAlert.css">
<script src="../res/js/sweetAlert.js"></script>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .container {
        background: #ffffffff;
        padding: 20px;
        width: 100%;
        height: 100vh;
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        position: fixed;
        z-index: 888;
        top: 0;
        left: 0;
    }
    .closex,
    .closexx {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        border-radius: 50%;
        border: 1px solid #ff0044ff;
        color: #ff0044ff;
        background: #ff004456;
        position: absolute;
        top: 35px;
        left: 35px;
        cursor: pointer;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 400px;
        margin: 0 auto;
    }
    select, input[type="text"], button {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }
    /* Estilo file input */
    .file-label {
        display: inline-block;
        padding: 10px;
        background: #007bff;
        color: white;
        border-radius: 6px;
        cursor: pointer;
        text-align: center;
    }
    .file-label:hover {
        background: #0056b3;
    }
    #file-preview,
    #file-previeww {
        max-width: 100%;
        max-height: 150px;
        object-fit: contain;
        margin-top: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        display: none;
    }
    .radio-group {
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .radio-group label {
        font-size: 14px;
    }
    button {
        background: #28a745;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }
    button:hover {
        background: #218838;
    }
    #newtarj,
    #showorders {
        width: 30px;
        height: 30px;
        position: absolute;
        top: 20px;
        right: 20px;
        border: 2px solid #3f3f3fff;
        border-radius: 8px;
        cursor: pointer;
        color: #3f3f3fff;
        font-size: 14px;
        font-weight: 600;
        background: #f6cd00ff;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #showorders {
        right: 60px;
        background: #eee url(../res/assets/images/user.svg) center / 20px no-repeat;
    }
    .tarjlist {
        width: 100%;
        height: 90%;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 80px 10px 0 10px;
    }
    .thumbtarj {
        max-width: 40px;
        cursor: pointer;
        position: relative;
    }
    .thumbtarj:hover {
        position: fixed;
        max-width: 40%;
        right: 50px;
        top: 25%;
        z-index: 887;
    }
    #the_table {
        width: 100%;
        border-collapse: collapse;
    }
    #the_table tbody tr:nth-of-type(even){
        background: #b8b8b8ff;
    }
    #the_table tbody tr td {
        text-align: center;
    }
    #mod,#del {
        width: 30px;
        aspect-ratio: 1/1;
        background: #eee url(../res/assets/images/edit.svg) center / 20px no-repeat;
        border-radius: 5px;
        cursor: pointer;
        margin: 10px;
    }
    #del {
        background: #eee url(../res/assets/images/delete.svg) center / 20px no-repeat;
    }
    #mdl,
    #orderstb {
        width: 100%;
        height: 100%;
        display: flex;
        position: fixed;
        z-index: 998;
        background: #fff;
        top: 0;
        left: 0;
    }
</style>
</head>
<body>
    <button id="showorders"></button>
    <button id="newtarj">+</button>
    <div class="tarjlist">
        <table id="the_table">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Referencia</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                    <th>Tarjeta</th>
                    <th>Ops.</th>
                </tr>
            </thead>
            <tbody id="data-table"></tbody>
        </table>
    </div>
    <div class="container">
        <span class="closex">X</span>
        <h2>Registro de equipos</h2>
        <form id="myForm" enctype="multipart/form-data">
            <!-- Select -->
            <select name="marca" id="marca" required>
                <option value="">Seleccione marca</option>
                <option value="samsung">Samsung</option>
                <option value="xiaomi">Xiaomi</option>
                <option value="honor">Honor</option>
                <option value="hyperos">Hyper OS</option>
                <option value="ios">IOS</option>
                <option value="unlocktool">Unlock Tool</option>
            </select>
            <input type="text" name="referencia" id="referencia" placeholder="Referencia" required>
            <!-- Modelo -->
            <input type="text" name="modelo" id="modelo" placeholder="Modelo" required>

            <!-- Imagen -->
            <input type="file" id="imagen" name="imagen" accept=".webp,.png" hidden required>
            <label for="imagen" class="file-label">Seleccionar imagen</label>
            <img id="file-preview" alt="Vista previa">

            <!-- Estado -->
            <div class="radio-group">
                <label><input type="radio" name="estado" value="activo" required> Activo</label>
                <label><input type="radio" name="estado" value="inactivo" required> Inactivo</label>
            </div>

            <!-- Botón -->
            <button type="submit">Enviar</button>
        </form>
    </div>

<script>
document.querySelector("#newtarj").addEventListener('click',()=>{
    document.querySelector('.container').style.display = "flex";
});

document.querySelector(".closex").addEventListener('click',()=>{
    document.querySelector('.container').style.display = "none";
});

(()=>{
    const uris = "upload.php?get_tarjs";
    const ops = {
        method: "GET",
        headers: {
            'Content-Type':'application/json'
        }
    }
    fetch(uris,ops)
        .then(rps => rps.json())
        .then(rpa => {
            document.querySelector("#data-table").innerHTML = rpa.response;
            const table = document.querySelector("#the_table");
            if (!table) return;
            let lastMarca = null;
            let rows = Array.from(table.querySelectorAll("tbody tr"));
            for (let i = 0; i < rows.length; i++) {
                let marca = rows[i].querySelector("td").textContent.trim();
                if (lastMarca !== null && marca !== lastMarca) {
                    // Crear fila especial
                    let specialRow = document.createElement("tr");
                    specialRow.innerHTML = `<td colspan="${rows[i].cells.length}" style="background:#03A9F4;font-weight:bold;text-align:center;">
                        Fin de ${lastMarca}
                    </td>`;
                    rows[i].parentNode.insertBefore(specialRow, rows[i]);
                    rows = Array.from(table.querySelectorAll("tbody tr"));
                    i++; // saltar la fila insertada
                }
                lastMarca = marca;
            }
            if (lastMarca !== null) {
                let specialRow = document.createElement("tr");
                specialRow.innerHTML = `<td colspan="${rows[0].cells.length}" style="background:#03A9F4;font-weight:bold;text-align:center;">
                    Fin de ${lastMarca}
                </td>`;
                table.querySelector("tbody").appendChild(specialRow);
            }
        })
})();

document.getElementById('imagen').addEventListener('change', function() {
    const file = this.files[0];
    const preview = document.getElementById('file-preview');

    if (file) {
        if (!['image/webp', 'image/png'].includes(file.type)) {
            alert("Solo se permiten imágenes WEBP o PNG");
            this.value = "";
            preview.style.display = "none";
            return;
        }
        if (file.size > 500 * 1024) {
            alert("La imagen no puede superar los 500KB");
            this.value = "";
            preview.style.display = "none";
            return;
        }
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = "none";
    }
});

document.getElementById('myForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('upload.php?new_resource', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        Swal.fire({
            title: "Correcto!",
            text: data.message,
            icon: "success"
        });
        if (data.ok) {
            this.reset();
            document.getElementById('file-preview').style.display = "none";
        }
    })
});

function modcard(id){
    const mdl = document.createElement('div');
    mdl.id = "mdl";
    document.body.appendChild(mdl);
    const ur = "upload.php?modifyCard";
    const dt = new FormData();
    dt.append("id",id);
    fetch(ur,{
        method: "POST",
        body:dt
    })
        .then(rps => rps.text())
        .then(rr => {
            document.querySelector('#mdl').innerHTML = rr;
            document.getElementById('imagenx').addEventListener('change', function() {
                const file = this.files[0];
                const preview = document.getElementById('file-previeww');

                if (file) {
                    if (!['image/webp', 'image/png'].includes(file.type)) {
                        alert("Solo se permiten imágenes WEBP o PNG");
                        this.value = "";
                        preview.style.display = "none";
                        return;
                    }
                    if (file.size > 500 * 1024) {
                        alert("La imagen no puede superar los 500KB");
                        this.value = "";
                        preview.style.display = "none";
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = e => {
                        preview.setAttribute('src',e.target.result);
                        preview.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.style.display = "none";
                }
            });
            document.querySelector("#myModForm").addEventListener('submit',(x)=>{
                x.preventDefault();
                const fmr = document.querySelector("#myModForm");
                const uu = "upload.php?mod_resource";
                const dat = new FormData(fmr);
                fetch(uu,{
                    method: "POST",
                    body: dat
                })
                    .then(rpx => rpx.json())
                    .then(rrr => {console.log(rrr)
                        if(rrr.ok){
                            Swal.fire({
                                title: "Correcto",
                                text: "Se ha modificado el ítem",
                                icon: "success"
                            }).then(()=>{
                                location.reload();
                            });
                        }
                        else {
                            Swal.fire({
                                title: "Error",
                                text: "No se ha podido modificar el ítem",
                                icon: "error"
                            })
                        }
                    })
            })
            document.querySelector('.closexx').addEventListener('click',()=>{
                document.querySelector("#mdl").remove();
            });
        })
      
}
function delcard(id){
    Swal.fire({
        title: "Eliminar ítem",
        text: "Está seguro de eliminar este ítem, esta operación no se puede deshacer",
        icon: "question",
        showConfirmButton: true,
        confirmButtonText: "Si, Eliminar",
        confirmButtonColor: "#e91e63" 
    }).then((cnf)=>{
        if(cnf.isConfirmed){
            const us = "upload.php?deltar";
            const ih = new FormData();
            ih.append("id",id);
            fetch(us,{
                method: "POST",
                body: ih
            })
                .then(t => t.text())
                .then(y => {
                    if(y == 1){
                        Swal.fire({
                            title: "Correcto",
                            text: "Se ha eliminado el ítem",
                            icon: "success"
                        }).then(()=>{
                            location.reload();
                        });
                    }
                    else {
                        Swal.fire({
                            title: "Error",
                            text: "No se ha podido eliminar el ítem",
                            icon: "error"
                        })
                    }
                })
        }
    });
}

document.querySelector("#showorders").addEventListener('click',()=>{
    const uo = "upload.php?getOrders";
    const gt = {
        method: "GET",
        headers: {
            'Content-Type':'plain/text'
        }
    }
    fetch(uo,gt)
        .then(st => st.text())
        .then(rt => {
            if(rt != 0){
                const ct = document.createElement('div');
                ct.id = "orderstb";
                document.body.append(ct);
                document.querySelector("#orderstb").innerHTML = `
                    <table>
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Imei/Unlock Code</th>
                                <th>Teléfono</th>
                                <th>Tipo</th>
                                <th>Fecha entrada</th>
                                <th>Fecha respuesta</th>
                                <th>Estado</th>
                                <th>Código</th>
                            </tr>
                        </thead>
                        <tbody>${rt}</tbody>
                    </table>
                `;
            }
        })
});

</script>
</body>
</html>
<?php
    }
    else {
        header("Location: ../");
    }
?>