<button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="tableExport" onclick="exportToCSV()">Excel</button>
<button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="tableExport" onclick="generatePDF()">PDF</button>
<button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="tableExport" onclick="printTable()">Print</button>

<div class="table-responsive"><br>
    <table class="table table-hover" id="tableExport" style="width:100%;" border='1'>

        <div class="table-responsive">
            <thead>
                <tr>
                    <th style="width: 5%;">Sno</th>
                    <th style="width: 8%;">Place</th>
                    <th style="width: 10%;">Dealer Name</th>
                    <th style="width: 10%;">Contact</th>
                    <th style="width: 10%;">Ledger Name</th>
                    <th style="width: 8%;">Date</th>

                    <th style="width: 8%;">Total Amount</th>

                </tr>
            </thead>
        <tbody>
            @php
                $i = 1;
                $total_bal_amount = 0;
            @endphp
                @foreach($result as $results)

                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$results->address}}</td>
                        <td>{{$results->dealer_name}}</td>
                        <td>{{$results->whatsapp_no}}</td>
                        <td>{{$results->ledger_name}}</td>
                        <td>{{$results->order_date}}</td>



                        <td>
                            {{$results->amount}}
                            @php
                                $total_bal_amount +=$results->amount;
                            @endphp
                        </td>
                    </tr>
                @endforeach
            @php
                $i++;
            @endphp
        </tbody>
            <tr >
                <td hidden></td>
                <td hidden></td>
                <td hidden></td>
                <td hidden></td>
                <td hidden></td>


                <td colspan="6" style="color:MediumSeaGreen"><center><b>Total</b> </center></td>

                <td style="background-color: yellow;color:red;">{{$total_bal_amount}} </td>
            </tr>
</table>
</div>
@foreach($result as $results)
    @php

    @endphp
@endforeach
<script>
function exportToCSV() {
    var from_date = '{{$from_date}}';
    var to_date = '{{$to_date}}';
    var tally_no = '';

    const table = document.getElementById('tableExport');
    const rows = table.querySelectorAll('tr');
    const csvData = [];
    csvData.push('\uFEFF');
    const headerRow1 = ['', '', '', '', '', '', '', 'PPS AGRO FOODS - ERODE', '', '', '', '', '', '', ''];
    csvData.push(headerRow1.join(','));

    const headerRow2 = ['', '', '', '', '', '', '', 'LEDGER REPORT', '', '', '', '', '', '', ''];
    csvData.push(headerRow2.join(','));

    const headerRow3 = ['FROM DATE', from_date, '', 'TO DATE', to_date, '', 'LEDGER NAME', tally_no, '', 'DISTRIBUTOR', ''];
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
    a.download = 'Ledger Reports.csv';

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


    var doc = new jsPDF('l', 'mm', [2500, 2050]);

    doc.setFontSize(30);
    doc.text("Ledger Reports", 15, 10);

    var headers = ['FROM DATE', from_date, 'TO DATE', to_date, 'SALES PERSON','DISTRIBUTOR'];
    var pdfjs = document.querySelector('#tableExport');

    doc.html(pdfjs, {
        callback: function(doc) {
            doc.save("Receipt Reports.pdf");
        },
        x: 10,
        y: 50
    });
}
function printTable() {
    const table = document.getElementById('tableExport');
    const printWindow = window.open('', '', 'width=1800,height=900');

    const headerRow1 = ['PPS AGRO FOODS - ERODE'];
    const headerRow2 = ['LEDGER REPORT'];

    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title></head><body>');
    printWindow.document.write('<h1>Ledger Reports </h1>');

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
