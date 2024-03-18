  <!-- Footers -->
  <footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <div>
          <span class="mb-3 mb-md-0 text-body-secondary" id="tahun"></span>
      </div>
      <ul class="nav col-md-4 list-unstyled d-flex justify-content-end">
          <li class="me-2">
              <a class="text-body-secondary" target="_blank" href="https://www.instagram.com/ridhosaputs">
                  <i class="fa-brands fa-instagram" style="font-size:25px;"></i>
              </a>
          </li>
          <li class="">
              <a class="text-body-secondary" target="_blank" href="https://wa.me/6281234567890">
                  <i class="fa-brands fa-whatsapp" style="font-size:25px;"></i>
              </a>
          </li>
      </ul>
  </footer>

  <script>
      // Fungsi untuk mendapatkan tahun saat ini
      function getCurrentYear() {
          // Buat objek Date
          var now = new Date();
          // Dapatkan tahun dari objek Date
          var year = now.getFullYear();
          // Kembalikan tahun
          return year;
      }

      // Fungsi untuk menampilkan tahun di dalam elemen div HTML
      function displayYear() {
          // Dapatkan elemen div dengan ID "tahun"
          var yearElement = document.getElementById("tahun");
          // Dapatkan tahun saat ini menggunakan fungsi getCurrentYear
          var currentYear = getCurrentYear();
          // Tampilkan tahun di dalam elemen div
          yearElement.innerHTML = "©  " + currentYear + " Cherry Rent";
      }


      // Panggil fungsi displayYear saat halaman dimuat
      window.onload = function() {
          displayYear();
      };
  </script>
