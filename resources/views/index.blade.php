<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API de sistema de votaciones residencial</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts: Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- Estilos personalizados -->
  <style>
    body {
      background-color: #f9fafb;
      color: #4B5563;
      font-family: 'Inter', sans-serif;
      font-size: 15px;
    }

    .container {
      margin-top: 80px;
    }

    .card {
      border-radius: 14px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
      border: none;
    }

    .card-header {
      background-color: #2B0A41;
      color: #ffffff;
      text-align: center;
      font-size: 1.75rem;
      font-weight: 600;
      padding: 1.25rem;
      border-radius: 14px 14px 0 0;
    }

    .card-body {
      padding: 2rem;
      background-color: #ffffff;
    }

    .card-body p {
      font-size: 1rem;
      line-height: 1.6;
      color: #4B5563;
    }

    .btn-primary {
      background-color: #2B0A41;
      border-color: #2B0A41;
      font-size: 1rem;
      padding: 0.6rem 1.4rem;
      border-radius: 8px;
      color: #fff;
      text-decoration: none;
    }

    .btn-primary:hover {
      background-color: #856CA0;
      border-color: #856CA0;
    }

    .section-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #2B0A41;
      margin-bottom: 1rem;
      border-bottom: 2px solid #C9C3FF;
      padding-bottom: 0.5rem;
    }

    ul li {
      margin-bottom: 0.5rem;
      font-size: 0.95rem;
      color: #4B5563;
    }

    .btn i {
      margin-right: 8px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-house me-2"></i> API de sistema de votaciones residencial
          </div>
          <div class="card-body">
            <h2 class="section-title">Bienvenido al proyecto</h2>
            <p>
              Sistema de votación web orientado a conjuntos residenciales. Permite crear preguntas y opciones de votación, gestionar votos de manera segura y mostrar resultados en tiempo real. Esta API RESTful proporciona los endpoints necesarios para interactuar con las aplicaciones de votación, gestionar la autenticación de usuarios, registrar votaciones, emitir votos y consultar resultados en tiempo real.
            </p>
            <p>
              Desarrollada con <strong>Laravel 11</strong> y <strong>Vue.js</strong>, esta API es moderna, escalable y fácil de integrar con sistemas frontend, brindando control total sobre la administración de votaciones y usuarios en un entorno seguro y confiable.
            </p>

            <h2 class="section-title">Características principales</h2>
            <ul>
              <li><strong>Gestión de usuarios:</strong> Registro y autenticación de propietarios.</li>
              <li><strong>Administración de votaciones:</strong> Creación de preguntas y opciones.</li>
              <li><strong>Votación segura:</strong> Emisión de votos con control de acceso.</li>
              <li><strong>Resultados en tiempo real:</strong> Visualización inmediata de los votos.</li>
              <li><strong>Panel administrativo:</strong> Gestión centralizada de usuarios y votaciones.</li>
            </ul>

            <div class="text-center mt-5">
              <a href="{{ url('/api/documentation') }}" class="btn btn-primary">
                <i class="fas fa-book-open"></i> Ver documentación de la API
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
