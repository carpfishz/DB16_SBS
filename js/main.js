window.onload = function () {
    var modal = document.getElementById('myModal');
    var span = document.getElementsByClassName('close')[0];
    var ct_button = document.getElementById('ct-button');

    ct_button.onclick = function () {
        modal.style.display = "block";
    }

    span.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if(event.target == modal) {
            modal.style.display = "none";
        }
    }
}