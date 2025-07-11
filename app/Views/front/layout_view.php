<!DOCTYPE html>
<html lang="es">
<head>
  <?= $this->include('front/head_view') ?>
</head>
<body>

  <?= $this->include('front/navbar_view') ?>

  <?php if (uri_string() === '' || uri_string() === '/') : ?>
    <main class="mt-4">
      <?= $this->renderSection('contenido') ?>
    </main>
  <?php else : ?>
    <main class="container mt-4">
      <?= $this->renderSection('contenido') ?>
    </main>
  <?php endif; ?>

  <?= $this->include('front/footer_view') ?>
  <?= view('front/chat_modal') ?>
  <script src="<?= base_url('public/assets/js/chatbot.js') ?>"></script>


</body>
</html>
