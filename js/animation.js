let subtitleClass = document.querySelectorAll("#subtitle");
let li = document.querySelectorAll("#progressContainer");
let tabContent = document.querySelector(".howWeDo");
const UserButton = document.getElementById("userButton");
const AdminButton = document.getElementById("adminButton");

const arrays = [
  "./assets/tabsImages/adminSubscription.webp",
  "./assets/tabsImages/thankyou.webp",
  "./assets/tabsImages/adminRegister.webp",
  "./assets/tabsImages/demographics.webp",
  "./assets/tabsImages/congratulations.webp",
  "./assets/tabsImages/dashboard.webp",
  "./assets/tabsImages/inviteNewUsers.webp",
  "./assets/tabsImages/analysis.webp",
];

const arraySecond = [
  "./assets/tabsImages/userRegister.webp",
  "./assets/tabsImages/survey.webp",
  "./assets/tabsImages/visualization.webp",
  "./assets/tabsImages/surveyAnalysis.webp",
  "./assets/tabsImages/userDashboard.webp",
  "./assets/tabsImages/homePage.webp",
];

let image = document.querySelector("#adminImage");
let imageThree = document.querySelector("#adminImageTwo");
function changeImage(file, i) {
  let imageClass = document.querySelectorAll(".admin2");
  image.setAttribute("src", file);
  image.classList.add("imageActive");
  setTimeout(() => {
    image.classList.remove("imageActive");
  }, 5000);
  subtitleClass[i].classList.add("subtitleActive");
  setTimeout(() => {
    subtitleClass[i].classList.remove("subtitleActive");
  }, 4900);
  li[i].classList.add("listItem");
  setTimeout(() => {
    li[i].classList.remove("listItem");
  }, 5000);
  imageClass[i].classList.add("admin3");
  setTimeout(() => {
    imageClass[i].classList.remove("admin3");
  }, 5000);
  let span = document.querySelectorAll("#progress");
  span[i].style.height = "100%";
  setTimeout(() => {
    span[i].style.height = "60px";
  }, 5000);
  span[i].classList.add("progress2");
  setTimeout(() => {
    span[i].classList.remove("progress2");
  }, 5000);
}

function changeImageTwo(file, i) {
  let imageClass = document.querySelectorAll(".admin2");
  let imageTwo = document.querySelector(".admin-image");
  imageThree.setAttribute("src", file);
  imageTwo.setAttribute("src", file);
  imageThree.classList.add("imageActive");
  imageTwo.classList.add("imageActive");
  setTimeout(() => {
    imageThree.classList.remove("imageActive");
    imageTwo.classList.remove("imageActive");
  }, 5000);
  subtitleClass[i].classList.add("subtitleActive");
  setTimeout(() => {
    subtitleClass[i].classList.remove("subtitleActive");
  }, 4900);
  li[i].classList.add("listItem");
  setTimeout(() => {
    li[i].classList.remove("listItem");
  }, 5000);
  imageClass[i].classList.add("admin3");
  setTimeout(() => {
    imageClass[i].classList.remove("admin3");
  }, 5000);
  let span = document.querySelectorAll("#progress");
  span[i].style.height = "auto";
  setTimeout(() => {
    span[i].style.height = "60px";
  }, 5000);
  span[i].classList.add("progress2");
  setTimeout(() => {
    span[i].classList.remove("progress2");
  }, 5000);
}

let imagesIndex = 0;
function getScrolledImages() {
  changeImage("./assets/tabsImages/adminSubscription.webp", imagesIndex);
  setIntervalId();
}
let clearAnimation = 0;
const setIntervalId = () =>
  setInterval(() => {
    if (clearAnimation === 1) return;
    if (imagesIndex === 7) imagesIndex = 0;
    else imagesIndex += 1;
    if (imagesIndex % 2 === 0) {
      image.classList.add("imageActiveTwo");
      setTimeout(() => {
        image.classList.remove("imageActiveTwo");
      }, 5000);
    } else {
      image.classList.add("imageActive");
      setTimeout(() => {
        image.classList.remove("imageActive");
      }, 5000);
    }
    changeImage(arrays[imagesIndex], imagesIndex);
  }, 5000);

let newImageIndex = 0;
let newImage = 8;
const intervalId = () => {
  setInterval(() => {
    if (clearAnimation === 1) return;
    if (newImageIndex === 5) newImageIndex = 0;
    else newImageIndex += 1;
    if (newImage === 13) newImage = 8;
    else newImage += 1;
    changeImageTwo(arraySecond[newImageIndex], newImage);
  }, 5000);
};


let prevIndex = 0;
function onListItem(fileName, index) {
  clearAnimation = 1;
  clearInterval(setIntervalId());
  clearInterval(intervalId());
  let imageClass = document.querySelectorAll(".admin2");
  let image = document.querySelector("#adminImage");
  let imageTwo = document.querySelector(".admin-image");
  image.setAttribute("src", fileName);
  imageTwo.setAttribute("src", fileName);
  if (imagesIndex % 2 === 0) {
    image.classList.add("imageActiveTwo");
    imageTwo.classList.add("imageActiveTwo");
    setTimeout(() => {
      image.classList.remove("imageActiveTwo");
      imageTwo.classList.remove("imageActiveTwo");
    }, 2000);
  } else {
    image.classList.add("imageActive");
    imageTwo.classList.add("imageActive");
    setTimeout(() => {
      image.classList.remove("imageActive");
      imageTwo.classList.remove("imageActive");
    }, 2000);
  }
  li[prevIndex].classList.remove("listItem");
  li[index].classList.add("listItem");
  subtitleClass[prevIndex].classList.remove("subtitleActive");
  subtitleClass[index].classList.add("subtitleActive");
  imageClass[prevIndex].classList.remove("admin3");
  imageClass[index].classList.add("admin3");
  let span = document.querySelectorAll("#progress");
  span[prevIndex].style.height = "60px";
  span[index].style.height = "100%";
  span[prevIndex].classList.remove("progressTwo", "progress2");
  span[index].classList.add("progressTwo");
  prevIndex = index;
}
function onListItem1(fileName, index) {
  clearAnimation = 1;
  clearInterval(setIntervalId());
  clearInterval(intervalId());
  let imageClass = document.querySelectorAll(".admin2");
  let image = document.querySelector("#adminImage");
  let imageTwo = document.querySelector(".admin-image");
  image.setAttribute("src", fileName);
  imageTwo.setAttribute("src", fileName);
  if (imagesIndex % 2 === 0) {
    image.classList.add("imageActiveTwo");
    imageTwo.classList.add("imageActiveTwo");
    setTimeout(() => {
      image.classList.remove("imageActiveTwo");
      imageTwo.classList.remove("imageActiveTwo");
    }, 2000);
  } else {
    image.classList.add("imageActive");
    imageTwo.classList.add("imageActive");
    setTimeout(() => {
      image.classList.remove("imageActive");
      imageTwo.classList.remove("imageActive");
    }, 2000);
  }
  li[prevIndex].classList.remove("listItem1");
  li[index].classList.add("listItem1");
  subtitleClass[prevIndex].classList.remove("subtitleActive");
  subtitleClass[index].classList.add("subtitleActive");
  imageClass[prevIndex].classList.remove("admin1");
  imageClass[index].classList.add("admin1");
  let span = document.querySelectorAll("#progress");
  span[prevIndex].style.height = "60px";
  span[index].style.height = "auto";
  span[prevIndex].classList.remove("progressTwo", "progress2");
  span[index].classList.add("progressTwo");
  prevIndex = index;
}
let scrollStart = 0;
window.addEventListener("scroll", () => {
  let top = tabContent.getBoundingClientRect().top;
  if (top <= window.innerHeight && scrollStart === 0) {
    scrollStart = 1;
    getScrolledImages();
  }
});

if (UserButton) {
  UserButton.addEventListener("click", () => {
    if (AdminButton.classList.contains("active"))
      AdminButton.classList.remove("active");
    else {
      changeImageTwo("./assets/tabsImages/userRegister.webp", newImage);
      intervalId();
      UserButton.classList.add("userActive");
    }
  });
}

if (AdminButton) {
  AdminButton.addEventListener("click", () => {
    if (UserButton.classList.contains("userActive"))
      UserButton.classList.remove("userActive");
    if (AdminButton.classList.contains("active"))
      AdminButton.classList.remove("active");
    else {
      changeImage("./assets/tabsImages/adminSubscription.webp", imagesIndex);
      AdminButton.classList.add("active");
    }
  });
}