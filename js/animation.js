function abrir_historico(botaoclicado){
    historico = document.getElementById("divhistorico");
    historico.style.margin = "20px 0px 20px 15px";
    
    botaoclicado.style.zIndex = 1;
    botaoescondido = document.getElementById("fecharhistorico");
    botaoescondido.style.zIndex = 2;
}
function fechar_historico(botaoclicado){
    historico = document.getElementById("divhistorico");
    historico.style.margin = "20px 0 20px -250px";

    botaoclicado.style.zIndex = 1;
    botaoescondido = document.getElementById("verhistorico");
    botaoescondido.style.zIndex = 2;
}
