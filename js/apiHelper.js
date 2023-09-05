const BASE_URL = "https://3.114.159.236";
const CONTENT_TYPE = "application/json";
const POST_REQUEST = "POST";
const ACCESS_TOKEN = "Logicease123";
const ACCESS_TOKEN_PIETENTIAL = "pietential123";
const PRATHEEPA_EMAIL = "pratheepa@pietential.com";
const PATCH_REQUEST = "PATCH";

const postRequest = async (Url, BODY, access) => {
  try {
    const response = await fetch(BASE_URL + Url, {
      method: POST_REQUEST,
      headers: {
        Accept: CONTENT_TYPE,
        "Content-Type": CONTENT_TYPE,
        "x-access-token": access,
      },
      body: JSON.stringify(BODY),
    });
    if (response.status === 401) {
      sessionStorage.clear();
      window.location.href = "https://pietential.com/pages/login.html";
    }
    const json = await response.json();
    if (json.error) {
      alert("some error occurred");
      return;
    } else {
      console.log(json);
      return json;
    }
  } catch (error) {
    console.log("ERROR: ", error);
    return error;
  }
};

const patchRequest = async (Url, BODY, access) => {
  try {
    const response = await fetch(BASE_URL + Url, {
      method: PATCH_REQUEST,
      headers: {
        Accept: CONTENT_TYPE,
        "Content-Type": CONTENT_TYPE,
        "x-access-token": access,
      },
      body: JSON.stringify(BODY),
    });
    if (response.status === 401) {
      sessionStorage.clear();
      window.location.href = "https://pietential.com/pages/login.html";
    }
    const json = await response.json();
    if (json.error) {
      alert("some error occurred");
    } else {
      return json;
    }
    console.log(json);
  } catch (error) {
    console.log("API ERROR: ", error);
    return error;
  }
};
