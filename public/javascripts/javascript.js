function fillCart() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'getCartElements',
    }).success (function (result) {
        document.getElementById("lblCartCount").innerHTML = result.toString();
    })
}