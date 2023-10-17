<button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="tableExport" onclick="exportToCSV()">Excel</button>
<button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="tableExport" onclick="generatePDF()">PDF</button>
<button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="tableExport" onclick="printTable()">Print</button>
<div class="table-responsive"><br>
    <table class="table table-hover" id="tableExport" style="width:100%;" border="1">
        <thead>
            <tr>
                <th colspan="6" ><center>Dealer Sale</center></th>
            </tr>
            <tr>
                <th colspan="6"><center>Dealer - {{$name_deal}} {{$adress}}</center></th>
            </tr>
        </thead>
        <tbody>


                <tr>
                    <th>Date</th>
                    <th>Openning</th>
                    <th>Secondary</th>
                    <th>Stock Receipt</th>
                    <th>Closing</th>
                    <th>Dealer Sale</th>

                </tr>
@php
    $openCount = 0;
    $orderCount = 0;
    $stockCount = 0;
    $closing_value_1 = 0;
    $closing_value_len1 = 0;
@endphp

@foreach ($datt as $dattes)
    @php
        $openning_date = $dattes->entry_date;
        $get_sto = 0;
    @endphp

    <tr>
        <td>{{ $openning_date }}</td>

        {{-- Opening Value --}}
        @php
            $totalForRow = 0;
        @endphp

        <td id="targetTd">
            @php
                if ($closing_value_len1 == 0) {
            @endphp
            @foreach ($open as $opens)
                @if ($openning_date == $opens->open_ent)
                    {{ $opens->total_opening_stock }}
                    @php
                        $openCount++;
                        $totalForRow += $opens->total_opening_stock;
                    @endphp
                @endif
            @endforeach
            @php
                } else {
                    echo $closing_value_1;
                     $openCount++;
                    $totalForRow +=$closing_value_1;
                }
                $closing_value_len1++;
            @endphp
        </td>

        <td>
            @php
                $totalOrderQuantityForRow = 0;
            @endphp

            @foreach ($order as $orders)
                @if ($openning_date == $orders->entry_date)
                    {{ $orders->total_order_quantity }}
                    @php
                        $orderCount++;
                        $totalOrderQuantityForRow += $orders->total_order_quantity;
                    @endphp
                @else
                @endif
            @endforeach
        </td>

        <td>
            @foreach ($open as $opens_1)
                @if ($openning_date == $opens_1->open_ent)
                    {{-- @if ($openCount <= 1)
                        @foreach($dispatch as $dispatchs)
                            {{$dispatchs->total_quantity}}
                        @endforeach
                    @endif --}}
                    @if ($openCount <= 1)
                        @foreach($dispatch as $dispatchs)
                            @if ($openning_date == $dispatchs->order_date_sub)
                                {{$dispatchs->total_quantity}}
                            @endif
                            @php
                                $get_sto = 0 + $dispatchs->total_quantity;
                            @endphp
                         @endforeach
                    @else
                        @foreach($dispatch as $dispatchs)
                            @if($openning_date == $dispatchs->order_date_sub)
                                {{ $get_sto = $opens_1->total_opening_stock + $dispatchs->total_quantity }}
                            @else
                                {{ $get_sto = $opens_1->total_opening_stock }}
                            @endif

                        @endforeach
                    @endif
                        @php
                            $stockCount++;
                            $totalForRow += $get_sto;
                        @endphp
                @endif
            @endforeach
        </td>

        <td id="sourceTd">
            {{-- Closing Value --}}

            {{ $totalForRow - $totalOrderQuantityForRow }}
            @php
                $closing_value_1 = ($totalForRow - $totalOrderQuantityForRow);
            @endphp
        </td>

        <td>
            {{-- Dealer Sales --}}
            {{ $totalOrderQuantityForRow }}
        </td>
    </tr>
@endforeach


        </tbody>

    </table>
</div>


<script>
   function exportToCSV() {
    var sales_rep_name = '{{ $rep_name ? $rep_name : "ALL" }}';
    var dealer_name = '{{$dea_name ? $dea_name : "ALL" }}';
    var manager_name = '{{$mana_name ? $mana_name : "ALL" }}';
    var from_date = '{{$from_date}}';
    var to_date = '{{$to_date}}';
    const table = document.getElementById('tableExport');
    const rows = table.querySelectorAll('tr');
    const csvData = [];
    csvData.push('\uFEFF');
    const headerRow1 = ['', '', '', '', '', '', '', 'PPS AGRO FOODS - ERODE', '', '', '', '', '', '', ''];
    csvData.push(headerRow1.join(','));

    const headerRow2 = ['', '', '', '', '', '', '', 'OVERALL OIL SALES', '', '', '', '', '', '', ''];
    csvData.push(headerRow2.join(','));

    const headerRow3 = ['FROM DATE', from_date, '', 'TO DATE', to_date, '','MANAGER NAME', manager_name ,'','SALES PERSON', sales_rep_name, '', 'DISTRIBUTOR', dealer_name];
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
