<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>SisConsórcios - Sistema de Administração de Consórcios</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/public/img/logoTransp.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/public/materialize/vendor/fonts/materialdesignicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/materialize/vendor/fonts/flag-icons.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('/public/materialize/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/public/materialize/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/public/materialize/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/public/materialize/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/public/materialize/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/materialize/vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('/public/materialize/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('/public/materialize/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('/public/materialize/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('/public/materialize/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/public/materialize/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="position-relative">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card p-2">
            <!-- Logo -->
            <div class="app-brand justify-content-center mt-5">
              <a href="/" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <span style="color: #666cff">
                    <img src="{{ asset('/public/img/logoTransp.png') }}" style='height: 40px' alt="">
                  </span>
                </span>
                <span class="app-brand-text demo text-heading fw-bold">SisConsórcios</span>
              </a>
            </div>
            <!-- /Logo -->

            <div class="card-body mt-2">
              <h4 class="mb-2">Bem Vindo ao SisConsórcios! 👋</h4>
              <p class="mb-4">Sistema de Administração de Consórcios Online.</p>

              <form id="formAuthentication" class="mb-3" action="/autenticar" method="POST">
                <div class="form-floating form-floating-outline mb-3">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" autofocus />
                  <label for="email">Email</label>
                </div>
                <div class="mb-3">
                  <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                      <div class="form-floating form-floating-outline">
                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="Senha" />
                        <label for="password">Senha</label>
                      </div>
                      <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                  </div>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                  <a href="auth-forgot-password-basic.html" class="float-end mb-1">
                    <span>Forgot Password?</span>
                  </a>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Entrar</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /Login -->
          <img
            alt="mask"
            src="{{ asset('/public/materialize/img/illustrations/auth-basic-login-mask-light.png') }}"
            class="authentication-image d-none d-lg-block"
          />
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/public/materialize/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/public/materialize/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/public/materialize/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/public/materialize/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('/public/materialize/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/public/materialize/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('/public/materialize/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('/public/materialize/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('/public/materialize/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/public/materialize/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('/public/materialize/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('/public/materialize/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('/public/materialize/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('/public/materialize/js/pages-auth.js') }}"></script>
  </body>
</html>
