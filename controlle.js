function verif(){
    let np=document.getElementById("np").value;
    let num=document.getElementById("num").value;
    let f=document.getElementById("femme").checked;
    let h=document.getElementById("homme").checked;

    if(np.indexOf(" ")==-1 || !alpha(np)){
        alert("SVP verfier votre nom et prénom");
        return false;
    }
    if(num.length!=8){
        alert("SVP verfier votre numéro de téléphone");
        return false;
    }
    if(!f && !h){
        alert("SVP seléctioner votre genre");
        return false;
    }
}
function alpha(ch) {
    ch=ch.toUpperCase()
    for (let i = 0; i < ch.length; i++) {
        if ((ch[i] < "A" || ch[i] > "Z" )&& ch[i]!=" ") {
            return false;
        }
    }
    return true
}