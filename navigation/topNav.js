try {
  document.getElementById("navi").id = "";
} catch (e) {}

document.body.getElementsByTagName(
  "script"
)[0].outerHTML += `<section id="navi"></section>`;

fetch("/navigation/navbar.html")
  .then((r) => {
    return r.text();
  })
  .then((a) => {
    document.getElementById("navi").innerHTML = a;
    document.getElementById("navi").style.textAlign = "center";
  });

function makeTitle() {
  try {
    if (document.getElementsByTagName("img")[0].title.length > 2) {
      return;
    }
    // document.getElementsByTagName("img")[0].title = `You are logged in as ${NavData.email}`;
  } catch (e) {
    console.log("could not set the title");
  }
}
makeTitle();

function checkForLogin() {
  let mobileMenu = document.getElementById("mobileMenu");
  let loginButton = document.querySelectorAll("#loginButton");
  let container = document.getElementById("myDashboardButton");
  if (sessionStorage.getItem("aResponse") || sessionStorage.getItem("userID")) {
    for (let i = 0; i < loginButton.length; i++) {
      loginButton[i].style.display = "none";
    }
    container.style.display = "block";
    mobileMenu.style.display = "block";
  } else {
    for (let i = 0; i < loginButton.length; i++) {
      loginButton[i].style.display = "block";
    }
    container.style.display = "none";
    mobileMenu.style.display = "none";
  }
}

let isForDropdown = false;

const getText = () => {
  isForDropdown = true;
  let loginButton = document.querySelectorAll("#loginButton");
  if (!sessionStorage.getItem("userID")) {
    for (let i = 0; i < loginButton.length; i++) {
      (loginButton[i].innerHTML = "login"),
        loginButton[i].addEventListener("click", () => {
          window.location.href = "/pages/login.html";
        });
    }
  } else {
    for (let i = 0; i < loginButton.length; i++) {
      (loginButton[i].innerHTML = "logout"),
        loginButton[i].addEventListener("click", () => {
          sessionStorage.clear();
          window.location.href = "/";
        });
    }
  }
};

function clearData() {
  const cookiePrefs = localStorage.cookiePrefs;
  sessionStorage.clear();
  localStorage.clear();
  window.location.href = "/";
  localStorage.cookiePrefs = cookiePrefs;
  checkForLogin();
}
let pietentialModule = sessionStorage.getItem("pietentialModule");
function getList() {
  let myDashboardDropdownButton = document.querySelectorAll(
    "#myDashboardDropdown a"
  );
  let myDashboardDropdown = document.querySelector("#myDashboardDropdown");
  console.log("hide buttons");
  console.log("mobileMenu",mobileMenu);
  if (myDashboardDropdownButton.length == 6 && pietentialModule == 1) {
    myDashboardDropdown.style.bottom = "-204px";
    myDashboardDropdownButton[1].parentNode.removeChild(
      myDashboardDropdownButton[1]
    );
    myDashboardDropdownButton[3].parentNode.removeChild(
      myDashboardDropdownButton[3]
    );
  }
  if (myDashboardDropdownButton.length == 6 && pietentialModule == 2) {
    myDashboardDropdown.style.bottom = "-244px";
    myDashboardDropdownButton[3].parentNode.removeChild(
      myDashboardDropdownButton[3]
    );
  }
}
function myList (){
  let mobileMenu = document.querySelectorAll("#mobileMenu a");
  console.log("mobileMenu",mobileMenu)
  if (mobileMenu.length == 6 && pietentialModule == 1){
    mobileMenu[1].parentNode.removeChild(mobileMenu[1]);
    mobileMenu[3].parentNode.removeChild(mobileMenu[3]);
  }
  if (mobileMenu.length == 6 && pietentialModule == 2) {
    mobileMenu[3].parentNode.removeChild(mobileMenu[3]);
  }
}

function getSidebarList() {
  let forHiding = document.querySelectorAll(".forHiding");
  if (pietentialModule == 1) {
    for (let i = 0; i < forHiding.length; i++) {
      forHiding[i].style.display = "none";
    }
  }
  if (pietentialModule == 2) {
    forHiding[1].style.display = "none";
  }
}

function showDropdownList() {
  let button = document.getElementById("myDashboardButton");
  let container = document.getElementById("myDashboardDropdown");
  container.classList.toggle("show");
  button.classList.toggle("button");
  getList();
}

function goToHomePage() {
  if (location.href.match(/\.com\/$/)) {
    showForm();
    return;
  }
  location.assign("/?pietential-sign-up");
}

function onExercise() {
  window.location.href = `/pages/exerciseHomepage.html`;
}
