
let cookie = document.getElementById("cookie");
console.log(cookie, "test");

let btnOne = document.getElementById("btnOne");
console.log(btnOne, "btn one");

let btnTwo = document.getElementById("btnTwo");
console.log(btnTwo, "test3");

let btnThree = document.getElementById("btnThree");
console.log(btnThree, "test3");

btnOne.addEventListener("click", function(){
    cookie.style.display = "none";
})

btnTwo.onclick = function(){
    window.location.href = "https://www.google.com/";
}

btnThree.onclick = function(){
    alert("Votre cookie est maintenant désactivé.");
}


/******************************** */


let droiteLogin = document.getElementById("droitelogin");
//console.log(droiteLogin, "droite login test");

let formulaire = document.getElementById("formulaire");
//console.log(formulaire,"formulaire");

droiteLogin.addEventListener("click", function(){
    //e.preventDefault();
    //console.log("test add event");
    if(formulaire.style.display == "block"){
        formulaire.style.display = "none";
        formulaire.style.animation = 'animate__fadeInBottomRight';
        formulaire.style.animationDuration = '1s';
        formulaire.style.margin = '0 0.5rem';

    }else{

        formulaire.style.display = "block";
        formulaire.style.animation = 'animate__fadeInBottomRight';
        formulaire.style.animationDuration = '1s';
        formulaire.style.margin = '0 0.5rem';

    }
})


/***JOKER CIBLE***************************** */

