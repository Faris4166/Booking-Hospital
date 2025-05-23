<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MedBook</title>
  <link rel="stylesheet" href="../css/error.css" />
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vivus@0.4.6/dist/vivus.min.js"></script>
    <link rel="icon" href="../image/logo.ico">
</head>

<body>

  <article>
    <aside>
      <svg onclick="render_error.reset().play();" id="render_error" xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 809 375">
        <path
          d="M218 49H82l-14 92a192 192 0 0 1 29-2c27 0 55 6 77 19 28 16 51 47 51 92 0 70-55 122-133 122-39 0-72-11-89-22l12-37c15 9 44 20 77 20 45 0 84-30 84-78 0-46-31-79-103-79-20 0-36 2-49 4L47 9h171zM524 183c0 122-45 189-124 189-70 0-117-65-118-184C282 68 333 3 406 3c75 0 118 67 118 180zm-194 6c0 93 29 146 73 146 49 0 73-58 73-149 0-88-23-146-73-146-42 0-73 51-73 149zM806 183c0 122-45 189-124 189-70 0-117-65-118-184C564 68 615 3 688 3c75 0 118 67 118 180zm-194 6c0 93 29 146 73 146 49 0 73-58 73-149 0-88-23-146-73-146-42 0-73 51-73 149z" />
      </svg>
      <h1>Ooops - Error 500</h1>
      <p>Please contact your administrator</p>
    </aside>
  </article>

  <script>
    const render_error = new Vivus('render_error', { type: 'oneByOne', duration: 500 });
  </script>

</body>

</html>
