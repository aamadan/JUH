              <?php 
                session_start(); 
                include '../lib/conn.php';              
                $sql="CALL rp_patient_by_doctor('$_SESSION[id]')";
                $result=$conn->query($sql);
                $col=$result->fetch_fields();
                ?>
                <table id="rpt" class="table table-hover text-nowrap" style="table-layout: fixed;">
                  <thead>
                    <tr>
                      <th width="6%" align="center">S. NO</th>
                      <th width="10%" align="center">Ticket No</th>
                      <th width="25%">Patient Full Name</th>
                      <th width="10%">Gender</th>
                      <th width="11%">Age</th>
                      <th width="11%">Status</th>
                      <th width="11%">Visit Date</th>
                      <th width="6%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                  $i=1;
                  while ($row=$result->fetch_assoc()) {
                  ?>
                    <tr>
                      <td width="6%" align="center" style="color: black;"><?php echo $i?></td>
                      <td width="10%" align="center" style="color: black;"><?php echo $row["Ticket No"]?></td>
                      <td width="25%" style="color: black;"><?php echo $row["Full Name"]?></td>
                      <td width="10%" style="color: black;"><?php echo $row["Gender"]?></td>
                      <td width="11%" style="color: black;"><?php echo $row["Age"]?></td>
                      <td width="11%" style="color: black;"><?php echo $row["Status"]?></td>
                      <td width="11%" style="color: black;"><?php echo $row["Ticket Date"]?></td>
                      <td width="6%" style="color: black;" align="center"><?php echo $row["Action"]?></td>
                    </tr>
                  <?php
                  $i++;
                  }
                  ?>
                  </tbody>
                </table>
                <script>
            $(function () {
              $("#example1").DataTable();
              $('#rpt').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
              });
            });
          </script>