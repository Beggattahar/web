window.onload = function() {

    fetch('../api/gpa.php')
    .then(res => res.json())
    .then(data => {
        document.getElementById('gpa').innerText = data.gpa;
    });

}