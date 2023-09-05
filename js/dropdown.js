function getYears() {
  fetch("https://pietential.com/json/years.json")
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      years = data.years;
      addYears();
    })
    .catch((err) => {
      console.log("error: " + err);
    });
}
getYears();
const wrapper = document.querySelector(".birthYearDropdown");
const selectBtn = wrapper ? wrapper.querySelector(".generalDropdown") : null;
const options = wrapper ? wrapper.querySelector(".birthYearOptions") : null;
const occupation = document.querySelector(".occupationDropdown");
const occupationOptions = occupation
  ? occupation.querySelector(".occupationOptions")
  : null;
const occupationBtn = occupation
  ? occupation.querySelector(".occupationContainer")
  : null;
const lastYear = document.querySelector(".lastYearDropdown");
const lastYearOptions = lastYear
  ? lastYear.querySelector(".lastYearOptions")
  : null;
const lastYearBtn = lastYear
  ? lastYear.querySelector(".lastYearContainer")
  : null;
const occupationHead = document.querySelector(".occupationHeadDropdown");
const occupationHeadOptions = occupationHead
  ? occupationHead.querySelector(".occupationHeadOptions")
  : null;
const occupationHeadBtn = occupationHead
  ? occupationHead.querySelector(".occupationHeadContainer")
  : null;
const annualIncome = document.querySelector(".annualIncomeDropdown");
const annualIncomeOptions = annualIncome
  ? annualIncome.querySelector(".annualIncomeOptions")
  : null;
const annualIncomeBtn = annualIncome
  ? annualIncome.querySelector(".annualIncomeContainer")
  : null;
const annualIncomeInput = annualIncome
  ? annualIncome.querySelector("input")
  : null;
const monthlyIncomeView = document.querySelector(".monthlyIncomeDropdown");
const monthlyIncomeOptions = monthlyIncomeView
  ? monthlyIncomeView.querySelector(".monthlyIncomeOptions")
  : null;
const monthlyIncomeBtn = monthlyIncomeView
  ? monthlyIncomeView.querySelector(".monthlyIncomeContainer")
  : null;
const monthlyIncomeInput = monthlyIncomeView
  ? monthlyIncomeView.querySelector("input")
  : null;
const monthlyFamilyIncome = document.querySelector(
  ".monthlyFamilyIncomeDropdown"
);
const monthlyFamilyIncomeOptions = monthlyFamilyIncome
  ? monthlyFamilyIncome.querySelector(".monthlyFamilyIncomeOptions")
  : null;
const monthlyFamilyIncomeBtn = monthlyFamilyIncome
  ? monthlyFamilyIncome.querySelector(".monthlyFamilyIncomeContainer")
  : null;
const monthlyFamilyIncomeInput = monthlyFamilyIncome
  ? monthlyFamilyIncome.querySelector("input")
  : null;
const nativeLanguage = document.querySelector(".nativeLanguageDropdown");
const nativeLanguageOptions = nativeLanguage
  ? nativeLanguage.querySelector(".nativeLanguageOptions")
  : null;
const nativeLanguageBtn = nativeLanguage
  ? nativeLanguage.querySelector(".nativeLanguageContainer")
  : null;
const nativeLanguageInput = nativeLanguage
  ? nativeLanguage.querySelector("input")
  : null;
const country = document.querySelector(".countryDropdown");
const countryOptions = country
  ? country.querySelector(".countryOptions")
  : null;
const countryBtn = country ? country.querySelector(".countryContainer") : null;
const countryInput = country
  ? country.querySelector(".countrySearchInput")
  : null;
const state = document.querySelector(".stateDropdown");
const stateOptions = state ? state.querySelector(".stateOptions") : null;
const stateBtn = state ? state.querySelector(".stateContainer") : null;
const stateInput = state ? state.querySelector(".stateSearchInput") : null;
const ruralState = document.querySelector(".ruralStateDropdown");
const ruralStateOptions = ruralState
  ? ruralState.querySelector(".ruralStateOptions")
  : null;
const ruralStateBtn = ruralState
  ? ruralState.querySelector(".ruralStateContainer")
  : null;
const ruralStateInput = ruralState
  ? ruralState.querySelector(".ruralStateSearchInput")
  : null;
const ruralVillage = document.querySelector(".ruralVillageDropdown");
const ruralVillageOptions = ruralVillage
  ? ruralVillage.querySelector(".ruralVillageOptions")
  : null;
const ruralVillageBtn = ruralVillage
  ? ruralVillage.querySelector(".ruralVillageContainer")
  : null;
const ruralVillageInput = ruralVillage
  ? ruralVillage.querySelector(".ruralVillageSearchInput")
  : null;
const ruralDistrict = document.querySelector(".ruralDistrictDropdown");
const ruralDistrictOptions = ruralDistrict
  ? ruralDistrict.querySelector(".ruralDistrictOptions")
  : null;
const ruralDistrictBtn = ruralDistrict
  ? ruralDistrict.querySelector(".ruralDistrictContainer")
  : null;
const ruralDistrictInput = ruralDistrict
  ? ruralDistrict.querySelector(".ruralDistrictSearchInput")
  : null;
const city = document.querySelector(".cityDropdown");
const cityOptions = city ? city.querySelector(".cityOptions") : null;
const cityBtn = city ? city.querySelector(".cityContainer") : null;
const cityInput = city ? city.querySelector(".citySearchInput") : null;
const industry = document.querySelector(".industryDropdown");
const industryOptions = industry
  ? industry.querySelector(".industryOptions")
  : null;
const industryBtn = industry
  ? industry.querySelector(".industryContainer")
  : null;
const industryInput = industry
  ? industry.querySelector(".industrySearchInput")
  : null;
const lastYearInput = lastYear ? lastYear.querySelector("input") : null;
const occupationHeadInput = occupationHead
  ? occupationHead.querySelector("input")
  : null;
const input = wrapper ? wrapper.querySelector("input") : null;
const occupationInput = occupation ? occupation.querySelector("input") : null;
const height = document.querySelector(".heightDropdown");
const heightOptions = height ? height.querySelector(".heightOptions") : null;
const heightBtn = height ? height.querySelector(".heightContainer") : null;
const heightInput = height ? height.querySelector(".heightSearchInput") : null;
function addYears(selectedYear = "") {
  if (options) options.innerHTML = "";
  if (lastYearOptions) lastYearOptions.innerHTML = "";
  years.forEach((year) => {
    let isSelected = year == selectedYear ? "selected" : "";
    let li = `<li onclick="updateName(${year})" class=${isSelected}>${year}</li>`;
    if (options) options.insertAdjacentHTML("beforeend", li);
    let item = `<li onclick="updateLastYear(${year})" class=${isSelected}>${year}</li>`;
    if (lastYearOptions) lastYearOptions.insertAdjacentHTML("beforeend", item);
  });
}
function onDropdown() {
  wrapper.classList.toggle("active");
}
function onOccupationDropdown() {
  occupation.classList.toggle("active");
}
function onLastYearDropdown() {
  lastYear.classList.toggle("active");
}
function onOccupationHeadDropdown() {
  occupationHead.classList.toggle("active");
}
function onAnnualIncomeDropdown() {
  annualIncome.classList.toggle("active");
}
function onMonthlyIncomeDropdown() {
  monthlyIncomeView.classList.toggle("active");
}
function onMonthlyFamilyIncomeDropdown() {
  monthlyFamilyIncome.classList.toggle("active");
}
function onNativeLanguageDropdown() {
  nativeLanguage.classList.toggle("active");
}
function onCountryDropdown() {
  country.classList.toggle("active");
}
function onState() {
  state.classList.toggle("active");
}
function onCityDropdown() {
  city.classList.toggle("active");
}
function onRuralState() {
  ruralState.classList.toggle("active");
}

function onRuralDistrictDropdown() {
  ruralDistrict.classList.toggle("active");
}

function onRuralVillageDropdown() {
  ruralVillage.classList.toggle("active");
}

function onIndustryDropdown() {
  industry.classList.toggle("active");
}
function onHeightDropdown() {
  height.classList.toggle("active");
}
if (input)
  input.addEventListener("keyup", () => {
    let value = input?.value;
    let arr = [];
    if (wrapper) {
      arr = years
        .filter((data) => {
          return data.startsWith(value);
        })
        .map((data) => `<li onclick="updateName(${data})">${data}</li>`)
        .join("");
      options.innerHTML = arr ? arr : "No Data Found";
    }
  });
if (lastYearInput)
  lastYearInput.addEventListener("keyup", () => {
    let value = lastYearInput?.value;
    let arr = [];
    if (lastYear) {
      arr = years
        .filter((data) => {
          return data.startsWith(value);
        })
        .map((data) => `<li onclick="updateLastYear(${data})">${data}</li>`)
        .join("");
      lastYearOptions.innerHTML = arr ? arr : "No Data Found";
    }
  });

function updateName(selectedCountry) {
  wrapper.classList.remove("active");
  input.value = "";
  addYears(selectedCountry);
  selectBtn.firstElementChild.innerHTML = selectedCountry;
}

function updateLastYear(selectedCountry) {
  lastYear.classList.remove("active");
  if (lastYearInput) lastYearInput.value = "";
  addYears(selectedCountry);
  lastYearBtn.firstElementChild.innerHTML = selectedCountry;
}

function getOccupation(selectedOccupation = "") {
  if (occupationOptions) occupationOptions.innerHTML = "";
  fetch("../json/occupations.json")
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      occupationsList = data;
      const occupationContainer = getElement(".occupationOptions");
      const occupationFamilyContainer = getElement(
        ".occupationFamilyContainer"
      );
      if (occupationContainer || occupationFamilyContainer) {
        occupationOptions.innerHTML = "";
        occupationsList.occupations.forEach((occupation) => {
          let item = `<li onclick="updateOccupation('${occupation}')">${occupation}</li>`;
          if (occupationOptions)
            occupationOptions.insertAdjacentHTML("beforeend", item);
          let li = `<li onclick="updateOccupationHead('${occupation}')">${occupation}</li>`;
          if (occupationHeadOptions)
            occupationHeadOptions.insertAdjacentHTML("beforeend", li);
        });
      }
    });
}
getOccupation();
if (occupationInput)
  occupationInput.addEventListener("keyup", () => {
    let value = occupationInput?.value.toLowerCase();
    console.log(value);
    let arr = [];
    arr = occupationsList.occupations
      .filter((data) => {
        return data.toLowerCase().startsWith(value);
      })
      .map((data) => `<li onclick="updateOccupation('${data}')">${data}</li>`)
      .join("");
    if (occupationOptions)
      occupationOptions.innerHTML = arr ? arr : "No Data Found";
  });

function updateOccupation(selectedValue = "") {
  occupation.classList.remove("active");
  occupationInput.value = "";
  occupationBtn.firstElementChild.innerHTML = selectedValue;
}
if (occupationHeadInput)
  occupationHeadInput.addEventListener("keyup", () => {
    let value = occupationHeadInput?.value.toLowerCase();
    console.log(value);
    let arr = [];
    arr = occupationsList.occupations
      .filter((data) => {
        return data.toLowerCase().startsWith(value);
      })
      .map(
        (data) => `<li onclick="updateOccupationHead('${data}')">${data}</li>`
      )
      .join("");
    occupationHeadOptions.innerHTML = arr ? arr : "No Data Found";
  });
getOccupation();
function updateOccupationHead(selectedValue = "") {
  occupationHead.classList.remove("active");
  occupationHeadInput.value = "";
  getOccupation(selectedValue);
  occupationHeadBtn.firstElementChild.innerHTML = selectedValue;
}

function getCurrency() {
  fetch("../json/country.json")
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      currencyDate = data;
      if (annualIncomeOptions) annualIncomeOptions.innerHTML = "";
      currencyDate.forEach((data) => {
        let item = `<li onclick="updateAnnualCurrency('${data.currency}')">${data.currency}</li>`;
        if (annualIncomeOptions)
          annualIncomeOptions.insertAdjacentHTML("beforeend", item);
        let li = `<li onclick="updateMonthlyCurrency('${data.currency}')">${data.currency}</li>`;
        if (monthlyIncomeOptions)
          monthlyIncomeOptions.insertAdjacentHTML("beforeend", li);
        let res = `<li onclick="updateMonthlyFamilyCurrency('${data.currency}')">${data.currency}</li>`;
        if (monthlyFamilyIncomeOptions)
          monthlyFamilyIncomeOptions.insertAdjacentHTML("beforeend", res);
      });
    });
}
getCurrency();
if (annualIncomeInput)
  annualIncomeInput.addEventListener("keyup", () => {
    let value = annualIncomeInput?.value.toLowerCase();
    let arr = [];
    arr = currencyDate
      .filter((data) => {
        return data.currency.toLowerCase().startsWith(value);
      })
      .map(
        (data) =>
          `<li onclick="updateAnnualCurrency('${data.currency}')">${data.currency}</li>`
      )
      .join("");
    annualIncomeOptions.innerHTML = arr ? arr : "No Data Found";
  });
if (monthlyIncomeInput)
  monthlyIncomeInput.addEventListener("keyup", () => {
    let value = monthlyIncomeInput?.value.toLowerCase();
    let arr = [];
    arr = currencyDate
      .filter((data) => {
        return data.currency.toLowerCase().startsWith(value);
      })
      .map(
        (data) =>
          `<li onclick="updateMonthlyCurrency('${data.currency}')">${data.currency}</li>`
      )
      .join("");
    monthlyIncomeOptions.innerHTML = arr ? arr : "No Data Found";
  });
if (monthlyFamilyIncome)
  monthlyFamilyIncome.addEventListener("keyup", () => {
    monthlyFamilyIncomeInput.value = "";
    let value = monthlyFamilyIncomeInput?.value.toLowerCase();
    let arr = [];
    arr = currencyDate
      .filter((data) => {
        return data.currency.toLowerCase().startsWith(value);
      })
      .map(
        (data) =>
          `<li onclick="updateMonthlyFamilyCurrency('${data.currency}')">${data.currency}</li>`
      )
      .join("");
    monthlyFamilyIncomeOptions.innerHTML = arr ? arr : "No Data Found";
  });

function updateAnnualCurrency(selectedValue = "") {
  console.log("__");
  annualIncome.classList.remove("active");
  annualIncomeInput.value = "";
  getCurrency(selectedValue);
  annualIncomeBtn.firstElementChild.innerHTML = selectedValue;
}

function updateMonthlyCurrency(selectedValue = "") {
  console.log("__");
  monthlyIncomeView.classList.remove("active");
  monthlyIncomeInput.value = "";
  getCurrency(selectedValue);
  monthlyIncomeBtn.firstElementChild.innerHTML = selectedValue;
}

function updateMonthlyFamilyCurrency(selectedValue = "") {
  monthlyFamilyIncome.classList.remove("active");
  monthlyFamilyIncomeInput.value = "";
  getCurrency(selectedValue);
  monthlyFamilyIncomeBtn.firstElementChild.innerHTML = selectedValue;
}

function getLanguages() {
  if (nativeLanguageInput) nativeLanguageInput.value = "";
  if (nativeLanguageOptions) nativeLanguageOptions.innerHTML = "";
  fetch("../json/languages.json")
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      languagesList = data.languages;
      languagesList.forEach((data) => {
        let item = `<li onclick="updateLanguage('${data}')">${data}</li>`;
        if (nativeLanguageOptions)
          nativeLanguageOptions.insertAdjacentHTML("beforeend", item);
      });
    });
}
getLanguages();
if (nativeLanguageInput)
  nativeLanguageInput.addEventListener("keyup", () => {
    let value = nativeLanguageInput.value.toLowerCase();
    let arr = [];
    arr = languagesList
      .filter((data) => {
        return data.toLowerCase().startsWith(value);
      })
      .map((data) => `<li onclick="updateLanguage('${data}')">${data}</li>`)
      .join("");
    nativeLanguageOptions.innerHTML = arr ? arr : "No Data Found";
  });

function updateLanguage(selectedValue = "") {
  nativeLanguage.classList.remove("active");
  nativeLanguageInput.value = "";
  getLanguages(selectedValue);
  nativeLanguageBtn.firstElementChild.innerHTML = selectedValue;
}

function getCountries() {
  fetch("../json/country.json")
    .then((response) => {
      return response.json();
    })
    .then((data, index) => {
      countryData = data;
      countryData.forEach((data) => {
        let item = `<li onclick="updateCountry('${data.name}', '${data.isoCode}', ${index})">${data.name}</li>`;
        if (countryOptions)
          countryOptions.insertAdjacentHTML("beforeend", item);
      });
    })
    .catch((err) => {
      console.log("error: " + err);
    });
}
getCountries();

function updateCountry(selectedValue = "", code) {
  country.classList.remove("active");
  countryInput.value = "";
  getCountries(selectedValue);
  countryBtn.firstElementChild.innerHTML = selectedValue;
  console.log("countryCode", code);
  getStates("", code);
}
if (countryInput)
  countryInput.addEventListener("keyup", () => {
    let value = countryInput.value.toLowerCase();
    console.log(value);
    let arr = [];
    arr = countryData
      .filter((data) => {
        return data.name.toLowerCase().startsWith(value);
      })
      .map(
        (data) =>
          `<li onclick="updateCountry('${data.name}', '${data.isoCode}')">${data.name}</li>`
      )
      .join("");
    countryOptions.innerHTML = arr ? arr : "No Data Found";
  });
let statesList = [];
let selectedCountryCode = "";
const getStates = async (id, code) => {
  selectedCountryCode = code;
  stateOptions.innerHTML = "";
  getElementById("smallLoader").style.display = "block";
  let select = getElement(".countryContainer");
  fetch("../json/states.json")
    .then((response) => {
      return response.json();
    })
    .then((stateList) => {
      console.log(stateList);
      const states = stateList.filter((value) => {
        return value.countryCode === code;
      });
      statesList = states;
      console.log(states);
      const stateContainer = getElement(".stateContainer");
      if (stateContainer) {
        states.forEach((data) => {
          let item = `<li onclick="updateState('${data.name}', '${code}', '${data.isoCode}')">${data.name}</li>`;
          if (stateOptions) stateOptions.insertAdjacentHTML("beforeend", item);
        });
      }
    })
    .catch((err) => {
      console.log("error: " + err);
    })
    .finally(() => {
      getElementById("smallLoader").style.display = "none";
    });
};

function updateState(selectedValue = "", countryCode, stateCode) {
  state.classList.remove("active");
  stateInput.value = "";
  stateBtn.firstElementChild.innerHTML = selectedValue;
  getCities("", countryCode, stateCode);
}
if (stateInput)
  stateInput.addEventListener("keyup", () => {
    let value = stateInput.value.toLowerCase();
    console.log(value);
    let arr = [];
    arr = statesList
      .filter((data) => {
        return data.name.toLowerCase().startsWith(value);
      })
      .map(
        (data) =>
          `<li onclick="updateState('${data.name}', '${selectedCountryCode}', '${data.isoCode}')">${data.name}</li>`
      )
      .join("");
    stateOptions.innerHTML = arr ? arr : "No Data Found";
  });
let citiesList = [];
const getCities = async (id, countryCode, stateCode) => {
  if (cityOptions) cityOptions.innerHTML = "";
  getElementById("smallLoader").style.display = "block";
  let countryContainer = getElement(".countryContainer");
  let stateContainer = getElement(".stateContainer");
  console.log(countryCode, stateCode);
  fetch("../json/cities.json")
    .then((response) => {
      return response.json();
    })
    .then((cityList) => {
      const cities = cityList.filter((value) => {
        return (
          value.countryCode === countryCode && value.stateCode === stateCode
        );
      });
      console.log("city", cities);
      citiesList = cities;
      const cityContainer = getElement(".cityContainer");
      if (cityContainer) {
        cities.forEach((data) => {
          let item = `<li onclick="updateCity('${data.name}')">${data.name}</li>`;
          if (cityOptions) cityOptions.insertAdjacentHTML("beforeend", item);
        });
      }
    })
    .catch((err) => {
      console.log("error: " + err);
    })
    .finally(() => {
      getElementById("smallLoader").style.display = "none";
    });
};

function updateCity(selectedValue = "") {
  city.classList.remove("active");
  cityInput.value = "";
  cityBtn.firstElementChild.innerHTML = selectedValue;
}
if (cityInput)
  cityInput.addEventListener("keyup", () => {
    let value = cityInput.value.toLowerCase();
    console.log(value);
    let arr = [];
    arr = citiesList
      .filter((data) => {
        return data.name.toLowerCase().startsWith(value);
      })
      .map(
        (data) =>
          `<li onclick="updateCity('${data.name}', '${data.isoCode}')">${data.name}</li>`
      )
      .join("");
    cityOptions.innerHTML = arr ? arr : "No Data Found";
  });

function getIndianStates() {
  if (ruralStateOptions) ruralStateOptions.innerHTML = "";
  fetch("../json/indiaStateDistrictVillage.json")
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      indianStates = data;
      if (ruralStateOptions) {
        indianStates.forEach((data) => {
          let item = `<li onclick="updateRuralState('${data.state}')">${data.state}</li>`;
          ruralStateOptions.insertAdjacentHTML("beforeend", item);
        });
      }
    });
}
getIndianStates();
if (ruralStateInput)
  ruralStateInput.addEventListener("keyup", () => {
    let value = ruralStateInput?.value.toLowerCase();
    let arr = [];
    if (ruralState) {
      arr = indianStates
        .filter((data) => {
          return data.state.toLowerCase().startsWith(value);
        })
        .map(
          (data) =>
            `<li onclick="updateRuralState('${data.state}')">${data.state}</li>`
        )
        .join("");
      ruralStateOptions.innerHTML = arr ? arr : "No Data Found";
    }
  });

function updateRuralState(selectedState) {
  ruralState.classList.remove("active");
  ruralStateInput.value = "";
  getIndianStates();
  getDistrict(selectedState);
  ruralStateBtn.firstElementChild.innerHTML = selectedState;
}
let selectedRuralState = "";
function getDistrict(stateValue) {
  if (ruralDistrictOptions) ruralDistrictOptions.innerHTML = "";
  selectedRuralState = stateValue;
  getElementById("smallLoaderCity").style.display = "block";
  const indianStatesContainer = getElement(".indianStatesContainer");
  fetch("../json/indiaStateDistrictVillage.json")
    .then((response) => {
      return response.json();
    })
    .then((stateList) => {
      const districts = stateList.filter((value) => {
        return value.state === stateValue;
      });
      districtList = districts[0].districts;
      districtList.forEach((data) => {
        console.log("dis", data.district);
        let item = `<li onclick="updateRuralDistrict('${data.district}', '${stateValue}')">${data.district}</li>`;
        if (ruralDistrictOptions)
          ruralDistrictOptions.insertAdjacentHTML("beforeend", item);
      });
    })
    .catch((err) => {
      console.log("error: " + err);
    })
    .finally(() => {
      getElementById("smallLoaderCity").style.display = "none";
    });
}
if (ruralDistrictInput)
  ruralDistrictInput.addEventListener("keyup", () => {
    let value = ruralDistrictInput?.value.toLowerCase();
    let arr = [];
    if (ruralDistrict) {
      arr = districtList
        .filter((data) => {
          return data.district.toLowerCase().startsWith(value);
        })
        .map(
          (data) =>
            `<li onclick="updateRuralDistrict('${data.district}', '${selectedRuralState}')">${data.district}</li>`
        )
        .join("");
      ruralDistrictOptions.innerHTML = arr ? arr : "No Data Found";
    }
  });

function updateRuralDistrict(selectedState = "", selectedRuralState) {
  ruralDistrict.classList.remove("active");
  ruralDistrictInput.value = "";
  ruralDistrictBtn.firstElementChild.innerHTML = selectedState;
  getVillages(selectedRuralState, selectedState);
}

let villageList = [];
function getVillages(selectedRuralState, selectedState) {
  if (ruralVillageOptions) ruralVillageOptions.innerHTML = "";
  getElementById("smallLoaderCity").style.display = "block";
  fetch("../json/indiaStateDistrictVillage.json")
    .then((response) => {
      return response.json();
    })
    .then((stateList) => {
      const district = stateList.filter((value) => {
        return value.state === selectedRuralState;
      });
      districtList = district[0].districts;
      const districts = districtList.filter((value) => {
        return value.district === selectedState;
      });
      let villages = districts[0].subDistricts.villages.sort();
      villageList = villages;
      villages.forEach((data) => {
        console.log("dis", data);
        let item = `<li onclick="updateRuralVillage('${data}')">${data}</li>`;
        if (ruralVillageOptions)
          ruralVillageOptions.insertAdjacentHTML("beforeend", item);
      });
    })
    .catch((err) => {
      console.log("error: " + err);
    })
    .finally(() => {
      getElementById("smallLoaderCity").style.display = "none";
    });
}
if (ruralVillageInput)
  ruralVillageInput.addEventListener("keyup", () => {
    let value = ruralVillageInput?.value.toLowerCase();
    let arr = [];
    if (ruralVillage) {
      arr = villageList
        .filter((data) => {
          return data.toLowerCase().startsWith(value);
        })
        .map(
          (data) => `<li onclick="updateRuralVillage('${data}')">${data}</li>`
        )
        .join("");
      ruralVillageOptions.innerHTML = arr ? arr : "No Data Found";
    }
  });

function updateRuralVillage(selectedState = "") {
  ruralVillage.classList.remove("active");
  ruralVillageInput.value = "";
  ruralVillageBtn.firstElementChild.innerHTML = selectedState;
}

function getIndustries() {
  fetch("../json/industries.json")
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      industriesData = data;
      industriesData.industries.forEach((data) => {
        let li = `<li onclick="updateIndustry('${data}')">${data}</li>`;
        if (industryOptions)
          industryOptions.insertAdjacentHTML("beforeend", li);
      });
    });
}
getIndustries();
if (industryInput)
  industryInput.addEventListener("keyup", () => {
    let value = industryInput?.value.toLowerCase();
    let arr = [];
    if (industry) {
      arr = industriesData.industries
        .filter((data) => {
          return data.toLowerCase().startsWith(value);
        })
        .map((data) => `<li onclick="updateIndustry('${data}')">${data}</li>`)
        .join("");
      industryOptions.innerHTML = arr ? arr : "No Data Found";
    }
  });

function updateIndustry(selectedCountry) {
  industry.classList.remove("active");
  industryInput.value = "";
  industryBtn.firstElementChild.innerHTML = selectedCountry;
}

function getHeight() {
  fetch("../json/height.json")
    .then((response) => {
      console.log(response);
      return response.json();
    })
    .then((data) => {
      heightData = data;
      heightData.height.forEach((data) => {
        let li = `<li onclick="updateHeight('${data}')">${data}</li>`;
        if (heightOptions)
          heightOptions.insertAdjacentHTML("beforeend", li);
      });
    });
}
getHeight();
if (heightInput)
  heightInput.addEventListener("keyup", () => {
    let value = heightInput?.value.toLowerCase();
    let arr = [];
    if (height) {
      arr = heightData.height
        .filter((data) => {
          return data.toLowerCase().startsWith(value);
        })
        .map((data) => `<li onclick="updateHeight('${data}')">${data}</li>`)
        .join("");
      heightOptions.innerHTML = arr ? arr : "No Data Found";
    }
  });

function updateHeight(selectedHeight) {
  height.classList.remove("active");
  heightInput.value = "";
  heightBtn.firstElementChild.innerHTML = selectedHeight;
}
