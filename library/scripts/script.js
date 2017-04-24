/* jQuery document ready. */
$(document).ready(function(){
	/*====================
	Date Picker Functions
	====================*/
	$('#datetimepicker1').datetimepicker({
		format: 'DD-MM-YYYY',    
		calendarWeeks:true,
		allowInputToggle: true,
		showTodayButton: true,
		widgetPositioning:{horizontal: 'auto', vertical: 'bottom'}
	});

	$('#datetimepicker1').on('dp.change', function (e) {
		var dday = $("#sale_date").val();
		// console.log(dday);
		
		var unformattedSaleDate = $('#sale_date').val();
		var sale_date = moment(unformattedSaleDate, "DD/MM/YYYY").format('YYYY-MM-DD');
		// console.log("date picked: " + unformattedSaleDate);
		console.log("date: " + sale_date);

		$("#outputTest").html(
			"MySQL format: " + moment(dday, "DD/MM/YYYY").format("YYYY-MM-DD")
		);

		$("#output").html(
			"Week Number: " + moment(dday, "DD/MM/YYYY").week() + " of " + 
			moment(dday, "DD/MM/YYYY").weeksInYear()
		);
		$("#output2").html(
			"Day of Year: " + moment(dday, "DD/MM/YYYY").dayOfYear()
		);
		$("#output3").html(
			"Day of Week: " + moment(dday, "DD/MM/YYYY").day() + " of 6 (" + 
			moment(dday, "DD/MM/YYYY").format("dddd") + ")"
		);
		$("#output4").html(
			"Start of Week: " + moment(dday, "DD/MM/YYYY").day(0).format("DD/MM/YYYY")
		);
		$("#output5").html(
			"End of Week: " + moment(dday, "DD/MM/YYYY").day(6).format("DD/MM/YYYY")
		);
	});
	
}); //end document ready

/*====================
Sales Inputs Functions
====================*/
function totalSales(){
	//console.log('starting sales inputs : ');
	$('.salesInputs').on('change paste keyup', function() {
		var sum = 0;
		$('.salesInputs').each(function(){
			sum += +$(this).val();
		});
		$('#saleSumTotal').html('<label>Sale Total : € </label> ' + sum);
		//console.log('Sale Total is : € ' + sum);
	});
} // end saleSumTotal

/*==============================================
				LOAD SALES
// uses MySQL '$sqlViewQuery' in "selectSales.php". 
	VIEW is:  'weekly_sales_total' 
// updates PHP table using AJAX loaded JSON data
==========================================*/
function loadSales(){ 
	var action = "Load"; //use this in PHP
	$.ajax({
		url:"modules/sales/selectSales.php", // call the variables from the model for AJAX rewrite
		method:"POST", // sends data to server
		data:{action:action}, // when 'action' button is pressed
		success:function(data){ // success callback function, receives data from server stored
			console.log("========================");
			console.log("fetching sales");
			// console.log("data");
			// console.log(data);
			console.log("finished fetching sales");
			console.log("========================");

			// clear the input fields
			$('#sale_date').val('');
			$('#dineIn_sales').val('');
			$('#takeAway_sales').val('');
			$('#delivery_sales').val('');
			$('#action').text('INSERT'); //overwrite action button text to default
			$('#resultsTable').html(data); // generate the Table for div with id 'resultTable'	
			
		}
	})
} // end loadSales


	

	