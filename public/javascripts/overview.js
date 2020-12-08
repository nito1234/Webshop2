function addtoCart(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'addToCart',
        data : {
            id : id
        },
    }).success (function (result) {
        document.getElementById("lblCartCount").innerHTML = result.toString();
    })
}

function orderComplete() {
    location.href = "/orderComplete";
}