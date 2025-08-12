
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});


  
$('.datepicker').datepicker();
$(document).ready(function(){               
  
                 $("#dob_time").datepicker();               
                 
                 $("#payment_date").datepicker({
                    dateFormat: 'dd-mm-yy'
                });
                 $("#starting_date").datepicker({
                    dateFormat: 'dd-mm-yy'
                });
                 $("#end_date").datepicker({
                    dateFormat: 'dd-mm-yy'
                });
                 $("#datepickerFrom").datepicker();
                 $("#datepickerTo").datepicker();
                 $("#birth_date").datepicker({
                    dateFormat: 'dd-mm-yy'
                });
                 $("#deposit_date").datepicker({
                    dateFormat: 'dd-mm-yy'
                });
                 $("#purchase_date").datepicker({
                    dateFormat: 'dd-mm-yy'
                });
                
                 
});
  




$(document).ready(function() {
    $('#income_all_list').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],
        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
} );

$(document).ready(function() {
    $('#expense_all_list').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],
        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
} );


$(document).ready(function() {
    $('#allowance_list').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],
        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
} );
$(document).ready(function() {
    var t = $('#expenses_list').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        columnDefs: [{
            targets: -1,
            visible: true
        }],
        "paging": true,
        "ordering": true,
        "info": true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ], // Include "All" as an option
    });

    t.on('order.dt search.dt', function() {
        t.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
});

$(document).ready(function() {
    var t = $('#person_list').DataTable( {         
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],

        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,    
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],    
    } );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    t.on('init', function () {
        t.api().buttons(1).active(true); // Select "All" from the length menu
    }).draw();






} );


$(document).ready(function() {
    var t = $('#payment_list').DataTable( {         
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],

        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
$(document).ready(function() {
    var t = $('#employee_list').DataTable( {         
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],

        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
$(document).ready(function() {
    var t = $('#nominee_list').DataTable( {         
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],

        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
$(document).ready(function() {
    $('#user_list').DataTable( {
        dom: 'Bfrtip',
        buttons: [


            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],
        columnDefs: [ {
            targets: -1,
            visible: false
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
} );
$(document).ready(function() {
    var t = $('#salary_list').DataTable( {
        dom: 'Bfrtip',        
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                header:true,
                exportOptions: {
                    title:'testing title',
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible',
                    
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],
             
        columnDefs: [ {
            targets: -1,
            visible: true
        } ],

     //  "pageLength": true,
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false, 

    } );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            t.cell(cell).invalidate('dom'); 
        } );
    } ).draw();
} );
$(document).ready(function() {
    var t = $('#employee_poa_history').DataTable( {         
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],

        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
$(document).ready(function() {
    var t = $('#nominee_poa_history').DataTable( {         
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],

        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );

$(document).ready(function() {
    var t = $('#nominee_nmc_history').DataTable( {         
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],

        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
$(document).ready(function() {
    var t = $('#bank_branch_list').DataTable( {         
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],

        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
$(document).ready(function() {
    var t = $('#pac_list').DataTable( {         
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                  //  columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],

        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );

$(document).ready(function() {
    var t = $('#payment_all_list').DataTable( {         
        dom: 'Bfrtip',
        footer: true,
        buttons: [
            'colvis',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [ 0, 2, 5, 6 ] //indexes of colums want to print in pdf
                    //columns:':visible'
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength'
        ],

        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "searching": true,
        "pagingType": "full_numbers",
        "scrollX": false,        
    } );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );


function showmodal(id){
    alert(":"+id);
}



$(document).ready(function(){	
	$('input[type=password]').keyup(function() {
		var pswd = $(this).val();
		
		//validate the length
		if ( pswd.length < 8 ) {
			$('#length').removeClass('valid').addClass('invalid');
		} else {
			$('#length').removeClass('invalid').addClass('valid');
		}
		
		//validate letter
		if ( pswd.match(/[A-z]/) ) {
			$('#letter').removeClass('invalid').addClass('valid');
		} else {
			$('#letter').removeClass('valid').addClass('invalid');
		}

		//validate capital letter
		if ( pswd.match(/[A-Z]/) ) {
			$('#capital').removeClass('invalid').addClass('valid');
		} else {
			$('#capital').removeClass('valid').addClass('invalid');
		}

		//validate number
		if ( pswd.match(/\d/) ) {
			$('#number').removeClass('invalid').addClass('valid');
		} else {
			$('#number').removeClass('valid').addClass('invalid');
		}
		
		//validate space
		if ( pswd.match(/[^a-zA-Z0-9\-\/]/) ) {
			$('#space').removeClass('invalid').addClass('valid');
		} else {
			$('#space').removeClass('valid').addClass('invalid');
		}
		
	}).focus(function() {
		$('#pswd_info').show();
	}).blur(function() {
		$('#pswd_info').hide();
	});
	
});

$(document).ready(function() { 
         var progressbar     = $('.progress-bar');
            $(".upload-image").click(function(){
            	$(".form-horizontal").ajaxForm(
		{
		  target: '.preview',
		  beforeSend: function() {
			$(".progress").css("display","block");
			progressbar.width('0%');
			progressbar.text('0%');
                    },

		    uploadProgress: function (event, position, total, percentComplete) {
		        progressbar.width(percentComplete + '%');
		        progressbar.text(percentComplete + '%');
		     },
		})
		.submit();
            });
        }); 



 $(document).ready(function (e) {
                $('#upload').on('click', function () {
                    alert("ok");
                    var form_data = new FormData();
                    var ins = document.getElementById('multiFiles').files.length;
                    for (var x = 0; x < ins; x++) {
                        form_data.append("files[]", document.getElementById('multiFiles').files[x]);
                    }
                    $.ajax({
                        url: 'http://localhost/pensionmgm/index.php/ajaxupload/upload_files', // point to server-side controller method
                        dataType: 'text', // what to expect back from the server
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            $('#msg').html(response); // display success response from the server
                        },
                        error: function (response) {
                            $('#msg').html(response); // display error response from the server
                        }
                    });
                });
            });
            
$(document).ready(function(){  
      $('#upload_form').on('submit', function(e){  
           e.preventDefault();  
          
           if($('#image_file').val() === '')  
           {  
                alert("Please Select the File");  
           }  
           else  
           {  
                $.ajax({  
                     url:"http://localhost/pensionmgm/index.php/employee/ajax_upload",   
                     //base_url() = http://localhost/tutorial/codeigniter  
                     method:"POST",  
                     data:new FormData(this),  
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     success:function(data)  
                     {  
                          $('#uploaded_image').html(data);  
                     }  
                });  
           }  
      });  
 });  
 
 function validate() {
    var filename=document.getElementById('image_file').value;
    var extension=filename.substr(filename.lastIndexOf('.')+1).toLowerCase();
    //alert(extension);
    if(extension=='jpg' || extension=='gif') {

       // return true;
    } else {
        alert('File extension is not allowed!');        
        return false;
    }
}


function toggle_emp_info(){
    $( "#employee_info_container" ).toggle();
}
function toggle_nomin_info(){
    $( "#nominee_info_container" ).toggle();
}
function toggle_emp_nominee_info(){
    $( "#emp_nominee_info_container" ).toggle();
}

function toggle_emp_pension_info(){
    $( "#emp_pension_info_container" ).toggle();
}
function toggle_nomin_pension_info(){
    $( "#nominee_pension_info_container" ).toggle();
}
function poa_nominee_update_toggle(){
    $( "#poa_nominee_update_container" ).toggle();
}


function nomin_plusClick(){
    $( "#poa_history_container" ).toggle();
}

function nomin_nmc_plusClick(){
    $( "#nmc_history_container" ).toggle();
}
function plusClick(){
    $( "#poa_history_container" ).toggle();
}

function poa_plusClick(){
    $( "#poa_update_container" ).toggle();
}

function nmc_nominee_update_toggle(){
    $( "#nmc_nominee_update_container" ).toggle();
}

function minusClick(){
    alert("Minus click");
}

function checkPhotoFile(fieldObj)
    {
        var FileName  = fieldObj.value;        
        var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
        var FileSize = fieldObj.files[0].size;
        var FileSizeMB = (FileSize/102400).toFixed(2);

        if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "gif"  && FileExt != "png") || FileSize>102000){  
            var error = "File type : "+ FileExt+"\n\n";
            error += "Size: " + FileSizeMB + " MB \n\n";
            error += "Please make sure your file is in jpg,jpeg,gif or png format and less than 100 KB.\n\n";
            alert(error);
            $('#image_display').attr('src', "");
            return false;
        }
       // return true;
    }

function checkPoaFile(fieldObj)
    {
        var FileName  = fieldObj.value;        
        var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
        var FileSize = fieldObj.files[0].size;
        var FileSizeMB = (FileSize/102400).toFixed(2);

        if ( (FileExt != "jpg" && FileExt != "pdf" && FileExt != "jpeg") || FileSize>512000)
        {
            var error = "File type : "+ FileExt+"\n\n";
            error += "Size: " + FileSizeMB + " MB \n\n";
            error += "Please make sure your file is in pdf,jpg,jpeg or doc format and less than 500 KB.\n\n";
            alert(error);
            return false;
        }
       // return true;
    }
function checkNmcFile(fieldObj)
    {
        var FileName  = fieldObj.value;        
        var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
        var FileSize = fieldObj.files[0].size;
        var FileSizeMB = (FileSize/102400).toFixed(2);

        if ( (FileExt != "jpg" && FileExt != "pdf" && FileExt != "jpeg") || FileSize>512000)
        {
            var error = "File type : "+ FileExt+"\n\n";
            error += "Size: " + FileSizeMB + " MB \n\n";
            error += "Please make sure your file is in pdf,jpg,jpeg or doc format and less than 500 KB.\n\n";
            alert(error);
            return false;
        }
       // return true;
    }    
    
function checkAll(){
    var photo = document.getElementById("image_file").value;
    var poa = document.getElementById("poa_file").value;
    if(isEmpty(photo)){alert("Select a photo");return false;}
    if(isEmpty(poa)){alert("Select a Proof of alive file");return false;}
 //   return false;
}    


// Speed up calls to hasOwnProperty


function isEmpty(obj) {
    //var hasOwnProperty = Object.prototype.hasOwnProperty;
    // null and undefined are "empty"
    if (obj == null) return true;

    // Assume if it has a length property with a non-zero value
    // that that property is correct.
    if (obj.length > 0)    return false;
    if (obj.length === 0)  return true;

    // If it isn't an object at this point
    // it is empty, but it can't be anything *but* empty
    // Is it empty?  Depends on your application.
    if (typeof obj !== "object") return true;

    // Otherwise, does it have any properties of its own?
    // Note that this doesn't handle
    // toString and valueOf enumeration bugs in IE < 9
  /*  for (var key in obj) {
        if (hasOwnProperty.call(obj, key)) return false;
    }
*/
    return true;
}

function changepass_check(){
   // alert("ok");
    //$('#loadingimage').show();
    $.LoadingOverlay("show");    
    return true;
}


function displayPaymentAccNo(){
    var e = document.getElementById("payment_method");
    var e_acc_no = document.getElementById("acc_no");
    var strUser = e.options[e.selectedIndex].value;
    
    if(strUser==='EFTBBCOOP'){
        e_acc_no.style.display= "block" ;
    }
        if(strUser==='Cheque'){
        e_acc_no.style.display= "none" ;
    }
        if(strUser==='EFTBANKS'){
        e_acc_no.style.display= "block" ;
    }
    
}

    




$(document).ready( function() { 
setTimeout('$(".confirm_msg").hide()',2500);

});

/* if the page has been fully loaded we add two click handlers to the button */
$(document).ready(function () {
	/* Get the checkboxes values based on the class attached to each check box */
	$("#buttonClass").click(function() {
	    getValueUsingClass();
	});
	
	/* Get the checkboxes values based on the parent div id */
	$("#buttonParent").click(function() {
	    getValueUsingParentTag();
	});
});

function getValueUsingClass(){
	/* declare an checkbox array */
	var chkArray = [];
	
	/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
	$(".chk:checked").each(function() {
		chkArray.push($(this).val());
	});
	
	/* we join the array separated by the comma */
	var selected;
	selected = chkArray.join(',') ;
	
	/* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
	if(selected.length > 0){
		alert("You have selected " + selected);	
	}else{
		alert("Please at least check one of the checkbox");	
	}
}

function getValueUsingParentTag(){
	var chkArray = [];
	
	/* look for all checkboes that have a parent id called 'checkboxlist' attached to it and check if it was checked */
	$("#checkboxlist input:checked").each(function() {
		chkArray.push($(this).val());
	});
	
	/* we join the array separated by the comma */
	var selected;
	selected = chkArray.join(',') ;
	
	/* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
	if(selected.length > 0){
		alert("You have selected " + selected);	
	}else{
		alert("Please at least check one of the checkbox");	
	}
}

function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}


$(document).ready(function() {

$("#accept_btn").click(function(event) {    
event.preventDefault();
var chkArray = [];	
	/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
	$(".chkEmpID:checked").each(function() {
		chkArray.push($(this).val());
	});
        
	/* we join the array separated by the comma */
	var selected;
	selected = chkArray.join(',') ;
	/*check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
	if(selected.length > 0){
	//    alert("You have selected " + selected);                
              var baseURL= window.location.href;                            
        //    alert("BaseUrl" + baseURL);                
               
        $.ajax({
            url : baseURL+"/approve_maker",
            type : "POST",
            data: {selectedItem: selected},
            success : function(data) {
                alert(data);
                // do something
            },
            error : function(data) {
                alert("Operation couldn't be performed ")
            }
       });
                
                
                
	}else{
		alert("Please at least check one of the checkbox");	
	}
});
});
function processAccept(){
        var appsSelected = new Array();
        $('input[name="checkApp"]:checked').each(function() {
        appsSelected.push(this.value);
        });
//       alert(appsSelected.length);
       var selectedLength=appsSelected.length;
      alert(appsSelected); 
    $.ajax({  
          type:"POST",  
          url:"updateAppPaymentStatus.php",  
          data: "appsSelected="+appsSelected+"&selectedLength="+ selectedLength,
          success: function(resp){
            if(resp){              
               // alert(resp);
                if(resp==='Success'){alert("Payment information updated successfully.");}
                if(resp==='Failed'){alert("Operation couldn't be completed.");}
               // $("#paymentAcceptResult").hide();
                window.location.href ="paymentAcceptance.php";
            }           
              },  
          error: function(e){  
            alert('Error: ' + e);  
          }  
            }); 
}

function toggle_payment_info(){
    $( "#payment_info_container" ).toggle();
}
