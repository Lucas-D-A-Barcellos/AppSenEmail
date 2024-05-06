document.getElementById("formulario").addEventListener("submit", function(event) {
    // Pega os valores dos campos do formulário
    var para = document.getElementById("para").value;
    var assunto = document.getElementById("assunto").value;
    var mensagem = document.getElementById("mensagem").value;

    // Validação simples dos campos
    if (para === "" || assunto === "" || mensagem ==="") {
        // Se algum campo estiver vazio, evita o envio do formulário
        event.preventDefault();
        alert("Por favor, preencha todos os campos.");
    } else {
        
    }
});
