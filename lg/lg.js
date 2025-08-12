document.addEventListener('DOMContentLoaded',()=>{
    const eye = document.querySelector("#showhide");
    const lgform = document.querySelector("#lgform");

    eye.addEventListener('change',()=>{
        if(eye.checked){
            document.querySelector("#upass").setAttribute('type','text');
        }
        else {
            document.querySelector("#upass").setAttribute('type','password');
        }
    });

    lgform.addEventListener('submit',(e)=>{
        e.preventDefault();
        const urx = "../res/php/main.php?setLogin";
        const data = new FormData(lgform);
        fetch(urx,{
            method: "POST",
            body: data
        })
            .then(rps => rps.json())
            .then(rpa => {
                if(rpa.status == 'success'){
                    window.location.href = rpa.response;
                }
                else if(rpa.status == 'noExists'){
                    alert("Ha ocurrido un error: "+rpa.response);
                }
                else {
                    alert("Ha ocurrido un error: "+rpa.response);
                }
            })
    });

});