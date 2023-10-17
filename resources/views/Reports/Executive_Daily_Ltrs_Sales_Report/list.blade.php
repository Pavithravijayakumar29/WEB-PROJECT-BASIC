<button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="tableExport" onclick="exportToCSV(from_date)">Excel</button>
<button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="tableExport" onclick="generatePDF()">PDF</button>
<button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="tableExport" onclick="printTable()">Print</button>
<div class="table-responsive"><br>
    @if (isset($from_date))
    @php
        $fr_date = date('Y-m-d');
        $last_date = date('m', strtotime($fr_date));

        $currentMonth = date('m', strtotime($from_date));
        $currentYear = date('Y', strtotime($from_date));

        if ($currentMonth == $last_date) {
            $fr_date = date('Y-m-d');
            $lastDay = date('d', strtotime($fr_date));
        } else {
            $lastDay = date('t', strtotime($from_date));
        }
        $crnt_month = '';

        if ($currentMonth == '01')
            $crnt_month = "Jan";
        elseif ($currentMonth == '02')
            $crnt_month = "Feb";
        elseif ($currentMonth == '03')
            $crnt_month = "Mar";
        elseif ($currentMonth == '04')
            $crnt_month = "Aprl";
        elseif ($currentMonth == '05')
            $crnt_month = "May";
        elseif ($currentMonth == '06')
            $crnt_month = "June";
        elseif ($currentMonth == '07')
            $crnt_month = "July";
        elseif ($currentMonth == '08')
            $crnt_month = "Aug";
        elseif ($currentMonth == '09')
            $crnt_month = "Sep";
        elseif ($currentMonth == '10')
            $crnt_month = "Oct";
        elseif ($currentMonth == '11')
            $crnt_month = "Nov";
        elseif ($currentMonth == '12')
            $crnt_month = "Dec";

        $columnTotals = array_fill(0, $lastDay, 0);
        $allRowTotal = 0;

        $dayNames = [];
        for ($day = 1; $day <= $lastDay; $day++) {
            $currentDate = strtotime("$currentYear-$currentMonth-$day");
            $dayNames[$day] = date("l", $currentDate);
        }
    @endphp
    <table class="table table-hover" id="tableExport" style="width:100%;" border="1">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Manager Name</th>
            <th>Sales Rep</th>
            <th>Dealer Name</th>
            <th>Area</th>
            @for ($day = 1; $day <= $lastDay; $day++)
                <th>{{ $crnt_month }}-{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}</th>
            @endfor
            <th>Total Ltrs</th>
        </tr>
        <tr>
            <td hidden> </td>
            <td hidden> </td>
            <td hidden> </td>
            <td hidden> </td>
            <td colspan="5"> </td>
            @for ($day = 1; $day <= $lastDay; $day++)
                <th> {{ $dayNames[$day] }}
                </th>
            @endfor
<th></th>
        </tr>
        </thead>
        <tbody>
        @php
            $i1 = 1;
            $uniqueSalesRefArea = [];
        @endphp
        @foreach ($results as $result)
            @php
                $uniqueKey = $result->area_name . '-' . $result->sales_ref_name;
                if (!isset($uniqueSalesRefArea[$uniqueKey])) {
                    $uniqueSalesRefArea[$uniqueKey] = true;
                } else {
                    continue;
                }
            @endphp
            <tr>
                <td>{{ $i1 }}</td>
                <td>{{ $result->manager_name }}</td>
                <td>{{ $result->sales_ref_name }}</td>
                <td>{{ $result->dealer_name }}</td>
                <td>{{ $result->area_name }}</td>
                @php
                    $dataBySalesRefArea = collect($results)
                        ->where('area_name', $result->area_name)
                        ->where('sales_ref_name', $result->sales_ref_name);
                @endphp
                @for ($day = 1; $day <= $lastDay; $day++)
                    <td>
                        @if ($dayNames[$day] != "Sunday")
                            @php
                            $quantityFound = false;
                            $leaveFound = false;
                            @endphp

                            @foreach ($dataBySalesRefArea as $data)
                                @if (date("d", strtotime($data->order_date_sub)) == $day)

                                        <label style="color: blue">{{ $data->total_quantity }}</label>
                                        @php
                                        $columnTotals[$day - 1] += $data->total_quantity;
                                        $quantityFound = true;
                                        break;
                                        @endphp

                                @endif
                            @endforeach

                            @if (!$quantityFound)
                                @foreach ($pairs as $pair)
                                    @php
                                    $sadate = $pair['date'];
                                    $date_val = explode("-", $sadate);
                                    $get_date = $date_val[2];
                                    @endphp
                                    @if ($pair['sales_rep_id'] == $result->sales_exec && $get_date == $day)
                                        @if ($pair['attendance_status'] == 'Absent')
                                            <label style="color:red">Leave</label>
                                            @php
                                            $leaveFound = true;
                                            break;
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach
                            @endif

                            @if (!$quantityFound && !$leaveFound)
                                <label style="color: green">NR</label>
                            @endif
                        @endif
                        </td>
                @endfor
                <td>
                    @php
                        $rowTotal = $dataBySalesRefArea->sum('total_quantity');
                        $allRowTotal += $rowTotal;
                    @endphp
                    {{ $rowTotal }}
                </td>
            </tr>
            @php
                $i1++;
            @endphp
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @foreach ($columnTotals as $total)
                <td bgcolor="MediumSeaGreen" style="color:aliceblue">{{ $total }}</td>
            @endforeach
            <td bgcolor="yellow" style="color:red">{{ $allRowTotal }}</td>
        </tr>
        </tfoot>
    </table>
@endif
</div>

<script>
   function exportToCSV(from_date) {

    var sales_rep_name = '{{ $rep_name ? $rep_name : "ALL" }}';
    var dealer_name = '{{$dea_name ? $dea_name : "ALL" }}';
    var manager_name = '{{$mana_name ? $mana_name : "ALL" }}';
    var from_date = '{{$from_date}}';
    const table = document.getElementById('tableExport');
    const rows = table.querySelectorAll('tr');
    const csvData = [];
    csvData.push('\uFEFF');
    const headerRow1 = ['', '', '', '', '', '', '', 'PPS AGRO FOODS - ERODE', '', '', '', '', '', '', ''];
    csvData.push(headerRow1.join(','));
    const headerRow2 = ['', '', '', '', '', '', '', 'OVERALL OIL SALES', '', '', '', '', '', '', ''];
    csvData.push(headerRow2.join(','));
    const headerRow3 = ['DATE', from_date, '', 'MANAGER NAME', manager_name ,'','SALES PERSON', sales_rep_name, '', 'DISTRIBUTOR', dealer_name];
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
    a.download = 'Executive Daily Ltrs Sales.csv';

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
    doc.text("Executive Daily Ltrs Sales Report-{{$from_date}}", 15, 10);

    var pdfjs = document.querySelector('#tableExport');

    doc.html(pdfjs, {
        callback: function(doc) {
            doc.save("Executive Daily Ltrs Sales Report.pdf");
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
    printWindow.document.write('<h1>Executive Daily Ltrs Sales Report [{{$from_date}}]</h1>');
    printWindow.document.write(table.outerHTML);
    printWindow.document.write('</body></html>');

    printWindow.document.close();
    printWindow.print();
    printWindow.close();
}
</script>
</div>
