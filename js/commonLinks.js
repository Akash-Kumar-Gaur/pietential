
function includeCommonHeader(title) {
    document.write(`
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link href="/pielet/styles.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="../style/public.css" type="text/css" />
      <title>${title}</title>
      <link rel="stylesheet" href="../style/responsive.css" type="text/css" />
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    `);
  }