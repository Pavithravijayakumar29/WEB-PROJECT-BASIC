<button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="tableExport" onclick="exportToCSV()">Excel</button>
<button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="tableExport" onclick="generatePDF()">PDF</button>
<button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="tableExport" onclick="printTable()">Print</button>
<style>
    .select2-container .select2-selection--single .select2-selection__rendered {
    padding-right: 128px;
}
</style>
<link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">

<div class="table-responsive">
    <table class="table table-sm table-hover" id="tableExport" style="width:100%;" border="1">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Sales Ref Name</th>
               

                <?php
                $idArray = []; // Initialize the ID array outside the loop

                foreach ($item_creation as $item_creation1) {
                    $idArray[] = $item_creation1->id; // Add item IDs to the array
                    ?>
                    <th colspan="2"><center>
                        <?php echo $item_creation1->short_code; ?>
                </center>
                    </th>
                   
                    <?php
                }
                ?>
            </tr>
            <tr>
            <td></td><td></td>
            <?php
                $idArray = []; // Initialize the ID array outside the loop

                foreach ($item_creation as $item_creation1) { ?>
                
            <td>Sales</td><td> Pending</td>
            <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i1 = 1; // Initialize counter
            $total_a = [];

            foreach ($sales_rep_creation as $sales_rep_creation1) {
                ?>
                
                <tr>
                    
                    <td><?php echo $i1; $i1++; ?></td>
                    <td><?php echo $sales_rep_creation1->sales_ref_name; ?></td>
                    
                    <?php
                   
                    foreach ($item_creation as $item_creation1) {
                        $total_a[ $item_creation1->id] = 0;


                        
                        $found = false; // Initialize a flag to check if sales data is found

                        foreach ($sales_order_deli as $sales_order_deli1) {
                            if ($sales_order_deli1->sales_exec == $sales_rep_creation1->id && $sales_order_deli1->item_id == $item_creation1->id) {
                                $sum_order_quantity = $sales_order_deli1->total_order_quantity;
                                $sum_balance_quantity = $sales_order_deli1->total_balance_quantity;
                                $total_a[ $item_creation1->id] += $sum_order_quantity;
                               
                                ?>
                                <td><?php echo empty($sum_order_quantity) ? 0 : $sum_order_quantity; ?>
                                </td>
                                <td><?php echo empty($sum_balance_quantity) ? 0 : $sum_balance_quantity; ?></td>
                                <?php
                                $found = true; // Set the flag to true
                                break; // No need to continue searching for this item
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
                    ?>
                </tr>
                <?php
            }
            ?>
    <tfoot>
            <tr>
                <td></td>
                <td>Total:</td>
                <?php
                  $found1 = false;
                foreach($item_creation as $item_creation1) { 
                    foreach($item_sales_total as $item_sales_total1) { 
                    $found1 = false;
                
                    if( $item_sales_total1->item_id == $item_creation1->id) {           
                ?>
            <td><?php echo $item_sales_total1->total_order_quantity; ?></td>
            <td><?php echo $item_sales_total1->total_balance_quantity;?></td>
            
            <?php $found1 = true; // Set the flag to true
                                break; }}  
                                 if (!$found1) {
                                    // Sales data not found for this item, so display 0 for both columns
                                    ?>
                                    <td>0</td>
                                    <td>0</td>
                                    <?php
                                }}?>
        </tr>
    </tfoot>

        </tbody>
    </table>
</div>
<script>
$(function () {
    $('#tableExport').DataTable({
        "dom": 'lBfrtip',
        "buttons": [
          
        ]
    });
});
</script>

<script>
    function exportToCSV() {
        const table = document.getElementById('tableExport');
        const rows = table.querySelectorAll('tr');
        const csvData = [];

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
        a.download = 'Item Sales Pending Month Wise Report.csv';

        document.body.appendChild(a);
        a.click();

        window.URL.revokeObjectURL(url);
    }

    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    function generatePDF() {
    const { jsPDF } = window.jspdf;

    // Adjust page size to fit more columns
    var doc = new jsPDF('l', 'mm', [2500, 2050]);

    doc.setFontSize(30);
    doc.text("Item Sales Pending Month Wise Report Report-{{$from_date}}", 15, 10);

    var pdfjs = document.querySelector('#tableExport');

    doc.html(pdfjs, {
        callback: function(doc) {
            doc.save("Item Sales Pending Month Wise Report Report.pdf");
        },
        x: 10,
        y: 50
    });
}
function printTable() {
    const table = document.getElementById('tableExport');
    const printWindow = window.open('', '', 'width=1800,height=900');

    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title></head><body>');
    printWindow.document.write('<h1>Item Sales Pending Month Wise Report Report [{{$from_date}}]</h1>');
    printWindow.document.write(table.outerHTML);
    printWindow.document.write('</body></html>');

    printWindow.document.close();
    printWindow.print();
    printWindow.close();
}
</script>