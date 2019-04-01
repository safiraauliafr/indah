<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <!-- jQuery library -->
		
		<!-- Latest compiled and minified JavaScript -->
        <script type="text/javascript" charset="utf-8" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <script>window.jQuery || document.write('<script type="text/javascript" language="javascript" src="<?=base_url('assets/frontend/js/jquery.min.js', '')?>">\x3C/script><script type="text/javascript" language="javascript" src="<?=base_url('assets/frontend/js/bootstrap.min.js', '')?>">\x3C/script>')</script>

        <?php
        if (isset($datatable))
        {
        ?>
            <!-- DataTable for BootStrap -->
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

            <script type="text/javascript" language="javascript" src="<?=base_url('assets/frontend/js/jquery.dataTables.min.js', '')?>"></script>
            <script type="text/javascript" language="javascript" src="<?=base_url('assets/frontend/js/dataTables.bootstrap.min.js', '')?>"></script>
            
            <script type="text/javascript" language="javascript">
            $(document).ready(function(){
                $('#<?=$datatable?>').DataTable({
                    "language":  {
                        "url": '<?=base_url('assets/frontend/js/dataTables.Indonesian.json', '')?>'
                    },
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
                });
            });
            </script>
        <?php
        }
        ?>
        
    </body>
</html>