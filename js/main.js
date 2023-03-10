const listItems = document.querySelectorAll(".sidebar-list li");

listItems.forEach(item => {
    item.addEventListener("click", () => {
        let isActive = item.classList.contains("active");

        listItems.forEach(e1 => {
            e1.classList.remove("active");
        });

        if(isActive) item.classList.remove("active");
        else item.classList.add("active");
    });
});

const toggleSidebar = document.querySelector(".toggle-sidebar");
const logo = document.querySelector(".logo-box");
const sidebar = document.querySelector(".sidebar");

toggleSidebar.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});
logo.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

// delete popup
function toggle(){
    var sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('blur');
    var home = document.querySelector('.home');
    home.classList.toggle('blur');
    var popup = document.querySelector('#popup');
    popup.classList.toggle('active');
}