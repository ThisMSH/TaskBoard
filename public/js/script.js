// ===== Toggle Sidebar ===
const menu = document.querySelector("#side-bar");
const openMenu = document.querySelector("#open-btn");
const closeMenu = document.querySelector("#close-btn");
const pageContents = document.querySelector("#contents");

openMenu.addEventListener("click", function () {
  menu.classList.add("left-0");
  menu.classList.remove("-left-80");
});

closeMenu.addEventListener("click", function () {
  menu.classList.add("-left-80");
  menu.classList.remove("left-0");
});

pageContents.addEventListener("click", function () {
  if(menu.classList.contains("left-0")) {
    menu.classList.add("-left-80");
    menu.classList.remove("left-0");
  }
});

// ===== Tasks Sorting =====
const tasks = document.querySelectorAll(".tasks-container");
const sortingNames = document.querySelectorAll(".name-sorting");
const sortingDates = document.querySelectorAll(".date-sorting");

for(var i = 0; i < sortingNames.length; i++) {
  let task = tasks[i].children;
  sortingNames[i].addEventListener("click",function () {
    sortByNames(task)
  });
  sortingDates[i].addEventListener("click",function () {
    sortByDates(task)
  });
}

function sortByNames(task) {
  var switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    for(i = 0; i < (task.length - 1); i++) {
      shouldSwitch = false;
      x = task[i].firstElementChild.firstElementChild;
      y = task[i + 1].firstElementChild.firstElementChild;
      if(dir == "asc") {
        if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if(x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      task[i].parentElement.insertBefore(task[i + 1], task[i]);
      switching = true;
      switchcount++;
    } else {

      if(switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function sortByDates(task) {
  var switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    for(i = 0; i < (task.length - 1); i++) {
      shouldSwitch = false;
      x = task[i].lastElementChild.previousElementSibling.firstElementChild.firstElementChild.innerHTML;
      y = task[i + 1].lastElementChild.previousElementSibling.firstElementChild.firstElementChild.innerHTML;
      x = x.replace(/(\d{2})-(\d{2})-(\d{4})/, "$3-$2-$1");
      y = y.replace(/(\d{2})-(\d{2})-(\d{4})/, "$3-$2-$1");
      if(dir == "asc") {
        if(new Date(x) > new Date(y)) {
          shouldSwitch = true;
          break;
        }
      } else if(dir == "desc") {
        if (new Date(x) < new Date(y)) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if(shouldSwitch) {
      task[i].parentElement.insertBefore(task[i + 1], task[i]);
      switching = true;
      switchcount++;
    } else {
      if(switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

// ===== Search for a task or tasks =====
const search = document.querySelector("#search");

search.addEventListener("keyup", myFunction);

function myFunction() {
  var filter, i, j, txtValue;
  filter = search.value.toUpperCase();

  for(j = 0; j < tasks.length; j++) {
    let task = tasks[j].children;
    for(i = 0; i < task.length; i++) {
      title = task[i].firstElementChild.firstElementChild;
      txtValue = title.textContent || title.innerText;
      if(txtValue.toUpperCase().indexOf(filter) > -1) {
        task[i].style.display = "";
      } else {
        task[i].style.display = "none";
      }
    }
  }
}

// ===== Popup of Delete =====
const deleteBtns = document.querySelectorAll(".delete-btn");
const deletePopups = document.querySelectorAll(".delete-popup");
const deleteBlur = document.querySelector(".delete-bg-blur");
const cancelBtns = document.querySelectorAll(".cancel-btn");

for(var i = 0; i < deleteBtns.length; i++) {
  let deleteBtn = deleteBtns[i];
  let deletePopup = deletePopups[i];
  let cancelBtn = cancelBtns[i];

  deleteBtn.addEventListener("click", function() {
    deletePopup.classList.remove("hidden");
    deletePopup.classList.add("fixed");
    deleteBlur.classList.remove("hidden");
    deleteBlur.classList.add("fixed");
  });

  cancelBtn.addEventListener("click", function() {
    deletePopup.classList.add("hidden");
    deletePopup.classList.remove("fixed");
    deleteBlur.classList.add("hidden");
    deleteBlur.classList.remove("fixed");
  });

  deleteBlur.addEventListener("click", function() {
    deletePopup.classList.add("hidden");
    deletePopup.classList.remove("fixed");
    deleteBlur.classList.add("hidden");
    deleteBlur.classList.remove("fixed");
  });
}

// ===== Change the date to dd-mm-yyyy form =====
const dates = document.querySelectorAll(".date");

for(var i = 0; i < dates.length; i++) {
  let date = dates[i];
  let replacedDate = date.innerText.replace(/(\d{4})-(\d{2})-(\d{2})/, "$3-$2-$1");

  date.innerText = replacedDate;
}
