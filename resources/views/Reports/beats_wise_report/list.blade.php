<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
    <tr>
        <th>Sno</th>
        <th>Entry Date</th>
        <th>Dealer Name</th>
        <th>Beats Name</th>
        <th>Shop Name</th>
        <th>Shop Whatsapp No</th>
        <th>Shop Address</th>
    </tr>
    </thead>
    <tbody>
   
    @php
        $i1 = 1;
    @endphp
    @foreach($beats_wise_report as $report)
  
    <tr>
        <td>{{ $i1 }}</td>
        <td>
            @if(isset($report->entry_date))
            {{ $report->entry_date }}
            @else
                N/A
            @endif
        </td>
        <td>
            @if(isset($report->dealer_name))
            {{ $report->dealer_name }}
            @else
                N/A
            @endif
        </td>
        <td>
            @if(isset($report->area_name))
            {{ $report->area_name }}
            @else
                N/A
            @endif
        </td>
        <td>
            @if(isset($report->shop_name))
            {{ $report->shop_name }}
            @else
                N/A
            @endif
        </td>
        <td>
            @if(isset($report->whatsapp_no))
            {{ $report->whatsapp_no }}
            @else
                N/A
            @endif
        </td>
        <td>
            @if(isset($report->address))
            {{ $report->address }}
            @else
                N/A
            @endif
        </td>
    </tr>
    @php
        $i1++;
    @endphp
   @endforeach
    </tbody>
    </table>
</div>
<script>
$(function () {
    $('#tableExport').DataTable({
        "dom": 'lBfrtip',
        "buttons": [
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6]
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                //text: '<i class="far fa-file-pdf"></i>',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6]
                }
            }
        ]
    });
});
</script>
