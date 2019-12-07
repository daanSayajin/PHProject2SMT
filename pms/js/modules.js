function insert(controller, body, cb = null) {
    $.ajax({
        method: 'POST',
        url: `routes.php?controller=${controller}&action=insert`,
        data: body,
        dataType: 'json',
        success: cb
    });
}

function update(controller, id, body, cb = null) {
    $.ajax({
        method: 'POST',
        url: `routes.php?controller=${controller}&action=update&id=${id}`,
        data: body,
        dataType: 'json',
        success: cb
    });
}

function remove(controller, id, cb = null) {
    $.ajax({
        method: 'DELETE',
        url: `routes.php?controller=${controller}&action=delete&id=${id}`,
        dataType: 'json',
        success: cb
    });
}

function selectAll(controller, cb) {
    $.ajax({
        method: 'GET',
        url: `routes.php?controller=${controller}&action=selectAll`,
        dataType: 'json',
        success: cb
    });
}

function selectById(controller, id, cb) {
    $.ajax({
        method: 'GET',
        url: `routes.php?controller=${controller}&action=selectById&id=${id}`,
        dataType: 'json',
        success: cb,
        error: function(data) {
            console.log(data);
        }
    });
}

function handleSessionStorage(label) {
    const username = sessionStorage.getItem("username");

    if (!username) 
        location.href = '../';

    $(label).html(username);
}

function handleLogout() {
    swal("Deseja realmente sair?", { buttons: true })
    .then(function(isConfirm) {
        if (isConfirm) {
            sessionStorage.clear();
            location.href = '../';
        }
    });
}