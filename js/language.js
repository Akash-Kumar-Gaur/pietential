var article = {
  en: {
    wellbeing: "Wellbeing <br /> Assessment",
    assessment: "Assessment",
    assessText: "Assess It",
    selfActualization: "Self Actualization",
    selfEsteem: "Self Esteem",
    loveBelonging: "Love and Belonging",
    safetyNeeds: "Safety Needs",
    physiologicalNeeds: "Physiological Needs",
    visualizeIt: "Visualize It",
    analyzeIt: "Analyze It",
    realizeItText: "Realize It",
    actualizeText: "Actualize it",
    yourPietentialAnalysis: "Your Pietential Analysis",
    accordingToTheAnswers:
      "According to the answers you recently supplied to Pietential, the following <br /> areas of life have been identified as having considerable growth <br /> potential for you.",
    scaleText:
      "On a scale of 1-10, with 1 being I completely disagree with this statement and 10 being I completely agree with this statement, how would you rate each of the following statements?",
    yourScore: "Your score",
    whatToBegin: "What you need to begin",
    theJourneyText: "The Journey",
    howToPractice: "How to practice over time",
    benefitsOfExercise: "Benefits of This Exercise",
    moreExercisesText: "More Exercises",
    completed: "Completed",
    welcomeToPieMind: "Welcome To PieMind!",
    exercisesRecommendation: "Here are the five exercises recommended to you based on your current wellbeing status <br /> in each category, you can start with any one of them."
  },
  hi: {
    wellbeing: "भलाई",
    assessment: "आकलन",
    assessText: "आकलन करें",
    selfActualization: "आत्म-साक्षात्कार",
    selfEsteem: "आत्म सम्मान",
    loveBelonging: "प्यार और अपनापन",
    safetyNeeds: "सुरक्षा आवश्यकताएँ",
    physiologicalNeeds: "शारीरिक आवश्यकताएँ",
    visualizeIt: "प्रत्यक्ष करें",
    analyzeIt: "विश्लेषण करें",
    realizeItText: "एहसास करें",
    actualizeText: "साकार करें",
    yourPietentialAnalysis: "आपका पाईटेंसियल विश्लेषण",
    accordingToTheAnswers:
      "आपके हाल ही में पाईटेंसियल को दिए गए उत्तरों के अनुसार, आपके जीवन के निम्नलिखित क्षेत्रों में विकास की क्षमता हैं।",
    scaleText:
      "1-10 के पैमाने पर, 1 संबोधित करता है कि आप इस कथन से पूरी तरह असहमत हैं और 10 संबोधित करता है कि इस कथन से आप पूरी तरह सहमत हैं, इस बात को ध्यान में रख कर आप निम्नलिखित प्रत्येक कथन का मूल्यांकन कैसे करेंगे?",
    yourScore: "आपका स्कोर",
    whatToBegin: "शुरुआत करने के लिए आपको क्या चाहिए",
    theJourneyText: "यात्रा",
    howToPractice: "समय के साथ अभ्यास कैसे करें",
    benefitsOfExercise: "अभ्यास के लाभ",
    moreExercisesText: "अधिक व्यायाम",
    completed: "पूर्ण",
    welcomeToPieMind: "पाईमाइंड में आपका स्वागत है!",
    exercisesRecommendation: "यहां प्रत्येक श्रेणी में आपकी वर्तमान मनोभाव स्थिति के आधार पर आपके लिए अनुशंसित पांच अभ्यास <br /> दिए गए हैं, आप उनमें से किसी एक के साथ शुरू कर सकते हैं।"
  },
};
let key = localStorage.currentLanguage == "hindi" ? "hi" : "en";
function get_i18n(item) {
  if (item.length == 1) {
    let elem = document.querySelector(`.${item}`);
    elem.innerHTML = article[key][item];
  } else {
    let elem = document.querySelectorAll(`.${item}`);
    for (let i = 0; i < elem.length; i++) {
      elem[i].innerHTML = article[key][item];
    }
  }
}
