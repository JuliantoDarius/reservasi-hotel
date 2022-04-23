<?php if ($_SESSION["aktif"] != "kamar" && $_SESSION["aktif"] !== "reservasi") : ?>
   </div>
<?php endif; ?>

<script type="text/javascript">
   $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
      language: "id"
   });
</script>

<script src="../../style/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>