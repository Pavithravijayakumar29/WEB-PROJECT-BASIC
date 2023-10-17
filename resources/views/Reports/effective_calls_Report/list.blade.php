<button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="tableExport" onclick="exportToCSV(from_date_1.value,to_date_1.value,sales_exec.value,dealer_creation_id_1.value)">Excel</button>
<button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="tableExport" onclick="generatePDF(from_date_1.value,to_date_1.value)">PDF</button>
<button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="tableExport" onclick="printTable(from_date_1.value,to_date_1.value,sales_exec.value,dealer_creation_id_1.value)">Print</button>




<div class="table-responsive"><br>
    <table class="table table-hover" id="tableExport" style="width:100%;" border='1'>
        <?php
$grandTotal = 0; // Initialize the grand total
?>
        <div class="table-responsive">
            <thead>
               <tr>
                    <th style="width: 5%;">Sno</th>
                    <th style="width: 8%;">Order Date</th>
                    <th style="width: 8%;">Manager Name</th>
                    <th style="width: 10%;">Sales Executive</th>
                    <th style="width: 10%;">Dealer Name</th>
                    <th style="width: 10%;">Area Name</th>
                    <th style="width: 8%;">Visit Shop</th>
                    <th style="width: 8%;">Order Shop</th>
                    <th style="width: 8%;">Item Name</th>
                    <?php
                     $total_count_1 = [];
                     foreach ($item_creation_short as $item_creation_short1) {
                        $group_2=$item_creation_short1['group_name']
                        // $total_count_1[$group_2] = 0;
                        ?>
                        <th style="border-bottom: 1px solid black"><?php echo $item_creation_short1['group_name']; ?></th>
                    <?php } ?>
                    <th style="width: 8%;font-size:100%">Total</th>
                </tr>
                <tr style="border-bottom: 1px solid black">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <?php
                     $total_count_1 = [];
                     foreach ($item_creation_short as $item_creation_short1) {
                        // $total_count_1[$item_creation_short1->short_code] = 0;
                        ?>
                        <th><?php echo $item_creation_short1['short_code']; ?></th>
                    <?php } ?>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i1 = 1;
                $totalRows = $i1 - 1;
                $rowWiseStatusCheckCount = [];
                $rowWiseShortCode = [];
                $totalStatusCheckCount = 0;
                $totalStatusCheckCount_1 = 0;

                foreach ($sales_order_d2s_main as $sales_order_d2s_main1) {
                    $rowWiseStatusCheckCount[] = $sales_order_d2s_main1->status_check_count;
                    $rowWiseShortCode[] = $sales_order_d2s_main1->short_code;
                    $totalStatusCheckCount += $sales_order_d2s_main1->status_check_count;
                    $totalStatusCheckCount_1 += $sales_order_d2s_main1->status_check_count_1;
                    $total = 0;

                    if (is_numeric($sales_order_d2s_main1->status_check_count)) {
                        $total += $sales_order_d2s_main1->status_check_count;
                    }
                    ?>
                    <tr>
                        <td><?php echo $i1;
                            $i1++; ?></td>

                        <td><?php echo $sales_order_d2s_main1->order_date; ?></td>
                        <td><?php echo $sales_order_d2s_main1->manager_name; ?></td>
                        <td><?php echo $sales_order_d2s_main1->sales_ref_name; ?></td>
                        <td><?php echo $sales_order_d2s_main1->dealer_name; ?></td>
                        <td><?php echo $sales_order_d2s_main1->area_name; ?></td>
                        <td><?php echo $visit = $sales_order_d2s_main1->status_check_count; ?></td>
                        <td>
                            <?php echo $order = ($sales_order_d2s_main1->status_check_count_1 > 0) ? $sales_order_d2s_main1->status_check_count_1 : '0'; ?>
                        </td>
                        <td style="text-align: center;">
                            <?php
                            $itemNames = explode(',', $sales_order_d2s_main1->item_name);
                            if (!empty($itemNames[0])) {
                                echo trim($itemNames[0]);
                            } else {
                                echo '--';
                            }
                            ?>
                        </td>

                            <?php
                             foreach ($item_creation_short as $item_creation_short1) {
                                if ($item_creation_short1['short_code'] == $sales_order_d2s_main1->short_code_2) {
                                    // $total_count_1[$item_creation_short1->short_code] += floatval($sales_order_d2s_main1->order_1);
                                    ?>
                                    <td>

                                        <?php echo  $sales_order_d2s_main1->order_1; ?>
                                    </td>
                                <?php } else { ?>
                                    <td>0</td>
                                <?php }
                            } ?>

                        <td><?php echo $total = $sales_order_d2s_main1->order_1; ?></td>
                        <?php $grandTotal += $total;?>
                    </tr>
                <?php } ?>
            </tbody>


            <tr >
                <td hidden></td>
                <td hidden></td>
                <td hidden></td>
                <td hidden></td>
                <td hidden></td>
                <td colspan="6" style="color:MediumSeaGreen;font-size:150%"><center><b>Total</b></center></td>
                <td style="background-color:#f3f9f5f9"><?php echo $totalStatusCheckCount; ?></td>
                <td style="background-color:#f3f9f5f9"><?php echo $totalStatusCheckCount_1; ?></td>

                <td style="text-align: center;">--</td>
                <?php foreach ($item_creation_short as $item_creation_short1) { ?>
                    <td style="background-color: MediumSeaGreen; color: aliceblue">
                        <?php
                        $total_count_1[$item_creation_short1['short_code']] = 0; // Initialize the total for this column
                        foreach ($sales_order_d2s_main as $sales_order_d2s_main1) {
                            if ($item_creation_short1['short_code'] == $sales_order_d2s_main1->short_code_2) {
                                $total_count_1[$item_creation_short1['short_code']] += $sales_order_d2s_main1->order_1;
                            }
                        }
                        echo $total_count_1[$item_creation_short1['short_code']]; // Display the total for this column
                        ?>
                    </td>
                <?php } ?>



               <td style="background-color: yellow;color:red;font-size:150%"><?php echo $grandTotal; ?></td>
            </tr>


        </div>
    </table>
</div>
<script>
function exportToCSV(from_date_1, to_date_1, sales_exec, dealer_creation_id_1) {
    var sales_rep_name = '{{ $rep_name ? $rep_name : "ALL" }}';
    var dealer_name = '{{$dea_name ? $dea_name : "ALL" }}';
    var manager_name = '{{$mana_name ? $mana_name : "ALL" }}';
    var item_nam = '{{$item_nam ? $item_nam : "ALL" }}';
    var grp_nam = '{{$grp_nam ? $grp_nam : "ALL" }}';


    const table = document.getElementById('tableExport');
    const rows = table.querySelectorAll('tr');
    const csvData = [];
    csvData.push('\uFEFF');
    const headerRow1 = ['', '', '', '', '', '', '', 'PPS AGRO FOODS - ERODE', '', '', '', '', '', '', ''];
    csvData.push(headerRow1.join(','));

    const headerRow2 = ['', '', '', '', '', '', '', 'OVERALL OIL SALES', '', '', '', '', '', '', ''];
    csvData.push(headerRow2.join(','));

    const headerRow3 = ['FROM DATE', from_date_1, '', 'TO DATE', to_date_1, '','MANAGER NAME', manager_name ,'','SALES PERSON', sales_rep_name, '', 'DISTRIBUTOR', dealer_name,'','ITEM NAME' , item_nam,'','GROUP NAME',grp_nam];
    csvData.push(headerRow3.join(','));

    const headerRow4 = [' '];
    csvData.push(headerRow4.join(','));

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const rowData = [];
        const cells = row.querySelectorAll('td, th');

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
    a.download = 'Effective_Calls_Reports.csv';

    document.body.appendChild(a);
    a.click();

    window.URL.revokeObjectURL(url);
}


    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    function generatePDF(from_date_1,to_date_1) {
        // alert(to_date_1)
    const { jsPDF } = window.jspdf;

    // Adjust page size to fit more columns
    var doc = new jsPDF('l', 'mm', [2500, 2050]);

    doc.setFontSize(30);
    doc.text("Effective Calls Reports", 15, 10);

    var headers = ['FROM DATE', from_date_1, 'TO DATE', to_date_1, 'SALES PERSON','DISTRIBUTOR'];
    var pdfjs = document.querySelector('#tableExport');

    doc.html(pdfjs, {
        callback: function(doc) {
            doc.save("Effective Calls Reports.pdf");
        },
        x: 10,
        y: 50
    });
}
function printTable(from_date_1, to_date_1, sales_exec, dealer_creation_id_1) {
    const table = document.getElementById('tableExport');
    const printWindow = window.open('', '', 'width=1800,height=900');
    var sales_rep_name = '{{ $rep_name ? $rep_name : "ALL" }}';
    var dealer_name = '{{$dea_name ? $dea_name : "ALL" }}';
    const headerRow1 = ['PPS AGRO FOODS - ERODE'];
    const headerRow2 = ['OVERALL OIL SALES'];
    const headerRow3 = ['FROM DATE', from_date_1, 'TO DATE', to_date_1, 'SALES PERSON', sales_rep_name, '', 'DISTRIBUTOR', dealer_name];
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title></head><body>');
    printWindow.document.write('<h1>Effective Calls Reports </h1>');

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

    printWindow.document.write('<div style="display:flex;">');
    for (const header of headerRow3) {
        printWindow.document.write('<div style="flex:1; text-align:center;">' + header + '</div>');
    }
    printWindow.document.write('</div>'); // Close headerRow3

    printWindow.document.write(table.outerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
    printWindow.close();
}
</script>
