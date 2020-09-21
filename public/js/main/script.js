// Sidebar
var expandBtn = document.getElementById("expand-sidebar-btn");
var sidebar = document.getElementById("sidebar");
var isExpandSidebar = false;
var sidebarArrow = document.getElementById("es-arrow");

expandBtn.addEventListener("click", function () {
  // e.preventDefault();

  if (isExpandSidebar) {
    sidebar.classList.remove("tu-expand-sidebar");
    sidebar.classList.remove("w-40");
    sidebar.classList.add("w-16");
    // sidebarArrow.classList.remove("transform");
    sidebarArrow.classList.remove("rotate-180");

    isExpandSidebar = false;
  } else {
    sidebar.classList.remove("w-16");
    sidebar.classList.add("tu-expand-sidebar");
    sidebar.classList.add("w-40");
    // sidebarArrow.classList.add("transform");
    sidebarArrow.classList.add("rotate-180");

    isExpandSidebar = true;
  }
});

