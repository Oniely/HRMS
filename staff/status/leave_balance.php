<?php

include "../includes/connection.php";
session_start();

$employee_id = $_SESSION['employee_id'];

$query = "SELECT * from leave_balance_tbl WHERE employee_id = $employee_id";
$query_res = mysqli_query($conn, $query);
if ($row = mysqli_fetch_assoc($query_res)) {
    $annual_leave = $row['annual_leave'];
    $sick_leave = $row['sick_leave'];
    $unpaid_leave = $row['unpaid_leave'];
    $balance = $row['balance'];
}

$xValues = ["Annual Leave", "Sick Leave", "Unpaid Leave"];
$yValues = [$annual_leave, $sick_leave, $unpaid_leave];

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
                    <th class="leave-th">Usage Percentage</th>
                </tr>
                <tr>
                    <td class="leave-td" id="td-bg">Annual Leave</td>
                    <td class="leave-td"><?php echo $annual_leave ?></td>
                    <td class="leave-td">9</td>
                </tr>
                <tr>
                    <td class="leave-td" id="td-bg">Sick Leave</td>
                    <td class="leave-td"><?php echo $sick_leave ?></td>
                    <td class="leave-td">9</td>
                </tr>
                <tr>
                    <td class="leave-td" id="td-bg">Unpaid Leave</td>
                    <td class="leave-td"><?php echo $unpaid_leave ?></td>
                    <td class="leave-td">9</td>
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
        "#2b5797",
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