<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>404 - Página no encontrada</title>
<style>
  /* ===== Base ===== */
  body {
    margin: 0;
    height: 100vh;
    background: #fdfcf7;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-family: "Poppins", "Segoe UI", sans-serif;
    color: #3d3a2f;
  }

  h1 {
    font-size: 4rem;
    margin: 0;
    color: #554f45;
  }

  p {
    margin: 8px 0;
    font-size: 1.1rem;
    color: #6d665b;
    text-align: center;
  }

  /* ===== Shelf Illustration ===== */
  .shelf {
    position: relative;
    width: 260px;
    height: 120px;
    margin-bottom: 30px;
  }

  /* Shelf wood base */
  .shelf::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 14px;
    background: linear-gradient(180deg, #d4c49b, #bfa66c);
    border-radius: 4px;
  }

  /* Book styling */
  .book {
    position: absolute;
    bottom: 14px;
    width: 28px;
    height: 80px;
    background: #e8e3d4;
    border-radius: 3px;
    box-shadow: inset 0 0 0 1px rgba(0,0,0,0.08);
  }

  .book:nth-child(1) { left: 10px; background: #c6b497; }
  .book:nth-child(2) { left: 45px; background: #d9c8a4; }
  .book:nth-child(3) { left: 80px; background: #bfa66c; }
  .book:nth-child(4) { left: 115px; background: #ddd3b5; }
  .book:nth-child(5) { left: 150px; background: #b6a47f; }
  .book:nth-child(6) { left: 185px; background: #e5d7b2; }
  /* Missing slot (empty space) */
  .slot {
    position: absolute;
    bottom: 14px;
    left: 220px;
    width: 28px;
    height: 80px;
    border: 2px dashed rgba(0,0,0,0.1);
    border-radius: 3px;
    background: transparent;
  }

  /* ===== Text ===== */
  .message {
    text-align: center;
    max-width: 360px;
  }

  /* ===== Button ===== */
  .back-home {
    margin-top: 25px;
    background: #bfa66c;
    color: #fff;
    border: none;
    padding: 10px 26px;
    border-radius: 25px;
    font-size: 1rem;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
  }

  .back-home:hover {
    background: #cbb87d;
    transform: scale(1.05);
  }
</style>
</head>
<body>
  <div class="shelf">
    <div class="book"></div>
    <div class="book"></div>
    <div class="book"></div>
    <div class="book"></div>
    <div class="book"></div>
    <div class="book"></div>
    <div class="slot"></div>
  </div>

  <div class="message">
    <h1>404</h1>
    <p>Página no encontrada</p>
    <p><em>Parece que este libro se ha extraviado del estante...</em></p>
  </div>

  <button class="back-home" onclick="window.location.href='/'">Volver al inicio</button>
</body>
</html>

