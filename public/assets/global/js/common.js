function showNotify(type, icon, message) {
    $.notifyClose();

    $.notify({
        icon: icon,
        message: message

    },{
        type: type,
        timer: 200
    });
}

function startLoading(message) {
    var options = {
        theme:"sk-circle",
        message:message
    };

    HoldOn.open(options);
}

function stopLoading() {
    HoldOn.close();
}