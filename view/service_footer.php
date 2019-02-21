<hr>
<footer class="text-center bg-light text-black pt-3">
  <div class="footer-above">
    Copyright &copy; 유진희 2018</footer>
  </div>
</footer>
<script>
  $('.nav-item').on('click', '.nav-link', function(){
    $('.nav-itme .nav-link.active').removeClass('active');
    $(this).addClass('active');
  })
  $('.navbar-text').on('click', function(){
    $('.navbar-text.active').removeClass('active');
    $(this).addClass('active');
  })
</script>
</body>
</html>
