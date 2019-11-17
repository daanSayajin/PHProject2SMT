/* Função que aplica máscara no telefone */
function mascara_telefone(val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 0000-0000' : '(00) 0000-0000';
}

/* Objeto utilizado na função da máscara do telefone */
let opcoes_telefone = {
    onKeyPress: function(val, e, field, options) {
        field.mask(mascara_telefone.apply({}, arguments), options);
    }
};

/* Função que aplica máscara no celular */
function mascara_celular(val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
}

/* Objeto utilizado na função da máscara do celular */
let opcoes_celular = {
    onKeyPress: function(val, e, field, options) {
        field.mask(mascara_celular.apply({}, arguments), options);
    }
};

/* Função para validar entrada de caracteres inválidos */ 
function validarLetrasNumeros(caracter, block_type, limit = 0, id = '') {
    let asc = "";

    if (window.event)
        asc = caracter.charCode;
    else
        asc = caracter.which;

    const $id = document.getElementById(id);
    if ($id.value.length === limit) 
        return false;

    if (block_type == "numeric") {
        if (asc >= 48 && asc <= 57)
            return false;
    }

    if (block_type == "string") {
        if (!(asc >= 48 && asc <= 57))
            return false;
    }

    return true;
}

/* Aplica a máscara nos ID's especificados */
$('#txt_telefone').mask(mascara_telefone, opcoes_telefone);
$('#txt_celular').mask(mascara_celular, opcoes_celular);
