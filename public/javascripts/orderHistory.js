function orderDetails(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'orderDetails',
        data : {
            id : id
        },
        complete: function (data) {
            document.getElementById("orderDetailOverlay").innerHTML = data.responseText;
            document.getElementById("orderDetailOverlay").style.visibility = "visible";
        },
    })
}

$(document).click(function (e) {
    var overlay = document.getElementById("orderDetailOverlay");
    if (overlay.style.visibility === "visible") {
        if (!$(overlay).is(e.target) && !$('input').is(e.target) && !$('#open').is(e.target)) {
            overlay.innerText="";
            overlay.style.visibility = "hidden";
            overlay.style.display = "none";
            location.reload();
        }
    }
});