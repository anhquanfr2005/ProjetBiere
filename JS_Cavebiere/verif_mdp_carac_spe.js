function carac_mdp() {

    let mdp = document.getElementById("id_pass").value;
    let msg = document.getElementById("msge"); // ici on recupère l'objet en entier
    msg.innetHTML=""; // on vide le message
    var reg = /(?=.*[a-z])(?=.*[A-Z])(?=.*[@\$\&\%\#\!\?])/;
    var result = reg.test(mdp);

    var retour = false;

    if (result) {
        retour = true;
    } else{
        msg.innerHTML = "le mot de passe doit contenir au moins une lettre minuscule et un caractère spécial tel que : <strong> @, #, $, %, !, ? ou & </strong>";
        retour = false;
    }

    
    return retour;
    
}

function togglePasswordVisibility() {
    var mdp = document.getElementById("id_pass");
    if (mdp.type === "password") {
        mdp.type = "text";
    } else {
        mdp.type = "password";
    }
}



/*****************************************************************/
function listeFiltreUtilisateurs(typeB) {
    var req_AJAX = null;
    if (window.XMLHttpRequest) {
        req_AJAX = new XMLHttpRequest();
    }
    if (req_AJAX) {
        req_AJAX.onreadystatechange = function () {
            TraiteListeFiltreUtilisateurs(req_AJAX);
        };
        req_AJAX.open("POST", "listefiltrebiere.php", true);
        req_AJAX.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        req_AJAX.send("typeB=" + typeB.value);
    }
    else {
        alert("EnvoiRequete: pas de XMLHTTP !");
    }
}

function TraiteListeFiltreUtilisateurs(requete) {
    document.getElementById("recherche").innerHTML = "";
    if (requete.readyState == 4 && requete.status == 200) {
        document.getElementById('recherche').innerHTML = requete.responseText;
    }
}

function inse(action){
    var req_AJAX = null;
    var action = action;
    var biere = document.getElementById("id_biere");
    var qte = document.getElementById("id_quant");
    var pays = document.getElementById("pays");
    var prix = document.getElementById("prix");
    var typebiere = document.getElementById("typebiere");
    var cap = document.getElementById("cap");
    
    setTimeout(function (){
        var captchaImage = document.getElementById('captchaImage');
        captchaImage.src = 'captchaimg.php?' + Math.random();
    }, 100); // 10000 millisecondes = 0.1 secondes
    
    setTimeout(function (){
        document.getElementById("message").innerHTML = "";
    }, 10000); // 10000 millisecondes = 10 secondes

    if (window.XMLHttpRequest) {
        req_AJAX = new XMLHttpRequest();
    }
    if (req_AJAX) {
        req_AJAX.onreadystatechange = function () {
            TraiteListeFiltreUtilisateursV2(req_AJAX);
        };
        req_AJAX.open("POST", "fonction.php", true);
        req_AJAX.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        req_AJAX.send("biere=" + biere.value + "&qte=" + qte.value +
            "&action=" + action.value + "&cap=" + cap.value
            + "&pays=" + pays.value + "&prix=" + prix.value + "&typebiere=" + typebiere.value);
    }
    else {
        alert("EnvoiRequete: pas de XMLHTTP !");
    }
}
function TraiteListeFiltreUtilisateursV2(requete) {
    document.getElementById("message").innerHTML = "";
    if (requete.readyState == 4 && requete.status == 200) {
        document.getElementById('message').innerHTML = requete.responseText;
    }
}

function suppr(action){
    var req_AJAX = null;
    var action = action;
    var supprbiere = document.getElementById("id_stock");
    var cap = document.getElementById("capa");
    
    
    if (window.XMLHttpRequest) {
        req_AJAX = new XMLHttpRequest();
    }
    if (req_AJAX) {
        req_AJAX.onreadystatechange = function () {
            TraiteListeFiltreUtilisateursV3(req_AJAX);
        };
        req_AJAX.open("POST", "fonction.php", true);
        req_AJAX.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        req_AJAX.send("supprbiere=" + supprbiere.value + "&action=" + action.value + "&cap=" + cap.value);
    }
    else {
        alert("EnvoiRequete: pas de XMLHTTP !");
    }
}
function TraiteListeFiltreUtilisateursV3(requete) {
    document.getElementById("message").innerHTML = "";
    
    if (requete.readyState == 4 && requete.status == 200) {
        document.getElementById('message').innerHTML = requete.responseText;
        setTimeout(function (){
            document.getElementById("message").innerHTML = "";
        }, 8000); // 10000 millisecondes = 8 secondes
    }
}

setInterval(function (){
    var captchaImage = document.getElementById('captch');
    captchaImage.src = 'captchaimg.php?' + Math.random();
}, 8000); // 10000 millisecondes = 8 secondes