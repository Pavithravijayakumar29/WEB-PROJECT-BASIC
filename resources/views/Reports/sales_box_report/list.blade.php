<button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="tableExport" onclick="exportToCSV()">Excel</button>
<button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="tableExport" onclick="generatePDF()">PDF</button>
<button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="tableExport" onclick="printTable()">Print</button>


<style>

.green-background {
    background-color: #ADD8E6;
     /* Optional: To ensure text is readable on the green background */
}

</style>
<div class="table-responsive"><br>

    <table  class="table table-hover" id="tableExport" style="width:100%;" border="1">
        <thead>
            <tr >
                <th>S.No</th>
                <th>Market Name</th>
                <th>Dealer Name</th>

                <?php foreach ($item_creation as $item_creation1) { ?>

                    <th colspan="2" style="border-bottom: 1px solid black">
                        <center><?php echo $item_creation1->group_name; ?>
                        </center>
                    </th>
                <?php } ?>
                <th>No.Of Visit</th>
                <th>Total Secondary</th>
                <th>Date of Last Visit</th>
            </tr>
            <tr >
                <th></th>
                <th></th>
                <th></th>

                <?php foreach ($item_creation as $item_creation1) { ?>

                    <th colspan="2" style="border-bottom: 1px solid black">
                        <center><?php echo $item_creation1->short_code; ?>
                        </center>
                    </th>
                <?php } ?>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr style="border-bottom: 1px solid black">
                <th></th>
                <th></th>
                <th></th>
                <?php foreach ($item_creation as $item_creation1) { ?>
                    <th>Supplied <?php echo $item_creation1->short_code; ?></th>
                    <th>Pending <?php echo $item_creation1->short_code; ?></th>
                <?php } ?>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i1 = 1; // Initialize counter
                $total_a = [];

                foreach ($market_creation as $market_creation1) {
                    $test_market_id = "";
            ?>
            @foreach($sales_box_report as $sales_box_report_gats)

                @if($sales_box_report_gats->total_current_stock !='' )

                <?php foreach ($sales_box_report as $sales_box_report1) {
                    if( ($sales_box_report1->total_current_stock != '') || ($sales_box_report1->total_order_quantity != '')){}}

                    ?>


                    <tr>
                        <td><?php echo $i1;
                            $i1++; ?></td>
                        <td><?php echo $market_creation1->area_name;

                            $test = 1; ?></td>

                        <?php foreach ($sales_box_report as $sales_box_report1) {
                            $found_t = false;
                            foreach ($dealer_creation as $dealer_name1) {
                                if ($dealer_name1->area_id == $market_creation1->id && $test == '1') {

                                    //// Set the flag to true
                        ?>
                                    <td><?php echo $dealer_name1->dealer_name;
                                        $test = 2;
                                        $found_t = true;
                                        break; ?></td>
                            <?php }
                            }
                        }

                        if ($test == 1) {
                            ?>
                            <td>0</td>
                            <?php
                        }




                        foreach ($item_creation as $item_creation1) {
                            $total_a[$item_creation1->id] = 0;
                            $found = false; // Initialize a flag to check if sales data is found

                            foreach ($sales_box_report as $sales_box_report1) {
                                if ($sales_box_report1->market_id == $market_creation1->id && $sales_box_report1->item_id == $item_creation1->id) {
                                    $sum_order_quantity = $sales_box_report1->total_order_quantity;
                                    $sum_balance_quantity = $sales_box_report1->total_current_stock;
                                    $sum_total_status_check = $sales_box_report1->total_status_check;
                                    $balance_pending = $sum_balance_quantity - $sum_order_quantity;


                            ?>
                                    <td <?php echo !empty($sum_order_quantity) ? 'class="green-background"' : ''; ?>><?php echo empty($sum_order_quantity) ?  : $sum_order_quantity;   $test_market_id=$sales_box_report1->market_id;?></td>
                                    <td <?php echo !empty($balance_pending) ? 'class="green-background"' : ''; ?>><?php echo empty($balance_pending) ? 0 : $balance_pending; ?></td>
                                <?php
                                    $found = true;
                                    break;
                                }
                            }

                            if (!$found) {
                                // Sales data not found for this item, so display 0 for both columns
                                ?>
                                <td>0</td>
                                <td>0</td>
                            <?php
                            }
                        }

                        $found_cunt = false;
                        foreach ($sales_box_report_count as $sales_box_report_count1) {

                            if ($sales_box_report_count1->market_id == $market_creation1->id) {

                                $sum_total_status_check = $sales_box_report_count1->total_status_count;

                                $sum_total_order_quantity = $sales_box_report_count1->total_order_quantity;

                            ?>
                                <td <?php echo !empty($sum_order_quantity) ? 'class="green-background"' : ''; ?>><?php echo empty($sum_total_status_check) ? 0 : $sum_total_status_check; ?></td>
                                <td <?php echo !empty($sum_order_quantity) ? 'class="green-background"' : ''; ?>><?php echo empty($sum_total_order_quantity) ? 0 : $sum_total_order_quantity; ?></td>

                            <?php
                                $found_cunt = true;
                                break;
                            }
                            if (!$found_cunt) {

                            ?>


                            <?php
                            }
                        }

                        foreach ($retrieve_last_visit_date as $retrieve_last_visit_date1) {
                            $found_cunt_chk = false;
                            if ($sales_box_report_count1->market_id == $market_creation1->id) {

                                $last_entry_date = $retrieve_last_visit_date1->entry_date;



                            ?>
                                <td <?php echo !empty($last_entry_date) ? 'class="green-background"' : ''; ?>><?php echo empty($last_entry_date) ? 0 : $last_entry_date; ?>

                                </td>


                            <?php
                                $found_cunt_chk = true;
                                break;
                            }
                            if (!$found_cunt_chk) {

                            ?>
                                <td>0</td>


                        <?php
                            }
                        }


                        ?>

                    </tr>
                @endif
                @break
            @endforeach

            <?php
            }
            ?>

                <tfoot style="border-top: 1px solid black;color: #A52A2A;">
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <?php

                        foreach ($item_creation as $item_creation1) {
                            $itemOrderTotal = 0;
                            $itemCurrentTotal = 0;
                            $balance_pending_T = 0;
                            foreach ($market_creation as $market_creation1) {
                                foreach ($sales_box_report as $sales_box_report1) {
                                    if ($sales_box_report1->market_id == $market_creation1->id && $sales_box_report1->item_id == $item_creation1->id) {
                                        $itemOrderTotal += $sales_box_report1->total_order_quantity;
                                        $itemCurrentTotal += $sales_box_report1->total_current_stock;
                                    }
                                }
                            }
                        ?>
                            <td <?php echo !empty($itemOrderTotal) ? 'class="green-background"' : ''; ?> ><?php echo  $itemOrderTotal; $balance_pending_T = $itemCurrentTotal - $itemOrderTotal; ?></td>
                            <td <?php echo !empty($balance_pending_T) ? 'class="green-background"' : ''; ?>><?php $balance_pending_T = $itemCurrentTotal - $itemOrderTotal;
                                echo  $balance_pending_T; ?></td>
                        <?php } ?>
                        <?php

                        $sum_total_status_check_t = 0;
                        $sum_total_order_quantity_t = 0;
                        foreach ($market_creation as $market_creation1) {

                            foreach ($sales_box_report_count as $sales_box_report_count1) {
                                if ($sales_box_report_count1->market_id == $market_creation1->id) {
                                    $sum_total_status_check_t += $sales_box_report_count1->total_status_count;
                                    $sum_total_order_quantity_t += $sales_box_report_count1->total_order_quantity;
                                }
                            }

                        ?>

                        <?php } ?>
                        <td <?php echo !empty($sum_total_status_check_t) ? 'class="green-background"' : ''; ?>><?php echo  $sum_total_status_check_t; ?></td>
                        <td <?php echo !empty($sum_total_order_quantity_t) ? 'class="green-background"' : ''; ?>><?php echo  $sum_total_order_quantity_t; ?></td>
                        <td>0</td>
                    </tr>
                </tfoot>
                 </tbody>

    </table>
</div>

<script>
    function exportToCSV() {
        const table = document.getElementById('tableExport');
        const rows = table.querySelectorAll('tr');
        const csvData = [];


    csvData.push('\uFEFF');
    const headerRow1 = ['', '', '', '', '', '', '', 'PPS AGRO FOODS - ERODE', '', '', '', '', '', '', ''];
    csvData.push(headerRow1.join(','));

    const headerRow2 = ['', '', '', '', '', '', '', 'Sales Box Report', '', '', '', '', '', '', ''];
    csvData.push(headerRow2.join(','));

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const rowData = [];
            const cells = row.querySelectorAll('td');

            for (let j = 0; j < cells.length; j++) {
                const cellData = cells[j].textContent.trim();
                rowData.push(`"${cellData.replace(/"/g, '""')}"`);
            }

            csvData.push(rowData.join(','));
        }

        const csvContent = csvData.join('\n');
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const url = window.URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = 'Sales Box Report.csv';

        document.body.appendChild(a);
        a.click();

        window.URL.revokeObjectURL(url);
    }

    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js">

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    function generatePDF() {
    const { jsPDF } = window.jspdf;

    // Adjust page size to fit more columns
    var doc = new jsPDF('l', 'mm', [2500, 2050]);

    doc.setFontSize(30);
    doc.text("Sales Box Report-{{$from_date}}", 15, 10);

    var pdfjs = document.querySelector('#tableExport');

    doc.html(pdfjs, {
        callback: function(doc) {
            doc.save("Sales Box Report.pdf");
        },
        x: 10,
        y: 50
    });
}
function printTable() {
    const table = document.getElementById('tableExport');
    const printWindow = window.open('', '', 'width=1800,height=900');

    const headerRow1 = ['PPS AGRO FOODS - ERODE'];
    const headerRow2 = ['SALES BOX REPORT'];

    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title></head><body>');
    printWindow.document.write('<h1>Sales Box Reports </h1>');

    printWindow.document.write('<div style="display:flex;">');
    for (const header of headerRow1) {
        printWindow.document.write('<div style="flex:1; text-align:center;">' + header + '</div>');
    }
    printWindow.document.write('</div>');

    printWindow.document.write('<div style="display:flex;">');
    for (const header of headerRow2) {
        printWindow.document.write('<div style="flex:1; text-align:center;">' + header + '</div>');
    }
    printWindow.document.write('</div>');


    printWindow.document.write('</div>');

    printWindow.document.write(table.outerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
    printWindow.close();
}

</script>
