<?php

include "../includes/connection.php";
session_start();

$employee_id = $_SESSION['employee_id'];

$query = "SELECT * from leave_balance_tbl WHERE employee_id = $employee_id";
$query_res = mysqli_query($conn, $query);
if ($row = mysqli_fetch_assoc($query_res)) {
    $sick_leave = $row['sick_leave'];
    $vacational_leave = $row['vacational_leave'];
    $marriage_leave = $row['marriage_leave'];
    $bereavement_leave = $row['bereavement_leave'];
    $other_leave = $row['other_leave'];
    $balance = $row['balance'];
}


$xValues = ["Sick Leave","Vacational Leave", "Marriage Leave", "Bereavement Leave", "Others"];
$yValues = [$sick_leave, $vacational_leave, $marriage_leave, $bereavement_leave, $other_leave];

?>

<div class="leave-container">
    <div class="chart-container">
        <canvas id="myChart" style="width:100%;max-width:600px;height:400px"></canvas>

    </div>
    <div class="leave-content">
        <div class="leave-title">
            <h3>Breakdown of Leave Days</h3>
            <span>Data of Leave</span>
        </div>
        <div class="leave-boxes">
            <table class="leave-tbl">
                <tr>
                    <th class="leave-th">Leave Type</th>
                    <th class="leave-th">Remaining Days</th>
                </tr>
              
                <tr>
                    <td class="leave-td" id="td-bg">Sick Leave</td>
                    <td class="leave-td"><?php echo $sick_leave ?></td>
                </tr>
                <tr>
                    <td class="leave-td" id="td-bg">Vacational Leave</td>
                    <td class="leave-td"><?php echo $vacational_leave ?></td>
                </tr>
          
                <tr>
                    <td class="leave-td" id="td-bg">Bereavement Leave</td>
                    <td class="leave-td"><?php echo $bereavement_leave ?></td>
                </tr>
                <tr>
                    <td class="leave-td" id="td-bg">Marriage Leave</td>
                    <td class="leave-td"><?php echo $marriage_leave ?></td>
                </tr>
                <tr>
                    <td class="leave-td" id="td-bg">Others</td>
                    <td class="leave-td"><?php echo $other_leave ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script>
    const xValues = <?php echo json_encode($xValues); ?>; // Labels for types of leaves
    const yValues = <?php echo json_encode($yValues); ?>; // Corresponding counts or values for each type of leave
    const barColors = [
        "#b91d47",
        "#00aba9",
        "#32ab01",
        "#2b5797",
        "#01b021",
  
    ];

    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
    });
</script>