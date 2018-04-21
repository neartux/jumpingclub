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