function entry_info2() {
    Swal.fire({
        // title: '<div class="attan badge-success">INFORMATION</div>',
        title: '<div class="attan badge-success" style="display: flex; align-items: center; color: white;"><img src="../assets/img/icon call.png" alt="Image" style="max-width: 60px; max-height: 60px; margin-right: 10px;"><h5><b>INFORMATION</b></h5></div>',
        html: `
            <div class="badge-group" style="background-image: url('assets/img/backimg.jpg'); background-size: cover; background-color: #ffffff; font-size: 2.125em;">
                <div class="badge-col">
                    <div class="card-header-action"> <button class="buttoninfo" onclick="attendance()">Attendance Entry </button> <button class="buttoninfo" onclick="partyopening()">Party Opening Stock </button> <button class="buttoninfo" onclick="D2S()">Secondary Sales (D->S) </button></div>
                </div>
                <div class="badge-col">
                    <div class="card-header-action"> <button class="buttoninfo" onclick="C2D()">Order Receipt </button> <button class="buttoninfo" onclick="dispatch()">Order Dispatch (C->D) </button> <button class="buttoninfo" onclick="salesreturn()">Order Recipt</button></div>
                </div>
                <div class="badge-col">
                    <div class="card-header-action"><button class="buttoninfo" onclick="expense()">Expense Creation</button> <button class="buttoninfo" onclick="receipt()">Receipt Entry</button></div>
                </div>
            </div>
        `,
        showCancelButton: false,
        customClass: {
            popup: 'custom-popup1-class',
            content: 'custom-content-class',
        },
    });
}

function attendance() {
    Swal.fire({
        // title: '<div class="attan badge-success">Attendance Info</div>',
        title: '<div class="attan badge-success"><a href="/Attendance_Entry/" style="text-decoration: none; color: white; font-size: 24px;" title="Click To Attendance Entry"><img src="../assets/img/icon call.png" alt="Image" style="max-width: 60px; max-height: 60px; margin-right: 10px;"><b>Attendance Info</b></a></div>',

        html: `
        <p class="popup-text">Welcome to the Attendance Creation</p>
        <ul class="popup-list" style="font-family: Times New Roman, Times, serif; font-size: 16px; color: #333333; list-style-type: square;">
        <li>
            In the Attendance Entry, navigate to the Create Page and choose the <b>Attendance Category Type</b>.
        </li>
        <li>
            After choosing the Attendance Category Type, list the name depend on Category Type
        </li>
        <li>
            If the "Checked All" checkbox is clicked, the Attendance Status list will show the present status for all names; otherwise, they will be marked as absent.
        </li>
        <li>
            Alternatively, individual checkboxes are available in the list for each Attendance Status (Present/Absent).
        </li>
        <li>
            <b> Store data into DataBase: attendance_entry</b>
        </li>
</ul>

        `,
        showCancelButton: true,
        showConfirmButton: false, // Set this to false to remove the OK button
        cancelButtonText: 'Back',
        customClass: {
            popup: 'custom-popup1-class',
            content: 'custom-content-class',
        },
        didOpen: () => {
            const cancelButton = Swal.getCancelButton();
            cancelButton.style.marginRight = '12px';
            cancelButton.style.marginLeft = '0';

            // Add event listener to the Back button
            cancelButton.addEventListener('click', () => {
                // Call your function here
                entry_info2();
            });
        },
    });
}

function partyopening() {
    Swal.fire({
        title: '<div class="attan badge-success"><a href="/Sales_Order_Stock/" style="text-decoration: none; color: white; font-size: 24px;" title="Click To Party Opening Stock"><img src="../assets/img/icon call.png" alt="Image" style="max-width: 60px; max-height: 60px; margin-right: 10px;"><b>Party Opening Stock</b> </a></div>',
        html: `
        <p class="popup-text">Welcome to the Party Opening Stock</p>
        <ul class="popup-list" style="font-family: Times New Roman, Times, serif; font-size: 16px; color: #333333;list-style-type: square;">
            <li>
        It has a <b>Mainlist</b> & <b>sublist</b>
        </li>
        <li>
            Select the Sales Executive, depending on the dealer
        </li>
        <li>
            In the Sublist, Select the Item Name depending on the Current Stock and Pieces/Liters. Then select Packing Type, and UOM. The Pieces/Liters Multiple with Current Stock.
        </li>
        <li>
            The Pieces/Liters it comes from Master->Item Creation.
        </li>
        <li>
        Then enter the Opening Stock. After clicking the "Add" button, the Opening Stock updates the Current Stock.
        </li>
        <li>
            Reduce the current stock based on Secondary Sales (D->S) and Order Dispatch (C->D) sales entries.
        </li>
        <li>
            <b>Store data into Main Database: sales_order_stock_main</b>
        </li>
        <li>
            <b>Store data into Sublist Database: sales_order_stock_sublist</b>
        </li>

        </ul>

        `,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Back',  // Set the text for the Back button
        // confirmButtonText: 'OK',  // Set the text for the OK button
        customClass: {
            popup: 'custom-popup1-class',
            content: 'custom-content-class',
        },
        didOpen: () => {
            const cancelButton = Swal.getCancelButton();
            cancelButton.style.marginRight = '12px';
            cancelButton.style.marginLeft = '0';

            // const confirmButton = Swal.getConfirmButton();
            // confirmButton.style.marginLeft = '12px';
            // confirmButton.style.marginRight = '10px';

            // Add event listener to the Back button
            cancelButton.addEventListener('click', () => {
                // Call your function here
                entry_info2();

            });
        },
    });
}

function D2S() {
    Swal.fire({
        title: '<div class="attan badge-success"><img src="../assets/img/icon call.png" alt="Image" style="max-width: 60px; max-height: 60px; margin-right: 10px;"><a href="/Sales_Order-DEALER_TO_SHOP/" style="text-decoration: none; color: white;font-size: 24px;" title="Click To Secondary Sales  (DEALER TO SHOP)"><b>Secondary Sales (D->S)</b></a></div>',
        html: `
             <p class="popup-text">Welcome to the Secondary Sales DEALER TO SHOP</p>
            <ul class="popup-list" style="font-family: Times New Roman, Times, serif; font-size: 16px; color: #333333;list-style-type: square;">
            <li>
                It has a <b>Mainlist</b> & <b>sublist</b>
            </li>
            <li>
                Select the Sales Executive, depending on the dealer , market name, and shop name.
           </li>
           <li>
           Click on the "Go To Visitors" button then Upload an image of the visiting shop.
         </li>
          <li>
            In the sublist, when the "Order Status" is set to NO, all the fields are disabled except for the shop name. This means the dealer only visits the shop without taking orders. If the "Order Status" is set to YES, the dealer visits the shop and takes the order.</li>
            <li>
            Then select Item Name, Packing Type, and UOM.
         </li>
         <li>
            In the sublist, the Stock (it comes from Party Opening Stock) then entered Order Quantity. The stock quantity decreases in Party Opening Stock accordingly. The  stock is based on  Sales Executive, dealer .
         </li>
         <li>
            <b> Store data into Main Database: sales_order_d2s_main </b></li>
            <li><b> Store data into Sublist Database: sales_order_d2s_sublist </b>
            </li>
         </ul>
        `,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Back',  // Set the text for the Back button
        confirmButtonText: 'OK',  // Set the text for the OK button
        customClass: {
            popup: 'custom-popup1-class',
            content: 'custom-content-class',
        },

        didOpen: () => {
            const cancelButton = Swal.getCancelButton();
            cancelButton.style.marginRight = '12px';
            cancelButton.style.marginLeft = '0';

            // const confirmButton = Swal.getConfirmButton();
            // confirmButton.style.marginLeft = '12px';
            // confirmButton.style.marginRight = '10px';

            // Add event listener to the Back button
            cancelButton.addEventListener('click', () => {
                // Call your function here
                entry_info2();

            });
        },
    });
}

function C2D() {
    Swal.fire({
        title: '<div class="attan badge-success"><img src="../assets/img/icon call.png" alt="Image" style="max-width: 60px; max-height: 60px; margin-right: 10px;"><a href="/Sales_Order-COMPANY_TO_DEALER/" style="text-decoration: none; color: white;font-size: 24px;" title="Click To Order Receipt"><b>Order Receipt</b></a></div>',
        html: `
        <p class="popup-text">Welcome to the Order Receipt</p>
        <ul class="popup-list" style="font-family: Times New Roman, Times, serif; font-size: 16px; color: #333333; list-style-type: square;">
    <li>
        It has a <b>Mainlist</b> & <b>sublist</b>
    </li>
    <li>
        Select the Sales Executive, depending on the dealer.
    </li>
    <li>
        In the Sublist, select Date, Time, Item Name, Packing Type, and UOM. Then, the stock is based on Sales Executive and dealer. The stock (it comes from Party Opening Stock). Enter the Order Quantity.
    </li>
    <li>
        It has an Order Number. After finishing the entry, the <b>Order Dispatch</b> gets the order number and shows all the details based on Order Receipt COMPANY TO DEALER.
    </li>
    <li>
        <b>Store data into Main Database: sales_order_c2d_main</b>
    </li>
    <li>
        <b>Store data into Sublist Database: sales_order_c2d_sublist</b>
    </li>
</ul>
        `,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Back',  // Set the text for the Back button
        confirmButtonText: 'OK',  // Set the text for the OK button
        customClass: {
            popup: 'custom-popup1-class',
            content: 'custom-content-class',
        },
        didOpen: () => {
            const cancelButton = Swal.getCancelButton();
            cancelButton.style.marginRight = '12px';
            cancelButton.style.marginLeft = '0';

            // const confirmButton = Swal.getConfirmButton();
            // confirmButton.style.marginLeft = '12px';
            // confirmButton.style.marginRight = '10px';

            // Add event listener to the Back button
            cancelButton.addEventListener('click', () => {
                // Call your function here
                entry_info2();

            });
        },
    });
}
function dispatch() {
    Swal.fire({
        title: '<div class="attan badge-success"><a href="/Sales_Order_Delivery/" style="text-decoration: none; color: white;font-size: 24px;" title="Click To Order Dispatch"><img src="../assets/img/icon call.png" alt="Image" style="max-width: 60px; max-height: 60px; margin-right: 10px;"><b>Order Dispatch (COMPANY TO DEALER)</b></a></div>',
        html: `
            <p class="popup-text">Welcome to the Order Dispatch (COMPANY TO DEALER)</p>
            <ul class="popup-list" style="font-family: Times New Roman, Times, serif; font-size: 16px; color: #333333;list-style-type: square;">
            <li>
                It has a <b>Mainlist</b> & <b>sublist</b>
            </li>
           <li>
            Select the Sales Executive, depending on the dealer. Then Entry the Driver Name,Driver Number,Vehicle Number and Tally Number.
           </li>
           <li>
            Tally Number is generate in Tally Software
           </li>
           <li>
         The Order Recipt Number depending on the Sublist,  If the "Checked All" checkbox is clicked, the Action will show the Dispatch status; otherwise, they will be marked as Not Dispatch.</li>
        <li>Enter the Dispatch Quantity, and the stock quantity is decrease to Party Opening Stock accordingly.
    </li>
    <li>
        <b> Store data into Main Database: sales_order_delivery_main_c </b></li>
      <li>  <b> Store data into Sublist Database: sales_order_delivery_sublist_c </b>
        </li>
            </ul>
        `,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Back',  // Set the text for the Back button
        confirmButtonText: 'OK',  // Set the text for the OK button
        customClass: {
            popup: 'custom-popup1-class',
            content: 'custom-content-class',
        },
        didOpen: () => {
            const cancelButton = Swal.getCancelButton();
            cancelButton.style.marginRight = '12px';
            cancelButton.style.marginLeft = '0';

            // const confirmButton = Swal.getConfirmButton();
            // confirmButton.style.marginLeft = '12px';
            // confirmButton.style.marginRight = '10px';

            // Add event listener to the Back button
            cancelButton.addEventListener('click', () => {
                // Call your function here
                entry_info2();

            });
        },
    });
}
function expense() {
    Swal.fire({
        title: '<div class="attan badge-success"><a href="/Expense_creations/" style="text-decoration: none; color: white;font-size: 24px;" title="Click To Expense Creation"><img src="../assets/img/icon call.png" alt="Image" style="max-width: 60px; max-height: 60px; margin-right: 10px;"><b>Expense Creation</b></a></div>',
        html: `
            <p class="popup-text">Welcome to the Expense Creation</p>
            <ul class="popup-list" style="font-family: Times New Roman, Times, serif; font-size: 16px; color: #333333; list-style-type: square;">
    <li>
        It has a <b>Mainlist</b> & <b>sublist</b>
    </li>
    <li>
        Select the Market Manager Name or Sales Rep-Name.
    </li>
    <li>
        Select the Mode of Payment.
    </li>
    <li>
        Select the Market Manager Name. The sublist Dealer Name and Market Name get disabled.
    </li>
    <li>
        Select the Expense Date, depending on the Sales Rep-Name, Dealer Name, and Market Name.
    </li>
    <li>
        Then select the Expense, Sub Expense, and Total Amount in the sublist.
    </li>
</ul>

        `,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Back',  // Set the text for the Back button
        confirmButtonText: 'OK',  // Set the text for the OK button
        customClass: {
            popup: 'custom-popup1-class',
            content: 'custom-content-class',
        },
        didOpen: () => {
            const cancelButton = Swal.getCancelButton();
            cancelButton.style.marginRight = '12px';
            cancelButton.style.marginLeft = '0';

            // const confirmButton = Swal.getConfirmButton();
            // confirmButton.style.marginLeft = '12px';
            // confirmButton.style.marginRight = '10px';

            // Add event listener to the Back button
            cancelButton.addEventListener('click', () => {
                // Call your function here
                entry_info2();

            });
        },
    });
}
function receipt() {
    Swal.fire({
        title: '<div class="attan badge-success"><a href="/Receipt_Entry/" style="text-decoration: none; color: white;font-size: 24px;" title="Click To Receipt Entry"><img src="../assets/img/icon call.png" alt="Image" style="max-width: 60px; max-height: 60px; margin-right: 10px;"><b>Receipt Entry</b></a></div>',
        html: `
            <p class="popup-text">Welcome to the Receipt Entry</p>
            <ul class="popup-list" style="font-family: Times New Roman, Times, serif; font-size: 16px; color: #333333;list-style-type: square;">
                <li>
                It has a <b>Mainlist</b> & <b> Two Sublist</b>
               </li>
                <li>
                The Main list same for Two Sublist
                </li>
                <li>
                 One sublist depend on Ledger Name and another sublist depend on Tally Number
                </li>
                <li>In main list Select Manager Name depend on Sales Executive, Dealer Name</li>
                <li><b>Ledger Name  Sublist:</b></li>
                <li>Select Ledger Name Dr</li>
                <li>Selelct Particulars Cr and enter the Amount</li>

                <li><b>Tally Number  Sublist:</b></li>

                In this sublist depend on Tally Number (In this tally number comes from Order Dispatch (C -> D))
                </li>
                <li>
                Give Pay Amount less than to Balance Amount.
                </li>
                <li>
                In the 1st entry of tally number Paid Amount will be '0' and the next entry of same tally number Balance Amount shift to  Paid Amount.
                </li>
                <li><b>Store data into Main Database: receipt_entry </b></li>
                <li><b> Store data into Ledger Name Sublist Database: receipt_entry_sub </b>
                </li>
                <li><b> Store data into Tally Number Sublist Database: receipt_entry_tally_sublist </b>
                </li>
            </ul>
        `,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Back',  // Set the text for the Back button
        confirmButtonText: 'OK',  // Set the text for the OK button
        customClass: {
            popup: 'custom-popup1-class',
            content: 'custom-content-class',
        },
        didOpen: () => {
            const cancelButton = Swal.getCancelButton();
            cancelButton.style.marginRight = '12px';
            cancelButton.style.marginLeft = '0';

            // const confirmButton = Swal.getConfirmButton();
            // confirmButton.style.marginLeft = '12px';
            // confirmButton.style.marginRight = '10px';

            // Add event listener to the Back button
            cancelButton.addEventListener('click', () => {
                // Call your function here
                entry_info2();

            });
        },
    });
}
function salesreturn() {
    Swal.fire({
        title: '<div class="attan badge-success"><a href="/Sales_Return-DEALER_TO_COMPANY/" style="text-decoration: none; color: white;font-size: 24px;" title="Click To Sales Order Return"><img src="../assets/img/icon call.png" alt="Image" style="max-width: 60px; max-height: 60px; margin-right: 10px;"><b>Return Entry</b></a></div>',
        html: `
            <p class="popup-text">Welcome to the Return Entry</p>
            <ul class="popup-list" style="font-family: Times New Roman, Times, serif; font-size: 16px; color: #333333;list-style-type: square;">
                <li>
                It has a <b>Mainlist</b> & <b>sublist</b>
            </li>
           <li>
            Select the Sales Executive, depending on the dealer. Then select the Mode Of Payment
           </li>
           <li>
            Select the Return type (it comes from Master-> Return Type)
           </li>
           <li>
            In the Sublist, select the Date, Tally Bill No,	Batch Number,Return Type, Item Name, Packing Type and UOM. Enter the Return Quantity, and the stock quantity is decrease to Party Opening Stock accordingly.
           </li>
           <li>
           <b> Store data into Main Database: sales_return_main </b></li>
          <li>
            <b> Store data into Sublist Database: sales_return_sublist </b>
           </li>
            </ul>
        `,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Back',  // Set the text for the Back button
        confirmButtonText: 'OK',  // Set the text for the OK button
        customClass: {
            popup: 'custom-popup1-class',
            content: 'custom-content-class',
        },
        didOpen: () => {
            const cancelButton = Swal.getCancelButton();
            cancelButton.style.marginRight = '12px';
            cancelButton.style.marginLeft = '0';

            // const confirmButton = Swal.getConfirmButton();
            // confirmButton.style.marginLeft = '12px';
            // confirmButton.style.marginRight = '10px';

            // Add event listener to the Back button
            cancelButton.addEventListener('click', () => {
                // Call your function here
                entry_info2();

            });
        },
    });
}
