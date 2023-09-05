const userId = sessionStorage.getItem("userID");
const companyName = sessionStorage.getItem("companyName");
const jwt = sessionStorage.getItem("jwt");
const handleAdminRegister = async (
  email,
  password,
  firstName,
  lastName,
  companyName,
  title,
  businessCategory,
  pietentialModule,
  userPrivacy
) => {
  const body = {
    email: email,
    password: password,
    fname: firstName,
    lname: lastName,
    adminFullName: "",
    company: companyName,
    title: title,
    businessCategories: businessCategory,
    pietentialModule: pietentialModule,
    userPrivacy: userPrivacy
  };
  const response = await postRequest(
    "/api/user/admin/create",
    body,
    ACCESS_TOKEN_PIETENTIAL
  );
  return response;
};

const handleAdminLogin = async (email, password) => {
  const body = {
    email: email,
    password: password,
  };
  const response = await postRequest(
    "/api/user/admin/login",
    body,
    ACCESS_TOKEN_PIETENTIAL
  );
  return response;
};

const handleSendEmailToAdmin = async (
  companyName,
  title,
  name,
  lastName,
  email
) => {
  const body = {
    To: PRATHEEPA_EMAIL,
    companyName: companyName,
    title: title,
    name: name,
    lastName: lastName,
    userEmail: email,
  };
  const response = await postRequest(
    "/api/user/admin/register/email",
    body,
    ACCESS_TOKEN_PIETENTIAL
  );
  return response;
};

const getAllQuestionsResponse = async () => {
  const body = {
    userID: userId,
    companyName: companyName,
  };
  const response = await postRequest(
    "/api/users/questions/response/get",
    body,
    jwt
  );
  return response;
};

const handleUserProgress = async (progress, text, stepCount) => {
  const body = {
    progress: progress,
    section: text,
    userID: sessionStorage.getItem("userID"),
    companyName: sessionStorage.getItem("companyName")
      ? sessionStorage.getItem("companyName")
      : "",
    stepCount: stepCount,
  };
  const response = await patchRequest("/api/users/update/progress", body, jwt);
  return response;
};

const getUserProgress = async () => {
  const body = {
    userID: userId,
    companyName: companyName,
  };
  const response = await postRequest("/api/users/get/progress", body, jwt);
  return response;
};

const handleUserForgotPassword = async (email, promoCode) => {
  const body = {
    email: email,
    promoCode: promoCode,
  };
  const response = await postRequest(
    "/api/users/forgot/password",
    body,
    ACCESS_TOKEN
  );
  return response;
};

const handleAdminForgotPassword = async (email) => {
  const body = {
    email: email,
  };
  const response = await postRequest(
    "/api/user/admin/forgot/password",
    body,
    ACCESS_TOKEN_PIETENTIAL
  );
  return response;
};

const getUserDemographics = async () => {
  const body = {
    companyName: companyName,
  };
  const response = await postRequest(
    "/api/demographics/get/by/user",
    body,
    jwt
  );
  // return response;
  return {
    "demographics": [
        {
            "COLUMN_NAME": "userID"
        },
        {
            "COLUMN_NAME": "created_at"
        },
        {
            "COLUMN_NAME": "demographic_id"
        },
        {
            "COLUMN_NAME": "age"
        },
        {
            "COLUMN_NAME": "gender"
        },
        {
            "COLUMN_NAME": "marital_status"
        },
        {
            "COLUMN_NAME": "number_of_dependents"
        },
        {
            "COLUMN_NAME": "education_level"
        },
        {
            "COLUMN_NAME": "employment_status"
        },
        {
            "COLUMN_NAME": "occupation"
        },
        {
            "COLUMN_NAME": "industry"
        },
        {
            "COLUMN_NAME": "title"
        },
        {
            "COLUMN_NAME": "annual_income"
        },
        {
            "COLUMN_NAME": "religion"
        },
        {
            "COLUMN_NAME": "native_language"
        },
        {
            "COLUMN_NAME": "caste"
        },
        {
            "COLUMN_NAME": "country"
        },
        {
            "COLUMN_NAME": "state_region"
        },
        {
            "COLUMN_NAME": "city"
        },
        {
            "COLUMN_NAME": "street"
        },
        {
            "COLUMN_NAME": "postal_code"
        }
    ],
    "demographicsType": [],
    "companyType": []
}
};

const handleUserUpdate = async (existingFields, userPrivacy) => {
  const body = {
    fname: "",
    lname: "",
    existingFields: "userID='" + userId + "'," + existingFields,
    userID: userId,
    companyName: companyName,
    userPrivacy: userPrivacy
  };
  const response = await patchRequest(
    "/api/users/update/by/user/id",
    body,
    jwt
  );
  return response;
};

const handleUserLogin = async (email, password, promoCode) => {
  const body = {
    email: email,
    password: password,
    promoCode: promoCode,
  };
  const response = await postRequest("/api/users/login", body, ACCESS_TOKEN);
  return response;
};

const handleUserCreate = async (
  email,
  password,
  promoCode,
  firstName,
  lastName,
  randomID
) => {
  const body = {
    email: email,
    password: password,
    promoCode: promoCode,
    fname: firstName,
    lname: lastName,
    userID: randomID,
  };
  const response = await postRequest("/api/users/create", body, ACCESS_TOKEN);
  return response;
};

const handleAdminResetPassword = async (adminID, password, token) => {
  const body = {
    adminID: adminID,
    password: password,
  };
  const response = await postRequest(
    "/api/user/admin/reset/password",
    body,
    token
  );
  return response;
};

const handleUserResetPassword = async (
  id,
  userCompanyName,
  password,
  token
) => {
  const body = {
    userID: id,
    companyName: userCompanyName,
    password: password,
  };
  const response = await postRequest("/api/users/reset/password", body, token);
  return response;
};

const getAllSurveyQuestion = async (language) => {
  const body = {
    language: language,
  };
  const response = await postRequest(
    "/api/users/questions/get",
    body,
    ACCESS_TOKEN
  );
  return response;
};

const handleCreateUserSurveyResponse = async (
  firstQuestionResponse,
  secondQuestionResponse,
  thirdQuestionResponse,
  fourthQuestionResponse,
  fifthQuestionResponse,
  sixthQuestionResponse,
  seventhQuestionResponse,
  eightQuestionResponse,
  ninthQuestionResponse,
  tenthQuestionResponse,
  eleventhQuestionResponse,
  twelfthQuestionResponse,
  thirteenthQuestionResponse,
  fourteenthQuestionResponse,
  fifteenthQuestionResponse,
  sixteenthQuestionResponse,
  seventeenthQuestionResponse,
  eighteenthQuestionResponse,
  nineteenthQuestionResponse,
  twentiethQuestionResponse,
  twentyOneQuestionResponse,
  twentyTwoQuestionResponse,
  twentyThreeQuestionResponse,
  twentyFourQuestionResponse,
  twentyFiveQuestionResponse,
  twentySixQuestionResponse,
  twentySevenQuestionResponse,
  twentyEightQuestionResponse,
  twentyNineQuestionResponse,
  thirtyQuestionResponse,
  currentDate
) => {
  const body = {
    Q0response: firstQuestionResponse,
    Q1response: secondQuestionResponse,
    Q2response: thirdQuestionResponse,
    Q3response: fourthQuestionResponse,
    Q4response: fifthQuestionResponse,
    Q5response: sixthQuestionResponse,
    Q6response: seventhQuestionResponse,
    Q7response: eightQuestionResponse,
    Q8response: ninthQuestionResponse,
    Q9response: tenthQuestionResponse,
    Q10response: eleventhQuestionResponse,
    Q11response: twelfthQuestionResponse,
    Q12response: thirteenthQuestionResponse,
    Q13response: fourteenthQuestionResponse,
    Q14response: fifteenthQuestionResponse,
    Q15response: sixteenthQuestionResponse,
    Q16response: seventeenthQuestionResponse,
    Q17response: eighteenthQuestionResponse,
    Q18response: nineteenthQuestionResponse,
    Q19response: twentiethQuestionResponse,
    Q20response: twentyOneQuestionResponse,
    Q21response: twentyTwoQuestionResponse,
    Q22response: twentyThreeQuestionResponse,
    Q23response: twentyFourQuestionResponse,
    Q24response: twentyFiveQuestionResponse,
    Q25response: twentySixQuestionResponse,
    Q26response: twentySevenQuestionResponse,
    Q27response: twentyEightQuestionResponse,
    Q28response: twentyNineQuestionResponse,
    Q29response: thirtyQuestionResponse,
    companyName: companyName,
    completionDate: currentDate,
    userID: userId,
  };
  const response = await postRequest(
    "/api/users/questions/response/create",
    body,
    jwt
  );
  return response;
};
