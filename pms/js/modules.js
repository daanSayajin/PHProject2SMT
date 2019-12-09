const baseUrl = 'http://localhost:80/daan/PHProject2SMT/pms/';

function insert(controller, body, cb = null) {
    $.ajax({
        method: 'POST',
        url: `${baseUrl}routes.php?controller=${controller}&action=insert`,
        data: body,
        dataType: 'json',
        success: cb,
        error: function(err) { console.log(err.responseText) }
    });
}

function update(controller, id, body, cb = null) {
    $.ajax({
        method: 'POST',
        url: `${baseUrl}routes.php?controller=${controller}&action=update&id=${id}`,
        data: body,
        dataType: 'json',
        success: cb,
        error: function(err) { console.log(err.responseText) }
    });
}

function updateStatus(controller, id, status, cb = null) {
    $.ajax({
        method: 'PUT',
        url: `${baseUrl}routes.php?controller=${controller}&action=updateStatus&id=${id}&status=${status}`,
        dataType: 'json',
        success: cb,
        error: function(err) { console.log(err.responseText) }
    });
}

function remove(controller, id, cb = null) {
    $.ajax({
        method: 'DELETE',
        url: `${baseUrl}routes.php?controller=${controller}&action=delete&id=${id}`,
        dataType: 'json',
        success: cb,
        error: function(err) { console.log(err.responseText) }
    });
}

function removeByProductId(controller, id, cb) {
    $.ajax({
        method: 'GET',
        url: `${baseUrl}routes.php?controller=${controller}&action=deleteByProductId&id=${id}`,
        dataType: 'json',
        success: cb,
        error: function(err) { console.log(err.responseText) }
    });
}

function selectAll(controller, cb) {
    $.ajax({
        method: 'GET',
        url: `${baseUrl}routes.php?controller=${controller}&action=selectAll`,
        dataType: 'json',
        success: cb,
        error: function(err) { console.log(err.responseText) }
    });
}

function selectByProductId(controller, id, cb) {
    $.ajax({
        method: 'GET',
        url: `${baseUrl}routes.php?controller=${controller}&action=selectByProductId&id=${id}`,
        dataType: 'json',
        success: cb,
        error: function(err) { console.log(err.responseText) }
    });
}

function selectByCategoryId(controller, id, cb) {
    $.ajax({
        method: 'GET',
        url: `${baseUrl}routes.php?controller=${controller}&action=selectByCategoryId&id=${id}`,
        dataType: 'json',
        success: cb,
        error: function(err) { console.log(err.responseText) }
    });
}

function selectBySubcategoryId(controller, id, cb) {
    $.ajax({
        method: 'GET',
        url: `${baseUrl}routes.php?controller=${controller}&action=selectBySubcategoryId&id=${id}`,
        dataType: 'json',
        success: cb,
        error: function(err) { console.log(err.responseText) }
    });
}

function selectById(controller, id, cb) {
    $.ajax({
        method: 'GET',
        url: `${baseUrl}routes.php?controller=${controller}&action=selectById&id=${id}`,
        dataType: 'json',
        success: cb,
        error: function(err) { console.log(err.responseText) }
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