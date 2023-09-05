const triangle = document.querySelector(".triangle");
let advisorContainer = document.querySelector("#advisorContainer");
let modal = document.querySelector("#modalOverlay");
let modalEnterprises = document.querySelector("#modalOverlayEnterprises");
let modalBusiness = document.querySelector("#modalOverlayBusiness");
let modalNgo = document.querySelector("#modalOverlayNgo");
let closeIcon = document.querySelector(".closeIcon");
let enterprisesCloseIcon = document.querySelector(".enterprisesCloseIcon");
let businessCloseIcon = document.querySelector(".businessCloseIcon");
let ngoCloseIcon = document.querySelector(".ngoCloseIcon");
let modalInner = document.querySelectorAll(".modalInner");
let enterprisesContainer = document.querySelector("#enterprisesContainer");
let businessContainer = document.querySelector("#businessContainer");
let ngoContainer = document.querySelector("#ngoContainer");

advisorContainer.addEventListener("click", () => {
  modalInner[0].classList.add("modalAnimation");
  modal.style.display = "block";
  onModalImageFour(
    "./assets/modalImages/pietentialAdvisorDashboard1.png",
    "#modalImage37"
  );
});

enterprisesContainer.addEventListener("click", () => {
  modalInner[1].classList.add("modalAnimation");
  modalEnterprises.style.display = "block";
  onModalImage(
    "./assets/modalImages/pietentialEnterpriseDashboard1.png",
    "#modalImage8"
  );
});

businessContainer.addEventListener("click", () => {
  modalInner[2].classList.add("modalAnimation");
  modalBusiness.style.display = "block";
  onModalImageTwo(
    "./assets/modalImages/pietentialBusinessDashboard1.png",
    "#modalImage19"
  );
});

ngoContainer.addEventListener("click", () => {
  modalInner[3].classList.add("modalAnimation");
  modalNgo.style.display = "block";
  onModalImageThree(
    "./assets/modalImages/pietentialNgoDashboard1.png",
    "#modalImage28"
  );
});

closeIcon.addEventListener("click", () => {
  modal.style.display = "none";
});

enterprisesCloseIcon.addEventListener("click", () => {
  modalEnterprises.style.display = "none";
});

businessCloseIcon.addEventListener("click", () => {
  modalBusiness.style.display = "none";
});

ngoCloseIcon.addEventListener("click", () => {
  modalNgo.style.display = "none";
});

const modalSliderImage = document.querySelector("#modalImage");
const modalSliderImageTwo = document.querySelector("#modalImage2");
const modalSliderImageThree = document.querySelector("#modalImage3");
const modalSliderImageFour = document.querySelector("#modalImage4");

let selectedImage = "#modalImage8";
let selectedImageTwo = "#modalImage19";
let selectedImageThree = "#modalImage28";
let selectedImageFour = "#modalImage38";

function onModalImage(fileName, i) {
  document.querySelector(selectedImage).style.border = "2px solid #00aeef";
  document.querySelector(i).style.border = "2px solid red";
  selectedImage = i;
  modalSliderImage.setAttribute("src", fileName);
}
function onModalImageTwo(fileName, i) {
  document.querySelector(selectedImageTwo).style.border = "2px solid #e8a900";
  document.querySelector(i).style.border = "2px solid red";
  selectedImageTwo = i;
  modalSliderImageTwo.setAttribute("src", fileName);
}

function onModalImageThree(fileName, i) {
  document.querySelector(selectedImageThree).style.border = "2px solid #f57e20";
  document.querySelector(i).style.border = "2px solid red";
  selectedImageThree = i;
  modalSliderImageThree.setAttribute("src", fileName);
}

function onModalImageFour(fileName, i) {
  document.querySelector(selectedImageFour).style.border = "2px solid #0E9535";
  document.querySelector(i).style.border = "2px solid red";
  selectedImageFour = i;
  modalSliderImageFour.setAttribute("src", fileName);
}

