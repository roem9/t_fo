        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> sisting.id
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</main>
  <!-- jquery  -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <!--   Core JS Files   -->
  <script src="<?= base_url()?>/assets/js/core/popper.min.js"></script>
  <script src="<?= base_url()?>/assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url()?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url()?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="<?= base_url()?>/assets/js/plugins/chartjs.min.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url()?>/assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
  <!-- sweet alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- data tables  -->
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

  <!-- ckeditor  -->
  <!-- <script src="https://cdn.ckeditor.com/4.20.1/basic/ckeditor.js"></script> -->
  <script src="//cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
  
  <!-- custom javascript -->
  <script src="<?= base_url()?>/assets/custom/js/validation.js"></script>
  <script src="<?= base_url()?>/assets/custom/js/helper.js"></script>

  <script>
    function logout() {
      Swal.fire({
        title: `Apa Anda yakin akan keluar dari sistem?`,
        // text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Keluar!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = '<?= base_url()?>/logout';
        }
      })
    }
  </script>
</body>

</html>