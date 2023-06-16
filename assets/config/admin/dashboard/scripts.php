  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/datatables/js/jquery.min.js"></script>
  <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
  <script src="../../vendor/datatables/js/jquery.semanticui.min.js"></script>
  <script src="../../vendor/datatables/js/semantic.min.js"></script>
  <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e)=>{
            let arrowParent = e.target.parentElement.parentElement;
            arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("close");
        });
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>