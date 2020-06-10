<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/auth/landing.css') }}" rel="stylesheet">
</head>
<body>
    <header class="container-fluid">
        <div class="d-flex justify-content-between align-items-center py-2 px-5">
            <div class="container">
                <h3 class="text-white">Drivify</h3>
            </div>
            <div class="d-flex justify-content-around container align-items-center w-25 mr-0">
                <a href="/login" class="text-white text-decoration-none btn">Login</a>
                <a href="/register" class="text-white text-decoration-none btn">Registro</a>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center h-75">
            <h1 class="text-white title">Viaja con gente con gustos musicales diferentes</h1>
        </div>
    </header>
   
  <section class="features" id="features">
    <div class="container">
      <div class="section-heading text-center">
        <h2>Recursos ilimitados, diversion ilimitada</h2>
        <p class="text-muted">Prueba nuestra web, no tendras que pelear mas por la musica</p>
        <hr>
      </div>
      <div class="row">
        <div class="col my-auto">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-6">
                <div class="feature-item">
                  <i class="icon-screen-smartphone text-primary"></i>
                  <h3>¡Vamonos de viaje!</h3>
                  <p class="text-muted">Añade tu salida y tu destino, comparte el codigo con tus ocupantes y elige tus canciones</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="feature-item">
                  <i class="icon-camera text-primary"></i>
                  <h3>Uso intuitivo</h3>
                  <p class="text-muted">Revise sus viajes, edite su perfil, y mucho mas</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="feature-item">
                  <i class="icon-present text-primary"></i>
                  <h3>Totalmente gratis</h3>
                  <p class="text-muted">No te preocupes por el dinero. Es totalmente gratis hoy y para siempre</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="feature-item">
                  <i class="icon-lock-open text-primary"></i>
                  <h3>Tus datos para ti</h3>
                  <p class="text-muted">En Drivify no tendras que preocuparte por tus datos personales.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cta">
    <div class="cta-content">
      <div class="container">
        <h2>No esperes mas.<br>Empieza a usar Drivify.</h2>
        <a href="/register" class="btn btn-outline btn-xl js-scroll-trigger">A viajar se ha dicho</a>
      </div>
    </div>
    <div class="overlay"></div>
  </section>

  <footer>
    <div class="container">
      <h3 class="text-white">&copy; Drivify</h3>
    </div>
  </footer>

</body>
</html>