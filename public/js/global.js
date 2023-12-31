$(document).ready(async function () {
    $("#loading_page").fadeOut(1000);
});

function formatRupiah(value) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    }).format(value);
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
        return true;
    }

    alert("Please enable the location permission!");
    return false;
}

function showPosition(position) {
    let address = {
        latitude: position.coords.latitude,
        longitude: position.coords.longitude,
    };

    return address;
}
