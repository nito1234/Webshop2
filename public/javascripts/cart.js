function removeItem(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'removeItem',
        data : {
            id : id
        },
    }).done (function (){
        location.reload();
    })
}

function checkOut() {
    location.href = "/bestellabschluss";
}