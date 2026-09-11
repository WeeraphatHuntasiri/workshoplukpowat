<footer class="main-footer">
  <div class="float-right d-none d-sm-block"><b>Version</b> 4.0.0</div>
  <p class="mb-0">&copy; <span id="year"></span> Weeraphat. All rights reserved.</p>
  <script>document.getElementById('year').textContent = new Date().getFullYear();</script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php if (isset($_SESSION['flash'])): $flash = $_SESSION['flash']; unset($_SESSION['flash']); ?>
  <script>Swal.fire(<?= json_encode($flash, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>);</script>
  <?php endif; ?>
</footer>
