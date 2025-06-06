document.addEventListener('DOMContentLoaded', () => {
    let password = document.getElementById("pwd");
    let showPassword = false;
    let toggleButton = document.getElementById("toggle-pwd");

    toggleButton.addEventListener("click", () => {
        showPassword = !showPassword;
        let type = showPassword ? "text" : "password";
        let placeholder = showPassword ? "" : "••••••••••••••";
    
        if (showPassword) {
            toggleButton.classList.remove("bp5-icon-eye-open");
            toggleButton.classList.add("bp5-icon-eye-off");
            
        } else {
            toggleButton.classList.remove("bp5-icon-eye-off");
            toggleButton.classList.add("bp5-icon-eye-open");
        }
        password.setAttribute("placeholder", placeholder);
        password.setAttribute("type", type);
    })
})

