
function logIn() {
    const user = document.getElementById("user");
    
    if (user.value === "admin") {
        window.location.href = "admin.php"
    } else {
        document.getElementById("auth").value = "1";
        document.getElementById("submit").click();
        close.click();
    }
}

function logOut() {
    document.getElementById("auth").value = "0";
    document.getElementById("submit").click();
}