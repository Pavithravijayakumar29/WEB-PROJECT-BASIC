<style>
	.main-sidebar .sidebar-menu li ul.dropdown-menu li a.has-dropdown_changed:before {
		content:"";
	}
	.main-sidebar .sidebar-menu li ul.dropdown-menu li a.has-dropdown_changed {
		padding-left:20px;
	}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/swal_fun.css') }}">
<li class="menu-header">Main</li>
<?php if(in_array("",$perm_view_details['1'])){ ?>
<li class="dropdown <?php if($cur_pg_uri=="Dashboard"){echo " active";} ?>"><a href="{{ route('Dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a></li>
<?php } ?>
<?php if(in_array("",$perm_view_details['2'])){ ?>
<li class="dropdown <?php if(in_array($cur_pg_uri, array("User_Type","User_Creation","User_Screen_Main","User_Screen_Sub","User_Permission"))){echo " active";} ?>">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>Admin</span></a>
    <ul class="dropdown-menu">
        <li <?php if($cur_pg_uri=="User_Type"){echo " class='active'";}echo $perm_view_details['2']['2']; ?>><a class="nav-link" href="{{ route('User_Type') }}">User Type</a></li>
        <li <?php if($cur_pg_uri=="User_Creation"){echo " class='active'";}echo $perm_view_details['2']['3']; ?>><a class="nav-link" href="{{ route('User_Creation') }}">User Creation</a></li>
        <li <?php if($cur_pg_uri=="User_Screen_Main"){echo " class='active'";}echo $perm_view_details['2']['4']; ?>><a class="nav-link" href="{{ route('User_Screen_Main') }}">User Screen Main</a></li>
        <li <?php if($cur_pg_uri=="User_Screen_Sub"){echo " class='active'";}echo $perm_view_details['2']['5']; ?>><a class="nav-link" href="{{ route('User_Screen_Sub') }}">User Screen Sub</a></li>
        <li <?php if($cur_pg_uri=="User_Permission"){echo " class='active'";}echo $perm_view_details['2']['6']; ?>><a class="nav-link" href="{{ route('User_Permission') }}">User Permission</a></li>
    </ul>
</li>
<?php } ?>
<?php if(in_array("",$perm_view_details['3'])){ ?>
<li class="dropdown <?php if(in_array($cur_pg_uri, array("Company_Creations","Country_Creation","State_Creation","District_Creation","Market_Creation","Shops_Type","Dealer_Creation","Designation_Creation","Sales_Rep_Creation","Customer_Creation","Employee_Creation","advance_creation","expense_type_creation","Market_Manager_Creation","sub_expense_type_creation","Category_Creation","Group_Creation","Tax_Creation","Item_Liters_Type","Item_Properties_Type","Item_Creation","account_ledger_creation","Working_Days","return_creation"))){echo " active";} ?>">
  <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Masters</span></a>
  <ul class="dropdown-menu">
	<?php if(in_array("",array($perm_view_details['3']['7'],$perm_view_details['3']['8'],$perm_view_details['3']['9'],$perm_view_details['3']['10'],$perm_view_details['3']['11'],$perm_view_details['3']['17']))){ ?>
	<li class="dropdown <?php if(in_array($cur_pg_uri, array("Company_Creations","Country_Creation","State_Creation","District_Creation","Market_Creation","Shops_Type"))){echo " active";} ?>">
	  <a href="#" class="has-dropdown has-dropdown_changed"><i class="fa fa-map-marker" aria-hidden="true"></i><span>Location</span></a>
	  <ul class="dropdown-menu">
		<li <?php if($cur_pg_uri=="Company_Creations"){echo " class='active'";}echo $perm_view_details['3']['7']; ?>><a href="{{ route('Company_Creations') }}">Company Creation</a></li>
		<li <?php if($cur_pg_uri=="Country_Creation"){echo " class='active'";}echo $perm_view_details['3']['8']; ?>><a href="{{ route('Country_Creation') }}">Country Creation</a></li>
		<li <?php if($cur_pg_uri=="State_Creation"){echo " class='active'";}echo $perm_view_details['3']['9']; ?>><a href="{{ route('State_Creation') }}">State Creation</a></li>
		<li <?php if($cur_pg_uri=="District_Creation"){echo " class='active'";}echo $perm_view_details['3']['10']; ?>><a href="{{ route('District_Creation') }}">District Creation</a></li>
		<li <?php if($cur_pg_uri=="Market_Creation"){echo " class='active'";}echo $perm_view_details['3']['11']; ?>><a href="{{ route('Market_Creation') }}">Market Creation</a></li>
		<li <?php if($cur_pg_uri=="Shops_Type"){echo " class='active'";}echo $perm_view_details['3']['17']; ?>><a href="{{ route('Shops_Type') }}">Shops Type</a></li>
	  </ul>
	</li>
	<?php } ?>
    {{-- 2nd  --}}
	<?php if(in_array("",array($perm_view_details['3']['18'],$perm_view_details['3']['19'],$perm_view_details['3']['12'],$perm_view_details['3']['25'],$perm_view_details['3']['26']))){ ?>
	<li class="dropdown <?php if(in_array($cur_pg_uri, array("Dealer_Creation","Designation_Creation","Sales_Rep_Creation","Customer_Creation","Market_Manager_Creation","Employee_Creation"))){echo " active";} ?>">
	  <a href="#" class="has-dropdown has-dropdown_changed"><i class="fas fa-desktop"></i><span>Staff Category</span></a>
	  <ul class="dropdown-menu">

		<li <?php if($cur_pg_uri=="Designation_Creation"){echo " class='active'";}echo $perm_view_details['3']['19']; ?>><a href="{{ route('Designation_Creation') }}">Designation Creation</a></li>

        <li <?php if($cur_pg_uri=="Market_Manager_Creation"){echo " class='active'";}echo $perm_view_details['3']['26']; ?>><a href="{{ route('Market_Manager_Creation') }}">Manager Creation</a></li>

		<li <?php if($cur_pg_uri=="Sales_Rep_Creation"){echo " class='active'";}echo $perm_view_details['3']['12']; ?>><a href="{{ route('Sales_Rep_Creation') }}">Sales Rep Creation</a></li>

        <li <?php if($cur_pg_uri=="Dealer_Creation"){echo " class='active'";}echo $perm_view_details['3']['18']; ?>><a href="{{ route('Dealer_Creation') }}">Dealer Creation</a></li>


		{{-- <li <?php if($cur_pg_uri=="Customer_Creation"){echo " class='active'";}echo $perm_view_details['3']['25']; ?>><a href="{{ route('Customer_Creation') }}">Customer Creation</a></li>
		<li <?php if($cur_pg_uri=="Employee_Creation"){echo " class='active'";}echo $perm_view_details['3']['26']; ?>><a href="{{ route('Employee_Creation') }}">Employee Creation</a></li> --}}

	  </ul>
	</li>
	<?php } ?>
    {{-- 3rd --}}
	<?php if(in_array("",array($perm_view_details['3']['13'],$perm_view_details['3']['14'],$perm_view_details['3']['15'],$perm_view_details['3']['51']))){ ?>
	<li class="dropdown <?php if(in_array($cur_pg_uri, array("advance_creation","expense_type_creation","sub_expense_type_creation","account_ledger_creation"))){echo " active";} ?>">
	  <a href="#" class="has-dropdown has-dropdown_changed"><i class='fas fa-hand-holding-usd' aria-hidden="true" style='font-size:24px'></i><span>Expense</span></a>
	  <ul class="dropdown-menu">
		<li <?php if($cur_pg_uri=="advance_creation"){echo " class='active'";}echo $perm_view_details['3']['13']; ?>><a href="{{ route('advance_creation') }}">Advance Creation</a></li>

		<li <?php if($cur_pg_uri=="expense_type_creation"){echo " class='active'";}echo $perm_view_details['3']['14']; ?>><a href="{{ route('expense_type_creation') }}">Expense Type Creation</a></li>

		<li <?php if($cur_pg_uri=="sub_expense_type_creation"){echo " class='active'";}echo $perm_view_details['3']['15']; ?>><a href="{{ route('sub_expense_type_creation') }}">Sub Expense Type Creation</a></li>

		<li <?php if($cur_pg_uri=="account_ledger_creation"){echo " class='active'";}echo $perm_view_details['3']['51'];  ?>><a href="{{ route('account_ledger_creation') }}">Account Ledger Creation</a></li>
	  </ul>
	</li>
	<?php } ?>
    {{-- 4th --}}
	<?php if(in_array("",array($perm_view_details['3']['20'],$perm_view_details['3']['21'],$perm_view_details['3']['22'],$perm_view_details['3']['48'],$perm_view_details['3']['49'],$perm_view_details['3']['23']))){ ?>
	<li class="dropdown <?php if(in_array($cur_pg_uri, array("Category_Creation","Group_Creation","Tax_Creation","Item_Liters_Type","Item_Properties_Type","Item_Creation"))){echo " active";} ?>">
	  <a href="#" class="has-dropdown has-dropdown_changed"><i class="fa fa-wrench" aria-hidden="true"></i><span>Item Category</span></a>
	  <ul class="dropdown-menu">
		<li <?php if($cur_pg_uri=="Category_Creation"){echo " class='active'";}echo $perm_view_details['3']['20']; ?>><a href="{{ route('Category_Creation') }}">Category Creation</a></li>
		<li <?php if($cur_pg_uri=="Group_Creation"){echo " class='active'";}echo $perm_view_details['3']['21']; ?>><a href="{{ route('Group_Creation') }}">Group Creation</a></li>
		<li <?php if($cur_pg_uri=="Tax_Creation"){echo " class='active'";}echo $perm_view_details['3']['22']; ?>><a href="{{ route('Tax_Creation') }}">Tax Creation</a></li>
		<li <?php if($cur_pg_uri=="Item_Liters_Type"){echo " class='active'";}echo $perm_view_details['3']['48']; ?>><a href="{{ route('Item_Liters_Type') }}">Unit of Measure</a></li>
		<li <?php if($cur_pg_uri=="Item_Properties_Type"){echo " class='active'";}echo $perm_view_details['3']['49']; ?>><a href="{{ route('Item_Properties_Type') }}">Packing Type </a></li>
		<li <?php if($cur_pg_uri=="Item_Creation"){echo " class='active'";}echo $perm_view_details['3']['23']; ?>><a href="{{ route('Item_Creation') }}">Item Creation</a></li>
	  </ul>
	</li>
	<?php } ?>
    {{-- 5th --}}
	<?php if(in_array("",array($perm_view_details['3']['24'],$perm_view_details['3']['53']))){ ?>
        <li class="dropdown <?php if(in_array($cur_pg_uri, array("Working_Days","return_creation"))){echo " active";} ?>">
          <a href="#" class="has-dropdown has-dropdown_changed"><i class="fa fa-universal-access" aria-hidden="true"></i><span>Comman Master</span></a>
          <ul class="dropdown-menu">
            <li <?php if($cur_pg_uri=="Working_Days"){echo " class='active'";}echo $perm_view_details['3']['24']; ?>><a href="{{ route('Working_Days') }}">Working Days Creation</a></li>

            <li <?php if($cur_pg_uri=="return_creation"){echo " class='active'";}echo $perm_view_details['3']['53']; ?>><a href="{{ route('return_creation') }}">Return Type Creation</a></li>
          </ul>
        </li>
        <?php } ?>
  </ul>
</li>
<?php } ?>
<?php if(in_array("",$perm_view_details['4'])){ ?>
<li class="dropdown <?php if(in_array($cur_pg_uri, array("Attendance_Entry","Sales_Order-COMPANY_TO_DEALER","Sales_Order-DEALER_TO_SHOP","Sales_Order_Stock","Sales_Order_Delivery","Expense_creations","Receipt_Entry","Sales_Return-DEALER_TO_COMPANY"))){echo " active";} ?>">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Entry &nbsp; &nbsp; &nbsp; <img src="{{ asset('assets/img/info.png') }}" width="20" height="20" title="Entry Info" onclick="entry_info2()" alt="Info Image"></span></a>
    <ul class="dropdown-menu">
        <?php if(in_array("",array($perm_view_details['4']['27'],$perm_view_details['4']['28'],$perm_view_details['4']['29'],$perm_view_details['4']['50'],$perm_view_details['4']['30'],$perm_view_details['4']['52'],$perm_view_details['4']['33']))){ ?>

		  <li <?php if($cur_pg_uri=="Attendance_Entry"){echo " class='active'";}echo $perm_view_details['4']['27']; ?>><a class="nav-link" href="{{ route('Attendance_Entry') }}">Attendance Entry</a></li>

		  <li <?php if($cur_pg_uri=="Sales_Order_Stock"){echo "class='active'";}echo $perm_view_details['4']['50']; ?>><a class="nav-link" href="{{ route('Sales_Order_Stock') }}">Party Opening Stock</a></li>

		  <li <?php if($cur_pg_uri=="Sales_Order-DEALER_TO_SHOP"){echo "class='active'";}echo $perm_view_details['4']['29']; ?>><a class="nav-link" href="{{ route('Sales_Order_D2S') }}">Secondary Sales</a></li>

		  <li <?php if($cur_pg_uri=="Sales_Order-COMPANY_TO_DEALER"){echo " class='active'";}echo $perm_view_details['4']['28']; ?>><a class="nav-link" href="{{ route('Sales_Order_C2D') }}">Order Recipt</a></li>

		  <li <?php if($cur_pg_uri=="Sales_Order_Delivery"){echo " class='active'";}echo $perm_view_details['4']['30']; ?>><a class="nav-link" href="{{ route('Sales_Order_Delivery') }}">Order Dispatch</a></li>

		  <li <?php if($cur_pg_uri=="Sales_Return-DEALER_TO_COMPANY"){echo " class='active'";}echo $perm_view_details['4']['32']; ?>><a class="nav-link" href="{{ route('Sales_Return_D2C') }}">Return Entry</a></li>

          <li <?php if($cur_pg_uri=="Expense_creations"){echo "class='active'";}echo $perm_view_details['4']['52']; ?>><a class="nav-link" href="{{ route('Expense_Creations') }}">Expense Creation</a></li>

		  <li <?php if($cur_pg_uri=="Receipt_Entry"){echo "class='active'";}echo $perm_view_details['4']['33']; ?>><a class="nav-link" href="{{ route('Receipt_Entry') }}">Receipt Entry</a></li>
        <?php }?>
    </ul>
</li>
<?php }?>
<?php if(in_array("",$perm_view_details['5'])){ ?>
    <li class="dropdown <?php if(in_array($cur_pg_uri, array("Beats_Wise_Report","Sales_Order_Report_c2d","Dealer_Order_Report","Effective_Calls_Report","dealer_sales_report","Item_Sales_pending_Month_Wise_Report","e_c_report","Sales_Box_Report","Receipt_Report","excutive_sales_report"))){echo " active";} ?>">
    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Reports</span></a>
    <ul class="dropdown-menu">
        <?php if(in_array("",array($perm_view_details['5']['34'],$perm_view_details['5']['35'],$perm_view_details['5']['36'],$perm_view_details['5']['37'],$perm_view_details['5']['39'],$perm_view_details['5']['54'],$perm_view_details['5']['55'],$perm_view_details['5']['59']))){ ?>

        <li <?php if($cur_pg_uri=="Beats_Wise_Report"){echo "class='active'";}echo $perm_view_details['5']['34']; ?>><a class="nav-link" href="{{ route('Beats_Wise_Report') }}">Beats Wise Report</a></li>

        {{-- <li <?php if($cur_pg_uri=="Sales_Order_Report_c2d"){echo "class='active'";}echo $perm_view_details['5']['35']; ?>><a class="nav-link" href="{{ route('Sales_Order_report_C2D') }}">Sales Order Report (C->D)</a></li> --}}


        <li <?php if($cur_pg_uri=="Dealer_Order_Report"){echo "class='active'";}echo $perm_view_details['5']['46']; ?>><a class="nav-link" href="{{ route('d_o_report') }}">Primary Orders Report</a></li>

        <li <?php if($cur_pg_uri=="excutive_sales_report"){echo " class='active'";}echo $perm_view_details['5']['36']; ?>><a class="nav-link" href="{{ route('excutive_sales_report') }}">Executive Ltrs Sales Report</a></li>

        <li <?php if($cur_pg_uri=="dealer_sales_report"){echo " class='active'";}echo $perm_view_details['5']['39']; ?>><a class="nav-link" href="{{ route('dealer_sales_report_1') }}">Dealer Sales Report</a></li>



		  <li <?php if($cur_pg_uri=="Item_Sales_pending_Month_Wise_Report"){echo " class='active'";}echo $perm_view_details['5']['54']; ?>><a class="nav-link" href="{{ route('Item_Sales_Pending_Month_Wise_Report') }}">Item Sales Pending Month Wise Report</a></li>

          <li <?php if($cur_pg_uri=="Effective_Calls_Report"){echo " class='active'";}echo $perm_view_details['5']['44']; ?>><a class="nav-link" href="{{ route('e_c_report') }}">Effective Calls</a></li>

		<li <?php if($cur_pg_uri=="Sales_Box_Report"){echo " class='active'";}echo $perm_view_details['5']['55']; ?>><a class="nav-link" href="{{ route('Sales_Box_Report') }}">Sales Box Report</a></li>

        <li <?php if($cur_pg_uri=="Receipt_Report"){echo " class='active'";}echo $perm_view_details['5']['59']; ?>><a class="nav-link" href="{{ route('receipt_report') }}">Receipt Entry Report</a></li>

        <?php } ?>
    </ul>
</li>
<?php } ?>

<script src="{{ asset('assets/js/swal_fun.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
