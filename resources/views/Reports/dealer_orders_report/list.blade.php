<button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="tableExport" onclick="exportToCSV()">Excel</button>
<button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="tableExport" onclick="generatePDF()">PDF</button>
<button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="tableExport" onclick="printTable()">Print</button>
<div class="table-responsive"><br>
    <table class="table table-hover" id="tableExport" style="width:100%;" border="1">
        <thead>
            <tr>
                <th>Manager Name</th>
                <th>Sales Ref Name</th>
                <th>Dealer Name</th>
                <th>Sno</th>
             <!--    <th>Market Name</th>
                <th>Shop Name</th> -->
                <th>Place</th>
                <th>Date Of Order</th>
                @foreach ($ItemCreation as $ItemCreation1)
                    <th style="border-bottom: 1px solid black">{{ $ItemCreation1['group_name'] }}</th>
                @endforeach
                <th>Total</th>
            </tr>
            <tr style="border-bottom: 1px solid black">
                <th></td>
                <th></td>
                <th></td>
                <th></td>
                <th></td>
                <th></td>
                @foreach ($ItemCreation as $ItemCreation1)
                    <th>{{ $ItemCreation1['short_code'] }}</th>
                @endforeach
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
            $i1 = 1;
            $overallTotal = 0;
            $columnTotals = array_fill(0, count($ItemCreation), 0);
            @endphp
            @foreach ($records as $record)
                <tr>
                    <td >{{ $record->manager_name }}</td>
                    <td>{{ $record->sales_ref_name }}</td>
                    <td>{{ $record->dealer_name }}</td>
                    <td>{{ $i1 }}</td>
             <!--        <td>{{$record->area_name}}</td>
                    <td>{{ $record->shop_name }}</td> -->
                    <td>{{ $record->address }}</td>
                    <td>{{ $record->order_date_sub }}</td>
                    @php
                    $rowTotal = 0;
                    $i = 0;
                    @endphp
                    @foreach ($ItemCreation as $ItemCreation1)
                        <td>
                            @if ($ItemCreation1['short_code'] == $record->short_code)
                                {{ $record->total_order_quantity }}
                                @php
                                $rowTotal += $record->total_order_quantity;
                                $columnTotals[$i] += $record->total_order_quantity;
                                @endphp
                            @endif
                        </td>
                        @php
                        $i++;
                        @endphp
                    @endforeach
                    <td>{{ $rowTotal }}</td>
                </tr>
                @php
                $i1++;
                @endphp
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td hidden></td>
                <td hidden></td>
                <td hidden></td>

                <td hidden></td>
                <td hidden></td>
                {{-- <td hidden></td> --}}
                {{-- <td hidden></td> --}}
                <td colspan="6" align="center">Overall Total</td>
                @php
                $overallTotal = array_sum($columnTotals);
                @endphp
                @foreach ($columnTotals as $columnTotal)
                    <td bgcolor="MediumSeaGreen" style="color: aliceblue">{{ $columnTotal }}</td>
                @endforeach
                <td bgcolor="yellow" style="color:red">{{ $overallTotal }}</td>
            </tr>
        </tfoot>
    </table>
</div>


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
        a.download = 'Dealer Orders.csv';

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

    var doc = new jsPDF('l', 'mm', [1500, 1350]);
    var pdfjs = document.querySelector('#tableExport');

    doc.setFontSize(30);
    doc.text("Dealer Orders Report-{{$from_date}} to {{$to_date}}", 15, 10);

    doc.html(pdfjs, {
        callback: function(doc) {
            doc.save("Dealer_Orders.pdf");
        },
        x: 15,
        y: 20
    });
}
function printTable() {
    const table = document.getElementById('tableExport');
    const printWindow = window.open('', '', 'width=1500,height=900');

    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title></head><body>');
    printWindow.document.write('<h1>Dealor Orders [{{$from_date}} to {{$to_date}}]</h1>');
    printWindow.document.write(table.outerHTML);
    printWindow.document.write('</body></html>');

    printWindow.document.close();
    printWindow.print();
    printWindow.close();
}
</script>
