const toggleBtn = document.getElementById("themeToggle");
const icon = document.getElementById("themeIcon");
const body = document.body;

const savedTheme = localStorage.getItem("theme");
if (savedTheme === "light") {
    body.classList.add("light");
    if (icon) icon.textContent = "☀️"; 
}

if (toggleBtn) { 
    toggleBtn.addEventListener("click", () => {
        body.classList.toggle("light");

        if (body.classList.contains("light")) {
            if (icon) icon.textContent = "☀️";
            localStorage.setItem("theme", "light");
        } else {
            if (icon) icon.textContent = "🌙";
            localStorage.setItem("theme", "dark");
        }
    });
}