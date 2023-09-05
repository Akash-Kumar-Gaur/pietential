let aResponse;
let bResponse;
let cResponse;
let dResponse;
let eResponse;
const getLatestQuestions = async () => {
  try {
    const res = await fetch(
      "https://3.114.159.236/api/users/questions/response/get",
      {
        method: "POST",
        body: JSON.stringify({
          userID: sessionStorage.getItem("userID"),
          companyName: sessionStorage.getItem("companyName"),
        }),
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          "x-access-token": sessionStorage.getItem("jwt"),
        },
      }
    );
    let json = await res.json();
    let reverseList = json.QuestionsResponse.reverse();
    let q = reverseList[0];
    aResponse = Math.round(
      ((Number(q.Q0response) +
        Number(q.Q1response) +
        Number(q.Q2response) +
        Number(q.Q3response) +
        Number(q.Q4response) +
        Number(q.Q5response)) /
        60) *
        100
    );
    bResponse = Math.round(
      ((Number(q.Q6response) +
        Number(q.Q7response) +
        Number(q.Q8response) +
        Number(q.Q9response) +
        Number(q.Q10response) +
        Number(q.Q11response)) /
        60) *
        100
    );
    cResponse = Math.round(
      ((Number(q.Q12response) +
        Number(q.Q13response) +
        Number(q.Q14response) +
        Number(q.Q15response) +
        Number(q.Q16response) +
        Number(q.Q17response)) /
        60) *
        100
    );
    dResponse = Math.round(
      ((Number(q.Q18response) +
        Number(q.Q19response) +
        Number(q.Q20response) +
        Number(q.Q21response) +
        Number(q.Q22response) +
        Number(q.Q23response)) /
        60) *
        100
    );
    eResponse = Math.round(
      ((Number(q.Q24response) +
        Number(q.Q25response) +
        Number(q.Q26response) +
        Number(q.Q27response) +
        Number(q.Q28response) +
        Number(q.Q29response)) /
        60) *
        100
    );
    sessionStorage.setItem("surveyList", aResponse);
    sessionStorage.setItem("lastEsteemScore", bResponse);
    sessionStorage.setItem("lastBelongingScore", cResponse);
    sessionStorage.setItem("lastNeedsScore", dResponse);
    sessionStorage.setItem("lastPhysioScore", eResponse);
  } catch (error) {
    console.log(error);
    return error;
  }
};

function getQuestionResponse() {
  if (!sessionStorage.getItem("userID")) return;
  getLatestQuestions();
}
getQuestionResponse();